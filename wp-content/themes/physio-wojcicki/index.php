<?php
/**
 * The main template file.
 *
 * @package Physio_Wojcicki
 */

get_header();
?>

<section class="bg-white">
	<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'mb-12 pb-12 border-b border-[#E5E7EB] last:border-0' ); ?>>
					<header class="mb-4">
						<h2 class="font-serif text-2xl font-semibold text-secondary">
							<a href="<?php the_permalink(); ?>" class="hover:text-accent transition-colors"><?php the_title(); ?></a>
						</h2>
					</header>

					<div class="text-[#555555]">
						<?php the_excerpt(); ?>
					</div>
				</article>
				<?php
			endwhile;

			the_posts_navigation();
		else :
			?>
			<p><?php esc_html_e( 'Keine Inhalte gefunden.', 'physio-wojcicki' ); ?></p>
			<?php
		endif;
		?>
	</div>
</section>

<?php
get_footer();
