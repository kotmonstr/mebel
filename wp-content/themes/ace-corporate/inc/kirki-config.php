<?php
/**
 * Created by PhpStorm.
 * User: kot
 * Date: 29.08.19
 * Time: 16:07
 */
Kirki::add_config( 'my_theme_config', array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod',
) );

Kirki::add_panel( 'my_settings', array(
    'priority'    => 50,
    'title'       => esc_html__( 'Мои новые настройки', 'kirki' ),
    'description' => esc_html__( 'Изучение kirki', 'kirki' ),
) );

Kirki::add_section( 'nav_settings', array(
    'title'          => esc_html__( 'Настройки', 'kirki' ),
    'description'    => esc_html__( 'Изменим телефон и цвет кнопок.', 'kirki' ),
    'panel'          => 'my_settings',
    'priority'       => 30,
) );

Kirki::add_field( 'phone_number', [
    'type'     => 'text',
    'settings' => 'my_setting2',
    'label'    => 'Телефон555',
    'section'  => 'nav_settings',
    'default'  => '+7 978 898 44 50',
    'priority' => 4,
] );


Kirki::add_field( 'button', [
	'type'        => 'color',
	'settings'    => 'content_color4',
	'label'       => 'Цверт кнопок',
	'description' => 'Цвет кнопок',
	'section'     => 'nav_settings',
	'default'     => '#F2F2F2',
	'transport' => 'auto',
	'priority' => 1,
	'output' => array(
		array(
			'element'  => '.service-body h3 a, .service-read',
			'property' => 'background-color',
		),
		array(
			'element'  => '.service-body h3 a, .service-read, .cp-top, a.btn',
			'property' => 'color',
		)
	),
] );