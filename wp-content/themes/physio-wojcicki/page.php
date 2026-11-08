<?php
/**
 * The template for displaying all pages.
 *
 * @package Physio_Wojcicki
 */

get_header();
?>

<section class="bg-white">
	<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<header class="mb-8">
				<h1 class="font-serif text-4xl font-semibold text-secondary leading-[1.15]"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content max-w-none text-[#222222]">
				<?php the_content(); ?>
			</div>

			<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile;
		?>
	</div>
</section>

<?php
get_footer();
