<?php
/**
 * GeorgeAG functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GeorgeAG
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function georgeag_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on GeorgeAG, use a find and replace
		* to change 'georgeag' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'georgeag', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'georgeag' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'georgeag_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'georgeag_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function georgeag_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'georgeag_content_width', 640 );
}
add_action( 'after_setup_theme', 'georgeag_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function georgeag_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'georgeag' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'georgeag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'georgeag_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function georgeag_scripts() {
	wp_enqueue_style( 'georgeag-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'georgeag-style', 'rtl', 'replace' );

	wp_enqueue_script( 'georgeag-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'georgeag_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load ACF Field Groups.
 */
require get_template_directory() . '/inc/acf-fields.php';

/**
 * Flush ACF field group cache when theme files change.
 * ACF caches field groups in DB; this forces a refresh.
 */
function georgeag_flush_acf_cache() {
	$flush_key = 'georgeag_acf_flush_v3';
	$saved     = get_option( $flush_key, '' );
	if ( $saved !== '1' ) {
		wp_cache_flush();
		global $wpdb;
		$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '%_transient_acf%' OR option_name LIKE '%_transient_timeout_acf%'" );
		update_option( $flush_key, '1' );
	}
}
add_action( 'after_setup_theme', 'georgeag_flush_acf_cache' );

/**
 * Load Events Custom Post Type.
 */
require get_template_directory() . '/inc/events-cpt.php';

/**
 * AJAX add to cart handler.
 */
function georgeag_ajax_add_to_cart() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		wp_send_json_error( array( 'message' => 'WooCommerce not active' ) );
	}

	$product_id = absint( $_POST['product_id'] );
	$quantity   = isset( $_POST['quantity'] ) ? absint( $_POST['quantity'] ) : 1;

	$passed_validate = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

	if ( $passed_validate ) {
		$cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity );

		if ( $cart_item_key ) {
			$count = WC()->cart->get_cart_contents_count();
			wp_send_json_success( array(
				'count' => $count,
				'message' => 'Товар добавлен в корзину',
			) );
		}
	}

	wp_send_json_error( array( 'message' => 'Не удалось добавить товар' ) );
}
add_action( 'wp_ajax_georgeag_add_to_cart', 'georgeag_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_georgeag_add_to_cart', 'georgeag_ajax_add_to_cart' );

/**
 * Get formatted cart data for AJAX responses.
 */
function georgeag_get_cart_data() {
	$cart      = WC()->cart;
	$items    = array();
	$is_book_cat = 'knigi';

	foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
		$product    = $cart_item['data'];
		$product_id = $cart_item['product_id'];

		$terms      = wp_get_post_terms( $product_id, 'product_cat', array( 'fields' => 'slugs' ) );
		$is_book    = ! is_wp_error( $terms ) && in_array( $is_book_cat, $terms, true );

		$image = '';
		if ( $product->get_image_id() ) {
			$image = wp_get_attachment_image_url( $product->get_image_id(), 'woocommerce_thumbnail' );
		}

		$items[] = array(
			'key'          => $cart_item_key,
			'name'         => $product->get_name(),
			'image'        => $image,
			'description'  => wp_strip_all_tags( $product->get_short_description() ),
			'price_html'   => $product->get_price_html(),
			'quantity'     => $cart_item['quantity'],
			'line_total'   => wc_price( $cart_item['line_total'] ),
			'is_book'      => $is_book,
			'link'         => get_permalink( $product_id ),
		);
	}

	$count     = $cart->get_cart_contents_count();
	$subtotal  = wc_price( (float) $cart->get_subtotal() );
	$total     = wc_price( (float) $cart->get_total( 'edit' ) );
	$counts    = $cart->get_cart_item_quantities();

	$count_label = '';
	if ( ! empty( $counts ) ) {
		$total_qty = 0;
		foreach ( $counts as $qty ) {
			$total_qty += $qty;
		}
		$count_label = sprintf( _n( '%d позиция', '%d позиции', $total_qty, 'georgeag' ), $total_qty );
	}

	return array(
		'count'  => $count,
		'empty'  => $cart->is_empty(),
		'items'  => $items,
		'totals' => array(
			'count'       => $count,
			'count_label' => $count_label,
			'subtotal'    => $subtotal,
			'total'       => $total,
		),
	);
}

/**
 * AJAX: Update cart item quantity.
 */
