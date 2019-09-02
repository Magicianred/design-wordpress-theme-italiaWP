<?php

add_action('wp_enqueue_scripts', 'italiawp_adjustments_css');
function italiawp_adjustments_css() {
    wp_enqueue_style('italiawp_adjustments_css', get_template_directory_uri() . '/inc/adjustments.css');
}

add_theme_support('post-thumbnails');
add_image_size('post-thumbnails',512,512,array('center','center'));
add_image_size('news-image',400,220,array('center','center'));

add_theme_support('custom-logo',array(
    'height'      => 512,
    'width'       => 512,
    'flex-width'  => true,
    'flex-height' => true,
));

register_nav_menus( array(
    'menu-principale' => 'Menu Principale',
    'menu-utilita' => 'Menu Utilità',
    'box-servizi-1' => 'Box Servizi 1',
    'box-servizi-2' => 'Box Servizi 2',
    'box-servizi-3' => 'Box Servizi 3',
    'box-servizi-4' => 'Box Servizi 4',
    'box-servizi-5' => 'Box Servizi 5',
    'box-servizi-6' => 'Box Servizi 6',
    'box-servizi-7' => 'Box Servizi 7',
    'box-servizi-8' => 'Box Servizi 8',
    'box-servizi-9' => 'Box Servizi 9',
    'menu-links-1' => 'Menu Links 1',
    'menu-links-2' => 'Menu Links 2',
    'menu-links-3' => 'Menu Links 3'
) );

function italiawp_custom_classes_menu_utilita( $classes, $item, $args ) {
    if ( 'menu-utilita' === $args->theme_location ) {
        $classes[] = 'Grid-cell u-sizeFull u-sm-size1of2 u-md-size1of4 u-lg-size1of4';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'italiawp_custom_classes_menu_utilita', 10, 3 );

function italiawp_custom_login_logo() {
    echo '<style type="text/css">';
    echo '.login h1 a { background-image:url('.esc_url(get_site_icon_url()).') !important; }';
    echo '</style>';
}
add_action('login_head', 'italiawp_custom_login_logo');

function italiawp_widgets_init() {
    register_sidebar( array(
        'name'          => 'Footer Colonne',
        'id'            => 'footer-colonne',
        'description'   => 'Colonne del Footer',
        'before_widget' => '<div id="%1$s" class="Footer-block Grid-cell u-sm-size1of2 u-md-size1of4 u-lg-size1of4 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="Footer-blockTitle">',
        'after_title'   => '</h2>'
    ));
    register_sidebar( array(
        'name'          => 'Sidebar Pagine',
        'id'            => 'sidebar-pagine',
        'description'   => 'Sidebar nelle Pagine',
        'before_widget' => '<div class="u-margin-r-top"></div>',
        'after_widget'  => '',
        'before_title'  => '<ul class="Linklist Linklist--padded u-layout-prose u-text-r-xs"><li><span class="Linklist-link Linklist-link--lev1">',
        'after_title'   => '</span></li></ul>',
        'class'         => 'Linklist-link Linklist-link--lev3'
    ));
    register_sidebar( array(
        'name'          => 'Sidebar Articoli',
        'id'            => 'sidebar-articoli',
        'description'   => 'Sidebar negli Articoli',
        'before_widget' => '<div class="u-margin-r-top"></div>',
        'after_widget'  => '',
        'before_title'  => '<ul class="Linklist Linklist--padded u-layout-prose u-text-r-xs"><li><span class="Linklist-link Linklist-link--lev1">',
        'after_title'   => '</span></li></ul>',
        'class'         => 'Linklist-link Linklist-link--lev3'
    ));
}
add_action( 'widgets_init', 'italiawp_widgets_init' );

function italiawp_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'italiawp_custom_header_args', array(
        'default-image'          => get_template_directory_uri() . '/images/2000x500.png',
        'default-text-color'     => '000000',
        'header-text'            => false,
        'width'                  => 2000,
        'height'                 => 500,
        'flex-height'            => true,
        'uploads'                => true
    )));
}
add_action( 'after_setup_theme', 'italiawp_custom_header_setup' );

register_default_headers(array(
    '2000x500' => array(
        'url' => get_template_directory_uri() . '/images/2000x500.png',
        'thumbnail_url' => get_template_directory_uri() . '/images/2000x500.png',
        'description' => 'Default header'
    )
));

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
function posts_link_attributes() {
    return 'class="u-color-50"';
}

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/style.php';
require get_template_directory() . '/inc/gallery.php';
require get_template_directory() . '/inc/details.php';

