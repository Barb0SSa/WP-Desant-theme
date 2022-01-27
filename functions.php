<?php
/**
 * DesantBrat functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DesantBrat
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


// ---------------НАСТРОЙКИ МЕНЮ
add_action( 'after_setup_theme', function () {

	register_nav_menus( [
		'header-menu' => 'Шапка',
	] );

} );



// Изменяем атрибут id у тега li
add_filter( 'nav_menu_item_id', 'filter_menu_item_css_id', 10, 4 );
function filter_menu_item_css_id( $menu_id, $item, $args, $depth ) {
	return $args->theme_location === 'header-menu' ? '' : $menu_id;
}
// Изменяем атрибут class у тега li
add_filter( 'nav_menu_css_class', 'filter_nav_menu_css_classes', 10, 4 );
function filter_nav_menu_css_classes( $classes, $item, $args, $depth ) {
	
	if ( $args->theme_location === 'header-menu' ) {
		if ($item->type == 'custom') {
			if ($depth > 0) {
				$classes = [
					'drop-menu__item',
					'drop-menu__wrapper',
				];	
			} else {
				$classes = [
					'drop-menu__wrapper',
					'menu__item',
				];
			};
		} else {
			if ($depth > 0) {
				$classes = [
					'drop-menu__item',
				];	
			} else {
				$classes = [
					'menu__item',
				];
			};
		};
	}
	return $classes;
}

// Изменяет класс у вложенного ul
add_filter( 'nav_menu_submenu_css_class', 'filter_nav_menu_submenu_css_class', 10, 3 );
function filter_nav_menu_submenu_css_class( $classes, $args, $depth ) {
	if ( $args->theme_location === 'header-menu' ) {
		$classes = [
			'drop-menu'
		];
	}

	return $classes;
}
// Добавляем классы ссылкам
add_filter( 'nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 4 );
function filter_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	if ( $args->theme_location === 'header-menu' ) {
		if ($item->type == 'custom') {
			if ($depth > 0) {
				$atts['class'] = 'drop-menu__link drop-menu__toggle';	
			} else {
				$atts['class'] = 'drop-menu__toggle menu__link';
			};
		} else {
			if ($depth > 0) {
				$atts['class'] = 'drop-menu__link';	
			} else {
				$atts['class'] = 'menu__link';
			};
		};
	}

	return $atts;
}
// добавляем кнопку для вложенных меню
add_filter( 'nav_menu_item_title', 'filter_nav_menu_item_title', 10, 4 );
function filter_nav_menu_item_title( $title, $item, $args, $depth ) {
	
	if ( $args->theme_location === 'header-menu' ) {
		if ($item->type == 'custom') {
			$title = $title . '<i class="fa fa-chevron-down menu__chevron" aria-hidden="true"></i>';
		}
	}
	return $title;
}


// admin-bar
add_filter('show_admin_bar', '__return_false');

// editor
add_action( 'after_setup_theme', 'my_theme_setup' );
function my_theme_setup() {
    add_editor_style();

    // For the Block Editor.
    add_theme_support( 'editor-styles' );
}

/**
 * Альтернатива wp_pagenavi. Создает ссылки пагинации на страницах архивов.
 *
 * @param string $before - текст до навигации
 * @param string $after - текст после навигации
 * @param bool $echo - возвращать или выводить результат
 * @param array $args - аргументы функции
 * @param array $wp_query - объект WP_Query на основе которого строится пагинация. По умолчанию глобальная переменная $wp_query
 *
 * Версия: 2.4
 * Автор: Тимур Камаев
 * Ссылка на страницу функции: http://wp-kama.ru/?p=8
 */
