<?php
class Free_Books_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Free_Books_Widget', // Base ID
			__('Islamic Books', 'edc-books'), // Name
			array( 'description' => __( 'You can add 1 out of 88 languages', 'edc-books' ), ) // Args
		);
	}

	public function EDC_BOOKS($book_data=''){
	global $EDC_category_info, $EDC_books_id, $EDC_book_info;
		
		if( ! empty($book_data) && is_array($book_data) ){
			$language_id = ( isset($book_data['language_id']) ? $book_data['language_id'] : '' );
			$booksrand = ( isset($book_data['booksrand']) ? $book_data['booksrand'] : '' );
			$edc_free_books_allow_source = ( isset($book_data['edc_free_books_allow_source']) ? $book_data['edc_free_books_allow_source'] : 0 );
			$edc_free_books_allow_download = ( isset($book_data['edc_free_books_allow_download']) ? $book_data['edc_free_books_allow_download'] : 0 );
			$edc_free_books_allow_read = ( isset($book_data['edc_free_books_allow_read']) ? $book_data['edc_free_books_allow_read'] : 0 );
			$width = ( isset($book_data['width']) ? $book_data['width'] : 200 );
			$height = ( isset($book_data['height']) ? $book_data['height'] : '' );
			$edc_slider_type = ( isset($book_data['edc_slider_type']) ? $book_data['edc_slider_type'] : 0 );
			$edc_free_books_allow_title = ( isset($book_data['edc_free_books_allow_title']) ? $book_data['edc_free_books_allow_title'] : 0 );
			$edc_free_books_use_bootstrap = ( isset($book_data['edc_free_books_use_bootstrap']) ? $book_data['edc_free_books_use_bootstrap'] : 0 );
			$loop = ( isset($book_data['loop']) ? $book_data['loop'] : 0 );
		}else{
			$language_id = "";
			$booksrand = "";
			$edc_free_books_allow_source = 0;
			$edc_free_books_allow_download = 0;
			$edc_free_books_allow_read = 0;
			$width = "200";
			$height = "300";
			$edc_slider_type = 0;
			$edc_free_books_allow_title = 0;
			$edc_free_books_use_bootstrap = 0;
			$loop = 0;
		}

		$language_name = $EDC_category_info[$language_id][1];
		$i = $EDC_books_id[$language_id][$booksrand];
		$books_count = count($EDC_books_id[$language_id]);
		
		$lang_string = explode("&", $EDC_book_info[$i][5]);
		if($lang_string[1] == ""){
			$lang_title = '';
		}else{
			$lang_title = '?'.$lang_string[1];
		}
		
		$author_id = ( isset($EDC_book_info[$i][6]) ? $EDC_book_info[$i][6] : '' );
		
		if($EDC_book_info[$i][0] == ""){ $title = ''; }else{ $title = $EDC_book_info[$i][0]; }
		if($EDC_book_info[$i][1] == ""){ $author = ''; }else{ $author = esc_html($EDC_book_info[$i][1]); }
		if($EDC_book_info[$i][2] == ""){ $url = ''; }else{ $url = esc_url($EDC_book_info[$i][2]); }
		if($EDC_book_info[$i][3] == ""){ $image = ''; }else{ $image = '<img class="edc_image_book" src="'.esc_url($EDC_book_info[$i][3]).'" alt="'.esc_attr($title).'" title="'.esc_attr($title).'" />'; }

		if($EDC_book_info[$i][2] == ""){
			$download = '';
			$fa_icons = '';
		}else{
			$fa_icons = '';
			if($edc_slider_type == 0){
				$download = '<div class="edc_icons_content_for_just_link">';
			}else{
				$download = '<div class="edc_icons_content">';
			}
			if($edc_free_books_allow_source == 1){
				$fa_icons .= '<a target="_blank" href="'.esc_url($EDC_book_info[$i][5]).'"><i class="fa fa-external-link" aria-hidden="true"></i></a>';
				$download .= '<a target="_blank" href="'.esc_url($EDC_book_info[$i][5]).'"><img class="edc_icons" src="'.plugin_dir_url( __FILE__ ).'/images/link.png" alt="Go to '.esc_attr($EDC_book_info[$i][0]).'" title="'.esc_attr($EDC_book_info[$i][0]).'" /></a>';
			}
			if($edc_free_books_allow_read == 1){
				$fa_icons .= '<a target="_blank" href="https://docs.google.com/viewer?url='.esc_url($EDC_book_info[$i][2]).'"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
				$download .= '<a target="_blank" href="https://docs.google.com/viewer?url='.esc_url($EDC_book_info[$i][2]).'"><img class="edc_icons" src="'.plugin_dir_url( __FILE__ ).'/images/pdf.png" alt="Read '.esc_attr($EDC_book_info[$i][0]).'" title="Read '.esc_attr($EDC_book_info[$i][0]).'" /></a>';
			}
			if($edc_free_books_allow_download == 1){
				$fa_icons .= '<a target="_blank" href="'.esc_url($EDC_book_info[$i][2]).'"><i class="fa fa-download" aria-hidden="true"></i></a>';
				$download .= '<a target="_blank" href="'.esc_url($EDC_book_info[$i][2]).'"><img class="edc_icons" src="'.plugin_dir_url( __FILE__ ).'/images/download.png" alt="Download '.esc_attr($EDC_book_info[$i][0]).'" title="Download '.esc_attr($EDC_book_info[$i][0]).'" /></a>';
			}
			$download .= '</div>';
		}

		if($books_count == 0){
			$code = '<div id="books_content_widget">Sorry, Not found books in '.$category_name.' language.</div>';
		}else{
			if($edc_free_books_use_bootstrap == 1){
				$active = ( $loop == 0 ? ' active' : '' );
				$code = '<figure class="item'.$active.'">
				<a target="_blank" href="'.esc_url($EDC_book_info[$i][5]).'">'.$image.'</a>
				<span class="label label-success cat-label">'.$category_name.'</span>
				<figcaption class="cap-title">
					<h3><a target="_blank" href="'.esc_url($EDC_book_info[$i][5]).'">'.$title.'</a></h3>
					<div class="box-post-meta">';
					if( ! empty($fa_icons) ){
						$code .= '<div class="fa-icons">';
						$code .= $fa_icons;
						$code .= '</div>';
					}

					if($lang_title == ""){
						$author_url = 'http://www.muslim-library.com/books-author/?author_id='.$author_id;
					}else{
						$author_url = 'http://www.muslim-library.com/books-author/'.$lang_title.'&author_id='.$author_id;
					}
					
					$get_author = ( empty($author_id) ? $author : '<a target="_blank" href="'.$author_url.'">'.$author.'</a>' );
					$code .= '<span class="box-post-author"><i class="fa fa-user"></i> '.$get_author.'</span>
					</div>
					<div class="clearfix" style="margin-top: 15px;"></div>
				</figcaption>
			</figure>';
			}else{
				if($edc_slider_type == 0){
					$code = '<li>'.$download.'<a target="_blank" href="'.$url.'" title="'.$author.'">'.$title.'</a><div style="clear:both;"></div></li>'."\n";
				}else{
					if($EDC_book_info[$i][3] != ""){
						$code = '<li><a target="_blank" href="'.$url.'">'.$image.'</a><div style="clear:both;"></div>'.$download.'</li>';
					}else{
						$code = '';
					}
				}
			}
		}

		return $code;
	}

	public function EDC_BOOKS_js($edc_free_books_id=0, $edc_slider_type=1, $view_extracode=0){
		$code_js = "<script type=\"text/javascript\">"."\n";
		$code_js .= "(function($){	
		  $(function(){";
		$code_js .= "$('#bxslider".$edc_free_books_id."').bxSlider({"."\n";
		if($edc_slider_type == 1){
		$code_js .= "mode: 'fade',
		  captions: true"."\n";
		$extracode = '';
		}elseif($edc_slider_type == 2){
		$code_js .= "auto: true,
		  autoControls: true"."\n";
		$extracode = '';
		}elseif($edc_slider_type == 3){
		$code_js .= "infiniteLoop: false,
		  hideControlOnEnd: true"."\n";
		$extracode = '';
		}elseif($edc_slider_type == 4){
		$code_js .= "adaptiveHeight: true,
		  mode: 'fade'"."\n";
		$extracode = '';
		}elseif($edc_slider_type == 5){
		$code_js .= "slideWidth: 300,
		    minSlides: 2,
		    maxSlides: 2,
		    slideMargin: 10"."\n";
		$extracode = '';
		}elseif($edc_slider_type == 6){
		$code_js .= "minSlides: 2,
		  maxSlides: 2,
		  slideWidth: 360,
		  slideMargin: 10"."\n";
		$extracode = '';
		}elseif($edc_slider_type == 7){
		$code_js .= "minSlides: 3,
		  maxSlides: 4,
		  slideWidth: 170,
		  slideMargin: 10"."\n";
		$extracode = '';
		}elseif($edc_slider_type == 8){
		$code_js .= "mode: 'vertical',
		  slideMargin: 5"."\n";
		$extracode = '';
		}elseif($edc_slider_type == 9){
		$code_js .= "nextSelector: '#slider-next',
		  prevSelector: '#slider-prev',
		  nextText: 'Next &#8594;',
		  prevText: '&#8592; Prev'"."\n";
		$extracode = '<div class="outside">
		<p><span id="slider-prev"></span> | <span id="slider-next"></span></p>
		</div>';
		}else{
		$code_js .= "mode: 'fade',
		  captions: true"."\n";
		$extracode = '';
		}
		$code_js .= "});"."\n";
		$code_js .= "});	
		}(jQuery))";
		$code_js .= "</script>"."\n";
	
	if($view_extracode == 1){
		return $extracode;
	}else{
		return $code_js;
	}
	}
	
	public function widget( $args, $instance ) {
		global $EDC_BOOK,$EDC_category_info,$EDC_books_id;
		$title = apply_filters( 'widget_title', $instance['title'] );
		$edc_free_books_id = $instance['edc_free_books_id'];
		$edc_free_books_language_shortname = $instance['edc_free_books_language_shortname'];
		$edc_free_books_allow_source = $instance['edc_free_books_allow_source'];
		$edc_free_books_allow_download = $instance['edc_free_books_allow_download'];
		$edc_free_books_use_bootstrap = (isset($instance['edc_free_books_use_bootstrap']) ? $instance['edc_free_books_use_bootstrap'] : 0 );
		$edc_free_books_allow_title = $instance['edc_free_books_allow_title'];
		$edc_free_books_allow_read = $instance['edc_free_books_allow_read'];
		$edc_free_books_width = $instance['edc_free_books_width'];
		$edc_free_books_height = $instance['edc_free_books_height'];
		$edc_free_books_limit = $instance['edc_free_books_limit'];
		$edc_slider_type = $instance['edc_slider_type'];

		if(empty($edc_free_books_width)){ $width = 200; }else{ $width = $edc_free_books_width; }
		if(empty($edc_free_books_height)){ $height = 300; }else{ $height = $edc_free_books_height; }
		if(empty($edc_free_books_limit)){ $books_limit = 1; }else{ $books_limit = $edc_free_books_limit; }

		$language_name = $EDC_category_info[$edc_free_books_id][1];
		$bookscount = count($EDC_books_id[$edc_free_books_id]);

		if($books_limit > $bookscount){ $limit = $bookscount; }else{ $limit = $books_limit; }

		$books_arr = '';
		for($x=0; $x<$limit; ++$x){
			$booksrand = rand(0, $bookscount-1);

			$book_data = array(
				'language_id' => $edc_free_books_id,
				'booksrand' => $booksrand,
				'edc_free_books_allow_source' => $edc_free_books_allow_source,
				'edc_free_books_allow_download' => $edc_free_books_allow_download,
				'edc_free_books_allow_read' => $edc_free_books_allow_read,
				'width' => $width,
				'height' => $height,
				'edc_slider_type' => $edc_slider_type,
				'edc_free_books_allow_title' => $edc_free_books_allow_title,
				'edc_free_books_use_bootstrap' => $edc_free_books_use_bootstrap,
				'loop' => $x
			);
			
			//$edc_free_books_id, $booksrand, $edc_free_books_allow_source, $edc_free_books_allow_download, $edc_free_books_allow_read, $width, $height, $edc_slider_type, $edc_free_books_allow_title, $edc_free_books_use_bootstrap
			$books_arr .= $this->EDC_BOOKS($book_data);
		}
		
		if( $edc_free_books_use_bootstrap == 1 ){
			$code = '<div class="mawthuq-books">';
			$code .= '<div id="widgetCarousel_books" class="carousel slide">';
			$code .= '<ol class="carousel-indicators">';
			for($slide=0; $slide<$limit; ++$slide){
				$code .= '<li data-target="#widgetCarousel_books" data-slide-to="'.$slide.'"></li>';
			}
			$code .= '</ol>';
			$code .= '<div class="carousel-inner">';
			$code .= $books_arr;
			$code .= '<a class="left carousel-control" href="#widgetCarousel_books" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a>';
			$code .= '<a class="right carousel-control" href="#widgetCarousel_books" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>';
			$code .= '</div>';
			$code .= '</div>';
			$code .= '</div>';
		}else{
			$code = ($edc_slider_type == 0 ? '' : $this->EDC_BOOKS_js($edc_free_books_id, $edc_slider_type, 0) );
			$code .= '<div class="edcbooks">';
			$code .= ( $edc_free_books_allow_title == 1 ? '<h2>'.$language_name.'</h2>' : '' );
			$code .= '<ul id="bxslider'.$edc_free_books_id.'">';
			$code .= $books_arr;
			$code .= '</ul>';
			$code .= '</div>';
			$code .= $this->EDC_BOOKS_js($edc_free_books_id, $edc_slider_type, 1);
		}

		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		echo $code;
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		global $EDC_category;
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			$edc_free_books_id = $instance['edc_free_books_id'];
			$edc_free_books_language_shortname = $instance['edc_free_books_language_shortname'];
			$edc_free_books_allow_source = $instance['edc_free_books_allow_source'];
			$edc_free_books_allow_download = $instance['edc_free_books_allow_download'];
			$edc_free_books_use_bootstrap = $instance['edc_free_books_use_bootstrap'];
			$edc_free_books_allow_read = $instance['edc_free_books_allow_read'];
			$edc_free_books_width = $instance['edc_free_books_width'];
			$edc_free_books_height = $instance['edc_free_books_height'];
			$edc_free_books_limit = $instance['edc_free_books_limit'];
			$edc_slider_type = $instance['edc_slider_type'];
			$edc_free_books_allow_title = $instance['edc_free_books_allow_title'];
		}else{
			$title = __( 'Islamic Books', 'edc-books' );
			$edc_free_books_id = 2;
			$edc_free_books_language_shortname = '';
			$edc_free_books_allow_source = 1;
			$edc_free_books_allow_download = 1;
			$edc_free_books_use_bootstrap = 0;
			$edc_free_books_allow_read = 1;
			$edc_free_books_width = '';
			$edc_free_books_height = '';
			$edc_free_books_limit = 10;
			$edc_slider_type = 1;
			$edc_free_books_allow_title = 1;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'edc-books' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>

		<select id="<?php echo $this->get_field_id('edc_free_books_id'); ?>" name="<?php echo $this->get_field_name('edc_free_books_id'); ?>">
		<?php for($i = 1; $i <= count($EDC_category); $i++): ?>
		<?php if($EDC_category[$i][4] == 0){ ?>
		<option title="<?php echo $EDC_category[$i][1]; ?>" value="<?php echo intval($EDC_category[$i][0]); ?>" <?php echo ( $edc_free_books_id == intval($EDC_category[$i][0]) ) ? 'selected="selected"' : ''; ?>><?php echo $EDC_category[$i][1]; ?></option>
		<?php }else{?>
		<option title="<?php echo $EDC_category[$i][1]; ?>" value="<?php echo intval($EDC_category[$i][0]); ?>" <?php echo ( $edc_free_books_id == intval($EDC_category[$i][0]) ) ? 'selected="selected"' : ''; ?>><?php echo '- '.$EDC_category[$i][1]; ?></option>
		<?php } ?>
		<?php endfor; ?>
		</select>
		<label for="<?php echo $this->get_field_id('edc_free_books_id'); ?>"> 
		<?php _e('Languages', 'edc-books'); ?>
		</label>
		</p>
		 
		<p>
		<label for="<?php echo $this->get_field_id('edc_free_books_allow_source'); ?>"> 
		<input id="<?php echo $this->get_field_id('edc_free_books_allow_source'); ?>" name="<?php echo $this->get_field_name('edc_free_books_allow_source'); ?>" type="checkbox" <?php if($edc_free_books_allow_source) { echo 'checked="checked"'; } ?> /> 
		<?php _e('Source icon', 'edc-books'); ?>
		</label>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('edc_free_books_allow_read'); ?>"> 
		<input id="<?php echo $this->get_field_id('edc_free_books_allow_read'); ?>" name="<?php echo $this->get_field_name('edc_free_books_allow_read'); ?>" type="checkbox" <?php if($edc_free_books_allow_read) { echo 'checked="checked"'; } ?> /> 
		<?php _e('Read icon', 'edc-books'); ?>
		</label>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('edc_free_books_allow_download'); ?>"> 
		<input id="<?php echo $this->get_field_id('edc_free_books_allow_download'); ?>" name="<?php echo $this->get_field_name('edc_free_books_allow_download'); ?>" type="checkbox" <?php if($edc_free_books_allow_download) { echo 'checked="checked"'; } ?> /> 
		<?php _e('Download icon', 'edc-books'); ?>
		</label>
		</p>
			
		<p>
		<label for="<?php echo $this->get_field_id('edc_free_books_use_bootstrap'); ?>"> 
		<input id="<?php echo $this->get_field_id('edc_free_books_use_bootstrap'); ?>" name="<?php echo $this->get_field_name('edc_free_books_use_bootstrap'); ?>" type="checkbox" <?php if($edc_free_books_use_bootstrap) { echo 'checked="checked"'; } ?> /> 
		<?php _e('Use Bootstrap?', 'edc-books'); ?>
		</label>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('edc_free_books_allow_title'); ?>"> 
		<input id="<?php echo $this->get_field_id('edc_free_books_allow_title'); ?>" name="<?php echo $this->get_field_name('edc_free_books_allow_title'); ?>" type="checkbox" <?php if($edc_free_books_allow_title) { echo 'checked="checked"'; } ?> /> 
		<?php _e('Show title', 'edc-books'); ?>
		</label>
		</p>
		
		<!--
		<p>
		<label for="<?php echo $this->get_field_id( 'edc_free_books_width' ); ?>"><?php _e( 'Image width:', 'edc-books' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'edc_free_books_width' ); ?>" name="<?php echo $this->get_field_name( 'edc_free_books_width' ); ?>" type="text" value="<?php if(empty($edc_free_books_width)){ echo 200; }else{ echo esc_attr( $edc_free_books_width ); } ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'edc_free_books_height' ); ?>"><?php _e( 'Image height:', 'edc-books' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'edc_free_books_height' ); ?>" name="<?php echo $this->get_field_name( 'edc_free_books_height' ); ?>" type="text" value="<?php if(empty($edc_free_books_height)){ echo 244; }else{ echo esc_attr( $edc_free_books_height ); } ?>" />
		</p>
		-->
		<p>
		<label for="<?php echo $this->get_field_id( 'edc_free_books_limit' ); ?>"><?php _e( 'Books limit:', 'edc-books' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'edc_free_books_limit' ); ?>" name="<?php echo $this->get_field_name( 'edc_free_books_limit' ); ?>" type="text" value="<?php if(empty($edc_free_books_limit)){ echo 1; }else{ echo esc_attr( $edc_free_books_limit ); } ?>" />
		</p>
		
		<p>
		<select id="<?php echo $this->get_field_id('edc_slider_type'); ?>" name="<?php echo $this->get_field_name('edc_slider_type'); ?>">
		<option value="1" <?php echo ( $edc_slider_type == 1 ) ? 'selected="selected"' : ''; ?>>1. Image slideshow with captions</option>
		<option value="2" <?php echo ( $edc_slider_type == 2 ) ? 'selected="selected"' : ''; ?>>2. Auto show with start / stop controls</option>
		<option value="3" <?php echo ( $edc_slider_type == 3 ) ? 'selected="selected"' : ''; ?>>3. Manual show without infinite loop</option>
		<option value="4" <?php echo ( $edc_slider_type == 4 ) ? 'selected="selected"' : ''; ?>>4. Slideshow using adaptiveHeight</option>
		<option value="5" <?php echo ( $edc_slider_type == 5 ) ? 'selected="selected"' : ''; ?>>5. Carousels demystified - in depth explanation with examples</option>
		<option value="6" <?php echo ( $edc_slider_type == 6 ) ? 'selected="selected"' : ''; ?>>6. Carousel - static number of slides showing</option>
		<option value="7" <?php echo ( $edc_slider_type == 7 ) ? 'selected="selected"' : ''; ?>>7. Carousel - dynamic number of slides showing</option>
		<option value="8" <?php echo ( $edc_slider_type == 8 ) ? 'selected="selected"' : ''; ?>>8. Vertical slideshow</option>
		<option value="9" <?php echo ( $edc_slider_type == 9 ) ? 'selected="selected"' : ''; ?>>9. Custom next / prev control selectors</option>
		<option value="0" <?php echo ( $edc_slider_type == 0 ) ? 'selected="selected"' : ''; ?>>10. Just Links</option>
		</select>
		<label for="<?php echo $this->get_field_id('edc_slider_type'); ?>"> 
		<?php _e('Slider Type', 'edc-books'); ?>
		</label>
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['edc_free_books_id'] = $new_instance['edc_free_books_id'];
		$instance['edc_free_books_language_shortname'] = $new_instance['edc_free_books_language_shortname'];
		$instance['edc_free_books_width'] = $new_instance['edc_free_books_width'];
		$instance['edc_free_books_height'] = $new_instance['edc_free_books_height'];
		$instance['edc_free_books_limit'] = $new_instance['edc_free_books_limit'];
		$instance['edc_free_books_allow_source'] = ( isset( $new_instance['edc_free_books_allow_source'] ) ? 1 : 0 );
		$instance['edc_free_books_allow_read'] = ( isset( $new_instance['edc_free_books_allow_read'] ) ? 1 : 0 );
		$instance['edc_free_books_allow_download'] = ( isset( $new_instance['edc_free_books_allow_download'] ) ? 1 : 0 );
		$instance['edc_free_books_use_bootstrap'] = ( isset( $new_instance['edc_free_books_use_bootstrap'] ) ? 1 : 0 );
		$instance['edc_free_books_allow_title'] = ( isset( $new_instance['edc_free_books_allow_title'] ) ? 1 : 0 );
		$instance['edc_slider_type'] = intval($new_instance['edc_slider_type']);
		return $instance;
	}

}

function register_Free_Books_Widget() {
    register_widget( 'Free_Books_Widget' );
}
add_action( 'widgets_init', 'register_Free_Books_Widget' );

?>