<?php
/*
Template Name: История ВДВ
*/
?>
<?php get_header(); ?>

<?php
	$wp_query = new WP_Query( array(
	    'post_type' => 'post',
	    'posts_per_page' => -1,
	    'cat' => 5,
	));
?>
	
<section class="main__news news main__elem">
        
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

			<article class="news__post">
                <div class="news__img-wrapper">
                    <?php $img = get_the_post_thumbnail_url(); ?>
                    <img src="<?= $img ?>" alt="" class="news__img">
                </div>
                <h6 class="news__title">
                    <a href="<?php the_permalink();?>" class="news__link">
                        <?php the_title();?>
                    </a>
                </h6>
                <?php the_excerpt();?>
                <a href="<?php the_permalink();?>" class="news__read readmore">Читать</a>
            </article>
		
			<?php endwhile; ?>
 
		<?php endif; ?>
		
</section>
<?php wp_reset_query(); ?>
	
<?php get_footer(); ?>   