function georgeag_update_cart_item() {
	try {
		if ( ! class_exists( 'WooCommerce' ) ) {
			wp_send_json_error( array( 'message' => 'WooCommerce not active' ) );
		}

		$cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );
		$quantity      = absint( $_POST['quantity'] );

		if ( $quantity < 1 ) {
			$quantity = 1;
		}

		WC()->cart->set_quantity( $cart_item_key, $quantity );
		WC()->cart->calculate_totals();

		wp_send_json_success( georgeag_get_cart_data() );
	} catch ( Exception $e ) {
		wp_send_json_error( array( 'message' => $e->getMessage() ) );
	}
}
add_action( 'wp_ajax_georgeag_update_cart_item', 'georgeag_update_cart_item' );
add_action( 'wp_ajax_nopriv_georgeag_update_cart_item', 'georgeag_update_cart_item' );

/**
 * AJAX: Remove cart item.
 */
function georgeag_remove_cart_item() {
	try {
		if ( ! class_exists( 'WooCommerce' ) ) {
			wp_send_json_error( array( 'message' => 'WooCommerce not active' ) );
		}

		$cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );

		WC()->cart->remove_cart_item( $cart_item_key );
		WC()->cart->calculate_totals();

		wp_send_json_success( georgeag_get_cart_data() );
	} catch ( Exception $e ) {
		wp_send_json_error( array( 'message' => $e->getMessage() ) );
	}
}
add_action( 'wp_ajax_georgeag_remove_cart_item', 'georgeag_remove_cart_item' );
add_action( 'wp_ajax_nopriv_georgeag_remove_cart_item', 'georgeag_remove_cart_item' );

/**
 * AJAX: Clear entire cart.
 */
function georgeag_clear_cart() {
	try {
		if ( ! class_exists( 'WooCommerce' ) ) {
			wp_send_json_error( array( 'message' => 'WooCommerce not active' ) );
		}

		WC()->cart->empty_cart();

		wp_send_json_success( georgeag_get_cart_data() );
	} catch ( Exception $e ) {
		wp_send_json_error( array( 'message' => $e->getMessage() ) );
	}
}
add_action( 'wp_ajax_georgeag_clear_cart', 'georgeag_clear_cart' );
add_action( 'wp_ajax_nopriv_georgeag_clear_cart', 'georgeag_clear_cart' );

/**
 * AJAX: Buy event ticket — creates product on the fly if needed, then adds to cart.
 */
function georgeag_buy_event_ticket() {
	try {
		if ( ! class_exists( 'WooCommerce' ) ) {
			wp_send_json_error( array( 'message' => 'WooCommerce not active' ) );
		}

		$event_id = absint( $_POST['event_id'] );
		if ( ! $event_id || get_post_type( $event_id ) !== 'event' ) {
			wp_send_json_error( array( 'message' => 'Событие не найдено' ) );
		}

		$product_id = get_post_meta( $event_id, 'event_product_id', true );

		if ( ! $product_id || get_post_type( $product_id ) !== 'product' ) {
			// Create product on the fly
			$title     = get_the_title( $event_id );
			$price     = get_post_meta( $event_id, 'event_price', true );
			$date      = get_post_meta( $event_id, 'event_date', true );
			$time      = get_post_meta( $event_id, 'event_time', true );
			$location  = get_post_meta( $event_id, 'event_location', true );
			$thumbnail = get_post_thumbnail_id( $event_id );

			$numeric_price = 0;
			if ( $price ) {
				preg_match( '/[\d]+/', str_replace( ' ', '', $price ), $matches );
				if ( ! empty( $matches[0] ) ) {
					$numeric_price = (float) $matches[0];
				}
			}

			$short_desc_parts = array();
			if ( $date ) $short_desc_parts[] = $date;
			if ( $time ) $short_desc_parts[] = $time;
			if ( $location ) $short_desc_parts[] = $location;

			$product = new WC_Product_Simple();
			$product->set_name( $title . ' — Билет' );
			$product->set_regular_price( $numeric_price );
			$product->set_status( 'publish' );
			$product->set_catalog_visibility( 'hidden' );
			$product->set_virtual( true );
			$product->set_short_description( implode( ' · ', $short_desc_parts ) );
			$product->set_description( 'Билет на событие: ' . $title );

			if ( $thumbnail ) {
				$product->set_image_id( $thumbnail );
			}

			$product_id = $product->save();
			if ( $product_id ) {
				update_post_meta( $event_id, 'event_product_id', $product_id );
			}
		}

		if ( ! $product_id ) {
			wp_send_json_error( array( 'message' => 'Не удалось создать товар' ) );
		}

		$quantity = isset( $_POST['quantity'] ) ? absint( $_POST['quantity'] ) : 1;

		$cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity );

		if ( $cart_item_key ) {
			$count = WC()->cart->get_cart_contents_count();
			wp_send_json_success( array(
				'count' => $count,
				'message' => 'Билет добавлен в корзину',
			) );
		}

		wp_send_json_error( array( 'message' => 'Не удалось добавить в корзину' ) );
	} catch ( Exception $e ) {
		wp_send_json_error( array( 'message' => $e->getMessage() ) );
	}
}
add_action( 'wp_ajax_georgeag_buy_event_ticket', 'georgeag_buy_event_ticket' );
add_action( 'wp_ajax_nopriv_georgeag_buy_event_ticket', 'georgeag_buy_event_ticket' );

