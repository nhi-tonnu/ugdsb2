<?php
/**
 * The menu on the left of the content for Coop
 * Contains a page menu by default.
 * Optionally, replaces page menu with custom menu.
 *
 * @package WordPress
 * @subpackage UGDSB
 * @since UGDSB 1.0
*/
?>
<?php if ( is_active_sidebar( 'sidebar-coop' ) ) : ?>
  <div id="sidebar-board" class="sidebar-left widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-coop' ); ?>
  </div>
<?php endif; ?>
