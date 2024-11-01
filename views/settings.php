<?php
//create custom post type for shortcode
function rs_team_custom_post_create_team_type() {

	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Shortcodes', 'Post Type General Name', 'rs-team-settings' ),
			'singular_name'       => _x( 'Shortcode', 'Post Type Singular Name', 'rs-team-settings' ),
			'menu_name'           => __( 'Shortcodes', 'rs-team-settings' ),
			'parent_item_colon'   => __( 'Parent Shortcode', 'rs-team-settings' ),
			'all_items'           => __( 'All Shortcodes', 'rs-team-settings' ),
			'view_item'           => __( 'View Shortcode', 'rs-team-settingse' ),
			'add_new_item'        => __( 'Create New Shortcode', 'rs-team-settings' ),
			'add_new'             => __( 'Add New Shortcode', 'rs-team-settings' ),
			'edit_item'           => __( 'Edit Shortcode', 'rs-team-settings' ),
			'update_item'         => __( 'Update Shortcode', 'rs-team-settings' ),
			'search_items'        => __( 'Search Shortcode', 'rs-team-settings' ),
			'not_found'           => __( 'Not Found', 'rs-team-settings' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'rs-team-settings' ),
		);

	// Set other options for Custom Post Type
		$args = array(
			'label'               => __( 'Shortcodes', 'rs-team-settings' ),
			'description'         => __( 'Shortcode news and reviews', 'rs-team-settings' ),
			'labels'              => $labels,
			'supports'            => array( 'title'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu' 		  => 'edit.php?post_type=rs_team',
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);

		// Registering your Custom Post Type
		register_post_type( 'rs_team_settings', $args );

	}

	add_action( 'init', 'rs_team_custom_post_create_team_type');	
		
/*--------------------------------------------------------------
*			Meatbox for slider type
*-------------------------------------------------------------*/

