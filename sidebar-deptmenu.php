<?php
/**
 * The widget region on the left or right of the content, display department menu
 *
 * @package WordPress
 * @subpackage UGDSB secondary
 * 
*/
?>
  

<?php /*if (has_nav_menu('department')){
	  wp_nav_menu(array('theme_location' => 'department', 'menu_class' => '', 'container' => false));
}*/

?>

<div id="secondary2" class="widget-area" role="complementary">
<?php # If we have a menu in the 'left' menu location ... ?>

<?php
	$siblings = get_pages(array(
      'sort_order' => 'ASC',
      'sort_column' => 'post_title',
      'hierarchical' => 0,
      'parent' => $post->post_parent,
      'post_type' => 'page',
    ));
    $children = get_pages(array(
      'sort_order' => 'ASC',
      'sort_column' => 'post_title',
      'hierarchical' => 0,
      'parent' => $post->ID,
      'post_type' => 'page',
    ));
	
	//check if the page has any child page, display them if they do
	if(count($children) > 0){ ?>
     	<div class="sub-menu-heading">
          <?php if ($post->post_parent != 0) { ?>
            <h3><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a></h3>
          <?php } else { ?>
            <h3><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
          <?php } ?>
    	</div>
    
    	<div class="sub-menu-items">
          <ul>
            <?php 
              foreach ($siblings as $sibling) {
                if ($sibling->post_parent != 0) {
                  if ($sibling->ID == $post->ID) {
                    echo '<li>';
                    echo '<strong>';
                    echo '<a href="'.get_permalink($sibling->ID).'">'.$sibling->post_title.'</a>';
                    echo '</strong>';
                  } else {
                    echo '<li>';
                    echo '<a href="'.get_permalink($sibling->ID).'">'.$sibling->post_title.'</a>';
                  }
                }
                if ($sibling->ID == $post->ID && $children) {
                  if ($post->post_parent != 0) {
                    echo '<ul class="nav_current_page_children_container">';
                  } else {
                    echo '<ul>';
                  }
                  foreach ($children as $child) {
                    echo '<li><a href="'.get_permalink($child->ID).'">'.$child->post_title.'</a></li>';
                  }
                  echo '</ul>';
                }
                if ($sibling->post_parent != 0) {
                  if ($sibling->ID == $post->ID) {
                    echo '</strong>';
                  }
                  echo '</li>';
                }
              }
            ?>
          </ul>
        </div><!-- end submenu list -->
    	<?php } else if (is_page() && ($post->post_parent)){ //it is a child page ?>
			<div class="sub-menu-heading">
          		<?php if ($post->post_parent != 0) { ?>
            	<h3><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a></h3>
          		<?php } else { ?>
            	<h3><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
          		<?php } ?>
    		</div>
    
    		<div class="sub-menu-items">
          	<ul>
            <?php 
              foreach ($siblings as $sibling) {
                if ($sibling->post_parent != 0) {
                  if ($sibling->ID == $post->ID) {
                    echo '<li>';
                    echo '<strong>';
                    echo '<a href="'.get_permalink($sibling->ID).'">'.$sibling->post_title.'</a>';
                    echo '</strong>';
                  } else {
                    echo '<li>';
                    echo '<a href="'.get_permalink($sibling->ID).'">'.$sibling->post_title.'</a>';
                  }
                }
                if ($sibling->ID == $post->ID && $children) {
                  if ($post->post_parent != 0) {
                    echo '<ul class="nav_current_page_children_container">';
                  } else {
                    echo '<ul>';
                  }
                  foreach ($children as $child) {
                    echo '<li><a href="'.get_permalink($child->ID).'">'.$child->post_title.'</a></li>';
                  }
                  echo '</ul>';
                }
                if ($sibling->post_parent != 0) {
                  if ($sibling->ID == $post->ID) {
                    echo '</strong>';
                  }
                  echo '</li>';
                }
              }
            ?>
          	</ul>
        	</div><!-- end submenu list -->
  		<?php }else {//page is parent without children, display none ?>
        	
        <?php }//else ?>
        


		<?php if ( is_active_sidebar( 'sidebar-department' ) ) : ?>
  		<div class="sidebar-left widget-area" role="complementary">
    		<?php dynamic_sidebar( 'sidebar-department' ); ?>
  		</div>
		<?php endif; ?>
</div><!-- end navigation -->




			

	
        
        	
            
            
            
            
        


