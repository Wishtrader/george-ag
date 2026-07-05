<?php
/**
 * Events Custom Post Type Registration
 *
 * @package GeorgeAG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Events Categories Taxonomy
 */
function georgeag_register_event_categories() {
	$labels = array(
		'name'                       => _x( 'Тип события', 'Taxonomy general name', 'georgeag' ),
		'singular_name'              => _x( 'Тип события', 'Taxonomy singular name', 'georgeag' ),
		'search_items'               => __( 'Поиск типов событий', 'georgeag' ),
		'all_items'                  => __( 'Все типы событий', 'georgeag' ),
		'parent_item'                => __( 'Родительский тип', 'georgeag' ),
		'parent_item_colon'          => __( 'Родительский тип:', 'georgeag' ),
		'edit_item'                  => __( 'Редактировать тип события', 'georgeag' ),
		'update_item'                => __( 'Обновить тип события', 'georgeag' ),
		'add_new_item'               => __( 'Добавить новый тип события', 'georgeag' ),
		'new_item_name'              => __( 'Название нового типа события', 'georgeag' ),
		'menu_name'                  => __( 'Тип события', 'georgeag' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'event-category' ),
		'show_in_rest'      => true,
		'show_tagcloud'     => false,
	);

	register_taxonomy( 'event_category', array( 'event' ), $args );

	// Create default categories on theme activation
	$default_categories = array(
		'masterclass'      => 'Мастер-классы',
		'lecture'          => 'Лекции',
		'meeting'          => 'Встречи',
		'movie'            => 'Кинопоказы',
		'for_children'     => 'Для детей',
		'for_adults'       => 'Для взрослых',
		'family'           => 'Семейный',
		'free'             => 'Бесплатные',
		'subscription'     => 'По абонементу',
	);

	foreach ( $default_categories as $slug => $name ) {
		if ( ! term_exists( $slug, 'event_category' ) ) {
			wp_insert_term( $name, 'event_category', array( 'slug' => $slug ) );
		}
	}

	// Remove "Экскурсии" (tour) category if it exists
	$tour_term = term_exists( 'tour', 'event_category' );
	if ( $tour_term && ! is_wp_error( $tour_term ) ) {
		wp_delete_term( $tour_term['term_id'], 'event_category' );
	}
}
add_action( 'init', 'georgeag_register_event_categories', 1 );

/**
 * Meta box content for event categories
 */
function georgeag_event_category_metabox_content( $post ) {
	wp_nonce_field( 'georgeag_event_category_meta', 'georgeag_event_category_nonce' );

	$terms = get_terms( array(
		'taxonomy'   => 'event_category',
		'hide_empty' => false,
	) );

	$selected_terms = wp_get_post_terms( $post->ID, 'event_category', array( 'fields' => 'ids' ) );
	?>
	<div id="taxonomy-event_category" class="categorydiv">
		<ul id="event_categorychecklist" class="list:category categorychecklist form-no-clear">
			<?php if ( ! is_wp_error( $terms ) && $terms ) : ?>
				<?php foreach ( $terms as $term ) : ?>
					<li id="event_category-<?php echo esc_attr( $term->term_id ); ?>" class="categories-list-item">
						<label class="selectit">
							<input value="<?php echo esc_attr( $term->term_id ); ?>" type="checkbox" name="event_category[]" <?php checked( in_array( $term->term_id, $selected_terms ) ); ?> />
							<?php echo esc_html( $term->name ); ?>
						</label>
					</li>
				<?php endforeach; ?>
			<?php else : ?>
				<li><?php _e( 'Категории не найдены.', 'georgeag' ); ?></li>
			<?php endif; ?>
		</ul>
		<div id="category-adder" class="wp-hidden-children">
			<h4>
				<a id="event_category-add-toggle" href="#event_category-add" class="hide-if-no-js">
					<span><?php _e( '+ Добавить новую категорию', 'georgeag' ); ?></span>
				</a>
			</h4>
			<p id="event_category-add" class="category-adder category-add-toggle wp-hidden-child">
				<label class="screen-reader-text" for="newevent_category"><?php _e( 'Новая категория', 'georgeag' ); ?></label>
				<input type="text" name="newevent_category" id="newevent_category" class="input-text-field form-input" value="" />
				<button type="button" id="event_category-add-submit" class="button category-add-submit"><?php _e( 'Добавить', 'georgeag' ); ?></button>
				<?php wp_nonce_field( 'add-event_category', '_ajax_nonce-add-event_category', false ); ?>
			</p>
		</div>
	</div>
	<?php
}

