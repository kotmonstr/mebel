<?php
/**
 * ACE Corporate Theme Customizer
 *
 * @package ACE Corporate
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('ace_corporate_customize_register')) :
    function ace_corporate_customize_register($wp_customize)
    {
        $wp_customize->get_setting('blogname')->transport = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
        //$wp_customize->get_setting( 'display_header_text' )->transport = 'postMessage';

        if (isset($wp_customize->selective_refresh)) {
            $wp_customize->selective_refresh->add_partial('blogname', array(
                'selector' => '.site-title a',
                'render_callback' => 'ace_corporate_customize_partial_blogname',
            ));
            $wp_customize->selective_refresh->add_partial('blogdescription', array(
                'selector' => '.site-description',
                'render_callback' => 'ace_corporate_customize_partial_blogdescription',
            ));
        }

    }

    add_action('customize_register', 'ace_corporate_customize_register');
endif;
if (! function_exists('ace_corporate_customize_partial_blogname') ){
function ace_corporate_customize_partial_blogname()
{
    bloginfo('name');
}
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 *
 * @return void
 */
if (! function_exists('ace_corporate_customize_partial_blogdescription') ){
function ace_corporate_customize_partial_blogdescription()
{
    bloginfo('description');
}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if (!function_exists('ace_corporate_customize_preview_js')) :
    function ace_corporate_customize_preview_js()
    {
        wp_enqueue_script( 'ace-corporate-customizer-js', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
    }

    add_action('customize_preview_init', 'ace_corporate_customize_preview_js');
endif;
if (! function_exists('ace_corporate_customize_main_js') ){
function ace_corporate_customize_main_js()
{
    wp_enqueue_script('ace-corporate-customizer-main-js', trailingslashit(get_template_directory_uri()) . 'js/customizer-main.js');
    wp_localize_script('ace-corporate-customizer-main-js', 'objectL10n', array(
        'response' => esc_html__('You can select upto 3 pages only', 'ace-corporate'),
    ));
}
}
add_action('customize_controls_enqueue_scripts', 'ace_corporate_customize_main_js');

/**
 *
 * Panel for customizers
 *
 **/
get_template_part('/inc/ace-corporate-customize-control');

if (!function_exists('ace_corporate_customizer_panels')) :
    function ace_corporate_customizer_panels($wp_customize)
    {

        $wp_customize->add_panel('ACECorporate_theme_panel', array(
            'priority' => 2,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __('Theme Options', 'ace-corporate'),
            'description' => '',
        ));
    }

    add_action('customize_register', 'ace_corporate_customizer_panels');
endif;

/************************************************/
/*           Section For Header Logo           */
/***********************************************/
if (!function_exists('ace_corporate_header_section')) :
    function ace_corporate_header_section($wp_customize)
    {

        // New Layout and Design

        $wp_customize->add_section('section_layout_design', array(
                'title' => __('Layout and design', 'ace-corporate'),
                'label' => __('Layout and design. ', 'ace-corporate'),
                'panel' => 'ACECorporate_theme_panel',
                'priority' => 1,
            )
        );

        $wp_customize->add_setting('layout_control', array(
                'default' => 'boxed',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'ace_corporate_sanitize_select',
            )
        );
        $wp_customize->add_control('layout_control', array(
                'label' => __('Choose Layout', 'ace-corporate'),
                'section' => 'section_layout_design',
                'type' => 'radio',
                'choices' => array(
                    'boxed' => __('Boxed', 'ace-corporate'),
                    'fullwidth' => __('Full Width', 'ace-corporate'),
                ),
                'priority' => 5,
            )
        );

        $wp_customize->add_setting('layout_picker', array(
                'default' => "3",
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(new ace_corporate_Layout_Picker_Custom_Control($wp_customize, 'layout_picker', array(
                    'label' => __('Layout picker', 'ace-corporate'),
                    'section' => 'section_layout_design',
                    'settings' => 'layout_picker',
                    'priority' => 6,
                )
            )
        );
    }

    add_action('customize_register', 'ace_corporate_header_section');
endif;
/****************************************************************************/
/*                Section For Footer Testimonial                            */
/****************************************************************************/
if (!function_exists('ace_corporate_footer_testimonial_customizer')) :
    function ace_corporate_footer_testimonial_customizer($wp_customize)
    {
        $wp_customize->add_section('testimonial_section', array(
                'title' => __('Testimonial', 'ace-corporate'),
                'description' => __('This is a section for Testimonial of Clients', 'ace-corporate'),
                'panel' => 'ACECorporate_theme_panel',
                'priority' => 6,
            )
        );

        $wp_customize->add_setting('testimonial_section_title', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control('testimonial_section_title', array(
                'label' => __('Section Title', 'ace-corporate'),
                'section' => 'testimonial_section',
                'type' => 'text',
                'priority' => 1,
            )
        );
    }

    add_action('customize_register', 'ace_corporate_footer_testimonial_customizer');
endif;

/**
 *
 * Customizer for the footer page
 *
 **/
if (!function_exists('ace_corporate_front_page_customize')) {
    function ace_corporate_front_page_customize($wp_customize)
    {

        /****************************************************************************/
        /* General Setting for Footer Content  */
        /****************************************************************************/

        $wp_customize->add_section('footer_section', array(
                'title' => __('Call To Action', 'ace-corporate'),
                'description' => __('This is a section for Call to Action of the site above the testimonial.', 'ace-corporate'),
                'panel' => 'ACECorporate_theme_panel',
                'priority' => 5,
            )
        );

        $wp_customize->add_setting('cta_heading', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control('cta_heading', array(
                'label' => __('Call To Action Title', 'ace-corporate'),
                'section' => 'footer_section',
                'type' => 'text',
                'priority' => 1,
            )
        );

        $wp_customize->add_setting('cta_content_text', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));

        $wp_customize->add_control('cta_content_text', array(
                'label' => __('The Content for the Call To Action Section', 'ace-corporate'),
                'section' => 'footer_section',
                'settings' => 'cta_content_text',
                'priority' => 2,
                'type' => 'textarea',

            )
        );

        $wp_customize->add_setting('cta_link_url', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );
        $wp_customize->add_control('cta_link_url', array(
                'label' => __('Button URL', 'ace-corporate'),
                'section' => 'footer_section',
                'type' => 'url',
                'priority' => 3,
            )
        );
        $wp_customize->add_setting('cta_link_text', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control('cta_link_text', array(
                'label' => __('Button Text', 'ace-corporate'),
                'section' => 'footer_section',
                'type' => 'text',
                'priority' => 4,
            )
        );
        $wp_customize->add_setting('section_background', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'section_background', array(
                    'label' => __('Background Image', 'ace-corporate'),
                    'section' => 'footer_section',
                    'settings' => 'section_background',
                    'priority' => 5,
                )
            )
        );

        /***********************************/
        /*** Slider *****/
        /**********************************/

        $wp_customize->add_section('ACECorporate_front_page', array(
            'title' => __('Slider Options', 'ace-corporate'),
            'panel' => 'ACECorporate_theme_panel',
            'priority' => 2,
        ));

        $wp_customize->add_setting('featured_post', array(
            'default' => 'none',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'ace_corporate_text_sanitize',
        ));

        $wp_customize->add_control(new ace_corporate_Page_Dropdown_control($wp_customize, 'featured_post', array(
            'label' => __('Select a Page for slider', 'ace-corporate'),
            'section' => 'ACECorporate_front_page',
            'priority' => 1,
        )));

        /******************************/
        /***** Posts below slider *****/
        /******************************/

        $wp_customize->add_section('ACECorporate_callout', array(
            'title' => __('Call Out Options', 'ace-corporate'),
            'panel' => 'ACECorporate_theme_panel',
            'priority' => 3,
        ));

        $wp_customize->add_setting('first_post_title', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('first_post_title', array(
            'label' => __('Section Title', 'ace-corporate'),
            'section' => 'ACECorporate_callout',
            'priority' => 2,
        ));

        $wp_customize->add_setting('first_post', array(
            'default' => 'none',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'ace_corporate_text_sanitize',
        ));
        $wp_customize->add_control(new ace_corporate_Page_Dropdown_control($wp_customize, 'first_post', array(
            'label' => __('Select 3 Pages To Show Below Slider', 'ace-corporate'),
            'description' => __('Select a category to display post below the slider', 'ace-corporate'),
            'section' => 'ACECorporate_callout',
            'priority' => 3,

        )));

        // title for portfolio section

        $wp_customize->add_section('ACECorporate_portfolio', array(
            'title' => __('Portfolio Options', 'ace-corporate'),
            'panel' => 'ACECorporate_theme_panel',
            'priority' => 4,
        ));

        $wp_customize->add_setting('portfolio_post_title', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('portfolio_post_title', array(
            'label' => __('Title for Portfolio Section', 'ace-corporate'),
            'section' => 'ACECorporate_portfolio',
            'priority' => 4,
        ));


        /**********************************************/
        /*** From the blog ***/
        /*******************************************/

        $wp_customize->add_section('homepage_content', array(
            'title' => __('Homepage Content Options', 'ace-corporate'),
            'panel' => 'ACECorporate_theme_panel',
            'priority' => 5,
        ));

        $wp_customize->add_setting('homepage_show_content', array(
            'default' => 0,
            'sanitize_callback' => 'ace_corporate_sanitize_checkbox'
        ));

        $wp_customize->add_control('homepage_show_content', array(
            'label' => esc_attr(__('Homepage Title And Content ?', 'ace-corporate')),
            'section' => 'homepage_content',
            'settings' => 'homepage_show_content',
            'type' => 'checkbox'
        ));

        $wp_customize->add_section('ACECorporate_blog', array(
            'title' => __('Blog Options', 'ace-corporate'),
            'panel' => 'ACECorporate_theme_panel',
            'priority' => 5,
        ));
        $wp_customize->add_setting('excerpt_length', array(
                'default' => 20,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control('excerpt_length', array(
                'label' => __('Excerpt Length', 'ace-corporate'),
                'section' => 'ACECorporate_blog',
                'type' => 'text',
            )
        );

         $wp_customize->add_setting('blog_section_title', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control('blog_section_title', array(
                'label' => __('Blog Title', 'ace-corporate'),
                'section' => 'ACECorporate_blog',
                'type' => 'text',
                'priority' => 1,
            )
        );

        $wp_customize->add_setting('show_blog_meta', array(
            'default' => 1,
            'sanitize_callback' => 'ace_corporate_sanitize_checkbox'
        ));

        $wp_customize->add_control('show_blog_meta', array(
            'label' => esc_attr(__('Show Meta In Blog?', 'ace-corporate')),
            'section' => 'ACECorporate_blog',
            'settings' => 'show_blog_meta',
            'type' => 'checkbox'
        ));
    }
}
add_action('customize_register', 'ace_corporate_front_page_customize');

/******************************************************************/
/*              Social Media Section                              */
/******************************************************************/
if (!function_exists('ace_corporate_social_media_section')) :
    function ace_corporate_social_media_section($wp_customize)
    {
        //ADD/CHANGE CSS
        $version_wp = get_bloginfo('version');
        if ($version_wp < 4.7) {
            $wp_customize->add_section(
                'change_css',
                array(
                    'title' => __('Custom CSS', 'ace-corporate'),
                    'description' => __('Here you can customize Your theme\'s css', 'ace-corporate'),
                    'panel' => 'ACECorporate_theme_panel',
                    'capability' => 'edit_theme_options',
                    'priority' => 40,
                )
            );
            $wp_customize->add_setting(
                'css_change',
                array(
                    'default' => '',
                    'sanitize_callback' => 'sanitize_textarea_field',
                    'capability' => 'edit_theme_options',
                )
            );
            $wp_customize->add_control('ace-corporate_css_change', array(
                'label' => __('Add CSS', 'ace-corporate'),
                'type' => 'textarea',
                'section' => 'change_css',
                'settings' => 'css_change',
            ));
        }

        $wp_customize->add_section(
            'documentation',
            array(
                'title' => __('Documentation and Support', 'ace-corporate'),
                'capability' => 'edit_theme_options',
                'priority' => 1,
            )
        );
        $wp_customize->add_setting(
            'doc_supp',
            array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
                'capability' => 'edit_theme_options',
            )
        );

        $wp_customize->add_control(new ace_corporate_documentation_Custom_Text_Control($wp_customize, 'doc_supp', array(
                'section' => 'documentation',
                'type' => 'customtext',
                'extra' => __('Font settings available in Pro version. Buy Pro Version', 'ace-corporate'),
            ))
        );
    }

    add_action('customize_register', 'ace_corporate_social_media_section');
endif;

get_template_part('inc/customizer', 'sanitization');