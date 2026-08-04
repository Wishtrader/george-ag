<?php
/**
 * ACF Field Groups Registration
 *
 *
 * @package GeorgeAG
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return; // ACF не установлен или не активирован
}

/**
 * Register Vystavka (Exhibitions) Custom Post Type
 */
function georgeag_register_vystavka_cpt() {
	$labels = array(
		'name'                  => _x( 'Выставки', 'Post type general name', 'georgeag' ),
		'singular_name'         => _x( 'Выставка', 'Post type singular name', 'georgeag' ),
		'menu_name'             => _x( 'Выставки', 'Admin Menu text', 'georgeag' ),
		'name_admin_bar'        => _x( 'Выставка', 'Add New on Toolbar', 'georgeag' ),
		'add_new'               => __( 'Добавить новую', 'georgeag' ),
		'add_new_item'          => __( 'Добавить новую выставку', 'georgeag' ),
		'new_item'              => __( 'Новая выставка', 'georgeag' ),
		'edit_item'             => __( 'Редактировать выставку', 'georgeag' ),
		'view_item'             => __( 'Просмотр выставки', 'georgeag' ),
		'all_items'             => __( 'Все выставки', 'georgeag' ),
		'search_items'          => __( 'Поиск выставок', 'georgeag' ),
		'not_found'             => __( 'Выставки не найдены.', 'georgeag' ),
		'not_found_in_trash'    => __( 'Выставки в корзине не найдены.', 'georgeag' ),
		'featured_image'        => _x( 'Обложка выставки', 'Overrides the "Featured Image" phrase', 'georgeag' ),
		'set_featured_image'    => _x( 'Установить обложку выставки', 'Overrides the "Set featured image" phrase', 'georgeag' ),
		'remove_featured_image' => _x( 'Удалить обложку выставки', 'Overrides the "Remove featured image" phrase', 'georgeag' ),
		'use_featured_image'    => _x( 'Использовать как обложку выставки', 'Overrides the "Use as featured image" phrase', 'georgeag' ),
		'archives'              => _x( 'Архив выставок', 'The post type archive label', 'georgeag' ),
		'insert_into_item'      => _x( 'Добавить в выставку', 'Overrides the "Insert into post" phrase', 'georgeag' ),
		'uploaded_to_this_item' => _x( 'Загружено для этой выставки', 'Overrides the "Uploaded to this post" phrase', 'georgeag' ),
		'filter_items_list'     => _x( 'Фильтровать список выставок', 'Overrides the "Filter items list" phrase', 'georgeag' ),
		'items_list_navigation' => _x( 'Навигация по списку выставок', 'Overrides the "Items list navigation" phrase', 'georgeag' ),
		'items_list'            => _x( 'Список выставок', 'Overrides the "Items list" phrase', 'georgeag' ),
	);

	$args = array(
		'labels'                => $labels,
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'vystavka' ),
		'capability_type'       => 'post',
		'has_archive'           => true,
		'hierarchical'          => false,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-format-gallery',
		'show_in_admin_bar'     => true,
		'show_in_rest'          => true,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
		'exclude_from_search'   => false,
	);

	register_post_type( 'vystavka', $args );
}
add_action( 'init', 'georgeag_register_vystavka_cpt' );

/**
 * Flush rewrite rules on theme activation for vystavka CPT
 */
function georgeag_vystavka_flush_rewrite_rules() {
	georgeag_register_vystavka_cpt();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'georgeag_vystavka_flush_rewrite_rules' );

/**
 * Add "Duplicate" link to vystavka admin table
 */
function georgeag_vystavka_duplicate_actions( $actions, $post ) {
	if ( $post->post_type !== 'vystavka' ) {
		return $actions;
	}

	if ( current_user_can( 'edit_posts' ) ) {
		$duplicate_url = wp_nonce_url(
			add_query_arg(
				array(
					'duplicate' => $post->ID,
					'type'      => 'vystavka',
				)
			),
			'duplicate_post_' . $post->ID,
			'duplicate_nonce'
		);

		$actions['duplicate'] = sprintf(
			'<a href="%s" title="%s" rel="nofollow">%s</a>',
			esc_url( $duplicate_url ),
			esc_attr__( 'Дублировать эту выставку', 'georgeag' ),
			esc_html__( 'Дублировать', 'georgeag' )
		);
	}

	return $actions;
}
add_filter( 'post_row_actions', 'georgeag_vystavka_duplicate_actions', 10, 2 );
add_filter( 'page_row_actions', 'georgeag_vystavka_duplicate_actions', 10, 2 );

/**
 * Handle duplicate action for vystavka
 */
function georgeag_handle_duplicate_vystavka() {
	if ( ! isset( $_GET['duplicate'] ) || ! isset( $_GET['type'] ) ) {
		return;
	}

	if ( $_GET['type'] !== 'vystavka' ) {
		return;
	}

	$nonce = isset( $_GET['duplicate_nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['duplicate_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'duplicate_post_' . absint( $_GET['duplicate'] ) ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}

	$post_id = absint( $_GET['duplicate'] );
	$post    = get_post( $post_id );

	if ( ! $post || $post->post_type !== 'vystavka' ) {
		return;
	}

	$new_post = array(
		'post_title'   => $post->post_title . ' (копия)',
		'post_content' => $post->post_content,
		'post_excerpt' => $post->post_excerpt,
		'post_status'  => 'draft',
		'post_type'    => 'vystavka',
		'post_author'  => get_current_user_id(),
	);

	$new_post_id = wp_insert_post( $new_post );

	if ( is_wp_error( $new_post_id ) ) {
		return;
	}

	$acf_fields = array(
		'sv_hero_badge', 'sv_hero_dates', 'sv_hero_description', 'sv_hero_image',
		'sv_hero_cta_primary_text', 'sv_hero_cta_primary_url',
		'sv_hero_cta_secondary_text', 'sv_hero_cta_secondary_url',
		'sv_about_title', 'sv_about_description',
		'sv_what_to_see_title', 'sv_what_to_see_items',
		'sv_why_title', 'sv_why_description', 'sv_why_image',
		'sv_practical_title', 'sv_practical_format', 'sv_practical_dates',
		'sv_practical_location', 'sv_practical_audience', 'sv_practical_for_whom',
		'sv_practical_access', 'sv_practical_button_text',
		'sv_cta_background_image', 'sv_cta_background_image_mobile',
		'sv_cta_title', 'sv_cta_primary', 'sv_cta_primary_url',
		'sv_cta_secondary', 'sv_cta_secondary_url',
	);

	foreach ( $acf_fields as $field ) {
		$value = get_post_meta( $post_id, $field, true );
		if ( $value ) {
			add_post_meta( $new_post_id, $field, $value );
		}
	}

	$thumbnail_id = get_post_thumbnail_id( $post_id );
	if ( $thumbnail_id ) {
		set_post_thumbnail( $new_post_id, $thumbnail_id );
	}

	wp_redirect( admin_url( 'post.php?post=' . $new_post_id . '&action=edit' ) );
	exit;
}
add_action( 'admin_init', 'georgeag_handle_duplicate_vystavka' );

// ============================================
// ГРУППА: HERO SECTION (Герой)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_hero_section',
	'title'    => 'Hero Section: Главный экран',
	'fields'   => array(
		array(
			'key'           => 'field_hero_title',
			'label'         => 'Заголовок',
			'name'          => 'hero_title',
			'type'          => 'text',
			'instructions'  => 'Главный заголовок страницы',
			'required'      => 1,
			'default_value' => 'Музей наивного искусства, где хочется не только смотреть, но и участвовать',
		),
		array(
			'key'           => 'field_hero_description',
			'label'         => 'Описание',
			'name'          => 'hero_description',
			'type'          => 'textarea',
			'instructions'  => 'Краткое описание музея',
			'rows'          => 3,
			'default_value' => 'Выставки, мастер-классы, лекции и творческие встречи для детей и взрослых в теплом и живом пространстве музея.',
		),
		array(
			'key'           => 'field_hero_image',
			'label'         => 'Изображение героя',
			'name'          => 'hero_image',
			'type'          => 'image',
			'instructions'  => 'Основное изображение для Hero секции',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_hero_cta_primary',
			'label'         => 'Главная кнопка',
			'name'          => 'hero_cta_primary',
			'type'          => 'text',
			'instructions'  => 'Текст кнопки',
			'default_value' => 'Смотреть афишу',
		),
		array(
			'key'           => 'field_hero_cta_secondary',
			'label'         => 'Вторичная кнопка',
			'name'          => 'hero_cta_secondary',
			'type'          => 'text',
			'instructions'  => 'Текст кнопки',
			'default_value' => 'Записаться на мастер-класс',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'homepage.php',
			),
		),
	),
	'menu_order' => -10,
	'position'   => 'normal',
	'style'      => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
) );

// ============================================
// ГРУППА: PREVIEW EVENTS (Превью событий)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_preview_events',
	'title'    => 'Preview Events: Превью событий',
	'fields'   => array(
		array(
			'key'           => 'field_preview_events',
			'label'         => 'События (3 шт)',
			'name'          => 'preview_events',
			'type'          => 'repeater',
			'instructions'  => 'Добавьте до 3 событий для превью',
			'layout'        => 'block',
			'button_label'  => 'Добавить событие',
			'max'           => 3,
			'sub_fields'    => array(
				array(
					'key'          => 'field_preview_event_type',
					'label'        => 'Тип события',
					'name'         => 'type',
					'type'         => 'select',
					'choices'      => array(
						'masterclass' => 'Мастер-класс',
						'lecture'     => 'Лекция',
						'meeting'     => 'Встреча',
						'family'      => 'Семейное занятие',
					),
					'default_value' => 'masterclass',
				),
				array(
					'key'          => 'field_preview_event_date',
					'label'        => 'Дата',
					'name'         => 'date',
					'type'         => 'text',
					'default_value' => '18 мая',
				),
				array(
					'key'          => 'field_preview_event_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Рисуем город мечты',
				),
				array(
					'key'          => 'field_preview_event_image',
					'label'        => 'Изображение',
					'name'         => 'image',
					'type'         => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'homepage.php',
			),
		),
	),
	'menu_order' => 3,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ГЛАВНАЯ ВЫСТАВКА — HERO
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_exhibition_hero',
	'title'    => 'Выставка: Hero',
	'fields'   => array(
		array(
			'key'           => 'field_exhibition_hero_title',
			'label'         => 'Заголовок',
			'name'          => 'exhibition_hero_title',
			'type'          => 'text',
			'default_value' => 'СССР: Сокровища счастливого советского ребёнка',
		),
		array(
			'key'           => 'field_exhibition_hero_description',
			'label'         => 'Описание',
			'name'          => 'exhibition_hero_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Постоянная экспозиция музея, посвящённая памяти детства, советским игрушкам, предметам быта и визуальной культуре прошлого.',
		),
		array(
			'key'           => 'field_exhibition_hero_image',
			'label'         => 'Фоновое изображение',
			'name'          => 'exhibition_hero_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_exhibition_hero_cta_primary_text',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'exhibition_hero_cta_primary_text',
			'type'          => 'text',
			'default_value' => 'Смотреть афишу',
		),
		array(
			'key'           => 'field_exhibition_hero_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'exhibition_hero_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_exhibition_hero_cta_secondary_text',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'exhibition_hero_cta_secondary_text',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_exhibition_hero_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'exhibition_hero_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'exhibition.php',
			),
		),
	),
	'menu_order' => 0,
	'position'   => 'normal',
) );