/**
 * Save event categories from meta box
 */
function georgeag_save_event_category_metabox( $post_id ) {
	if ( ! isset( $_POST['georgeag_event_category_nonce'] ) || ! wp_verify_nonce( $_POST['georgeag_event_category_nonce'], 'georgeag_event_category_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['event_category'] ) && is_array( $_POST['event_category'] ) ) {
		$term_ids = array_map( 'intval', $_POST['event_category'] );
		wp_set_post_terms( $post_id, $term_ids, 'event_category' );
	} else {
		wp_set_post_terms( $post_id, array(), 'event_category' );
	}
}
add_action( 'save_post_event', 'georgeag_save_event_category_metabox' );

/**
 * Add icon field to event category taxonomy
 */
function georgeag_event_category_add_form_fields() {
	?>
	<div class="form-field">
		<label for="event_cat_icon"><?php _e( 'Иконка категории', 'georgeag' ); ?></label>
		<input type="hidden" name="event_cat_icon" id="event_cat_icon" value="" />
		<button type="button" class="button event-cat-icon-upload"><?php _e( 'Загрузить иконку', 'georgeag' ); ?></button>
		<button type="button" class="button event-cat-icon-remove" style="display:none;"><?php _e( 'Удалить', 'georgeag' ); ?></button>
		<p class="description"><?php _e( 'Иконка для отображения рядом с типом события в карточке', 'georgeag' ); ?></p>
	</div>
	<?php
}
add_action( 'event_category_add_form_fields', 'georgeag_event_category_add_form_fields' );

function georgeag_event_category_edit_form_fields( $term ) {
	$icon_url = get_term_meta( $term->term_id, 'event_cat_icon', true );
	?>
	<tr class="form-field">
		<th scope="row"><label for="event_cat_icon"><?php _e( 'Иконка категории', 'georgeag' ); ?></label></th>
		<td>
			<input type="hidden" name="event_cat_icon" id="event_cat_icon" value="<?php echo esc_attr( $icon_url ); ?>" />
			<?php if ( $icon_url ) : ?>
				<p><img src="<?php echo esc_url( $icon_url ); ?>" style="max-width:40px;max-height:40px;" /></p>
			<?php endif; ?>
			<button type="button" class="button event-cat-icon-upload"><?php _e( 'Загрузить иконку', 'georgeag' ); ?></button>
			<button type="button" class="button event-cat-icon-remove" <?php echo $icon_url ? '' : 'style="display:none;"'; ?>><?php _e( 'Удалить', 'georgeag' ); ?></button>
		</td>
	</tr>
	<?php
}
add_action( 'event_category_edit_form_fields', 'georgeag_event_category_edit_form_fields' );

function georgeag_event_category_save_fields( $term_id ) {
	if ( isset( $_POST['event_cat_icon'] ) ) {
		update_term_meta( $term_id, 'event_cat_icon', sanitize_text_field( $_POST['event_cat_icon'] ) );
	}
}
add_action( 'created_event_category', 'georgeag_event_category_save_fields' );
add_action( 'edited_event_category', 'georgeag_event_category_save_fields' );

function georgeag_event_category_admin_enqueue() {
	if ( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] !== 'event_category' ) {
		return;
	}
	wp_enqueue_media();
}
add_action( 'admin_init', 'georgeag_event_category_admin_enqueue' );

function georgeag_event_category_admin_script() {
	if ( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] !== 'event_category' ) {
		return;
	}
	?>
	<script>
	jQuery(function($){
		$(document).on('click', '.event-cat-icon-upload', function(e){
			e.preventDefault();
			var button = $(this);
			var container = button.closest('td, .form-field');
			var input = container.find('input[name="event_cat_icon"]');
			if (typeof wp.media === 'undefined') {
				alert('Медиабиблиотека не загружена. Обновите страницу.');
				return;
			}
			var frame = wp.media({ title: 'Выберите иконку', button: { text: 'Выбрать' }, multiple: false });
			frame.on('select', function(){
				var attachment = frame.state().get('selection').first().toJSON();
				input.val(attachment.url);
				container.find('.event-cat-icon-remove').show();
				var img = container.find('.event-cat-icon-preview');
				if (!img.length) {
					button.before('<p class="event-cat-icon-preview"><img src="' + attachment.url + '" style="max-width:40px;max-height:40px;" /></p>');
				} else {
					img.html('<img src="' + attachment.url + '" style="max-width:40px;max-height:40px;" />');
				}
			});
			frame.open();
		});
		$(document).on('click', '.event-cat-icon-remove', function(e){
			e.preventDefault();
			var container = $(this).closest('td, .form-field');
			container.find('input[name="event_cat_icon"]').val('');
			container.find('.event-cat-icon-preview').remove();
			$(this).hide();
		});
	});
	</script>
	<?php
}
add_action( 'admin_footer', 'georgeag_event_category_admin_script' );

