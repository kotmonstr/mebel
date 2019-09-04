<?php
require_once( get_template_directory(). '/inc/kirki/kirki.php');
require_once( get_template_directory(). '/inc/kirki-config.php');


function my_get_template_part($template, $data = array()){
    extract($data);
    require locate_template($template.'.php');
}

/*
 * портфолио
 */
function create_portfolio() {
    register_post_type('portfolio', array(
        'labels' => array(
            'name'            => __( 'Портфолио' ),
            'singular_name'   => __( 'Портфолио' ),
            'add_new'         => __( 'Добавить портфолио' ),
            'add_new_item'    => __( 'Добавить портфолио' ),
            'edit'            => __( 'Редактировать м' ),
            'edit_item'       => __( 'Редактировать м' ),
            'new_item'        => __( 'Портфолио' ),
            'all_items'       => __( 'Все портфолио' ),
            'view'            => __( 'Просмотр портфолио' ),
            'view_item'       => __( 'Просмотр портфолио' ),
            'search_items'    => __( 'Поиск портфолио' ),
            'not_found'       => __( 'Портфолио не найден' ),
        ),
        'public' => true, // show in admin panel?
        'publicly_queryable' => true,
        'menu_position' => 4,
        'show_ui' => true,
        'query_var' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies' => array('portfolio'),
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-format-aside',
        'rewrite' => array('slug' => 'portfolio'),
        'has_archive'  =>  'portfolio'
    ));
}
add_action( 'init', 'create_portfolio' );

/*
 * Отзывы
 */
function create_testimonals() {
	register_post_type('testimonal', array(
		'labels' => array(
			'name'            => __( 'Отзывы' ),
			'singular_name'   => __( 'Отзыв' ),
			'add_new'         => __( 'Добавить отзыв' ),
			'add_new_item'    => __( 'Добавить отзыв' ),
			'edit'            => __( 'Редактировать отзыв' ),
			'edit_item'       => __( 'Редактировать отзыв' ),
			'new_item'        => __( 'Отзыв' ),
			'all_items'       => __( 'Все отзывы' ),
			'view'            => __( 'Просмотр отзывов' ),
			'view_item'       => __( 'Просмотр отзывов' ),
			'search_items'    => __( 'Поиск отзывов' ),
			'not_found'       => __( 'Отзывы не найдены' ),
		),
		'public' => true,
		'menu_position' => 8,
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
		'taxonomies' => array('testimonal'),
		'has_archive' => true,
		'capability_type' => 'post',
		'menu_icon'   => 'dashicons-format-aside',
		'rewrite' => array('slug' => 'testimonal'),


	));
}
add_action( 'init', 'create_testimonals' );

/*
 * Наши услуги
 */
function create_services() {
    register_post_type('service', array(
        'labels' => array(
            'name'            => __( 'Услуги' ),
            'singular_name'   => __( 'Услуга' ),
            'add_new'         => __( 'Добавить услугу' ),
            'add_new_item'    => __( 'Добавить услугу' ),
            'edit'            => __( 'Редактировать услугу' ),
            'edit_item'       => __( 'Редактировать услугу' ),
            'new_item'        => __( 'Услуга' ),
            'all_items'       => __( 'Все услуги' ),
            'view'            => __( 'Просмотр услуги' ),
            'view_item'       => __( 'Просмотр услуги' ),
            'search_items'    => __( 'Поиск услуги' ),
            'not_found'       => __( 'Не найдена услуги' ),
        ),
        'public' => true, // show in admin panel?
        'menu_position' => 5,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies' => array('service' ),
        'has_archive' => true,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-index-card',
        'rewrite' => array('slug' => 'service'),
    ));
}
add_action( 'init', 'create_services' );

/*
 * Новости
 */
function create_news() {
    register_post_type('news', array(
        'labels' => array(
            'name'            => __( 'Новости' ),
            'singular_name'   => __( 'Новость' ),
            'add_new'         => __( 'Добавить новости' ),
            'add_new_item'    => __( 'Добавить новости' ),
            'edit'            => __( 'Редактировать новость' ),
            'edit_item'       => __( 'Редактировать новость' ),
            'new_item'        => __( 'Новость' ),
            'all_items'       => __( 'Все новости' ),
            'view'            => __( 'Просмотр новости' ),
            'view_item'       => __( 'Просмотр новости' ),
            'search_items'    => __( 'Поиск Новости' ),
            'not_found'       => __( 'Новости не найдена' ),
        ),
        'public' => true,
        'menu_position' => 6,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies' => array('news'),
        'has_archive' => true,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-editor-help',
        'rewrite' => array('slug' => 'news'),
    ));
}
add_action( 'init', 'create_news');


