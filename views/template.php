<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly



 /*=====================================================================
	// RS Team ShortCode
  =======================================================================*/

	function rs_team_shortcode( $atts ) {	


 /*=====================================================================
	//take shorcode ID
  =======================================================================*/
	
	$atts = shortcode_atts(
		array(
			'id' => "", 
		), $atts);
		global $post;
		$post_id = $atts['id'];		
		if($post_id!='xx'){			
	 /*===========================================================
           //retrive settings value form settings page
       ============================================================*/
		
		$slider_type = get_post_meta($post_id, 'slider_type', true);
		$primary_color = get_post_meta($post_id, 'primary_color', true);
		$icon_color = get_post_meta($post_id, 'icon_color', true);
		$per_row = get_post_meta($post_id, 'per_row', true);
		$per_page = get_post_meta($post_id, 'per_page', true);
		
		$grid_size= (12/$per_row);
		$class_grid="cl-col-md-".$grid_size." cl-col-lg-".$grid_size." cl-col-sm-6 cl-col-xs-12";
	 /*=====================================================================
		//Slider type check 
	  =======================================================================*/
	
   if($slider_type=="grid"){
	?>  
	<?php	
  /*=====================================================================
	//Show custom data form rs team custom post
  =======================================================================*/
	
	$args = array(
		'post_type'      => 'rs_team',
		'orderby'        => 'date',
		'order'          => 'ASC',
		'posts_per_page' => $per_page
	);

	$que = new WP_Query( $args );	
    $outline .= '<div class="cl-member">';
		$outline .= '<div class="cl-member-wrap">';
			$outline .= '<div class="cl-row layout5">';			 

					if ( $que->have_posts() ) {
						while ( $que->have_posts() ) : $que->the_post();
				
							$member_image = get_the_post_thumbnail_url( get_the_ID(), 'rs-team-member-image' );
         
		   
					$outline .= '<div class="'.$class_grid.' cl-margin-bottom">';
 						$outline .= '<div class="single-member-area">';		
			
							$outline .= '<div class="cl-single-member">';
			
					/*=====================================================================
						//retrive data form team post type
 					 =======================================================================*/
								 
								if ( has_post_thumbnail() ) {
									$outline .= '<figure><img src="' . $member_image . '" alt="' . get_the_title() . '"></figure>';
								}
								$designation = get_post_meta( get_the_ID(), 'designation', true );
								$description = get_post_meta( get_the_ID(), 'description', true );
								$mail        = get_post_meta( get_the_ID(), 'mail', true );
								$website     = get_post_meta( get_the_ID(), 'website', true );
								$phone       = get_post_meta( get_the_ID(), 'phone', true );
								$address     = get_post_meta( get_the_ID(), 'address', true );
								$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
								$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
								$google_plus = get_post_meta( get_the_ID(), 'google_plus', true );
								$linkedin    = get_post_meta( get_the_ID(), 'linkedin', true );					
		
			
								$outline .= '<div class="overlay">';
								$outline .= '<div class="overlay-element">';      
									
									//$outline .= '<span class="detail-link">
									 		//<a href="#" data-id="1" class="cl-single-item-popup"><i class="fa fa-plus"></i></a>
									// </span>';		
									 	  
									$outline .= '<div class="social-icons">
									<a style="background:'.$icon_color.'"; href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa 	fa-facebook"></i></a> 
									<a style="background:'.$icon_color.'"; href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i></a>
									<a style="background:'.$icon_color.'"; href="' . esc_url( $google_plus ) . '" target="_blank"><i class="fa fa-google-plus";></i></a>
									<a style="background:'.$icon_color.'"; href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin";></i></a>
									 </div>';
				
							$outline .= '</div>';
							$outline .= '</div>';
							$outline .= '</div>';
          
			
	
           	 
			$outline .= '<article>';
				$outline .= '<div class="cl-content-layout1" style="background:'.$primary_color.'";>';		
					
					/*=====================================================================
						//show team Info
 					 =======================================================================*/
					
						$outline .= '<h3 class="rs-member-name text-center">' . esc_html( get_the_title() ) . '</h3>';
						if ( $designation ) {
								$outline .= '<div class="member-title text-center">' . esc_html( $designation ) . '</div>';	
						}
					    $outline .= '</div>';	
				
						if ( $description ) {
							$outline .= '<div class="short-bio">' . esc_html( $description ) . '</div>';	
						}
			
			$outline .= '<div class="contact-info">';
				$outline.='<ul>';	
					 if ( $mail ) {
						$outline .= '<li><i class="fa fa-envelope-o" style="color:'.$icon_color.'";></i><a href="mailto:'. esc_html( $mail ) . '"> ' . esc_html( $mail ) . '</a></li>';	
						}
						
					if ( $website ) {
						$outline .= '<li><i class="fa fa-globe" style="color:'.$icon_color.'";></i><a href="'. esc_html( $website ) .'"target="_blank">' . esc_html( $website ) . '</a></li>';	
						}
						
					 if ( $phone ) {
						$outline .= '<li><i class="fa fa-phone" style="color:'.$icon_color.'";></i>' . esc_html( $phone ) . '</li>';	
						}
						
					 if ( $address ) {
						$outline .= '<li><i class="fa fa-map-marker" style="color:'.$icon_color.'";></i>' . esc_html( $address ) . '</li>';	
						}
			
        	 		$outline.='</ul>';
         		$outline .= '</div>';		
			$outline .= '</article>';
        $outline .= '</div>';
$outline .= '</div>';

		endwhile;
		wp_reset_postdata();

	} 
	
	else {
		$outline .= '<h2 class="rs-not-found-any-member">' . esc_html__( 'Not found any member', 'rs-team' ) . '</h2>';
	}

	  
	   $outline .= '</div>'; /*end class cl-row */
	  $outline .= '</div>'; /*end class cl-member-wrap */
	$outline .= '</div>'; /*end class cl memeber */
	return $outline;
}




/*=====================================================================
		//wide style start here
=======================================================================*/
	
   if($slider_type=="wide"){
    
		/**
		 * adding wide view template
		 */
		

	
  /*=====================================================================
	//Show custom data dorm rs team custom post
  =======================================================================*/
	
	$args = array(
		'post_type'      => 'rs_team',
		'orderby'        => 'date',
		'order'          => 'ASC',
		'posts_per_page' => $per_page
	);

	$que = new WP_Query( $args );	
	
    $outline .= '<div class="wide"> <div class="cl-member">';
		$outline .= '<div class="cl-member-wrap">';
			$outline .= '<div class="cl-row layout5">';			 

					if ( $que->have_posts() ) {
						while ( $que->have_posts() ) : $que->the_post();
				
							$member_image = get_the_post_thumbnail_url( get_the_ID(), 'rs-team-member-image' );
         
		   
					$outline .= '<div class="cl-col-md-12 cl-col-lg-12 cl-col-sm-12 cl-col-xs-12 cl-margin-bottom">';
 						$outline .= '<div class="single-member-area">';		
			
							$outline .= '<div class="cl-single-member cl-col-md-3 cl-col-sm-12 cl-col-xs-12">';
			
					/*=====================================================================
						//retrive data form team post type
 					 =======================================================================*/
								 
								if ( has_post_thumbnail() ) {
									$outline .= '<figure><img src="' . $member_image . '" alt="' . get_the_title() . '"></figure>';
								}
								$designation = get_post_meta( get_the_ID(), 'designation', true );
								$description = get_post_meta( get_the_ID(), 'description', true );
								$mail        = get_post_meta( get_the_ID(), 'mail', true );
								$website     = get_post_meta( get_the_ID(), 'website', true );
								$phone       = get_post_meta( get_the_ID(), 'phone', true );
								$address     = get_post_meta( get_the_ID(), 'address', true );
								$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
								$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
								$google_plus = get_post_meta( get_the_ID(), 'google_plus', true );
								$linkedin    = get_post_meta( get_the_ID(), 'linkedin', true );
								
		
			
							$outline .= '</div>';
          
			
	
           	 
			$outline .= '<div class="cl-col-md-9 cl-col-sm-12 cl-col-xs-12"><article>';
				$outline .= '<div class="cl-content-layout1" style="background:'.$primary_color.'";>';		
					
					/*=====================================================================
						//show team Info
 					 =======================================================================*/
					
						$outline .= '<h3 class="rs-member-name" style="text-align:left">' . esc_html( get_the_title() ) . '</h3>';
						if ( $designation ) {
								$outline .= '<div class="member-title" style="text-align:left">' . esc_html( $designation ) . '</div>';	
						}
					    $outline .= '</div>';	
				
						if ( $description ) {
							$outline .= '<div class="short-bio">' . esc_html( $description ) . '</div>';	
						}
						
					/*=====================================================================
						//show personal Info
 					 =======================================================================*/	
			
			$outline .= '<div class="contact-info">';
				$outline.='<ul>';	
					 if ( $mail ) {
						$outline .= '<li><i class="fa fa-envelope-o" style="color:'.$icon_color.'";></i><a href="mailto:'. esc_html( $mail ) . '"> ' . esc_html( $mail ) . '</a></li>';	
						}
						
					if ( $website ) {
						$outline .= '<li><i class="fa fa-globe" style="color:'.$icon_color.'";></i><a href="'. esc_html( $website ) .'"target="_blank">' . esc_html( $website ) . '</a></li>';	
						}
						
					 if ( $phone ) {
						$outline .= '<li><i class="fa fa-phone" style="color:'.$icon_color.'";></i>' . esc_html( $phone ) . '</li>';	
						}
						
					 if ( $address ) {
						$outline .= '<li><i class="fa fa-map-marker" style="color:'.$icon_color.'";></i>' . esc_html( $address ) . '</li>';	
						}
			
        	 		$outline.='</ul>';
					
						/*=====================================================================
						//show Social Icon
 					 =======================================================================*/	
					
						$outline .= '<div class="social-icons">
									<a style="background:'.$icon_color.'"; href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa 	fa-facebook"></i></a> 
									<a style="background:'.$icon_color.'"; href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i></a>
									<a style="background:'.$icon_color.'"; href="' . esc_url( $google_plus ) . '" target="_blank"><i class="fa fa-google-plus";></i></a>
									<a style="background:'.$icon_color.'"; href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin";></i></a>
									 </div>';
					
         		$outline .= '</div>';		
			$outline .= '</article>';
        $outline .= '</div>';
$outline .= '</div>';
$outline .= '</div>';

		endwhile;
		wp_reset_postdata();

	} 
	
	else {
		$outline .= '<h2 class="rs-not-found-any-member">' . esc_html__( 'Not found any member', 'rs-team' ) . '</h2>';
	}

	  
	   $outline .= '</div>'; /*end class cl-row */
	  $outline .= '</div>'; /*end class cl-member-wrap */
	$outline .= '</div>'; /*end class cl memeber */
	$outline .= '</div>'; /*end class cl memeber */
	return $outline;

}



/* slider type team view start here-----------
------------------------------------------------- */
	
	if($slider_type="slider"){
	
    //team slider with carousel
        
		$outline   = '';

	// Query for team show
	
	$args = array(
		'post_type'      => 'rs_team',
		'orderby'        => 'date',
		'order'          => 'ASC'
	);

	$que = new WP_Query( $args );
	$custom_id = uniqid();
	$outline   = '';
    $outline .= '<div class="cl-member">';
		$outline .= '<div class="cl-member-wrap">';
			$outline .= '<div id="rs-team-' . $custom_id . '" class="rs-team-area">';
				$outline .= '<div class="cl-row layout5"><div class="owl-carousel owl-theme">';
				 
			
				if ( $que->have_posts() ) {
					while ( $que->have_posts() ) : $que->the_post();
			
						$member_image = get_the_post_thumbnail_url( get_the_ID(), 'rs-team-member-image' );				

						$outline .= ' <div class="item"><div class="cl-margin-bottom">';
						$outline .= '<div class="single-member-area">';		
						
						$outline .= '<div class="cl-single-member">';
						
						
						if ( has_post_thumbnail() ) {
							$outline .= '<figure><img src="' . $member_image . '" alt="' . get_the_title() . '"></figure>';
						}
						$designation = get_post_meta( get_the_ID(), 'designation', true );
						$description = get_post_meta( get_the_ID(), 'description', true );
						$mail        = get_post_meta( get_the_ID(), 'mail', true );
						$website     = get_post_meta( get_the_ID(), 'website', true );
						$phone       = get_post_meta( get_the_ID(), 'phone', true );
						$address     = get_post_meta( get_the_ID(), 'address', true );
						$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
						$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
						$google_plus = get_post_meta( get_the_ID(), 'google_plus', true );
						$linkedin    = get_post_meta( get_the_ID(), 'linkedin', true );
						
						//forntend view
						
							$outline .= '<div class="overlay">';
								$outline .= '<div class="overlay-element">';      
								
								//$outline .= '<span class="detail-link"> 
									//<a href="#" data-id="1" class="cl-single-item-popup"><i class="fa fa-plus"></i></a>
									$outline .= '<div class="social-icons">
										<a style="background:'.$icon_color.'"; href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa 	fa-facebook"></i></a> 
										<a style="background:'.$icon_color.'"; href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i></a>
										<a style="background:'.$icon_color.'"; href="' . esc_url( $google_plus ) . '" target="_blank"><i class="fa fa-google-plus";></i></a>
										<a style="background:'.$icon_color.'"; href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin";></i></a>
										 </div>';
									
								$outline .= '</div>';
							$outline .= '</div>';
						$outline .= '</div>';
					  
						
						//retrive general info
						 
							$outline .= '<article>';
									  $outline .= '<div class="cl-content-layout1" style="background:'.$primary_color.'";>';			
										$outline .= '<h3 class="rs-member-name text-center">' . esc_html( get_the_title() ) . '</h3>';
										if ( $designation ) {
												$outline .= '<div class="member-title text-center">' . esc_html( $designation ) . '</div>';	
											}
										$outline .= '</div>';	
								
									if ( $description ) {
										$outline .= '<div class="short-bio">' . esc_html( $description ) . '</div>';	
									}
							
								$outline .= '<div class="contact-info">';
										$outline.='<ul>';	
											 if ( $mail ) {
												$outline .= '<li><i class="fa fa-envelope-o" style="color:'.$icon_color.'";></i><a href="mailto:'. esc_html( $mail ) . '"> ' . esc_html( $mail ) . '</a></li>';	
												}
												
											if ( $website ) {
												$outline .= '<li><i class="fa fa-globe" style="color:'.$icon_color.'";></i><a href="'. esc_html( $website ) .'"target="_blank">' . esc_html( $website ) . '</a></li>';	
												}
												
											 if ( $phone ) {
												$outline .= '<li><i class="fa fa-phone" style="color:'.$icon_color.'";></i>' . esc_html( $phone ) . '</li>';	
												}
												
											 if ( $address ) {
												$outline .= '<li><i class="fa fa-map-marker" style="color:'.$icon_color.'";></i>' . esc_html( $address ) . '</li>';	
												}
									
											$outline.='</ul>';
         		$outline .= '</div>';		
							$outline .= '</article>';
						
						$outline .= '</div>';
						$outline .= '</div>';
						$outline .= '</div>';
			
					endwhile;
					wp_reset_postdata();
			
				} else {
					$outline .= '<h2 class="rs-not-found-any-member">' . esc_html__( 'Not found any member', 'rs-team' ) . '</h2>';
				}
				$outline .= '</div>';
			
				$outline .= '</div>';
			$outline .= '</div>';
		$outline .= '</div>';
		$outline .= '</div>';
		$outline .= '</div>';	
	

	return $outline;          
      
			}
	
		}	}

add_shortcode( 'rsteamshortcode', 'rs_team_shortcode' );