/**
 * Register Events Custom Post Type
 */
function georgeag_register_events_cpt() {
	$labels = array(
		'name'                  => _x( 'События', 'Post type general name', 'georgeag' ),
		'singular_name'         => _x( 'Событие', 'Post type singular name', 'georgeag' ),
		'menu_name'             => _x( 'События', 'Admin Menu text', 'georgeag' ),
		'name_admin_bar'        => _x( 'Событие', 'Add New on Toolbar', 'georgeag' ),
		'add_new'               => __( 'Добавить новое', 'georgeag' ),
		'add_new_item'          => __( 'Добавить новое событие', 'georgeag' ),
		'new_item'              => __( 'Новое событие', 'georgeag' ),
		'edit_item'             => __( 'Редактировать событие', 'georgeag' ),
		'view_item'             => __( 'Просмотр события', 'georgeag' ),
		'all_items'             => __( 'Все события', 'georgeag' ),
		'search_items'          => __( 'Поиск событий', 'georgeag' ),
		'parent_item_colon'     => __( 'Родительские события:', 'georgeag' ),
		'not_found'             => __( 'События не найдены.', 'georgeag' ),
		'not_found_in_trash'    => __( 'События в корзине не найдены.', 'georgeag' ),
		'featured_image'        => _x( 'Обложка события', 'Overrides the "Featured Image" phrase for this post type', 'georgeag' ),
		'set_featured_image'    => _x( 'Установить обложку события', 'Overrides the "Set featured image" phrase for this post type', 'georgeag' ),
		'remove_featured_image' => _x( 'Удалить обложку события', 'Overrides the "Remove featured image" phrase for this post type', 'georgeag' ),
		'use_featured_image'    => _x( 'Использовать как обложку события', 'Overrides the "Use as featured image" phrase for this post type', 'georgeag' ),
		'archives'              => _x( 'Архив событий', 'The post type archive label', 'georgeag' ),
		'insert_into_item'      => _x( 'Добавить в событие', 'Overrides the "Insert into post" phrase for this post type', 'georgeag' ),
		'uploaded_to_this_item' => _x( 'Загружено для этого события', 'Overrides the "Uploaded to this post" phrase for this post type', 'georgeag' ),
		'filter_items_list'     => _x( 'Фильтровать список событий', 'Overrides the "Filter items list" phrase for this post type', 'georgeag' ),
		'items_list_navigation' => _x( 'Навигация по списку событий', 'Overrides the "Items list navigation" phrase for this post type', 'georgeag' ),
		'items_list'            => _x( 'Список событий', 'Overrides the "Items list" phrase for this post type', 'georgeag' ),
	);

	$args = array(
		'labels'                => $labels,
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'events' ),
		'capability_type'       => 'post',
		'has_archive'           => true,
		'hierarchical'          => false,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-calendar-alt',
		'show_in_admin_bar'     => true,
		'show_in_rest'          => true,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
		'exclude_from_search'   => false,
	);

	register_post_type( 'event', $args );
}
add_action( 'init', 'georgeag_register_events_cpt' );

/**
 * Flush rewrite rules on theme activation
 */
function georgeag_events_flush_rewrite_rules() {
	georgeag_register_events_cpt();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'georgeag_events_flush_rewrite_rules' );

/**
 * Duplicate Event functionality
 */
function georgeag_duplicate_event( $post_id, $post ) {
	// Check if user has permission to duplicate posts
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}

	// Check if this is a revision
	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	// Check if this is an autosave
	if ( wp_is_post_autosave( $post_id ) ) {
		return;
	}
}

/**
 * Add "Duplicate" link to admin table
 */
