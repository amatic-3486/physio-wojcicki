<?php
/**
 * The template for displaying the home page.
 *
 * @package Physio_Wojcicki
 */

get_header();

$img = get_template_directory_uri() . '/assets/img/';
?>

<!-- Hero Section -->
<section class="relative bg-cream overflow-hidden">
	<div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 items-stretch">

		<div class="px-4 sm:px-6 lg:px-8 py-16 lg:py-24 flex flex-col justify-center">
			<p class="text-accent text-xs sm:text-sm font-semibold tracking-[0.1em] uppercase mb-4">
				<?php esc_html_e( 'Bewegung &middot; Gesundheit &middot; Lebensqualität', 'physio-wojcicki' ); ?>
			</p>
			<h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-secondary leading-[1.15] mb-4">
				<?php esc_html_e( 'Gemeinsam in Bewegung.', 'physio-wojcicki' ); ?>
			</h1>
			<p class="font-serif text-2xl sm:text-3xl text-secondary mb-6">
				<?php esc_html_e( 'Ihre Physiotherapiepraxis in Neustadt am Rübenberge.', 'physio-wojcicki' ); ?>
			</p>
			<p class="text-[#555555] max-w-md mb-8">
				<?php esc_html_e( 'Wir begleiten Sie auf dem Weg zu mehr Beweglichkeit, weniger Schmerzen und einem aktiven Leben – mit Erfahrung, Fachkompetenz und Zeit für Sie.', 'physio-wojcicki' ); ?>
			</p>
			<div class="flex flex-wrap items-center gap-4">
				<a href="#kontakt" class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-full transition-colors">
					<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008Z" />
					</svg>
					<?php esc_html_e( 'Termin vereinbaren', 'physio-wojcicki' ); ?>
					<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
					</svg>
				</a>
				<a href="<?php echo esc_url( physio_wojcicki_contact( 'phone_href' ) ); ?>" class="inline-flex items-center gap-2 border border-secondary/30 hover:border-accent hover:text-accent text-secondary font-semibold px-6 py-3.5 rounded-full transition-colors">
					<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97a1.125 1.125 0 0 0 .417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
					</svg>
					<?php echo esc_html( physio_wojcicki_contact( 'phone' ) ); ?>
				</a>
			</div>
		</div>

		<div class="relative min-h-[320px] lg:min-h-0">
			<img src="<?php echo esc_url( $img . 'hero-reception.jpeg' ); ?>" alt="<?php esc_attr_e( 'Empfang der Physiotherapiepraxis Wojcicki', 'physio-wojcicki' ); ?>" class="absolute inset-0 w-full h-full object-cover">

			<div class="hero-badge font-script text-lg sm:text-xl text-accent bg-white rounded-full w-32 h-32 sm:w-36 sm:h-36 flex items-center justify-center text-center p-4 absolute bottom-6 right-6 rotate-[-6deg] leading-tight">
				<?php esc_html_e( 'Gesundheit in guten Händen.', 'physio-wojcicki' ); ?>
			</div>
		</div>
	</div>
</section>

