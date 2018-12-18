<?php
require_once( plugin_dir_path( __FILE__ ) . '/data/Books_categories.php' );
require_once( plugin_dir_path( __FILE__ ) . '/data/Books_ids.php' );
require_once( plugin_dir_path( __FILE__ ) . '/data/Books_info.php' );

function EDC_Books_view_categories($type=0){
	global $EDC_category;
	
	$code = '';
	if( isset($EDC_category) ){
		if( is_array($EDC_category) ){
			if($type == 1){
				$code .= '<ul>';
				foreach($EDC_category as $value){
					$title = ( isset($value[1]) ? $value[1] : '' );
					$parent = ( isset($value[4]) ? $value[4] : 0 );
					if( $parent == 0 ){
						$code .= '<li>'.$title.'</li>';
					}else{
						$code .= '<li>---'.$title.'</li>';
					}
				}
				$code .= '</ul>';
			}else{
				$code .= '<select name="edc_category_id" id="edc_category_id">';
				foreach($EDC_category as $value){
					$title = ( isset($value[1]) ? $value[1] : '' );
					$parent = ( isset($value[4]) ? $value[4] : 0 );
					$id = ( isset($value[0]) ? intval($value[0]) : 0 );
					
					if( get_option('edc_category_id') == $id ){
						$selected = ' selected="selected"';
					}else{
						$selected = '';
					}
					
					if( $parent == 0 ){
						$code .= '<option value="'.$id.'"'.$selected.'>'.$title.'</option>';
					}else{
						$code .= '<option value="'.$id.'"'.$selected.'>--- '.$title.'</option>';
					}
				}
				$code .= '</select>';
			}
		}else{
			return false;
		}
	}else{
		return false;
	}

	return $code;
}


function EDC_Books_view_books($category=0){
	global $post, $EDC_category_info, $EDC_books_id;
	
	if( is_array($category) ){
		$category_id = $category[1];
	}else{
		$category_id = $category;
	}

	if( isset($EDC_books_id[$category_id]) ){
		$book_info = $EDC_books_id[$category_id];
		$books = count($book_info);

		$page = (int) ( isset($_GET["pages"]) ? intval($_GET["pages"]) : 1 );
		$perpage = 20;
		$pagesnum = ceil($books / $perpage);
		if( $page > $pagesnum ){ $page = 1; }
		$startpoint = ($page * $perpage) - $perpage;
		$endpoint = ($startpoint + $perpage);
		

		if($page > $pagesnum){
			$code = '<p>Error page!</p>';
		}else{
			$code = '<div id="free-books">';
			$code .= '<h2>'.__('Category', 'edc-books').': '.$EDC_category_info[$category_id][1].' <span style="font-size:12px; color:green;">'.$books.' '.__('Books', 'edc-books').'</span></h2>';
			$code .= '<ul>';
			for($i=$startpoint; $i < $endpoint; $i++){
				if($i >= $books){
					$code .= '';
				}else{
					$book_id = $book_info[$i];
					$code .= '<li>';
					if ( is_admin() ) {
						$code .= EDC_Books_info($book_id);
					}else{
						$code .= EDC_Books_info_with_image($book_id);
					}
					$code .= '</li>';
				}
			}
			$code .= '</ul>';
			if($pagesnum > 1){
				$code .= '<div class="perpage">';
				for ($i=1; $i<=$pagesnum; $i++) {
					if ($i != $page) {
						if ( is_admin() ) {
							$z = '[<a href="admin.php?page=edc-books&pages='.$i.'">'.$i.'</a>] ';
						}else{
							$pagelink = add_query_arg( 'pages', $i, get_permalink($post->ID) );
							$z = '[<a href="'.$pagelink.'">'.$i.'</a>] ';
						}
					} else {
						$z = '[<u>'.$i.'</u>]';
					}
					$code .= $z;
				}
				$code .= '</div>';
			}
			$code .= '</div>';
		}
		return $code;
	}else{
		return false;
	}
}

function EDC_Books_info($book_id=0){
	global $EDC_book_info;
	
	if( isset($EDC_book_info[$book_id]) ){
		$book_info = $EDC_book_info[$book_id];
		if( is_array($book_info) ){
			$source = ( isset($book_info[5]) ? $book_info[5] : '' );
			$title = ( isset($book_info[0]) ? $book_info[0] : '' );
			$author = ( isset($book_info[1]) ? $book_info[1] : '' );
			$download = ( isset($book_info[2]) ? $book_info[2] : '' );
			$image = ( isset($book_info[3]) ? $book_info[3] : '' );
			
			if( empty($source) ){
				$lang_title = '';
			}else{
				$lang_string = explode("/", $source);
				$lang_title = ( isset($lang_string[3]) ? '?lang='.ucwords($lang_string[3]) : '' );
			}

			$code = '<p class="title"><strong>'.__('Title', 'edc-books').':</strong> <a target="_blank" href="'.$source.'"><span>'.$title.'</span></a></p>';
			if($author != ""){
				$code .= '<p class="author"><strong>'.__('Author', 'edc-books').':</strong> <span>'.$author.'</span></p>';
			}
			if($download != ""){
				$code .= '<p class="download"><strong>'.__('Download', 'edc-books').':</strong> <a target="_blank" href="'.$download.'"><span>'.$download.'</span></a></p>';
			}
			if($image != ""){
				$code .= '<p class="download"><strong>'.__('Image', 'edc-books').':</strong> <a target="_blank" href="'.$image.'"><span>'.$image.'</span></a></p>';
			}

			return $code;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function EDC_Books_info_with_image($book_id=0){
	global $EDC_book_info;
	if( isset($EDC_book_info[$book_id]) ){
		$book_info = $EDC_book_info[$book_id];
		if( is_array($book_info) ){
			$source = ( isset($book_info[5]) ? $book_info[5] : '' );
			$title = ( isset($book_info[0]) ? $book_info[0] : '' );
			$author = ( isset($book_info[1]) ? $book_info[1] : '' );
			$download = ( isset($book_info[2]) ? $book_info[2] : '' );
			$image = ( isset($book_info[3]) ? $book_info[3] : '' );
			
			if( empty($source) ){
				$lang_title = '';
			}else{
				$lang_string = explode("/", $source);
				$lang_title = ( isset($lang_string[3]) ? '?lang='.ucwords($lang_string[3]) : '' );
			}
			
			$code = '';
			if($image != ""){
				$code .= '<div class="image"><a target="_blank" href="'.$source.'"><img src="'.$image.'" alt="'.$title.'" /></a></div>';
			}
			$code .= '<p class="title"><strong>'.__('Title', 'edc-books').':</strong> <a target="_blank" href="'.$source.'"><span>'.$title.'</span></a></p>';
			if($author != ""){
				$code .= '<p class="author"><strong>'.__('Author', 'edc-books').':</strong> <span>'.$author.'</span></p>';
			}
			if($download != ""){
				$code .= '<p class="download"><strong>'.__('Image', 'edc-books').':</strong> <a target="_blank" href="'.$download.'"><img src="'.plugin_dir_url( __FILE__ ).'/i/download.png" alt="'.$title.'" /></a></p>';
				$code .= '<div style="clear:both;"></div>';
			}
			return $code;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function EDC_books_replace($t){
	$text = preg_replace_callback("/EDC_books\[([0-9]*?)\]/s", "EDC_Books_view_books", $t);
	return $text;
}
add_filter('the_content','EDC_books_replace');

require_once( plugin_dir_path( __FILE__ ) . '/books-widget.php' );