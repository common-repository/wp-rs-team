<?php
/* post type with metabox */


// Member Image Size
add_theme_support( 'post-thumbnails' );
add_image_size( 'rs-member-image', 400, 400, true );


// Register Team Post Type
function rs_team_register_post_type() {

	$labels = array(
		'name'               => esc_html__( 'Members', 'rs-team' ),
		'singular_name'      => esc_html__( 'Member', 'rs-team' ),
		'add_new'            => esc_html_x( 'Add New Member', 'rs-team', 'rs-team' ),
		'add_new_item'       => esc_html__( 'Add New Member', 'rs-team' ),
		'edit_item'          => esc_html__( 'Edit Member', 'rs-team' ),
		'new_item'           => esc_html__( 'New Member', 'rs-team' ),
		'all_items'          => esc_html__( 'All Members', 'rs-team' ),
		'view_item'          => esc_html__( 'View Member', 'rs-team' ),
		'search_items'       => esc_html__( 'Search Members', 'rs-team' ),
		'not_found'          => esc_html__( 'No Members found', 'rs-team' ),
		'not_found_in_trash' => esc_html__( 'No Members found in Trash', 'rs-team' ),
		'parent_item_colon'  => esc_html__( 'Parent Member:', 'rs-team' ),
		'menu_name'          => esc_html__( 'RS Team', 'rs-team' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-businessman',
		'supports'           => array( 'title', 'thumbnail' )
	);

	register_post_type( 'rs_team', $args );

}

add_action( 'init', 'rs_team_register_post_type' );


// Meta Box



/*--------------------------------------------------------------
*			Member info
*-------------------------------------------------------------*/

function rs_team_member_info_meta_box() {
	add_meta_box( 'member_info_meta', esc_html__( 'Member Info', 'rs-team' ), 'rs_team_member_info_meta_callback', 'rs_team', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'rs_team_member_info_meta_box');


// member info callback
function rs_team_member_info_meta_callback( $member_info ) {

	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>

	<div style="margin: 10px 0;"><label for="designation" style="width:150px; display:inline-block;"><?php esc_html_e( 'Designation', 'rs-team' ) ?></label>
	<?php $designation = get_post_meta( $member_info->ID, 'designation', true ); ?>
	<input type="text" name="designation" id="designation" class="designation" value="<?php echo esc_html($designation); ?>" style="width:300px;"/>
	</div>
    
    <div style="margin: 10px 0;"><label for="Description" style="width:150px; display:inline-block;"><?php esc_html_e( 'Description', 'rs-team' ) ?></label>
	<?php $description = get_post_meta( $member_info->ID, 'description', true ); ?>
	<textarea name="description" id="description" class="description" style="width:300px; height:120px"/><?php echo esc_html($description); ?></textarea>
	</div>
    
    
    <div style="margin: 10px 0;"><label for="mail" style="width:150px; display:inline-block;"><?php esc_html_e( 'Mail', 'rs-team' ) ?></label>
	<?php $mail = get_post_meta( $member_info->ID, 'mail', true ); ?>
	<input type="text" name="mail" id="mail" class="mail" value="<?php echo esc_html($mail); ?>" style="width:300px;"/>
	</div>
    
    
    <div style="margin: 10px 0;"><label for="website" style="width:150px; display:inline-block;"><?php esc_html_e( 'Website', 'rs-team' ) ?></label>
	<?php $website = get_post_meta( $member_info->ID, 'website', true ); ?>
	<input type="text" name="website" id="website" class="website" value="<?php echo esc_html($website); ?>" style="width:300px;"/>
	</div>
    
    
    <div style="margin: 10px 0;"><label for="phone" style="width:150px; display:inline-block;"><?php esc_html_e( 'Phone', 'rs-team' ) ?></label>
	<?php $phone = get_post_meta( $member_info->ID, 'phone', true ); ?>
	<input type="text" name="phone" id="phone" class="phone" value="<?php echo esc_html($phone); ?>" style="width:300px;"/>
	</div>
    
    
    <div style="margin: 10px 0;"><label for="address" style="width:150px; display:inline-block;"><?php esc_html_e( 'Address', 'rs-team' ) ?></label>
	<?php $address = get_post_meta( $member_info->ID, 'address', true ); ?>
	<input type="text" name="address" id="address" class="address" value="<?php echo esc_html($address); ?>" style="width:300px;"/>
	</div>

<?php }


/*--------------------------------------------------------------
*			Member social links
*-------------------------------------------------------------*/

function rs_team_member_social_link_meta_box() {
	add_meta_box( 'member_social_link_meta', esc_html__( 'Member Social Links', 'rs-team' ), 'rs_team_social_meta_link_callback', 'rs_team', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'rs_team_member_social_link_meta_box' );


// Social Meta Callback
function rs_team_social_meta_link_callback( $social_meta ) {

	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>

	<!-- member social -->
	<div class="wrap-meta-group">

		<div style="margin: 10px 0;"><label for="facebook" style="width:150px; display:inline-block;"><?php esc_html_e( 'Facebook', 'rs-team' ) ?></label>
			<?php $facebook = get_post_meta( $social_meta->ID, 'facebook', true ); ?>
			<input type="text" name="facebook" id="facebook" class="facebook" value="<?php echo esc_html($facebook); ?>" style="width:300px;"/>
		</div>

		<div style="margin: 10px 0;"><label for="twitter" style="width:150px; display:inline-block;"><?php esc_html_e(
					'Twitter', 'rs-team' ) ?></label>
			<?php $twitter = get_post_meta( $social_meta->ID, 'twitter', true ); ?>
			<input type="text" name="twitter" id="twitter" class="twitter" value="<?php echo esc_html($twitter); ?>" style="width:300px;"/>
		</div>

		<div style="margin: 10px 0;"><label for="google_plus" style="width:150px; display:inline-block;"><?php esc_html_e( 'Google Plus', 'rs-team' ) ?></label>
			<?php $google_plus = get_post_meta( $social_meta->ID, 'google_plus', true ); ?>
			<input type="text" name="google_plus" id="google_plus" class="google_plus" value="<?php echo esc_html($google_plus); ?>" style="width:300px;"/>
		</div>

		<div style="margin: 10px 0;"><label for="linkedin" style="width:150px; display:inline-block;"><?php esc_html_e( 'Linkedin', 'rs-team' ) ?></label>
			<?php $linkedin= get_post_meta( $social_meta->ID, 'linkedin', true ); ?>
			<input type="text" name="linkedin" id="linkedin" class="linkedin" value="<?php echo esc_html($linkedin); ?>" style="width:300px;"/>
		</div>

	</div>
<?php }


/*--------------------------------------------------------------
 *			Save member social meta
*-------------------------------------------------------------*/
function save_rs_team_member_social_meta( $post_id ) {
	if ( ! isset( $_POST['member_social_metabox_nonce'] ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( 'rs_team' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$mymeta = array( 'facebook', 'twitter', 'google_plus', 'linkedin', 'designation', 'description','mail','website','phone','address' );

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

add_action( 'save_post', 'save_rs_team_member_social_meta' );