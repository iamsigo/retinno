<?php
/** Blog single template. */
get_header();
while ( have_posts() ) : the_post();
?>
<main id="main-content" class="article-single">
    <div class="profile-breadcrumb"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">خانه</a><span aria-hidden="true">/</span><a href="<?php echo esc_url( retinno_get_page_url( 'blog', '/blog/' ) ); ?>">مجله رتینو</a><span aria-hidden="true">/</span><span><?php the_title(); ?></span></div></div>
    <article <?php post_class(); ?>><header class="article-single__header container"><div class="article-single__meta"><span><?php echo esc_html( get_the_date() ); ?></span><span>نوشته <?php the_author_posts_link(); ?></span><?php $cats = get_the_category(); if ( $cats ) : ?><span><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?></div><h1><?php the_title(); ?></h1><?php if ( has_excerpt() ) : ?><p class="article-single__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?></header>
        <?php if ( has_post_thumbnail() ) : ?><div class="container article-single__featured"><?php the_post_thumbnail( 'large', array( 'fetchpriority' => 'high' ) ); ?></div><?php endif; ?>
        <div class="container article-single__layout"><div class="rich-content article-single__content"><?php the_content(); wp_link_pages(); ?></div><aside class="article-single__sidebar"><div class="profile-sidebar__card"><span class="eyebrow">مجله رتینو</span><h2>یادگیری ادامه دارد</h2><p>مقاله‌های دیگر را هم ببین و موضوع‌های کاربردی مرتبط با مسیر کنکور را دنبال کن.</p><a class="text-link" href="<?php echo esc_url( retinno_get_page_url( 'blog', '/blog/' ) ); ?>">همه مقاله‌ها <span aria-hidden="true">←</span></a></div></aside></div>
    </article>
</main>
<?php endwhile; get_footer(); ?>
