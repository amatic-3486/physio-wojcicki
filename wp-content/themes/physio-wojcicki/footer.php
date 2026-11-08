<?php
/**
 * The footer for our theme.
 *
 * @package Physio_Wojcicki
 */
?>
</main><!-- #main -->

<footer id="kontakt" class="bg-cream">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
		<div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">

			<!-- Dark teal contact card -->
			<div class="bg-secondary text-white rounded-2xl p-8 flex flex-col gap-6">
				<div>
					<div class="w-12 h-12 rounded-full border-2 border-white/40 flex items-center justify-center mb-4">
						<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97a1.125 1.125 0 0 0 .417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
						</svg>
					</div>
					<h2 class="font-serif text-2xl font-semibold mb-2"><?php esc_html_e( 'Kontakt', 'physio-wojcicki' ); ?></h2>
					<p class="text-white/80 mb-1"><?php esc_html_e( 'Wir sind für Sie da.', 'physio-wojcicki' ); ?></p>
					<p class="text-white/70 text-sm"><?php esc_html_e( 'Rufen Sie uns an oder nutzen Sie unser Kontaktformular. Wir freuen uns auf Sie!', 'physio-wojcicki' ); ?></p>
				</div>
				<div class="flex flex-col gap-3 mt-auto">
					<a href="<?php echo esc_url( physio_wojcicki_contact( 'phone_href' ) ); ?>" class="inline-flex items-center justify-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-5 py-3 rounded-full transition-colors">
						<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97a1.125 1.125 0 0 0 .417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
						</svg>
						<?php echo esc_html( physio_wojcicki_contact( 'phone' ) ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/kontakt/#kontaktformular' ) ); ?>" class="inline-flex items-center justify-center gap-2 border border-white/40 hover:border-white text-white font-semibold px-5 py-3 rounded-full transition-colors">
						<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
						</svg>
						<?php esc_html_e( 'Kontaktformular', 'physio-wojcicki' ); ?>
					</a>
				</div>
			</div>

			<!-- Opening hours -->
			<div class="rounded-2xl p-8 border border-[#E5E7EB]">
				<div class="w-12 h-12 rounded-full border-2 border-accent/40 flex items-center justify-center mb-4">
					<svg class="w-6 h-6 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
					</svg>
				</div>
				<p class="text-accent text-xs font-semibold tracking-widest uppercase mb-1"><?php esc_html_e( 'Anmeldezeiten', 'physio-wojcicki' ); ?></p>
				<h2 class="font-serif text-2xl font-semibold text-secondary mb-6"><?php esc_html_e( 'Unsere Sprechzeiten', 'physio-wojcicki' ); ?></h2>
				<dl class="divide-y divide-[#E5E7EB] text-sm">
					<div class="flex items-start justify-between gap-4 py-3">
						<dt class="font-semibold text-secondary"><?php esc_html_e( 'Montag – Donnerstag', 'physio-wojcicki' ); ?></dt>
						<dd class="text-right text-[#555555]">08:00 – 12:00 Uhr<br>14:00 – 18:00 Uhr</dd>
					</div>
					<div class="flex items-start justify-between gap-4 py-3">
						<dt class="font-semibold text-secondary"><?php esc_html_e( 'Freitag', 'physio-wojcicki' ); ?></dt>
						<dd class="text-right text-[#555555]">08:00 – 13:00 Uhr</dd>
					</div>
				</dl>
				<p class="text-xs text-[#555555] mt-4"><?php esc_html_e( 'Termine nach Vereinbarung.', 'physio-wojcicki' ); ?></p>
			</div>

			<!-- Location -->
			<div class="relative overflow-hidden rounded-2xl p-8 border border-[#E5E7EB] bg-cream">
				<svg class="leaf-watermark absolute -right-6 -top-6 w-40 h-40 text-secondary/10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1" aria-hidden="true">
					<path d="M12 2c4 3 7 7 7 11a7 7 0 0 1-14 0c0-4 3-8 7-11Z" />
				</svg>
				<svg class="leaf-watermark absolute right-10 bottom-4 w-16 h-16 text-secondary/10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1" aria-hidden="true">
					<path d="M12 2c4 3 7 7 7 11a7 7 0 0 1-14 0c0-4 3-8 7-11Z" />
				</svg>
				<div class="relative">
					<div class="w-12 h-12 rounded-full border-2 border-accent/40 flex items-center justify-center mb-4">
						<svg class="w-6 h-6 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
						</svg>
					</div>
					<p class="text-accent text-xs font-semibold tracking-widest uppercase mb-1"><?php esc_html_e( 'Unsere Praxis', 'physio-wojcicki' ); ?></p>
					<h2 class="font-serif text-2xl font-semibold text-secondary mb-4"><?php esc_html_e( 'So finden Sie uns', 'physio-wojcicki' ); ?></h2>
					<p class="text-[#555555] mb-6"><?php echo esc_html( physio_wojcicki_contact( 'address_1' ) ); ?><br><?php echo esc_html( physio_wojcicki_contact( 'address_2' ) ); ?></p>
					<a href="https://www.google.com/maps/search/?api=1&query=<?php echo rawurlencode( physio_wojcicki_contact( 'address_1' ) . ', ' . physio_wojcicki_contact( 'address_2' ) ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 border border-secondary/30 hover:border-accent hover:text-accent text-secondary font-semibold px-5 py-2.5 rounded-full transition-colors">
						<?php esc_html_e( 'Auf Karte anzeigen', 'physio-wojcicki' ); ?>
						<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
						</svg>
					</a>
				</div>
			</div>
		</div>

		<div class="mt-10 pt-6 border-t border-[#E5E7EB] flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-[#555555]">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Alle Rechte vorbehalten.', 'physio-wojcicki' ); ?></p>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'items_wrap'     => '<ul class="flex items-center gap-6">%3$s</ul>',
					'fallback_cb'    => false,
				)
			);
			?>
			<button id="cookie-settings-button" type="button" class="rounded-full border border-[#E5E7EB] bg-white px-4 py-2 text-xs font-semibold text-secondary transition-colors hover:text-accent" aria-controls="cookie-consent-banner" aria-expanded="true">
				<?php esc_html_e( 'Cookie-Einstellungen', 'physio-wojcicki' ); ?>
			</button>
		</div>
	</div>
