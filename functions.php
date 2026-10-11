<?php
/**
 * RETINNO Theme functions.
 *
 * @package RETINNO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'RETINNO_THEME_VERSION', '1.4.0' );
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

    // Flag JS availability so motion-only styles (marquee, reveals) apply progressively.
    echo '<script>document.documentElement.classList.add("js");</script>' . "\n";

    // Preload the two most-used self-hosted font weights for faster first paint.
    printf(
        '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
        esc_url( RETINNO_THEME_URI . '/assets/fonts/vazirmatn-400.woff2' )
    );
    printf(
        '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
        esc_url( RETINNO_THEME_URI . '/assets/fonts/vazirmatn-700.woff2' )
    );
}
add_action( 'wp_enqueue_scripts', 'retinno_theme_assets' );

/**
 * Register optional social profile URLs shown in the footer.
 * Managed under Settings → Reading on a classic theme.
 */
function retinno_social_settings() {
    register_setting( 'reading', 'retinno_instagram_url', array( 'type' => 'string', 'sanitize_callback' => 'esc_url_raw' ) );
    register_setting( 'reading', 'retinno_telegram_url', array( 'type' => 'string', 'sanitize_callback' => 'esc_url_raw' ) );
    register_setting( 'reading', 'retinno_whatsapp_number', array( 'type' => 'string', 'sanitize_callback' => 'sanitize_text_field' ) );
    register_setting( 'reading', 'retinno_linkedin_url', array( 'type' => 'string', 'sanitize_callback' => 'esc_url_raw' ) );
    register_setting( 'reading', 'retinno_youtube_url', array( 'type' => 'string', 'sanitize_callback' => 'esc_url_raw' ) );
}
add_action( 'admin_init', 'retinno_social_settings' );