// Добавляет миниатюры записи в таблицу записей в админке

if (1) {
    add_action('init', 'add_post_thumbs_in_post_list_table', 20);
    function add_post_thumbs_in_post_list_table()
    {
        // проверим какие записи поддерживают миниатюры
        $supports = get_theme_support('post-thumbnails');

        // $ptype_names = array('post','page'); // указывает типы для которых нужна колонка отдельно

        // Определяем типы записей автоматически
        if (!isset($ptype_names)) {
            if ($supports === true) {
                $ptype_names = get_post_types(array('public' => true), 'names');
                $ptype_names = array_diff($ptype_names, array('attachment'));
            } // для отдельных типов записей
            elseif (is_array($supports)) {
                $ptype_names = $supports[0];
            }
        }

        // добавляем фильтры для всех найденных типов записей
        foreach ($ptype_names as $ptype) {
            add_filter("manage_{$ptype}_posts_columns", 'add_thumb_column');
            add_action("manage_{$ptype}_posts_custom_column", 'add_thumb_value', 10, 2);
        }
    }

    // добавим колонку
    function add_thumb_column($columns)
    {
        // подправим ширину колонки через css
        add_action('admin_notices', function () {
            echo '
	<style>
	.column-thumbnail{ width:80px; text-align:center; }
	</style>';
        });

        $num = 1; // после какой по счету колонки вставлять новые

        $new_columns = array('thumbnail' => __('Thumbnail'));

        return array_slice($columns, 0, $num) + $new_columns + array_slice($columns, $num);
    }

    // заполним колонку
    function add_thumb_value($colname, $post_id)
    {
        if ('thumbnail' == $colname) {
            $width = $height = 45;

            // миниатюра
            if ($thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true)) {
                $thumb = wp_get_attachment_image($thumbnail_id, array($width, $height), true);
            } // из галереи...
            elseif ($attachments = get_children(array(
                'post_parent' => $post_id,
                'post_mime_type' => 'image',
                'post_type' => 'attachment',
                'numberposts' => 1,
                'order' => 'DESC',
            ))) {
                $attach = array_shift($attachments);
                $thumb = wp_get_attachment_image($attach->ID, array($width, $height), true);
            }

            echo empty($thumb) ? ' ' : $thumb;
        }
    }
}

/*
 * Прячу в админке лишнее от глаз админа
 */
//add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu() {
    remove_menu_page('options-general.php'); // Удаляем раздел Настройки
    remove_menu_page('tools.php'); // Инструменты
    remove_menu_page('users.php'); // Пользователи
    remove_menu_page('plugins.php'); // Плагины
    remove_menu_page('themes.php'); // Внешний вид
    remove_menu_page('upload.php'); // Медиабиблиотека
    remove_menu_page('edit.php?post_type=page'); // Страницы
    remove_menu_page('edit-comments.php'); // Комментарии
    remove_menu_page('link-manager.php'); // Ссылки

    /*
     * Плагины
     */
    //remove_menu_page('edit.php?post_type=acf-field-group'); // cf
    remove_menu_page('fm_carousel_overview'); // cf
    remove_menu_page('for-the-visually-impaired'); // cf
    //remove_menu_page('revslider'); // cf
    remove_menu_page('uptolike_settings'); // cf
    //remove_menu_page('smart-slider3'); // cf
    remove_menu_page('loco'); // cf

}


//add_action( 'admin_init', 'wpse_136058_debug_admin_menu' );
//function wpse_136058_debug_admin_menu() {
//    echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
//}



function wpschool_api_add_admin_menu( ) {
	add_menu_page( 'Преймущества', 'Преймущества', 'manage_options', 'wpschool-settings-page', 'wpschool_api_options_page' );
}

function wpschool_api_settings_init( ) {
	register_setting( 'wpschoolCustom', 'wpschool_api_settings' );
	add_settings_section(
		'wpschool_api_wpschoolCustom_section',
		__( 'Настройки', 'wordpress' ),
		'wpschool_api_settings_section_callback',
		'wpschoolCustom'
	);

	add_settings_field(
		'wpschool_api_text_field_0',
		__( 'Заголовок блока', 'wordpress' ),
		'wpschool_api_text_field_0_render',
		'wpschoolCustom',
		'wpschool_api_wpschoolCustom_section'
	);

	add_settings_field(
		'wpschool_api_select_field_1',
		__( 'Текст блока', 'wordpress' ),
		'wpschool_api_select_field_1_render',
		'wpschoolCustom',
		'wpschool_api_wpschoolCustom_section'
	);
}