function georgeag_event_duplicate_actions( $actions, $post ) {
	if ( $post->post_type !== 'event' ) {
		return $actions;
	}

	if ( current_user_can( 'edit_posts' ) ) {
		$duplicate_url = wp_nonce_url(
			add_query_arg(
				array(
					'duplicate' => $post->ID,
					'type'      => 'event',
				)
			),
			'duplicate_post_' . $post->ID,
			'duplicate_nonce'
		);

		$actions['duplicate'] = sprintf(
			'<a href="%s" title="%s" rel="nofollow">%s</a>',
			esc_url( $duplicate_url ),
			esc_attr__( 'Дублировать это событие', 'georgeag' ),
			esc_html__( 'Дублировать', 'georgeag' )
		);
	}

	return $actions;
}
add_filter( 'page_row_actions', 'georgeag_event_duplicate_actions', 10, 2 );
add_filter( 'post_row_actions', 'georgeag_event_duplicate_actions', 10, 2 );

/**
 * Handle duplicate action
 */
function georgeag_handle_duplicate_event() {
	// Check if we have a duplicate request
	if ( ! isset( $_GET['duplicate'] ) || ! isset( $_GET['type'] ) ) {
		return;
	}

	if ( $_GET['type'] !== 'event' ) {
		return;
	}

	// Verify nonce
	$nonce = isset( $_GET['duplicate_nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['duplicate_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'duplicate_post_' . absint( $_GET['duplicate'] ) ) ) {
		return;
	}

	// Check permissions
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}

	$post_id = absint( $_GET['duplicate'] );
	$post    = get_post( $post_id );

	if ( ! $post ) {
		return;
	}

	// Create duplicate
	$new_post_id = georgeag_create_event_duplicate( $post_id, $post );

	if ( $new_post_id ) {
		wp_redirect( admin_url( 'post.php?post=' . $new_post_id . '&action=edit' ) );
		exit;
	}
}
add_action( 'admin_init', 'georgeag_handle_duplicate_event' );

/**
 * Create duplicate of an event
 */
function georgeag_create_event_duplicate( $post_id, $post ) {
	// Check if post is valid
	if ( ! $post || $post->post_type !== 'event' ) {
		return false;
	}

	// Create new post array
	$new_post = array(
		'post_title'   => $post->post_title . ' (копия)',
		'post_content' => $post->post_content,
		'post_excerpt' => $post->post_excerpt,
		'post_status'  => 'draft',
		'post_type'    => 'event',
		'post_author'  => get_current_user_id(),
	);

	// Insert new post
	$new_post_id = wp_insert_post( $new_post );

	if ( is_wp_error( $new_post_id ) ) {
		return false;
	}

	// Copy post meta
	$meta_keys = georgeag_get_event_meta_keys();
	foreach ( $meta_keys as $meta_key ) {
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		if ( $meta_value ) {
			add_post_meta( $new_post_id, $meta_key, $meta_value );
		}
	}

	// Copy featured image
	$thumbnail_id = get_post_thumbnail_id( $post_id );
	if ( $thumbnail_id ) {
		set_post_thumbnail( $new_post_id, $thumbnail_id );
	}

	// Copy terms (event_category taxonomy)
	$terms = wp_get_post_terms( $post_id, 'event_category', array( 'fields' => 'ids' ) );
	if ( ! is_wp_error( $terms ) && $terms ) {
		wp_set_post_terms( $new_post_id, $terms, 'event_category' );
	}

	return $new_post_id;
}

/**
 * Get all event meta keys (ACF fields)
 */
function georgeag_get_event_meta_keys() {
	return array(
		'event_date',
		'event_time',
		'event_duration',
		'event_location',
		'event_price',
		'event_age',
		'event_brief_description',
		'event_description',
		'event_what_to_expect_icon',
		'event_what_to_expect',
		'event_audience',
		'event_speaker_name',
		'event_speaker_bio',
		'event_hero_image',
		'event_icon_date',
		'event_icon_time',
		'event_icon_duration',
		'event_icon_format',
		'event_icon_location',
		'event_icon_price',
		'event_icon_age',
		'event_cta_background_image',
		'event_cta_title',
		'event_cta_primary',
		'event_cta_primary_url',
		'event_cta_secondary',
		'event_cta_secondary_url',
	);
}

/**
 * Register ACF fields for Events
 */
