<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_custom-sections',
		'title' => 'Custom Sections',
		'fields' => array (
			array (
				'key' => 'field_58a37658c099c',
				'label' => 'Overwrite BTF sections',
				'name' => 'overwrite',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_58a37693c099d',
				'label' => 'BTF Sections',
				'name' => 'cstmbtf',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58a37658c099c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_58a376dfc099e',
						'label' => 'SECTION',
						'name' => 'section',
						'type' => 'select',
						'column_width' => '',
						'choices' => array (
							'subscribe' => 'Subscribe',
							'featcat' => 'Featured Category',
							'tv' => 'TV Section',
							'sip' => 'SIP Section',
							'upload_photo' => 'Upload Photo',
							'explore' => 'Explore Section',
							'wysiwyg' => 'WYSIWYG Editor',
							'custom_html' => 'Custom HTML',
							'multi_vid' => 'Multi Video',
						),
						'default_value' => '',
						'allow_null' => 1,
						'multiple' => 0,
					),
					array (
						'key' => 'field_58a37734c099f',
						'label' => 'Featured Category',
						'name' => 'featured_cat',
						'type' => 'repeater',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_58a376dfc099e',
									'operator' => '==',
									'value' => 'featcat',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_58a3775cc09a0',
								'label' => 'Category',
								'name' => 'category',
								'type' => 'taxonomy',
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'select',
								'allow_null' => 0,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 0,
							),
							array (
								'key' => 'field_58a37777c09a1',
								'label' => 'Subtitle',
								'name' => 'subtitle',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a37786c09a2',
								'label' => 'Sponsor Logo',
								'name' => 'sponsor_logo',
								'type' => 'image',
								'column_width' => '',
								'save_format' => 'url',
								'preview_size' => 'thumbnail',
								'library' => 'all',
							),
							array (
								'key' => 'field_58a37796c09a3',
								'label' => 'Sponsor Text',
								'name' => 'sponsor_text',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a377acc09a4',
								'label' => 'Sponsor URL',
								'name' => 'sponsor_url',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
						),
						'row_min' => 1,
						'row_limit' => 1,
						'layout' => 'row',
						'button_label' => 'Add Row',
					),
					array (
						'key' => 'field_58a377c1c09a5',
						'label' => 'TV Section',
						'name' => 'tv_section',
						'type' => 'repeater',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_58a376dfc099e',
									'operator' => '==',
									'value' => 'tv',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_58a377f5c09a6',
								'label' => 'Title',
								'name' => 'title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a3780ac09a7',
								'label' => 'Subtitle',
								'name' => 'subtitle',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a37820c09a8',
								'label' => 'Logo',
								'name' => 'logo',
								'type' => 'image',
								'column_width' => '',
								'save_format' => 'url',
								'preview_size' => 'thumbnail',
								'library' => 'all',
							),
							array (
								'key' => 'field_58a3782ec09a9',
								'label' => 'Link Text',
								'name' => 'link_text',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a37837c09aa',
								'label' => 'Link URL',
								'name' => 'link_url',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a3783fc09ab',
								'label' => 'Video ID',
								'name' => 'video_id',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
						),
						'row_min' => 1,
						'row_limit' => 1,
						'layout' => 'row',
						'button_label' => 'Add Row',
					),
					array (
						'key' => 'field_58a378698752b',
						'label' => 'SIP Section',
						'name' => 'sip_section',
						'type' => 'repeater',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_58a376dfc099e',
									'operator' => '==',
									'value' => 'sip',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_58a3787f8752c',
								'label' => 'Title',
								'name' => 'title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a378868752d',
								'label' => 'Subtitle',
								'name' => 'subtitle',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a3788d8752e',
								'label' => 'SIP link text',
								'name' => 'sip_link_text',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a378a28752f',
								'label' => 'SIP link url',
								'name' => 'sip_link_url',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a378ad87530',
								'label' => 'Mag Cover',
								'name' => 'mag_cover',
								'type' => 'image',
								'column_width' => '',
								'save_format' => 'url',
								'preview_size' => 'medium',
								'library' => 'all',
							),
							array (
								'key' => 'field_58a378c687531',
								'label' => 'iTunes URL',
								'name' => 'itunes_url',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a378ed87532',
								'label' => 'Google Play URL',
								'name' => 'google_play_url',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a378f887533',
								'label' => 'Windows Store URL',
								'name' => 'windows_store_url',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a3790587534',
								'label' => 'Post ID #1',
								'name' => 'post_id_1',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a3791187535',
								'label' => 'Post ID #2',
								'name' => 'post_id_2',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
						),
						'row_min' => 1,
						'row_limit' => 1,
						'layout' => 'row',
						'button_label' => 'Add Row',
					),
					array (
						'key' => 'field_58a3792c87536',
						'label' => 'Explore Section',
						'name' => 'explore_section',
						'type' => 'repeater',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_58a376dfc099e',
									'operator' => '==',
									'value' => 'explore',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_58a3797687537',
								'label' => 'Category',
								'name' => 'category',
								'type' => 'taxonomy',
								'instructions' => 'Choose 3, 5, 8 or 11 categories',
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'select',
								'allow_null' => 0,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 0,
							),
						),
						'row_min' => 3,
						'row_limit' => 11,
						'layout' => 'row',
						'button_label' => 'Add Row',
					),
					array (
						'key' => 'field_58a379bd87538',
						'label' => 'Upload Photo',
						'name' => 'upload_photo',
						'type' => 'repeater',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_58a376dfc099e',
									'operator' => '==',
									'value' => 'upload_photo',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_58a379e187539',
								'label' => 'Title',
								'name' => 'title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a379eb8753a',
								'label' => 'Title URL',
								'name' => 'title_url',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a379fc8753b',
								'label' => 'Subtitle',
								'name' => 'subtitle',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a37a068753c',
								'label' => 'Buttons',
								'name' => 'buttons',
								'type' => 'repeater',
								'column_width' => '',
								'sub_fields' => array (
									array (
										'key' => 'field_58a37a118753d',
										'label' => 'Button Text',
										'name' => 'button_text',
										'type' => 'text',
										'column_width' => '',
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									),
									array (
										'key' => 'field_58a37a238753e',
										'label' => 'Button URL',
										'name' => 'button_url',
										'type' => 'text',
										'column_width' => '',
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									),
								),
								'row_min' => '',
								'row_limit' => '',
								'layout' => 'table',
								'button_label' => 'Add Row',
							),
							array (
								'key' => 'field_58a37a2e8753f',
								'label' => 'Links',
								'name' => 'links',
								'type' => 'repeater',
								'column_width' => '',
								'sub_fields' => array (
									array (
										'key' => 'field_58a37a4387540',
										'label' => 'Link Text',
										'name' => 'link_text',
										'type' => 'text',
										'column_width' => '',
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									),
									array (
										'key' => 'field_58a37a4987541',
										'label' => 'Link URL',
										'name' => 'link_url',
										'type' => 'text',
										'column_width' => '',
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									),
								),
								'row_min' => '',
								'row_limit' => '',
								'layout' => 'row',
								'button_label' => 'Add Row',
							),
							array (
								'key' => 'field_58a37a5387542',
								'label' => 'Post ID #1',
								'name' => 'post_id_1',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a37aec87543',
								'label' => 'Post ID #2',
								'name' => 'post_id_2',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
						),
						'row_min' => 1,
						'row_limit' => 1,
						'layout' => 'row',
						'button_label' => 'Add Row',
					),
					array (
						'key' => 'field_58a37b0b87544',
						'label' => 'Multi Video',
						'name' => 'multi_video',
						'type' => 'repeater',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_58a376dfc099e',
									'operator' => '==',
									'value' => 'multi_vid',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_58a37b2687545',
								'label' => 'Video Service',
								'name' => 'video_service',
								'type' => 'radio',
								'column_width' => '',
								'choices' => array (
									'brightcove' => 'Birghtcove',
									'youtube' => 'YouTube',
								),
								'other_choice' => 0,
								'save_other_choice' => 0,
								'default_value' => 'brightcove',
								'layout' => 'horizontal',
							),
							array (
								'key' => 'field_58a37b4b87546',
								'label' => 'Section Title',
								'name' => 'section_title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a37b6f87547',
								'label' => 'Featured Video ID',
								'name' => 'feat_video_id',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a37b9d87548',
								'label' => 'Featured Video Title',
								'name' => 'feat_video_title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a37bb187549',
								'label' => 'Featured Video Description',
								'name' => 'feat_video_desc',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_58a37bca8754a',
								'label' => 'Featured Video Thumb',
								'name' => 'feat_image_z',
								'type' => 'image',
								'conditional_logic' => array (
									'status' => 1,
									'rules' => array (
										array (
											'field' => 'field_58a37b2687545',
											'operator' => '==',
											'value' => 'brightcove',
										),
									),
									'allorany' => 'all',
								),
								'column_width' => '',
								'save_format' => 'url',
								'preview_size' => 'thumbnail',
								'library' => 'all',
							),
							array (
								'key' => 'field_58a37bdb8754b',
								'label' => 'Video List',
								'name' => 'video_list',
								'type' => 'repeater',
								'column_width' => '',
								'sub_fields' => array (
									array (
										'key' => 'field_58a37c0d8754c',
										'label' => 'Video ID',
										'name' => 'video_id',
										'type' => 'text',
										'column_width' => '',
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									),
									array (
										'key' => 'field_58a37c178754d',
										'label' => 'Video Title',
										'name' => 'znamez',
										'type' => 'text',
										'default_value' => '',
										'formatting' => 'html',
										'maxlength' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
									),
									array (
										'key' => 'field_58a37c178754e',
										'label' => 'Video Image',
										'name' => 'z_image_z',
										'type' => 'image',
										'column_width' => '',
										'save_format' => 'url',
										'preview_size' => 'thumbnail',
										'library' => 'all',
										'conditional_logic' => array (
											'status' => 1,
											'rules' => array (
												array (
													'field' => 'field_58a37b2687545',
													'operator' => '==',
													'value' => 'brightcove',
												),
											),
											'allorany' => 'all',
										),
									),
									array (
										'key' => 'field_58a37c178754f',
										'label' => 'Video Description',
										'name' => 'udesk',
										'type' => 'textarea',
										'default_value' => '',
										'placeholder' => '',
										'maxlength' => '',
										'rows' => '',
										'formatting' => 'br',
									),
								),
								'row_min' => 0,
								'row_limit' => 0,
								'layout' => 'row',
								'button_label' => 'Add Row',
							),
						),
						'row_min' => 0,
						'row_limit' => 0,
						'layout' => 'row',
						'button_label' => 'Add Row',
					),
					array (
						'key' => 'field_584040b4e89cc',
						'label' => 'WYSIWYG Editor',
						'name' => 'wysiwyg_editor',
						'type' => 'wysiwyg',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_58a376dfc099e',
									'operator' => '==',
									'value' => 'wysiwyg',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_584040d4e89cd',
						'label' => 'Custom HTML',
						'name' => 'custom_html',
						'type' => 'textarea',
						'instructions' => 'Use this field to insert custom html',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_58a376dfc099e',
									'operator' => '==',
									'value' => 'custom_html',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 12,
						'formatting' => 'html',
					),
				),
				'row_min' => 0,
				'row_limit' => 0,
				'layout' => 'row',
				'button_label' => 'Add Section',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'category',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