function italiawp_create_breadcrumbs() {

    $home = 'Home';
    $before = '<li class="Breadcrumb-item">';
    $after = '</li>';

    if (!is_home() && !is_front_page()) {
        echo '<div class="u-layout-wide u-layoutCenter u-layout-withGutter u-padding-r-bottom u-padding-r-top">';
        echo '<nav aria-label="sei qui:" role="navigation"><ul class="Breadcrumb">';

        global $post;
        $homeLink = get_bloginfo('url');
        echo '<li class="Breadcrumb-item"><a class="Breadcrumb-link u-color-50" href="' . $homeLink . '">' . $home . '</a></li>';

        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0)
                echo(get_category_parents($parentCat, TRUE, ' '));
            echo $before . single_cat_title('', false) . $after;
        } elseif (is_day()) {
            echo '<li class="Breadcrumb-item"><a class="Breadcrumb-link u-color-50" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
            echo '<li class="Breadcrumb-item"><a class="Breadcrumb-link u-color-50" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<li class="Breadcrumb-item"><a class="Breadcrumb-link u-color-50" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<li class="Breadcrumb-item"><a class="Breadcrumb-link u-color-50" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo '<li class="Breadcrumb-item"><a class="Breadcrumb-link u-color-50" href="' . get_term_link($cat->cat_ID, false) . '">' . $cat->cat_name . '</a></li>';
                echo $before . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ');
            echo '<li class="Breadcrumb-item"><a class="Breadcrumb-link u-color-50" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
            echo $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li class="Breadcrumb-item"><a class="Breadcrumb-link u-color-50" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb)
                echo $crumb . ' ';
            echo $before . get_the_title() . $after;
        } elseif (is_search()) {
            echo $before . get_search_query() . $after;
        } elseif (is_tag()) {
            echo $before . single_tag_title('', false) . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . 'Errore 404' . $after;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo '<li class="Breadcrumb-item"> (';
            echo ' Pagina' . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ') </li>';
        }

        echo '</div></ul></nav>';
    }
}

add_filter('the_excerpt', function ($excerpt) {
    if ( has_excerpt() ) {
        return $excerpt;
    } else {
        return substr(strip_shortcodes($excerpt), 0, strpos(strip_shortcodes($excerpt), '.') + 1);
    }
});

add_filter('get_the_excerpt', function ($excerpt) {
    if ( has_excerpt() ) {
        return $excerpt;
    } else {
        if (strpos($excerpt, '.') === false) {
            if(strlen(strip_shortcodes($excerpt))>115) {
                return substr(strip_shortcodes($excerpt), 0, 115);
            }else{
                return strip_shortcodes($excerpt);
            }
        }else{
            return substr(strip_shortcodes($excerpt), 0, strpos(strip_shortcodes($excerpt), '.') + 1);
        }
    }
});

/* UPDATER THEME VERSION */
require 'inc/theme-update-checker.php';
$update_checker = new ThemeUpdateChecker(
    'italiawp',
    'https://raw.githubusercontent.com/italia/design-wordpress-theme-wt/master/italiawp.json'
);

/* Per la ricerca manuale degli aggiornamenti, altrimenti avviene automaticamente ogni 12 ore */
//$update_checker->checkForUpdates();

require_once 'inc/tgm-plugin-activation/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'italiawp_register_required_plugins');

function italiawp_register_required_plugins() {
    $plugins = array(
        array(
            'name' => 'Attachments',
            'slug' => 'attachments',
            'required' => false,
        ),
    );

    $config = array(
        'id' => 'italiawp',
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'parent_slug' => 'themes.php',
        'capability' => 'edit_theme_options',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => false,
        'message' => '',
        'strings' => array(
            'page_title' => __('Plugin richiesti dal tema "ItaliaWP"', 'italiawp'),
            'menu_title' => __('Plugin richiesti', 'italiawp'),
            'installing' => __('Installazione del Plugin: %s', 'italiawp'),
            'updating' => __('Aggiornamento del Plugin: %s', 'italiawp'),
            'oops' => __('Qualcosa è andato male con le API del Plugin.', 'italiawp'),
            'notice_can_install_required' => _n_noop(
                    'Il tema "ItaliaWP" richiede il plugin: %1$s.', 'Il tema "ItaliaWP" richiede i plugin: %1$s.', 'italiawp'
            ),
            'notice_can_install_recommended' => _n_noop(
                    'Il tema "ItaliaWP" raccomanda il plugin: %1$s.', 'Il tema "ItaliaWP" raccomanda i plugin: %1$s.', 'italiawp'
            ),
            'notice_ask_to_update' => _n_noop(
                    'Il seguente plugin deve essere aggiornato all\'ultima versione per avere massima compatibilità con questo tema: %1$s.', 'I seguenti plugin devono essere aggiornati all\'ultima versione per avere massima compatibilità con questo tema: %1$s.', 'italiawp'
            ),
            'notice_ask_to_update_maybe' => _n_noop(
                    'C\'è un aggiornamento disponibile per: %1$s.', 'Ci sono aggiornamenti disponibili per: %1$s.', 'italiawp'
            ),
            'notice_can_activate_required' => _n_noop(
                    'Il plugin richiesto non è attivo: %1$s.', 'I plugin richiesti non sono attivi: %1$s.', 'italiawp'
            ),
            'notice_can_activate_recommended' => _n_noop(
                    'Il plugin raccomandato non è attivo: %1$s.', 'I plugin raccomandati non sono attivi: %1$s.', 'italiawp'
            ),
            'install_link' => _n_noop(
                    'Installa il plugin', 'Installa i plugin', 'italiawp'
            ),
            'update_link' => _n_noop(
                    'Aggiorna il plugin', 'Aggiorna i plugin', 'italiawp'
            ),
            'activate_link' => _n_noop(
                    'Attiva il plugin', 'Attiva i plugin', 'italiawp'
            ),
            'return' => __('Ritorna all\'installazione dei Plugin Richiesti', 'italiawp'),
            'plugin_activated' => __('Plugin attivati con successo.', 'italiawp'),
            'activated_successfully' => __('I seguenti plugin sono stati attivati con successo:', 'italiawp'),
            'plugin_already_active' => __('Nessuna azione richiesta. Il Plugin %1$s è già attivo.', 'italiawp'),
            'plugin_needs_higher_version' => __('Plugin non attivato. Il tema ha bisogno di na versione più recente di %s. Per favore aggiorna il plugin.', 'italiawp'),
            'complete' => __('Tutti i plugin sono stati installati e attivati con successo. %1$s', 'italiawp'),
            'dismiss' => __('Nascondi la notifica', 'italiawp'),
            'notice_cannot_install_activate' => __('Ci sono dei plugin raccomandati o richiesti da installare, aggiornare  o attivare.', 'italiawp'),
            'contact_admin' => __('Per favore, contatta l\'amministratore del sito per assistenza.', 'italiawp'),
            'nag_type' => '',
        ),
    );
    tgmpa($plugins, $config);
}