function rs_team_settings_show_type() {
	add_meta_box( 'Slider Show Meta', esc_html__( 'Slider Settings', 'rs_team_settings' ), 'rs_team__setting_info_meta_callback', 'rs_team_settings', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'rs_team_settings_show_type');


// Setting Info

	function rs_team__setting_info_meta_callback($show_type) {
	?>
<div style="margin:10px 0">
  <label for="Primary Color" style="width:150px; display:inline-block;">
    <?php esc_html_e( 'Primary Color', 'rs_team_settings' ) ?>
  </label>
  <?php $primary_color= get_post_meta( get_the_ID(), 'primary_color', true ); ?>
  <input size='10' name='primary_color' class='primary_color' type='text' id="primary_color" value="<?php echo ($primary_color)? $primary_color: '#000000'; ?>"/>
</div>

<div style="margin:10px 0">
  <label for="Icon Color" style="width:150px; display:inline-block;">
    <?php esc_html_e( 'Icon Color', 'rs_team_settings' ) ?>
  </label>
  <?php $icon_color= get_post_meta( get_the_ID(), 'icon_color', true ); ?>
  <input size='10' name='icon_color' class='icon_color' type='text' id="icon_color" value="<?php echo ($icon_color)? $icon_color: '#000000'; ?>"/>
</div>


<div style="margin:10px 0">
  <label for="Slider Type" style="width:150px; display:inline-block;">
    <?php esc_html_e( 'Per Row', 'rs_team_settings' ) ?>
  </label>
  <?php $per_row = get_post_meta( get_the_ID(), 'per_row', true ); ?>
  <select name="per_row"  style="    text-transform: capitalize;">
    <option selected="selected" value="<?php echo ($per_row)? $per_row: 4 ; ?>"><?php echo ($per_row)? $per_row: 4 ; ?></option>
    <option value="4">4 </option>
    <option  value="3">3 </option>
    <option  value="2">2 </option>
    <option  value="1">1 </option>
  </select>
</div>
<div style="margin:10px 0">
  <label for="Slider Type" style="width:150px; display:inline-block;">
    <?php esc_html_e( 'Slider Type', 'rs_team_settings' ) ?>
  </label>
  <?php $slider_type = get_post_meta( get_the_ID(), 'slider_type', true ); ?>
  <select name="slider_type"  style="    text-transform: capitalize;">
    <option selected="selected" value="<?php echo ($slider_type)? $slider_type: grid ; ?>"><?php echo ($slider_type)? $slider_type: Grid ; ?></option>
    <option value="grid">Grid</option>
    <option value="wide">Wide</option>
    <option  value="slider">Slider</option>
  </select>
</div>
<div style="margin:10px 0">
  <label for="Primary Color" style="width:150px; display:inline-block;">
    <?php esc_html_e( 'Items Per Page', 'rs_team_settings' ) ?>
  </label>
  <?php $per_page= get_post_meta( get_the_ID(), 'per_page', true ); ?>
  <input size='10' name='per_page' class='per_page' type='text' id="per_page"  value='<?php echo ($per_page)? $per_page: -1 ; ?>'/>
</div>
<?php }
    /*--------------------------------------------------------------
	*			Save team setting  meta
	*-------------------------------------------------------------*/

function save_rs_team_settings_meta( $post_id ) {
	

	if ( 'rs_team_settings' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$mymeta = array( 'slider_type','primary_color','per_row', 'per_page','icon_color' );

	foreach ( $mymeta as $keys ) {

		if ( is_array( $_POST[ $keys ] ) ) {
			$data = array();

			foreach ( $_POST[ $keys ] as $key => $value ) {
				$data[] = $value;
			}
		} else {
			$data = sanitize_text_field( $_POST[ $keys ] );
		}

		update_post_meta( $post_id, $keys, $data );
	}

}

add_action( 'save_post', 'save_rs_team_settings_meta' );

	   /*--------------------------------------------------------------
 		*add submenu
	  *-------------------------------------------------------------*/
	
	function add_team_menu(){
			
			 add_submenu_page('edit.php?post_type=rs_team', __('Create Shortcode','rs_team'), __('Create Shortcode','rs_team'), 'manage_options',             'post-new.php?post_type=rs_team_settings');
	}
	
	 add_action('admin_menu','add_team_menu');
	 
	 
	 /*-----------------------------------
	 Settings text for title and save etc
	 -------------------------------------*/
	 
	 function rs_team_rs_team_settings_admin_enter_title( $input ) {
		global $post_type;

		if ( 'rs_team_settings' == $post_type )
			return __( 'Enter Shortcode Name', 'rs_team_settings' );

		return $input;
	}
	add_filter( 'enter_title_here', 'rs_team_rs_team_settings_admin_enter_title' );

	
	function rs_team_rs_team_settings_admin_updated_messages( $messages ) {
		global $post, $post_id;
		$messages['rs_team_settings'] = array( 
			1 => __('Shortcode updated.', 'rs_team_settings'),
			2 => $messages['post'][2],
			3 => $messages['post'][3],
			4 => __('Shortcode updated.', 'rs_team_settings'),
			5 => isset($_GET['revision']) ? sprintf( __('Shortcode restored to revision from %s', 'rs_team_settings'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => __('Shortcode published.', 'rs_team_settings'),
			7 => __('Shortcode saved.', 'rs_team_settings'),
			8 => __('Shortcode submitted.', 'trs_team_settings'),
			9 => sprintf( __('Shortcode scheduled for: <strong>%1$s</strong>.', 'rs_team_settings'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) )),
			10 => __('Shortcode draft updated.', 'rs_team_settings'),
		);
		return $messages;
	}
	add_filter( 'post_updated_messages', 'rs_team_rs_team_settings_admin_updated_messages' );
	
	
	/*------------------------------------------
	Extra column make for shotcode custom post
	-------------------------------------------*/
		
	
	function rs_team_settings_add_shortcode_column( $columns ) {
		return array_merge( $columns,
			array( 'shortcode' => __( 'Shortcode', 'rs_team_settings' ) ) 
			
			);
	}
	add_filter( 'manage_rs_team_settings_posts_columns' , 'rs_team_settings_add_shortcode_column' );
	
	
	/*------------------------------------------
	Dynamic Shortcode generator
	-------------------------------------------*/

	function rs_team_settings_add_posts_shortcode_display( $column, $post_id ) {
		if ($column == 'shortcode'){
			?>
<input style="background:#ccc; width:250px" type="text" onClick="this.select();" value="[rsteamshortcode <?php echo 'id=&quot;'.$post_id.'&quot;';?>]" />
<br />
<textarea cols="50" rows="3" style="background:#ddd" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[rsteamshortcode id='; echo "'".$post_id."']"; echo '"); ?>'; ?></textarea>
<?php
		}
	}
	
	add_action( 'manage_rs_team_settings_posts_custom_column' , 'rs_team_settings_add_posts_shortcode_display', 10, 2 );	
?>
