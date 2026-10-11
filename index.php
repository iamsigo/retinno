<?php
/**
 * The main template file — required fallback for a classic WordPress theme.
 *
 * @package RETINNO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>
<main id="main-content">
    <section class="page-hero">
        <div class="container page-hero__inner">
            <span class="eyebrow">RETINNO</span>
            <h1><?php esc_html_e( 'آخرین مطالب رتینو', 'retinno-theme' ); ?></h1>
            <p><?php esc_html_e( 'راهنماها و مطالب آموزشی رتینو را دنبال کنید.', 'retinno-theme' ); ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container article-grid article-grid--archive">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : ?>
                    <?php the_post(); ?>
                    <?php get_template_part( 'template-parts/article-card' ); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="empty-state empty-state--wide">
                    <h2><?php esc_html_e( 'محتوایی پیدا نشد', 'retinno-theme' ); ?></h2>
                    <p><?php esc_html_e( 'در حال حاضر محتوایی برای نمایش وجود ندارد.', 'retinno-theme' ); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <?php if ( have_posts() ) : ?>
            <div class="container pagination-wrap">
                <?php
                the_posts_pagination(
                    array(
                        'mid_size'  => 1,
                        'prev_text' => '→ جدیدتر',
                        'next_text' => 'قدیمی‌تر ←',
                    )
                );
                ?>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php
get_footer();
