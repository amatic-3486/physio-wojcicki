<?php
/**
 * Employee card, shared by both team rows.
 *
 * @package Physio_Wojcicki
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$member     = $args['member'];
$role       = get_post_meta( $member->ID, '_physio_team_role', true );
$link       = get_post_meta( $member->ID, '_physio_team_link', true );
$link_label = get_post_meta( $member->ID, '_physio_team_link_label', true );
?>
<article class="team-card text-center border border-[#E5E7EB] rounded-2xl bg-white" aria-labelledby="member-<?php echo esc_attr( $member->ID ); ?>">
	<div class="team-portrait mx-auto rounded-full overflow-hidden bg-mint">
		<?php if ( has_post_thumbnail( $member ) ) : ?>
			<?php echo get_the_post_thumbnail( $member, 'physio-team-portrait', array( 'class' => 'w-full h-full object-cover', 'alt' => get_the_title( $member ), 'loading' => 'lazy', 'decoding' => 'async', 'sizes' => '(min-width: 768px) 176px, 160px' ) ); ?>
		<?php else : ?>
			<div class="team-placeholder flex flex-col items-center justify-center h-full text-secondary">
				<svg class="w-12 h-12 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 21v-2a8 8 0 0 1 16 0v2"/></svg>
				<span class="text-xs"><?php esc_html_e( 'Foto folgt', 'physio-wojcicki' ); ?></span>
			</div>
		<?php endif; ?>
	</div>
	<h2 id="member-<?php echo esc_attr( $member->ID ); ?>" class="font-serif text-xl font-semibold text-secondary mb-3"><?php echo esc_html( get_the_title( $member ) ); ?></h2>
	<?php if ( $role ) : ?>
		<p class="team-role text-sm text-[#555555]"><?php echo nl2br( esc_html( $role ) ); ?></p>
	<?php endif; ?>
	<?php if ( trim( $member->post_content ) ) : ?>
		<div class="team-bio text-sm text-[#555555] mt-4"><?php echo apply_filters( 'the_content', $member->post_content ); ?></div>
	<?php endif; ?>
	<?php if ( $link && $link_label ) : ?>
		<a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer" class="team-link inline-flex items-center justify-center text-sm font-semibold mt-4"><?php echo esc_html( $link_label ); ?> <span aria-hidden="true">&nbsp;↗</span></a>
	<?php endif; ?>
</article>