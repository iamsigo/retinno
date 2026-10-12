<?php
/**
 * RETINNO Theme functions.
 *
 * @package RETINNO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'RETINNO_THEME_VERSION', '1.3.0' );
define( 'RETINNO_THEME_DIR', get_template_directory() );
define( 'RETINNO_THEME_URI', get_template_directory_uri() );

/** Theme features and navigation locations. */
function retinno_theme_setup() {
    load_theme_textdomain( 'retinno-theme', RETINNO_THEME_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 120,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'responsive-embeds' );

    add_image_size( 'retinno-consultant-card', 720, 820, true );
    add_image_size( 'retinno-article-card', 720, 480, true );

    register_nav_menus( array(
        'primary' => __( 'منوی اصلی', 'retinno-theme' ),
        'footer'  => __( 'منوی فوتر', 'retinno-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'retinno_theme_setup' );

/** Load theme assets. */
function retinno_theme_assets() {
    wp_enqueue_style( 'retinno-theme-style', get_stylesheet_uri(), array(), RETINNO_THEME_VERSION );
    wp_enqueue_style( 'retinno-theme-main', RETINNO_THEME_URI . '/assets/css/main.css', array( 'retinno-theme-style' ), RETINNO_THEME_VERSION );
    wp_enqueue_script( 'retinno-theme-main', RETINNO_THEME_URI . '/assets/js/main.js', array(), RETINNO_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'retinno_theme_assets' );

/** Fallback menu when no WordPress menu has been assigned yet. */
function retinno_fallback_primary_menu( $args = array() ) {
    $theme_location = is_object( $args ) && isset( $args->theme_location ) ? $args->theme_location : '';
    $list_class = 'footer' === $theme_location ? 'footer-nav__list' : 'site-nav__list';
    $items = array(
        array( 'label' => 'خانه', 'url' => home_url( '/' ) ),
    );

    $consultants_url = get_post_type_archive_link( 'retinno_consultant' );
    if ( $consultants_url ) {
        $items[] = array( 'label' => 'مشاوران', 'url' => $consultants_url );
    }

    $posts_page_id = (int) get_option( 'page_for_posts' );
    if ( $posts_page_id ) {
        $items[] = array( 'label' => 'مجله رتینو', 'url' => get_permalink( $posts_page_id ) );
    } else {
        $items[] = array( 'label' => 'مجله رتینو', 'url' => home_url( '/blog/' ) );
    }

    foreach ( array( 'about' => 'درباره ما', 'services' => 'خدمات', 'contact' => 'ارتباط با ما' ) as $slug => $label ) {
        $page = get_page_by_path( $slug );
        if ( $page instanceof WP_Post ) {
            $items[] = array( 'label' => $label, 'url' => get_permalink( $page ) );
        }
    }

    printf( '<ul class="%s">', esc_attr( $list_class ) );
    foreach ( $items as $item ) {
        $is_current = untrailingslashit( $item['url'] ) === untrailingslashit( home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) ) );
        printf(
            '<li class="site-nav__item%s"><a href="%s">%s</a></li>',
            $is_current ? ' is-current' : '',
            esc_url( $item['url'] ),
            esc_html( $item['label'] )
        );
    }
    echo '</ul>';
}

/** Small helpers for template data. */
function retinno_get_field_value( $field_name, $post_id = 0 ) {
    $post_id = $post_id ? $post_id : get_the_ID();

    if ( function_exists( 'get_field' ) ) {
        return get_field( $field_name, $post_id );
    }

    return get_post_meta( $post_id, $field_name, true );
}

function retinno_get_consultant_capacity( $post_id = 0 ) {
    $value = retinno_get_field_value( 'capacity_status', $post_id );
    $statuses = array(
        'available' => array( 'label' => 'دارای ظرفیت', 'class' => 'is-available' ),
        'limited'   => array( 'label' => 'ظرفیت محدود', 'class' => 'is-limited' ),
        'full'      => array( 'label' => 'تکمیل ظرفیت', 'class' => 'is-full' ),
        'inactive'  => array( 'label' => 'فعلاً پذیرش ندارد', 'class' => 'is-inactive' ),
    );

    return isset( $statuses[ $value ] ) ? $statuses[ $value ] : array( 'label' => 'وضعیت ظرفیت اعلام نشده', 'class' => 'is-unknown' );
}

function retinno_consultant_terms( $taxonomy, $post_id = 0 ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $terms = get_the_terms( $post_id, $taxonomy );

    if ( is_wp_error( $terms ) || empty( $terms ) ) {
        return array();
    }

    return $terms;
}

function retinno_render_consultant_terms( $taxonomy, $post_id = 0 ) {
    $terms = retinno_consultant_terms( $taxonomy, $post_id );
    if ( empty( $terms ) ) {
        return;
    }

    echo '<div class="term-pills">';
    foreach ( $terms as $term ) {
        printf( '<span class="term-pill">%s</span>', esc_html( $term->name ) );
    }
    echo '</div>';
}

function retinno_get_page_url( $slug, $fallback_path = '/' ) {
    $page = get_page_by_path( $slug );
    if ( $page instanceof WP_Post ) {
        return get_permalink( $page );
    }
    return home_url( $fallback_path );
}

/** Excerpt length tuned for Persian card layouts. */
function retinno_excerpt_length( $length ) {
    return 24;
}
add_filter( 'excerpt_length', 'retinno_excerpt_length', 999 );

function retinno_excerpt_more( $more ) {
    return '…';
}
add_filter( 'excerpt_more', 'retinno_excerpt_more' );
