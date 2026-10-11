<?php
/** Site footer. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<footer class="site-footer">
    <div class="container site-footer__top">
        <div class="site-footer__brand">
            <a class="footer-wordmark" href="<?php echo esc_url( home_url( '/' ) ); ?>">RETINNO<span>رتینو</span></a>
            <p>همراهی برای ساختن مسیری آگاهانه‌تر در دوران کنکور؛ با برنامه‌ریزی، پیگیری و یادگیری مستمر.</p>
            <?php retinno_render_social_links(); ?>
        </div>
        <div class="site-footer__links">
            <h2>دسترسی سریع</h2>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer',
                'container'      => false,
                'menu_class'     => 'footer-nav__list',
                'fallback_cb'    => 'retinno_fallback_primary_menu',
                'depth'          => 1,
            ) );
            ?>
        </div>
        <div class="site-footer__contact">
            <h2>از رتینو بیشتر بدان</h2>
            <p>مشاوران را بشناس و محتوای آموزشی را در مجله رتینو دنبال کن.</p>
            <a class="text-link" href="<?php echo esc_url( get_post_type_archive_link( 'retinno_consultant' ) ?: home_url( '/consultants/' ) ); ?>">مشاهده مشاوران <span aria-hidden="true">←</span></a>
        </div>
    </div>
    <div class="container site-footer__bottom">
        <span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> RETINNO. تمامی حقوق محفوظ است.</span>
        <span>طراحی‌شده برای مسیر یادگیری بهتر</span>
    </div>
</footer>
<button class="back-to-top" type="button" aria-label="بازگشت به بالای صفحه">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 15 7-7 7 7"/></svg>
</button>
<?php wp_footer(); ?>
</body>
</html>