require get_template_directory() . '/inc/gallery_cpt.php';

function current_url() {
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $validURL = str_replace("&", "&amp", $url);
    return $validURL;
}

function is_custom_post_type($post = NULL) {
    $all_custom_post_types = get_post_types(array('_builtin' => FALSE));

    if (empty($all_custom_post_types))
        return FALSE;

    $custom_types = array_keys($all_custom_post_types);
    $current_post_type = get_post_type($post);

    if (!$current_post_type)
        return FALSE;

    return in_array($current_post_type, $custom_types);
}

add_action('admin_head-nav-menus.php', 'italiawp_menu_pt_archive');
function italiawp_menu_pt_archive() {
    add_meta_box('minimac-metabox-nav-menu-pt', 'Custom Posts Type', 'italiawp_metabox_menu_pt_archive', 'nav-menus', 'side', 'default');
}

function italiawp_metabox_menu_pt_archive() {

    $post_types = get_post_types(array(
        'show_in_nav_menus' => true,
        'has_archive' => true
            ), 'object');

    if ($post_types) :
        $items = array();
        $loop_index = 999999;

        foreach ($post_types as $post_type) {
            $item = new stdClass();
            $loop_index++;

            $item->object_id = $loop_index;
            $item->db_id = 0;
            $item->object = 'post_type_' . $post_type->query_var;
            $item->menu_item_parent = 0;
            $item->type = 'custom';
            $item->title = $post_type->labels->name;
            $item->url = get_post_type_archive_link($post_type->query_var);
            $item->target = '';
            $item->attr_title = '';
            $item->classes = array();
            $item->xfn = '';

            $items[] = $item;
        }

        $walker = new Walker_Nav_Menu_Checklist(array());

        echo '<div id="posttype-archive" class="posttypediv">';
        echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
        echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
        echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
        echo '</ul>';
        echo '</div>';
        echo '</div>';

        echo '<p class="button-controls">';
        echo '<span class="add-to-menu">';
        echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . 'Aggiungi al menu' . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
        echo '<span class="spinner"></span>';
        echo '</span>';
        echo '</p>';

    endif;
}

add_action('pre_get_posts','my_date_search');
function my_date_search() {
    if (is_search()) {
        $original_query = get_search_query();
        
        $months = array(1 => "Gennaio", 2 => "Febbraio", 3 => "Marzo", 4 => "Aprile", 5 => "Maggio", 6 => "Giugno", 7 => "Luglio", 8 => "Agosto", 9 => "Settembre", 10 => "Ottobre", 11 => "Novembre", 12 => "Dicembre");

        foreach ($months as $month => $month_name) {
            if (stristr($original_query, $month_name)) {
                $m = $month;
                preg_match('/(19[0-9][0-9]|20[0-9][0-9])/', $original_query, $year);
                if ($year)
                    $y = $year[0];
                preg_match('/^[0-3]{0,1}[0-9]{1} /', $original_query, $day);
                if ($day)
                    $d = $day[0];
            }
        }
        
        if (isset($m) && isset($y)) {
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            if(!isset($d)) $d = "";
            $new_query = 'year=' . $y . '&monthnum=' . $m . '&day=' . $d . '&paged=' . $paged;
            query_posts($new_query);
        }
    }
}
