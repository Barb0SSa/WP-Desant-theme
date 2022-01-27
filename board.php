<?php
/*
Template Name: Попечительский совет

*/
?>
<?php get_header(); ?>

<section class="main__board board main__elem">

    <?php
        $loop = CFS()->get('board__card');
        foreach ($loop as $row) {
            ?>
            <article class="board__member member">
                <div class="member__img-wrapper">
                    <img src="<?= $row['board__img']?>" alt="<?= $row['board__name']?>" class="member__img">
                </div>
                <div class="member__description">
                    <h3 class="member__name"><?= $row['board__name'] ?></h3>
                    <p class="member__info"><?= $row['board__info'] ?></p>
                </div>
            </article>
            <?php
        }
    ?>
    
</section>


<?php get_footer(); ?>