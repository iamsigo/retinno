<?php
/** Author archive, designed for a multi-author blog. */
get_header(); $author = get_queried_object();
?>
<main id="main-content"><section class="page-hero"><div class="container page-hero__inner"><span class="eyebrow">نویسندگان مجله</span><h1><?php echo esc_html( get_the_author_meta( 'display_name', $author->ID ) ); ?></h1><?php $bio = get_the_author_meta( 'description', $author->ID ); if ( $bio ) : ?><p><?php echo esc_html( $bio ); ?></p><?php else : ?><p>مقاله‌های منتشرشده توسط این نویسنده در مجله رتینو.</p><?php endif; ?></div></section><section class="section"><div class="container article-grid article-grid--archive"><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); get_template_part( 'template-parts/article-card' ); endwhile; else : ?><div class="empty-state empty-state--wide"><h2>مقاله‌ای برای نمایش نیست</h2></div><?php endif; ?></div><div class="container pagination-wrap"><?php the_posts_pagination(); ?></div></section></main>
<?php get_footer(); ?>
