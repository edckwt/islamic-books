<?php
add_action('plugins_loaded', 'edc_books_load_textdomain');
function edc_books_load_textdomain() {
	load_plugin_textdomain( 'edc-books', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

function edc_books_install(){
	add_option( 'edc_category_id', 3 );
	add_option( 'edc_view_js', 1 );
	add_option( 'edc_categoty_title', __('Islamic Books', 'edc-books') );
}
register_activation_hook( __FILE__ , 'edc_books_install'); 

function edc_books_scripts(){
	if(get_option('edc_view_js') == 1){
		//wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', '//code.jquery.com/jquery-1.11.1.min.js', false, '1.11', false );
		wp_enqueue_script('jquery');
	}
	wp_register_script('edc_free_books_plugin_scripts', plugin_dir_url( __FILE__ ).'js/bxslider/jquery.bxslider.min.js');
	wp_enqueue_script('edc_free_books_plugin_scripts');
}
add_action('wp_enqueue_scripts', 'edc_books_scripts'); 

function edc_books_css() {
	wp_register_style( 'edc-styles2', plugin_dir_url( __FILE__ ).'style.css' );
	wp_register_style( 'edc-styles', plugin_dir_url( __FILE__ ).'js/bxslider/jquery.bxslider.css' );
	wp_enqueue_style( 'edc-styles' );
	wp_enqueue_style( 'edc-styles2' );
}
add_action( 'wp_enqueue_scripts', 'edc_books_css' );

function edc_books_admin_css() {
	echo "<style type=\"text/css\" media=\"screen\">\n";
	echo "#free-books { width:100%; margin:0; border:0px solid #cccccc; padding:0; }\n";
	echo "#free-books .widget { margin:0; border:1px solid #cccccc; background-color:#fff; padding:10px; margin-top:0px; }\n";
	echo "#free-books .viewbook { margin:0; border:1px solid #cccccc; background-color:#fff; padding:10px; margin-top:15px; }\n";
	echo "#free-books .viewbook p { margin:0 0 5px 0; }\n";
	echo "#free-books .viewbook p.title span { color:#333; }\n";
	echo "#free-books .viewbook p.author span { color:blue; }\n";
	echo "#free-books .viewbook p.download span { color:green; }\n";
	echo "#free-books .viewbook p.title a, #free-books .viewbook p.download a { text-decoration:none; }\n";
	echo "#free-books .viewbook li { margin:0 0 15px 0; padding:0 0 10px 0; border-bottom:1px solid #cccccc; }\n";
	echo "#free-books .shortcode { margin:15px 0 0 0; padding:10px; border:1px solid #000000; background-color:#333333; text-align:center; color:#ffffff;; }\n";
	echo "#free-books .shortcode span { color:yellow; }\n";
	do_action('edc_css');
	echo "</style>\n";
}

add_action( 'admin_head','edc_books_admin_css' );
add_action( 'admin_menu', 'edc_books_menu' );

function edc_books_menu() {
	add_menu_page( __('Islamic Books', 'edc-books'), __('Islamic Books', 'edc-books'), 'manage_options', 'edc-books', 'edc_books_options', ''.trailingslashit(plugins_url(null,__FILE__)).'/i/book.png' );
}