/**
 * AJAX: Buy exhibition ticket — creates product on the fly, adds to cart, returns cart URL.
 */
function georgeag_buy_exhibition_ticket() {
	try {
		if ( ! class_exists( 'WooCommerce' ) ) {
			wp_send_json_error( array( 'message' => 'WooCommerce not active' ) );
		}

		$page_id = absint( $_POST['page_id'] ?? 0 );
		if ( ! $page_id ) {
			wp_send_json_error( array( 'message' => 'Страница не найдена' ) );
		}

		$product_id = get_post_meta( $page_id, 'exhibition_product_id', true );

		if ( ! $product_id || get_post_type( $product_id ) !== 'product' ) {
			$title    = get_the_title( $page_id );
			$hero_cta_secondary_url = get_field( 'exhibition_hero_cta_secondary_url', $page_id ) ?: '';
			$price    = get_field( 'exhibition_practical_price', $page_id ) ?: '0';

			$numeric_price = 0;
			if ( $price ) {
				preg_match( '/[\d]+/', str_replace( ' ', '', $price ), $matches );
				if ( ! empty( $matches[0] ) ) {
					$numeric_price = (float) $matches[0];
				}
			}

			$location = get_field( 'exhibition_practical_location', $page_id ) ?: 'Музей Naif Arts';
			$format   = get_field( 'exhibition_practical_format', $page_id ) ?: 'Постоянная экспозиция';

			$product = new WC_Product_Simple();
			$product->set_name( $title . ' — Билет' );
			$product->set_regular_price( $numeric_price );
			$product->set_status( 'publish' );
			$product->set_catalog_visibility( 'hidden' );
			$product->set_virtual( true );
			$product->set_short_description( $location . ' · ' . $format );
			$product->set_description( 'Билет на экспозицию: ' . $title );

			$product_id = $product->save();
			if ( $product_id ) {
				update_post_meta( $page_id, 'exhibition_product_id', $product_id );
			}
		}

		if ( ! $product_id ) {
			wp_send_json_error( array( 'message' => 'Не удалось создать товар' ) );
		}

		$quantity = isset( $_POST['quantity'] ) ? absint( $_POST['quantity'] ) : 1;

		$cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity );

		if ( $cart_item_key ) {
			$count      = WC()->cart->get_cart_contents_count();
			$cart_url   = wc_get_cart_url();
			wp_send_json_success( array(
				'count'    => $count,
				'message'  => 'Билет добавлен в корзину',
				'cart_url' => $cart_url,
			) );
		}

		wp_send_json_error( array( 'message' => 'Не удалось добавить в корзину' ) );
	} catch ( Exception $e ) {
		wp_send_json_error( array( 'message' => $e->getMessage() ) );
	}
}
add_action( 'wp_ajax_georgeag_buy_exhibition_ticket', 'georgeag_buy_exhibition_ticket' );
add_action( 'wp_ajax_nopriv_georgeag_buy_exhibition_ticket', 'georgeag_buy_exhibition_ticket' );

/**
 * Get the custom checkout page URL.
 */
function georgeag_get_checkout_url() {
	$pages = get_pages( array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => 'checkout.php',
		'number'     => 1,
	) );
	if ( ! empty( $pages ) ) {
		return get_permalink( $pages[0]->ID );
	}
	return wc_get_checkout_url();
}

/**
 * Enqueue cart AJAX script on shop and cart pages.
 */
