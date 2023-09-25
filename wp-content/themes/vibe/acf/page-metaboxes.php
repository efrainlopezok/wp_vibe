<?php
// Register Page Options
if( function_exists('acf_add_local_field_group') ):
    
    acf_add_local_field_group(array (
        'key' => 'group_5a047c0588cbe',
        'title' => 'Hero',
        'fields' => array (
            array (
                'key' => 'field_5a047c0a0052c',
                'label' => 'Show Hero Image?',
                'name' => 'hero_image',
                'type' => 'checkbox',
                'value' => NULL,
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'yes' => 'Yes',
                ),
                'allow_custom' => 0,
                'save_custom' => 0,
                'default_value' => array (
                ),
                'layout' => 'vertical',
                'toggle' => 0,
                'return_format' => 'value',
            ),
            array (
                'key' => 'field_5a047c280052d',
                'label' => 'Header Image',
                'name' => 'header_image',
                'type' => 'image',
                'value' => NULL,
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_5a047c0a0052c',
                            'operator' => '==',
                            'value' => 'yes',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array (
                'key' => 'field_5a047c7b0052e',
                'label' => 'Header content',
                'name' => 'header_content',
                'type' => 'wysiwyg',
                'value' => NULL,
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_5a047c0a0052c',
                            'operator' => '==',
                            'value' => 'yes',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array (
                'key' => 'field_5a047c960052f',
                'label' => 'Header Tagline',
                'name' => 'header_tagline',
                'type' => 'wysiwyg',
                'value' => NULL,
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_5a047c0a0052c',
                            'operator' => '==',
                            'value' => 'yes',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));
    
    endif;