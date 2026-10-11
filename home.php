<?php
/** Blog listing page. */
get_header();
?>
<main id="main-content">
    <section class="page-hero"><div class="container page-hero__inner"><span class="eyebrow">یادگیری و رشد</span><h1><?php echo esc_html( get_the_title( (int) get_option( 'page_for_posts' ) ) ?: 'مجله رتینو' ); ?></h1><p>مقاله‌ها و راهنماهایی برای مطالعه مؤثرتر، برنامه‌ریزی و شناخت مسیر کنکور.</p><div class="page-hero__line"><span>آموزش / برنامه‌ریزی / کنکور</span><span>RETINNO / JOURNAL</span></div></div></section>
    <section class="section"><div class="container article-grid article-grid--archive"><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); get_template_part( 'template-parts/article-card' ); endwhile; else : ?><div class="empty-state empty-state--wide"><h2>هنوز مقاله‌ای منتشر نشده</h2><p>بعد از انتشار محتوا، مقاله‌ها در اینجا دیده می‌شوند.</p></div><?php endif; ?></div><div class="container pagination-wrap"><?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '→ جدیدتر', 'next_text' => 'قدیمی‌تر ←' ) ); ?></div></section>
</main>
<?php get_footer(); ?>
