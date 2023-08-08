<?php
/**
 * Template Name: School Council Page
 *
 * This is the template that displays School council page with school council's specific widgets
 *
 * @package ugdsb2
 */
 ?>

<?php get_header(); ?>

<?php $has_left = FALSE; ?>
<?php $has_right = FALSE; ?>
<?php if (is_active_sidebar('sidebar-council2')) {$has_left = TRUE;} ?>
<?php //if (has_nav_menu('department')) {$has_right = TRUE;} ?>

<?php $has_left= TRUE; ?>





<?php
    # Both sidebars
    # content area
    if (($has_left == TRUE) and ($has_right == TRUE)):
      echo '<div class="col-md-7 col-md-push-3" id="mainContent">';
    # Just left sidebar
    elseif (($has_left == TRUE) and ($has_right == FALSE)):
      echo '<div class="col-md-8 col-md-push-4" id="mainContent">';
    # Just right sidebar
    elseif (($has_left == FALSE) and ($has_right == TRUE)):
      echo '<div class="col-md-9" id="mainContent">';
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
    echo '<div class="col-md-3 col-md-pull-7 ldiv">';
    if(is_front_page()&& ugdsb2_i_am_secondary()){
        //echo "<p>Display something here (left sidebar and right sidebar)</p>";
    }//end if
    
    if (!is_front_page()) {
          get_sidebar('council2');
    }
    //get_sidebar('lmenu');//display left menu
    
    echo '</div>';

    # Just left sidebar
    elseif (($has_left == TRUE) and ($has_right == FALSE)):
      echo '<div class="col-md-4 col-md-pull-8 ldiv">';
      if(is_front_page()&& ugdsb2_i_am_secondary()){
          //echo "<p>Display something here (left sidebar) - Just left sidebar</p>";
      }//end if
    
      if (!is_front_page()) {
          get_sidebar('council2');//display school council widget
      }
      //get_sidebar('lmenu');//display left menu
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
