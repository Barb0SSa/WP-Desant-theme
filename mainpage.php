<?php
/*
Template Name: Главная страница

*/
?>
<?php get_header(); ?>

<!-- CFS -->
<?php 

$benefactors__help_top = CFS()->get('benefactors__help_top');
$benefactors__help_bottom = CFS()->get('benefactors__help_bottom');
$benefactors__donate = CFS()->get('benefactors__donate');

?>

<section class="main__present present main__elem-full">
    <img src="https://example.barbossa.su/desant/wp-content/uploads/2021/11/компромисс-16к9.5-1443х768.jpg" alt="" class="present__img">
    <p class="present__quote">«Друг не бывает вдруг, если дружба зародилась на поле брани и скреплена потом и кровью.» — гласит известная русская поговорка. Мы учредители Благотворительного фонда, ветераны ВДВ и подразделений военной разведки ВС РФ, создали этот фонд во имя памяти боевых товарищей; во имя тех, кто сегодня на боевом посту защищает наш покой; во имя мирного будущего наших детей и во имя процветания нашей любимой Родины.</p>
</section>
<section class="main__elem-full main__purpose_full">
    <div class="main__purpose purpose main__elem">
        <div class="purpose__container">
            <div class="purpose__card card">
                <div class="card__icon-wrapper">
                    <i class="fas fa-medal"></i>
                </div>
                <h4 class="card__title">Традиции</h4>
                <p class="card__text">Деятельность, направленная на сохранение и развитие патриотических традиций Российского государства и его Вооруженных сил</p>
            </div>
            <div class="purpose__card card">
                <div class="card__icon-wrapper">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h4 class="card__title">Поддержка ветеранов</h4>
                <p class="card__text">Поддержка ветеранов, военнослужащих ВДВ и подразделений военной разведки ВС РФ и членов их семей, оказавшихся в сложной жизненной ситуации</p>
            </div>
            <div class="purpose__card card">
                <div class="card__icon-wrapper">
                    <i class="fas fa-photo-video"></i>
                </div>
                <h4 class="card__title">Мероприятия</h4>
                <p class="card__text">Деятельность, направленная на оказание помощи командованию ВДВ в проведении военно-патриотических мероприятий</p>
            </div>
        </div>
    </div>
</section>
<?php
	$wp_query = new WP_Query( array(
	    'post_type' => 'post',
	    'posts_per_page' => 1,
	    'cat' => 5,
	));
?>
<section class="main__links links main__elem">
    <article class="links_card lcard">
        <h4 class="lcard__title">История ВДВ</h4>
        <div class="lcard__img-wrapper">
            <?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
            <?php $imghist = get_the_post_thumbnail_url(); ?>
            <img src="<?= $imghist ?>" alt="history" class="lcard__img">
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <a href="http://desant/historyvdv/" class="lcard__btn readmore">Перейти</a>
    </article>



    <article class="links_card lcard">
        <h4 class="lcard__title">Новости</h4>
        <div class="lcard__img-wrapper">
            <?php
                $wp_query = new WP_Query( array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                    'cat' => '1, 6',
                ));
            ?>
            <?php
            $imgUrl = 'https://example.barbossa.su/desant/wp-content/uploads/2021/11/компромисс-16к9.5-1443х768.jpg';
            $checkPhoto = false;
            while(have_posts() && !$checkPhoto) {
                the_post();
                $imgnews = get_the_post_thumbnail_url( $post->ID);
                if ($img) {
                    $imgObj = getimagesize($imgnews);
                    $imgWidth = $imgObj[0];
                    $imgHeight = $imgObj[1];
                    if ($imgHeight / $imgWidth < 0.54) {
                        continue;
                    } else {
                        $checkPhoto = true;
                        $imgUrl = get_the_post_thumbnail_url( $post->ID);
                    }
                }
            } 	
            ?>
            <img src="<?= $imgUrl ?>" alt="contact" class="lcard__img">
        </div>
        <a href="http://desant/news/" class="lcard__btn readmore">Перейти</a>
    </article>
    <article class="links_card lcard">
        <h4 class="lcard__title">Контакты</h4>
        <div class="lcard__img-wrapper">
            <img src="https://example.barbossa.su/desant/wp-content/uploads/2021/12/mapa.png" alt="contact" class="lcard__img">
        </div>
        <a href="http://desant/contacts/" class="lcard__btn readmore">Перейти</a>
    </article>
</section>
<section class="main__donate_full main__elem-full">
    <div class="main__donate donate main__elem">
        <div class="donate__thanks">
            <?= $benefactors__help_top ?>
            <br>
            <?= $benefactors__help_bottom ?>
        </div>
        <div class="donate__btn-section">
            <a href="#" class="donate__btn">
                <?= $benefactors__donate ?>
            </a>
        </div>
    </div>
</section>



<?php get_footer(); ?>