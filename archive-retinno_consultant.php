<?php
/** Consultant archive. */
get_header();
?>
<main id="main-content">
    <section class="page-hero page-hero--archive"><div class="container page-hero__inner"><span class="eyebrow">همراهان رتینو</span><h1>مشاوران رتینو</h1><p>با سوابق، زمینه فعالیت و وضعیت پذیرش مشاوران آشنا شو تا شناخت روشن‌تری برای انتخاب مسیرت داشته باشی.</p><div class="page-hero__line"><span>مشاوران آموزشی</span><span>RETINNO / PEOPLE</span></div></div></section>
    <section class="section archive-list-section"><div class="container">
        <?php if ( have_posts() ) : ?><div class="consultant-grid consultant-grid--archive"><?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/consultant-card' ); endwhile; ?></div><div class="pagination-wrap"><?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '→ جدیدتر', 'next_text' => 'قدیمی‌تر ←' ) ); ?></div>
        <?php else : ?><div class="empty-state"><span class="empty-state__mark">R</span><h2>مشاوری برای نمایش وجود ندارد</h2><p>با انتشار پروفایل مشاوران، اطلاعات آن‌ها در این بخش قرار می‌گیرد.</p></div><?php endif; ?>
    </div></section>
</main>
<?php get_footer(); ?>
