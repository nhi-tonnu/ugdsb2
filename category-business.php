<?php
/* template for department category*/
?>

<?php get_header(); ?>

<?php $has_left = FALSE; ?>
<?php $has_right = FALSE; ?>
<?php if (is_active_sidebar('sidebar-department') || has_nav_menu('department')) {$has_left = TRUE;} ?>
<?php //if (is_active_sidebar('sidebar-right') || has_nav_menu('right')) {$has_right = TRUE;} ?>


<?php if (!is_front_page()) {$has_left = TRUE;} ?>




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



      <h1 class="headings"><?php single_cat_title(); ?></h1>
      <div id="category-description">
            <?php echo category_description(); ?> 
      </div>
      
      <?php
    
      while ( have_posts() ) : the_post();
          // Include the post format-specific content template.

          get_template_part( 'content', 'category');

      
      endwhile;

      // Previous/next post navigation.
      ugdsb2_paging_nav();
    ?>

      business
      </div> <!-- end content area primary-->

<?php

    # Both sidebars
    # left column
    if (($has_left == TRUE) and ($has_right == TRUE)):
    echo '<div class="col-sm-3 col-sm-pull-7 ldiv">';
    if(is_front_page()&& ugdsb2_i_am_secondary()){
        //echo "<p>Display something here (left sidebar and right sidebar)</p>";
    }//end if
    
    if (!is_front_page()) {
          get_sidebar('department');
    }
    get_sidebar('deptmenu');
    echo '</div>';

    # Just left sidebar
    elseif (($has_left == TRUE) and ($has_right == FALSE)):
      echo '<div class="col-sm-3 col-sm-pull-9 ldiv">';
      if(is_front_page()&& ugdsb2_i_am_secondary()){
          //echo "<p>Display something here (left sidebar) - Just left sidebar</p>";
      }//end if
    
      if (!is_front_page()) {
          get_sidebar('department');//display left menu
      }
      get_sidebar('deptmenu');
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
      echo '<div class="col-sm-2 rdiv">';
      if (!is_front_page()) {
        get_sidebar('rmenu');
      }
      get_sidebar('right');
      echo '</div>';

    # Just left sidebar
      # Nothing to do

    # Just right sidebar
    elseif (($has_left == FALSE) and ($has_right == TRUE)):
      echo '<div class="col-sm-3 rdiv">';
      if (is_front_page() && ugdsb2_i_am_secondary()) {
          //echo "Echo something for the right sidebar!!";
      }
      if (!is_front_page()) {
        get_sidebar('rmenu');
      }
      
      get_sidebar('right');
      echo '</div>';

    # No sidebars
      # Nothing to do

    endif;
    ?>

  
  </div>
</div>



<div class='clear'></div>


<?php get_footer(); ?>