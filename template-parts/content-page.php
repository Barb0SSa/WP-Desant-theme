<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DesantBrat
 */

?>

<section class='page main__elem'>

	<?php desantbrat_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		?>
	</div>

</section>
