<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DesantBrat
 */

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="https://example.barbossa.su/desant/wp-content/uploads/2021/12/favicon.ico" type="image/png">
	<?php wp_head(); ?>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <?php 
		if (has_nav_menu('header-menu')) {
			wp_nav_menu( [
				'theme_location'   => 'header-menu',
				'container'        => 'nav',
				'container_class'  => 'header__menu',
				'container_id'     => false,
				'items_wrap'       => '<div class="menu__toggle"><div class="menu__toggle-btn">Меню</div></div><ul class="menu">%3$s</ul>'
			] );
		} else {
			echo 'Нет меню, добавьте в админке';
		};
			
		?>
		<?php 
		$categ = get_the_category();
		if (is_front_page()) {
			?>
			<div class="header__title">
				<img src="https://example.barbossa.su/desant/wp-content/uploads/2021/11/gerb1.png" alt="" class="header__gerb">
				Благотворительный фонд
			</div>
		<?php
		} else {
			if (empty($categ)) {
				?>
				<div class="header__title">
					<img src="https://example.barbossa.su/desant/wp-content/uploads/2021/11/gerb1.png" alt="" class="header__gerb">
					<?php wp_title('');?>
				</div>
			<?php
			}  else { ?>
				<div class="header__title">
					<img src="https://example.barbossa.su/desant/wp-content/uploads/2021/11/gerb1.png" alt="" class="header__gerb">
					<?= $categ[0]->name; ?>
				</div>
			<?php
			}	
		}
		?>
    </header>
	<main class="main">