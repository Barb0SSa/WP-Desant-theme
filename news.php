<?php
/*
Template Name: Новости
*/
?>
<?php get_header(); ?>

<?php
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$query = new WP_Query( array(
	  'post_type'           => 'post',
	  'posts_per_page'      => 3,
	  'cat'                 => '6',
      'paged'               => $paged
	));
?>
	
<section class="main__news news main__elem">
        
		<?php if ( $query->have_posts() ) : ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>

			<article class="news__post">
                <div class="news__img-wrapper">
                    <?php $img = get_the_post_thumbnail_url(); ?>
                    <?php if (!$img) {
                        $img = 'https://example.barbossa.su/desant/wp-content/uploads/2021/11/gerb1.png';
                    }?>
                    <img src="<?= $img ?>" alt="" class="news__img">
                </div>
                <h6 class="news__title">
                    <a href="<?php the_permalink();?>" class="news__link">
                        <?php the_title();?>
                    </a>
                </h6>
                <?php the_excerpt();?>
                <p class="news__date"><?php the_date(); ?></p>
                <a href="<?php the_permalink();?>" class="news__read readmore">Читать</a>
            </article>
		
			<?php endwhile; ?>
 
		<?php endif; ?>
    </section>
    <section class="main__pagination main__elem">
    <!-- pagination -->
	<?php kama_pagenavi($before = '', $after = '', $echo = true, $args = array(), $wp_query = $query); // пагинация, функция нах-ся в function.php ?>
    <!-- /pagination  -->
    </section>


	
<?php get_footer(); ?>   