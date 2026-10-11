<?php
/** Single consultant profile. */
get_header();
while ( have_posts() ) : the_post();
    $post_id = get_the_ID();
    $intro = retinno_get_field_value( 'short_intro', $post_id );
    $resume = retinno_get_field_value( 'resume', $post_id );
    $education = retinno_get_field_value( 'education', $post_id );
    $achievements = retinno_get_field_value( 'achievements', $post_id );
    $experience = retinno_get_field_value( 'consulting_experience', $post_id );
    $capacity = retinno_get_consultant_capacity( $post_id );
?>
<main id="main-content" class="consultant-profile">
    <div class="profile-breadcrumb"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">خانه</a><span aria-hidden="true">/</span><a href="<?php echo esc_url( get_post_type_archive_link( 'retinno_consultant' ) ?: home_url( '/consultants/' ) ); ?>">مشاوران</a><span aria-hidden="true">/</span><span><?php the_title(); ?></span></div></div>
    <section class="profile-hero section--compact">
        <div class="container profile-hero__grid">
            <div class="profile-portrait">
                <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'large', array( 'fetchpriority' => 'high' ) ); else : ?><div class="profile-portrait__placeholder"><span>R</span><small>RETINNO</small></div><?php endif; ?>
                <span class="profile-portrait__accent" aria-hidden="true"></span>
            </div>
            <div class="profile-hero__content">
                <span class="eyebrow">مشاور رتینو</span>
                <h1><?php the_title(); ?></h1>
                <?php if ( $intro ) : ?><p class="profile-intro"><?php echo esc_html( $intro ); ?></p><?php elseif ( has_excerpt() ) : ?><p class="profile-intro"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
                <div class="profile-capacity"><span class="capacity-badge <?php echo esc_attr( $capacity['class'] ); ?>"><span></span><?php echo esc_html( $capacity['label'] ); ?></span><span class="profile-capacity__note">وضعیت پذیرش فعلی</span></div>
                <?php if ( retinno_consultant_terms( 'consultant_field', $post_id ) || retinno_consultant_terms( 'consultant_grade', $post_id ) ) : ?>
                    <div class="profile-taxonomies">
                        <?php if ( retinno_consultant_terms( 'consultant_field', $post_id ) ) : ?><div class="profile-taxonomy"><span class="profile-taxonomy__label">رشته</span><?php retinno_render_consultant_terms( 'consultant_field', $post_id ); ?></div><?php endif; ?>
                        <?php if ( retinno_consultant_terms( 'consultant_grade', $post_id ) ) : ?><div class="profile-taxonomy"><span class="profile-taxonomy__label">پایه‌های تحت پوشش</span><?php retinno_render_consultant_terms( 'consultant_grade', $post_id ); ?></div><?php endif; ?>
                    </div>
                <?php endif; ?>
                <a class="button" href="#consultant-contact">آشنایی با مراحل دریافت مشاوره <span aria-hidden="true">↓</span></a>
                <p class="profile-cta-note">روش ارتباط و ثبت درخواست مشاوره در مرحله بعدی سایت مشخص خواهد شد.</p>
            </div>
        </div>
    </section>

    <section class="section profile-details">
        <div class="container profile-layout">
            <div class="profile-main-content">
                <?php if ( $resume ) : ?><section class="profile-content-block"><span class="eyebrow">معرفی</span><h2>درباره مشاور</h2><div class="rich-content"><?php echo wp_kses_post( $resume ); ?></div></section><?php endif; ?>
                <?php if ( $education || $achievements ) : ?>
                    <div class="profile-content-columns">
                        <?php if ( $education ) : ?><section class="profile-content-block"><span class="eyebrow">پیشینه</span><h2>سوابق تحصیلی</h2><div class="rich-content"><?php echo wp_kses_post( $education ); ?></div></section><?php endif; ?>
                        <?php if ( $achievements ) : ?><section class="profile-content-block"><span class="eyebrow">تجربه‌ها</span><h2>سوابق و دستاوردها</h2><div class="rich-content"><?php echo wp_kses_post( $achievements ); ?></div></section><?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $experience ) : ?><section class="profile-content-block"><span class="eyebrow">همراهی آموزشی</span><h2>سابقه مشاوره</h2><div class="rich-content"><?php echo wp_kses_post( wpautop( $experience ) ); ?></div></section><?php endif; ?>
                <?php if ( ! $resume && ! $education && ! $achievements && ! $experience && ! get_the_content() ) : ?><section class="profile-content-block"><h2>اطلاعات این مشاور در حال تکمیل است</h2><p>جزئیات رزومه و سوابق به‌زودی در این صفحه قرار می‌گیرد.</p></section><?php endif; ?>
                <?php if ( get_the_content() ) : ?><section class="profile-content-block"><span class="eyebrow">اطلاعات تکمیلی</span><div class="rich-content"><?php the_content(); ?></div></section><?php endif; ?>
            </div>
            <aside class="profile-sidebar">
                <div class="profile-sidebar__card"><span class="profile-sidebar__icon" aria-hidden="true">R</span><h2>نگاهی به پروفایل</h2><div class="profile-sidebar__row"><span>وضعیت پذیرش</span><strong><?php echo esc_html( $capacity['label'] ); ?></strong></div><?php $experience_text = $experience ? wp_strip_all_tags( $experience ) : ''; if ( $experience_text ) : ?><div class="profile-sidebar__row"><span>سابقه مشاوره</span><strong><?php echo esc_html( $experience_text ); ?></strong></div><?php endif; ?><a class="text-link" href="<?php echo esc_url( get_post_type_archive_link( 'retinno_consultant' ) ?: home_url( '/consultants/' ) ); ?>">بازگشت به فهرست مشاوران <span aria-hidden="true">←</span></a></div>
            </aside>
        </div>
    </section>
    <section class="closing-cta closing-cta--profile" id="consultant-contact"><div class="container closing-cta__inner"><div><span class="eyebrow eyebrow--light">قدم بعدی</span><h2>برای انتخاب آگاهانه وقت بگذار.</h2><p>سوابق مشاور را بررسی کن و با درنظرگرفتن نیازها و شرایطت تصمیم بگیر.</p></div><a class="button button--light" href="<?php echo esc_url( get_post_type_archive_link( 'retinno_consultant' ) ?: home_url( '/consultants/' ) ); ?>">بازگشت به مشاوران <span aria-hidden="true">←</span></a></div></section>
</main>
<?php endwhile; get_footer(); ?>
