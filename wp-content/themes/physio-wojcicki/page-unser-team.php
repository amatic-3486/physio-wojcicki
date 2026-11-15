<?php
/**
 * Template Name: Unser Team
 *
 * @package Physio_Wojcicki
 */

get_header();
the_post();

$team_page_id = get_the_ID();
$members      = get_posts(
	array(
		'post_type'      => 'physio_team',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
	)
);
$groups = array( 'featured' => array(), 'regular' => array() );
foreach ( $members as $member ) {
	$group = get_post_meta( $member->ID, '_physio_team_featured', true ) ? 'featured' : 'regular';
	$groups[ $group ][] = $member;
}
?>

<section class="page-hero relative bg-cream overflow-hidden" aria-labelledby="team-title">
	<div class="page-hero__content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="page-hero__copy flex flex-col justify-center py-12 sm:py-16 lg:py-16">
			<?php if ( has_excerpt() ) : ?>
				<p class="text-accent-dark text-xs sm:text-sm font-semibold tracking-[0.1em] uppercase mb-4"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
			<h1 id="team-title" class="font-serif text-4xl sm:text-5xl font-bold text-secondary leading-[1.15] mb-4"><?php the_title(); ?></h1>
			<div class="team-intro text-[#555555] max-w-md"><?php the_content(); ?></div>
			<a href="<?php echo esc_url( home_url( '/kontakt/#kontaktformular' ) ); ?>" class="self-start inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-full transition-colors mt-6">
				<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
				</svg>
				<?php esc_html_e( 'Termin vereinbaren', 'physio-wojcicki' ); ?>
				<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
				</svg>
			</a>
		</div>
	</div>
	<div class="page-hero__image relative min-h-[320px]">
		<?php if ( has_post_thumbnail( $team_page_id ) ) : ?>
			<?php echo get_the_post_thumbnail( $team_page_id, 'full', array( 'class' => 'absolute inset-0 w-full h-full object-cover', 'fetchpriority' => 'high', 'decoding' => 'async' ) ); ?>
		<?php else : ?>
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/hero-reception-wide.jpeg' ); ?>" alt="<?php esc_attr_e( 'Empfang der Physiotherapiepraxis Wojcicki', 'physio-wojcicki' ); ?>" class="absolute inset-0 w-full h-full object-cover" fetchpriority="high" decoding="async">
		<?php endif; ?>
	</div>
</section>

<section class="team-section bg-white" aria-label="<?php esc_attr_e( 'Unsere Mitarbeiterinnen und Mitarbeiter', 'physio-wojcicki' ); ?>">
	<div class="team-container mx-auto px-4 sm:px-6 lg:px-8">
		<?php foreach ( $groups as $group => $group_members ) : ?>
			<?php if ( $group_members ) : ?>
				<div class="team-grid <?php echo 'featured' === $group ? 'team-grid--featured grid grid-cols-1 md:grid-cols-2' : 'grid grid-cols-1 md:grid-cols-3'; ?>">
					<?php foreach ( $group_members as $member ) : ?>
						<?php get_template_part( 'template-parts/team-card', null, array( 'member' => $member ) ); ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php if ( ! $members ) : ?>
			<p class="text-center text-[#555555]"><?php esc_html_e( 'Hier stellen wir Ihnen bald unser Team vor.', 'physio-wojcicki' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>