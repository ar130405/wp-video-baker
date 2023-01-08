<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.

//
// Metabox of the POST
// Set a unique slug-like ID
//
$prefix_post_opts = 'videobaker_post';

//
// Create a metabox
//
CSF::createMetabox( $prefix_post_opts, array(
  'title'        => 'WP VideoBaker Builder',
  'post_type'    => 'post',
  'class'        => 'slides_repeater',
  'show_restore' => true,
) );

CSF::createSection( $prefix_post_opts, array(
		'fields' => array(

			array(
				'id'           => 'audio_file',
				'type'         => 'upload',
				'title'        => 'Choose music / audio file',
				'placeholder'  => 'http://',
				'button_title' => 'Add File',
				'remove_title' => 'Remove File',
				'preview'		=> false,
				'desc' 			=> '<a href="https://pixabay.com/music/" target="_blank">Pixabay Music</a> - Free music library.' 
			),
			
			array(
				'id'          => 'update_email',
				'title'       => 'Send Link To Email',
				'type'        => 'text',
				'desc' => 'Once video generated, you will receive an updtae with download link to this email. By default, we will send an email to administrator email.',
				'default' => get_bloginfo('admin_email')
			),
			
			array(
			  'id'      => 'include_opener',
			  'type'    => 'switcher',
			  'title'   => 'Opener',
			  'label'   => 'To show opener?',
			  'default' => false
			),	
			
			array(
				'id'          => 'opener-title',
				'title'       => 'Opener title',
				'type'        => 'text',
			),
			array(
				'id'          => 'opener-text',
				'title'       => 'Opener Text',
				'type'        => 'textarea',
			),
			array(
				'id'          => 'opener-speech',
				'title'       => 'Your opener voice speech text',
				'type'        => 'textarea',
				'default'     => '',
			),
			
			array(
				'id'      => 'include_final',
				'type'    => 'switcher',
				'title'   => 'Thank you Section',
				'label'   => 'To show Thank You section?',
				'default' => false
			),			
			
			array(
				'id'          => 'goodbye-title',
				'title'       => 'Thank You title',
				'type'        => 'text',
				'default' 	=> ''
			),
			array(
				'id'          => 'goodbye-text',
				'title'       => 'Thank You Text',
				'type'        => 'textarea',
				'default' 	=> ''
			),
			array(
				'id'        => 'goodbye-speech',
				'title'     => 'Your Thank You voice speech text',
				'type'      => 'textarea',
				'default' 	=> ''
			),
			
			array(
				'id'     => 'video-section',
				'type'   => 'repeater',
				'title'  => 'Video Sections',
				'fields' => array(

					array(
						'id'    => 'video-section-title',
						'type'  => 'text',
						'title' => 'Video section Title'
					),
					array(
						'id'     => 'video-p',
						'type'   => 'repeater',
						'title'  => 'Video Section Paragraphs',
						'fields' => array(

							array(
								'id'    => 'opt-wp-editor-1',
								'type'  => 'textarea',
								'title' => 'Video Section Paragraph',
							),
							array(
								'id'    => 'video-subtitle',
								'type'  => 'text',
								'title' => 'Paragraph Subtitle'
							),
							array(
								'id'           => 'paragraph_thumb',
								'type'         => 'upload',
								'title'        => 'Select thumbnail image for this paragraph',
								'library'      => 'image',
								'placeholder'  => 'http://',
								'button_title' => 'Add Image',
								'remove_title' => 'Remove Image',
								'preview'		=> true
							),

						),
					),

				),
			),
			array(
			  'type'     => 'callback',
			  'function' => 'vbaker_generate_preview',
			),
			array(
			  'type'     => 'callback',
			  'function' => 'vbaker_create_buttons',
			),
			
			array(
			  'type'    => 'notice',
			  'style'   => 'success',
			  'content' => '1',
			),
		)
	)
);