// Афиша: Абонементы и регулярные форматы
acf_add_local_field_group( array(
	'key'      => 'group_afisha_subscriptions',
	'title'    => 'Афиша: Абонементы',
	'fields'   => array(
		array(
			'key'           => 'field_afisha_subscriptions_title',
			'label'         => 'Заголовок секции',
			'name'          => 'afisha_subscriptions_title',
			'type'          => 'text',
			'default_value' => 'Абонементы и регулярные форматы',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'afisha.php',
			),
		),
	),
	'menu_order' => 3,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ABOUT MUSEUM (О музее)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_about_museum',
	'title'    => 'About Museum: О музее',
	'fields'   => array(
		array(
			'key'           => 'field_about_title',
			'label'         => 'Заголовок',
			'name'          => 'about_title',
			'type'          => 'text',
			'default_value' => 'О музее',
		),
		array(
			'key'           => 'field_about_description',
			'label'         => 'Описание',
			'name'          => 'about_description',
			'type'          => 'textarea',
			'rows'          => 5,
			'default_value' => 'Naif Arts– музей наивного искусства в Минске, посвященный самобытным художникам и искреннему художественному высказыванию. Здесь соседствуют детское творчество, произведения пожилых авторов и мировое наивное искусство, раскрывающее разные взгляды на мир вне академических правил. Музей - это не только пространство экспозиций, но и место, где проходят мастер-классы, лекции и встречи.',
		),
		array(
			'key'           => 'field_about_image',
			'label'         => 'Изображение',
			'name'          => 'about_image',
			'type'          => 'image',
			'instructions'  => 'Основное изображение секции',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_about_image_bg',
			'label'         => 'Изображение',
			'name'          => 'about_image_bg',
			'type'          => 'image',
			'instructions'  => 'Фоновое изображение секции',
			'return_format' => 'url',
			'library'       => 'all',
		),

	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'homepage.php',
			),
		),
	),
	'menu_order' => -7,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: EXPOSITIONS (Экспозиции)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_expositions',
	'title'    => 'Expositions: Экспозиции музея',
	'fields'   => array(
		array(
			'key'           => 'field_expositions_title',
			'label'         => 'Заголовок',
			'name'          => 'expositions_title',
			'type'          => 'text',
			'default_value' => 'Экспозиции музея',
		),
		array(
			'key'           => 'field_expositions_link_text',
			'label'         => 'Текст ссылки',
			'name'          => 'expositions_link_text',
			'type'          => 'text',
			'default_value' => 'Все экспозиции',
		),
		array(
			'key'           => 'field_expositions_list',
			'label'         => 'Экспозиции (до 4 шт)',
			'name'          => 'expositions_list',
			'type'          => 'repeater',
			'layout'        => 'block',
			'button_label'  => 'Добавить экспозицию',
			'max'           => 4,
			'sub_fields'    => array(
				array(
					'key'          => 'field_exposition_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Наивное искусство без правил',
				),
				array(
					'key'          => 'field_exposition_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 2,
					'default_value' => 'Работы художников-примитивистов, в которых особенно чувствуется искренность, свобода взгляда и отсутствие академических рамок.',
				),
				array(
					'key'          => 'field_exposition_image',
					'label'        => 'Изображение',
					'name'         => 'image',
					'type'         => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'homepage.php',
			),
		),
	),
	'menu_order' => -6,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: SPECIAL EXPOSITION (Особая экспозиция)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_special_exposition',
	'title'    => 'Special Exposition: Особая экспозиция',
	'fields'   => array(
		array(
			'key'           => 'field_special_badge',
			'label'         => 'Метка',
			'name'          => 'special_badge',
			'type'          => 'text',
			'default_value' => 'Особая постоянная экспозиция',
		),
		array(
			'key'           => 'field_special_title',
			'label'         => 'Заголовок',
			'name'          => 'special_title',
			'type'          => 'text',
			'default_value' => 'СССР: Сокровища счастливого советского ребенка',
		),
		array(
			'key'           => 'field_special_description',
			'label'         => 'Описание',
			'name'          => 'special_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Особая постоянная экспозиция музея, посвященная памяти детства, советским игрушкам, предметам быта и визуальной культуре прошлого.',
		),
		array(
			'key'           => 'field_special_image',
			'label'         => 'Изображение',
			'name'          => 'special_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_special_button_text',
			'label'         => 'Текст кнопки',
			'name'          => 'special_button_text',
			'type'          => 'text',
			'default_value' => 'Подробнее об экспозиции',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'homepage.php',
			),
		),
	),
	'menu_order' => -5,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: CLASSES & LECTURES (Мастер-классы и лекции)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_classes_lectures',
	'title'    => 'Classes & Lectures: Мастер-классы и лекции',
	'fields'   => array(
		array(
			'key'           => 'field_classes_title',
			'label'         => 'Заголовок',
			'name'          => 'classes_title',
			'type'          => 'text',
			'default_value' => 'Мастер-классы и лекции',
		),
		array(
			'key'           => 'field_classes_link_text',
			'label'         => 'Текст ссылки',
			'name'          => 'classes_link_text',
			'type'          => 'text',
			'default_value' => 'Все мастер-классы и лекции',
		),
		array(
			'key'           => 'field_classes_main',
			'label'         => 'Главный мастер-класс',
			'name'          => 'classes_main',
			'type'          => 'group',
			'layout'        => 'block',
			'sub_fields'    => array(
				array(
					'key'          => 'field_classes_main_type',
					'label'        => 'Тип',
					'name'         => 'type',
					'type'         => 'select',
					'choices'      => array(
						'masterclass' => 'Мастер-класс',
						'lecture'     => 'Лекция',
						'meeting'     => 'Встреча',
					),
					'default_value' => 'masterclass',
				),
				array(
					'key'          => 'field_classes_main_datetime',
					'label'        => 'Дата и время',
					'name'         => 'datetime',
					'type'         => 'text',
					'default_value' => '19 мая, вс · 12:00',
				),
				array(
					'key'          => 'field_classes_main_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Живопись акрилом: весенний пейзаж',
				),
				array(
					'key'          => 'field_classes_main_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 2,
					'default_value' => 'Пишем яркий пейзаж под руководством преподавателя. Для взрослых и подростков.',
				),
				array(
					'key'          => 'field_classes_main_image',
					'label'        => 'Изображение',
					'name'         => 'image',
					'type'         => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_classes_main_link',
					'label'        => 'Ссылка',
					'name'         => 'link',
					'type'         => 'url',
				),
				array(
					'key'          => 'field_classes_main_button_text',
					'label'        => 'Текст кнопки',
					'name'         => 'button_text',
					'type'         => 'text',
					'default_value' => 'Записаться',
				),
			),
		),
		array(
			'key'           => 'field_classes_list',
			'label'         => 'Список лекций (до 3 шт)',
			'name'          => 'classes_list',
			'type'          => 'repeater',
			'layout'        => 'block',
			'button_label'  => 'Добавить лекцию',
			'max'           => 3,
			'sub_fields'    => array(
				array(
					'key'          => 'field_class_item_type',
					'label'        => 'Тип',
					'name'         => 'type',
					'type'         => 'select',
					'choices'      => array(
						'masterclass' => 'Мастер-класс',
						'lecture'     => 'Лекция',
						'meeting'     => 'Встреча',
					),
					'default_value' => 'lecture',
				),
				array(
					'key'          => 'field_class_item_datetime',
					'label'        => 'Дата и время',
					'name'         => 'datetime',
					'type'         => 'text',
					'default_value' => '21 мая, вт · 18:30',
				),
				array(
					'key'          => 'field_class_item_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Лекция: Как понимать наивное искусство',
				),
				array(
					'key'          => 'field_class_item_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 2,
					'default_value' => 'О языке, символах и особой искренности наивного искусства.',
				),
				array(
					'key'          => 'field_class_item_image',
					'label'        => 'Изображение',
					'name'         => 'image',
					'type'         => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_class_item_link',
					'label'        => 'Ссылка',
					'name'         => 'link',
					'type'         => 'url',
				),
				array(
					'key'          => 'field_class_item_button_text',
					'label'        => 'Текст кнопки',
					'name'         => 'button_text',
					'type'         => 'text',
					'default_value' => 'Подробнее',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'homepage.php',
			),
		),
	),
	'menu_order' => -4,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: MUSEUM SHOP (Магазин музея)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_museum_shop',
	'title'    => 'Museum Shop: Магазин музея',
	'fields'   => array(
		array(
			'key'           => 'field_shop_title',
			'label'         => 'Заголовок',
			'name'          => 'shop_title',
			'type'          => 'text',
			'default_value' => 'Магазин музея',
		),
		array(
			'key'           => 'field_shop_link_text',
			'label'         => 'Текст ссылки',
			'name'          => 'shop_link_text',
			'type'          => 'text',
			'default_value' => 'В магазин',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'homepage.php',
			),
		),
	),
	'menu_order' => -3,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: WHY US (Почему приходят к нам)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_why_us',
	'title'    => 'Why Us: Почему приходят к нам',
	'fields'   => array(
		array(
			'key'           => 'field_why_us_title',
			'label'         => 'Заголовок',
			'name'          => 'why_us_title',
			'type'          => 'text',
			'default_value' => 'Почему приходят к нам',
		),
		array(
			'key'           => 'field_why_us_items',
			'label'         => 'Преимущества (4 шт)',
			'name'          => 'why_us_items',
			'type'          => 'repeater',
			'layout'        => 'block',
			'button_label'  => 'Добавить преимущество',
			'max'           => 4,
			'sub_fields'    => array(
				array(
					'key'           => 'field_why_us_item_icon',
					'label'         => 'Иконка',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'          => 'field_why_us_item_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Живая атмосфера',
				),
				array(
					'key'          => 'field_why_us_item_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 2,
					'default_value' => 'Уютное пространство, где искусство становится ближе, музей воспринимается неформально и по-домашнему.',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'homepage.php',
			),
		),
	),
	'menu_order' => -2,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: CTA SECTION (Призыв к действию)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_cta_section',
	'title'    => 'CTA Section: Призыв к действию',
	'fields'   => array(
		array(
			'key'           => 'field_cta_background_image',
			'label'         => 'Фоновое изображение (десктоп)',
			'name'          => 'cta_background_image',
			'type'          => 'image',
			'instructions'  => 'Фоновое изображение для CTA секции (десктопная версия, от 1024px и выше)',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_cta_background_image_mobile',
			'label'         => 'Фоновое изображение (мобильная)',
			'name'          => 'cta_background_image_mobile',
			'type'          => 'image',
			'instructions'  => 'Фоновое изображение для CTA секции (мобильная версия, до 1024px). Если не загружено, используется десктопное.',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_cta_title',
			'label'         => 'Заголовок',
			'name'          => 'cta_title',
			'type'          => 'text',
			'default_value' => 'Проведите день в мире искреннего искусства',
		),
		array(
			'key'           => 'field_cta_primary',
			'label'         => 'Главная кнопка (текст)',
			'name'          => 'cta_primary',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_cta_secondary',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'cta_secondary',
			'type'          => 'text',
			'default_value' => 'Посмотреть афишу',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'homepage.php',
			),
		),
	),
	'menu_order' => -1,
	'position'   => 'normal',
) );


// ============================================
// ГРУППА: О ТОВАРЕ (Фон)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sp_about',
	'title'    => 'О товаре: Фон',
	'fields'   => array(
		array(
			'key'           => 'field_sp_about_bg',
			'label'         => 'Фоновое изображение (десктоп)',
			'name'          => 'sp_about_bg',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sp_about_bg_mobile',
			'label'         => 'Фоновое изображение (мобильная)',
			'name'          => 'sp_about_bg_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'product',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ХАРАКТЕРИСТИКИ (Фон)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sp_chars',
	'title'    => 'Характеристики: Фон',
	'fields'   => array(
		array(
			'key'           => 'field_sp_char_bg',
			'label'         => 'Фоновое изображение (десктоп)',
			'name'          => 'sp_char_bg',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sp_char_bg_mobile',
			'label'         => 'Фоновое изображение (мобильная)',
			'name'          => 'sp_char_bg_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'product',
			),
		),
	),
	'menu_order' => 2,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ПОЧЕМУ ЭТОТ ТОВАР ВЫБИРАЮТ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sp_why',
	'title'    => 'Почему этот товар выбирают',
	'fields'   => array(
		array(
			'key'           => 'field_sp_why_bg',
			'label'         => 'Фоновое изображение (десктоп)',
			'name'          => 'sp_why_bg',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sp_why_bg_mobile',
			'label'         => 'Фоновое изображение (мобильная)',
			'name'          => 'sp_why_bg_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sp_why_title',
			'label'         => 'Заголовок секции',
			'name'          => 'sp_why_title',
			'type'          => 'text',
			'default_value' => 'Почему этот товар выбирают',
		),
		array(
			'key'           => 'field_sp_why_items',
			'label'         => 'Пункты',
			'name'          => 'sp_why_items',
			'type'          => 'repeater',
			'layout'        => 'block',
			'button_label'  => 'Добавить пункт',
			'sub_fields'    => array(
				array(
					'key'           => 'field_sp_why_item_icon',
					'label'         => 'Иконка',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'          => 'field_sp_why_item_text',
					'label'        => 'Текст',
					'name'         => 'text',
					'type'         => 'text',
					'default_value' => 'связан с выставочным проектом музея',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'product',
			),
		),
	),
	'menu_order' => 3,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КАК ПОЛУЧИТЬ ЗАКАЗ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sp_delivery',
	'title'    => 'Как получить заказ',
	'fields'   => array(
		array(
			'key'           => 'field_sp_delivery_title',
			'label'         => 'Заголовок секции',
			'name'          => 'sp_delivery_title',
			'type'          => 'text',
			'default_value' => 'Как получить заказ',
		),
		array(
			'key'           => 'field_sp_delivery_items',
			'label'         => 'Способы получения (4 шт)',
			'name'          => 'sp_delivery_items',
			'type'          => 'repeater',
			'layout'        => 'block',
			'button_label'  => 'Добавить способ',
			'max'           => 4,
			'sub_fields'    => array(
				array(
					'key'           => 'field_sp_delivery_item_icon',
					'label'         => 'Иконка',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'          => 'field_sp_delivery_item_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Самовывоз из музея',
				),
				array(
					'key'          => 'field_sp_delivery_item_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 2,
					'default_value' => 'Заберите заказ в музее в удобное для вас время.',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'product',
			),
		),
	),
	'menu_order' => 4,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: БАННЕР ВНИЗУ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sp_banner',
	'title'    => 'Баннер: Продолжите знакомство',
	'fields'   => array(
		array(
			'key'           => 'field_sp_banner_bg',
			'label'         => 'Фоновое изображение (десктоп)',
			'name'          => 'sp_banner_bg',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sp_banner_bg_mobile',
			'label'         => 'Фоновое изображение (мобильная)',
			'name'          => 'sp_banner_bg_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sp_banner_title',
			'label'         => 'Заголовок',
			'name'          => 'sp_banner_title',
			'type'          => 'text',
			'default_value' => 'Продолжите знакомство с музеем',
		),
		array(
			'key'           => 'field_sp_banner_button_text',
			'label'         => 'Текст кнопки',
			'name'          => 'sp_banner_button_text',
			'type'          => 'text',
			'default_value' => 'Посмотреть афишу',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'product',
			),
		),
	),
	'menu_order' => 5,
	'position'   => 'normal',
) );


