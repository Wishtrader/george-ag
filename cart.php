<?php
/**
 * Template Name: Корзина
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	get_header();
	echo '<div class="container-main py-16 text-center"><h1>Корзина недоступна</h1><p>WooCommerce не активен.</p></div>';
	get_footer();
	return;
}

$cart      = WC()->cart;
$is_empty  = $cart->is_empty();
$all_items = $cart->get_cart();

// Separate items: books (knigi) vs everything else (tickets)
$book_items    = array();
$ticket_items  = array();
foreach ( $all_items as $key => $item ) {
	$item_terms = wp_get_post_terms( $item['product_id'], 'product_cat', array( 'fields' => 'slugs' ) );
	if ( ! is_wp_error( $item_terms ) && in_array( 'knigi', $item_terms, true ) ) {
		$book_items[ $key ] = $item;
	} else {
		$ticket_items[ $key ] = $item;
	}
}

$count     = $cart->get_cart_contents_count();
$subtotal  = wc_price( $cart->get_subtotal() );
$total     = wc_price( $cart->get_total( 'edit' ) );
$count_label = sprintf( _n( '%d позиция', '%d позиции', $count, 'georgeag' ), $count );

get_header();
?>

<!-- ============ CART SECTION ============ -->
<section class="py-10 lg:py-16">
  <div class="container-main">

    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs lg:text-sm text-[#6B5A4A] mb-6">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#E8872C] transition">Главная</a>
      <span>→</span>
      <span class="text-[#2D2926]">Корзина</span>
    </nav>

    <!-- Title -->
    <h1 class="text-[34px] lg:text-[50px] text-[#2D2926] mb-12">
      Корзина
    </h1>

    <!-- Cart content container — перерисовывается JS -->
    <div id="cart-content">

      <?php if ( ! $is_empty ) : ?>

        <!-- ============ БИЛЕТЫ И СОБЫТИЯ ============ -->
        <?php if ( ! empty( $ticket_items ) ) : ?>
        <div class="cart-section-tickets mb-12">
          <h2 class="flex items-center gap-3 text-[22px] lg:text-[28px] font-semibold text-[#2D2926] mb-6">
            <span class="w-8 h-8 flex items-center justify-center bg-[#F5EADB] rounded-lg">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="18" rx="2"/>
                <path d="M2 10h20"/>
                <path d="M10 4v16"/>
              </svg>
            </span>
            Билеты и события
          </h2>

          <?php foreach ( $ticket_items as $cart_item_key => $item ) :
            $product    = $item['data'];
            $product_id = $item['product_id'];
            $qty        = $item['quantity'];
            $line_total = wc_price( $item['line_total'] );
            $name       = $product->get_name();
            $desc       = wp_strip_all_tags( $product->get_short_description() );
          ?>
          <div class="cart-item-card bg-white rounded-2xl p-5 lg:p-6 shadow-sm flex flex-col lg:flex-row lg:items-center gap-4 mb-4" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
            <div class="flex-1">
              <h3 class="font-['Literata'] text-[18px] lg:text-[20px] font-semibold text-[#2D2926] mb-2">
                <?php echo esc_html( $name ); ?>
              </h3>
              <?php if ( $desc ) : ?>
              <p class="text-[14px] lg:text-[15px] text-[#6B5A4A] leading-snug">
                <?php echo esc_html( $desc ); ?>
              </p>
              <?php endif; ?>
            </div>
            <div class="flex items-center gap-5 lg:gap-8">
              <span class="cart-item-total text-[18px] lg:text-[20px] font-semibold text-[#2D2926] whitespace-nowrap"><?php echo wp_kses_post( $line_total ); ?></span>
              <div class="flex items-center gap-0">
                <button class="cart-qty-btn cart-qty-minus w-10 h-10 rounded-l-xl border border-[#E0D6CC] bg-[#FAF6EF] flex items-center justify-center text-[#2D2926] text-lg font-medium hover:bg-[#F0E8DD] transition" aria-label="Уменьшить количество">−</button>
                <span class="cart-qty-value w-12 h-10 flex items-center justify-center border-y border-[#E0D6CC] bg-white text-[16px] font-medium text-[#2D2926]"><?php echo esc_html( $qty ); ?></span>
                <button class="cart-qty-btn cart-qty-plus w-10 h-10 rounded-r-xl border border-[#E0D6CC] bg-[#FAF6EF] flex items-center justify-center text-[#2D2926] text-lg font-medium hover:bg-[#F0E8DD] transition" aria-label="Увеличить количество">+</button>
              </div>
              <button class="cart-remove-btn w-8 h-8 flex items-center justify-center text-[#E8872C] hover:text-[#D1731F] transition" aria-label="Удалить">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                  <line x1="18" y1="6" x2="6" y2="18"/>
                  <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
              </button>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- ============ ТОВАРЫ МАГАЗИНА ============ -->
        <?php if ( ! empty( $book_items ) ) : ?>
        <div class="cart-section-books mb-12">
          <h2 class="flex items-center gap-3 text-[22px] lg:text-[28px] font-semibold text-[#2D2926] mb-6">
            <span class="w-8 h-8 flex items-center justify-center bg-[#F5EADB] rounded-lg">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                <line x1="3" y1="6" x2="21" y2="6"/>
                <path d="M16 10a4 4 0 0 1-8 0"/>
              </svg>
            </span>
            Товары магазина
          </h2>

          <?php foreach ( $book_items as $cart_item_key => $item ) :
            $product    = $item['data'];
            $product_id = $item['product_id'];
            $qty        = $item['quantity'];
            $line_total = wc_price( $item['line_total'] );
            $name       = $product->get_name();
            $desc       = wp_strip_all_tags( $product->get_short_description() );

            $image = '';
            if ( $product->get_image_id() ) {
              $image = wp_get_attachment_image_url( $product->get_image_id(), 'woocommerce_thumbnail' );
            } elseif ( $product->get_gallery_image_ids() ) {
              $image = wp_get_attachment_image_url( $product->get_gallery_image_ids()[0], 'woocommerce_thumbnail' );
            }
          ?>
          <div class="cart-item-card bg-white rounded-2xl p-5 lg:p-6 shadow-sm flex flex-col lg:flex-row lg:items-center gap-4 mb-4" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
            <div class="flex items-center gap-4 flex-1">
              <div class="w-[72px] h-[72px] rounded-xl overflow-hidden flex-shrink-0 bg-[#F5EADB]">
                <?php if ( $image ) : ?>
                  <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="w-full h-full object-cover">
                <?php endif; ?>
              </div>
              <div class="flex-1">
                <h3 class="font-['Literata'] text-[16px] lg:text-[18px] font-semibold text-[#2D2926] mb-1">
                  <?php echo esc_html( $name ); ?>
                </h3>
                <?php if ( $desc ) : ?>
                <p class="text-[13px] lg:text-[14px] text-[#6B5A4A] leading-snug">
                  <?php echo esc_html( $desc ); ?>
                </p>
                <?php endif; ?>
              </div>
            </div>
            <div class="flex items-center gap-5 lg:gap-8">
              <span class="cart-item-total text-[18px] lg:text-[20px] font-semibold text-[#2D2926] whitespace-nowrap"><?php echo wp_kses_post( $line_total ); ?></span>
              <div class="flex items-center gap-0">
                <button class="cart-qty-btn cart-qty-minus w-10 h-10 rounded-l-xl border border-[#E0D6CC] bg-[#FAF6EF] flex items-center justify-center text-[#2D2926] text-lg font-medium hover:bg-[#F0E8DD] transition" aria-label="Уменьшить количество">−</button>
                <span class="cart-qty-value w-12 h-10 flex items-center justify-center border-y border-[#E0D6CC] bg-white text-[16px] font-medium text-[#2D2926]"><?php echo esc_html( $qty ); ?></span>
                <button class="cart-qty-btn cart-qty-plus w-10 h-10 rounded-r-xl border border-[#E0D6CC] bg-[#FAF6EF] flex items-center justify-center text-[#2D2926] text-lg font-medium hover:bg-[#F0E8DD] transition" aria-label="Увеличить количество">+</button>
              </div>
              <button class="cart-remove-btn w-8 h-8 flex items-center justify-center text-[#E8872C] hover:text-[#D1731F] transition" aria-label="Удалить">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                  <line x1="18" y1="6" x2="6" y2="18"/>
                  <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
              </button>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- ============ ИТОГО ПО ЗАКАЗУ ============ -->
        <div class="cart-section-totals bg-white rounded-2xl p-6 lg:p-8 shadow-sm">
          <h2 class="font-['Literata'] text-[22px] lg:text-[24px] font-semibold text-[#2D2926] mb-6">
            Итого по заказу
          </h2>

          <div class="space-y-3 text-[15px] lg:text-[16px] text-[#2D2926] mb-6">
            <div class="flex justify-between">
              <span class="cart-count-label"><?php echo esc_html( $count_label ); ?></span>
            </div>
            <div class="flex justify-between">
              <span>Сумма</span>
              <span class="cart-subtotal"><?php echo wp_kses_post( $subtotal ); ?></span>
            </div>
            <div class="flex justify-between">
              <span>Доставка</span>
              <span class="text-[#6B5A4A]">рассчитывается отдельно</span>
            </div>
          </div>

          <div class="border-t border-[#E0D6CC] pt-4 mb-5">
            <div class="flex justify-between items-center">
              <span class="text-[18px] lg:text-[20px] font-semibold text-[#2D2926]">К оплате</span>
              <span class="cart-total text-[20px] lg:text-[22px] font-semibold text-[#2D2926]"><?php echo wp_kses_post( $total ); ?></span>
            </div>
          </div>

          <p class="text-[13px] lg:text-[14px] text-[#6B5A4A] mb-8 bg-[#FAF6EF] rounded-xl px-5 py-4 leading-relaxed">
            Для билетов будет оформлено электронное подтверждение, для товаров — самовывоз или доставка.
          </p>

          <div class="flex flex-col items-center gap-4">
            <a href="<?php echo esc_url( georgeag_get_checkout_url() ); ?>" class="btn-primary !max-w-none w-full h-[52px] rounded-xl">
              Оформить заказ
            </a>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-secondary !max-w-none w-full h-[52px] rounded-xl">
              Продолжить выбор
            </a>
            <button id="cart-clear-btn" class="text-[15px] font-medium text-[#6B5A4A] underline underline-offset-4 hover:text-[#E8872C] transition mt-2">
              Очистить корзину
            </button>
          </div>
        </div>

      <?php else : ?>

        <!-- ============ ПУСТАЯ КОРЗИНА ============ -->
        <div id="cart-empty" class="text-center py-16">
          <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center bg-[#F5EADB] rounded-full">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
              <line x1="3" y1="6" x2="21" y2="6"/>
              <path d="M16 10a4 4 0 0 1-8 0"/>
            </svg>
          </div>
          <h2 class="font-['Literata'] text-[26px] lg:text-[32px] text-[#2D2926] mb-3">Корзина пуста</h2>
          <p class="text-[15px] lg:text-[17px] text-[#6B5A4A] mb-8">Добавьте товары из магазина или билеты на мероприятия</p>
          <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-primary">
            Перейти в магазин
          </a>
        </div>

      <?php endif; ?>

    </div><!-- #cart-content -->

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var cartContent = document.getElementById('cart-content');
  if (!cartContent) return;

  var ajaxUrl = typeof georgeagCart !== 'undefined' ? georgeagCart.ajaxUrl : '<?php echo admin_url("admin-ajax.php"); ?>';

  // ——— Helper: rebuild full cart HTML from data ———
  function renderCart(data) {
    if (data.empty) {
      cartContent.innerHTML =
        '<div id="cart-empty" class="text-center py-16">' +
          '<div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center bg-[#F5EADB] rounded-full">' +
            '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">' +
              '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>' +
              '<line x1="3" y1="6" x2="21" y2="6"/>' +
              '<path d="M16 10a4 4 0 0 1-8 0"/>' +
            '</svg>' +
          '</div>' +
          '<h2 class="font-[\'Literata\'] text-[26px] lg:text-[32px] text-[#2D2926] mb-3">Корзина пуста</h2>' +
          '<p class="text-[15px] lg:text-[17px] text-[#6B5A4A] mb-8">Добавьте товары из магазина или билеты на мероприятия</p>' +
          '<a href="<?php echo esc_js( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-primary">Перейти в магазин</a>' +
        '</div>';
      updateHeaderCount(0);
      return;
    }

    var tickets = [];
    var books = [];
    data.items.forEach(function(item) {
      if (item.is_book) {
        books.push(item);
      } else {
        tickets.push(item);
      }
    });

    var html = '';

    // Tickets section
    if (tickets.length > 0) {
      html += '<div class="cart-section-tickets mb-12">';
      html += '<h2 class="flex items-center gap-3 text-[22px] lg:text-[28px] font-semibold text-[#2D2926] mb-6">';
      html += '<span class="w-8 h-8 flex items-center justify-center bg-[#F5EADB] rounded-lg">';
      html += '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="18" rx="2"/><path d="M2 10h20"/><path d="M10 4v16"/></svg>';
      html += '</span>Билеты и события</h2>';
      tickets.forEach(function(item) { html += renderTicketCard(item); });
      html += '</div>';
    }

    // Books section
    if (books.length > 0) {
      html += '<div class="cart-section-books mb-12">';
      html += '<h2 class="flex items-center gap-3 text-[22px] lg:text-[28px] font-semibold text-[#2D2926] mb-6">';
      html += '<span class="w-8 h-8 flex items-center justify-center bg-[#F5EADB] rounded-lg">';
      html += '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>';
      html += '</span>Товары магазина</h2>';
      books.forEach(function(item) { html += renderBookCard(item); });
      html += '</div>';
    }

    // Totals section
    html += renderTotals(data.totals);

    cartContent.innerHTML = html;
    updateHeaderCount(data.count);
  }

  function renderTicketCard(item) {
    var desc = item.description ? '<p class="text-[14px] lg:text-[15px] text-[#6B5A4A] leading-snug">' + item.description + '</p>' : '';
    return '<div class="cart-item-card bg-white rounded-2xl p-5 lg:p-6 shadow-sm flex flex-col lg:flex-row lg:items-center gap-4 mb-4" data-cart-key="' + item.key + '">' +
      '<div class="flex-1">' +
        '<h3 class="font-[\'Literata\'] text-[18px] lg:text-[20px] font-semibold text-[#2D2926] mb-2">' + item.name + '</h3>' +
        desc +
      '</div>' +
      '<div class="flex items-center gap-5 lg:gap-8">' +
        '<span class="cart-item-total text-[18px] lg:text-[20px] font-semibold text-[#2D2926] whitespace-nowrap">' + item.line_total + '</span>' +
        renderQtyControls(item) +
        renderRemoveBtn() +
      '</div>' +
    '</div>';
  }

  function renderBookCard(item) {
    var imgHtml = item.image
      ? '<img src="' + item.image + '" alt="' + item.name + '" class="w-full h-full object-cover">'
      : '';
    var desc = item.description ? '<p class="text-[13px] lg:text-[14px] text-[#6B5A4A] leading-snug">' + item.description + '</p>' : '';
    return '<div class="cart-item-card bg-white rounded-2xl p-5 lg:p-6 shadow-sm flex flex-col lg:flex-row lg:items-center gap-4 mb-4" data-cart-key="' + item.key + '">' +
      '<div class="flex items-center gap-4 flex-1">' +
        '<div class="w-[72px] h-[72px] rounded-xl overflow-hidden flex-shrink-0 bg-[#F5EADB]">' + imgHtml + '</div>' +
        '<div class="flex-1">' +
          '<h3 class="font-[\'Literata\'] text-[16px] lg:text-[18px] font-semibold text-[#2D2926] mb-1">' + item.name + '</h3>' +
          desc +
        '</div>' +
      '</div>' +
      '<div class="flex items-center gap-5 lg:gap-8">' +
        '<span class="cart-item-total text-[18px] lg:text-[20px] font-semibold text-[#2D2926] whitespace-nowrap">' + item.line_total + '</span>' +
        renderQtyControls(item) +
        renderRemoveBtn() +
      '</div>' +
    '</div>';
  }

  function renderQtyControls(item) {
    return '<div class="flex items-center gap-0">' +
      '<button class="cart-qty-btn cart-qty-minus w-10 h-10 rounded-l-xl border border-[#E0D6CC] bg-[#FAF6EF] flex items-center justify-center text-[#2D2926] text-lg font-medium hover:bg-[#F0E8DD] transition" aria-label="Уменьшить количество">−</button>' +
      '<span class="cart-qty-value w-12 h-10 flex items-center justify-center border-y border-[#E0D6CC] bg-white text-[16px] font-medium text-[#2D2926]">' + item.quantity + '</span>' +
      '<button class="cart-qty-btn cart-qty-plus w-10 h-10 rounded-r-xl border border-[#E0D6CC] bg-[#FAF6EF] flex items-center justify-center text-[#2D2926] text-lg font-medium hover:bg-[#F0E8DD] transition" aria-label="Увеличить количество">+</button>' +
    '</div>';
  }

  function renderRemoveBtn() {
    return '<button class="cart-remove-btn w-8 h-8 flex items-center justify-center text-[#E8872C] hover:text-[#D1731F] transition" aria-label="Удалить">' +
      '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">' +
        '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>' +
      '</svg></button>';
  }

  function renderTotals(totals) {
    return '<div class="cart-section-totals bg-white rounded-2xl p-6 lg:p-8 shadow-sm">' +
      '<h2 class="font-[\'Literata\'] text-[22px] lg:text-[24px] font-semibold text-[#2D2926] mb-6">Итого по заказу</h2>' +
      '<div class="space-y-3 text-[15px] lg:text-[16px] text-[#2D2926] mb-6">' +
        '<div class="flex justify-between"><span class="cart-count-label">' + totals.count_label + '</span></div>' +
        '<div class="flex justify-between"><span>Сумма</span><span class="cart-subtotal">' + totals.subtotal + '</span></div>' +
        '<div class="flex justify-between"><span>Доставка</span><span class="text-[#6B5A4A]">рассчитывается отдельно</span></div>' +
      '</div>' +
      '<div class="border-t border-[#E0D6CC] pt-4 mb-5">' +
        '<div class="flex justify-between items-center">' +
          '<span class="text-[18px] lg:text-[20px] font-semibold text-[#2D2926]">К оплате</span>' +
          '<span class="cart-total text-[20px] lg:text-[22px] font-semibold text-[#2D2926]">' + totals.total + '</span>' +
        '</div>' +
      '</div>' +
      '<p class="text-[13px] lg:text-[14px] text-[#6B5A4A] mb-8 bg-[#FAF6EF] rounded-xl px-5 py-4 leading-relaxed">' +
        'Для билетов будет оформлено электронное подтверждение, для товаров — самовывоз или доставка.' +
      '</p>' +
      '<div class="flex flex-col items-center gap-4">' +
        '<a href="<?php echo esc_js( georgeag_get_checkout_url() ); ?>" class="btn-primary !max-w-none w-full h-[52px] rounded-xl">Оформить заказ</a>' +
        '<a href="<?php echo esc_js( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-secondary !max-w-none w-full h-[52px] rounded-xl">Продолжить выбор</a>' +
        '<button id="cart-clear-btn" class="text-[15px] font-medium text-[#6B5A4A] underline underline-offset-4 hover:text-[#E8872C] transition mt-2">Очистить корзину</button>' +
      '</div>' +
    '</div>';
  }

  function updateHeaderCount(count) {
    var headerEl = document.getElementById('header-cart-count');
    var mobileEl = document.getElementById('mobile-cart-count');
    if (headerEl) {
      headerEl.textContent = count;
      headerEl.classList.toggle('hidden', count === 0);
    }
    if (mobileEl) {
      mobileEl.textContent = count;
      mobileEl.classList.toggle('hidden', count === 0);
    }
  }

  // ——— AJAX helper ———
  function cartAjax(action, params, callback) {
    var formData = new FormData();
    formData.append('action', action);
    for (var k in params) {
      formData.append(k, params[k]);
    }
    console.log('[Cart AJAX]', action, params);
    fetch(ajaxUrl, { method: 'POST', body: formData })
      .then(function(r) { return r.json(); })
      .then(function(res) {
        console.log('[Cart AJAX response]', res);
        if (res.success) {
          callback(res.data);
        } else {
          console.error('[Cart AJAX] Error:', res.data);
        }
      })
      .catch(function(err) {
        console.error('[Cart AJAX] Fetch error:', err);
      });
  }

  // ——— Event delegation ———
  cartContent.addEventListener('click', function(e) {
    var target = e.target;

    // Walk up from click target to find the button (handles SVG child elements)
    var btn = target;
    while (btn && btn !== cartContent) {
      if (btn.classList && (btn.classList.contains('cart-qty-btn') || btn.classList.contains('cart-remove-btn') || btn.id === 'cart-clear-btn')) break;
      btn = btn.parentElement || btn.parentNode;
    }
    if (!btn || btn === cartContent) return;

    var card = btn.closest('.cart-item-card');

    // Quantity +
    if (btn.classList.contains('cart-qty-plus') && card) {
      e.preventDefault();
      var key = card.dataset.cartKey;
      var qtyEl = card.querySelector('.cart-qty-value');
      var newQty = parseInt(qtyEl.textContent) + 1;
      qtyEl.textContent = newQty;
      btn.disabled = true;
      cartAjax('georgeag_update_cart_item', { cart_item_key: key, quantity: newQty }, function(data) {
        renderCart(data);
      });
    }

    // Quantity −
    if (btn.classList.contains('cart-qty-minus') && card) {
      e.preventDefault();
      var key = card.dataset.cartKey;
      var qtyEl = card.querySelector('.cart-qty-value');
      var currentQty = parseInt(qtyEl.textContent);
      if (currentQty <= 1) return;
      var newQty = currentQty - 1;
      qtyEl.textContent = newQty;
      btn.disabled = true;
      cartAjax('georgeag_update_cart_item', { cart_item_key: key, quantity: newQty }, function(data) {
        renderCart(data);
      });
    }

    // Remove ×
    if (btn.classList.contains('cart-remove-btn') && card) {
      e.preventDefault();
      var key = card.dataset.cartKey;
      card.style.opacity = '0.4';
      card.style.pointerEvents = 'none';
      cartAjax('georgeag_remove_cart_item', { cart_item_key: key }, function(data) {
        renderCart(data);
      });
    }

    // Clear cart
    if (btn.id === 'cart-clear-btn') {
      e.preventDefault();
      if (!confirm('Очистить корзину?')) return;
      btn.disabled = true;
      cartAjax('georgeag_clear_cart', {}, function(data) {
        renderCart(data);
      });
    }
  });
});
</script>

<?php get_footer(); ?>
