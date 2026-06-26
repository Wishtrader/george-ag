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
