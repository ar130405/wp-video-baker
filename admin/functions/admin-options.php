<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.
$fonts = vbaker_get_google_fonts();


$prefix = 'video_baker_admin';

//
// Create options
//
CSF::createOptions( $prefix, array(
	'menu_title' => 'WPVideoBaker',
	'menu_slug'  => 'video_baker',
	'ajax_save'  => false,
	'framework_title' 	=> 'WPVideoBaker Settings',
	'footer_text'		=> 'Thank you for using WPVIDEOBAKER',
	'theme'             => 'light',
) );


CSF::createSection( $prefix, array(
	'title'  => 'Welcome',
	'icon'   => 'fas fa-rocket',
		'fields' => array(
			array(
				'type'     => 'callback',
				'function' => 'vbaker_welcome_window',
			),
			array(
				'id'          => 'license',
				'title'       => esc_html__('API KEY', 'video_baker' ),
				'type'        => 'text',
				'before'       => '<div class="validation_license"></div>',
				'subtitle' => '<div><b style="color:red;">In order to be abale to start create videos you need to register on our website: <a href="https://wpvideobaker.com/" target="_blank">WPVideoBaker</a> and get an API KEY from your profile page.</b></div>'
			),
		)
	)
);

CSF::createSection( $prefix, array(
		'title'  => 'Global Settings',
		'icon'   => 'fas fa-rocket',
		'fields' => array(
			array(
				'id'      => 'Logo',
				'title'   => esc_html__( 'Your Logo', 'video_baker' ),
				'desc'    => esc_html__( 'Only Pro users', 'video_baker' ),
				'type'    => 'upload',
				'preview' => true,
				'default' => '',
			),
			array(
				'id'      => 'logo_position',
				'title'   => esc_html__('Logo position', 'video_baker' ),
				'desc'    => esc_html__( 'Only Pro users', 'video_baker' ),
				'type'    => 'select',
				'default' => 'center',
				'options' => array(
					'top-center'   => 'Top Center',
					'top-left' => 'Top Left',
					'top-right'  => 'Top Right',
					'center-left' => 'Center left ',
					'center'  => 'Center',
					'center-right'  => 'Center Right',
					'bottom-left' => 'Bottom Left ',
					'bottom center'  => 'Bottom Center',
					'bottom-right'  => 'Botttom Right',
				),
			),
			array(
				'id'      => 'main_bg_img',
				'title'   => esc_html__( 'Main Background Image', 'video_baker' ),
				'type'    => 'upload',
				'preview' => true,
				'default' => '',
			),
			array(
				'id'      => 'main_bg_color',
				'title'   => esc_html__( 'Main Background Color', 'video_baker' ),
				'desc'    => esc_html__( 'This color will be used to fill background on all slides, if background image not set.', 'video_baker' ),
				'type'    => 'color',
				'default' => '',
			),
			array(
				'id'      => 'titles_color',
				'title'   => esc_html__( 'Titles Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '#fff',
			),
			array(
				'id'      => 'text_color',
				'title'   => esc_html__( 'Text Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '',
				'default' => '#000',
			),
			array(
				'id'      => 'title_color_bg',
				'title'   => esc_html__( 'Titles Background Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '#000',
			),
			array(
				'id'      => 'text_color_bg',
				'title'   => esc_html__( 'Text Background Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '',
			),
			array(
				'id'      => 'title_font',
				'title'   => esc_html__('Choose font for your titles', 'video_baker' ),
				'type'    => 'select',
				'options' => $fonts,
				'default' => 'Mulish:900',
				'chosen' => true
			),
			array(
				'id'      => 'subtitle_font',
				'title'   => esc_html__('Choose font for your subtitles', 'video_baker' ),
				'type'    => 'select',
				'options' => $fonts,
				'default' => 'Mulish:600',
				'chosen' => true
			),
			array(
				'id'      => 'text_font',
				'title'   => esc_html__('Choose font for your text', 'video_baker' ),
				'type'    => 'select',
				'options' => $fonts,
				'default' => 'Space Mono:regular',
				'chosen' => true
			),
			array(
				'id'      => 'left_img-right_text_bg',
				'title'   => esc_html__( 'Left Image / Right Text Image Background', 'video_baker' ),
				'type'    => 'upload',
				'default' => plugin_dir_url( __FILE__ )."assets/img/blcakwhite-6.png",
				'preview' => true,
			),
			array(
				'id'      => 'right_img-left_text_bg',
				'title'   => esc_html__( 'Right Image / left Text Image Background', 'video_baker' ),
				'type'    => 'upload',
				'default' => plugin_dir_url( __FILE__ )."assets/img/blcakwhite-5.png",
				'preview' => true,
			),
			array(
				'id'      => 'only_text_bg',
				'title'   => esc_html__( 'Only text / Without Image Background', 'video_baker' ),
				'default' => plugin_dir_url( __FILE__ )."assets/img/blcakwhite-4.png",
				'type'    => 'upload',
				'preview' => true,
			),
			 array(
				'id'      => 'text-to-speech-language',
				'title'   => esc_html__('Voice Overlay Language', 'video_baker' ),
				'type'    => 'select',
				'options' => vbaker_get_google_voices(),
				'chosen' => true,
				'default' => 'en-US-Neural2-J|MALE',
			),
			array(
				'id'      => 'disable-synthesis',
				'title'   => esc_html__('Disable Voice Overlay', 'video_baker' ),
				'type'    => 'checkbox',
				'default' => 0,
			),
			array(
				'id'          => 'webhook_url',
				'title'       => 'Webhook Url',
				'type'        => 'text',
				'desc' => 'Once video is ready, we will send a link to the video to this webhook.',
			),
		)
	)
);

CSF::createSection( $prefix, array(
	'title'  => 'Opener settings',
	'icon'   => 'fas fa-rocket',
		'fields' => array(
			array(
				'id'      => 'main_opener_img',
				'title'   => esc_html__( 'Opener Background Image', 'video_baker' ),
				'type'    => 'upload',
				'default' => plugin_dir_url( __FILE__ )."assets/img/blcakwhite-4.png",
				'preview' => true,
			),
			array(
				'id'      => 'opener_bg_color',
				'title'   => esc_html__( 'Opener Background Color', 'video_baker' ),
				'desc'    => esc_html__( 'This color will be used to fill background on opener, if background image not set.', 'video_baker' ),
				'type'    => 'color',
				'default' => '',
			),
			array(
				'id'      => 'opener_titles_color',
				'title'   => esc_html__( 'Titles Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '#fff',
			),
			array(
				'id'      => 'opener_text_color',
				'title'   => esc_html__( 'Text Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '#fff',
			),
			array(
				'id'      => 'opener_title_color_bg',
				'title'   => esc_html__( 'Titles Background Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '#000',
			),
			array(
				'id'      => 'opener_text_color_bg',
				'title'   => esc_html__( 'Text Background Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '#000',
			),
			array(
				'id'      => 'title_font_opener',
				'title'   => esc_html__('Choose font for your opener title', 'video_baker' ),
				'type'    => 'select',
				'options' => $fonts,
				'default' => 'Mulish:900',
				'chosen' => true
			),
			array(
				'id'      => 'text_font_opener',
				'title'   => esc_html__('Choose font for your opener text', 'video_baker' ),
				'type'    => 'select',
				'options' => $fonts,
				'default' => 'Space Mono:regular',
				'chosen' => true
			),
			array(
				'id'      => 'opener position',
				'title'   => esc_html__('Choose text and title position', 'video_baker' ),
				'type'    => 'select',
				'default' => 'center',
				'options' => array(
					'top-center'   => 'Top Center',
					'top-left' => 'Top Left',
					'top-right'  => 'Top Right',
					'center-left' => 'Center left ',
					'center'  => 'Center',
					'center-right'  => 'Center Right',
					'bottom-left' => 'Bottom Left ',
					'bottom center'  => 'Bottom Center',
					'bottom-right'  => 'Botttom Right',
				),
			),
		)
	)
);

CSF::createSection( $prefix, array(
	'title'  => 'Thank You settings',
	'icon'   => 'fas fa-rocket',
		'fields' => array(
			array(
				'id'      => 'main_goodbye_img',
				'title'   => esc_html__( 'Thank You Background Image', 'video_baker' ),
				'type'    => 'upload',
				'default' => plugin_dir_url( __FILE__ )."assets/img/blcakwhite-4.png",
				'preview' => true,
			),
			array(
				'id'      => 'goodbye_bg_color',
				'title'   => esc_html__( 'Thank You Background Color', 'video_baker' ),
				'desc'    => esc_html__( 'This color will be used to fill background on final slide, if background image not set.', 'video_baker' ),
				'type'    => 'color',
			),
			array(
				'id'      => 'goodbye_titles_color',
				'title'   => esc_html__( 'Titles Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '#fff',
			),
			array(
				'id'      => 'goodbye_text_color',
				'title'   => esc_html__( 'Text Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '#fff',
			),
			array(
				'id'      => 'goodbye_title_color_bg',
				'title'   => esc_html__( 'Titles Background Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '#000',
			),
			array(
				'id'      => 'goodbye_text_color_bg',
				'title'   => esc_html__( 'Text Background Color', 'video_baker' ),
				'type'    => 'color',
				'default' => '#000',
			),
			array(
				'id'      => 'title_font_goodbye',
				'title'   => esc_html__('Choose font for your Thank You title', 'video_baker' ),
				'type'    => 'select',
				'options' => $fonts,
				'default' => 'Mulish:900',
				'chosen' => true
			),
			array(
				'id'      => 'text_font_goodbye',
				'title'   => esc_html__('Choose font for your Thank You text', 'video_baker' ),
				'type'    => 'select',
				'options' => $fonts,
				'default' => 'Space Mono:regular',
				'chosen' => true
			),
			array(
				'id'      => 'goodbye_position',
				'title'   => esc_html__('Choose text and title position', 'video_baker' ),
				'type'    => 'select',
				'default' => 'center',
				'options' => array(
					'top-center'   => 'Top Center',
					'top-left' => 'Top Left',
					'top-right'  => 'Top Right',
					'center-left' => 'Center left ',
					'center'  => 'Center',
					'center-right'  => 'Center Right',
					'bottom-left' => 'Bottom Left ',
					'bottom center'  => 'Bottom Center',
					'bottom-right'  => 'Botttom Right',
				),
			),
		)
	)
);

CSF::createSection( $prefix, array(
	'title'  => 'Import/Export Settings',
	'icon'   => 'fas fa-rocket',
		'fields' => array(
			array(
			  'type' => 'backup',
			),
		)
	)
);

