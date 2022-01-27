<?php
/*
Template Name: Герои
*/
?>
<?php get_header(); ?>

<?php
	$wp_query = new WP_Query( array(
	  'post_type' => 'post',
	  'posts_per_page' => -1,
	  'cat' => 3,
	));
?>
	
<section class="main__heroes heroes main__elem">
    <h1 class="heroes__h1">Воины-десантники — Герои Советского Союза и Российской Федерации</h1>
    <p class="heroes__info">За всю историю ВДВ звания Героя CCCР были удостоены 373 десантника и 113 десантников были удостоены звания Герой России.</p>
    <section class="heroes__list">
        
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

			<article class="heroes__hero hero">
            	<div class="hero__img-wrapper">
					<?php $img = get_the_post_thumbnail_url(); ?>
					<img src="<?= $img; ?>" alt="hero" class="hero__img">
            	</div>
				<div class="hero__info">
                	<h6 class="hero__name"><?php the_title(); ?></h6>
                	<p class="hero__description">
                    	<?php the_excerpt();?>
                	</p>
                <a href="<?php the_permalink();?>" class="hero__readmore readmore">Читать</a>
            	</div>
			</article>
		
			<?php endwhile; ?>
 
		<?php endif; ?>
		
    </section>
</section>
<?php wp_reset_query(); ?>
	
<?php get_footer(); ?>   