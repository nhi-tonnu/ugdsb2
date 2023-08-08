<?php
/**
 * Template Name: Coop Page
 *
 * This is the template that displays Coop pages with its specific widgets
 *
 * @package ugdsb2
 */
 ?>

<?php get_header(); ?>

<?php $has_left = FALSE; ?>
<?php $has_right = FALSE; ?>
<?php if (has_nav_menu('lmenu') || (is_active_sidebar('sidebar-coop'))) {$has_left = TRUE;} ?>
<?php //if (has_nav_menu('department')) {$has_right = TRUE;} ?>

<?php $has_left= TRUE; ?>





<?php
    # Both sidebars
    # content area
    if (($has_left == TRUE) and ($has_right == TRUE)):
      echo '<div class="col-sm-7 col-sm-push-3" id="mainContent">';
    # Just left sidebar
    elseif (($has_left == TRUE) and ($has_right == FALSE)):
      echo '<div class="col-sm-9 col-sm-push-3" id="mainContent">';
    # Just right sidebar
    elseif (($has_left == FALSE) and ($has_right == TRUE)):
      echo '<div class="col-sm-9" id="mainContent">';
    # No sidebars
    elseif (($has_left == FALSE) and ($has_right == FALSE)):
      echo '<div class="col-md-12" id="mainContent">';
    endif;
    ?>



      <?php
      // Start the Loop.
      while ( have_posts() ) : the_post();
      ?>

      <h1 class="headings"><?php the_title(); ?></h1>
        <p><?php the_content(); ?></p>
        
      <?php   
      endwhile;
      wp_reset_query();
      ?>
      </div> <!-- end content area primary-->

<?php

    # Both sidebars
    # left column
    if (($has_left == TRUE) and ($has_right == TRUE)):
    echo '<div class="col-sm-3 col-sm-pull-7 ldiv">';
    if(is_front_page()&& ugdsb2_i_am_secondary()){
        //echo "<p>Display something here (left sidebar and right sidebar)</p>";
    }//end if
    
    /*if (has_nav_menu('coop_menu')){
        wp_nav_menu(array(  
            'theme_location' => 'coop_menu',   // This will be different for you. 
            'container_id' => 'plamenu', 
            'container_class' => 'ugdsb',
            'walker' => new CSS_Menu_Maker_Walker()
        )); 
     }else{
          get_sidebar('lmenu');//display left menu, sidebar-lmenu.php
     }
    get_sidebar('coop');//display sidebar-left.php
	*/
	
	get_sidebar('coop_menu');//display left menu
      if (!is_front_page()) {
          get_sidebar('coop');//display left menu
      }
    echo '</div>';

    # Just left sidebar
    elseif (($has_left == TRUE) and ($has_right == FALSE)):
      echo '<div class="col-sm-3 col-sm-pull-9 ldiv">';
      if(is_front_page()&& ugdsb2_i_am_secondary()){
          //echo "<p>Display something here (left sidebar) - Just left sidebar</p>";
      }//end if
    
      
      get_sidebar('coop_menu');//display left menu
      if (!is_front_page()) {
          get_sidebar('coop');//display left menu
      }
	  
	 /* echo '<div class="col-sm-3 col-sm-pull-9 ldiv" id="parent">';
      if (has_nav_menu('coop_menu')){
        wp_nav_menu(array(  
            'theme_location' => 'coop_menu',   // This will be different for you. 
            'container_id' => 'plamenu', 
            'container_class' => 'ugdsb',
            'walker' => new CSS_Menu_Maker_Walker()
        )); 
      }else{
       		get_sidebar('lmenu');//display left menu, sidebar-lmenu.php
      }
      get_sidebar('coop');//display sidebar-left.php*/
      echo '</div>';

    # Just right sidebar
    elseif (($has_left == FALSE) and ($has_right == TRUE)):
      # Nothing to do

    # No sidebars
    elseif (($has_left == FALSE) and ($has_right == FALSE)):
      # Nothing to do

    endif;

 ?>




<?php
    # Both sidebars
    # right column

    if (($has_left == TRUE) and ($has_right == TRUE)):
      #nothing to do

    # Just left sidebar
      # Nothing to do

    # Just right sidebar
    elseif (($has_left == FALSE) and ($has_right == TRUE)):
       #nothing to do

    # No sidebars
      # Nothing to do

    endif;
    ?>

<?php get_footer(); ?>
