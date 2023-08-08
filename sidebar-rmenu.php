<?php
/**
 * The widget region on the right of the content.
 *
 * @package WordPress
 * @subpackage UGDSB secondary
 * 
*/
?>


<div id="secondary" class="widget-area" role="complementary">
<?php # If we have a menu in the 'right' menu location ... ?>



<?php if (has_nav_menu('right')){
	  wp_nav_menu(array('theme_location' => 'right', 'menu_class' => '', 'container' => false));
}?>
</div><!-- end navigation -->


			

	
        
        	
            
            
            
            
        


