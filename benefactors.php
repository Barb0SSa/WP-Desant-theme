<?php
/*
Template Name: Благотворители
*/
?>

<?php get_header(); ?>

<section class="main__partners partners main__elem">
    
    <?php 
        $loop = CFS()->get('ben-card');
        foreach ($loop as $row) {
            ?>
            <div class="partners__item">
                <img src="<?= $row['ben-card__img'] ?>" alt="<?= $row['ben-card__name']?>" class="partners__img">
            </div>
            <?php
        }
    ?>
</section>
<section class="main__donate donate main__elem">
    <div class="donate__thanks">
        <?= CFS()->get('benefactors__help_top') ?>
        <br>
        <?= CFS()->get('benefactors__help_bottom') ?>
    </div>
    <div class="donate__btn-section">
        <a href="#" class="donate__btn">
            <?= CFS()->get('benefactors__donate') ?>
        </a>
    </div>
</section>
<section class="main__payment main__elem">
    <img src="https://example.barbossa.su/desant/wp-content/uploads/2021/12/payment.png" alt="Payment" class="main__payment-img">
</section>
<section class="main__pay-info main__elem">
    <?= CFS()->get('benefactors__donate-info') ?>
</section>

<?php get_footer();?>