<!-- Services Section -->
<section id="leistungen" class="bg-mint">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
		<div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
			<div>
				<p class="text-accent text-xs sm:text-sm font-semibold tracking-[0.1em] uppercase mb-3"><?php esc_html_e( 'Unsere Leistungen', 'physio-wojcicki' ); ?></p>
				<h2 class="font-serif text-3xl sm:text-4xl font-semibold text-secondary leading-[1.15]"><?php esc_html_e( 'Gezielte Therapie für mehr Lebensqualität.', 'physio-wojcicki' ); ?></h2>
			</div>
			<p class="text-[#555555] max-w-md"><?php esc_html_e( 'Wir bieten Ihnen ein breites Spektrum an bewährten physiotherapeutischen Methoden – individuell auf Ihre Bedürfnisse abgestimmt.', 'physio-wojcicki' ); ?></p>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-5">
			<?php
			$services = array(
				array(
					'title' => 'Physiotherapie',
					'text'  => 'Individuelle Behandlung für mehr Beweglichkeit und weniger Schmerzen.',
					'bg'    => 'bg-accent/10',
					'color' => 'text-accent',
					'path'  => 'M13.5 4.5 11 9l3 1-1.5 7.5L9 13l-3 1 2.5-7L6 6l4-1 1.5 2 2-2.5Z',
				),
				array(
					'title' => 'Manuelle Therapie',
					'text'  => 'Gezielte, sanfte Techniken bei Funktionsstörungen und Beschwerden.',
					'bg'    => 'bg-mint',
					'color' => 'text-secondary',
					'path'  => 'M12 3v2.25M12 18.75V21M5.636 5.636l1.591 1.591M16.773 16.773l1.591 1.591M3 12h2.25M18.75 12H21M5.636 18.364l1.591-1.591M16.773 7.227l1.591-1.591',
				),
				array(
					'title' => 'Manuelle Lymphdrainage',
					'text'  => 'Unterstützt den Abfluss, reduziert Schwellungen und fördert das Wohlbefinden.',
					'bg'    => 'bg-accent/10',
					'color' => 'text-accent',
					'path'  => 'M3 12c2-3 4-3 6 0s4 3 6 0 4-3 6 0M3 17c2-3 4-3 6 0s4 3 6 0 4-3 6 0',
				),
				array(
					'title' => 'Osteopathische Medizin',
					'text'  => 'Ganzheitliche Betrachtung des Bewegungsapparates.',
					'bg'    => 'bg-mint',
					'color' => 'text-secondary',
					'path'  => 'M12 21c-4.97-3.5-9-7-9-11a5 5 0 0 1 9-3 5 5 0 0 1 9 3c0 4-4.03 7.5-9 11Z',
				),
				array(
					'title' => 'Trainingstherapie',
					'text'  => 'Individuell, sicher und wirkungsvoll.',
					'bg'    => 'bg-accent/10',
					'color' => 'text-accent',
					'path'  => 'M4.5 12h2.25m0 0V9.75m0 2.25V14.25M17.25 12h2.25M6.75 12h10.5M9 8.25v7.5M15 8.25v7.5',
				),
			);

			foreach ( $services as $service ) :
				?>
				<div class="bg-white rounded-2xl p-6 text-center flex flex-col items-center shadow-sm border border-[#E5E7EB]">
					<div class="w-16 h-16 rounded-full <?php echo esc_attr( $service['bg'] ); ?> flex items-center justify-center mb-5">
						<svg class="w-7 h-7 <?php echo esc_attr( $service['color'] ); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="<?php echo esc_attr( $service['path'] ); ?>" />
						</svg>
					</div>
					<h3 class="font-serif text-lg font-semibold text-secondary mb-2"><?php echo esc_html( $service['title'] ); ?></h3>
					<p class="text-sm text-[#555555] mb-5"><?php echo esc_html( $service['text'] ); ?></p>
					<a href="#kontakt" class="mt-auto w-9 h-9 rounded-full border border-accent/40 flex items-center justify-center text-accent hover:bg-accent hover:text-white transition-colors" aria-label="<?php echo esc_attr( sprintf( __( 'Mehr über %s erfahren', 'physio-wojcicki' ), $service['title'] ) ); ?>">
						<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
						</svg>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Gallery Section -->
