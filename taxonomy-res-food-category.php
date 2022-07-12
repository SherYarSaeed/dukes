<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Restaurant_FWD
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>


			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->


		<div class="button-group filter-button-group">
			<button data-filter="*">Show All</button>
			<?php
				$terms = get_terms( array(
					'taxonomy' => 'res-food-category',
					'parent'   => get_queried_object()->term_id,
					'hide_empty' => false,
				));
				foreach($terms as $term) {
					echo '<button data-filter=".'.$term->slug.'">'.$term->name.'</button>';
				}
			?>
							
 
	<?php  ?>
				<article class="grid-item '.isotope_vendor_classes(get_the_id()).">
				<h2><?php the_title(); ?></h2>
				
				<?php 
					if (function_exists('get_field') ) {
						if ( get_field( 'food_description' ) ) {
							?>
							<section class= "food-description">
								<p><?php the_field( 'food_description' );?> </p>
							</section> 
							<?php
						}
						if ( get_field( 'food_price' ) ) {
							?>
							<section class= "food-price">
								<p> <?php the_field( 'food_price' ); ?> </p>
							</section> 
							<?php
						}
						if ( get_field( 'food_flavour' ) ) {
							?>
							<section class= "food-flavour">
								<?php 
									$flavors = get_field('food_flavour');
									if ($flavors) :
									?>
									<ul>
										<?php foreach( $flavors as $flavor) : ?>
											<li><?php echo $flavor; ?></li>
											<?php endforeach; ?>
									</ul>
									<?php endif; ?>
							</section> 
							<?php
						}
					}



				?>
</div>
		<?php  
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
