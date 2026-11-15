param([int]$Port = 9334, [string]$OutputDirectory = 'team-preview')
$ErrorActionPreference = 'Stop'
$tab = @(Invoke-RestMethod "http://127.0.0.1:$Port/json/list") | Where-Object { $_.type -eq 'page' -and $_.url -like '*/unser-team/*' } | Select-Object -First 1
if (-not $tab) { throw 'Open the team page in a browser with remote debugging enabled.' }
$socket = New-Object System.Net.WebSockets.ClientWebSocket
$cancel = New-Object System.Threading.CancellationTokenSource
$cancel.CancelAfter(60000)
$socket.ConnectAsync([Uri]$tab.webSocketDebuggerUrl, $cancel.Token).GetAwaiter().GetResult()
$script:messageId = 0
function Invoke-Cdp([string]$Method, [hashtable]$Parameters = @{}) {
    $script:messageId++
    $id = $script:messageId
    $json = @{ id = $id; method = $Method; params = $Parameters } | ConvertTo-Json -Depth 20 -Compress
    $bytes = [Text.Encoding]::UTF8.GetBytes($json)
    $socket.SendAsync([ArraySegment[byte]]::new($bytes), [Net.WebSockets.WebSocketMessageType]::Text, $true, $cancel.Token).GetAwaiter().GetResult()
    do {
        $stream = New-Object IO.MemoryStream
        do {
            $buffer = New-Object byte[] 65536
            $received = $socket.ReceiveAsync([ArraySegment[byte]]::new($buffer), $cancel.Token).GetAwaiter().GetResult()
            $stream.Write($buffer, 0, $received.Count)
        } while (-not $received.EndOfMessage)
        $response = [Text.Encoding]::UTF8.GetString($stream.ToArray()) | ConvertFrom-Json
        $stream.Dispose()
    } while ($response.id -ne $id)
    if ($response.error) { throw ($response.error | ConvertTo-Json -Compress) }
    return $response.result
}
try {
    New-Item -ItemType Directory -Path $OutputDirectory -Force | Out-Null
    Invoke-Cdp 'Page.reload' @{ ignoreCache = $true } | Out-Null
    Start-Sleep -Seconds 1
    Invoke-Cdp 'Runtime.evaluate' @{ expression = "document.getElementById('cookie-consent-reject')?.click()" } | Out-Null
    foreach ($width in 375, 768, 1440, 1920) {
        Invoke-Cdp 'Emulation.setDeviceMetricsOverride' @{ width = $width; height = 1000; deviceScaleFactor = 1; mobile = ($width -lt 768) } | Out-Null
        $expression = @'
(async () => {
  document.querySelectorAll('.team-card img').forEach(image => image.loading = 'eager');
  await Promise.all([...document.images].map(image => image.decode().catch(() => {})));
  await new Promise(resolve => requestAnimationFrame(() => requestAnimationFrame(resolve)));
  const cards = [...document.querySelectorAll('.team-card')];
  const grids = [...document.querySelectorAll('.team-grid')];
  const portraits = [...document.querySelectorAll('.team-portrait')];
  const cta = document.querySelector('.page-hero__copy a');
  let mobileMenuWorks = true;
  if (innerWidth < 1024) {
    const toggle = document.getElementById('menu-toggle');
    toggle.click();
    mobileMenuWorks = toggle.getAttribute('aria-expanded') === 'true' && !!document.querySelector('#mobile-menu a[href$="/unser-team/"]');
    toggle.click();
  }
  return {
    viewport: innerWidth, documentWidth: document.documentElement.scrollWidth,
    cards: cards.length, rows: grids.map(grid => getComputedStyle(grid).gridTemplateColumns.split(' ').length),
    ctaStyled: getComputedStyle(cta).backgroundColor === 'rgb(189, 79, 40)', mobileMenuWorks,
    circles: portraits.every(p => p.offsetWidth === p.offsetHeight && getComputedStyle(p).borderRadius === '9999px'),
    brokenImages: [...document.images].filter(image => !image.naturalWidth).length,
    heroContained: [...document.querySelectorAll('.page-hero__copy, .team-card')].every(element => {
      const rect = element.getBoundingClientRect(); return rect.left >= 0 && rect.right <= innerWidth;
    })
  };
})()
'@
        $evaluation = Invoke-Cdp 'Runtime.evaluate' @{ expression = $expression; returnByValue = $true; awaitPromise = $true }
        if ($evaluation.exceptionDetails) { throw ($evaluation.exceptionDetails | ConvertTo-Json -Depth 5) }
        $metrics = $evaluation.result.value
        Write-Output ($metrics | ConvertTo-Json -Compress)
        if ($metrics.viewport -ne $width -or $metrics.documentWidth -gt $width -or $metrics.cards -ne 8 -or -not $metrics.circles -or $metrics.brokenImages -gt 0 -or -not $metrics.heroContained -or -not $metrics.ctaStyled -or -not $metrics.mobileMenuWorks) { throw "Layout check failed at $width px" }
        $expected = if ($width -lt 768) { '1,1' } else { '2,3' }
        if (($metrics.rows -join ',') -ne $expected) { throw "Unexpected grid columns at $width px" }
        $capture = Invoke-Cdp 'Page.captureScreenshot' @{ format = 'png'; captureBeyondViewport = $true }
        [IO.File]::WriteAllBytes((Join-Path (Join-Path (Get-Location) $OutputDirectory) "team-$width.png"), [Convert]::FromBase64String($capture.data))
    }
} finally {
    $socket.Dispose()
    $cancel.Dispose()
}