<section id="praxis" class="bg-white relative">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
		<div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
			<div>
				<p class="text-accent text-xs sm:text-sm font-semibold tracking-[0.1em] uppercase mb-3"><?php esc_html_e( 'Unsere Praxis', 'physio-wojcicki' ); ?></p>
				<h2 class="font-serif text-3xl sm:text-4xl font-semibold text-secondary leading-[1.15]"><?php esc_html_e( 'Helle und freundliche Räume für Ihre Gesundheit.', 'physio-wojcicki' ); ?></h2>
			</div>
			<div class="max-w-md">
				<p class="text-[#555555] mb-4"><?php esc_html_e( 'In unserer Praxis in Neustadt am Rübenberge erwarten Sie moderne Behandlungsräume und ein Trainingsbereich mit aktuellen Geräten – für eine angenehme und effektive Therapie in ruhiger Atmosphäre.', 'physio-wojcicki' ); ?></p>
				<a href="#kontakt" class="inline-flex items-center gap-2 border border-accent text-accent hover:bg-accent hover:text-white font-semibold px-5 py-2.5 rounded-full transition-colors">
					<?php esc_html_e( 'Unsere Praxis entdecken', 'physio-wojcicki' ); ?>
					<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
					</svg>
				</a>
			</div>
		</div>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
			<?php
			$gallery = array(
				array(
					'src' => 'gallery-behandlungsraum.jpeg',
					'alt' => 'Behandlungsraum mit Therapieliege',
					'label' => 'Unsere Behandlungsräume',
				),
				array(
					'src' => 'gallery-aktiv.jpeg',
					'alt' => 'Trainingsbereich mit Sprossenwand',
					'label' => 'Aktiv und beweglich bleiben',
				),
				array(
					'src' => 'gallery-individuell.jpeg',
					'alt' => 'Heller Behandlungsraum mit Therapieliege',
					'label' => 'Individuelle Therapie',
				),
				array(
					'src' => 'gallery-praxis-aussen.jpeg',
					'alt' => 'Außenansicht der Praxis Wojcicki',
					'label' => 'So finden Sie uns',
				),
			);

			foreach ( $gallery as $item ) :
				?>
				<figure class="relative rounded-lg overflow-hidden aspect-[3/4] group">
					<img src="<?php echo esc_url( $img . $item['src'] ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
					<figcaption class="absolute inset-x-3 bottom-3 bg-white/90 backdrop-blur text-secondary text-sm font-semibold text-center py-2 px-3 rounded-md">
						<?php echo esc_html( $item['label'] ); ?>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- USPs Bar -->
<section class="bg-mint">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
		<h2 class="font-serif text-2xl sm:text-3xl font-semibold text-secondary text-center lg:text-left mb-8">
			<?php esc_html_e( 'Ihr Weg zu mehr Lebensqualität.', 'physio-wojcicki' ); ?>
		</h2>
		<div class="flex flex-col sm:flex-row flex-wrap items-center justify-between gap-8">
			<?php
			$usps = array(
				array(
					'text' => 'Individuelle Behandlung',
					'path' => 'M12 21s-7.5-4.6-9.6-9.2C1 8.6 2.4 5.4 5.4 4.6 7.6 4 9.8 4.9 12 7c2.2-2.1 4.4-3 6.6-2.4 3 .8 4.4 4 3 6.2C19.5 16.4 12 21 12 21Z',
				),
				array(
					'text' => 'Zeit für Ihre Anliegen',
					'path' => 'M16.5 18.75a4.5 4.5 0 1 0-9 0M12 11.25a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM19.5 18.75a3.75 3.75 0 0 0-3-3.675M4.5 18.75a3.75 3.75 0 0 1 3-3.675M17.25 7.5a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0ZM11.25 7.5a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z',
				),
				array(
					'text' => 'Moderne und freundliche Praxisräume',
					'path' => 'M12 2c4 3 7 7 7 11a7 7 0 0 1-14 0c0-4 3-8 7-11Z',
				),
				array(
					'text' => 'Barrierefreier Zugang und Parkplätze',
					'path' => 'M8.25 18.75a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM18.75 18.75a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM3.75 15h15l-1.5-6h-12l-1.5 6ZM5.25 9l1.5-3h10.5l1.5 3',
				),
				array(
					'text' => 'Zentrale Lage mit Bushaltestelle direkt vor der Praxis',
					'path' => 'M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z',
				),
			);

			foreach ( $usps as $usp ) :
				?>
				<div class="flex items-center gap-3 max-w-[220px] text-center sm:text-left flex-col sm:flex-row">
					<div class="w-11 h-11 shrink-0 rounded-full bg-accent text-white flex items-center justify-center">
						<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="<?php echo esc_attr( $usp['path'] ); ?>" />
						</svg>
					</div>
					<p class="text-sm font-medium text-secondary"><?php echo esc_html( $usp['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_footer();
