<?php

// страница записи

get_header();
?>





<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 

$post_categ = get_the_category();
$categ_ID = $post_categ[0]->term_id;

?>

<article class="main__post post main__elem">
	<h1 class="post__title"><?php the_title();?></h1>
	<?php if ($categ_ID == 6):?>
		<div class="post__date">
			<i class="fas fa-calendar post__calendar"></i>
			<?php the_date(); ?>
		</div>
	<?php endif; ?>
	<div class="post__content">
	<?php 
	if ($categ_ID == 3):?>
		<?php $post_img = get_the_post_thumbnail_url();?>
		<div class="post__img-wrapper">
			<img src="<?= $post_img ?>" alt="<?= $categ_ID ?>" class="post__img">
			<em class="post__img-capture">
				<p><?php the_title();?></p>
				
				<?php the_excerpt(); ?>
			</em>
		</div>
	<?php endif; ?>
		<?php the_content();?>
	</div>
	<div class="post__navigation">
		<div class="post__navigation-next">
			<?php next_post_link('%link', 'Следующий пост', true); ?>
		</div>
		<div class="post__navigation-prev">
			<?php previous_post_link('%link', 'Предыдущий пост', true); ?>
		</div>
	</div>
</article>

<?php endwhile; else : ?>
	<p>Страница в разработке!</p>
<?php endif; ?>
<?php
get_footer();
