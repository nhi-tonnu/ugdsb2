
<?php

/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search. */
 
 
?>
<div class="post-div clearfix">
<?php if (is_single()) :
  the_title( '<h2 class="post">', '</h2>' );
else :
  the_title( '<h2 class="post"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
endif; ?>

<?php if ('post' == get_post_type()) { ?>
<?php 
if (get_the_date() != get_the_modified_date() ){ ?>
  <p class="author">Updated <?php echo get_the_modified_date(); ?></p>
<?php
}else{
 ?>
 <p class="author">Posted <?php echo get_the_date(); ?></p>
<?php 
}//if posted date
}//if post type ?>



<?php 
$limit = 40; //limit
$content_text = get_the_content();
$exceptt= explode(' ', $content_text, $limit);


/*if(has_post_thumbnail()){
                the_post_thumbnail('spotlight-schools', array( 'class' => 'text-wrap-left hidden-xs'));
}*/
if(has_excerpt()){
   echo "<p>".the_excerpt()."</p>";
   echo '<p class="readmore"><a href="'. get_permalink() . '"><strong>Read more about</strong> <cite>'. get_the_title() .'</cite> &#187;</a></p>';

}else if(count($exceptt) >=$limit){
   echo content($limit);
   //echo "<p>".break_text(get_the_content(),$limit)."</p>";   
   //echo '<p class="readmore"><a href="'. get_permalink() . '"><strong>Read more about</strong> <cite>'. get_the_title() .'</cite> &#187;</a></p>';
}else{
                  echo "<p>".$content_text."</p>";   
}
 
 ?>
</div>


