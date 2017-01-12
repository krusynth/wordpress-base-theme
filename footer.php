  <footer id="colophon" class="footer" role="contentinfo">
    <?php if ( is_active_sidebar( 'footer' )  ) : ?>
      <aside class="footer-content widget-area" role="complementary">
        <?php dynamic_sidebar( 'footer' ); ?>
      </aside><!-- .sidebar .widget-area -->
    <?php endif; ?>
  </footer><!-- .site-footer -->

<?php wp_footer(); ?>

</body>
</html>