function wpschool_api_text_field_0_render( ) {
	$options = get_option( 'wpschool_api_settings' );
	?>
	<input type='text' name='wpschool_api_settings[wpschool_api_text_field_0]' value='<?php echo $options['wpschool_api_text_field_0']; ?>'>
	<?php
}

function wpschool_api_select_field_1_render( ) {
	$options = get_option( 'wpschool_api_settings' );
	?>
	<textarea type='text' rows="10" cols="100"  name='wpschool_api_settings[wpschool_api_text_field_1]'><?php echo $options['wpschool_api_text_field_1']; ?></textarea>
	<?php
}

function wpschool_api_settings_section_callback( ) {
	echo __( 'Введите данные для полей','wordpress' );
}

function wpschool_api_options_page( ) {
	?>
	<form action='options.php' method='post'>
		<h2>Преймущества</h2>
		<?php
		settings_fields( 'wpschoolCustom' );
		do_settings_sections( 'wpschoolCustom' );
		submit_button();
		?>
	</form>
	<?php
}
add_action( 'admin_menu', 'wpschool_api_add_admin_menu' );
add_action( 'admin_init', 'wpschool_api_settings_init' );

function map_api_add_admin_menu( ) {
	add_menu_page( 'Карта', 'Карта', 'manage_options', 'map-settings-page', 'map_api_options_page' );
}

function map_api_settings_init( ) {
	register_setting( 'mapCustom', 'map_api_settings' );
	add_settings_section(
		'map_api_mapCustom_section',
		__( 'Настройки', 'wordpress' ),
		'map_api_settings_section_callback',
		'mapCustom'
	);

	add_settings_field(
		'map_api_text_field_0',
		__( 'Заголовок блока', 'wordpress' ),
		'map_api_text_field_0_render',
		'mapCustom',
		'map_api_mapCustom_section'
	);

	add_settings_field(
		'map_api_select_field_1',
		__( 'Iframe Код для карты', 'wordpress' ),
		'map_api_select_field_1_render',
		'mapCustom',
		'map_api_mapCustom_section'
	);
}

function map_api_text_field_0_render( ) {
	$options = get_option( 'map_api_settings' );
	?>
    <input type='text' name='map_api_settings[map_api_text_field_0]' value='<?php echo $options['map_api_text_field_0']; ?>' style="width: 600px">
	<?php
}

function map_api_select_field_1_render( ) {
	$options = get_option( 'map_api_settings' );
	?>
    <textarea type='text' rows="10" cols="100"  name='map_api_settings[map_api_text_field_1]'><?php echo $options['map_api_text_field_1']; ?></textarea>
	<?php
}

function map_api_settings_section_callback( ) {
	echo __( 'Введите данные для полей','wordpress' );
}

function map_api_options_page( ) {
	?>
    <form action='options.php' method='post'>
        <h2>Карта</h2>
		<?php
		settings_fields( 'mapCustom' );
		do_settings_sections( 'mapCustom' );
		submit_button();
		?>
    </form>
	<?php
}
add_action( 'admin_menu', 'map_api_add_admin_menu' );
add_action( 'admin_init', 'map_api_settings_init' );

## заменим слово «записи» на «Слайды»
add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){


	$new = array(
		'name'                  => 'Слайды',
		'singular_name'         => 'Слайд',
		'add_new'               => 'Добавить слайд',
		'add_new_item'          => 'Добавить слайд',
		'edit_item'             => 'Редактировать Слайд',
		'new_item'              => 'Новая слайд',
		'view_item'             => 'Просмотреть слайд',
		'search_items'          => 'Поиск слайда',
		'not_found'             => 'Слайд не найден.',
		'not_found_in_trash'    => 'Слайд в корзине не найден.',
		'parent_item_colon'     => '',
		'all_items'             => 'Все Слайды',
		'archives'              => 'Архивы Слайд',
		'insert_into_item'      => 'Вставить в слайд',
		'uploaded_to_this_item' => 'Загруженные для этого слайда',
		'featured_image'        => 'Миниатюра Слайда',
		'filter_items_list'     => 'Фильтровать список Слайдов',
		'items_list_navigation' => 'Навигация по списку Слайдов',
		'items_list'            => 'Список Слайдов',
		'menu_name'             => 'Слайды',
		'name_admin_bar'        => 'Слайд', // пункте "добавить"
	);

	return (object) array_merge( (array) $labels, $new );
}