</footer>

<?php $privacy_policy_url = get_privacy_policy_url(); ?>
<section id="cookie-consent-banner" class="cookie-consent-banner fixed bottom-4 z-[60] rounded-2xl border border-[#E5E7EB] bg-white p-5 shadow-2xl sm:bottom-6" role="dialog" aria-modal="false" aria-labelledby="cookie-consent-title" aria-describedby="cookie-consent-description">
	<div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
		<div>
			<h2 id="cookie-consent-title" class="font-serif text-xl font-semibold text-secondary"><?php esc_html_e( 'Datenschutzeinstellungen', 'physio-wojcicki' ); ?></h2>
			<p id="cookie-consent-description" class="mt-2 text-sm leading-6 text-[#555555]">
				<?php esc_html_e( 'Das Theme verwendet technisch notwendige Funktionen. Mit Ihrer Zustimmung werden zusätzlich Google Fonts geladen. Dabei wird Ihre IP-Adresse an Google übermittelt. Ihre Auswahl wird für bis zu 180 Tage auf diesem Gerät gespeichert.', 'physio-wojcicki' ); ?>
			<?php if ( $privacy_policy_url ) : ?>
				<a class="font-semibold text-secondary underline hover:text-accent" href="<?php echo esc_url( $privacy_policy_url ); ?>"><?php esc_html_e( 'Datenschutzerklärung', 'physio-wojcicki' ); ?></a>
			<?php endif; ?>
			</p>
		</div>
		<div class="flex shrink-0 flex-col gap-2 sm:w-48">
			<button id="cookie-consent-reject" type="button" class="rounded-full border border-secondary px-4 py-2.5 text-sm font-semibold text-secondary transition-colors hover:bg-mint"><?php esc_html_e( 'Nur notwendige', 'physio-wojcicki' ); ?></button>
			<button id="cookie-consent-accept" type="button" class="rounded-full border border-secondary bg-secondary px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-secondary-dark"><?php esc_html_e( 'Google Fonts erlauben', 'physio-wojcicki' ); ?></button>
		</div>
	</div>
</section>

<?php wp_footer(); ?>
</body>
</html>
