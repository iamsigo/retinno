<?php
/** Blog article card. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<article <?php post_class( 'article-card' ); ?>>
    <a class="article-card__image" href="<?php the_permalink(); ?>" aria-label="خواندن <?php the_title_attribute(); ?>">
        <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'retinno-article-card', array( 'loading' => 'lazy', 'decoding' => 'async' ) ); else : ?><span class="article-card__placeholder" aria-hidden="true"><span>RETINNO</span><i></i></span><?php endif; ?>
    </a>
    <div class="article-card__body">
        <div class="article-card__meta"><span><?php echo esc_html( get_the_date() ); ?></span><?php $categories = get_the_category(); if ( ! empty( $categories ) ) : ?><span><?php echo esc_html( $categories[0]->name ); ?></span><?php endif; ?></div>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22, '…' ) ); ?></p>
        <a class="card-link" href="<?php the_permalink(); ?>">ادامه مطلب <span aria-hidden="true">←</span></a>
    </div>
</article>