function georgeag_cart_ajax_script() {
	if ( is_post_type_archive( 'product' ) || is_page( 'shop' ) || is_product() || is_cart() || is_page_template( 'cart.php' ) || is_page_template( 'checkout.php' ) || is_page_template( 'exhibition.php' ) || is_singular( 'event' ) ) {
		wp_enqueue_script( 'georgeag-cart-ajax', '', array(), '1.0.0', true );
		wp_localize_script( 'georgeag-cart-ajax', 'georgeagCart', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'georgeag_cart_nonce' ),
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'georgeag_cart_ajax_script' );

/**
 * AJAX: Submit order from custom checkout page.
 */
function georgeag_submit_order() {
	try {
		if ( ! class_exists( 'WooCommerce' ) ) {
			wp_send_json_error( array( 'message' => 'WooCommerce не активен' ) );
		}

		if ( ! isset( $_POST['georgeag_checkout_nonce_field'] ) || ! wp_verify_nonce( sanitize_text_field( $_POST['georgeag_checkout_nonce_field'] ), 'georgeag_checkout_nonce' ) ) {
			wp_send_json_error( array( 'message' => 'Ошибка безопасности. Обновите страницу.' ) );
		}

		$name    = sanitize_text_field( $_POST['checkout_name'] );
		$phone   = sanitize_text_field( $_POST['checkout_phone'] );
		$email   = sanitize_email( $_POST['checkout_email'] );
		$comment = sanitize_textarea_field( $_POST['checkout_comment'] ?? '' );
		$delivery = sanitize_text_field( $_POST['delivery_method'] ?? 'pickup' );
		$address  = sanitize_textarea_field( $_POST['delivery_address'] ?? '' );
		$payment  = sanitize_text_field( $_POST['payment_method'] ?? 'online' );

		if ( empty( $name ) || empty( $phone ) || empty( $email ) ) {
			wp_send_json_error( array( 'message' => 'Заполните обязательные поля' ) );
		}

		if ( ! is_email( $email ) ) {
			wp_send_json_error( array( 'message' => 'Укажите корректный e-mail' ) );
		}

		$cart = WC()->cart;
		if ( $cart->is_empty() ) {
			wp_send_json_error( array( 'message' => 'Корзина пуста' ) );
		}

		// Create WC order
		$order = wc_create_order();

		// Add cart items
		foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
			$product    = wc_get_product( $cart_item['variation_id'] ? $cart_item['variation_id'] : $cart_item['product_id'] );
			$quantity   = $cart_item['quantity'];
			$order->add_product( $product, $quantity );
		}

		// Set billing/shipping address
		$address_data = array(
			'first_name' => $name,
			'last_name'  => '',
			'phone'      => $phone,
			'email'      => $email,
			'address_1'  => $address,
			'city'       => 'Минск',
			'country'    => 'BY',
		);
		$order->set_address( $address_data, 'billing' );
		if ( $delivery === 'delivery' ) {
			$order->set_address( $address_data, 'shipping' );
		}

		// Set payment method
		if ( $payment === 'online' ) {
			$order->set_payment_method( 'bacs' );
		} else {
			$order->set_payment_method( 'cod' );
		}

		// Set order note
		if ( $comment ) {
			$order->add_order_note( $comment );
		}
		$order->add_order_note( 'Способ получения: ' . ( $delivery === 'pickup' ? 'Самовывоз' : 'Доставка' ) );

		// Calculate totals
		$order->calculate_totals();

		// Set order status
		$order->update_status( 'pending', 'Ожидает оплаты' );

		// Empty the cart
		$cart->empty_cart();

		// Redirect to thank you page
		$thankyou_pages = get_pages( array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'thankyou.php',
			'number'     => 1,
		) );
		if ( ! empty( $thankyou_pages ) ) {
			$redirect_url = get_permalink( $thankyou_pages[0]->ID );
		} else {
			$redirect_url = home_url( '/' );
		}

		wp_send_json_success( array(
			'order_id'  => $order->get_id(),
			'order_key' => $order->get_order_key(),
			'redirect'  => $redirect_url,
		) );

	} catch ( Exception $e ) {
		wp_send_json_error( array( 'message' => $e->getMessage() ) );
	}
}
add_action( 'wp_ajax_georgeag_submit_order', 'georgeag_submit_order' );
add_action( 'wp_ajax_nopriv_georgeag_submit_order', 'georgeag_submit_order' );

