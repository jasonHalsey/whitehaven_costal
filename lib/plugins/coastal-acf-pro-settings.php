<?php
	if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_556825bbadf77',
	'title' => __('Home Page Sections'),
	'fields' => array (
		array (
			'key' => 'field_556825ed08113',
			'label' => __('Home Page Sections'),
			'name' => 'home_page_sections',
			'type' => 'flexible_content',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'button_label' => __('Add Section'),
			'min' => '',
			'max' => '',
			'layouts' => array (
				array (
					'key' => '556825fb1ac85',
					'name' => 'collection',
					'label' => __('Collection'),
					'display' => 'row',
					'sub_fields' => array (
						array (
							'key' => 'field_55683a2163be3',
							'label' => __('Header Title'),
							'name' => 'coll_header_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'coll-section-header-title',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_5568267e08114',
							'label' => __('Section Sub-title'),
							'name' => 'coll_section_subtitle',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'coll-section-subtitle',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_557559353f557',
							'label' => __('Categories'),
							'name' => 'coll_categories',
							'type' => 'taxonomy',
							'instructions' => __('Select the category or categories of collection items'),
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'taxonomy' => 'portfolio_category',
							'field_type' => 'multi_select',
							'allow_null' => 0,
							'add_term' => 1,
							'load_save_terms' => 1,
							'return_format' => 'id',
							'multiple' => 0,
						),
						array (
							'key' => 'field_557559a33f559',
							'label' => __('Display Category Buttons?'),
							'name' => 'display_collection_buttons',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
						),
						array (
							'key' => 'field_55682c7ef388d',
							'label' => __('Sort order of items'),
							'name' => 'coll_sort',
							'type' => 'select',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array (
								'ASC' => 'Oldest First',
								'DESC' => 'Newest First',
							),
							'default_value' => array (
								'ASC' => 'Oldest First',
							),
							'allow_null' => 0,
							'multiple' => 0,
							'ui' => 0,
							'ajax' => 0,
							'placeholder' => '',
							'disabled' => 0,
							'readonly' => 0,
						),
						array (
							'key' => 'field_5571350a1bb20',
							'label' => __('Background Color'),
							'name' => 'coll_background_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#fff',
						),
						array (
							'key' => 'field_557135411bb21',
							'label' => __('Text Color'),
							'name' => 'coll_text_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#333',
						),
						array (
							'key' => 'field_55753db4b3d0f',
							'label' => __('Category Button Background Color'),
							'name' => 'coll_cat_button_bg_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#FFF',
						),
						array (
							'key' => 'field_557543b265ecf',
							'label' => __('Category Button Hover Color'),
							'name' => 'coll_cat_button_hover_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#FFF',
						),
						array (
							'key' => 'field_55753e7ab3d10',
							'label' => __('Category Button Text Color'),
							'name' => 'coll_cat_button_text_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#333',
						),
						array (
							'key' => 'field_55754495d7ec6',
							'label' => __('Category Button Hover Text Color'),
							'name' => 'coll_cat_button_hover_text_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
						),
						array (
							'key' => 'field_55684ef2a9697',
							'label' => __('Menu Link'),
							'name' => 'coll_menu_link',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'coll_menu_link',
								'id' => '',
							),
							'default_value' => '/#',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '55682b40f3747',
					'name' => 'text',
					'label' => __('Text Section'),
					'display' => 'row',
					'sub_fields' => array (
						array (
							'key' => 'field_55683afccba47',
							'label' => __('Header Title'),
							'name' => 'txt_header_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'txt-section-header-title',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_55682b6cf3748',
							'label' => __('Section Sub-title'),
							'name' => 'txt_section_subtitle',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'txt-section-subtitle',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_557135cf1bb22',
							'label' => __('Background Color'),
							'name' => 'txt_background_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#edf4f4',
						),
						array (
							'key' => 'field_557135f61bb23',
							'label' => __('Text Color'),
							'name' => 'txt_text_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#333',
						),
						array (
							'key' => 'field_55682bdef3749',
							'label' => __('Content'),
							'name' => 'txt_content',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
						),
						array (
							'key' => 'field_55684f16a9698',
							'label' => __('Menu Link'),
							'name' => 'txt_menu_link',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'txt_menu_link',
								'id' => '',
							),
							'default_value' => '/#',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '55682c21f374a',
					'name' => 'latest',
					'label' => __('Latest Posts'),
					'display' => 'row',
					'sub_fields' => array (
						array (
							'key' => 'field_55683b19cba48',
							'label' => __('Header Title'),
							'name' => 'tl_header_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'tl-section-header-title',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_55682c64f374b',
							'label' => __('Section Sub-title'),
							'name' => 'tl_section_subtitle',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'tl-section-subtitle',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_55682da8f374e',
							'label' => __('Background Color'),
							'name' => 'tl_background_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#fff',
						),
						array (
							'key' => 'field_55682df9f374f',
							'label' => __('Text Color'),
							'name' => 'tl_text_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#333',
						),
						array (
							'key' => 'field_55682c7ef374c',
							'label' => __('Number of posts to display'),
							'name' => 'tl_number_of_posts',
							'type' => 'select',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array (
								3 => 3,
								6 => 6,
								9 => 9,
							),
							'default_value' => array (
								0 => 6,
							),
							'allow_null' => 0,
							'multiple' => 0,
							'ui' => 0,
							'ajax' => 0,
							'placeholder' => '',
							'disabled' => 0,
							'readonly' => 0,
						),
						array (
							'key' => 'field_55682ceef374d',
							'label' => __('Category'),
							'name' => 'tl_category',
							'type' => 'taxonomy',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'taxonomy' => 'category',
							'field_type' => 'multi_select',
							'allow_null' => 0,
							'add_term' => 0,
							'load_save_terms' => 0,
							'return_format' => 'id',
							'multiple' => 0,
						),
						array (
							'key' => 'field_55684f30a9699',
							'label' => __('Menu Link'),
							'name' => 'tl_menu_link',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'tl_menu_link',
								'id' => '',
							),
							'default_value' => '/#',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '55682eb6f3750',
					'name' => 'photo',
					'label' => 'Photo',
					'display' => 'row',
					'sub_fields' => array (
						array (
							'key' => 'field_55682ef7f3751',
							'label' => __('Link URL'),
							'name' => 'blog_link_url',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_55682f29f3752',
							'label' => __('Link Text'),
							'name' => 'blog_link_text',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_556830daf3753',
							'label' => __('Section Background Image'),
							'name' => 'blog_image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'url',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '5568314df3754',
					'name' => 'contact',
					'label' => 'Contact',
					'display' => 'row',
					'sub_fields' => array (
						array (
							'key' => 'field_55683b3fcba49',
							'label' => __('Header Title'),
							'name' => 'contact_header_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'contact-section-header-title',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_556831a7f3755',
							'label' => __('Section Sub-title'),
							'name' => 'contact_section_subtitle',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'contact-section-subtitle',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_5568329261707',
							'label' => __('Contact Form Shortcode'),
							'name' => 'contact_form_shortcode',
							'type' => 'text',
							'instructions' => __('Enter the contact form shortcode here.'),
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_5571361e1bb24',
							'label' => __('Background Color'),
							'name' => 'contact_background_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#fff',
						),
						array (
							'key' => 'field_5571367e1bb25',
							'label' => __('Text Color'),
							'name' => 'contact_text_color',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#333',
						),
						array (
							'key' => 'field_55684f4fa969b',
							'label' => __('Menu Link'),
							'name' => 'contact_menu_link',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => 'contact_menu_link',
								'id' => '',
							),
							'default_value' => '/#',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
					),
					'min' => '',
					'max' => '',
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'front-page-main.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'the_content',
	),
));

endif;
?>
