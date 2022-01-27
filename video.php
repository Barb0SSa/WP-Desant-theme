<?php
/*
Template Name: Видео о ВДВ

*/
?>
<?php get_header(); ?>

<section class="main__video video main__elem">
    <?php
        $loop = CFS()->get('video__card');
        foreach ($loop as $row) {
            ?>
            <div class="video__post" data-url='<?= $pos; ?>'>
                <iframe width="100%" height="300" src="<?= $row['video__url'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <?php
        }
    ?>
</section>


<?php get_footer(); ?>