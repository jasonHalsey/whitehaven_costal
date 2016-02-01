<?php
//Register ACF sections
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_home-collection',
		'title' => __('Home Collection'),
		'fields' => array (
			array (
				'key' => 'field_54ac53874fa51',
				'label' => __('Section Type'),
				'name' => 'section_type',
				'type' => 'select',
				'instructions' => __('Select the type of section to display. Refer to documentation for more details.'),
				'choices' => array (
					'-- Select One --' => __('-- Select One --'),
					'collection' => __('Collection'),
					'text' => __('Text Block'),
					'photo' => __('Photo Background Link'),
					'contact' => __('Contact'),
				),
				'default_value' => '-- Select One --',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_54a34b247054f',
				'label' => __('Contact Section Header'),
				'name' => 'contact_section_header',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ac53874fa51',
							'operator' => '==',
							'value' => 'contact',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => __('Get in Touch'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_549a1cd628256',
				'label' => __('Section Sub-title'),
				'name' => 'section_subtitle',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ac53874fa51',
							'operator' => '==',
							'value' => 'collection',
						),
						array (
							'field' => 'field_54ac53874fa51',
							'operator' => '==',
							'value' => 'text',
						),
						array (
							'field' => 'field_54ac53874fa51',
							'operator' => '==',
							'value' => 'contact',
						),
					),
					'allorany' => 'any',
				),
				'default_value' => '',
				'placeholder' => __('Enter section title here.'),
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			
			
			array (
				'key' => 'field_549efee702d5e',
				'label' => __('Link URL'),
				'name' => 'blog_link_url',
				'type' => 'text',
				'instructions' => __('Paste the url of the page you want to link to.'),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ac53874fa51',
							'operator' => '==',
							'value' => 'photo',
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
				'key' => 'field_549eff0b02d5f',
				'label' => __('Link Text'),
				'name' => 'blog_link_text',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ac53874fa51',
							'operator' => '==',
							'value' => 'photo',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => __('Enter text to display here.'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_549eff1f02d60',
				'label' => __('Section Background Image'),
				'name' => 'blog_image',
				'type' => 'image',
				'instructions' => __('Select background image here. Recommended width >1200px.'),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ac53874fa51',
							'operator' => '==',
							'value' => 'photo',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_54a34c5270551',
				'label' => __('Contact Form Shortcode'),
				'name' => 'contact_form_shortcode',
				'type' => 'text',
				'instructions' => __('Enter the contact form shortcode here.'),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ac53874fa51',
							'operator' => '==',
							'value' => 'contact',
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
				'key' => 'field_54c302710d563',
				'label' => __('Text Block Section'),
				'name' => 'text_block_content',
				'type' => 'wysiwyg',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ac53874fa51',
							'operator' => '==',
							'value' => 'text',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-home-section.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'discussion',
				4 => 'comments',
				5 => 'slug',
				6 => 'featured_image',
				7 => 'categories',
				8 => 'tags',
				9 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}
?>