function georgeag_register_event_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'      => 'group_event_details',
		'title'    => 'Event Details: Информация о событии',
		'fields'   => array(
			array(
				'key'           => 'field_event_date',
				'label'         => 'Дата события',
				'name'          => 'event_date',
				'type'          => 'date_picker',
				'instructions'  => 'Выберите дату события',
				'required'      => 1,
				'display_format' => 'd.m.Y',
				'return_format'  => 'd F, D',
			),
			array(
				'key'           => 'field_event_time',
				'label'         => 'Время начала',
				'name'          => 'event_time',
				'type'          => 'text',
				'instructions'  => 'Формат: "18:30"',
				'required'      => 1,
				'default_value' => '18:30',
			),
			array(
				'key'           => 'field_event_duration',
				'label'         => 'Длительность',
				'name'          => 'event_duration',
				'type'          => 'text',
				'instructions'  => 'Например: "1 час 30 минут"',
				'default_value' => '1 час 30 минут',
			),
			array(
				'key'           => 'field_event_location',
				'label'         => 'Место проведения',
				'name'          => 'event_location',
				'type'          => 'text',
				'instructions'  => 'Например: "Лекторий музея"',
				'required'      => 1,
				'default_value' => 'Лекторий музея',
			),
			array(
				'key'           => 'field_event_price',
				'label'         => 'Стоимость',
				'name'          => 'event_price',
				'type'          => 'text',
				'instructions'  => 'Например: "00 BYN" или "Бесплатно"',
				'required'      => 1,
				'default_value' => '00 BYN',
			),
			array(
				'key'           => 'field_event_age',
				'label'         => 'Возрастное ограничение',
				'name'          => 'event_age',
				'type'          => 'text',
				'instructions'  => 'Например: "16+" или "0+"',
				'default_value' => '16+',
			),
		array(
			'key'           => 'field_event_brief_description',
			'label'         => 'Краткое описание',
			'name'          => 'event_brief_description',
			'type'          => 'textarea',
			'instructions'  => 'Краткое описание под заголовком в hero секции',
			'rows'          => 2,
			'default_value' => 'О символах, образах и живом языке наивной живописи — просто, ясно и без академической дистанции.',
		),
		array(
			'key'           => 'field_event_description',
			'label'         => 'Полное описание',
			'name'          => 'event_description',
			'type'          => 'textarea',
			'instructions'  => 'Подробное описание для секции «О событии»',
			'rows'          => 6,
			'default_value' => 'О символах, образах и живом языке наивной живописи — просто, ясно и без академической дистанции.',
		),
		array(
			'key'           => 'field_event_what_to_expect_icon',
			'label'         => 'Иконка (общая)',
			'name'          => 'event_what_to_expect_icon',
			'type'          => 'image',
			'instructions'  => 'Иконка для всех строк секции «Что вас ждёт»',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_what_to_expect',
			'label'         => 'Что вас ждёт',
			'name'          => 'event_what_to_expect',
			'type'          => 'repeater',
			'instructions'  => 'Добавьте строки для секции',
			'layout'        => 'block',
			'button_label'  => 'Добавить строку',
			'sub_fields'    => array(
				array(
					'key'          => 'field_what_to_expect_item_text',
					'label'        => 'Текст',
					'name'         => 'text',
					'type'         => 'textarea',
					'rows'         => 2,
					'default_value' => '',
				),
			),
		),
			array(
				'key'           => 'field_event_audience',
				'label'         => 'Кому подойдёт событие',
				'name'          => 'event_audience',
				'type'          => 'textarea',
				'instructions'  => 'Описание целевой аудитории',
				'rows'          => 4,
				'default_value' => 'Лекция подойдёт взрослым посетителям, начинающим зрителям, тем, кто хочет лучше понимать искусство без сложной теории, а также всем, кому интересны искренние художественные высказывания и культурный контекст наивного искусства.',
			),
			array(
				'key'           => 'field_event_speaker_name',
				'label'         => 'Имя спикера',
				'name'          => 'event_speaker_name',
				'type'          => 'text',
				'instructions'  => 'Имя и фамилия спикера',
				'default_value' => 'Анна Михайлова',
			),
			array(
				'key'           => 'field_event_speaker_image',
				'label'         => 'Фото спикера',
				'name'          => 'event_speaker_image',
				'type'          => 'image',
				'instructions'  => 'Изображение спикера (рекомендуется квадрат 300x300px)',
				'return_format' => 'url',
				'library'       => 'all',
			),
			array(
				'key'           => 'field_event_speaker_bio',
				'label'         => 'Биография спикера',
				'name'          => 'event_speaker_bio',
				'type'          => 'textarea',
				'instructions'  => 'Краткая биография спикера',
				'rows'          => 4,
				'default_value' => 'Искусствовед и куратор образовательных программ музея. Исследует наивное искусство, визуальную память и формы художественного высказывания вне академической традиции.',
			),
		array(
			'key'           => 'field_event_thumbnail',
			'label'         => 'Миниатюра',
			'name'          => 'event_thumbnail',
			'type'          => 'image',
			'instructions'  => 'Изображение для карточки события',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_audience_type',
			'label'         => 'Аудитория',
			'name'          => 'event_audience_type',
			'type'          => 'select',
			'instructions'  => 'Для кого предназначен формат',
			'choices'       => array(
				'for_children' => 'Для детей',
				'for_adults'   => 'Для взрослых',
				'family'       => 'Семейный',
			),
			'default_value' => 'for_children',
		),
		array(
			'key'           => 'field_event_audience_icon',
			'label'         => 'Иконка аудитории',
			'name'          => 'event_audience_icon',
			'type'          => 'image',
			'instructions'  => 'Иконка слева от названия аудитории в карточке',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_hero_image',
			'label'         => 'Hero изображение',
			'name'          => 'event_hero_image',
			'type'          => 'image',
			'instructions'  => 'Фоновое изображение для hero секции страницы события',
			'return_format' => 'url',
		'library'       => 'all',
	),
		array(
			'key'           => 'field_event_icons_tab',
			'label'         => 'Иконки секций',
			'name'          => '',
			'type'          => 'tab',
			'placement'     => 'top',
		),
		array(
			'key'           => 'field_event_icon_date',
			'label'         => 'Иконка: Дата',
			'name'          => 'event_icon_date',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_icon_time',
			'label'         => 'Иконка: Время',
			'name'          => 'event_icon_time',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_icon_duration',
			'label'         => 'Иконка: Длительность',
			'name'          => 'event_icon_duration',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_icon_format',
			'label'         => 'Иконка: Формат',
			'name'          => 'event_icon_format',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_icon_location',
			'label'         => 'Иконка: Место',
			'name'          => 'event_icon_location',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_icon_price',
			'label'         => 'Иконка: Стоимость',
			'name'          => 'event_icon_price',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_icon_age',
			'label'         => 'Иконка: Возраст',
			'name'          => 'event_icon_age',
			'type'          => 'image',
			'return_format' => 'url',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_event_cta_tab',
			'label'         => 'CTA-баннер',
			'name'          => '',
			'type'          => 'tab',
			'placement'     => 'top',
		),
		array(
			'key'           => 'field_event_cta_background_image',
			'label'         => 'Фоновое изображение',
			'name'          => 'event_cta_background_image',
			'type'          => 'image',
			'instructions'  => 'Фон CTA-баннера внизу страницы события',
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
			'default_value' => 'Купить билет',
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
			'default_value' => 'Посмотреть афишу',
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
		'menu_order' => 0,
		'position'   => 'normal',
		'style'      => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
	) );
}
add_action( 'acf/init', 'georgeag_register_event_acf_fields' );

