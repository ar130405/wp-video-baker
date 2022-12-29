<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.

function get_google_fonts(){
	
	$response = wp_remote_post( 'https://wpvideobaker.com/api/font_list.json');
	
	$f = json_decode($response['body'],true)['items'];
	
	foreach($f as $v){
		
		foreach($v['files'] as $key=>$var){
			$fonts[$v['family'].':'.$key] = $v['family'].' - '.$key;
		}
		
	}
	
	return $fonts;
}
function get_google_voices(){
	
	$lang = wp_remote_post('https://wpvideobaker.com/api/functions/lang.csv');
	
	$langex = explode(',',$lang['body']);
	foreach($langex as $l ){
		$ex = explode(':',$l);
		$chars = array("\r\n", '\\n', '\\r', "\n", "\r", "\t", "\0", "\x0B");
		$key = str_replace($chars,"",$ex[0]);
		if(isset($ex[2])){
			$langarr[$key] = $ex[1] .'-'. $ex[2];			
		}
	}
	
	$vl = json_decode(wp_remote_post('https://wpvideobaker.com/api/functions/voices.json')['body'],true)['voices'];
	foreach($vl as $v){
		$ex = explode('-',$v['name']);
		if(isset($langarr[$ex[0].'-'.strtolower($ex[1])])){
			$voices[$v['name']. '|' . $v['ssmlGender']] = $langarr[$ex[0].'-'.strtolower($ex[1])].'-'.$v['ssmlGender'].'-version '.$ex[3].'-'. $ex[2];
		} else {
			$voices[$v['name']. '|' . $v['ssmlGender']] = $ex[0].'-'.strtolower($ex[1]).'-'.$v['ssmlGender'].'-version '.$ex[3].'-'. $ex[2];
		}
	}

	return $voices;
}

function welcome_window() {

	$options = get_option( 'video_baker_admin' );

	?>
	
	<iframe width="800" height="500" style="margin: 50px 0; " src="https://www.youtube.com/embed/wtvV5Ss8td4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	
	<script>
	
		<?php if(check_license() == 367 || check_license() == 319 || check_license() == 320 || check_license() == 321){ ?>
			jQuery(window).on('load', function(){
				jQuery("input[data-depend-id=license]").parent().append('<br/><span style="color:green">Account is Active.</span>');
			});
		<?php } else if(check_license() == 400){ ?>
			jQuery(window).on('load', function(){
				jQuery("input[data-depend-id=license]").parent().append('<br/><span style="color:red">Your Account is Inactive. Please Check Profile Page.</span>');
			});		
		<?php } else if(check_license() == 500){?>
			jQuery(window).on('load', function(){
				jQuery("input[data-depend-id=license]").parent().append('<br/><span style="color:red">Incorect API KEY.</span>');
			});		
		<?php }  ?>
		
	</script>
	
	<?php
}

function check_license() {

	$options = get_option( 'video_baker_admin' );
	$status = wp_remote_post('https://wpvideobaker.com/api/checkuser.php/?key='.$options['license']);
	return $status['body'];

}

function create_buttons(){

	$repeater = (isset(get_post_meta( get_the_ID(), 'videobaker_post', true )['video-section']) ? get_post_meta( get_the_ID(), 'videobaker_post', true )['video-section'] : false );
	$options = get_option( 'video_baker_admin' );

	
	echo "<div>";
	if($repeater){
		if(check_license() != 400 && check_license() != 500){
			echo "<input type='button' value='Generate Video' id='gen_video' style='color:white; background: #10393B; border:unset; cursor:pointer; font-size: 16px; padding: 5px 15px; margin-right:15px; border-radius:3px; ' data-api='".$options['license']."' data-id='".get_the_ID()."'/>";
		} else {
			echo '<div class="csf-field-notice apikeynotice"><div class="csf-notice csf-notice-danger">Please check API KEY!</div></div>';
		}
	} else {
		echo '<div class="csf-field-notice apikeynotice"><div class="csf-notice csf-notice-warning">Please add some video blocks. Save & reload the page in order to generate video.</div></div>';
	}
	echo "</div>";
	echo "<img src='".plugin_dir_url( __FILE__ )."/assets/img/Spinner.gif' width='50' id='loading' />";
	

}


function send_data() {
	
		$args = array(
			'body'        => json_encode(array(get_post_meta($_POST['id'],'videobaker_post'),get_option( 'video_baker_admin' ))),
			'headers'     => array('Content-Type' => 'application/json','Authorization' => sanitize_text_field($_POST['api'])),
			'timeout'     => '60',
		);
		
		$response = wp_remote_post( 'https://wpvideobaker.com/api/add_to_db.php', $args );

		echo $response['body'];
			
		wp_die(); 
		
		
		
}

add_action( 'wp_ajax_send_data', 'send_data' );

function generate_preview(){ ?>
	<?php if(isset(get_post_meta( get_the_ID(), 'videobaker_post', true )['video-section'])){ ?>
	
		<iframe
		  src="https://template-slideshow-preview-xi.vercel.app/"
		  width="100%"
		  height="800px"
		  title="Video Preview"
		  id="preview_iframe"
		></iframe>
		
	<?php } else { ?>
	
		<img src='<?php echo plugin_dir_url( __FILE__ ); ?>/assets/img/Spinner.gif' width='50' id='loading' />
	
	<?php } ?>

<?php }

function preview_data() {
	
	$args = array(
		'body'        => json_encode(array(get_post_meta(get_the_ID(),'videobaker_post'),get_option( 'video_baker_admin' ))),
		'headers'     => array('Content-Type:application/json'),
		'timeout'     => '60',
	);
	
	$response = wp_remote_post( 'https://wpvideobaker.com/api/generate_preview.php', $args );
	
?>
	<script>
		const preview_data = <?php echo $response['body']; ?>;
	</script>
<?php }
add_action( 'admin_head', 'preview_data' );

