<?php


if ( ! isset( $content_width ) ) {
	$content_width = 740; /* pixels */
}

/**
 * Set the content width for full width pages with no sidebar.
 */
function ugdsb2_content_width() {
  if ( is_page_template( 'page-fullwidth.php' ) || is_page_template( 'front-page.php' ) ) {
    global $content_width;
    $content_width = 1140; /* pixels */
  }
}
add_action( 'template_redirect', 'ugdsb2_content_width' );

if ( ! function_exists( 'ugdsb2_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ugdsb2_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change 'unite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ugdsb2', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	// Enable support for Post Formats.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	//add_theme_support( 'post-formats', array( 'image' ) );
	
	
	// Enable support for Featured Images (Post Thumbnails) in pages and posts, and declare sizes.
  	//add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	add_theme_support('post-thumbnails');
	
  	set_post_thumbnail_size( 165, 9999);
	add_image_size('tab-small', 165, 9999);
	add_image_size( 'ugdsb2-featured', 1170, 410, false);
  	add_image_size('spotlight-schools',200, 9999, false);

	
	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );

	// Add theme support for custom CSS in the TinyMCE visual editor
	
	//Nhi March 29, 2016 force tinymce to show in visual setting first
	add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );
	
	//Nhi added July11, 2019 to disable Gutenberg editor
	add_filter('use_block_editor_for_post', '__return_false');
	
	//Nhi added Jan1, 2022 for remove Widget block Editor
	add_filter( 'use_widgets_block_editor', '__return_false' );
	
	/*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
	add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list',
	) );
		
	// register navigation
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ugdsb2' ),
		'department' => __( 'Department Menu', 'ugdsb2' ),
    	'guidance_menu'  => __( 'Guidance Menu', 'ugdsb2' ),
		'coop_menu'  => __( 'Coop Menu', 'ugdsb2' ),
		//'footer-links' => __( 'Footer Menu', 'ugdsb2' ), 
		//'left' => __( 'Left Menu', 'ugdsb2' ),
		//'right' => __( 'Right Menu', 'ugdsb2' ),
	) );
	
}
endif; //ugdsb2_setup
add_action('after_setup_theme', 'ugdsb2_setup');



function ugdsb2_scripts() {
	wp_register_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css');
	wp_register_style( 'custom-style', get_template_directory_uri() . '/css/style.css');	
	//wp_register_style( 'bootstrap-style' , 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
	wp_register_style('datatables_style', 'https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css');//for datatables
	

	//wp_register_style( 'custom-style-button', get_template_directory_uri() . '/css/button.css');//button
	//wp_register_style( 'custom-style-icon', get_template_directory_uri() . '/css/icon-styles.css');//icon style
	wp_register_style( 'ugdsb-icons', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');// Add Font Awesome stylesheet
	wp_register_style( 'ugdsb-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400,700,600|Amarante|Catamaran|Open+Sans+Condensed|Roboto+Slab|Loster|Oxygen|Fenix|Oswald|Merriweather|Calibri');
	 
	wp_enqueue_style('bootstrap-style'); 
	wp_enqueue_style('custom-style');  
	 
	wp_enqueue_style('datatables_style');  
	//wp_enqueue_style('custom-style-button');  
	//wp_enqueue_style('custom-style-icon');  
	wp_enqueue_style('ugdsb-icons');  
	wp_enqueue_style('ugdsb-fonts');  
	
	//wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.5.1.js');//Feb17-2022
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, null);
	wp_register_script( 'custom-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
    wp_register_script( 'datatable-script', 'https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js');
	wp_register_script( 'smoothup', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), '',  true );
	

	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'custom-script');
    wp_enqueue_script( 'datatable-script');
	wp_enqueue_script( 'smoothup' );
	
	
	

}//end
add_action( 'wp_enqueue_scripts', 'ugdsb2_scripts',10);

/**
*	custom background
*
*/
function ugdsb2_custom_background() {
    $args = array(
        'default-color' => 'FFFFFF',
    );
 
    $args = apply_filters( 'ugdsb2_custom_background_args', $args );
 
    if ( function_exists( 'wp_get_theme' ) ) {
        add_theme_support( 'custom-background', $args );
    } else {
        define( 'BACKGROUND_COLOR', $args['default-color'] );
        define( 'BACKGROUND_IMAGE', $args['default-image'] );
        add_custom_background();
    }
}
add_action( 'after_setup_theme', 'ugdsb2_custom_background' );




