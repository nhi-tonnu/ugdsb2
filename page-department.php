<?php
/**
/**
 * Template Name: Department Page
 *
 * This is the template that displays custom widgets for Department page
 *
 * @package ugdsb2
 */
?>
<?php get_header(); ?>

<?php $has_left = FALSE; ?>
<?php $has_right = FALSE; ?>
<?php if (has_nav_menu('deptmenu') || (is_active_sidebar('sidebar-department'))) {$has_left = TRUE;} ?>
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
    get_sidebar('deptmenu');//display sidebar-department.php
    if (!is_front_page()) {
          get_sidebar('department');
    }
    
    echo '</div>';

    # Just left sidebar
    elseif (($has_left == TRUE) and ($has_right == FALSE)):
      echo '<div class="col-sm-3 col-sm-pull-9 ldiv">';
      if(is_front_page()&& ugdsb2_i_am_secondary()){
          //echo "<p>Display something here (left sidebar) - Just left sidebar</p>";
      }//end if

     
     /* if ( is_active_sidebar( 'sidebar-department' ) ){
          get_sidebar('department');//display left menu
      }else{
		   get_sidebar('deptmenu');//display department menu
	  }*/
	  if (has_nav_menu('department')){
	  		//bellows( 'main' , array( 'theme_location' => 'department' ) );  
			// get_sidebar('deptmenu');//display department menu
			//
			get_sidebar('department');//display left menu
      }
	  else{
          get_sidebar('lmenu');//display left menu, sidebar-lmenu.php
		  
      }
	   
       
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