function kama_pagenavi( $before = '', $after = '', $echo = true, $args = array(), $wp_query = null ) {
    if ( ! $wp_query ) {
        global $wp_query;
    }

    // параметры по умолчанию
    $default_args = array(
        'text_num_page'   => '',
        // Текст перед пагинацией. {current} - текущая; {last} - последняя (пр. 'Страница {current} из {last}' получим: "Страница 4 из 60" )
        'num_pages'       => 5,
        // сколько ссылок показывать
        'step_link'       => 0,
        // ссылки с шагом (значение - число, размер шага (пр. 1,2,3...10,20,30). Ставим 0, если такие ссылки не нужны.
        'dotright_text'   => '…',
        // промежуточный текст "до".
        'dotright_text2'  => '…',
        // промежуточный текст "после".
        'back_text'       => 'Назад',
        // текст "перейти на предыдущую страницу". Ставим 0, если эта ссылка не нужна.
        'next_text'       => 'Вперед',
        // текст "перейти на следующую страницу". Ставим 0, если эта ссылка не нужна.
        'first_page_text' => 'К началу',
        // текст "к первой странице". Ставим 0, если вместо текста нужно показать номер страницы.
        'last_page_text'  => 'В конец',
        // текст "к последней странице". Ставим 0, если вместо текста нужно показать номер страницы.
    );

    $default_args = apply_filters( 'kama_pagenavi_args', $default_args ); // чтобы можно было установить свои значения по умолчанию

    $args = array_merge( $default_args, $args );

    extract( $args );

    $posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
    $paged          = (int) $wp_query->query_vars['paged'];
    $max_page       = $wp_query->max_num_pages;

    //проверка на надобность в навигации
    if ( $max_page <= 1 ) {
        return false;
    }

    if ( empty( $paged ) || $paged == 0 ) {
        $paged = 1;
    }

    $pages_to_show         = intval( $num_pages );
    $pages_to_show_minus_1 = $pages_to_show - 1;

    $half_page_start = floor( $pages_to_show_minus_1 / 2 ); //сколько ссылок до текущей страницы
    $half_page_end   = ceil( $pages_to_show_minus_1 / 2 ); //сколько ссылок после текущей страницы

    $start_page = $paged - $half_page_start; //первая страница
    $end_page   = $paged + $half_page_end; //последняя страница (условно)

    if ( $start_page <= 0 ) {
        $start_page = 1;
    }
    if ( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if ( $end_page > $max_page ) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page   = (int) $max_page;
    }

    if ( $start_page <= 0 ) {
        $start_page = 1;
    }

    //выводим навигацию
    $out = '';

    // создаем базу чтобы вызвать get_pagenum_link один раз
    $link_base = str_replace( 99999999, '___', get_pagenum_link( 99999999 ) );
    $first_url = get_pagenum_link( 1 );
    if ( false === strpos( $first_url, '?' ) ) {
        $first_url = user_trailingslashit( $first_url );
    }

    $out .= $before . "<div class='wp-pagenavi'>\n";

    if ( $text_num_page ) {
        $text_num_page = preg_replace( '!{current}|{last}!', '%s', $text_num_page );
        $out           .= sprintf( "<span class='pages'>$text_num_page</span> ", $paged, $max_page );
    }
    // назад
    if ( $back_text && $paged != 1 ) {
        $out .= '<a class="prev" href="' . ( ( $paged - 1 ) == 1 ? $first_url : str_replace( '___', ( $paged - 1 ), $link_base ) ) . '">' . $back_text . '</a> ';
    }
    // в начало
    if ( $start_page >= 2 && $pages_to_show < $max_page ) {
        $out .= '<a class="first" href="' . $first_url . '">' . ( $first_page_text ? $first_page_text : 1 ) . '</a> ';
        if ( $dotright_text && $start_page != 2 ) {
            $out .= '<span class="extend">' . $dotright_text . '</span> ';
        }
    }
    // пагинация
    for ( $i = $start_page; $i <= $end_page; $i ++ ) {
        if ( $i == $paged ) {
            $out .= '<span class="current">' . $i . '</span> ';
        } elseif ( $i == 1 ) {
            $out .= '<a href="' . $first_url . '">1</a> ';
        } else {
            $out .= '<a href="' . str_replace( '___', $i, $link_base ) . '">' . $i . '</a> ';
        }
    }

    //ссылки с шагом
    $dd = 0;
    if ( $step_link && $end_page < $max_page ) {
        for ( $i = $end_page + 1; $i <= $max_page; $i ++ ) {
            if ( $i % $step_link == 0 && $i !== $num_pages ) {
                if ( ++ $dd == 1 ) {
                    $out .= '<span class="extend">' . $dotright_text2 . '</span> ';
                }
                $out .= '<a href="' . str_replace( '___', $i, $link_base ) . '">' . $i . '</a> ';
            }
        }
    }
    // в конец
    if ( $end_page < $max_page ) {
        if ( $dotright_text && $end_page != ( $max_page - 1 ) ) {
            $out .= '<span class="extend">' . $dotright_text2 . '</span> ';
        }
        $out .= '<a class="last" href="' . str_replace( '___', $max_page, $link_base ) . '">' . ( $last_page_text ? $last_page_text : $max_page ) . '</a> ';
    }
    // вперед
    if ( $next_text && $paged != $end_page ) {
        $out .= '<a class="next" href="' . str_replace( '___', ( $paged + 1 ), $link_base ) . '">' . $next_text . '</a> ';
    }

    $out .= "</div>" . $after . "\n";

    $out = apply_filters( 'kama_pagenavi', $out );

    if ( $echo ) {
        return print $out;
    }

    return $out;
}




if ( ! function_exists( 'desantbrat_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function desantbrat_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on DesantBrat, use a find and replace
		 * to change 'desantbrat' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'desantbrat', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'desantbrat_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'desantbrat_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function desantbrat_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'desantbrat_content_width', 640 );
}
add_action( 'after_setup_theme', 'desantbrat_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function desantbrat_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'desantbrat' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'desantbrat' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'desantbrat_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function desantbrat_scripts() {
	wp_enqueue_style( 'desantbrat-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'fa-style', get_template_directory_uri() . '/fa/css/all.css');
	wp_enqueue_style( 'fonts-style', get_template_directory_uri() . '/fonts/fonts.css');
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/style.css');
	wp_enqueue_style( 'media-style', get_template_directory_uri() . '/css/media.css');
	wp_style_add_data( 'desantbrat-style', 'rtl', 'replace' );

	wp_enqueue_script( 'desantbrat-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/script.js', array(), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'desantbrat_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