/**
 * Register widgetized area and update sidebar with default widgets.
 */

function ugdsb2_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Page Sidebar (Right)', 'ugdsb2' ),
		'id'            => 'sidebar-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar (Left)', 'ugdsb2' ),
		'id'            => 'sidebar-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	register_sidebar( array(
    'name'          => __( 'Extra Curricular Sidebar', 'ugdsb2' ),
    'id'            => 'sidebar-council',
    'description'   => __( 'Widgets for Extra Curricular Page only', 'ugdsb2' ),
    'before_widget' => '<div class="sidebar-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  	));

	register_sidebar( array(
    'name'          => __( 'School Council Sidebar', 'ugdsb2' ),
    'id'            => 'sidebar-council2',
    'description'   => __( 'Widgets for School Council Page only', 'ugdsb2' ),
    'before_widget' => '<div class="sidebar-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  	));

  
  	register_sidebar(array(
		'id'            => 'sidebar-home',
		'name'          => 'Homepage Sidebar',
		'description'   => 'Used only on the homepage page template.',
		'before_widget' => '<div id="%1$s" class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
  	));
	register_sidebar(array(
		'id'            => 'sidebar-department',
		'name'          => 'Department Widget',
		'description'   => 'Used only on the Department Page.',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
  	));
	register_sidebar(array(
		'id'            => 'sidebar-aboutus',
		'name'          => 'Our School Widget',
		'description'   => 'Used only on the Our School Page.',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
  	));

  	register_sidebar(array(
		'id'            => 'sidebar-student-supports',
		'name'          => 'Student Supports Widget',
		'description'   => 'Used only on the Student Support Page.',
		'before_widget' => '<div id="%1$s" class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
  	));

  	register_sidebar(array(
		'id'            => 'sidebar-library',
		'name'          => 'Library Widget',
		'description'   => 'Used only on the Library pages.',
		'before_widget' => '<div id="%1$s" class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
  	));
  	register_sidebar(array(
		'id'            => 'sidebar-music',
		'name'          => 'Music Dept Widget',
		'description'   => 'Used only on the Music pages.',
		'before_widget' => '<div id="%1$s" class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
  	));
  	register_sidebar(array(
		'id'            => 'sidebar-english',
		'name'          => 'English Dept Widget',
		'description'   => 'Used only on the English pages.',
		'before_widget' => '<div id="%1$s" class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
  	));

  	register_sidebar(array(
		'id'            => 'sidebar-guidance',
		'name'          => 'Guidance Widget',
		'description'   => 'Used only on the Guidance pages.',
		'before_widget' => '<div id="%1$s" class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
  	));

	register_sidebar(array(
		'id'            => 'sidebar-coop',
		'name'          => 'Coop Widget',
		'description'   => 'Used only on the Coop pages.',
		'before_widget' => '<div id="%1$s" class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
  	));
  	register_sidebar(array(
		'id'            => 'sidebar-footer',
		'name'          => 'Footer Widget',
		'description'   => 'Used only on the Footer.',
		'before_widget' => '<div id="%1$s" class="footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
  	));
 
  //register_widget( 'unite_popular_posts_widget' );
}
add_action( 'widgets_init', 'ugdsb2_widgets_init' );


// Implement Custom Header features.
// http://codex.wordpress.org/Custom_Headers
//require get_template_directory() . '/inc/custom-header.php';
$custom_header_options = array(
  	'width'                  => 1170,
  	'flex-width'             => false,
  	'height'                 => 250,
  	'flex-height'            => false,
  	'default-image'        => get_template_directory_uri() . '/images/header.jpg',
  	'default-image'          => '',
 	'uploads'                => true,
 	'random-default'         => false,
 	'default-text-color'     => '',
 	'header-text'            => true,
 	'wp-head-callback'       => '',
 	'admin-head-callback'    => '',
  	'admin-preview-callback' => '',
);
add_theme_support('custom-header', $custom_header_options);


/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/admin/' );
require_once dirname( __FILE__ ) . '/inc/admin/options-framework.php';
// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );


/***********************************************************************
*			breadcrumb
***********************************************************************/
function the_breadcrumb() {
  global $post;
  echo '<div class="container-breadcrumb">';
  echo '<ol class="breadcrumb">';
  if (!is_front_page()) {
    echo '<li>';
    echo '<a href="';
    echo get_option('home');
    echo '">';
    echo 'Home';
    echo '</a>';
    echo '</li>';
    if (is_single()) {
      echo '<li><a href="'.ugdsb2_posts_page_url().'">News</a></li>';
      echo '<li>';
      the_title();
      echo '</li>';
    } elseif (is_page()) {
      if($post->post_parent){
        $anc = get_post_ancestors( $post->ID );
        $title = get_the_title();
        $output = '';
        foreach ( $anc as $ancestor ) {
          $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>'.$output;
        }
        echo $output;
        echo '<li>'.$title.'</li>';
      } else {
        echo '<li>'.get_the_title().'</li>';
      }
    } elseif (is_home()) {
      echo '<li>News &amp; Announcements</li>';
    }
  }
  elseif (is_tag()) {single_tag_title();}
  elseif (is_category()) {echo"<li>"; the_category(); echo'</li>';}
  elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
  elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
  elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
  elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
  elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
  elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
  echo '</ol>';
  echo '</div>';
}
function ugdsb2_posts_page_url() {
  if (get_option('show_on_front') == 'page') {
    return get_permalink(get_option('page_for_posts'));
  } else {
    return get_bloginfo('url');
  }
}

//add search
function ugdsb2_wpsearch( $form ) {
    $form = '<form method="get" class="form-search" action="' . home_url( '/' ) . '">
  <div class="row">
    <div class="col-lg-12">
      <div class="input-group">
        <input type="text" class="form-control search-query" value="' . get_search_query() . '" name="s" id="s" placeholder="'. esc_attr__('Search...','ugdsb2') .'">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="Go"><span class="glyphicon glyphicon-search"></span></button>
        </span>
      </div>
    </div>
  </div>
</form>';
    return $form;
} 
add_filter( 'get_search_form', 'ugdsb2_wpsearch' );


//body class
function ugdsb2_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	return $classes;
}
add_filter( 'body_class', 'ugdsb2_body_classes' );



