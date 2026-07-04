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

// ============================================
// ГРУППА: UPCOMING EVENTS (Ближайшие события)
// ============================================
acf_add_local_field_group( array(
	'key'      => 'group_upcoming_events',
	'title'    => 'Upcoming Events: Ближайшие события',
	'fields'   => array(
		array(
			'key'           => 'field_upcoming_title',
			'label'         => 'Заголовок секции',
			'name'          => 'upcoming_title',
			'type'          => 'text',
			'default_value' => 'Ближайшие события',
		),
		array(
			'key'           => 'field_upcoming_link_text',
			'label'         => 'Текст ссылки "Все события"',
			'name'          => 'upcoming_link_text',
			'type'          => 'text',
			'default_value' => 'Смотреть все события',
		),
		array(
			'key'           => 'field_upcoming_events',
			'label'         => 'События (до 4 шт)',
			'name'          => 'upcoming_events',
			'type'          => 'repeater',
			'instructions'  => 'Добавьте события для секции',
			'layout'        => 'block',
			'button_label'  => 'Добавить событие',
			'max'           => 4,
			'sub_fields'    => array(
				array(
					'key'          => 'field_upcoming_event_type',
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
					'key'          => 'field_upcoming_event_datetime',
					'label'        => 'Дата и время',
					'name'         => 'datetime',
					'type'         => 'text',
					'default_value' => '19 мая, вс · 12:00',
				),
				array(
					'key'          => 'field_upcoming_event_title',
					'label'        => 'Заголовок',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Мастер-класс: Рисуем сказочный дом',
				),
				array(
					'key'          => 'field_upcoming_event_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 2,
					'default_value' => 'Создаем яркий домик из красок и фантазий. Для детей от 6 лет.',
				),
				array(
					'key'          => 'field_upcoming_event_image',
					'label'        => 'Изображение',
					'name'         => 'image',
					'type'         => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_upcoming_event_button_text',
					'label'        => 'Текст кнопки',
					'name'         => 'button_text',
					'type'         => 'text',
					'default_value' => 'Записаться',
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
	'menu_order' => -8,
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
			'label'         => 'Изображение',
			'name'          => 'about_hero_image',
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
	'key'      => 'group_about_mission',
	'title'    => 'О музее: Миссия и статистика',
	'fields'   => array(
		array(
			'key'           => 'field_about_mission_title',
			'label'         => 'Заголовок',
			'name'          => 'about_mission_title',
			'type'          => 'text',
			'default_value' => 'Музей, где искусство остаётся искренним',
		),
		array(
			'key'           => 'field_about_mission_description',
			'label'         => 'Описание',
			'name'          => 'about_mission_description',
			'type'          => 'textarea',
			'rows'          => 6,
			'default_value' => 'Naif Arts — музей наивного искусства в Минске. Коллекция насчитывает более 1500 работ художников-самоучек из разных стран. Здесь живут картины, выполненные с любовью и фантазией, без академических правил, но с огромной душой. Музей — это место, где можно увидеть работы профессиональных художников, посетить мастер-классы, лекции, встречи и творческие программы для детей и взрослых.',
		),
		array(
			'key'   => 'field_about_stat_1',
			'label' => 'Статистика 1',
			'type'  => 'group',
			'fields' => array(
				array(
					'key'           => 'field_about_stat_1_number',
					'label'         => 'Число',
					'name'          => 'about_stat_1_number',
					'type'          => 'text',
					'default_value' => '1500+',
				),
				array(
					'key'           => 'field_about_stat_1_label',
					'label'         => 'Подпись',
					'name'          => 'about_stat_1_label',
					'type'          => 'text',
					'default_value' => 'картин художников-самоучек',
				),
			),
		),
		array(
			'key'   => 'field_about_stat_2',
			'label' => 'Статистика 2',
			'type'  => 'group',
			'fields' => array(
				array(
					'key'           => 'field_about_stat_2_number',
					'label'         => 'Число',
					'name'          => 'about_stat_2_number',
					'type'          => 'text',
					'default_value' => '9',
				),
				array(
					'key'           => 'field_about_stat_2_label',
					'label'         => 'Подпись',
					'name'          => 'about_stat_2_label',
					'type'          => 'text',
					'default_value' => 'направлений',
				),
			),
		),
		array(
			'key'   => 'field_about_stat_3',
			'label' => 'Статистика 3',
			'type'  => 'group',
			'fields' => array(
				array(
					'key'           => 'field_about_stat_3_number',
					'label'         => 'Число',
					'name'          => 'about_stat_3_number',
					'type'          => 'text',
					'default_value' => 'Первый',
				),
				array(
					'key'           => 'field_about_stat_3_label',
					'label'         => 'Подпись',
					'name'          => 'about_stat_3_label',
					'type'          => 'text',
					'default_value' => 'в Минске',
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
	'key'      => 'group_about_special',
	'title'    => 'О музее: Спец. экспозиция',
	'fields'   => array(
		array(
			'key'     => 'field_about_special_badge',
			'label'   => 'Бейдж',
			'name'    => 'about_special_badge',
			'type'    => 'text',
			'default_value' => 'Постоянная экспозиция',
		),
		array(
			'key'           => 'field_about_special_title',
			'label'         => 'Заголовок',
			'name'          => 'about_special_title',
			'type'          => 'text',
			'default_value' => 'СССР: Сокровища счастливого советского ребенка',
		),
		array(
			'key'           => 'field_about_special_description',
			'label'         => 'Описание',
			'name'          => 'about_special_description',
			'type'          => 'textarea',
			'rows'          => 4,
			'default_value' => 'Обычный посетитель музея, посвященный детским игрушкам, книгам и утвари. Погрузитесь в атмосферу детства!',
		),
		array(
			'key'           => 'field_about_special_image',
			'label'         => 'Изображение',
			'name'          => 'about_special_image',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_about_special_button_text',
			'label'         => 'Текст кнопки',
			'name'          => 'about_special_button_text',
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
	'menu_order' => 4,
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
