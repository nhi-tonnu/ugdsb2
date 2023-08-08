<?
/*
Description: Custom Page to display home page

*/
?>

<?php get_header(); ?>


<div id="primary-home" class="col-md-8">
    <main id="mainContent" role="main">
          <h1 class="home-headings">News &amp; Announcements</h1>
              <!-- begin EMERGENCY -->
              <?php 
			  		ugdsb_display_emergency();//emergency
			      	ugdsb_display_homenews_sec(); //not emergency but important
			  
			  ?>
              <!-- end EMERGENCY-->

<?php 

/* Query Sticky Posts, showing max of 2 sticky post */
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$sticky = get_option( 'sticky_posts' );

//sort the sticky post with newest first, 
rsort($sticky);

/* Get the 2 newest stickies (change 2 for a different number) */
$sticky = array_slice( $sticky, 0, 3 );

$sticky_args=array( 'post__in' => $sticky,
                   'ignore_sticky_posts' => 1, 
                   'orderby' => 'date'
);
$stick_query = new WP_Query($sticky_args);

//if(isset($sticky[0]) &&($paged < 2)){
	
if($stick_query->have_posts())	{
//if($stick_query->have_posts()):
while ( $stick_query->have_posts() ) : $stick_query->the_post(); 

?>
        <div class='sticky-div'>
                    <h2><?php the_title(); ?></h2>
                      <?php the_content(); ?>
        </div>  
<?php
endwhile; 
//endif; 
wp_reset_postdata();
}//end if

/*normal post exclude sticky post*/
$query_args = array(
  'post_type' => 'post',
  'category_name' => 'news',
  'post__not_in' => get_option( 'sticky_posts' ),
  'paged' => $paged
);
$the_query = new WP_Query($query_args);
if ( $the_query->have_posts() ) : 
  while ( $the_query->have_posts() ) : $the_query->the_post(); 
   get_template_part( 'content', 'home');     
   endwhile;
endif;
 
//pagination
ugdsb2_paging_nav($the_query->max_num_pages,"",$paged);
wp_reset_postdata(); 

?>

    </main><!-- #main -->
</div><!-- #primary -->

<div id="secondary" class="widget-area col-md-4" role="complementary">



<?php 
echo '<div class="widget-img"><a href="https://www.ugdsb.ca/schools/admission-registration/" target="_blank"><img src="https://www.ugdsb.ca/uploads/static/new-student-registration-button.jpg" alt="New Student Registration" /></a></div>';// kindergarten

echo '<div class="widget-img"><a href="https://www.ugdsb.ca/students/ugdsb-pathways/" target="_blank"><img src="https://ugdsb.ca/uploads/static/Pathways_button.jpg" alt="Pathways find your path" /></a></div>';//backtoschool

echo '<div class="widget-img"><a href="https://www.ugdsb.ca/schools/safe-equitable-and-inclusive-schools/equity-and-inclusive-education/" target="_blank"><img src="https://www.ugdsb.ca/wp-content/uploads/2021/04/reopening_btn-2.jpg" alt="Equity and Inclusive Education" /></a></div>';//equity button

echo '<div class="widget-img"><a href="https://sites.google.com/ugcloud.ca/mhugparents" target="_blank"><img src="https://www.ugdsb.ca/wp-content/uploads/2022/08/mhparents-button.jpg" alt="Parent Mental Health Site" /></a></div>';//mental health

echo '<div class="widget-img"><a href="https://webapps.ugdsb.on.ca/reportbullying/" target="_blank"><img src="https://www.ugdsb.ca/wp-content/uploads/2022/10/bullying_reporting_new_btn.jpg" alt="Bullying Reporting Tool" /></a></div>'; //bullying reporting tool

echo '<div class="widget-img"><a href="https://www.ugdsb.ca/parents/connected/" target="_blank"><img src="https://www.ugdsb.ca/wp-content/uploads/2021/11/ugdsb_parent_portal.jpg" alt="Parent Portal" /></a></div>';

//echo '<div class="widget-img"><a href="https://www.ugdsb.ca/parents/school-messenger-app/" target="_blank"><img src="https://www.ugdsb.ca/wp-content/uploads/school-messenger_training_button.gif" alt="Tutorials and Resources for School Messenger for Parents" /></a></div>'; 




if ( is_active_sidebar( 'sidebar-home' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-home' ); ?>
<?php endif; ?>

<?php 

//*******************Display RSS Feed from UGDSB site**************** 
if(is_front_page()){  
          ugdsb2_display_rss_feed2();
}
//******************* END Display RSS Feed from UGDSB site**************** 
?>



</div><!-- end side bar -->



<?php   get_footer();  ?>