// ============================================
// ГРУППА: HERO СЕКЦИЯ КАТАЛОГА
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sc_hero',
	'title'    => 'Каталог: Hero секция',
	'fields'   => array(
		array(
			'key'           => 'field_sc_title',
			'label'         => 'Заголовок',
			'name'          => 'sc_title',
			'type'          => 'text',
			'default_value' => 'Магазин музея',
		),
		array(
			'key'           => 'field_sc_description',
			'label'         => 'Описание',
			'name'          => 'sc_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Каталоги, открытки, принты, сувениры и другие вещи, которые помогают сохранить впечатление от музея и наивного искусства.',
		),
		array(
			'key'           => 'field_sc_hero_bg',
			'label'         => 'Фоновое изображение (десктоп)',
			'name'          => 'sc_hero_bg',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sc_hero_bg_mobile',
			'label'         => 'Фоновое изображение (мобильная)',
			'name'          => 'sc_hero_bg_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'shop-catalog.php',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КАК ПОЛУЧИТЬ ЗАКАЗ (Каталог)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sc_delivery',
	'title'    => 'Каталог: Как получить заказ',
	'fields'   => array(
		array(
			'key'           => 'field_sc_delivery_title',
			'label'         => 'Заголовок секции',
			'name'          => 'sc_delivery_title',
			'type'          => 'text',
			'default_value' => 'Как получить заказ',
		),
		array(
			'key'           => 'field_sc_delivery_items',
			'label'         => 'Способы получения (4 шт)',
			'name'          => 'sc_delivery_items',
			'type'          => 'repeater',
			'layout'        => 'block',
			'button_label'  => 'Добавить способ',
			'max'           => 4,
			'sub_fields'    => array(
				array(
					'key'           => 'field_sc_delivery_item_icon',
					'label'         => 'Иконка',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'          => 'field_sc_delivery_item_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Самовывоз из музея',
				),
				array(
					'key'          => 'field_sc_delivery_item_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 2,
					'default_value' => 'Заберите заказ в музее в удобное для вас время.',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'shop-catalog.php',
			),
		),
	),
	'menu_order' => 2,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: БАННЕР КАТАЛОГА
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sc_banner',
	'title'    => 'Каталог: Баннер внизу',
	'fields'   => array(
		array(
			'key'           => 'field_sc_banner_bg',
			'label'         => 'Фоновое изображение (десктоп)',
			'name'          => 'sc_banner_bg',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sc_banner_bg_mobile',
			'label'         => 'Фоновое изображение (мобильная)',
			'name'          => 'sc_banner_bg_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sc_banner_title',
			'label'         => 'Заголовок',
			'name'          => 'sc_banner_title',
			'type'          => 'text',
			'default_value' => 'Выберите вещь, которую захочется забрать с собой',
		),
		array(
			'key'           => 'field_sc_banner_btn_primary',
			'label'         => 'Текст кнопки 1',
			'name'          => 'sc_banner_btn_primary',
			'type'          => 'text',
			'default_value' => 'Перейти в корзину',
		),
		array(
			'key'           => 'field_sc_banner_btn_secondary',
			'label'         => 'Текст кнопки 2',
			'name'          => 'sc_banner_btn_secondary',
			'type'          => 'text',
			'default_value' => 'Посмотреть афишу',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'shop-catalog.php',
			),
		),
	),
	'menu_order' => 3,
	'position'   => 'normal',
) );

acf_add_local_field_group( array(
	'key'      => 'group_event_cta',
	'title'    => 'Событие: CTA-секция',
	'fields'   => array(
		array(
			'key'           => 'field_event_cta_background_image',
			'label'         => 'Фон изображение (десктоп)',
			'name'          => 'event_cta_background_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_cta_background_image_mobile',
			'label'         => 'Фон изображение (мобильная)',
			'name'          => 'event_cta_background_image_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_cta_title',
			'label'         => 'Заголовок',
			'name'          => 'event_cta_title',
			'type'          => 'text',
			'default_value' => 'Выберите событие и приходите в музей',
		),
		array(
			'key'           => 'field_event_cta_primary',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'event_cta_primary',
			'type'          => 'text',
		),
		array(
			'key'           => 'field_event_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'event_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_event_cta_secondary',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'event_cta_secondary',
			'type'          => 'text',
		),
		array(
			'key'           => 'field_event_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'event_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'event',
			),
		),
	),
	'menu_order' => 10,
	'position'   => 'normal',
) );

acf_add_local_field_group( array(
	'key'      => 'group_about_hero',
	'title'    => 'О музее: Hero',
	'fields'   => array(
			array(
			'key'           => 'field_about_hero_title',
			'label'         => 'Заголовок',
			'name'          => 'about_hero_title',
			'type'          => 'text',
			'default_value' => 'О музее Naif Arts',
		),
		array(
			'key'           => 'field_about_hero_description',
			'label'         => 'Описание',
			'name'          => 'about_hero_description',
			'type'          => 'textarea',
			'rows'          => 4,
			'default_value' => 'Теплое культурное пространство в Минске, где наивное искусство раскрывается через выставки, мастер-классы, лекции и семейные программы.',
		),
		array(
			'key'           => 'field_about_hero_image',
			'label'         => 'Изображение (десктоп)',
			'name'          => 'about_hero_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_about_hero_image_mobile',
			'label'         => 'Изображение (мобайл)',
			'name'          => 'about_hero_image_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_about_hero_cta_primary_text',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'about_hero_cta_primary_text',
			'type'          => 'text',
			'default_value' => 'Смотреть арт',
		),
		array(
			'key'           => 'field_about_hero_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'about_hero_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_about_hero_cta_secondary_text',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'about_hero_cta_secondary_text',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_about_hero_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'about_hero_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'about.php',
			),
		),
	),
	'menu_order' => 0,
	'position'   => 'normal',
) );