/**
 * Add custom columns to Events admin table
 */
function georgeag_events_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'event_date':
			$date = get_post_meta( $post_id, 'event_date', true );
			$time = get_post_meta( $post_id, 'event_time', true );
			if ( $date || $time ) {
				echo esc_html( $date . ' ' . $time );
			}
			break;

		case 'event_price':
			$price = get_post_meta( $post_id, 'event_price', true );
			echo esc_html( $price ? $price : '-' );
			break;
	}
}
add_action( 'manage_event_posts_custom_column', 'georgeag_events_custom_columns', 10, 2 );

/**
 * Format event date to Russian format "24 мая, пт"
 */
function georgeag_format_event_date( $value, $post_id, $field ) {
	if ( $field['name'] === 'event_date' && ! empty( $value ) ) {
		// Parse the date from ACF (stored as "Y-m-d" internally before filter)
		$timestamp = strtotime( $value );
		if ( $timestamp ) {
			// Format: day, month (lowercase), short weekday (lowercase)
			$day = date( 'd', $timestamp );
			$month = mb_strtolower( date( 'F', $timestamp ), 'UTF-8' );
			$weekday = mb_strtolower( date( 'D', $timestamp ), 'UTF-8' );
			
			// Map English month/weekday to Russian
			$months = array(
				'january'   => 'января', 'february'  => 'февраля', 'march'     => 'марта',
				'april'     => 'апреля',  'may'       => 'мая',     'june'      => 'июня',
				'july'      => 'июля',    'august'    => 'августа', 'september' => 'сентября',
				'october'   => 'октября', 'november'  => 'ноября',  'december'  => 'декабря',
			);
			$weekdays = array(
				'mon' => 'пн', 'tue' => 'вт', 'wed' => 'ср', 'thu' => 'чт', 'fri' => 'пт', 'sat' => 'сб', 'sun' => 'вс',
			);
			
			$month_ru = $months[ mb_strtolower( date( 'F', $timestamp ) ) ] ?? $month;
			$weekday_ru = $weekdays[ date( 'D', $timestamp ) ] ?? $weekday;
			
			return $day . ' ' . $month_ru . ', ' . $weekday_ru;
		}
	}
	return $value;
}
add_filter( 'acf/format_value/name=event_date', 'georgeag_format_event_date', 10, 3 );