/** Render footer social icons from saved settings; outputs nothing when none are set. */
function retinno_render_social_links() {
    $icons = array(
        'instagram' => '<path d="M12 2.2c3.2 0 3.6 0 4.9.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.26.07 1.64.07 4.85s0 3.6-.07 4.85c-.05 1.17-.25 1.8-.41 2.23a3.7 3.7 0 0 1-.9 1.38c-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.26.06-1.64.07-4.9.07s-3.64 0-4.9-.07c-1.17-.05-1.8-.25-2.23-.41a3.7 3.7 0 0 1-1.38-.9 3.7 3.7 0 0 1-.9-1.38c-.16-.42-.36-1.06-.41-2.23C2.2 15.6 2.2 15.2 2.2 12s0-3.6.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41C8.4 2.2 8.8 2.2 12 2.2Zm0 1.8c-3.15 0-3.5.01-4.74.07-.88.04-1.36.19-1.68.31-.42.17-.73.37-1.05.69-.32.32-.52.63-.69 1.05-.12.32-.27.8-.31 1.68C3.47 8.5 3.46 8.85 3.46 12s.01 3.5.07 4.74c.04.88.19 1.36.31 1.68.17.42.37.73.69 1.05.32.32.63.52 1.05.69.32.12.8.27 1.68.31 1.24.06 1.59.07 4.74.07s3.5-.01 4.74-.07c.88-.04 1.36-.19 1.68-.31.42-.17.73-.37 1.05-.69.32-.32.52-.63.69-1.05.12-.32.27-.8.31-1.68.06-1.24.07-1.59.07-4.74s-.01-3.5-.07-4.74c-.04-.88-.19-1.36-.31-1.68a2.8 2.8 0 0 0-.69-1.05 2.8 2.8 0 0 0-1.05-.69c-.32-.12-.8-.27-1.68-.31C15.5 4.01 15.15 4 12 4Zm0 3.06a4.94 4.94 0 1 1 0 9.88 4.94 4.94 0 0 1 0-9.88Zm0 1.8a3.14 3.14 0 1 0 0 6.28 3.14 3.14 0 0 0 0-6.28Zm5.14-2.9a1.15 1.15 0 1 1 0 2.3 1.15 1.15 0 0 1 0-2.3Z"/>',
        'telegram'  => '<path d="M9.04 15.57 8.9 19.3c.39 0 .56-.17.77-.37l1.84-1.77 3.83 2.81c.7.39 1.2.19 1.38-.65l2.5-11.72c.23-1.03-.37-1.43-1.05-1.18L3.6 9.7c-.99.38-.97.92-.17 1.17l3.5 1.09 8.13-5.16c.38-.25.73-.11.44.14L9.04 15.57Z"/>',
        'whatsapp'  => '<path d="M17.47 14.38c-.3-.15-1.75-.86-2.02-.96-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.65.07-.3-.15-1.25-.46-2.39-1.47-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.68-1.63-.93-2.23-.24-.58-.5-.49-.67-.5l-.57-.01c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.06 2.87 1.21 3.07.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.7.63.71.22 1.36.19 1.87.11.57-.08 1.75-.71 2-1.4.25-.69.25-1.28.17-1.4-.07-.13-.27-.2-.57-.35v.01ZM12.05 21.1h-.01a9.04 9.04 0 0 1-4.6-1.26l-.33-.2-3.4.89.91-3.32-.22-.34a8.99 8.99 0 0 1-1.38-4.8c0-4.97 4.05-9.02 9.04-9.02 2.41 0 4.68.94 6.39 2.64a8.94 8.94 0 0 1 2.64 6.39c0 4.97-4.05 9.02-9.04 9.02Zm7.67-16.7A10.43 10.43 0 0 0 12.05 1.5C6.3 1.5 1.64 6.16 1.64 11.9c0 1.84.48 3.63 1.4 5.21L1.5 22.5l5.53-1.45a10.4 10.4 0 0 0 5.01 1.28h.01c5.75 0 10.41-4.66 10.41-10.4 0-2.79-1.08-5.4-3.04-7.37l-.2.04Z"/>',
        'linkedin'  => '<path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3 9h4v12H3V9Zm7 0h3.8v1.7h.05c.53-1 1.83-2.05 3.76-2.05C21.6 8.65 23 10.9 23 14.2V21h-4v-6c0-1.43-.5-2.4-1.78-2.4-1.03 0-1.64.7-1.9 1.37-.1.25-.13.6-.13.95V21h-4V9Z"/>',
        'youtube'   => '<path d="M23.5 6.5a3 3 0 0 0-2.12-2.12C19.5 3.88 12 3.88 12 3.88s-7.5 0-9.38.5A3 3 0 0 0 .5 6.5 31.3 31.3 0 0 0 0 12a31.3 31.3 0 0 0 .5 5.5 3 3 0 0 0 2.12 2.12c1.88.5 9.38.5 9.38.5s7.5 0 9.38-.5a3 3 0 0 0 2.12-2.12A31.3 31.3 0 0 0 24 12a31.3 31.3 0 0 0-.5-5.5ZM9.6 15.57V8.43L15.82 12 9.6 15.57Z"/>',
    );

    $urls = array(
        'instagram' => array( get_option( 'retinno_instagram_url' ), 'اینستاگرام رتینو' ),
        'telegram'  => array( get_option( 'retinno_telegram_url' ), 'تلگرام رتینو' ),
        'whatsapp'  => array( '', '' ),
        'linkedin'  => array( get_option( 'retinno_linkedin_url' ), 'لینکدین رتینو' ),
        'youtube'   => array( get_option( 'retinno_youtube_url' ), 'یوتیوب رتینو' ),
    );

    $whatsapp = trim( (string) get_option( 'retinno_whatsapp_number' ) );
    if ( $whatsapp !== '' ) {
        $digits = preg_replace( '/\D+/', '', $whatsapp );
        if ( strlen( $digits ) >= 10 ) {
            $urls['whatsapp'] = array( 'https://wa.me/' . $digits, 'واتساپ رتینو' );
        }
    }

    $links = '';
    foreach ( $urls as $key => $entry ) {
        list( $url, $label ) = $entry;
        if ( ! $url || ! isset( $icons[ $key ] ) ) {
            continue;
        }
        $links .= sprintf(
            '<a class="social-link" href="%1$s" target="_blank" rel="noopener noreferrer" aria-label="%2$s"><svg viewBox="0 0 24 24" aria-hidden="true">%3$s</svg></a>',
            esc_url( $url ),
            esc_attr( $label ),
            $icons[ $key ]
        );
    }

    if ( $links ) {
        printf( '<div class="social-links">%s</div>', $links );
    }
}

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
