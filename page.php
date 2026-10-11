<?php
/** Standard page template. */
get_header();
while ( have_posts() ) : the_post();
?>
<main id="main-content" class="standard-page">
    <section class="page-hero page-hero--simple"><div class="container page-hero__inner"><span class="eyebrow">RETINNO</span><h1><?php the_title(); ?></h1><?php if ( has_excerpt() ) : ?><p><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?></div></section>
    <section class="section"><div class="container content-container"><article <?php post_class( 'rich-content page-content' ); ?>><?php the_content(); ?></article></div></section>
</main>
<?php endwhile; get_footer(); ?>