/**
 * Add sortable columns header to Events admin table
 */
function georgeag_events_add_custom_columns( $columns ) {
	$new_columns = array();

	foreach ( $columns as $key => $value ) {
		$new_columns[ $key ] = $value;

		if ( $key === 'title' ) {
			$new_columns['event_date'] = 'Дата/время';
			$new_columns['event_price'] = 'Цена';
		}
	}

	return $new_columns;
}
add_filter( 'manage_event_posts_columns', 'georgeag_events_add_custom_columns' );

/**
 * Register Subscriptions Custom Post Type
 */
function georgeag_register_subscriptions_cpt() {
	$labels = array(
		'name'                  => _x( 'Абонементы', 'Post type general name', 'georgeag' ),
		'singular_name'         => _x( 'Абонемент', 'Post type singular name', 'georgeag' ),
		'menu_name'             => _x( 'Абонементы', 'Admin Menu text', 'georgeag' ),
		'name_admin_bar'        => _x( 'Абонемент', 'Add New on Toolbar', 'georgeag' ),
		'add_new'               => __( 'Добавить новый', 'georgeag' ),
		'add_new_item'          => __( 'Добавить новый абонемент', 'georgeag' ),
		'new_item'              => __( 'Новый абонемент', 'georgeag' ),
		'edit_item'             => __( 'Редактировать абонемент', 'georgeag' ),
		'view_item'             => __( 'Просмотр абонемента', 'georgeag' ),
		'all_items'             => __( 'Все абонементы', 'georgeag' ),
		'search_items'          => __( 'Поиск абонементов', 'georgeag' ),
		'not_found'             => __( 'Абонементы не найдены.', 'georgeag' ),
		'not_found_in_trash'    => __( 'Абонементы в корзине не найдены.', 'georgeag' ),
		'featured_image'        => _x( 'Обложка абонемента', 'Overrides the "Featured Image" phrase', 'georgeag' ),
		'set_featured_image'    => _x( 'Установить обложку абонемента', 'Overrides the "Set featured image" phrase', 'georgeag' ),
		'remove_featured_image' => _x( 'Удалить обложку абонемента', 'Overrides the "Remove featured image" phrase', 'georgeag' ),
		'use_featured_image'    => _x( 'Использовать как обложку абонемента', 'Overrides the "Use as featured image" phrase', 'georgeag' ),
	);

	$args = array(
		'labels'                => $labels,
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'subscriptions' ),
		'capability_type'       => 'post',
		'has_archive'           => true,
		'hierarchical'          => false,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-tickets',
		'show_in_admin_bar'     => true,
		'show_in_rest'          => true,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'exclude_from_search'   => false,
	);

	register_post_type( 'subscription', $args );
}
add_action( 'init', 'georgeag_register_subscriptions_cpt' );

/**
 * Flush rewrite rules on theme activation for subscriptions
 */
function georgeag_subscriptions_flush_rewrite_rules() {
	georgeag_register_subscriptions_cpt();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'georgeag_subscriptions_flush_rewrite_rules' );

/**
 * Register ACF fields for Subscriptions
 */
