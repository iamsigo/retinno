<?php
/** Site header. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main-content">رفتن به محتوای اصلی</a>
<header class="site-header">
    <div class="container site-header__inner">
        <div class="site-branding">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a class="site-branding__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="رتینو؛ صفحه اصلی">
                    <img class="brand-mark" src="<?php echo esc_url( RETINNO_THEME_URI . '/assets/images/retinno-mark-dark.png' ); ?>" alt="" width="42" height="42" aria-hidden="true">
                    <span class="brand-wordmark"><strong>RETINNO</strong><small>رتینو</small></span>
                </a>
            <?php endif; ?>
        </div>

        <button class="site-nav-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
            <span class="site-nav-toggle__icon" aria-hidden="true"><i></i><i></i><i></i></span>
            <span class="screen-reader-text">باز کردن منو</span>
        </button>

        <nav class="site-nav" id="primary-navigation" aria-label="منوی اصلی">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'site-nav__list',
                'fallback_cb'    => 'retinno_fallback_primary_menu',
                'depth'          => 2,
            ) );
            ?>
        </nav>
        <a class="button button--small site-header__cta" href="<?php echo esc_url( get_post_type_archive_link( 'retinno_consultant' ) ?: home_url( '/consultants/' ) ); ?>">آشنایی با مشاوران <span aria-hidden="true">←</span></a>
    </div>
</header>
