<?php
/** Consultant card. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$capacity = retinno_get_consultant_capacity( get_the_ID() );
$intro = retinno_get_field_value( 'short_intro', get_the_ID() );
if ( ! $intro ) { $intro = get_the_excerpt(); }
?>
<article <?php post_class( 'consultant-card' ); ?>>
    <a class="consultant-card__image" href="<?php the_permalink(); ?>" aria-label="مشاهده پروفایل <?php the_title_attribute(); ?>">
        <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'retinno-consultant-card', array( 'loading' => 'lazy', 'decoding' => 'async' ) ); else : ?><span class="consultant-card__placeholder" aria-hidden="true"><strong>R</strong><small>RETINNO</small></span><?php endif; ?>
        <span class="capacity-badge <?php echo esc_attr( $capacity['class'] ); ?>"><span></span><?php echo esc_html( $capacity['label'] ); ?></span>
    </a>
    <div class="consultant-card__body">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php if ( $intro ) : ?><p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $intro ), 22, '…' ) ); ?></p><?php else : ?><p>برای مشاهده سوابق و زمینه فعالیت این مشاور، وارد صفحه اختصاصی او شو.</p><?php endif; ?>
        <div class="consultant-card__meta">
            <?php $fields = retinno_consultant_terms( 'consultant_field', get_the_ID() ); if ( $fields ) : ?><span><?php echo esc_html( implode( '، ', wp_list_pluck( $fields, 'name' ) ) ); ?></span><?php endif; ?>
            <?php $grades = retinno_consultant_terms( 'consultant_grade', get_the_ID() ); if ( $grades ) : ?><span><?php echo esc_html( implode( '، ', wp_list_pluck( $grades, 'name' ) ) ); ?></span><?php endif; ?>
        </div>
        <a class="card-link" href="<?php the_permalink(); ?>">مشاهده پروفایل <span aria-hidden="true">←</span></a>
    </div>
</article>