function georgeag_register_subscription_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'      => 'group_subscription_details',
		'title'    => 'Абонемент: Детали',
		'fields'   => array(
			array(
				'key'           => 'field_subscription_description',
				'label'         => 'Описание',
				'name'          => 'subscription_description',
				'type'          => 'textarea',
				'instructions'  => 'Краткое описание абонемента',
				'rows'          => 3,
			),
			array(
				'key'           => 'field_subscription_price',
				'label'         => 'Стоимость',
				'name'          => 'subscription_price',
				'type'          => 'text',
				'instructions'  => 'Например: "49 BYN"',
				'default_value' => '00 BYN',
			),
			array(
				'key'           => 'field_subscription_button_text',
				'label'         => 'Текст кнопки',
				'name'          => 'subscription_button_text',
				'type'          => 'text',
				'default_value' => 'Подробнее',
			),
			array(
				'key'           => 'field_subscription_button_url',
				'label'         => 'Ссылка кнопки',
				'name'          => 'subscription_button_url',
				'type'          => 'url',
			),
			array(
				'key'           => 'field_subscription_what_includes',
				'label'         => 'Что входит',
				'name'          => 'subscription_what_includes',
				'type'          => 'repeater',
				'instructions'  => 'Список того, что входит в абонемент',
				'layout'        => 'block',
				'button_label'  => 'Добавить пункт',
				'sub_fields'    => array(
					array(
						'key'   => 'field_sub_what_item',
						'label' => 'Пункт',
						'name'  => 'item',
						'type'  => 'text',
					),
					array(
						'key'           => 'field_sub_what_icon',
						'label'         => 'Иконка (опционально)',
						'name'          => 'icon',
						'type'          => 'image',
						'return_format' => 'url',
						'library'       => 'all',
						'instructions'  => 'Заменит стандартную иконку галочки',
					),
				),
			),
		),
		'location'   => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'subscription',
				),
			),
		),
		'menu_order' => 0,
		'position'   => 'normal',
		'style'      => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
	) );
}
add_action( 'acf/init', 'georgeag_register_subscription_acf_fields' );

/**
 * Add "Duplicate" link to Subscription post row actions
 */
function georgeag_subscription_row_actions( $actions, $post ) {
	if ( $post->post_type === 'subscription' ) {
		$url = wp_nonce_url(
			add_query_arg( array(
				'action'  => 'georgeag_duplicate_subscription',
				'post'    => $post->ID,
			), admin_url( 'edit.php' ) ),
			'georgeag_duplicate_subscription_' . $post->ID
		);
		$actions['duplicate'] = '<a href="' . esc_url( $url ) . '" title="Дублировать абонемент">Дублировать</a>';
	}
	return $actions;
}
add_filter( 'post_row_actions', 'georgeag_subscription_row_actions', 10, 2 );

/**
 * Handle subscription duplication
 */
function georgeag_duplicate_subscription() {
	if ( ! isset( $_GET['action'] ) || $_GET['action'] !== 'georgeag_duplicate_subscription' ) {
		return;
	}

	$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0;
	if ( ! $post_id ) {
		wp_die( 'Некорректный ID поста.' );
	}

	if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'georgeag_duplicate_subscription_' . $post_id ) ) {
		wp_die( 'Невалидный nonce.' );
	}

	$original_post = get_post( $post_id );
	if ( ! $original_post || $original_post->post_type !== 'subscription' ) {
		wp_die( 'Абонемент не найден.' );
	}

	$duplicate_data = array(
		'comment_status' => $original_post->comment_status,
		'ping_status'    => $original_post->ping_status,
		'post_author'    => $original_post->post_author,
		'post_content'   => $original_post->post_content,
		'post_excerpt'   => $original_post->post_excerpt,
		'post_name'      => $original_post->post_name,
		'post_password'  => $original_post->post_password,
		'post_status'    => 'draft',
		'post_title'     => $original_post->post_title . ' (копия)',
		'post_type'      => $original_post->post_type,
		'to_ping'        => $original_post->to_ping,
		'menu_order'     => $original_post->menu_order,
	);

	$new_post_id = wp_insert_post( $duplicate_data );

	if ( is_wp_error( $new_post_id ) ) {
		wp_die( 'Ошибка при создании дубликата: ' . $new_post_id->get_error_message() );
	}

	// Copy post meta.
	$meta = get_post_meta( $post_id );
	foreach ( $meta as $key => $values ) {
		foreach ( $values as $value ) {
			add_post_meta( $new_post_id, $key, $value );
		}
	}

	// Copy featured image.
	$thumbnail_id = get_post_thumbnail_id( $post_id );
	if ( $thumbnail_id ) {
		set_post_thumbnail( $new_post_id, $thumbnail_id );
	}

	wp_redirect( admin_url( 'post.php?post=' . $new_post_id . '&action=edit' ) );
	exit;
}
add_action( 'admin_init', 'georgeag_duplicate_subscription' );