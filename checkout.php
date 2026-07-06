<?php
/**
 * Template Name: Оформление заказа
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	get_header();
	echo '<div class="container-main py-16 text-center"><h1>Оформление заказа недоступно</h1><p>WooCommerce не активен.</p></div>';
	get_footer();
	return;
}

$cart = WC()->cart;

if ( $cart->is_empty() ) {
	wp_redirect( wc_get_cart_url() );
	exit;
}

$all_items   = $cart->get_cart();
$book_items  = array();
$ticket_items = array();
foreach ( $all_items as $key => $item ) {
	$item_terms = wp_get_post_terms( $item['product_id'], 'product_cat', array( 'fields' => 'slugs' ) );
	if ( ! is_wp_error( $item_terms ) && in_array( 'knigi', $item_terms, true ) ) {
		$book_items[ $key ] = $item;
	} else {
		$ticket_items[ $key ] = $item;
	}
}

$total   = wc_price( $cart->get_total( 'edit' ) );
$cart_url = wc_get_cart_url();

get_header();
?>

<!-- ============ CHECKOUT SECTION ============ -->
<section class="py-10 lg:py-16">
  <div class="container-main max-w-[960px]">

    <!-- Title -->
    <h1 class="text-[34px] lg:text-[50px] text-[#2D2926] mb-10">
      Оформление заказа
    </h1>

    <!-- ============ STEP INDICATORS ============ -->
    <div class="flex items-center gap-0 mb-12 overflow-x-auto no-scrollbar" id="step-indicators">
      <div class="flex items-center gap-3 flex-shrink-0">
        <span class="step-circle w-[41px] h-[41px] lg:w-[82px] lg:h-[82px] flex items-center justify-center rounded-full bg-[#F2E8DA] border-2 border-[#DA7421] text-[#DA7421] text-[26px] lg:text-[48px] font-semibold" data-step="1">1</span>
        <span class="step-label text-[16px] lg:text-[18px] font-medium text-[#2D2926]">Контакты</span>
      </div>
      <div class="w-12 lg:w-20 h-px bg-[#D6C9BC] mx-3 flex-shrink-0"></div>
      <div class="flex items-center gap-3 flex-shrink-0">
        <span class="step-circle w-[41px] h-[41px] lg:w-[82px] lg:h-[82px] flex items-center justify-center rounded-full bg-transparent border-2 border-[#D9CCBC] text-[#7C6E63] text-[26px] lg:text-[48px] font-semibold" data-step="2">2</span>
        <span class="step-label text-[16px] lg:text-[18px] font-medium text-[#9B8E82]">Получение</span>
      </div>
      <div class="w-12 lg:w-20 h-px bg-[#D6C9BC] mx-3 flex-shrink-0"></div>
      <div class="flex items-center gap-3 flex-shrink-0">
        <span class="step-circle w-[41px] h-[41px] lg:w-[82px] lg:h-[82px] flex items-center justify-center rounded-full bg-transparent border-2 border-[#D9CCBC] text-[#7C6E63] text-[26px] lg:text-[48px] font-semibold" data-step="3">3</span>
        <span class="step-label text-[16px] lg:text-[18px] font-medium text-[#9B8E82]">Оплата</span>
      </div>
      <div class="w-12 lg:w-20 h-px bg-[#D6C9BC] mx-3 flex-shrink-0"></div>
      <div class="flex items-center gap-3 flex-shrink-0">
        <span class="step-circle w-[41px] h-[41px] lg:w-[82px] lg:h-[82px] flex items-center justify-center rounded-full bg-transparent border-2 border-[#D9CCBC] text-[#7C6E63] text-[26px] lg:text-[48px] font-semibold" data-step="4">4</span>
        <span class="step-label text-[16px] lg:text-[18px] font-medium text-[#9B8E82]">Подтверждение</span>
      </div>
    </div>

    <!-- ============ STEP 1: CONTACTS ============ -->
    <div id="checkout-step-contacts" class="checkout-step">
      <div class="rounded-3xl border border-[#D9CCBC] bg-[#F2E8DA] p-6 lg:p-10 mb-8">
        <h2 class="font-['Literata'] text-[20px] lg:text-[36px] font-semibold text-[#2D2926] mb-2">
          Контактные данные
        </h2>
        <p class="text-[14px] lg:text-[15px] text-[#6B5A4A] mb-8">
          Укажите информацию для оформления заказа
        </p>

        <form id="checkout-form" class="space-y-6">
          <?php wp_nonce_field( 'georgeag_checkout_nonce', 'georgeag_checkout_nonce_field' ); ?>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
              <label for="checkout-name" class="block text-[14px] lg:text-[15px] font-medium text-[#2D2926] mb-2">Ваше имя</label>
              <input type="text" id="checkout-name" name="checkout_name" required
                class="w-full h-[50px] px-4 rounded-[6px] border border-[#E0D6CC] bg-[#FAF6EF] text-[#2D2926] text-[15px] placeholder-[#B8A99A] focus:border-[#E8872C] focus:outline-none transition"
                placeholder="Иван Иванов">
            </div>
            <div>
              <label for="checkout-phone" class="block text-[14px] lg:text-[15px] font-medium text-[#2D2926] mb-2">Телефон</label>
              <input type="tel" id="checkout-phone" name="checkout_phone" required
                class="w-full h-[50px] px-4 rounded-[6px] border border-[#E0D6CC] bg-[#FAF6EF] text-[#2D2926] text-[15px] placeholder-[#B8A99A] focus:border-[#E8872C] focus:outline-none transition"
                placeholder="+375 (XX) XXX-XX-XX"
                data-mask="+375 (XX) XXX-XX-XX">
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
              <label for="checkout-email" class="block text-[14px] lg:text-[15px] font-medium text-[#2D2926] mb-2">E-mail</label>
              <input type="email" id="checkout-email" name="checkout_email" required
                class="w-full h-[50px] px-4 rounded-[6px] border border-[#E0D6CC] bg-[#FAF6EF] text-[#2D2926] text-[15px] placeholder-[#B8A99A] focus:border-[#E8872C] focus:outline-none transition"
                placeholder="example@mail.com">
            </div>
            <div class="flex items-end">
              <p class="text-[13px] lg:text-[14px] text-[#9B8E82] leading-snug pb-1">
                Телефон и e-mail нужны для подтверждения заказа и связи по деталям.
              </p>
            </div>
          </div>

          <div>
            <label for="checkout-comment" class="block text-[14px] lg:text-[15px] font-medium text-[#2D2926] mb-2">Комментарий к заказу (необязательно)</label>
            <textarea id="checkout-comment" name="checkout_comment" rows="3"
              class="w-full px-4 py-3 rounded-[6px] border border-[#E0D6CC] bg-[#FAF6EF] text-[#2D2926] text-[15px] placeholder-[#B8A99A] focus:border-[#E8872C] focus:outline-none transition resize-none"
              placeholder="Дополнительная информация..."></textarea>
          </div>

          <div class="flex items-start gap-3">
                <input type="checkbox" id="checkout-consent" name="checkout_consent" required checked
              class="mt-1 w-5 h-5 rounded border-[#E0D6CC] text-[#E8872C] focus:ring-[#E8872C] accent-[#E8872C]">
            <label for="checkout-consent" class="text-[14px] lg:text-[15px] text-[#2D2926] leading-snug">
              Я согласен (на) на обработку <a href="#" class="underline underline-offset-2 hover:text-[#E8872C] transition">персональных данных</a>
            </label>
          </div>

          <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
            <a href="<?php echo esc_url( $cart_url ); ?>"
               class="btn-secondary !max-w-none w-full sm:w-[240px] h-[52px] rounded-xl">
              Вернуться в корзину
            </a>
            <button type="submit" id="checkout-submit"
               class="btn-primary !max-w-none w-full sm:w-[240px] h-[52px] rounded-xl">
              Продолжить
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- ============ STEP 2: DELIVERY ============ -->
    <div id="checkout-step-delivery" class="checkout-step hidden">
      <div class="rounded-3xl border border-[#D9CCBC] bg-[#F2E8DA] p-6 lg:p-10 mb-8">

        <!-- Tickets — electronic -->
        <h2 class="font-['Literata'] text-[20px] lg:text-[36px] font-semibold text-[#2D2926] mb-6">
          Как вы получите билет
        </h2>

        <div class="bg-white rounded-2xl p-5 lg:p-6 mb-10">
          <h3 class="font-['Literata'] text-[18px] lg:text-[20px] font-semibold text-[#2D2926] mb-2">Электронный билет на e-mail</h3>
          <p class="text-[14px] lg:text-[15px] text-[#6B5A4A] leading-snug">После оформления мы отправим подтверждение, электронные билеты и детали посещения.</p>
        </div>

        <!-- Products — delivery method -->
        <h2 class="font-['Literata'] text-[20px] lg:text-[36px] font-semibold text-[#2D2926] mb-6">
          Как вы хотите получить товары
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
          <label class="delivery-option flex items-start gap-3 p-5 rounded-2xl border-2 border-[#E8872C] cursor-pointer bg-white">
            <input type="radio" name="delivery_method" value="pickup" checked class="mt-1 w-5 h-5 accent-[#E8872C]">
            <div>
              <span class="text-[16px] font-medium text-[#2D2926]">Самовывоз из музея</span>
              <span class="block text-[14px] text-[#6B5A4A] mt-1 leading-snug">Бесплатно. Забрать можно в часы работы музея.</span>
            </div>
          </label>
          <label class="delivery-option flex items-start gap-3 p-5 rounded-2xl border-2 border-[#E0D6CC] cursor-pointer hover:border-[#E8872C] transition bg-white">
            <input type="radio" name="delivery_method" value="delivery" class="mt-1 w-5 h-5 accent-[#E8872C]">
            <div>
              <span class="text-[16px] font-medium text-[#2D2926]">Доставка</span>
              <span class="block text-[14px] text-[#6B5A4A] mt-1 leading-snug">По тарифам службы доставки (около 15 BYN).</span>
            </div>
          </label>
        </div>

        <!-- Pickup address -->
        <div id="pickup-address" class="bg-white rounded-2xl p-5 lg:p-6 mb-8">
          <h3 class="font-['Literata'] text-[18px] lg:text-[20px] font-semibold text-[#2D2926] mb-2">Адрес для самовывоза:</h3>
          <p class="text-[14px] lg:text-[15px] text-[#6B5A4A] leading-snug">г. Минск, пр-т Победителей, 84, 2 этаж, ТЦ «Арена Сити»</p>
        </div>

        <!-- Delivery address form (hidden by default) -->
        <div id="delivery-address-field" class="hidden mb-8">
          <h2 class="font-['Literata'] text-[20px] lg:text-[36px] font-semibold text-[#2D2926] mb-6">
            Адрес доставки
          </h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
              <label for="delivery-city" class="block text-[14px] lg:text-[15px] font-medium text-[#2D2926] mb-2">Город</label>
              <input type="text" id="delivery-city" name="delivery_city"
                class="w-full h-[50px] px-4 rounded-[6px] border border-[#E0D6CC] bg-[#FAF6EF] text-[#2D2926] text-[15px] placeholder-[#B8A99A] focus:border-[#E8872C] focus:outline-none transition"
                placeholder="Минск">
            </div>
            <div>
              <label for="delivery-street" class="block text-[14px] lg:text-[15px] font-medium text-[#2D2926] mb-2">Улица</label>
              <input type="text" id="delivery-street" name="delivery_street"
                class="w-full h-[50px] px-4 rounded-[6px] border border-[#E0D6CC] bg-[#FAF6EF] text-[#2D2926] text-[15px] placeholder-[#B8A99A] focus:border-[#E8872C] focus:outline-none transition"
                placeholder="ул. Ленина">
            </div>
          </div>

          <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
              <label for="delivery-house" class="block text-[14px] lg:text-[15px] font-medium text-[#2D2926] mb-2">Дом</label>
              <input type="text" id="delivery-house" name="delivery_house"
                class="w-full h-[50px] px-4 rounded-[6px] border border-[#E0D6CC] bg-[#FAF6EF] text-[#2D2926] text-[15px] placeholder-[#B8A99A] focus:border-[#E8872C] focus:outline-none transition"
                placeholder="1">
            </div>
            <div>
              <label for="delivery-apartment" class="block text-[14px] lg:text-[15px] font-medium text-[#2D2926] mb-2">Квартира / офис</label>
              <input type="text" id="delivery-apartment" name="delivery_apartment"
                class="w-full h-[50px] px-4 rounded-[6px] border border-[#E0D6CC] bg-[#FAF6EF] text-[#2D2926] text-[15px] placeholder-[#B8A99A] focus:border-[#E8872C] focus:outline-none transition"
                placeholder="1">
            </div>
          </div>

          <div>
            <label for="delivery-courier-comment" class="block text-[14px] lg:text-[15px] font-medium text-[#2D2926] mb-2">Комментарий для курьера (необязательно)</label>
            <input type="text" id="delivery-courier-comment" name="delivery_courier_comment"
              class="w-full h-[50px] px-4 rounded-[6px] border border-[#E0D6CC] bg-[#FAF6EF] text-[#2D2926] text-[15px] placeholder-[#B8A99A] focus:border-[#E8872C] focus:outline-none transition"
              placeholder="Код домофона, этаж...">
          </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
          <a href="<?php echo esc_url( $cart_url ); ?>"
             class="btn-secondary !max-w-none w-full sm:w-[240px] h-[52px] rounded-xl">
            Вернуться в корзину
          </a>
          <button type="button" id="step2-next"
             class="btn-primary !max-w-none w-full sm:w-[240px] h-[52px] rounded-xl">
            Продолжить
          </button>
        </div>
      </div>
    </div>

    <!-- ============ STEP 3: PAYMENT ============ -->
    <div id="checkout-step-payment" class="checkout-step hidden">
      <div class="rounded-3xl border border-[#D9CCBC] bg-[#F2E8DA] p-6 lg:p-10 mb-8">
        <h2 class="font-['Literata'] text-[20px] lg:text-[36px] font-semibold text-[#2D2926] mb-6">
          Способ оплаты
        </h2>

        <div class="space-y-4 mb-8">
          <label class="payment-option flex items-start gap-4 p-5 rounded-2xl border-2 border-[#E8872C] cursor-pointer bg-white">
            <input type="radio" name="payment_method" value="online_card" checked class="mt-1 w-5 h-5 accent-[#E8872C]">
            <div>
              <span class="text-[16px] font-medium text-[#2D2926]">Онлайн-оплата картой</span>
              <span class="block text-[14px] text-[#6B5A4A] mt-1 leading-snug">Оплата банковской картой Visa, Mastercard, Белкарт.</span>
            </div>
          </label>
          <label class="payment-option flex items-start gap-4 p-5 rounded-2xl border-2 border-[#E0D6CC] cursor-pointer hover:border-[#E8872C] transition">
            <input type="radio" name="payment_method" value="erip" class="mt-1 w-5 h-5 accent-[#E8872C]">
            <div>
              <span class="text-[16px] font-medium text-[#2D2926]">Оплата через ЕРИП</span>
              <span class="block text-[14px] text-[#6B5A4A] mt-1 leading-snug">Удобная оплата через интернет-банкинг или мобильное приложение.</span>
            </div>
          </label>
          <label class="payment-option flex items-start gap-4 p-5 rounded-2xl border-2 border-[#E0D6CC] cursor-pointer hover:border-[#E8872C] transition">
            <input type="radio" name="payment_method" value="cash" class="mt-1 w-5 h-5 accent-[#E8872C]">
            <div>
              <span class="text-[16px] font-medium text-[#2D2926]">Оплата при получении</span>
              <span class="block text-[14px] text-[#6B5A4A] mt-1 leading-snug">Наличными или банковской картой при самовывозе из музея.</span>
            </div>
          </label>
          <label class="payment-option flex items-start gap-4 p-5 rounded-2xl border-2 border-[#E0D6CC] cursor-pointer hover:border-[#E8872C] transition">
            <input type="radio" name="payment_method" value="invoice" class="mt-1 w-5 h-5 accent-[#E8872C]">
            <div>
              <span class="text-[16px] font-medium text-[#2D2926]">Оплата по счёту</span>
              <span class="block text-[14px] text-[#6B5A4A] mt-1 leading-snug">Для юридических лиц и организаций.</span>
            </div>
          </label>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
          <button type="button" id="step3-back"
             class="btn-secondary !max-w-none w-full sm:w-[240px] h-[52px] rounded-xl">
            Вернуться в корзину
          </button>
          <button type="button" id="step3-next"
             class="btn-primary !max-w-none w-full sm:w-[240px] h-[52px] rounded-xl">
            Продолжить
          </button>
        </div>
      </div>
    </div>

    <!-- ============ STEP 4: CONFIRMATION ============ -->
    <div id="checkout-step-confirm" class="checkout-step hidden">

      <!-- Контактные данные -->
      <div class="rounded-3xl border border-[#D9CCBC] bg-[#F2E8DA] p-6 lg:p-10 mb-4">
        <div class="flex items-center justify-between mb-6">
          <h2 class="font-['Literata'] text-[20px] lg:text-[36px] font-semibold text-[#2D2926]">Контактные данные</h2>
          <button type="button" class="step-edit-btn text-[15px] font-medium text-[#E8872C] underline underline-offset-4 hover:text-[#D1731F] transition" data-goto="1">Изменить</button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-8 text-[15px]">
          <div>
            <span class="text-[#9B8E82] block mb-1">Ваше имя</span>
            <span class="text-[#2D2926] font-medium" id="confirm-name">—</span>
          </div>
          <div>
            <span class="text-[#9B8E82] block mb-1">Телефон</span>
            <span class="text-[#2D2926] font-medium" id="confirm-phone">—</span>
          </div>
          <div>
            <span class="text-[#9B8E82] block mb-1">E-mail</span>
            <span class="text-[#2D2926] font-medium" id="confirm-email">—</span>
          </div>
        </div>
      </div>

      <!-- Получение -->
      <div class="rounded-3xl border border-[#D9CCBC] bg-[#F2E8DA] p-6 lg:p-10 mb-4">
        <div class="flex items-center justify-between mb-4">
          <h2 class="font-['Literata'] text-[20px] lg:text-[36px] font-semibold text-[#2D2926]">Получение</h2>
          <button type="button" class="step-edit-btn text-[15px] font-medium text-[#E8872C] underline underline-offset-4 hover:text-[#D1731F] transition" data-goto="2">Изменить</button>
        </div>
        <p class="text-[15px] text-[#2D2926]" id="confirm-delivery-title">Электронный билет на e-mail</p>
        <p class="text-[14px] text-[#6B5A4A] mt-1" id="confirm-delivery-detail">Билеты будут отправлены на example@mail.com</p>
      </div>

      <!-- Способ оплаты -->
      <div class="rounded-3xl border border-[#D9CCBC] bg-[#F2E8DA] p-6 lg:p-10 mb-4">
        <div class="flex items-center justify-between mb-4">
          <h2 class="font-['Literata'] text-[20px] lg:text-[36px] font-semibold text-[#2D2926]">Способ оплаты</h2>
          <button type="button" class="step-edit-btn text-[15px] font-medium text-[#E8872C] underline underline-offset-4 hover:text-[#D1731F] transition" data-goto="3">Изменить</button>
        </div>
        <p class="text-[15px] text-[#2D2926]" id="confirm-payment">—</p>
      </div>

      <!-- Состав заказа -->
      <div class="rounded-3xl border border-[#D9CCBC] bg-[#F2E8DA] p-6 lg:p-10 mb-4">
        <div class="flex items-center justify-between mb-4">
          <h2 class="font-['Literata'] text-[20px] lg:text-[36px] font-semibold text-[#2D2926]">Состав заказа</h2>
          <a href="<?php echo esc_url( $cart_url ); ?>" class="text-[15px] font-medium text-[#E8872C] underline underline-offset-4 hover:text-[#D1731F] transition">В корзину</a>
        </div>
        <div id="confirm-items" class="space-y-2 text-[15px] text-[#2D2926]"></div>
      </div>

      <!-- Ваш заказ -->
      <div class="rounded-3xl border border-[#D9CCBC] bg-[#F2E8DA] p-6 lg:p-10 mb-4">
        <h2 class="font-body text-[20px] lg:text-[28px] font-semibold text-[#2D2926] mb-6">Ваш заказ</h2>
        <div id="confirm-order-lines" class="space-y-3 mb-4"></div>
        <div id="confirm-order-items" class="space-y-4 mb-6">
          <?php foreach ( $ticket_items as $item ) :
            $product = $item['data'];
            $name    = $product->get_name();
            $qty     = $item['quantity'];
            $price   = wc_price( $item['line_total'] );
          ?>
          <div class="flex justify-between items-start gap-4 text-[15px] text-[#2D2926]">
            <span class="flex-1"><?php echo esc_html( $name ); ?><?php if ( $qty > 1 ) echo ' x' . esc_html( $qty ); ?></span>
            <span class="font-medium whitespace-nowrap"><?php echo wp_kses_post( $price ); ?></span>
          </div>
          <?php endforeach; ?>
          <?php foreach ( $book_items as $item ) :
            $product = $item['data'];
            $name    = $product->get_name();
            $qty     = $item['quantity'];
            $price   = wc_price( $item['line_total'] );
          ?>
          <div class="flex justify-between items-start gap-4 text-[15px] text-[#2D2926]">
            <span class="flex-1"><?php echo esc_html( $name ); ?><?php if ( $qty > 1 ) echo ' x' . esc_html( $qty ); ?></span>
            <span class="font-medium whitespace-nowrap"><?php echo wp_kses_post( $price ); ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Итого -->
      <div class="rounded-3xl border border-[#D9CCBC] bg-[#F2E8DA] p-6 lg:p-10">
        <h2 class="font-['Literata'] text-[20px] lg:text-[36px] font-semibold text-[#2D2926] mb-6">Итого</h2>

        <div class="space-y-3 text-[15px] text-[#2D2926] mb-4">
          <div class="flex justify-between">
            <span>Товары / билеты (<?php echo esc_html( $cart->get_cart_contents_count() ); ?>)</span>
            <span class="font-medium"><?php echo wp_kses_post( wc_price( $cart->get_subtotal() ) ); ?></span>
          </div>
          <div class="flex justify-between">
            <span>Доставка</span>
            <span class="text-[#6B5A4A]">—</span>
          </div>
        </div>

        <div class="border-t border-[#D9CCBC] pt-4 mb-6">
          <div class="flex justify-between items-center">
            <span class="text-[18px] lg:text-[22px] font-semibold text-[#2D2926]">К оплате</span>
            <span class="text-[20px] lg:text-[24px] font-bold text-[#2D2926]"><?php echo wp_kses_post( $total ); ?></span>
          </div>
        </div>

        <div class="flex items-start gap-3 mb-6">
          <input type="checkbox" id="confirm-consent" checked
            class="mt-1 w-5 h-5 rounded border-[#E0D6CC] text-[#E8872C] focus:ring-[#E8872C] accent-[#E8872C]">
          <label for="confirm-consent" class="text-[14px] text-[#6B5A4A] leading-snug">
            Я согласен(а) с условиями оформления заказа и политикой конфиденциальности
          </label>
        </div>

        <button type="button" id="step4-submit"
          class="btn-primary !max-w-none w-full h-[52px] rounded-xl mb-4">
          Подтвердить заказ
        </button>
        <a href="<?php echo esc_url( $cart_url ); ?>"
          class="btn-secondary !max-w-none w-full h-[52px] rounded-xl">
          Вернуться в корзину
        </a>
      </div>

    </div>

    <!-- ============ ORDER SUMMARY (below form) ============ -->
    <div id="standalone-order-summary" class="rounded-3xl border border-[#D9CCBC] bg-[#F2E8DA] p-6 lg:p-10">
      <h2 class="!font-['Golos_Text'] text-[20px] lg:!text-[28px] !font-semibold text-[#2D2926] mb-6">
        Ваш заказ
      </h2>

      <div class="space-y-4 mb-6">
        <?php foreach ( $ticket_items as $item ) :
          $product = $item['data'];
          $name    = $product->get_name();
          $qty     = $item['quantity'];
          $price   = wc_price( $item['line_total'] );
        ?>
        <div class="flex justify-between items-start gap-4 text-[15px] text-[#2D2926]">
          <span class="flex-1"><?php echo esc_html( $name ); ?><?php if ( $qty > 1 ) echo ' x' . esc_html( $qty ); ?></span>
          <span class="font-medium whitespace-nowrap"><?php echo wp_kses_post( $price ); ?></span>
        </div>
        <?php endforeach; ?>

        <?php foreach ( $book_items as $item ) :
          $product = $item['data'];
          $name    = $product->get_name();
          $qty     = $item['quantity'];
          $price   = wc_price( $item['line_total'] );
        ?>
        <div class="flex justify-between items-start gap-4 text-[15px] text-[#2D2926]">
          <span class="flex-1"><?php echo esc_html( $name ); ?><?php if ( $qty > 1 ) echo ' x' . esc_html( $qty ); ?></span>
          <span class="font-medium whitespace-nowrap"><?php echo wp_kses_post( $price ); ?></span>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="border-t border-[#E0D6CC] pt-4 mb-4">
        <div class="flex justify-between items-center">
          <span class="text-[18px] lg:text-[20px] font-semibold text-[#2D2926]">Итого</span>
          <span class="text-[20px] lg:text-[22px] font-semibold text-[#2D2926]"><?php echo wp_kses_post( $total ); ?></span>
        </div>
      </div>

      <p class="text-[13px] lg:text-[14px] text-[#6B5A4A] bg-[#FAF6EF] rounded-xl px-5 py-4 leading-relaxed">
        Для билетов будет оформлено электронное подтверждение, для товаров — самовывоз или доставка.
      </p>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var currentStep = 1;
  var checkoutData = {};

  var steps = ['contacts', 'delivery', 'payment', 'confirm'];

  function showStep(n) {
    currentStep = n;
    document.querySelectorAll('.checkout-step').forEach(function(el) {
      el.classList.add('hidden');
    });
    var target = document.getElementById('checkout-step-' + steps[n - 1]);
    if (target) target.classList.remove('hidden');
    // Hide standalone order summary when on step 4 (it's inside step 4 now)
    var standalone = document.getElementById('standalone-order-summary');
    if (standalone) standalone.classList.toggle('hidden', n === 4);
    updateIndicators();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  function updateIndicators() {
    var container = document.getElementById('step-indicators');
    if (!container) return;
    container.querySelectorAll('.step-circle').forEach(function(circle) {
      var step = parseInt(circle.dataset.step);
      var label = circle.parentElement.querySelector('.step-label');
      if (step < currentStep) {
        // Completed — filled orange with checkmark
        circle.className = 'step-circle w-[41px] h-[41px] lg:w-[82px] lg:h-[82px] flex items-center justify-center rounded-full bg-[#E8872C] border-2 border-[#E8872C] text-white text-[26px] lg:text-[48px] font-semibold';
        circle.innerHTML = '<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/checkmark.svg" alt="" class="w-[24px] h-[24px] lg:w-[40px] lg:h-[40px]">';
        if (label) label.className = 'step-label text-[16px] lg:text-[18px] font-medium text-[#2D2926]';
      } else if (step === currentStep) {
        // Active — orange border, page bg fill
        circle.className = 'step-circle w-[41px] h-[41px] lg:w-[82px] lg:h-[82px] flex items-center justify-center rounded-full bg-[#F2E8DA] border-2 border-[#DA7421] text-[#DA7421] text-[26px] lg:text-[48px] font-semibold';
        circle.textContent = step;
        if (label) label.className = 'step-label text-[16px] lg:text-[18px] font-medium text-[#2D2926]';
      } else {
        // Inactive — transparent bg, gray border
        circle.className = 'step-circle w-[41px] h-[41px] lg:w-[82px] lg:h-[82px] flex items-center justify-center rounded-full bg-transparent border-2 border-[#D9CCBC] text-[#7C6E63] text-[26px] lg:text-[48px] font-semibold';
        circle.textContent = step;
        if (label) label.className = 'step-label text-[16px] lg:text-[18px] font-medium text-[#9B8E82]';
      }
    });
  }

  document.getElementById('checkout-form').addEventListener('submit', function(e) {
    e.preventDefault();
    checkoutData.name    = document.getElementById('checkout-name').value;
    checkoutData.phone   = document.getElementById('checkout-phone').value;
    checkoutData.email   = document.getElementById('checkout-email').value;
    checkoutData.comment = document.getElementById('checkout-comment').value;
    showStep(2);
  });

  document.getElementById('step2-next').addEventListener('click', function() {
    var radios = document.getElementsByName('delivery_method');
    for (var i = 0; i < radios.length; i++) {
      if (radios[i].checked) checkoutData.delivery = radios[i].value;
    }
    if (checkoutData.delivery === 'delivery') {
      checkoutData.city     = document.getElementById('delivery-city').value;
      checkoutData.street   = document.getElementById('delivery-street').value;
      checkoutData.house    = document.getElementById('delivery-house').value;
      checkoutData.apartment = document.getElementById('delivery-apartment').value;
      checkoutData.courierComment = document.getElementById('delivery-courier-comment').value;
      checkoutData.address = checkoutData.city + ', ул. ' + checkoutData.street + ', д. ' + checkoutData.house;
      if (checkoutData.apartment) checkoutData.address += ', кв. ' + checkoutData.apartment;
    }
    showStep(3);
  });

  document.querySelectorAll('input[name="delivery_method"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
      var pickupAddr = document.getElementById('pickup-address');
      var deliveryField = document.getElementById('delivery-address-field');
      document.querySelectorAll('input[name="delivery_method"]').forEach(function(r) {
        var lbl = r.closest('.delivery-option');
        lbl.className = r.checked
          ? 'delivery-option flex items-start gap-3 p-5 rounded-2xl border-2 border-[#E8872C] cursor-pointer bg-white'
          : 'delivery-option flex items-start gap-3 p-5 rounded-2xl border-2 border-[#E0D6CC] cursor-pointer hover:border-[#E8872C] transition bg-white';
      });
      if (this.value === 'delivery') {
        pickupAddr.classList.add('hidden');
        deliveryField.classList.remove('hidden');
      } else {
        pickupAddr.classList.remove('hidden');
        deliveryField.classList.add('hidden');
      }
    });
  });

  document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
      document.querySelectorAll('input[name="payment_method"]').forEach(function(r) {
        var lbl = r.closest('.payment-option');
        lbl.className = r.checked
          ? 'payment-option flex items-start gap-4 p-5 rounded-2xl border-2 border-[#E8872C] cursor-pointer bg-white'
          : 'payment-option flex items-start gap-4 p-5 rounded-2xl border-2 border-[#E0D6CC] cursor-pointer hover:border-[#E8872C] transition';
      });
    });
  });

  document.getElementById('step3-back').addEventListener('click', function() { showStep(2); });
  document.getElementById('step3-next').addEventListener('click', function() {
    var radios = document.getElementsByName('payment_method');
    for (var i = 0; i < radios.length; i++) {
      if (radios[i].checked) checkoutData.payment = radios[i].value;
    }
    renderConfirmation();
    showStep(4);
  });

  // "Изменить" buttons in step 4
  document.querySelectorAll('.step-edit-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var step = parseInt(this.dataset.goto);
      showStep(step);
    });
  });

  document.getElementById('step4-submit').addEventListener('click', function() {
    var consent = document.getElementById('confirm-consent');
    if (!consent.checked) {
      alert('Необходимо согласиться с условиями оформления заказа.');
      return;
    }
    submitOrder(this);
  });

  function renderConfirmation() {
    // Контактные данные
    document.getElementById('confirm-name').textContent = checkoutData.name || '—';
    document.getElementById('confirm-phone').textContent = checkoutData.phone || '—';
    document.getElementById('confirm-email').textContent = checkoutData.email || '—';

    // Получение
    var deliveryTitle = document.getElementById('confirm-delivery-title');
    var deliveryDetail = document.getElementById('confirm-delivery-detail');
    if (checkoutData.delivery === 'pickup') {
      deliveryTitle.textContent = 'Самовывоз из музея';
      deliveryDetail.textContent = 'г. Минск, пр-т Победителей, 84, 2 этаж, ТЦ «Арена Сити»';
    } else {
      deliveryTitle.textContent = 'Доставка';
      deliveryDetail.textContent = checkoutData.address || '';
    }

    // Способ оплаты
    document.getElementById('confirm-payment').textContent = getPaymentLabel(checkoutData.payment);

    // Состав заказа
    var itemsHtml = '';
    document.querySelectorAll('#confirm-order-items > div').forEach(function(row) {
      itemsHtml += '<div class="text-[15px] text-[#2D2926]">' + row.querySelector('span:first-child').textContent + '</div>';
    });
    document.getElementById('confirm-items').innerHTML = itemsHtml;
  }

  function submitOrder(btn) {
    btn.disabled = true;
    btn.textContent = 'Отправка...';

    var formData = new FormData();
    formData.append('action', 'georgeag_submit_order');
    formData.append('georgeag_checkout_nonce_field', document.querySelector('[name="georgeag_checkout_nonce_field"]').value);
    formData.append('checkout_name', checkoutData.name);
    formData.append('checkout_phone', checkoutData.phone);
    formData.append('checkout_email', checkoutData.email);
    formData.append('checkout_comment', checkoutData.comment || '');
    formData.append('delivery_method', checkoutData.delivery || 'pickup');
    formData.append('delivery_address', checkoutData.address || '');
    formData.append('delivery_city', checkoutData.city || '');
    formData.append('delivery_street', checkoutData.street || '');
    formData.append('delivery_house', checkoutData.house || '');
    formData.append('delivery_apartment', checkoutData.apartment || '');
    formData.append('delivery_courier_comment', checkoutData.courierComment || '');
    formData.append('payment_method', checkoutData.payment || 'online');

    var ajaxUrl = typeof georgeagCart !== 'undefined' ? georgeagCart.ajaxUrl : '/wp-admin/admin-ajax.php';

    fetch(ajaxUrl, { method: 'POST', body: formData })
      .then(function(r) { return r.json(); })
      .then(function(res) {
        if (res.success && res.data.redirect) {
          window.location.href = res.data.redirect;
        } else {
          alert(res.data && res.data.message ? res.data.message : 'Произошла ошибка. Попробуйте ещё раз.');
          btn.disabled = false;
          btn.textContent = 'Подтвердить заказ';
        }
      })
      .catch(function() {
        alert('Ошибка сети. Попробуйте ещё раз.');
        btn.disabled = false;
        btn.textContent = 'Подтвердить заказ';
      });
  }

  function getPaymentLabel(value) {
    var labels = {
      'online_card': 'Онлайн-оплата картой',
      'erip': 'Оплата через ЕРИП',
      'cash': 'Оплата при получении',
      'invoice': 'Оплата по счёту'
    };
    return labels[value] || value;
  }

  function escapeHtml(str) {
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
  }

  // Phone mask: +375 XX XXX-XX-XX
  var phoneInput = document.getElementById('checkout-phone');
  if (phoneInput) {
    phoneInput.addEventListener('input', function(e) {
      var raw = this.value.replace(/\D/g, '');
      if (raw.length > 0 && raw.indexOf('375') !== 0) {
        raw = '375' + raw.replace(/^0+/, '');
      }
      raw = raw.substring(0, 12);
      var d = raw.substring(3);
      var f = '+375';
      if (d.length > 0) f += ' (' + d.substring(0, 2);
      if (d.length > 2) f += ') ' + d.substring(2, 5);
      if (d.length > 5) f += '-' + d.substring(5, 7);
      if (d.length > 7) f += '-' + d.substring(7, 9);
      this.value = f;
    });
    phoneInput.addEventListener('keydown', function(e) {
      // Allow: backspace, delete, tab, escape, enter, arrows
      if ([8, 46, 9, 27, 13, 37, 38, 39, 40].indexOf(e.keyCode) !== -1) return;
      // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
      if ((e.ctrlKey || e.metaKey) && [65, 67, 86, 88].indexOf(e.keyCode) !== -1) return;
      // Block if too long (max: +375 (XX) XXX-XX-XX = 19 chars)
      if (this.value.length >= 19) e.preventDefault();
    });
  }
});
</script>

<?php get_footer(); ?>
