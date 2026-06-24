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
	'menu_order' => -9,
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
			'key'           => 'field_upcoming_link_url',
			'label'         => 'Ссылка "Все события"',
			'name'          => 'upcoming_link_url',
			'type'          => 'url',
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
			'key'           => 'field_expositions_link_url',
			'label'         => 'Ссылка',
			'name'          => 'expositions_link_url',
			'type'          => 'url',
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
		array(
			'key'           => 'field_special_button_link',
			'label'         => 'Ссылка кнопки',
			'name'          => 'special_button_link',
			'type'          => 'url',
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
			'key'           => 'field_classes_link_url',
			'label'         => 'Ссылка',
			'name'          => 'classes_link_url',
			'type'          => 'url',
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
		array(
			'key'           => 'field_shop_link_url',
			'label'         => 'Ссылка',
			'name'          => 'shop_link_url',
			'type'          => 'url',
		),
		array(
			'key'           => 'field_shop_products',
			'label'         => 'Товары (до 4 шт)',
			'name'          => 'shop_products',
			'type'          => 'repeater',
			'layout'        => 'block',
			'button_label'  => 'Добавить товар',
			'max'           => 4,
			'sub_fields'    => array(
				array(
					'key'          => 'field_shop_product_title',
					'label'        => 'Название',
					'name'         => 'title',
					'type'         => 'text',
					'default_value' => 'Каталоги выставки',
				),
				array(
					'key'          => 'field_shop_product_description',
					'label'        => 'Описание',
					'name'         => 'description',
					'type'         => 'textarea',
					'rows'         => 2,
					'default_value' => '«Истории в цвете»: иллюстрированный каталог с текстами о наивном искусстве.',
				),
				array(
					'key'          => 'field_shop_product_price',
					'label'        => 'Цена',
					'name'         => 'price',
					'type'         => 'text',
					'default_value' => '00 BYN',
				),
				array(
					'key'          => 'field_shop_product_image',
					'label'        => 'Изображение',
					'name'         => 'image',
					'type'         => 'image',
					'return_format' => 'url',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_shop_product_link',
					'label'        => 'Ссылка',
					'name'         => 'link',
					'type'         => 'url',
				),
				array(
					'key'          => 'field_shop_product_button_text',
					'label'        => 'Текст кнопки',
					'name'         => 'button_text',
					'type'         => 'text',
					'default_value' => 'В корзину',
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
					'key'          => 'field_why_us_item_icon',
					'label'        => 'Иконка (SVG код)',
					'name'         => 'icon',
					'type'         => 'textarea',
					'instructions' => 'Вставьте SVG код иконки',
					'rows'         => 5,
					'default_value' => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" stroke="#E8872C" stroke-width="2" stroke-linecap="round"><path d="M32 8c-8 0-16 8-16 18 0 14 12 22 16 22s16-8 16-22c0-10-8-18-16-18z"/><path d="M22 20l8 8M42 20l-8 8M20 34h24"/><circle cx="52" cy="12" r="2" fill="#E8872C"/><circle cx="10" cy="46" r="1.5" fill="#E8872C"/></svg>',
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
			'label'         => 'Фоновое изображение',
			'name'          => 'cta_background_image',
			'type'          => 'image',
			'instructions'  => 'Фоновое изображение для CTA секции',
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
