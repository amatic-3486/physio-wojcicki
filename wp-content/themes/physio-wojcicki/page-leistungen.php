<?php
/**
 * The template for the "Leistungen" page.
 *
 * Intro text: page excerpt/content in the backend. Cards are defined below.
 *
 * @package Physio_Wojcicki
 */

get_header();

$img = get_template_directory_uri() . '/assets/img/';

$services = array(
	array(
		'title' => 'Physiotherapie',
		'text'  => 'Gezielte Behandlung zur Schmerzlinderung, Verbesserung der Beweglichkeit und Wiederherstellung Ihrer körperlichen Funktion.',
		'img'   => 'gallery-behandlungsraum.jpeg',
		'bg'    => 'bg-accent/10',
		'color' => 'text-accent',
		'path'  => 'M13.5 4.5 11 9l3 1-1.5 7.5L9 13l-3 1 2.5-7L6 6l4-1 1.5 2 2-2.5Z',
	),
	array(
		'title' => 'Manuelle Therapie',
		'text'  => 'Spezielle, sanfte Techniken zur Mobilisation von Gelenken, Muskeln und Nerven – bei akuten und chronischen Beschwerden.',
		'img'   => 'gallery-individuell.jpeg',
		'bg'    => 'bg-mint',
		'color' => 'text-secondary',
		'path'  => 'M12 3v2.25M12 18.75V21M5.636 5.636l1.591 1.591M16.773 16.773l1.591 1.591M3 12h2.25M18.75 12H21M5.636 18.364l1.591-1.591M16.773 7.227l1.591-1.591',
	),
	array(
		'title' => 'Manuelle Lymphdrainage',
		'text'  => 'Eine besonders sanfte Methode, die den Lymphabfluss anregt, Schwellungen reduziert und das Gewebe entlastet.',
		'img'   => 'hero-reception.jpeg',
		'bg'    => 'bg-accent/10',
		'color' => 'text-accent',
		'path'  => 'M3 12c2-3 4-3 6 0s4 3 6 0 4-3 6 0M3 17c2-3 4-3 6 0s4 3 6 0 4-3 6 0',
	),
	array(
		'title' => 'Osteopathie',
		'text'  => 'Eine ganzheitliche Behandlung, die Funktionsstörungen im Körper erkennt und behandelt – für mehr Balance, Beweglichkeit und Wohlbefinden.',
		'img'   => 'gallery-praxis-aussen.jpeg',
		'bg'    => 'bg-mint',
		'color' => 'text-secondary',
		'path'  => 'M12 21c-4.97-3.5-9-7-9-11a5 5 0 0 1 9-3 5 5 0 0 1 9 3c0 4-4.03 7.5-9 11Z',
	),
	array(
		'title' => 'Trainingstherapie',
		'text'  => 'Individuelles, therapeutisch begleitetes Training zur Stärkung von Muskulatur, Stabilität und Ausdauer – für mehr Belastbarkeit im Alltag.',
		'img'   => 'gallery-aktiv.jpeg',
		'bg'    => 'bg-accent/10',
		'color' => 'text-accent',
		'path'  => 'M4.5 12h2.25m0 0V9.75m0 2.25V14.25M17.25 12h2.25M6.75 12h10.5M9 8.25v7.5M15 8.25v7.5',
	),
);
?>

<section class="bg-cream overflow-hidden">
	<div class="max-w-7xl mx-auto grid lg:grid-cols-2 items-stretch">
		<div class="px-4 sm:px-6 lg:px-8 py-12 lg:py-16 flex flex-col justify-center">
			<p class="text-accent text-xs sm:text-sm font-semibold tracking-[0.1em] uppercase mb-4"><?php esc_html_e( 'Unsere Leistungen', 'physio-wojcicki' ); ?></p>
			<h1 class="font-serif text-4xl sm:text-5xl font-bold text-secondary leading-[1.15] mb-4">
				<?php esc_html_e( 'Gezielte Therapien für Ihre Gesundheit.', 'physio-wojcicki' ); ?>
			</h1>
			<div class="leistungen-intro text-[#555555] max-w-md">
				<?php
				if ( have_posts() ) {
					the_post();
					$content = trim( wp_strip_all_tags( get_the_content() ) );
					if ( '' !== $content ) {
						the_content();
					} else {
						echo '<p>' . esc_html__( 'Ein vielfältiges Behandlungsangebot – individuell auf Ihre Bedürfnisse abgestimmt.', 'physio-wojcicki' ) . '</p>';
					}
				}
				?>
			</div>
		</div>
		<div class="relative min-h-[240px] lg:min-h-[320px]">
			<img src="<?php echo esc_url( $img . 'gallery-behandlungsraum.jpeg' ); ?>" alt="<?php esc_attr_e( 'Behandlungsraum mit Therapieliege', 'physio-wojcicki' ); ?>" class="absolute inset-0 w-full h-full object-cover">
		</div>
	</div>
</section>

<section class="bg-white">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-5">
			<?php foreach ( $services as $i => $s ) : ?>
				<article class="lg:col-span-<?php echo $i < 3 ? '2' : '3'; ?> flex flex-col sm:flex-row gap-5 bg-white border border-[#E5E7EB] rounded-2xl p-4 shadow-sm">
					<img src="<?php echo esc_url( $img . $s['img'] ); ?>" alt="" class="w-full sm:w-40 h-48 sm:h-auto object-cover rounded-xl shrink-0">
					<div class="flex flex-col items-start">
						<span class="w-12 h-12 rounded-full <?php echo esc_attr( $s['bg'] . ' ' . $s['color'] ); ?> flex items-center justify-center mb-3">
							<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="<?php echo esc_attr( $s['path'] ); ?>" />
							</svg>
						</span>
						<h2 class="font-serif text-xl font-semibold text-secondary leading-tight mb-2"><?php echo esc_html( $s['title'] ); ?></h2>
						<p class="text-sm text-[#555555] mb-4"><?php echo esc_html( $s['text'] ); ?></p>
						<a href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>" class="mt-auto inline-flex items-center gap-2 border border-accent text-accent hover:bg-accent hover:text-white text-sm font-semibold px-4 py-2 rounded-full transition-colors" aria-label="<?php echo esc_attr( 'Mehr erfahren: ' . $s['title'] ); ?>">
							<?php esc_html_e( 'Mehr erfahren', 'physio-wojcicki' ); ?>
							<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
							</svg>
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="mt-8 bg-mint rounded-2xl px-6 py-6 flex flex-col md:flex-row items-center gap-6">
			<svg class="w-12 h-12 text-accent shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-7.5-4.6-9.6-9.2C1 8.6 2.4 5.4 5.4 4.6 7.6 4 9.8 4.9 12 7c2.2-2.1 4.4-3 6.6-2.4 3 .8 4.4 4 3 6.2C19.5 16.4 12 21 12 21Z" />
			</svg>
			<div class="text-center md:text-left md:flex-1">
				<h2 class="font-serif text-xl font-semibold text-secondary"><?php esc_html_e( 'Individuelle Beratung', 'physio-wojcicki' ); ?></h2>
				<p class="text-[#555555] text-sm"><?php esc_html_e( 'Gerne besprechen wir mit Ihnen, welche Behandlung für Ihre Beschwerden und Ziele am besten geeignet ist.', 'physio-wojcicki' ); ?></p>
			</div>
			<a href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>" class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-full transition-colors">
				<?php esc_html_e( 'Jetzt Termin vereinbaren', 'physio-wojcicki' ); ?>
			</a>
		</div>
	</div>
</section>

<?php
get_footer();
