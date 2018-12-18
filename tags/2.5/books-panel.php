<?php
function edc_books_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	if(isset($_POST['submitted']) && $_POST['submitted'] == 1){
		if ( ! isset( $_POST['edc_books_update'] ) || ! wp_verify_nonce( $_POST['edc_books_update'], 'edc_books_nonce' ) ) {
			wp_die( __( 'Sorry, your nonce did not verify.' ) );
		} else {
			if ( get_option( 'edc_category_id' ) !== false ) {
				update_option( 'edc_category_id', intval($_POST['edc_category_id']) );
				update_option( 'edc_categoty_title', addslashes($_POST['edc_categoty_title']) );
				update_option( 'edc_view_js', addslashes($_POST['edc_view_js']) );
			} else {
				add_option( 'edc_category_id', 3 );
				add_option( 'edc_categoty_title', __('Islamic Books', 'edc-books'), null );
				add_option( 'edc_view_js', 1, null );
			}
		}
	}

	$edc_category_id = ( get_option('edc_category_id') ? intval(get_option('edc_category_id')) : 0 );
	$edc_categoty_title = (get_option('edc_categoty_title') ? strip_tags(get_option('edc_categoty_title')) : '' );
	$edc_view_js = (get_option('edc_view_js') ? intval(get_option('edc_view_js')) : '' );
	?>
	<div class="wrap">
		<h1><?php _e('Islamic Books Settings', 'edc-books'); ?></h1>
		<form method="post" action="">
			<input type="hidden" name="submitted" value="1" />
			<?php wp_nonce_field('edc_books_nonce', 'edc_books_update'); ?>
			
			<table class="form-table">
			<tr>
				<th scope="row"><label for="edc_categoty_title"><?php _e('Category Title', 'edc-books'); ?></label></th>
				<td>
					<input name="edc_categoty_title" type="text" id="edc_categoty_title" value="<?php echo esc_attr($edc_categoty_title); ?>" class="regular-text" />
					<p class="description"><?php _e('if empty will write category name.', 'edc-books'); ?></p>
				</td>
			</tr>
				
			<tr>
			<th scope="row"><label for="edc_view_js"><?php _e('JavaScript', 'edc-books'); ?></label></th>
			<td>
				<select name="edc_view_js" id="edc_view_js">
					<?php
						if($edc_view_js == 1){
							echo '<option value="1" selected="selected">'. __('Activate', 'edc-books') .'</option>';
							echo '<option value="0">'. __('Inactivate', 'edc-books') .'</option>';
						}else{
							echo '<option value="1">'. __('Activate', 'edc-books') .'</option>';
							echo '<option value="0" selected="selected">'. __('Inactivate', 'edc-books') .'</option>';
						}
					?>
				</select>
				<p class="description"><?php _e('If there is a problem, disable this option.', 'edc-books'); ?></p>
				</td>
			</tr>
						
			<tr>
			<th scope="row"><label for="edc_category_id"><?php _e('Choose category', 'edc-books'); ?></label></th>
			<td><?php echo EDC_Books_view_categories(0); ?></td>
			</tr>
		
			</table>
				
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Update', 'edc-books'); ?>" /></p>
		</form>
		<p><?php _e('Copy shortcode and paste into post/page:', 'edc-books'); ?> <code>EDC_books[<?php echo $edc_category_id; ?>]</code></p>
		<p><a href="widgets.php"><?php _e('Insert Books by widgets.', 'edc-books'); ?></a></p>
		<div id="free-books">
			<div class="viewbook"><?php echo EDC_Books_view_books($edc_category_id); ?></div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
<?php
}
