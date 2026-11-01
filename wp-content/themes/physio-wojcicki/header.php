<?php
/**
 * The header for our theme.
 *
 * @package Physio_Wojcicki
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-white text-[#222222] antialiased' ); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Zum Inhalt springen', 'physio-wojcicki' ); ?></a>

<header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-[#E5E7EB]">
	<nav class="max-w-7xl mx-auto flex items-center justify-between gap-4 px-4 sm:px-6 lg:px-8 py-4" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'physio-wojcicki' ); ?>">

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 shrink-0">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-12 w-auto">
			<?php endif; ?>
		</a>

		<div class="hidden lg:flex items-center gap-8">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '<ul class="flex items-center gap-8 text-sm font-medium">%3$s</ul>',
					'fallback_cb'    => 'physio_wojcicki_fallback_menu',
				)
			);
			?>
		</div>

		<div class="hidden lg:flex items-center gap-6">
			<a href="<?php echo esc_url( physio_wojcicki_contact( 'phone_href' ) ); ?>" class="flex items-center gap-2 text-secondary font-semibold hover:text-accent transition-colors">
				<svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97a1.125 1.125 0 0 0 .417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
				</svg>
				<?php echo esc_html( physio_wojcicki_contact( 'phone' ) ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>" class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-colors">
				<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008Z" />
				</svg>
				<?php esc_html_e( 'Termin anfragen', 'physio-wojcicki' ); ?>
			</a>
		</div>

		<button id="menu-toggle" type="button" class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-secondary hover:text-accent" aria-controls="mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Menü öffnen', 'physio-wojcicki' ); ?>">
			<svg id="icon-open" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
			</svg>
			<svg id="icon-close" class="w-7 h-7 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
			</svg>
		</button>
	</nav>

	<div id="mobile-menu" class="lg:hidden overflow-hidden max-h-0 border-t border-[#E5E7EB]">
		<div class="px-4 sm:px-6 py-4 space-y-4">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '<ul class="flex flex-col gap-3 text-base font-medium">%3$s</ul>',
					'fallback_cb'    => 'physio_wojcicki_fallback_menu',
				)
			);
			?>
			<div class="pt-4 border-t border-[#E5E7EB] flex flex-col gap-3">
				<a href="<?php echo esc_url( physio_wojcicki_contact( 'phone_href' ) ); ?>" class="flex items-center gap-2 text-secondary font-semibold">
					<svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97a1.125 1.125 0 0 0 .417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
					</svg>
					<?php echo esc_html( physio_wojcicki_contact( 'phone' ) ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>" class="inline-flex items-center justify-center gap-2 bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-5 py-3 rounded-full transition-colors">
					<?php esc_html_e( 'Termin anfragen', 'physio-wojcicki' ); ?>
				</a>
			</div>
		</div>
	</div>
</header>

<main id="main">