acf_add_local_field_group( array(
	'key'      => 'group_about_mission_v3',
	'title'    => 'О музее: Миссия и статистика',
	'fields'   => array(
		array(
			'key'           => 'field_about_mission_title_v3',
			'label'         => 'Заголовок',
			'name'          => 'about_mission_title',
			'type'          => 'text',
			'default_value' => 'Музей, где искусство остаётся искренним',
		),
		array(
			'key'           => 'field_about_mission_description_v3',
			'label'         => 'Описание',
			'name'          => 'about_mission_description',
			'type'          => 'textarea',
			'rows'          => 6,
			'default_value' => 'Naif Arts — музей наивного искусства в Минске. Коллекция насчитывает более 1500 работ художников-самоучек из разных стран. Здесь живут картины, выполненные с любовью и фантазией, без академических правил, но с огромной душой. Музей — это место, где можно увидеть работы профессиональных художников, посетить мастер-классы, лекции, встречи и творческие программы для детей и взрослых.',
		),
		array(
			'key'           => 'field_about_stat_1_icon_v3',
			'label'         => 'Статистика 1: Иконка',
			'name'          => 'about_stat_1_icon',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
			'preview_size'  => 'thumbnail',
		),
		array(
			'key'           => 'field_about_stat_1_number_v3',
			'label'         => 'Статистика 1: Число',
			'name'          => 'about_stat_1_number',
			'type'          => 'text',
			'default_value' => '1500+',
		),
		array(
			'key'           => 'field_about_stat_1_label_v3',
			'label'         => 'Статистика 1: Подпись',
			'name'          => 'about_stat_1_label',
			'type'          => 'text',
			'default_value' => 'картин художников-самоучек',
		),
		array(
			'key'           => 'field_about_stat_2_icon_v3',
			'label'         => 'Статистика 2: Иконка',
			'name'          => 'about_stat_2_icon',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
			'preview_size'  => 'thumbnail',
		),
		array(
			'key'           => 'field_about_stat_2_number_v3',
			'label'         => 'Статистика 2: Число',
			'name'          => 'about_stat_2_number',
			'type'          => 'text',
			'default_value' => '9',
		),
		array(
			'key'           => 'field_about_stat_2_label_v3',
			'label'         => 'Статистика 2: Подпись',
			'name'          => 'about_stat_2_label',
			'type'          => 'text',
			'default_value' => 'направлений',
		),
		array(
			'key'           => 'field_about_stat_3_icon_v3',
			'label'         => 'Статистика 3: Иконка',
			'name'          => 'about_stat_3_icon',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
			'preview_size'  => 'thumbnail',
		),
		array(
			'key'           => 'field_about_stat_3_number_v3',
			'label'         => 'Статистика 3: Число',
			'name'          => 'about_stat_3_number',
			'type'          => 'text',
			'default_value' => 'Первый',
		),
		array(
			'key'           => 'field_about_stat_3_label_v3',
			'label'         => 'Статистика 3: Подпись',
			'name'          => 'about_stat_3_label',
			'type'          => 'text',
			'default_value' => 'в Минске',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'about.php',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

acf_add_local_field_group( array(
	'key'      => 'group_about_what_to_do',
	'title'    => 'О музее: Что можно сделать',
	'fields'   => array(
		array(
			'key'           => 'field_about_what_to_do_title',
			'label'         => 'Заголовок',
			'name'          => 'about_what_to_do_title',
			'type'          => 'text',
			'default_value' => 'Что можно сделать в музее',
		),
		array(
			'key'          => 'field_about_what_to_do_items',
			'label'        => 'Элементы',
			'name'         => 'about_what_to_do_items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить элемент',
			'sub_fields'   => array(
				array(
					'key'           => 'field_about_what_to_do_icon',
					'label'         => 'Иконка',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'     => 'field_about_what_to_do_item_title',
					'label'   => 'Заголовок',
					'name'    => 'title',
					'type'    => 'text',
				),
				array(
					'key'     => 'field_about_what_to_do_item_description',
					'label'   => 'Описание',
					'name'    => 'description',
					'type'    => 'textarea',
					'rows'    => 3,
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'about.php',
			),
		),
	),
	'menu_order' => 2,
	'position'   => 'normal',
) );

acf_add_local_field_group( array(
	'key'      => 'group_about_expositions',
	'title'    => 'О музее: Экспозиции',
	'fields'   => array(
		array(
			'key'           => 'field_about_expositions_title',
			'label'         => 'Заголовок',
			'name'          => 'about_expositions_title',
			'type'          => 'text',
			'default_value' => 'Экспозиции музея',
		),
		array(
			'key'           => 'field_about_expositions_link_text',
			'label'         => 'Текст ссылки',
			'name'          => 'about_expositions_link_text',
			'type'          => 'text',
			'default_value' => 'Все экспозиции',
		),
		array(
			'key'          => 'field_about_expositions_list',
			'label'        => 'Экспозиции',
			'name'         => 'about_expositions_list',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить экспозицию',
			'sub_fields'   => array(
				array(
					'key'           => 'field_about_expo_image',
					'label'         => 'Изображение',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'     => 'field_about_expo_title',
					'label'   => 'Название',
					'name'    => 'title',
					'type'    => 'text',
				),
				array(
					'key'     => 'field_about_expo_description',
					'label'   => 'Описание',
					'name'    => 'description',
					'type'    => 'textarea',
					'rows'    => 3,
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'about.php',
			),
		),
	),
	'menu_order' => 3,
	'position'   => 'normal',
) );

acf_add_local_field_group( array(
	'key'      => 'group_about_education',
	'title'    => 'О музее: Образование',
	'fields'   => array(
		array(
			'key'           => 'field_about_education_title',
			'label'         => 'Заголовок секции',
			'name'          => 'about_education_title',
			'type'          => 'text',
			'default_value' => 'Образовательная и творческая программа',
		),
		array(
			'key'           => 'field_about_education_link_text',
			'label'         => 'Текст ссылки',
			'name'          => 'about_education_link_text',
			'type'          => 'text',
			'default_value' => 'Все мастер-классы и лекции',
		),
		array(
			'key'           => 'field_about_education_lectures_title',
			'label'         => 'Лекции: заголовок',
			'name'          => 'about_education_lectures_title',
			'type'          => 'text',
			'default_value' => 'Лекции, экскурсии и встречи',
		),
		array(
			'key'           => 'field_about_education_lectures_description',
			'label'         => 'Лекции: описание',
			'name'          => 'about_education_lectures_description',
			'type'          => 'textarea',
			'rows'          => 4,
			'default_value' => 'Групповые и индивидуальные экскурсии, авторские лекции по истории искусства, тематические встречи с искусствоведами.',
		),
		array(
			'key'           => 'field_about_education_lectures_image',
			'label'         => 'Лекции: изображение',
			'name'          => 'about_education_lectures_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'          => 'field_about_education_lectures_items',
			'label'        => 'Лекции: список',
			'name'         => 'about_education_lectures_items',
			'type'         => 'repeater',
			'layout'       => 'table',
			'button_label' => 'Добавить пункт',
			'sub_fields'   => array(
				array(
					'key'   => 'field_about_lectures_item_text',
					'label' => 'Текст',
					'name'  => 'text',
					'type'  => 'text',
				),
			),
		),
		array(
			'key'           => 'field_about_education_lectures_button',
			'label'         => 'Лекции: кнопка',
			'name'          => 'about_education_lectures_button',
			'type'          => 'text',
			'default_value' => 'Подробнее',
		),
		array(
			'key'           => 'field_about_education_masterclass_title',
			'label'         => 'Мастер-классы: заголовок',
			'name'          => 'about_education_masterclass_title',
			'type'          => 'text',
			'default_value' => 'Мастер-классы и творческие активности',
		),
		array(
			'key'           => 'field_about_education_masterclass_description',
			'label'         => 'Мастер-классы: описание',
			'name'          => 'about_education_masterclass_description',
			'type'          => 'textarea',
			'rows'          => 4,
			'default_value' => 'Практические занятия для взрослых и детей, где можно создать свою работу под руководством преподавателя.',
		),
		array(
			'key'           => 'field_about_education_masterclass_image',
			'label'         => 'Мастер-классы: изображение',
			'name'          => 'about_education_masterclass_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'          => 'field_about_education_masterclass_items',
			'label'        => 'Мастер-классы: список',
			'name'         => 'about_education_masterclass_items',
			'type'         => 'repeater',
			'layout'       => 'table',
			'button_label' => 'Добавить пункт',
			'sub_fields'   => array(
				array(
					'key'   => 'field_about_masterclass_item_text',
					'label' => 'Текст',
					'name'  => 'text',
					'type'  => 'text',
				),
			),
		),
		array(
			'key'           => 'field_about_education_masterclass_button',
			'label'         => 'Мастер-классы: кнопка',
			'name'          => 'about_education_masterclass_button',
			'type'          => 'text',
			'default_value' => 'Подробнее',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'about.php',
			),
		),
	),
	'menu_order' => 5,
	'position'   => 'normal',
) );

acf_add_local_field_group( array(
	'key'      => 'group_about_shop',
	'title'    => 'О музее: Магазин',
	'fields'   => array(
		array(
			'key'           => 'field_about_shop_title',
			'label'         => 'Заголовок',
			'name'          => 'about_shop_title',
			'type'          => 'text',
			'default_value' => 'Искусство, книги и музейные сувениры',
		),
		array(
			'key'           => 'field_about_shop_link_text',
			'label'         => 'Текст ссылки',
			'name'          => 'about_shop_link_text',
			'type'          => 'text',
			'default_value' => 'В магазин',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'about.php',
			),
		),
	),
	'menu_order' => 6,
	'position'   => 'normal',
) );

acf_add_local_field_group( array(
	'key'      => 'group_about_events',
	'title'    => 'О музее: События',
	'fields'   => array(
		array(
			'key'           => 'field_about_events_title',
			'label'         => 'Заголовок',
			'name'          => 'about_events_title',
			'type'          => 'text',
			'default_value' => 'События, ради которых хочется возвращаться',
		),
		array(
			'key'           => 'field_about_events_link_text',
			'label'         => 'Текст ссылки',
			'name'          => 'about_events_link_text',
			'type'          => 'text',
			'default_value' => 'Смотреть все события',
		),
		array(
			'key'          => 'field_about_events_list',
			'label'        => 'События',
			'name'         => 'about_events_list',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить событие',
			'sub_fields'   => array(
				array(
					'key'           => 'field_about_event_image',
					'label'         => 'Изображение',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'     => 'field_about_event_type',
					'label'   => 'Тип',
					'name'    => 'type',
					'type'    => 'select',
					'choices' => array(
						'masterclass' => 'Мастер-класс',
						'lecture'     => 'Лекция',
						'meeting'     => 'Встреча',
						'family'      => 'Семейное занятие',
					),
				),
				array(
					'key'     => 'field_about_event_datetime',
					'label'   => 'Дата/время',
					'name'    => 'datetime',
					'type'    => 'text',
				),
				array(
					'key'     => 'field_about_event_title',
					'label'   => 'Название',
					'name'    => 'title',
					'type'    => 'text',
				),
				array(
					'key'     => 'field_about_event_description',
					'label'   => 'Описание',
					'name'    => 'description',
					'type'    => 'textarea',
					'rows'    => 3,
				),
				array(
					'key'     => 'field_about_event_button_text',
					'label'   => 'Текст кнопки',
					'name'    => 'button_text',
					'type'    => 'text',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'about.php',
			),
		),
	),
	'menu_order' => 7,
	'position'   => 'normal',
) );

acf_add_local_field_group( array(
	'key'      => 'group_about_cta',
	'title'    => 'О музее: CTA-секция',
	'fields'   => array(
		array(
			'key'           => 'field_about_cta_background_image',
			'label'         => 'Фон изображение (десктоп)',
			'name'          => 'about_cta_background_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_about_cta_background_image_mobile',
			'label'         => 'Фон изображение (мобильная)',
			'name'          => 'about_cta_background_image_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_about_cta_title',
			'label'         => 'Заголовок',
			'name'          => 'about_cta_title',
			'type'          => 'text',
			'default_value' => 'Познакомьтесь с искусством ближе',
		),
		array(
			'key'           => 'field_about_cta_primary',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'about_cta_primary',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_about_cta_secondary',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'about_cta_secondary',
			'type'          => 'text',
			'default_value' => 'Посетите музей',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'about.php',
			),
		),
	),
	'menu_order' => 8,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КАФЕ — HERO
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_cafe_hero',
	'title'    => 'Кафе: Hero',
	'fields'   => array(
		array(
			'key'           => 'field_cafe_hero_title',
			'label'         => 'Заголовок',
			'name'          => 'cafe_hero_title',
			'type'          => 'text',
			'default_value' => 'Кафе музея',
		),
		array(
			'key'           => 'field_cafe_hero_description',
			'label'         => 'Описание',
			'name'          => 'cafe_hero_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Пространство для отдыха, разговоров и вкусной паузы после знакомства с искусством.',
		),
		array(
			'key'           => 'field_cafe_hero_image',
			'label'         => 'Изображение',
			'name'          => 'cafe_hero_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_cafe_hero_cta_primary_text',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'cafe_hero_cta_primary_text',
			'type'          => 'text',
			'default_value' => 'Смотреть афишу',
		),
		array(
			'key'           => 'field_cafe_hero_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'cafe_hero_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_cafe_hero_cta_secondary_text',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'cafe_hero_cta_secondary_text',
			'type'          => 'text',
			'default_value' => 'Связаться с музеем',
		),
		array(
			'key'           => 'field_cafe_hero_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'cafe_hero_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'cafe.php',
			),
		),
	),
	'menu_order' => 0,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КАФЕ — ОПИСАНИЕ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_cafe_about',
	'title'    => 'Кафе: Описание',
	'fields'   => array(
		array(
			'key'           => 'field_cafe_about_title',
			'label'         => 'Заголовок',
			'name'          => 'cafe_about_title',
			'type'          => 'text',
			'default_value' => 'Искусство хочется не только смотреть, но и обсуждать',
		),
		array(
			'key'           => 'field_cafe_about_description',
			'label'         => 'Описание',
			'name'          => 'cafe_about_description',
			'type'          => 'textarea',
			'rows'          => 5,
			'default_value' => 'Посещение музея — это событие не только эстетическое, но и гастрономическое. Увиденное хочется обсудить, обсудить и прожить чуть дольше — за чашкой чая, кофе или десертом. Поэтому мы создали музейное кафе, где можно комфортно провести время после экспозиции с постоянной экспозицией и новыми выставками.',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'cafe.php',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КАФЕ — ЧТО ВАС ЖДЕТ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_cafe_features',
	'title'    => 'Кафе: Что вас ждет',
	'fields'   => array(
		array(
			'key'           => 'field_cafe_features_title',
			'label'         => 'Заголовок',
			'name'          => 'cafe_features_title',
			'type'          => 'text',
			'default_value' => 'Что вас ждет',
		),
		array(
			'key'          => 'field_cafe_features_items',
			'label'        => 'Карточки',
			'name'         => 'cafe_features_items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить карточку',
			'max'          => 4,
			'sub_fields'   => array(
				array(
					'key'           => 'field_cafe_feature_icon',
					'label'         => 'Иконка',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'          => 'field_cafe_feature_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Кафе и десерты',
				),
				array(
					'key'          => 'field_cafe_feature_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 3,
					'default_value' => 'Идеальное место для короткой паузы, неспешного разговора и отдыха после прогулки по музею.',
				),
				array(
					'key'           => 'field_cafe_feature_image',
					'label'         => 'Изображение',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'cafe.php',
			),
		),
	),
	'menu_order' => 2,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КАФЕ — ТВОРЧЕСКАЯ ПАУЗА
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_cafe_creative',
	'title'    => 'Кафе: Творческая пауза',
	'fields'   => array(
		array(
			'key'           => 'field_cafe_creative_title',
			'label'         => 'Заголовок',
			'name'          => 'cafe_creative_title',
			'type'          => 'text',
			'default_value' => 'Творческая пауза внутри музейного маршрута',
		),
		array(
			'key'           => 'field_cafe_creative_description',
			'label'         => 'Описание',
			'name'          => 'cafe_creative_description',
			'type'          => 'textarea',
			'rows'          => 4,
			'default_value' => 'Кафе продолжает атмосферу музея: здесь можно сделать паузу, обсудить увиденное, встретиться с друзьями или просто спокойно провести время в красивом пространстве.',
		),
		array(
			'key'           => 'field_cafe_creative_image',
			'label'         => 'Изображение',
			'name'          => 'cafe_creative_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'cafe.php',
			),
		),
	),
	'menu_order' => 3,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КАФЕ — ВАЖНО ЗНАТЬ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_cafe_important',
	'title'    => 'Кафе: Важно знать',
	'fields'   => array(
		array(
			'key'           => 'field_cafe_important_title',
			'label'         => 'Заголовок',
			'name'          => 'cafe_important_title',
			'type'          => 'text',
			'default_value' => 'Важно знать перед посещением',
		),
		array(
			'key'          => 'field_cafe_important_items',
			'label'        => 'Карточки',
			'name'         => 'cafe_important_items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить карточку',
			'max'          => 6,
			'sub_fields'   => array(
				array(
					'key'           => 'field_cafe_important_icon',
					'label'         => 'Иконка',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'          => 'field_cafe_important_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Посещение по билету музея',
				),
				array(
					'key'          => 'field_cafe_important_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 3,
					'default_value' => 'Для посещения кафе и бара необходим действующий билет в музей.',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'cafe.php',
			),
		),
	),
	'menu_order' => 4,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КАФЕ — ГАЛЕРЕЯ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_cafe_gallery',
	'title'    => 'Кафе: Галерея',
	'fields'   => array(
		array(
			'key'           => 'field_cafe_gallery_title',
			'label'         => 'Заголовок',
			'name'          => 'cafe_gallery_title',
			'type'          => 'text',
			'default_value' => 'Пространство для отдыха и разговоров',
		),
		array(
			'key'          => 'field_cafe_gallery_images',
			'label'        => 'Изображения (4 шт)',
			'name'         => 'cafe_gallery_images',
			'type'         => 'gallery',
			'layout'       => 'grid',
			'button_label' => 'Добавить изображение',
			'return_format' => 'array',
			'library'       => 'all',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'cafe.php',
			),
		),
	),
	'menu_order' => 5,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КАФЕ — CTA
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_cafe_cta',
	'title'    => 'Кафе: CTA-секция',
	'fields'   => array(
		array(
			'key'           => 'field_cafe_cta_background_image',
			'label'         => 'Фон изображение (десктоп)',
			'name'          => 'cafe_cta_background_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_cafe_cta_background_image_mobile',
			'label'         => 'Фон изображение (мобильная)',
			'name'          => 'cafe_cta_background_image_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_cafe_cta_title',
			'label'         => 'Заголовок',
			'name'          => 'cafe_cta_title',
			'type'          => 'text',
			'default_value' => 'Хотите провести время в музейном кафе?',
		),
		array(
			'key'           => 'field_cafe_cta_primary',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'cafe_cta_primary',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_cafe_cta_secondary',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'cafe_cta_secondary',
			'type'          => 'text',
			'default_value' => 'Связаться с музеем',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'cafe.php',
			),
		),
	),
	'menu_order' => 6,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КОНТАКТЫ — HERO
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_contacts_hero',
	'title'    => 'Контакты: Hero',
	'fields'   => array(
		array(
			'key'           => 'field_contacts_hero_title',
			'label'         => 'Заголовок',
			'name'          => 'contacts_hero_title',
			'type'          => 'text',
			'default_value' => 'Контакты музея',
		),
		array(
			'key'           => 'field_contacts_hero_description',
			'label'         => 'Описание',
			'name'          => 'contacts_hero_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Свяжитесь с нами, запланируйте посещение музея или найдите удобный способ добраться до Naif Arts',
		),
		array(
			'key'           => 'field_contacts_hero_image',
			'label'         => 'Фоновое изображение',
			'name'          => 'contacts_hero_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'contacts.php',
			),
		),
	),
	'menu_order' => 0,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КОНТАКТЫ — КОНТАКТНАЯ ИНФОРМАЦИЯ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_contacts_info',
	'title'    => 'Контакты: Контактная информация',
	'fields'   => array(
		array(
			'key'           => 'field_contacts_address_title',
			'label'         => 'Адрес: заголовок',
			'name'          => 'contacts_address_title',
			'type'          => 'text',
			'default_value' => 'Адрес музея',
		),
		array(
			'key'           => 'field_contacts_address_text',
			'label'         => 'Адрес: текст',
			'name'          => 'contacts_address_text',
			'type'          => 'textarea',
			'rows'          => 2,
			'default_value' => 'Минск, пр-т Победителей, 84, 2 этаж, ТЦ «Арена Сити»',
		),
		array(
			'key'           => 'field_contacts_address_map_query',
			'label'         => 'Адрес для карты',
			'name'          => 'contacts_address_map_query',
			'type'          => 'text',
			'instructions'  => 'Точный адрес для Яндекс Карт (будет использован для геокодирования)',
			'default_value' => 'Минск, пр-т Победителей, 84',
		),
		array(
			'key'           => 'field_contacts_phone_title',
			'label'         => 'Телефон: заголовок',
			'name'          => 'contacts_phone_title',
			'type'          => 'text',
			'default_value' => 'Телефон',
		),
		array(
			'key'           => 'field_contacts_phone_text',
			'label'         => 'Телефон: текст',
			'name'          => 'contacts_phone_text',
			'type'          => 'text',
			'default_value' => '+375 44 574-30-82',
		),
		array(
			'key'           => 'field_contacts_phone_link',
			'label'         => 'Телефон: ссылка',
			'name'          => 'contacts_phone_link',
			'type'          => 'text',
			'default_value' => 'tel:+375445743082',
		),
		array(
			'key'           => 'field_contacts_email_title',
			'label'         => 'Почта: заголовок',
			'name'          => 'contacts_email_title',
			'type'          => 'text',
			'default_value' => 'E-mail',
		),
		array(
			'key'           => 'field_contacts_email_text',
			'label'         => 'Почта: текст',
			'name'          => 'contacts_email_text',
			'type'          => 'text',
			'default_value' => 'naifartsmuseum@yandex.by',
		),
		array(
			'key'           => 'field_contacts_email_link',
			'label'         => 'Почта: ссылка',
			'name'          => 'contacts_email_link',
			'type'          => 'text',
			'default_value' => 'mailto:naifartsmuseum@yandex.by',
		),
		array(
			'key'           => 'field_contacts_socials_title',
			'label'         => 'Соцсети: заголовок',
			'name'          => 'contacts_socials_title',
			'type'          => 'text',
			'default_value' => 'Мы в социальных сетях',
		),
		array(
			'key'           => 'field_contacts_socials_instagram',
			'label'         => 'Instagram: ссылка',
			'name'          => 'contacts_socials_instagram',
			'type'          => 'url',
			'default_value' => 'https://www.instagram.com/naifartsmuseum',
		),
		array(
			'key'           => 'field_contacts_socials_tiktok',
			'label'         => 'TikTok: ссылка',
			'name'          => 'contacts_socials_tiktok',
			'type'          => 'url',
			'default_value' => 'https://www.tiktok.com/@naifartsmuseum',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'contacts.php',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КОНТАКТЫ — ЧАСЫ РАБОТЫ + КАРТА
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_contacts_hours_map',
	'title'    => 'Контакты: Часы работы и Карта',
	'fields'   => array(
		array(
			'key'           => 'field_contacts_hours_title',
			'label'         => 'Часы работы: заголовок',
			'name'          => 'contacts_hours_title',
			'type'          => 'text',
			'default_value' => 'Часы работы',
		),
		array(
			'key'           => 'field_contacts_hours_text',
			'label'         => 'Часы работы: текст',
			'name'          => 'contacts_hours_text',
			'type'          => 'text',
			'default_value' => 'Музей работает с 10:00 до 22:00',
		),
		array(
			'key'           => 'field_contacts_how_to_get_title',
			'label'         => 'Карта: заголовок',
			'name'          => 'contacts_how_to_get_title',
			'type'          => 'text',
			'default_value' => 'Как добраться',
		),
		array(
			'key'           => 'field_contacts_map_api_key',
			'label'         => 'API-ключ Яндекс Карт',
			'name'          => 'contacts_map_api_key',
			'type'          => 'text',
			'instructions'  => 'Получите API-ключ на https://developer.tech.yandex.ru/',
		),
		array(
			'key'           => 'field_contacts_map_center_lat',
			'label'         => 'Широта центра карты',
			'name'          => 'contacts_map_center_lat',
			'type'          => 'text',
			'default_value' => '53.9386',
		),
		array(
			'key'           => 'field_contacts_map_center_lon',
			'label'         => 'Долгота центра карты',
			'name'          => 'contacts_map_center_lon',
			'type'          => 'text',
			'default_value' => '27.4855',
		),
		array(
			'key'           => 'field_contacts_map_zoom',
			'label'         => 'Масштаб',
			'name'          => 'contacts_map_zoom',
			'type'          => 'range',
			'min'           => 1,
			'max'           => 19,
			'step'          => 1,
			'default_value' => 16,
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'contacts.php',
			),
		),
	),
	'menu_order' => 2,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: КОНТАКТЫ — ФОРМА И РЕКВИЗИТЫ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_contacts_form',
	'title'    => 'Контакты: Форма и Реквизиты',
	'fields'   => array(
		array(
			'key'           => 'field_contacts_form_bg_image',
			'label'         => 'Фон секции формы',
			'name'          => 'contacts_form_bg_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_contacts_form_title',
			'label'         => 'Форма: заголовок',
			'name'          => 'contacts_form_title',
			'type'          => 'text',
			'default_value' => 'Напишите нам',
		),
		array(
			'key'           => 'field_contacts_form_name_placeholder',
			'label'         => 'Форма: плейсхолдер имени',
			'name'          => 'contacts_form_name_placeholder',
			'type'          => 'text',
			'default_value' => 'Иван Иванов',
		),
		array(
			'key'           => 'field_contacts_form_phone_placeholder',
			'label'         => 'Форма: плейсхолдер телефона',
			'name'          => 'contacts_form_phone_placeholder',
			'type'          => 'text',
			'default_value' => '+375 XX XXX-XX-XX',
		),
		array(
			'key'           => 'field_contacts_form_comment_placeholder',
			'label'         => 'Форма: плейсхолдер комментария',
			'name'          => 'contacts_form_comment_placeholder',
			'type'          => 'text',
			'default_value' => 'Опишите, какая упаковка вам нужна...',
		),
		array(
			'key'           => 'field_contacts_form_checkbox_text',
			'label'         => 'Форма: текст чекбокса',
			'name'          => 'contacts_form_checkbox_text',
			'type'          => 'text',
			'default_value' => 'Я согласен (на) на обработку персональных данных',
		),
		array(
			'key'           => 'field_contacts_form_button_text',
			'label'         => 'Форма: текст кнопки',
			'name'          => 'contacts_form_button_text',
			'type'          => 'text',
			'default_value' => 'Отправить заявку',
		),
		array(
			'key'           => 'field_contacts_requisites_title',
			'label'         => 'Реквизиты: заголовок',
			'name'          => 'contacts_requisites_title',
			'type'          => 'text',
			'default_value' => 'Реквизиты',
		),
		array(
			'key'           => 'field_contacts_requisites_text',
			'label'         => 'Реквизиты: текст',
			'name'          => 'contacts_requisites_text',
			'type'          => 'textarea',
			'rows'          => 12,
			'default_value' => 'ООО "Джордж Эйджи"
УНП: 690663385
Счет: BY58PJCB30120683671000000933
ОАО "Приорбанк"
БИК: PJCVBY2X
Юридический адрес: 220062 Республика Беларусь, г.Минск, ул Ржавецкая, д.5. пом.158/2
Директор: Жуковская Полина Константиновна действующая на основании Устава',
		),
		array(
	'key'           => 'field_contacts_requisites_image',
		'label'         => 'Реквизиты: изображение',
		'name'          => 'contacts_requisites_image',
		'type'          => 'image',
		'return_format' => 'url',
		'library'       => 'all',
	),
),
'location'   => array(
	array(
		array(
			'param'    => 'page_template',
			'operator' => '==',
			'value'    => 'contacts.php',
		),
	),
),
'menu_order' => 3,
'position'   => 'normal',
) );

// ============================================
// ГРУППА: ГЛАВНАЯ ВЫСТАВКА — ОПИСАНИЕ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_exhibition_about',
	'title'    => 'Выставка: Описание',
	'fields'   => array(
		array(
			'key'           => 'field_exhibition_about_title',
			'label'         => 'Заголовок',
			'name'          => 'exhibition_about_title',
			'type'          => 'text',
			'default_value' => 'Экспозиция о памяти, детстве и вещах, которые узнаются с первого взгляда',
		),
		array(
			'key'           => 'field_exhibition_about_description',
			'label'         => 'Описание 1',
			'name'          => 'exhibition_about_description',
			'type'          => 'textarea',
			'rows'          => 4,
			'default_value' => 'Эта экспозиция — не просто место для осмотра предметов, а пространство личной памяти. Проект «СССР: Сокровища счастливого советского ребёнка» — это возможность не просто увидеть прошлое, но и прожить его через визуальные и эмоциональные детали.',
		),
		array(
			'key'           => 'field_exhibition_about_description_2',
			'label'         => 'Описание 2',
			'name'          => 'exhibition_about_description_2',
			'type'          => 'textarea',
			'rows'          => 4,
			'default_value' => 'Здесь собраны игрушки, книги, элементы повседневного быта, визуальные детали и знакомые вещи, которые вызывают воспоминания, тёплую ностальгию и желание рассказать о них снова.',
		),
		array(
			'key'           => 'field_exhibition_about_description_3',
			'label'         => 'Описание 3',
			'name'          => 'exhibition_about_description_3',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Пространство экспозиции помогает не только вспомнить прошлое, но и увидеть его как часть культурной памяти.',
		),
		array(
			'key'           => 'field_exhibition_about_image',
			'label'         => 'Изображение',
			'name'          => 'exhibition_about_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'exhibition.php',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ГЛАВНАЯ ВЫСТАВКА — ЧТО МОЖНО УВИДЕТЬ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_exhibition_what_to_see',
	'title'    => 'Выставка: Что можно увидеть',
	'fields'   => array(
		array(
			'key'           => 'field_exhibition_what_to_see_title',
			'label'         => 'Заголовок',
			'name'          => 'exhibition_what_to_see_title',
			'type'          => 'text',
			'default_value' => 'Что можно увидеть в экспозиции',
		),
		array(
			'key'          => 'exhibition_what_to_see_items',
			'label'        => 'Элементы',
			'name'         => 'exhibition_what_to_see_items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить элемент',
			'max'          => 4,
			'sub_fields'   => array(
				array(
					'key'           => 'field_exhibition_what_to_see_image',
					'label'         => 'Изображение',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_exhibition_what_to_see_item_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Советские игрушки',
				),
				array(
					'key'          => 'field_exhibition_what_to_see_item_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 3,
					'default_value' => 'Куклы, машинки, конструкторы и игрушки, которые были частью детства нескольких поколений.',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'exhibition.php',
			),
		),
	),
	'menu_order' => 2,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ГЛАВНАЯ ВЫСТАВКА — ПОЧЕМУ СЮДА ХОЧЕТСЯ ПРИЙТИ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_exhibition_why',
	'title'    => 'Выставка: Почему сюда хочется прийти',
	'fields'   => array(
		array(
			'key'           => 'field_exhibition_why_title',
			'label'         => 'Заголовок',
			'name'          => 'exhibition_why_title',
			'type'          => 'text',
			'default_value' => 'Почему сюда хочется прийти',
		),
		array(
			'key'           => 'field_exhibition_why_description',
			'label'         => 'Описание',
			'name'          => 'exhibition_why_description',
			'type'          => 'textarea',
			'rows'          => 6,
			'default_value' => 'Эта экспозиция работает не только как музейный раздел, но и как личный эмоциональный опыт. Для одних посетителей она становится поводом вспомнить своё детство, для других — возможностью увидеть предметный мир прошлого впервые. Именно поэтому пространство экспозиции построено как историко-культурный проект, семейный повод для посещения и целый маршрут по памяти.',
		),
		array(
			'key'           => 'field_exhibition_why_image',
			'label'         => 'Изображение',
			'name'          => 'exhibition_why_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'exhibition.php',
			),
		),
	),
	'menu_order' => 3,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ГЛАВНАЯ ВЫСТАВКА — ПРАКТИЧЕСКАЯ ИНФОРМАЦИЯ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_exhibition_practical',
	'title'    => 'Выставка: Практическая информация',
	'fields'   => array(
		array(
			'key'           => 'field_exhibition_practical_title',
			'label'         => 'Заголовок',
			'name'          => 'exhibition_practical_title',
			'type'          => 'text',
			'default_value' => 'Практическая информация',
		),
		array(
			'key'           => 'field_exhibition_practical_format',
			'label'         => 'Формат',
			'name'          => 'exhibition_practical_format',
			'type'          => 'text',
			'default_value' => 'Постоянная экспозиция',
		),
		array(
			'key'           => 'field_exhibition_practical_access',
			'label'         => 'Доступ',
			'name'          => 'exhibition_practical_access',
			'type'          => 'text',
			'default_value' => 'по входному билету',
		),
		array(
			'key'           => 'field_exhibition_practical_location',
			'label'         => 'Место',
			'name'          => 'exhibition_practical_location',
			'type'          => 'text',
			'default_value' => 'музей Naif Arts',
		),
		array(
			'key'           => 'field_exhibition_practical_additional',
			'label'         => 'Дополнительно',
			'name'          => 'exhibition_practical_additional',
			'type'          => 'text',
			'default_value' => 'можно совмещать с другими выставками и событиями музея',
		),
		array(
			'key'           => 'field_exhibition_practical_audience',
			'label'         => 'Подходит для',
			'name'          => 'exhibition_practical_audience',
			'type'          => 'text',
			'default_value' => 'индивидуального и семейного посещения',
		),
		array(
			'key'           => 'field_exhibition_practical_price',
			'label'         => 'Стоимость',
			'name'          => 'exhibition_practical_price',
			'type'          => 'text',
			'default_value' => '00 BYN',
		),
		array(
			'key'           => 'field_exhibition_practical_button_text',
			'label'         => 'Текст кнопки',
			'name'          => 'exhibition_practical_button_text',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'exhibition.php',
			),
		),
	),
	'menu_order' => 4,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ГЛАВНАЯ ВЫСТАВКА — АБОНЕМЕНТЫ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_exhibition_subscriptions',
	'title'    => 'Выставка: Абонементы',
	'fields'   => array(
		array(
			'key'           => 'field_exhibition_subscriptions_title',
			'label'         => 'Заголовок',
			'name'          => 'exhibition_subscriptions_title',
			'type'          => 'text',
			'default_value' => 'Абонементы и регулярные форматы',
		),
		array(
			'key'          => 'exhibition_subscriptions_items',
			'label'        => 'Абонементы',
			'name'         => 'exhibition_subscriptions_items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить абонемент',
			'max'          => 3,
			'sub_fields'   => array(
				array(
					'key'           => 'field_exhibition_subscription_image',
					'label'         => 'Изображение',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_exhibition_subscription_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Абонемент в музей',
				),
				array(
					'key'          => 'field_exhibition_subscription_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 3,
					'default_value' => 'Свободное посещение постоянных выставок и временных экспозиций в течение выбранного периода.',
				),
				array(
					'key'          => 'field_exhibition_subscription_includes_title',
					'label'        => 'Заголовок "Что входит"',
					'name'         => 'includes_title',
					'type'         => 'text',
					'default_value' => 'Что входит',
				),
				array(
					'key'          => 'field_exhibition_subscription_includes_items',
					'label'        => 'Что входит (через запятую)',
					'name'         => 'includes_items',
					'type'         => 'textarea',
					'rows'         => 3,
					'default_value' => "посещение музея\ndоступ к постоянной экспозиции\ndоступ к временным выставкам",
				),
				array(
					'key'          => 'field_exhibition_subscription_price',
					'label'        => 'Цена',
					'name'         => 'price',
					'type'         => 'text',
					'default_value' => 'от 00 BYN',
				),
				array(
					'key'          => 'field_exhibition_subscription_button_text',
					'label'        => 'Текст кнопки',
					'name'         => 'button_text',
					'type'         => 'text',
					'default_value' => 'Подробнее',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'exhibition.php',
			),
		),
	),
	'menu_order' => 5,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ГЛАВНАЯ ВЫСТАВКА — CTA
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_exhibition_cta',
	'title'    => 'Выставка: CTA-секция',
	'fields'   => array(
		array(
			'key'           => 'field_exhibition_cta_background_image',
			'label'         => 'Фон изображение (десктоп)',
			'name'          => 'exhibition_cta_background_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_exhibition_cta_background_image_mobile',
			'label'         => 'Фон изображение (мобильная)',
			'name'          => 'exhibition_cta_background_image_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_exhibition_cta_title',
			'label'         => 'Заголовок',
			'name'          => 'exhibition_cta_title',
			'type'          => 'text',
			'default_value' => 'Приходите увидеть экспозицию, которая возвращает в память детства',
		),
		array(
			'key'           => 'field_exhibition_cta_primary',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'exhibition_cta_primary',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_exhibition_cta_secondary',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'exhibition_cta_secondary',
			'type'          => 'text',
			'default_value' => 'Посмотреть афишу',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'exhibition.php',
			),
		),
	),
	'menu_order' => 6,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ВЫСТАВКИ — HERO
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_vystavki_hero',
	'title'    => 'Выставки: Hero',
	'fields'   => array(
		array(
			'key'           => 'field_vystavki_hero_title',
			'label'         => 'Заголовок',
			'name'          => 'vystavki_hero_title',
			'type'          => 'text',
			'default_value' => 'Выставки музея',
		),
		array(
			'key'           => 'field_vystavki_hero_description',
			'label'         => 'Описание',
			'name'          => 'vystavki_hero_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Постоянные и временные экспозиции, через которые раскрывается мир наивного искусства, память, дети и живое художественное высказывание.',
		),
		array(
			'key'           => 'field_vystavki_hero_image',
			'label'         => 'Фоновое изображение',
			'name'          => 'vystavki_hero_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_vystavki_hero_cta_primary_text',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'vystavki_hero_cta_primary_text',
			'type'          => 'text',
			'default_value' => 'Смотреть текущие выставки',
		),
		array(
			'key'           => 'field_vystavki_hero_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'vystavki_hero_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_vystavki_hero_cta_secondary_text',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'vystavki_hero_cta_secondary_text',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_vystavki_hero_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'vystavki_hero_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'vystavki.php',
			),
		),
	),
	'menu_order' => 0,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ВЫСТАВКИ — ФИЛЬТРЫ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_vystavki_filters',
	'title'    => 'Выставки: Фильтры',
	'fields'   => array(
		array(
			'key'          => 'field_vystavki_filters',
			'label'        => 'Категории фильтров',
			'name'         => 'vystavki_filters',
			'type'         => 'repeater',
			'layout'       => 'table',
			'button_label' => 'Добавить фильтр',
			'sub_fields'   => array(
				array(
					'key'          => 'field_vystavki_filter_label',
					'label'        => 'Название',
					'name'         => 'label',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_vystavki_filter_slug',
					'label'        => 'Slug',
					'name'         => 'slug',
					'type'         => 'text',
					'instructions' => 'Идентификатор для JS-фильтрации (латиницей)',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'vystavki.php',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ВЫСТАВКИ — СПИСОК ВЫСТАВОК
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_vystavki_list',
	'title'    => 'Выставки: Список выставок',
	'fields'   => array(
		array(
			'key'          => 'field_vystavki_list',
			'label'        => 'Выставки',
			'name'         => 'vystavki_list',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить выставку',
			'sub_fields'   => array(
				array(
					'key'          => 'field_vystavki_item_category',
					'label'        => 'Категория',
					'name'         => 'category',
					'type'         => 'select',
					'choices'      => array(
						'permanent'  => 'Постоянная экспозиция',
						'temporary'  => 'Временные выставки',
						'accompanying' => 'Сопутствующие',
					),
					'default_value' => 'permanent',
				),
				array(
					'key'          => 'field_vystavki_item_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_vystavki_item_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 3,
				),
				array(
					'key'           => 'field_vystavki_item_image',
					'label'         => 'Изображение',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_vystavki_item_button_text',
					'label'        => 'Текст кнопки',
					'name'         => 'button_text',
					'type'         => 'text',
					'default_value' => 'Подробнее',
				),
				array(
					'key'          => 'field_vystavki_item_button_url',
					'label'        => 'Ссылка кнопки',
					'name'         => 'button_url',
					'type'         => 'url',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'vystavki.php',
			),
		),
	),
	'menu_order' => 3,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ВЫСТАВКИ — КАК УСТРОЕНЫ ВЫСТАВКИ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_vystavki_how',
	'title'    => 'Выставки: Как устроены выставки',
	'fields'   => array(
		array(
			'key'           => 'field_vystavki_how_title',
			'label'         => 'Заголовок',
			'name'          => 'vystavki_how_title',
			'type'          => 'text',
			'default_value' => 'Как устроены выставки музея',
		),
		array(
			'key'           => 'field_vystavki_how_description',
			'label'         => 'Описание',
			'name'          => 'vystavki_how_description',
			'type'          => 'textarea',
			'rows'          => 6,
			'default_value' => 'Выставочная программа музея построена так, чтобы посетитель мог увидеть наивное искусство в разных форматах и контекстах. Постоянные экспозиции знакомят с основными темами и авторами, временные выставки помогают по-новому взглянуть на темы и сюжеты, а специальные и кураторские проекты рассказывают музей как живое культурное пространство.',
		),
		array(
			'key'          => 'field_vystavki_how_items',
			'label'        => 'Карточки',
			'name'         => 'vystavki_how_items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить карточку',
			'max'          => 3,
			'sub_fields'   => array(
				array(
					'key'           => 'field_vystavki_how_item_icon',
					'label'         => 'Иконка',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'          => 'field_vystavki_how_item_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_vystavki_how_item_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 4,
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'vystavki.php',
			),
		),
	),
	'menu_order' => 4,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ВЫСТАВКИ — АБОНЕМЕНТЫ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_vystavki_subscriptions',
	'title'    => 'Выставки: Абонементы',
	'fields'   => array(
		array(
			'key'           => 'field_vystavki_subscriptions_title',
			'label'         => 'Заголовок',
			'name'          => 'vystavki_subscriptions_title',
			'type'          => 'text',
			'default_value' => 'Абонементы и регулярные форматы',
		),
		array(
			'key'          => 'field_vystavki_subscriptions_items',
			'label'        => 'Абонементы',
			'name'         => 'vystavki_subscriptions_items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить абонемент',
			'max'          => 3,
			'sub_fields'   => array(
				array(
					'key'           => 'field_vystavki_sub_item_image',
					'label'         => 'Изображение',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_vystavki_sub_item_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_vystavki_sub_item_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 3,
				),
				array(
					'key'          => 'field_vystavki_sub_item_includes_title',
					'label'        => 'Заголовок "Что входит"',
					'name'         => 'includes_title',
					'type'         => 'text',
					'default_value' => 'Что входит',
				),
				array(
					'key'          => 'field_vystavki_sub_item_includes_items',
					'label'        => 'Что входит',
					'name'         => 'includes_items',
					'type'         => 'textarea',
					'rows'         => 4,
				),
				array(
					'key'          => 'field_vystavki_sub_item_price',
					'label'        => 'Цена',
					'name'         => 'price',
					'type'         => 'text',
					'default_value' => 'от 00 BYN',
				),
				array(
					'key'          => 'field_vystavki_sub_item_button_text',
					'label'        => 'Текст кнопки',
					'name'         => 'button_text',
					'type'         => 'text',
					'default_value' => 'Подробнее',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'vystavki.php',
			),
		),
	),
	'menu_order' => 5,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ВЫСТАВКИ — CTA
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_vystavki_cta',
	'title'    => 'Выставки: CTA-секция',
	'fields'   => array(
		array(
			'key'           => 'field_vystavki_cta_background_image',
			'label'         => 'Фон изображение (десктоп)',
			'name'          => 'vystavki_cta_background_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_vystavki_cta_background_image_mobile',
			'label'         => 'Фон изображение (мобильная)',
			'name'          => 'vystavki_cta_background_image_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_vystavki_cta_title',
			'label'         => 'Заголовок',
			'name'          => 'vystavki_cta_title',
			'type'          => 'text',
			'default_value' => 'Выберите выставку и приходите в музей',
		),
		array(
			'key'           => 'field_vystavki_cta_primary',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'vystavki_cta_primary',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_vystavki_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'vystavki_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_vystavki_cta_secondary',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'vystavki_cta_secondary',
			'type'          => 'text',
			'default_value' => 'Посмотреть афишу',
		),
		array(
			'key'           => 'field_vystavki_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'vystavki_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'vystavki.php',
			),
		),
	),
	'menu_order' => 6,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ТИПОВАЯ ВЫСТАВКА — HERO
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sv_hero',
	'title'    => 'Типовая выставка: Hero',
	'fields'   => array(
		array(
			'key'           => 'field_sv_hero_badge',
			'label'         => 'Метка (категория)',
			'name'          => 'sv_hero_badge',
			'type'          => 'text',
			'default_value' => 'Временная выставка',
		),
		array(
			'key'           => 'field_sv_hero_dates',
			'label'         => 'Даты',
			'name'          => 'sv_hero_dates',
			'type'          => 'text',
			'default_value' => '12 апреля–12 июня',
		),
		array(
			'key'           => 'field_sv_hero_description',
			'label'         => 'Описание',
			'name'          => 'sv_hero_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Выставочный проект о цвете, личных сюжетах и радости наивного художественного высказывания.',
		),
		array(
			'key'           => 'field_sv_hero_image',
			'label'         => 'Изображение',
			'name'          => 'sv_hero_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sv_hero_cta_primary_text',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'sv_hero_cta_primary_text',
			'type'          => 'text',
			'default_value' => 'Смотреть афишу',
		),
		array(
			'key'           => 'field_sv_hero_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'sv_hero_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_sv_hero_cta_secondary_text',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'sv_hero_cta_secondary_text',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_sv_hero_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'sv_hero_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'vystavka',
			),
		),
	),
	'menu_order' => 0,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ТИПОВАЯ ВЫСТАВКА — О ВЫСТАВКЕ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sv_about',
	'title'    => 'Типовая выставка: О выставке',
	'fields'   => array(
		array(
			'key'           => 'field_sv_about_title',
			'label'         => 'Заголовок',
			'name'          => 'sv_about_title',
			'type'          => 'text',
			'default_value' => 'О выставке',
		),
		array(
			'key'           => 'field_sv_about_description',
			'label'         => 'Описание',
			'name'          => 'sv_about_description',
			'type'          => 'textarea',
			'rows'          => 6,
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'vystavka',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ТИПОВАЯ ВЫСТАВКА — ЧТО МОЖНО УВИДЕТЬ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sv_what_to_see',
	'title'    => 'Типовая выставка: Что можно увидеть',
	'fields'   => array(
		array(
			'key'           => 'field_sv_what_to_see_title',
			'label'         => 'Заголовок',
			'name'          => 'sv_what_to_see_title',
			'type'          => 'text',
			'default_value' => 'Что можно увидеть в экспозиции',
		),
		array(
			'key'          => 'sv_what_to_see_items',
			'label'        => 'Элементы',
			'name'         => 'sv_what_to_see_items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить элемент',
			'max'          => 4,
			'sub_fields'   => array(
				array(
					'key'           => 'field_sv_what_to_see_image',
					'label'         => 'Изображение',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_sv_what_to_see_item_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_sv_what_to_see_item_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 3,
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'vystavka',
			),
		),
	),
	'menu_order' => 2,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ТИПОВАЯ ВЫСТАВКА — ПОЧЕМУ ВАЖНА + ПРАКТИКА
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sv_why',
	'title'    => 'Типовая выставка: Почему важна',
	'fields'   => array(
		array(
			'key'           => 'field_sv_why_title',
			'label'         => 'Заголовок',
			'name'          => 'sv_why_title',
			'type'          => 'text',
			'default_value' => 'Почему эта выставка важна',
		),
		array(
			'key'           => 'field_sv_why_description',
			'label'         => 'Описание',
			'name'          => 'sv_why_description',
			'type'          => 'textarea',
			'rows'          => 5,
		),
		array(
			'key'           => 'field_sv_why_image',
			'label'         => 'Изображение',
			'name'          => 'sv_why_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sv_practical_title',
			'label'         => 'Практическая информация: заголовок',
			'name'          => 'sv_practical_title',
			'type'          => 'text',
			'default_value' => 'Практическая информация',
		),
		array(
			'key'           => 'field_sv_practical_format',
			'label'         => 'Формат',
			'name'          => 'sv_practical_format',
			'type'          => 'text',
			'default_value' => 'времренная выставка',
		),
		array(
			'key'           => 'field_sv_practical_dates',
			'label'         => 'Даты',
			'name'          => 'sv_practical_dates',
			'type'          => 'text',
			'default_value' => '15 июня — 20 августа',
		),
		array(
			'key'           => 'field_sv_practical_location',
			'label'         => 'Место',
			'name'          => 'sv_practical_location',
			'type'          => 'text',
			'default_value' => 'Музей Naif Arts',
		),
		array(
			'key'           => 'field_sv_practical_audience',
			'label'         => 'Подходит для',
			'name'          => 'sv_practical_audience',
			'type'          => 'text',
			'default_value' => 'самостоятельно или с экскурсоводом',
		),
		array(
			'key'           => 'field_sv_practical_for_whom',
			'label'         => 'Для кого',
			'name'          => 'sv_practical_for_whom',
			'type'          => 'text',
			'default_value' => 'индивидуального и семейного посещения',
		),
		array(
			'key'           => 'field_sv_practical_access',
			'label'         => 'Доступ',
			'name'          => 'sv_practical_access',
			'type'          => 'text',
			'default_value' => 'по входному билету',
		),
		array(
			'key'           => 'field_sv_practical_button_text',
			'label'         => 'Текст кнопки',
			'name'          => 'sv_practical_button_text',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'vystavka',
			),
		),
	),
	'menu_order' => 3,
	'position'   => 'normal',
) );



// ============================================
// ГРУППА: ТИПОВАЯ ВЫСТАВКА — CTA
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_sv_cta',
	'title'    => 'Типовая выставка: CTA',
	'fields'   => array(
		array(
			'key'           => 'field_sv_cta_background_image',
			'label'         => 'Фон изображение (десктоп)',
			'name'          => 'sv_cta_background_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sv_cta_background_image_mobile',
			'label'         => 'Фон изображение (мобильная)',
			'name'          => 'sv_cta_background_image_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_sv_cta_title',
			'label'         => 'Заголовок',
			'name'          => 'sv_cta_title',
			'type'          => 'text',
			'default_value' => 'Выберите выставку и приходите в музей',
		),
		array(
			'key'           => 'field_sv_cta_primary',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'sv_cta_primary',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_sv_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'sv_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_sv_cta_secondary',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'sv_cta_secondary',
			'type'          => 'text',
			'default_value' => 'Посмотреть афишу',
		),
		array(
			'key'           => 'field_sv_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'sv_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'vystavka',
			),
		),
	),
	'menu_order' => 4,
	'position'   => 'normal',
) );


// ============================================
// ГРУППА: АФИША — HERO
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_afisha_hero',
	'title'    => 'Афиша: Hero',
	'fields'   => array(
		array(
			'key'           => 'field_afisha_hero_title',
			'label'         => 'Заголовок',
			'name'          => 'afisha_hero_title',
			'type'          => 'text',
			'default_value' => 'Афиша музея',
		),
		array(
			'key'           => 'field_afisha_hero_description',
			'label'         => 'Описание',
			'name'          => 'afisha_hero_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Мастер-классы, лекции, встречи, показы и специальные события, на которые можно записаться уже сейчас.',
		),
		array(
			'key'           => 'field_afisha_hero_image',
			'label'         => 'Фоновое изображение',
			'name'          => 'afisha_hero_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_afisha_hero_cta_primary_text',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'afisha_hero_cta_primary_text',
			'type'          => 'text',
			'default_value' => 'Ближайшие события',
		),
		array(
			'key'           => 'field_afisha_hero_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'afisha_hero_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_afisha_hero_cta_secondary_text',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'afisha_hero_cta_secondary_text',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_afisha_hero_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'afisha_hero_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'afisha.php',
			),
		),
	),
	'menu_order' => 0,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: АФИША — ГЛАВНОЕ СОБЫТИЕ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_afisha_featured',
	'title'    => 'Афиша: Главное событие',
	'fields'   => array(
		array(
			'key'           => 'field_afisha_featured_image_left',
			'label'         => 'Изображение (левое)',
			'name'          => 'afisha_featured_image_left',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_afisha_featured_image_right',
			'label'         => 'Изображение (правое)',
			'name'          => 'afisha_featured_image_right',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_afisha_featured_type',
			'label'         => 'Тип события',
			'name'          => 'afisha_featured_type',
			'type'          => 'select',
			'choices'       => array(
				'masterclass' => 'Мастер-класс',
				'lecture'     => 'Лекция',
				'meeting'     => 'Встреча',
				'tour'        => 'Экскурсия',
				'movie'       => 'Кинопоказ',
				'for_children'=> 'Для детей',
				'for_adults'  => 'Для взрослых',
				'family'      => 'Семейный',
				'free'        => 'Бесплатные',
			),
		),
		array(
			'key'           => 'field_afisha_featured_type_icon',
			'label'         => 'Иконка типа (опционально)',
			'name'          => 'afisha_featured_type_icon',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
			'instructions'  => 'Заменит стандартную иконку для выбранного типа события',
		),
		array(
			'key'           => 'field_afisha_featured_title',
			'label'         => 'Заголовок',
			'name'          => 'afisha_featured_title',
			'type'          => 'text',
		),
		array(
			'key'           => 'field_afisha_featured_description',
			'label'         => 'Описание',
			'name'          => 'afisha_featured_description',
			'type'          => 'textarea',
			'rows'          => 3,
		),
		array(
			'key'           => 'field_afisha_featured_location',
			'label'         => 'Место',
			'name'          => 'afisha_featured_location',
			'type'          => 'text',
			'default_value' => 'Лекторий музея',
		),
		array(
			'key'           => 'field_afisha_featured_location_icon',
			'label'         => 'Иконка места (опционально)',
			'name'          => 'afisha_featured_location_icon',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
			'instructions'  => 'Заменит стандартную иконку места проведения',
		),
		array(
			'key'           => 'field_afisha_featured_date',
			'label'         => 'Дата',
			'name'          => 'afisha_featured_date',
			'type'          => 'text',
			'instructions'  => 'Например: "23 мая, пт"',
		),
		array(
			'key'           => 'field_afisha_featured_time',
			'label'         => 'Время',
			'name'          => 'afisha_featured_time',
			'type'          => 'text',
			'instructions'  => 'Например: "18:00"',
		),
		array(
			'key'           => 'field_afisha_featured_button_detail_text',
			'label'         => 'Кнопка "Подробнее" (текст)',
			'name'          => 'afisha_featured_button_detail_text',
			'type'          => 'text',
			'default_value' => 'Подробнее',
		),
		array(
			'key'           => 'field_afisha_featured_button_detail_url',
			'label'         => 'Кнопка "Подробнее" (ссылка)',
			'name'          => 'afisha_featured_button_detail_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_afisha_featured_button_buy_text',
			'label'         => 'Кнопка "Купить билет" (текст)',
			'name'          => 'afisha_featured_button_buy_text',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_afisha_featured_button_buy_url',
			'label'         => 'Кнопка "Купить билет" (ссылка)',
			'name'          => 'afisha_featured_button_buy_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'afisha.php',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: АФИША — CTA
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_afisha_cta',
	'title'    => 'Афиша: CTA',
	'fields'   => array(
		array(
			'key'           => 'field_afisha_cta_background_image',
			'label'         => 'Фон изображение (десктоп)',
			'name'          => 'afisha_cta_background_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_afisha_cta_background_image_mobile',
			'label'         => 'Фон изображение (мобильная)',
			'name'          => 'afisha_cta_background_image_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_afisha_cta_title',
			'label'         => 'Заголовок',
			'name'          => 'afisha_cta_title',
			'type'          => 'text',
			'default_value' => 'Выберите событие и приходите в музей',
		),
		array(
			'key'           => 'field_afisha_cta_primary',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'afisha_cta_primary',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_afisha_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'afisha_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_afisha_cta_secondary',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'afisha_cta_secondary',
			'type'          => 'text',
			'default_value' => 'Посмотреть афишу',
		),
		array(
			'key'           => 'field_afisha_cta_secondary_url',
	'label'         => 'Вторичная кнопка (ссылка)',
		'name'          => 'afisha_cta_secondary_url',
		'type'          => 'url',
	),
	),
	'location'   => array(
	array(
		array(
			'param'    => 'page_template',
			'operator' => '==',
			'value'    => 'afisha.php',
		),
	),
	),
	'menu_order' => 2,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: МАСТЕР-КЛАССЫ — HERO
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_mk_hero',
	'title'    => 'Мастер-классы: Hero',
	'fields'   => array(
		array(
			'key'           => 'field_mk_hero_title',
			'label'         => 'Заголовок',
			'name'          => 'mk_hero_title',
			'type'          => 'text',
			'default_value' => 'Мастер-классы музея',
		),
		array(
			'key'           => 'field_mk_hero_description',
			'label'         => 'Описание',
			'name'          => 'mk_hero_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Практические занятия по наивной живописи, декоративным техникам и творческим форматам для детей и взрослых.',
		),
		array(
			'key'           => 'field_mk_hero_image',
			'label'         => 'Фоновое изображение',
			'name'          => 'mk_hero_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_mk_hero_cta_primary_text',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'mk_hero_cta_primary_text',
			'type'          => 'text',
			'default_value' => 'Ближайшие события',
		),
		array(
			'key'           => 'field_mk_hero_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'mk_hero_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_mk_hero_cta_secondary_text',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'mk_hero_cta_secondary_text',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_mk_hero_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'mk_hero_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'master-klassy.php',
			),
		),
	),
	'menu_order' => 0,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: МАСТЕР-КЛАССЫ — ФИЛЬТРЫ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_mk_filters',
	'title'    => 'Мастер-классы: Фильтры',
	'fields'   => array(
		array(
			'key'          => 'field_mk_filters',
			'label'        => 'Категории фильтров',
			'name'         => 'mk_filters',
			'type'         => 'repeater',
			'layout'       => 'table',
			'button_label' => 'Добавить фильтр',
			'sub_fields'   => array(
				array(
					'key'          => 'field_mk_filter_label',
					'label'        => 'Название',
					'name'         => 'label',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_mk_filter_slug',
					'label'        => 'Slug',
					'name'         => 'slug',
					'type'         => 'text',
					'instructions' => 'Идентификатор для JS-фильтрации (латиницей)',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'master-klassy.php',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: МАСТЕР-КЛАССЫ — ГЛАВНЫЙ МАСТЕР-КЛАСС
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_mk_featured',
	'title'    => 'Мастер-классы: Главный мастер-класс',
	'fields'   => array(
		array(
			'key'          => 'field_mk_featured_title',
			'label'        => 'Заголовок',
			'name'         => 'mk_featured_title',
			'type'         => 'text',
			'default_value' => 'Живопись акрилом: весенний пейзаж',
		),
		array(
			'key'          => 'field_mk_featured_description',
			'label'        => 'Описание',
			'name'         => 'mk_featured_description',
			'type'         => 'textarea',
			'rows'         => 3,
			'default_value' => 'Пишем яркий пейзаж под руководством преподавателя. Для взрослых и подростков.',
		),
		array(
			'key'           => 'field_mk_featured_image',
			'label'         => 'Изображение',
			'name'          => 'mk_featured_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'          => 'field_mk_featured_date',
			'label'        => 'Дата',
			'name'         => 'mk_featured_date',
			'type'         => 'text',
			'default_value' => '23 мая, пт',
		),
		array(
			'key'          => 'field_mk_featured_time',
			'label'        => 'Время',
			'name'         => 'mk_featured_time',
			'type'         => 'text',
			'default_value' => '18:30',
		),
		array(
			'key'          => 'field_mk_featured_audience',
			'label'        => 'Аудитория',
			'name'         => 'mk_featured_audience',
			'type'         => 'text',
			'default_value' => 'Для взрослых',
		),
		array(
			'key'          => 'field_mk_featured_materials',
			'label'        => 'Материалы',
			'name'         => 'mk_featured_materials',
			'type'         => 'text',
			'default_value' => 'Материалы включены',
			'instructions' => 'Текст рядом с иконкой палитры. Оставьте пустым, чтобы скрыть.',
		),
		array(
			'key'          => 'field_mk_featured_button_detail_text',
			'label'        => 'Кнопка "Подробнее" (текст)',
			'name'         => 'mk_featured_button_detail_text',
			'type'         => 'text',
			'default_value' => 'Подробнее',
		),
		array(
			'key'          => 'field_mk_featured_button_detail_url',
			'label'        => 'Кнопка "Подробнее" (ссылка)',
			'name'         => 'mk_featured_button_detail_url',
			'type'         => 'url',
		),
		array(
			'key'          => 'field_mk_featured_button_buy_text',
			'label'        => 'Кнопка "Купить билет" (текст)',
			'name'         => 'mk_featured_button_buy_text',
			'type'         => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'          => 'field_mk_featured_button_buy_url',
			'label'        => 'Кнопка "Купить билет" (ссылка)',
			'name'         => 'mk_featured_button_buy_url',
			'type'         => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'master-klassy.php',
			),
		),
	),
	'menu_order' => 2,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: МАСТЕР-КЛАССЫ — ФОРМАТЫ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_mk_formats',
	'title'    => 'Мастер-классы: Форматы',
	'fields'   => array(
		array(
			'key'          => 'field_mk_formats_title',
			'label'        => 'Заголовок секции',
			'name'         => 'mk_formats_title',
			'type'         => 'text',
			'default_value' => 'Форматы мастер-классов',
		),
		array(
			'key'          => 'field_mk_formats',
			'label'        => 'Форматы',
			'name'         => 'mk_formats',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить формат',
			'max'          => 6,
			'sub_fields'   => array(
				array(
					'key'           => 'field_mk_format_icon',
					'label'         => 'Иконка',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'          => 'field_mk_format_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_mk_format_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 3,
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'master-klassy.php',
			),
		),
	),
	'menu_order' => 4,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: МАСТЕР-КЛАССЫ — CTA
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_mk_cta',
	'title'    => 'Мастер-классы: CTA',
	'fields'   => array(
		array(
			'key'           => 'field_mk_cta_background_image',
			'label'         => 'Фон изображение (десктоп)',
			'name'          => 'mk_cta_background_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_mk_cta_background_image_mobile',
			'label'         => 'Фон изображение (мобильная)',
			'name'          => 'mk_cta_background_image_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_mk_cta_title',
			'label'         => 'Заголовок',
			'name'          => 'mk_cta_title',
			'type'          => 'text',
			'default_value' => 'Выберите мастер-класс и приходите творить',
		),
		array(
			'key'           => 'field_mk_cta_primary',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'mk_cta_primary',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_mk_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'mk_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_mk_cta_secondary',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'mk_cta_secondary',
			'type'          => 'text',
			'default_value' => 'Посмотреть афишу',
		),
		array(
			'key'           => 'field_mk_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
		'name'          => 'mk_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
	array(
		array(
			'param'    => 'page_template',
			'operator' => '==',
			'value'    => 'master-klassy.php',
		),
	),
	),
	'menu_order' => 6,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ЛЕКЦИИ — HERO
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_lk_hero',
	'title'    => 'Лекции и встречи: Hero',
	'fields'   => array(
		array(
			'key'           => 'field_lk_hero_title',
			'label'         => 'Заголовок',
			'name'          => 'lk_hero_title',
			'type'          => 'text',
			'default_value' => 'Лекции и встречи',
		),
		array(
			'key'           => 'field_lk_hero_description',
			'label'         => 'Описание',
			'name'          => 'lk_hero_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Экскурсии, лекции, встречи и творческие форматы для тех, кто хочет узнать больше об искусстве и музее.',
		),
		array(
			'key'           => 'field_lk_hero_image',
			'label'         => 'Фоновое изображение',
			'name'          => 'lk_hero_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_lk_hero_cta_primary_text',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'lk_hero_cta_primary_text',
			'type'          => 'text',
			'default_value' => 'Ближайшие события',
		),
		array(
			'key'           => 'field_lk_hero_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'lk_hero_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_lk_hero_cta_secondary_text',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'lk_hero_cta_secondary_text',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_lk_hero_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'lk_hero_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'lekcii.php',
			),
		),
	),
	'menu_order' => 0,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ЛЕКЦИИ — ФИЛЬТРЫ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_lk_filters',
	'title'    => 'Лекции и встречи: Фильтры',
	'fields'   => array(
		array(
			'key'          => 'field_lk_filters',
			'label'        => 'Категории фильтров',
			'name'         => 'lk_filters',
			'type'         => 'repeater',
			'layout'       => 'table',
			'button_label' => 'Добавить фильтр',
			'sub_fields'   => array(
				array(
					'key'          => 'field_lk_filter_label',
					'label'        => 'Название',
					'name'         => 'label',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_lk_filter_slug',
					'label'        => 'Slug',
					'name'         => 'slug',
					'type'         => 'text',
					'instructions' => 'Идентификатор для JS-фильтрации (латиницей)',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'lekcii.php',
			),
		),
	),
	'menu_order' => 1,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ЛЕКЦИИ — ГЛАВНОЕ СОБЫТИЕ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_lk_featured',
	'title'    => 'Лекции и встречи: Главное событие',
	'fields'   => array(
		array(
			'key'          => 'field_lk_featured_title',
			'label'        => 'Заголовок',
			'name'         => 'lk_featured_title',
			'type'         => 'text',
			'default_value' => 'Лекция: Как понимать наивное искусство',
		),
		array(
			'key'          => 'field_lk_featured_description',
			'label'        => 'Описание',
			'name'         => 'lk_featured_description',
			'type'         => 'textarea',
			'rows'         => 3,
			'default_value' => 'Разбираемся в языке, символах и особой искренности наивного искусства.',
		),
		array(
			'key'           => 'field_lk_featured_image',
			'label'         => 'Изображение',
			'name'          => 'lk_featured_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'          => 'field_lk_featured_date',
			'label'        => 'Дата',
			'name'         => 'lk_featured_date',
			'type'         => 'text',
			'default_value' => '25 мая, вт',
		),
		array(
			'key'          => 'field_lk_featured_time',
			'label'        => 'Время',
			'name'         => 'lk_featured_time',
			'type'         => 'text',
			'default_value' => '18:30',
		),
		array(
			'key'          => 'field_lk_featured_location',
			'label'        => 'Место',
			'name'         => 'lk_featured_location',
			'type'         => 'text',
			'default_value' => 'Лекторий музея',
		),
		array(
			'key'          => 'field_lk_featured_button_detail_text',
			'label'        => 'Кнопка "Подробнее" (текст)',
			'name'         => 'lk_featured_button_detail_text',
			'type'         => 'text',
			'default_value' => 'Подробнее',
		),
		array(
			'key'          => 'field_lk_featured_button_detail_url',
			'label'        => 'Кнопка "Подробнее" (ссылка)',
			'name'         => 'lk_featured_button_detail_url',
			'type'         => 'url',
		),
		array(
			'key'          => 'field_lk_featured_button_buy_text',
			'label'        => 'Кнопка "Купить билет" (текст)',
			'name'         => 'lk_featured_button_buy_text',
			'type'         => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'          => 'field_lk_featured_button_buy_url',
			'label'        => 'Кнопка "Купить билет" (ссылка)',
			'name'         => 'lk_featured_button_buy_url',
			'type'         => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'lekcii.php',
			),
		),
	),
	'menu_order' => 2,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ЛЕКЦИИ — СПИСОК СОБЫТИЙ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_lk_events',
	'title'    => 'Лекции и встречи: Список',
	'fields'   => array(
		array(
			'key'          => 'field_lk_events_title',
			'label'        => 'Заголовок секции',
			'name'         => 'lk_events_title',
			'type'         => 'text',
			'default_value' => 'Лекции и встречи',
		),
		array(
			'key'          => 'field_lk_events',
			'label'        => 'События',
			'name'         => 'lk_events',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить событие',
			'sub_fields'   => array(
				array(
					'key'           => 'field_lk_event_image',
					'label'         => 'Изображение',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_lk_event_category',
					'label'        => 'Категория',
					'name'         => 'category',
					'type'         => 'select',
					'choices'      => array(
						'lecture'      => 'Лекция',
						'meeting'      => 'Встреча',
						'tour'         => 'Экскурсия',
						'masterclass'  => 'Мастер-класс',
						'for_children' => 'Для детей',
						'for_adults'   => 'Для взрослых',
						'family'       => 'Семейное',
					),
					'default_value' => 'lecture',
				),
				array(
					'key'          => 'field_lk_event_date',
					'label'        => 'Дата и время',
					'name'         => 'date',
					'type'         => 'text',
					'default_value' => '21 мая, вт · 18:30',
				),
				array(
					'key'          => 'field_lk_event_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_lk_event_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 3,
				),
				array(
					'key'          => 'field_lk_event_audience',
					'label'        => 'Аудитория',
					'name'         => 'audience',
					'type'         => 'select',
					'choices'      => array(
						'for_children' => 'Для детей',
						'for_adults'   => 'Для взрослых',
						'family'       => 'Семейное',
					),
					'default_value' => 'for_adults',
				),
				array(
					'key'           => 'field_lk_event_audience_icon',
					'label'         => 'Иконка аудитории',
					'name'          => 'audience_icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'          => 'field_lk_event_price',
					'label'        => 'Цена',
					'name'         => 'price',
					'type'         => 'text',
					'default_value' => '00 BYN',
				),
				array(
					'key'          => 'field_lk_event_button_text',
					'label'        => 'Текст кнопки',
					'name'         => 'button_text',
					'type'         => 'text',
					'default_value' => 'Подробнее',
				),
				array(
					'key'          => 'field_lk_event_button_url',
					'label'        => 'Ссылка кнопки',
					'name'         => 'button_url',
					'type'         => 'url',
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'lekcii.php',
			),
		),
	),
	'menu_order' => 3,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ЛЕКЦИИ — ФОРМАТЫ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_lk_formats',
	'title'    => 'Лекции и встречи: Форматы',
	'fields'   => array(
		array(
			'key'          => 'field_lk_formats_title',
			'label'        => 'Заголовок секции',
			'name'         => 'lk_formats_title',
			'type'         => 'text',
			'default_value' => 'Форматы лекций',
		),
		array(
			'key'          => 'field_lk_formats',
			'label'        => 'Форматы',
			'name'         => 'lk_formats',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Добавить формат',
			'max'          => 6,
			'sub_fields'   => array(
				array(
					'key'           => 'field_lk_format_icon',
					'label'         => 'Иконка',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'url',
					'library'       => 'all',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'          => 'field_lk_format_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_lk_format_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 3,
				),
			),
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'lekcii.php',
			),
		),
	),
	'menu_order' => 4,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ЛЕКЦИИ — АБОНЕМЕНТЫ
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_lk_subscriptions',
	'title'    => 'Лекции и встречи: Абонементы',
	'fields'   => array(
		array(
			'key'          => 'field_lk_subscriptions_title',
			'label'        => 'Заголовок секции',
			'name'         => 'lk_subscriptions_title',
			'type'         => 'text',
			'default_value' => 'Абонементы и регулярные форматы',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'lekcii.php',
			),
		),
	),
	'menu_order' => 5,
	'position'   => 'normal',
) );

// ============================================
// ГРУППА: ЛЕКЦИИ — CTA
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_lk_cta',
	'title'    => 'Лекции и встречи: CTA',
	'fields'   => array(
		array(
			'key'           => 'field_lk_cta_background_image',
			'label'         => 'Фон изображение (десктоп)',
			'name'          => 'lk_cta_background_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_lk_cta_background_image_mobile',
			'label'         => 'Фон изображение (мобильная)',
			'name'          => 'lk_cta_background_image_mobile',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_lk_cta_title',
			'label'         => 'Заголовок',
			'name'          => 'lk_cta_title',
			'type'          => 'text',
			'default_value' => 'Выберите лекцию и приходите в музей',
		),
		array(
			'key'           => 'field_lk_cta_primary',
			'label'         => 'Основная кнопка (текст)',
			'name'          => 'lk_cta_primary',
			'type'          => 'text',
			'default_value' => 'Купить билет',
		),
		array(
			'key'           => 'field_lk_cta_primary_url',
			'label'         => 'Основная кнопка (ссылка)',
			'name'          => 'lk_cta_primary_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_lk_cta_secondary',
			'label'         => 'Вторичная кнопка (текст)',
			'name'          => 'lk_cta_secondary',
			'type'          => 'text',
			'default_value' => 'Посмотреть афишу',
		),
		array(
			'key'           => 'field_lk_cta_secondary_url',
			'label'         => 'Вторичная кнопка (ссылка)',
			'name'          => 'lk_cta_secondary_url',
			'type'          => 'url',
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'lekcii.php',
			),
		),
	),
	'menu_order' => 6,
	'position'   => 'normal',
) );

/**
 * ACF Field Group: Спасибо за заказ (Thank You page)
 */
acf_add_local_field_group( array(
	'key'      => 'group_thankyou',
	'title'    => 'Страница «Спасибо за заказ»',
	'fields'   => array(
		array(
			'key'           => 'field_thankyou_bg',
			'label'         => 'Фоновое изображение',
			'name'          => 'thankyou_bg',
			'type'          => 'image',
			'return_format' => 'url',
			'preview_size'  => 'medium',
		),
		array(
			'key'          => 'field_thankyou_title',
			'label'        => 'Заголовок',
			'name'         => 'thankyou_title',
			'type'         => 'text',
			'default_value' => 'Спасибо за заказ',
		),
		array(
			'key'          => 'field_thankyou_text',
			'label'        => 'Текст',
			'name'         => 'thankyou_text',
			'type'         => 'textarea',
			'rows'         => 4,
			'default_value' => "Ваш заказ в магазине музея принят. Мы свяжемся с вами после обработки и уточнения деталей получения.\n\nЕсли выбран самовывоз — мы сообщим, когда заказ будет готов.",
		),
	),
	'location'   => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'thankyou.php',
			),
		),
	),
	'menu_order' => 7,
	'position'   => 'normal',
) );
