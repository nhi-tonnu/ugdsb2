<?php
/*
* Template Name: Contact Us
*  @package ugdsb2
*/
?>



<?php get_header(); ?>


<?php
if(isset($_POST['submitted'])) {
  if(trim($_POST['contactName']) === '') {
    $nameError = 'Please enter your name.';
    $hasError = true;
  } else {
    echo $name = trim($_POST['contactName']);
  }

  if(trim($_POST['emailAddress']) === '')  {
    $emailError = 'Please enter your email address.';
    $hasError = true;
  } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['emailAddress']))) {
    $emailError = 'You entered an invalid email address.';
    $hasError = true;
  } else {
    echo $email = trim($_POST['emailAddress']);
  }

  if(trim($_POST['comments']) === '') {
    $commentError = 'Please enter a message.';
    $hasError = true;
  } else {
    if(function_exists('stripslashes')) {
      $comments = stripslashes(trim($_POST['comments']));
    } else {
      $comments = trim($_POST['comments']);
    }
  }

  if(!isset($hasError)) {
    $emailTo = get_option('tz_email');
    if (!isset($emailTo) || ($emailTo == '') ){
      $emailTo = get_option('admin_email');
    }
    $subject = '[PHP Snippets] From '.$name;
    $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
    $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

    wp_mail($emailTo, $subject, $body, $headers);
    $emailSent = true;
  }

} ?>




<?php $has_left = FALSE; ?>
<?php $has_right = FALSE; ?>
<?php //if (is_active_sidebar('sidebar-left') || has_nav_menu('left')) {$has_left = TRUE;} ?>
<?php //if (is_active_sidebar('sidebar-right') || has_nav_menu('right')) {$has_right = TRUE;} ?>


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

      <!-- form begin -->
<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
  <ul>
    <li>
      <label for="contactName">Name:</label>
      <input type="text" name="contactName" id="contactName" value="" />
    </li>
    <li>
      <label for="emailAddress">Email</label>
      <input type="text" name="emailAddress" id="email" value="" />
    </li>
    <li>
      <label for="commentsText">Message:</label>
      <textarea name="comments" id="commentsText" rows="20" cols="30"></textarea>
    </li>
    <li>
      <button type="submit">Send email</button>
    </li>
  </ul>
  <input type="hidden" name="submitted" id="submitted" value="true" />
</form>






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
          get_sidebar('lmenu');//display left menu, sidebar-lmenu.php
    }
    get_sidebar('left');//display sidebar-left.php
    echo '</div>';

    # Just left sidebar
    elseif (($has_left == TRUE) and ($has_right == FALSE)):
      echo '<div class="col-sm-3 col-sm-pull-9 ldiv">';
      if(is_front_page()&& ugdsb2_i_am_secondary()){
          //echo "<p>Display something here (left sidebar) - Just left sidebar</p>";
      }//end if
    
      if (!is_front_page()) {
          get_sidebar('lmenu');//display left menu
      }
      get_sidebar('left');//display sidebar-left.php
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


