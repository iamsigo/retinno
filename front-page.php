<?php
/**
 * Front page template — RETINNO signature experience.
 *
 * @package RETINNO_Theme
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$consultants_url = get_post_type_archive_link( 'retinno_consultant' ) ?: home_url( '/consultants/' );
$posts_page_id   = (int) get_option( 'page_for_posts' );
$blog_url        = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' );
$about_url       = retinno_get_page_url( 'about', '/about/' );
?>
<main id="main-content" class="retinno-home">
    <section class="hero-section hero-section--signature" aria-labelledby="home-hero-title">
        <div class="container hero-grid">
            <div class="hero-copy" data-reveal>
                <span class="hero-kicker"><span class="hero-kicker__pulse" aria-hidden="true"></span> همراه هوشمند مسیر کنکور <span class="hero-kicker__en">RETINNO / 01</span></span>
                <h1 id="home-hero-title">مسیر کنکور،<br><span>واضح‌تر از همیشه.</span></h1>
                <p class="hero-description">قرار نیست از روز اول تمام راه را بدانی. از شناخت نقطه فعلی شروع کن، قدم بعدی را آگاهانه انتخاب کن و در طول مسیر، بر اساس نتیجه‌هایت پیش برو.</p>
                <div class="hero-actions">
                    <a class="button hero-primary-cta" href="#pathfinder">از کجا شروع کنم؟ <span aria-hidden="true">←</span></a>
                    <a class="button button--ghost" href="<?php echo esc_url( $consultants_url ); ?>">مشاوران رتینو <span aria-hidden="true">↗</span></a>
                </div>
                <div class="hero-signature">
                    <span class="hero-signature__mark" aria-hidden="true"><img src="<?php echo esc_url( RETINNO_THEME_URI . '/assets/images/retinno-mark-light.png' ); ?>" alt="" width="30" height="27"></span>
                    <span><strong>مسیر را واضح‌تر کن</strong><small>Make the path clearer.</small></span>
                    <span class="hero-signature__line" aria-hidden="true"></span>
                </div>
            </div>

            <div class="hero-visual hero-visual--dashboard" role="img" aria-label="نمای مفهومی رتینو از مسیر یادگیری؛ شناخت وضعیت، برنامه‌ریزی و بازبینی پیشرفت" data-reveal data-reveal-delay="120">
                <div class="hero-visual__halo hero-visual__halo--one" aria-hidden="true"></div>
                <div class="hero-visual__halo hero-visual__halo--two" aria-hidden="true"></div>
                <div class="hero-dashboard">
                    <div class="hero-dashboard__topbar">
                        <span class="hero-dashboard__wordmark"><i aria-hidden="true"></i> RETINNO <span>/ PATH SYSTEM</span></span>
                        <span class="hero-dashboard__badge"><b aria-hidden="true"></b> نمای مفهومی</span>
                    </div>
                    <div class="hero-dashboard__heading">
                        <div><span class="hero-dashboard__eyebrow">YOUR NEXT STEP</span><h2>قدم بعدی،<br>نه تمام مسیر.</h2></div>
                        <span class="hero-dashboard__index" aria-hidden="true">R<br><i>01</i></span>
                    </div>
                    <div class="hero-path-art" aria-hidden="true">
                        <svg viewBox="0 0 520 190" preserveAspectRatio="xMidYMid meet" focusable="false">
                            <defs>
                                <linearGradient id="retinno-path-gradient" x1="0" y1="1" x2="1" y2="0"><stop offset="0" stop-color="#3B82F6" stop-opacity=".25"/><stop offset=".52" stop-color="#60A5FA"/><stop offset="1" stop-color="#BFDBFE"/></linearGradient>
                                <filter id="retinno-path-glow" x="-60%" y="-60%" width="220%" height="220%"><feGaussianBlur stdDeviation="6" result="blur"/><feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
                            </defs>
                            <path class="hero-path-art__underlay" d="M24 153 C95 153 97 107 169 118 S259 151 302 94 S389 73 493 28"/>
                            <path class="hero-path-art__path" d="M24 153 C95 153 97 107 169 118 S259 151 302 94 S389 73 493 28"/>
                            <path class="hero-path-art__trail" d="M24 153 C95 153 97 107 169 118 S259 151 302 94 S389 73 493 28"/>
                            <circle class="hero-path-art__ring" cx="24" cy="153" r="13"/><circle class="hero-path-art__node" cx="24" cy="153" r="5"/>
                            <circle class="hero-path-art__ring" cx="169" cy="118" r="13"/><circle class="hero-path-art__node" cx="169" cy="118" r="5"/>
                            <circle class="hero-path-art__ring" cx="302" cy="94" r="13"/><circle class="hero-path-art__node" cx="302" cy="94" r="5"/>
                            <circle class="hero-path-art__ring hero-path-art__ring--final" cx="493" cy="28" r="16"/><circle class="hero-path-art__node hero-path-art__node--final" cx="493" cy="28" r="6"/>
                        </svg>
                        <span class="hero-path-art__coordinate hero-path-art__coordinate--start">START / HERE</span>
                        <span class="hero-path-art__coordinate hero-path-art__coordinate--end">NEXT / STEP</span>
                    </div>
                    <div class="hero-dashboard__steps">
                        <div class="hero-dashboard-step"><span>01</span><strong>شناخت</strong><small>نقطه شروع</small></div>
                        <div class="hero-dashboard-step"><span>02</span><strong>برنامه</strong><small>قدم بعدی</small></div>
                        <div class="hero-dashboard-step"><span>03</span><strong>بازبینی</strong><small>بهبود مسیر</small></div>
                    </div>
                    <div class="hero-dashboard__footer"><span><i aria-hidden="true"></i> مسیر شخصی، نه نسخه یکسان</span><span class="hero-dashboard__footer-code">RT / 001</span></div>
                </div>
                <div class="hero-float-note hero-float-note--top" aria-hidden="true"><span class="hero-float-note__symbol">↗</span><span><small>FOCUS</small><strong>قدم بعدی روشن</strong></span></div>
            </div>
        </div>
        <div class="container hero-principles" aria-label="اصول رویکرد رتینو">
            <div class="hero-principle"><span>01</span><p><strong>از نقطه فعلی شروع کن</strong><small>نه از یک برنامه آماده برای همه</small></p></div>
            <div class="hero-principle"><span>02</span><p><strong>قدم بعدی را مشخص کن</strong><small>هدف‌های روشن و قابل پیگیری</small></p></div>
            <div class="hero-principle"><span>03</span><p><strong>مسیر را دوباره بررسی کن</strong><small>یادگیری بر اساس تجربه واقعی</small></p></div>
        </div>
        <div class="hero-section__gridline" aria-hidden="true"></div>
    </section>

    <section class="section intro-section" id="approach" aria-labelledby="approach-title">
        <div class="container intro-grid">
            <div class="section-heading" data-reveal>
                <span class="eyebrow"><span class="eyebrow__dash" aria-hidden="true"></span> رویکرد رتینو / ۰۱</span>
                <h2 id="approach-title">فقط برنامه نمی‌چینیم؛<br><span>مسیر را دنبال می‌کنیم.</span></h2>
            </div>
            <div class="intro-copy" data-reveal data-reveal-delay="100"><p>برنامه زمانی ارزشمند است که با شرایط واقعی تو هماهنگ باشد. رتینو به جای یک نسخه ثابت، روی شناخت، برنامه‌ریزی و بازبینی تأکید می‌کند؛ تا بتوانی بفهمی کجا هستی و قدم بعدی‌ات چه می‌تواند باشد.</p><a class="text-link" href="<?php echo esc_url( $about_url ); ?>">بیشتر درباره رتینو <span aria-hidden="true">←</span></a></div>
        </div>
        <div class="container feature-grid">
            <article class="feature-card" data-reveal>
                <span class="feature-index">01 <i> / UNDERSTAND</i></span>
                <div class="feature-icon" aria-hidden="true"><svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="17"/><circle cx="24" cy="24" r="8"/><path d="M24 3v8M24 37v8M3 24h8M37 24h8"/></svg></div>
                <h3>شناخت دقیق‌تر</h3><p>شرایط، هدف‌ها و چالش‌ها را بهتر بشناس تا تصمیم‌هایت بر پایه واقعیت باشند.</p><span class="feature-card__corner" aria-hidden="true">↙</span>
            </article>
            <article class="feature-card" data-reveal data-reveal-delay="90">
                <span class="feature-index">02 <i> / PLAN</i></span>
                <div class="feature-icon" aria-hidden="true"><svg viewBox="0 0 48 48" fill="none"><path d="M8 38V10h32v28H8Z"/><path d="M15 18h18M15 24h12M15 30h15"/><path d="m29 33 4 4 8-9"/></svg></div>
                <h3>برنامه قابل اجرا</h3><p>برنامه‌ریزی باید با زمان، توان و وضعیت درسی تو هماهنگ باشد؛ نه فقط روی کاغذ خوب به نظر برسد.</p><span class="feature-card__corner" aria-hidden="true">↙</span>
            </article>
            <article class="feature-card" data-reveal data-reveal-delay="180">
                <span class="feature-index">03 <i> / REFINE</i></span>
                <div class="feature-icon" aria-hidden="true"><svg viewBox="0 0 48 48" fill="none"><path d="M7 37V11M7 37h34"/><path d="m12 31 9-9 7 5 11-15"/><circle cx="39" cy="12" r="3"/></svg></div>
                <h3>پیگیری و بهبود</h3><p>با مرور عملکرد و اصلاح برنامه، مسیرت را به‌مرور با نیازها و نتیجه‌ها هماهنگ‌تر کن.</p><span class="feature-card__corner" aria-hidden="true">↙</span>
            </article>
        </div>
    </section>

    <section class="pathfinder-section" id="pathfinder" aria-labelledby="pathfinder-title">
        <div class="container pathfinder-grid">
            <div class="pathfinder-copy" data-reveal>
                <span class="eyebrow eyebrow--light"><span class="eyebrow__dash" aria-hidden="true"></span> نقطه شروع تو / ۰۲</span>
                <h2 id="pathfinder-title">الان کدام قدم،<br><span>مهم‌تر است؟</span></h2>
                <p>لازم نیست همین حالا برای همه مسیر تصمیم بگیری. نزدیک‌ترین وضعیت به خودت را انتخاب کن تا یک قدم برای شروع پیشنهاد شود.</p>
                <div class="pathfinder-note"><span class="pathfinder-note__icon" aria-hidden="true">i</span><span>این راهنمای کوتاه، اطلاعاتی ذخیره نمی‌کند و جایگزین مشاوره شخصی نیست؛ فقط کمک می‌کند از یک نقطه شروع کنی.</span></div>
            </div>
            <div class="pathfinder-widget" data-reveal data-reveal-delay="130">
                <div class="pathfinder-widget__top"><span><i aria-hidden="true"></i> FIND YOUR NEXT STEP</span><span>۰۱ — ۰۳</span></div>
                <p class="pathfinder-widget__question">بیشتر شبیه کدام وضعیت هستی؟</p>
                <div class="pathfinder-tabs" role="tablist" aria-label="انتخاب وضعیت فعلی">
                    <button class="pathfinder-tab is-active" type="button" role="tab" id="path-tab-start" aria-selected="true" aria-controls="path-panel-start" tabindex="0" data-path-choice="start"><span>01</span><strong>هنوز مطمئن نیستم</strong><i aria-hidden="true">↙</i></button>
                    <button class="pathfinder-tab" type="button" role="tab" id="path-tab-plan" aria-selected="false" aria-controls="path-panel-plan" tabindex="-1" data-path-choice="plan"><span>02</span><strong>به برنامه نیاز دارم</strong><i aria-hidden="true">↙</i></button>
                    <button class="pathfinder-tab" type="button" role="tab" id="path-tab-review" aria-selected="false" aria-controls="path-panel-review" tabindex="-1" data-path-choice="review"><span>03</span><strong>می‌خواهم بهتر بررسی کنم</strong><i aria-hidden="true">↙</i></button>
                </div>
                <div class="pathfinder-results" aria-live="polite" aria-atomic="true">
                    <section class="pathfinder-result" role="tabpanel" id="path-panel-start" aria-labelledby="path-tab-start" data-path-panel="start">
                        <span class="pathfinder-result__eyebrow">SUGGESTED FIRST STEP / 01</span><h3>اول تصویر واضح‌تری بساز.</h3><p>قبل از تغییرهای بزرگ، هدفت، وضعیت فعلی درس‌ها و چالش اصلی‌ات را مشخص کن. شروع خوب از یک شناخت واقع‌بینانه می‌آید.</p>
                        <div class="pathfinder-result__next"><span>پیشنهاد برای شروع</span><a class="button" href="<?php echo esc_url( $blog_url ); ?>">مطالب آموزشی را ببین <span aria-hidden="true">←</span></a></div>
                    </section>
                    <section class="pathfinder-result" role="tabpanel" id="path-panel-plan" aria-labelledby="path-tab-plan" data-path-panel="plan" hidden>
                        <span class="pathfinder-result__eyebrow">SUGGESTED FIRST STEP / 02</span><h3>برنامه را با شرایطت هماهنگ کن.</h3><p>زمان در دسترس، اولویت درس‌ها و نقطه‌های دشوار باید در برنامه دیده شوند. برنامه‌ای بهتر است که بتوانی اجرا و بازبینی‌اش کنی.</p>
                        <div class="pathfinder-result__next"><span>پیشنهاد برای شروع</span><a class="button" href="<?php echo esc_url( $consultants_url ); ?>">مشاوران را بشناس <span aria-hidden="true">←</span></a></div>
                    </section>
                    <section class="pathfinder-result" role="tabpanel" id="path-panel-review" aria-labelledby="path-tab-review" data-path-panel="review" hidden>
                        <span class="pathfinder-result__eyebrow">SUGGESTED FIRST STEP / 03</span><h3>به نتیجه‌ها نگاه کن، نه فقط ساعت‌ها.</h3><p>مرور کیفیت مطالعه، تست‌ها و بخش‌هایی که هنوز دشوارند می‌تواند نشان بدهد چه چیزی نیاز به تغییر دارد.</p>
                        <div class="pathfinder-result__next"><span>پیشنهاد برای شروع</span><a class="button" href="<?php echo esc_url( $blog_url ); ?>">روش‌های مطالعه را بخوان <span aria-hidden="true">←</span></a></div>
                    </section>
                </div>
                <div class="pathfinder-widget__footer"><span><b aria-hidden="true"></b> بدون ثبت اطلاعات شخصی</span><span>RETINNO / GUIDE</span></div>
            </div>
        </div>
        <div class="pathfinder-decoration" aria-hidden="true">R<span>—</span>03</div>
    </section>

    <section class="section consultants-section" id="consultants" aria-labelledby="consultants-title">
        <div class="container section-header-row">
            <div class="section-heading" data-reveal><span class="eyebrow"><span class="eyebrow__dash" aria-hidden="true"></span> همراهان مسیر / ۰۳</span><h2 id="consultants-title">آدم‌های مسیرت را<br><span>با شناخت انتخاب کن.</span></h2><p>سوابق، زمینه فعالیت و وضعیت پذیرش هر مشاور را ببین و آگاهانه‌تر انتخاب کن.</p></div>
            <a class="button button--secondary section-header-action" href="<?php echo esc_url( $consultants_url ); ?>">دیدن همه مشاوران <span aria-hidden="true">←</span></a>
        </div>
        <div class="container">
            <?php
            $consultant_query = new WP_Query( array( 'post_type' => 'retinno_consultant', 'posts_per_page' => 3, 'post_status' => 'publish', 'no_found_rows' => true ) );
            if ( $consultant_query->have_posts() ) : ?>
                <div class="consultant-grid consultant-grid--home">
                    <?php while ( $consultant_query->have_posts() ) : $consultant_query->the_post(); get_template_part( 'template-parts/consultant-card' ); endwhile; ?>
                </div>
            <?php else : ?>
                <div class="empty-state empty-state--consultants"><span class="empty-state__mark">R</span><span class="empty-state__eyebrow">THE PEOPLE BEHIND THE PATH</span><h3>همراهان رتینو در راه‌اند.</h3><p>پس از ثبت و انتشار پروفایل مشاوران، معرفی آن‌ها به‌صورت خودکار در این بخش نمایش داده می‌شود.</p><a class="text-link" href="<?php echo esc_url( $consultants_url ); ?>">رفتن به صفحه مشاوران <span aria-hidden="true">←</span></a></div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>

    <section class="section journal-section" id="journal" aria-labelledby="journal-title">
        <div class="container section-header-row">
            <div class="section-heading" data-reveal><span class="eyebrow"><span class="eyebrow__dash" aria-hidden="true"></span> مجله رتینو / ۰۴</span><h2 id="journal-title">دانش بیشتر،<br><span>تصمیم بهتر.</span></h2><p>ایده‌ها و راهنماهایی برای بهتر درس خواندن، برنامه‌ریزی و شناخت مسیر کنکور.</p></div>
            <a class="text-link section-header-action" href="<?php echo esc_url( $blog_url ); ?>">رفتن به مجله <span aria-hidden="true">←</span></a>
        </div>
        <div class="container article-grid">
            <?php
            $latest_posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3, 'post_status' => 'publish', 'no_found_rows' => true ) );
            if ( $latest_posts->have_posts() ) :
                while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); get_template_part( 'template-parts/article-card' ); endwhile;
            else : ?>
                <div class="empty-state empty-state--wide"><span class="empty-state__eyebrow">THE RETINNO JOURNAL</span><h3>اولین مقاله‌ها به‌زودی اینجا هستند.</h3><p>مقاله‌های آموزشی رتینو بعد از انتشار به‌صورت خودکار نمایش داده می‌شوند.</p></div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>

    <section class="faq-section" aria-labelledby="faq-title">
        <div class="container faq-grid">
            <div class="faq-intro" data-reveal><span class="eyebrow"><span class="eyebrow__dash" aria-hidden="true"></span> پرسش‌های پرتکرار</span><h2 id="faq-title">قبل از شروع،<br><span>این‌ها را بدان.</span></h2><p>برای آشنایی با رویکرد رتینو، از پرسش‌های رایج شروع کن.</p><a class="text-link" href="<?php echo esc_url( $about_url ); ?>">آشنایی بیشتر با رتینو <span aria-hidden="true">←</span></a></div>
            <div class="faq-list" data-reveal data-reveal-delay="100">
                <details class="faq-item"><summary><span>رتینو فقط برنامه‌ریزی درسی انجام می‌دهد؟</span><i aria-hidden="true"></i></summary><div class="faq-item__answer"><p>نگاه رتینو فراتر از نوشتن برنامه است: شناخت وضعیت، برنامه‌ریزی متناسب و بازبینی مسیر در کنار هم معنا پیدا می‌کنند. جزئیات همراهی را در معرفی مشاوران و صفحات خدمات دنبال کن.</p><a href="<?php echo esc_url( $about_url ); ?>">رویکرد رتینو <span aria-hidden="true">←</span></a></div></details>
                <details class="faq-item"><summary><span>از کجا بفهمم کدام مشاور برای من مناسب است؟</span><i aria-hidden="true"></i></summary><div class="faq-item__answer"><p>زمینه فعالیت، سوابق تحصیلی، تجربه مشاوره و وضعیت پذیرش را در پروفایل‌ها بررسی کن. انتخاب نهایی بهتر است با نیازها و شرایط شخصی تو هماهنگ باشد.</p><a href="<?php echo esc_url( $consultants_url ); ?>">مشاهده پروفایل مشاوران <span aria-hidden="true">←</span></a></div></details>
                <details class="faq-item"><summary><span>اگر هنوز برنامه یا هدف دقیقی ندارم چه؟</span><i aria-hidden="true"></i></summary><div class="faq-item__answer"><p>لازم نیست همه چیز از ابتدا قطعی باشد. با مرور وضعیت فعلی و مطالعه راهنماهای آموزشی شروع کن؛ سپس می‌توانی درباره قدم بعدی تصمیم دقیق‌تری بگیری.</p><a href="<?php echo esc_url( $blog_url ); ?>">شروع از مجله رتینو <span aria-hidden="true">←</span></a></div></details>
            </div>
        </div>
    </section>

    <section class="closing-cta closing-cta--signature" aria-labelledby="closing-title">
        <div class="container closing-cta__inner"><div data-reveal><span class="eyebrow eyebrow--light"><span class="eyebrow__dash" aria-hidden="true"></span> قدم بعدی تو</span><h2 id="closing-title">لازم نیست همه راه را بدانی.<br><span>از قدم بعدی شروع کن.</span></h2><p>مشاوران و مطالب آموزشی رتینو را ببین و مسیرت را با شناخت بیشتری ادامه بده.</p></div><a class="button button--light" href="#pathfinder">پیدا کردن نقطه شروع <span aria-hidden="true">↑</span></a></div>
        <div class="closing-cta__orb closing-cta__orb--one" aria-hidden="true"></div><div class="closing-cta__orb closing-cta__orb--two" aria-hidden="true"></div><div class="closing-cta__code" aria-hidden="true">RETINNO / MAKE THE PATH CLEARER</div>
    </section>
</main>
<?php get_footer(); ?>
