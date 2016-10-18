<?php // You can find sample on northamericanwhitetail.artem
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_microsite-video-page',
		'title' => 'Microsite Video Page',
		'fields' => array (
			array (
				'key' => 'field_580594af0b5dc',
				'label' => 'Video Service',
				'name' => 'video_service',
				'type' => 'radio',
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
				'key' => 'field_57d9bfc6e9ae5',
				'label' => 'Featured Video ID',
				'name' => 'feat_video_id',
				'type' => 'text',
				'instructions' => 'You can also add this id to the video list below',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_58057cf454ea8',
				'label' => 'Featured Youtube Video Title',
				'name' => 'youtube_video_title',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_580594af0b5dc',
							'operator' => '==',
							'value' => 'youtube',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57d9bfe9e9ae6',
				'label' => 'Video Menu',
				'name' => 'video_menu',
				'type' => 'repeater',
				'instructions' => 'Video categories. Put all in lowercase letters',
				'sub_fields' => array (
					array (
						'key' => 'field_57dc5baafe1de',
						'label' => 'Category Name',
						'name' => 'category_name',
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
				'key' => 'field_57d9c0cab5dd6',
				'label' => 'Video List',
				'name' => 'video',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_57d9c0dfb5dd7',
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
						'key' => 'field_57d9c105b5dd9',
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
						'key' => 'field_57d9c0e9b5dd8',
						'label' => 'Video Category',
						'name' => 'video_category',
						'type' => 'repeater',
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_57dc5f8ab35cd',
								'label' => 'Cat Name',
								'name' => 'cat_name',
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
						'key' => 'field_57dc5ec93a0ee',
						'label' => 'image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-templates/microsite-video.php',
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
?>