<?php
/*
Template Name: Контакты
*/
?>

<?php get_header();?>

    <section class="main__contact contact main__elem">
        <h3 class="contact__h3"><?= CFS()->get('contact__h3') ?></h3>
        <div class="contact__block">
            <h5 class="contact__h5"><?= CFS()->get('contact__tel-text') ?></h5>
            <div class="contact__info contact__info_margin">
                <i class="fas fa-phone-alt contact__call-i" aria-hidden="true"></i>
                <?= CFS()->get('contact__tel_1') ?>
            </div>
            <div class="contact__info">
                <i class="fas fa-phone-alt contact__call-i" aria-hidden="true"></i>
                <?= CFS()->get('contact__tel_2') ?>
            </div>
        </div>
        <div class="contact__block contact__block_row">
            <div class="contact__col">
                <h5 class="contact__h5"><?= CFS()->get('contact__mail') ?></h5>
                <div class="contact__info">
                    <i class="far fa-envelope contact__mail-i" aria-hidden="true"></i>
                    <?= CFS()->get('contact__mail_val') ?>
                </div>
            </div>
            <div class="contact__col">
                <h5 class="contact__h5"><?= CFS()->get('contact__coop') ?></h5>
                <div class="contact__info">
                    <i class="far fa-envelope contact__mail-i" aria-hidden="true"></i>
                    <?= CFS()->get('contact__coop_val') ?>
                </div>
            </div>
        </div>
        <div class="contact__block">
            <h5 class="contact__h5"><?= CFS()->get('contact__adress') ?></h5>
            <div class="contact__info">
                <i class="fas fa-map-marked-alt contact__map-i" aria-hidden="true"></i>
                <?= CFS()->get('contact__adress_val') ?>
            </div>
        </div>
        <div class="contact__map">
        <iframe src="https://yandex.ru/map-widget/v1/-/CCUyaIhmWC" width="100%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
        </div>
        <div class="contact__block">
            <?= CFS()->get('contact__inn') ?>
            <br>
            <?= CFS()->get('contact__ogrn') ?>
        </div>
    </section>

<?php
get_footer();
