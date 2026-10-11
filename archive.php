<?php
/** Generic archive template. */
get_header();
?>
<main id="main-content">
    <section class="page-hero"><div class="container page-hero__inner"><span class="eyebrow">مجله رتینو</span><h1><?php the_archive_title(); ?></h1><?php the_archive_description( '<div class="archive-description">', '</div>' ); ?></div></section>
    <section class="section"><div class="container article-grid article-grid--archive"><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); get_template_part( 'template-parts/article-card' ); endwhile; else : ?><div class="empty-state empty-state--wide"><h2>محتوایی پیدا نشد</h2><p>در حال حاضر محتوایی برای نمایش در این بخش وجود ندارد.</p></div><?php endif; ?></div><div class="container pagination-wrap"><?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '→ جدیدتر', 'next_text' => 'قدیمی‌تر ←' ) ); ?></div></section>
</main>
<?php get_footer(); ?>
