<?php 

/* Template Name: Home */ 



/* # Header Schema
---------------------------------------------------------------------------------------------------- */
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
function custom_site_title() { 
	$logo = get_field( 'logo', 'option' );
	echo '<a class="retina logo" href="'.get_bloginfo('url').'" title="TI"><img src="'.$logo.'" alt="logo"/></a>';
}
// add_action( 'genesis_site_title', 'custom_site_title' );

remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_header', 'genesis_do_header' );
//add in the new header markup - prefix the function name - here sm_ is used
add_action( 'genesis_header', 'sm_genesis_header_markup_open', 5 );
add_action( 'genesis_header', 'sm_genesis_header_markup_close', 15 );
add_action( 'genesis_header', 'sm_genesis_do_header' );
//New Header functions
function sm_genesis_header_markup_open() {
	genesis_markup( array(
		'html5'   => '<header %s>',
		'context' => 'site-header',
	) );
	// Added in content
    echo '<div class="header-ghost"></div>';
    $logo = get_field( 'logo', 'option' );
	echo '<div class="main-logo col text-center justify-content-center align-self-center"><a class="retina logo" href="'.get_bloginfo('url').'" title="TI"><img src="'.$logo.'" alt="logo"/></a></div>';
	// genesis_structural_wrap( 'header' );
}
function sm_genesis_header_markup_close() {
	// genesis_structural_wrap( 'header', 'close' );
	genesis_markup( array(
		'close'   => '</header>',
		'context' => 'site-header',
	) );
}
function sm_genesis_do_header() {
	global $wp_registered_sidebars;
    $header_options = get_field('choose_header_type','option');
    echo '<div class="top-menu">';
	genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'title-area',
	) );
	do_action( 'genesis_site_title' );
	do_action( 'genesis_site_description' );
	
	genesis_markup( array(
		'close'    => '</div>',
		'context' => 'title-area',
	) );
	genesis_markup( array(
        'open'    => '<div %s>' . genesis_sidebar_title( 'header-right' ),
        'context' => 'header-widget-area',
    ) );
        do_action( 'genesis_header_right' );
        add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
        add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
        echo '<div class="right-button">';
        echo '<a href="#">'.__('Contact Us').'</a>';
        echo '</div>';
        remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
        remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
        if($header_options):
            
        endif;
    genesis_markup( array(
        'close'   => '</div>',
        'context' => 'header-widget-area',
    ) );
    echo '</div>';
}

add_filter( 'genesis_attr_body', 'themeprefix_add_css_attr' );
function themeprefix_add_css_attr( $attributes ) {
	if( get_field('hero_image'))
		$attributes['class'] .= ' fixed-header';
	else	 
		$attributes['class'] .= '';
	return $attributes;
}


/* # Home Sections
---------------------------------------------------------------------------------------------------- */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'home_do_custom_loop' );
 
function home_do_custom_loop() {
    $intro_text = get_field('intro_text');
    $testimonials = get_field('testimonials');
    $home_contact = get_field('home_contact');
    if($intro_text):

 ?>
    <!-- Section Description -->
    <section id="home-description" class="home-description">
        <div class="container">
            <?php echo do_shortcode($intro_text['intro_content']); ?>
        </div>
    </section>
    <!-- End Description -->
    <?php 
    endif;
    if($testimonials): 
    $i = 0;
    ?>
    <!-- Section testimoial -->
    <section class="testimonials" id="testimonials">
        <div id="testimonial-slide" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php  while ( have_rows('testimonials') ) : the_row(); ?>
                <li data-target="#testimonial-slide" data-slide-to="<?php echo $i;?>" <?php if($i==0) echo 'class="active"';?>></li>
                <?php 
                $i++;
                endwhile;?>
            </ol>
            <div class="carousel-inner">
                <?php  
                $i = 0;
                while ( have_rows('testimonials') ) : the_row(); 
                $testimonial_author = get_sub_field('testimonial_author');
                $testimonial_content = get_sub_field('testimonial_content');
                ?>
                <div class="carousel-item <?php if($i==0) echo 'active';?>">
                    <div class="item">
                        <h3><?php echo  $testimonial_author?></h3>
                        <?php echo do_shortcode($testimonial_content);?>
                    </div>
                </div>
                <?php 
                $i++;
                endwhile;?>
            </div>
            <a class="carousel-control-prev" href="#testimonial-slide" role="button" data-slide="prev">
                <i class="fa fa-angle-left fa-5x"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#testimonial-slide" role="button" data-slide="next">
                <i class="fa fa-angle-right fa-5x"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!-- End Testimonial -->
 <?php
 endif;
 ?>
 <?php
 if($home_contact):
 ?> 
 <!-- Section Contact Us -->
 <section class="contact-us" id="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2><?php echo $home_contact['title'];?></h2>
                </div>
                <div class="col-md-6">
                   <?php echo do_shortcode($home_contact['contact_content']); ?>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5 right-section">
                    <?php echo do_shortcode($home_contact['form_content']); ?>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Us -->
 <?php
 endif;
}

genesis();