### Unser Team pflegen

- Unter **Unser Team → Alle Mitarbeiter** ist jede Person einzeln bearbeitbar: Name, Biografie, Beitragsbild und die Felder unter **Teamangaben**.
- **Mitarbeiter hervorheben** ordnet die Person der oberen Zweierspalte zu. Die übrigen Personen erscheinen darunter in drei Spalten; auf Mobilgeräten stehen alle Karten untereinander.
- **Reihenfolge** unter den Seiten-Attributen bestimmt die Position innerhalb einer Gruppe; kleinere Zahlen stehen vorne. Entwürfe erscheinen nicht auf der Website.
- Unter **Seiten → Unser Team** lassen sich Überschrift, Einleitung, Textauszug (kleine Überschrift) und Hero-Beitragsbild bearbeiten. Das Empfangsfoto dient als Fallback.
- Fehlt ein Mitarbeiterfoto, erscheint ein kreisförmiger Platzhalter „Foto folgt“ – derzeit bei Pawel Wojcicki.

### Erstmalige Einrichtung auf einer weiteren Installation

Der Custom Post Type `physio_team` wird durch `wp-content/mu-plugins/physio-team.php` automatisch geladen und bleibt unabhängig vom Theme erhalten.

Nach dem Übertragen der Dateien einmal im WordPress-Hauptverzeichnis ausführen:

```powershell
php bin/setup-team.php
```

Benötigt werden die PHP-Laufzeit und Datenbankverbindung der Website sowie die üblichen WordPress-Bildfunktionen (GD oder Imagick). Bei Local muss die Kommandozeile den Datenbankport der jeweiligen Website verwenden. Keine Zugangsdaten im Skript hinterlegen.

Der Import legt acht Mitarbeiter, die Seite `/unser-team/`, Medien und gegebenenfalls den Eintrag im zugewiesenen Hauptmenü an. Wiederholte Ausführung überschreibt keine vorhandenen Profile oder Seiteninhalte. Datenbankinhalte und Uploads werden durch das reine Übertragen der Theme-Dateien nicht mitgenommen.

### Bildquellen

Die ausgerichteten Theme-Porträts stammen aus `input/img/team` und sind anhand des Mockups zugeordnet:

| Quelle | Mitarbeiter |
| --- | --- |
| `image0.jpeg` | Skadi Briest |
| `image1.jpeg` | Roman Wojcicki |
| `image2.jpeg` | Micela Klischies |
| `image3.jpeg` | Sylwia Wojcicki |
| `image4.jpeg` | Serap Ilhan |
| `image5.jpeg` | Agata Sokolowska |
| `image6.jpeg` | Ilyada Akaydin |

Neue Porträts können direkt als Beitragsbild hochgeladen werden; WordPress erstellt einen quadratischen Zuschnitt, den die Seite kreisförmig darstellt.

### Prüfungen

```powershell
php bin/test-team.php
```

Prüft unter anderem die Berechtigungen, Metadaten, REST-Bearbeitung, Sichtbarkeit, Reihenfolge und Platzhalter. Temporäre Testprofile werden wieder entfernt.

Für die Layoutprüfung die Teamseite in einem separaten Chromium-/Edge-Profil mit Remote-Debugging auf Port 9334 öffnen, anschließend vom WordPress-Hauptverzeichnis aus:

```powershell
.\bin\test-team-layout.ps1
```

Prüft 375, 768, 1440 und 1920 Pixel, Kartenraster, Überbreite, Bilddarstellung, Terminbutton und Mobilnavigation. Bildschirmaufnahmen werden unter `team-preview` abgelegt.