//custom header
//require get_template_directory() . '/inc/custom-header.php';

//Bootstrap navigation
require_once(get_template_directory().'/inc/wp_bootstrap_navwalker.php');
//require_once(get_template_directory().'/inc/yamm-nav-walker.php');//nhi oct20,2016

//adding logo
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

/**
 * Filter the except length to 100 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function ugdsb2_custom_excerpt_length( $length ) {
    return 60;
}
add_filter( 'excerpt_length', 'ugdsb2_custom_excerpt_length', 999 );


/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
/*function wpdocs_excerpt_more( $more ) {
    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );*/




/*limit the display of post/page content*/
function content($limit) {
	global $post;
  	$content = explode(' ', get_the_content(), $limit);
  	if (count($content)>= $limit) {
    	array_pop($content);
    	//$content = implode(" ",$content).' ... <a href="'. get_permalink($post->ID) . '">Read more</a>';
  		$content = implode(" ",$content);
      $content = strip_tags($content, '<p><caption><img><a>'); //allow these tags and not <i><b>
  		$content .= " ...";
  		$content .= '<p class="readmore"><a href="'. get_permalink($post->ID) . '">Read more about <cite>'. get_the_title($post->ID) .'</cite> &#187;</a></p>';
  	
  }else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
/******************************************************************
*  Function to display a teaser of Board news
*****************************************************************/
function break_text($text, $length){

    if(strlen($text)<$length+10) return $text;//don't cut if too short

    $break_pos = strpos($text, ' ', $length);//find next space after desired length
    $visible = substr($text, 0, $break_pos);
    return $visible . " […]";
} 



/*************************************************************************
* Get the posts/news from main site, blogID is 1, 
* Category ID for Elementary is 4, Category ID for Secondary is 3
*************************************************************************/
function ugdsb2_display_rss_feed2(){

    global $switched;
    switch_to_blog(1); //switched to blog id 1
  
 
    // Get latest Post
    $latest_posts = get_posts('category=3&posts_per_page=4');
    $cnt =count($latest_posts);
  
   if($cnt != 0){
        echo "<div id='feedzy_wp_widget-2' class='sidebar-widget'>";
        echo "<h3 class='widget-title'>Board News </h3>";
        echo "<div class='feedzy-rss'>";
        foreach($latest_posts as $post) : setup_postdata($post);
            echo "<div class='feed-item'>";
            //echo "<h4><a href='".get_page_link($post->ID)."' title='".$post->post_title."' >";


            echo "<h4><a href='".get_post_permalink($post->ID)."' title='".$post->post_title."' >";
            echo $post->post_title."</a></h4>";
            //echo "<p style='font-size: 0.9em;'>".substr(get_the_excerpt(), 0, 160). ' [...]'."</p>";
            //echo break_text($post->post_content,160);      

            if(has_excerpt($post->ID)){
                  echo "<p style='font-size: 0.9em;'>".$post->post_excerpt."</p>";
            }else{
                 //echo "<p style='font-size: 0.9em;'>".$post->post_content."</p>";  
                  echo "<p style='font-size:0.9em;'>".break_text($post->post_content,160)."</p>";   
            }
            echo "</div>";          
        endforeach; 
        echo "</div>";
        echo "</div>";
    }//if there are some posts then display                        
    
    restore_current_blog(); //switched back to main site 
}//end 





//to add https onto the function get_theme_mod
function get_theme_mod_img($mod_name){
     //return str_replace(array('http:', 'https:'), '', get_theme_mod($mod_name));
   return str_replace("http://", "https://", get_theme_mod($mod_name));
}
/**********************************
*Add iframe
***********************************************************/
// allow script & iframe tag within posts
function ugdsb_allow_post_tags( $allowedposttags ){
    $allowedposttags['script'] = array(
        'type' => true,
        'src' => true,
        'height' => true,
        'width' => true,
    );
    $allowedposttags['iframe'] = array(
        'src' => true,
        'width' => true,
        'height' => true,
        'class' => true,
        'frameborder' => true,
        'webkitAllowFullScreen' => true,
        'mozallowfullscreen' => true,
        'allowFullScreen' => true
    );
    return $allowedposttags;
}
add_filter('wp_kses_allowed_html','ugdsb_allow_post_tags', 1);

/*********Function to display School Information - use in Secondary School theme 
*
************************************************************************************/

function ugdsb2_school_info_display(){
	
	echo '<h2>';
	echo get_bloginfo('name'); 
	echo '</h2>';
	echo '<address>';
	if ( of_get_option('custom_header_address1_text', true) != "") {	
		echo of_get_option('custom_header_address1_text', true).'<br />';
	}//if
	if ( of_get_option('custom_header_address2_text', true) != "") {	
		echo of_get_option('custom_header_address2_text', true);
	}//if
	if ( of_get_option('custom_header_address3_text', true) != "") {	
		echo ", ".of_get_option('custom_header_address3_text', true).'<br />';
	}//if
	echo '</address>';
	
	echo '<address>';
	$attendance_line = of_get_option('custom_phone_attendance_text', '');
	if ( !empty($attendance_line)) {
		echo 'Attendance Line: '.$attendance_line.'<br />';
	}
	
	if ( of_get_option('custom_header_phone_text', true) != "") {	
		echo 'Phone: '.of_get_option('custom_header_phone_text', true);
		echo '<br />';
		echo 'Fax: '.of_get_option('custom_header_fax_text', true);
		echo '<br />';
		echo 'Email: <a href=mailto:'.of_get_option('custom_header_email_text', true).'>'. of_get_option('custom_header_email_text', true).'</a>';
		echo '</address>';
	}
	$school_hours = of_get_option('custom_school_hours_text','');
	if (!empty($school_hours)) {
		echo 'School Hours: '.$school_hours.'<br />';
	}
	$office_hours = of_get_option('custom_office_hours_text', '');
	if ( !empty($office_hours)) {
		echo 'Office Hours: '.$office_hours.'<br />';
	}
	$break1 = of_get_option('custom_nuttrition1_hours_text','');
	if ( !empty($break1)) {
		echo 'Nutrition Break: '.$break1.'<br />';
	}
	$break2 = of_get_option('custom_nuttrition2_hours_text','');
	if ( !empty($break2)) {
		echo 'Nutrition Break: '.$break2.'<br />';
	}
	
	$principal = of_get_option('custom_principal_text','');
	if ( !empty($principal)) {
		echo '<br />Principal: '.$principal.'<br />';
	}
	
	$viceprincipal = of_get_option('custom_vp_text','');
	if ( !empty($viceprincipal)) {
		echo 'Vice-Principal(s): '.$viceprincipal.'<br />';
	}
	$secretary = of_get_option('custom_secretary_text', '');
	if ( !empty($secretary)) {
		echo 'Office Coordinator: '.$secretary;
	}
	
}//end funcation

// Auto Add Image Attributes From Image Filename
function abl_mc_auto_image_attributes( $post_ID ) {
$attachment = get_post( $post_ID );
$attachment_title = $attachment->post_title;
$attachment_title = str_replace( '-', ' ', $attachment_title ); // Hyphen Removal
$attachment_title = ucwords( $attachment_title ); // Capitalize First Word
$uploaded_image = array();
$uploaded_image['ID'] = $post_ID;
$uploaded_image['post_title'] = $attachment_title; // Image Title
//$uploaded_image['post_excerpt'] = $attachment_title; // Image Caption
$uploaded_image['post_content'] = $attachment_title; // Image Description
update_post_meta( $post_ID, '_wp_attachment_image_alt', $attachment_title ); // Image Alt Text
wp_update_post( $uploaded_image );
}
add_action( 'add_attachment', 'abl_mc_auto_image_attributes' );

//to hide the admin bar from the theme
add_filter('show_admin_bar', '__return_false');


//**********************************************************************
/*			Dashboard customization
/*************************************************************************/
function isa_disable_dashboard_widgets() {
	
  remove_meta_box('dashboard_quick_press','dashboard','side'); //Quick Press widget
  remove_meta_box('dashboard_recent_drafts','dashboard','side'); //Recent Drafts
  remove_meta_box('dashboard_primary','dashboard','side'); //WordPress.com Blog
  remove_meta_box('dashboard_secondary','dashboard','side'); //Other WordPress News
  remove_meta_box('dashboard_incoming_links','dashboard','normal'); //Incoming Links
  remove_meta_box('dashboard_plugins','dashboard','normal'); //Plugins
  remove_meta_box('dashboard_recent_comments','dashboard','normal'); //Recent Comments
  //remove_meta_box('dashboard_right_now','dashboard', 'normal'); //Right Now or At a Glance
  //remove_meta_box('rg_forms_dashboard','dashboard','normal'); //Gravity Forms
  //remove_meta_box('icl_dashboard_widget','dashboard','normal'); //Multi Language Plugin
  remove_meta_box('prli_dashboard_widget','dashboard','normal'); //Pretty Link Add
  
  remove_meta_box('dashboard_activity','dashboard', 'normal'); //Activity
  remove_action('welcome_panel','wp_welcome_panel');
	
}
add_action('admin_menu', 'isa_disable_dashboard_widgets');

/*********************************************************************
*		this hook is to remove columns (comments and tags) from a page
**********************************************************************/
add_filter( 'manage_pages_columns', 'custom_pages_columns' );
function custom_pages_columns( $columns ) {
  unset(
    $columns['comments'],
	$columns['tags'],
	$columns['date']
    //$columns['post_type'],
	//$columns['author']
  );
  return $columns;
}
add_filter( 'manage_posts_columns', 'custom_posts_columns' );
function custom_posts_columns( $columns ) {
  unset(
    $columns['comments'],
	$columns['tags'],
	$columns['date']
    //$columns['post_type'],
	//$columns['author']
  );
  return $columns;
}
/**********************************************************************
* hook to DISPLAY THE LAST MODIFIED AUTHOR
*
********************************************************************/




//////////////////////////////////////////////////////////////////////////////////
/*			nhi added Sept6, 2019
*	Testing to have customed filter for pages
*
**************************************************************************************/
// __________________Post Columns ______________________________
add_action ( 'manage_posts_custom_column',	'rkv_post_columns_data',	10,	2	);
add_filter ( 'manage_edit-post_columns',	'rkv_post_columns_display'			);
function rkv_post_columns_data( $column, $post_id ) {
	switch ( $column ) {
	case 'modified':
		$m_orig		= get_post_field( 'post_modified', $post_id, 'raw' );
		$m_stamp	= strtotime( $m_orig );
		$modified	= date('n/j/y @ g:i a', $m_stamp );
	       	$modr_id	= get_post_meta( $post_id, '_edit_last', true );
	       	$auth_id	= get_post_field( 'post_author', $post_id, 'raw' );
	       	$user_id	= !empty( $modr_id ) ? $modr_id : $auth_id;
	       	$user_info	= get_userdata( $user_id );
	
	       	echo '<p class="mod-date">';
	       	echo '<em>'.$modified.'</em><br />';
	       	echo 'by <strong>'.$user_info->display_name.'<strong>';
	       	echo '</p>';
		break;
	// end all case breaks
	}
}
function rkv_post_columns_display( $columns ) {
	$columns['modified']	= 'Last Modified';
	return $columns;
}



//___________________PAGES ONLY___________________________________
add_action ( 'manage_pages_custom_column',	'rkv_heirch_columns',	10,	2	);
add_filter ( 'manage_edit-page_columns',	'rkv_page_columns'				);
function rkv_heirch_columns( $column, $post_id ) {
	switch ( $column ) {
	case 'modified':
		$m_orig		= get_post_field( 'post_modified', $post_id, 'raw' );
		$m_stamp	= strtotime( $m_orig );
		$modified	= date(get_option('date_format').'@'.get_option('time_format'), $m_stamp );
	       	$modr_id	= get_post_meta( $post_id, '_edit_last', true );
	       	$auth_id	= get_post_field( 'post_author', $post_id, 'raw' );
	       	$user_id	= !empty( $modr_id ) ? $modr_id : $auth_id;
	       	$user_info	= get_userdata( $user_id );
	
	       	echo '<p class="mod-date">';
	       	echo '<em>'.$modified.'</em><br />';
	       	echo 'by <strong>'.$user_info->display_name.'<strong>';
	       	echo '</p>';
		break;
	// end all case breaks
	}
}
function rkv_page_columns( $columns ) {
	$columns['modified']	= 'Last Modified';
	return $columns;
}
function last_modified_column_register_sortable( $columns ) {
	$columns["modified"] = "last_modified";
        return $columns;
}
add_filter( "manage_edit-post_sortable_columns", "last_modified_column_register_sortable" );
add_filter( "manage_edit-page_sortable_columns", "last_modified_column_register_sortable" );


/**********************************************************************
* add user drop down menu
************************************************************************/
function restrict_manage_authors() {
    if (isset($_GET['post_type']) && post_type_exists($_GET['post_type']) && in_array(strtolower($_GET['post_type']))) {
        wp_dropdown_users(array(
            'show_option_all'   => 'Show all Authors',
            'show_option_none'  => false,
            'name'          => 'author',
            'selected'      => !empty($_GET['author']) ? $_GET['author'] : 0,
            'include_selected'  => false
        ));
    }
}
add_action('restrict_manage_posts', 'restrict_manage_authors');
 
function custom_columns_author($columns) {
    $columns['author'] = 'Author';
    return $columns;
}
add_filter('manage_edit-post_columns', 'custom_columns_author');


/***************************************************************************
* Feb11, 2020 - Create custom user role - for Editor to limit the editing other people's posts
***************************************************************************/

add_action('admin_init', 'user_custom_roles');

function user_custom_roles() {
	
if ( get_role('editor_limited') ) {
    remove_role('editor_limited');
}

add_role(
'editor_limited',
'Editor Limited',
array(

// Dashboard
'read' => true, // Access to Dashboard and Users -> Your Profile.
// Editor Capabilities
			'delete_others_pages' => false,//cannot delete other people's pages
			'delete_others_posts' => false,//cannot delete other people's posts
			'delete_pages' => true,
			'delete_posts' => true,
			'delete_private_pages' => true,
			'delete_private_posts' => true,
			'delete_published_pages' => true,
			'delete_published_posts' => true,
			'edit_others_pages' => false,//cannot edit other people's pages
			'edit_others_posts' => false,//cannot edit other people's posts
			'edit_pages' => true,
			'edit_posts' => true,
			'edit_private_pages' => true,
			'edit_private_posts' => true,
			'edit_published_pages' => true,
			'edit_published_posts' => true,
			'publish_pages' => true,
			'publish_posts' => true,
			'read_private_pages' => false,//cannot read/or see other private pages
			'read_private_posts' => false,




//Disable core and admin task
'manage_categories' => false, // Access to managing categories; keep this one so he/she can view posts
'manage_links' => true,
'moderate_comments' => false, // Access to moderating comments. Edit posts also needs to be set to true.
'edit_comments' => false, // Comments are blocked out for this user.
'edit_users' => false, // Can not view other users.
'create_users'           => false,
'list_users'             => false,
'delete_users'           => false,
'promote_users'          => false,
'remove_users'           => false,
'install_plugins'        => false,
'activate_plugins'       => false,
'update_plugins'         => false,
'edit_plugins'           => false,
'delete_plugins'         => false,
'edit_dashboard'         => false,
'switch_themes'          => false,
'edit_theme_options'     => false,
        
'customize'              => false,
'manage_options'         => false,
'delete_site'            => false,
'import'                 => false,
'export'                 => false,
'update_core' => false, // Can NOT update core. I added a plugin for this.
'unfiltered_html' => true,

// Media Library
'upload_files' => true, // Access to Media Library.

        )
    );
}

//add custom css style to admin bashboard page
/*
add_action('admin_head','my_custom_css');
function my_custom_css(){
	echo '<style>
	#custom_widget.postbox{
	 background-color:#FCFF33;	
	}
	
	</style>';
}*/

/***************************************************************
* this function will display a simple text widget on user's dashboard
* Added Mar31, 2020
****************************************************************/
/*add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets(){
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_widget', 'Important Message from UGDSB IT Team', 'custom_dashboard_information');
}
function custom_dashboard_information(){
echo "<p>On Thursday, April 2, 2020, between 2-4pm, please restrain from update website (ex. posting news on homepage). If you have to then you will need to re-do it after 4pm. Thank you!</p>";
}*/


?>
