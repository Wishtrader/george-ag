<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GeorgeAG
 */

?>

<footer id="contacts" class="bg-[#F2E8DA] text-black pt-16 pb-8">
  <div class="container-main">
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
      <!-- Logo column -->
      <div>
            <!-- Logo -->
	<?php
	$logo_id = get_theme_mod('custom_logo');

	if ($logo_id) {
	  $logo_url = wp_get_attachment_image_url($logo_id, 'full');
	    echo '<a href="' . esc_url(home_url()) . '">';
	    echo '<img src="' . esc_url($logo_url) . '" ';
	    echo 'alt="' . esc_attr(get_bloginfo('name')) . '" ';
	    echo 'class="h-[34px] w-auto object-contain hover:opacity-90 transition-opacity">';
	    echo '</a>';
	  }
	?>
        <div class="flex items-center gap-3 mb-6">
          <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition" aria-label="Instagram">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg>
          </a>
          <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition" aria-label="Telegram">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
          </a>
        </div>
      </div>
      
      <!-- Navigation -->
      <div>
        <p class="text-2xl font-medium mb-5">Навигация</p>
          <?php wp_nav_menu([
              'menu' => 'main-menu',       
              'menu_class' => '',
              'container' => false,
              'link_before' => '<span class="flex items-center justify-between py-2 text-[15px] font-medium">',
              'link_after' => '</span>',
	  ]);
  ?>
      </div>
      
      <!-- Contacts -->
      <div>
        <p class="text-2xl font-medium mb-5">Контакты</p>
        <ul class="space-y-4 text-[15px] font-medium text-black">
          <li class="flex items-start gap-3">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2" class="mt-0.5 flex-shrink-0"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>Минск, пр-т Победителей, 84,<br/>2 этаж, ТЦ «Арена Сити»</span>
          </li>
          <li class="flex items-start gap-3">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2" class="mt-0.5 flex-shrink-0"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <a href="tel:+375445743082" class="hover:text-[#E8872C] transition">+375 44 574-30-82</a>
          </li>
          <li class="flex items-start gap-3">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2" class="mt-0.5 flex-shrink-0"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="m22 6-10 7L2 6"/></svg>
            <a href="mailto:naifartsmuseum@yandex.by" class="hover:text-[#E8872C] transition">naifartsmuseum@yandex.by</a>
          </li>
        </ul>
      </div>
      
      <!-- Hours -->
      <div>
        <p class="text-2xl font-medium mb-5">Часы работы</p>
        <p class="text-[15px] font-medium leading-relaxed text-black mb-6">
          сегодня музей работает с<br> 10:00 до 22:00</span>
        </p>
      </div>
    </div>
    
    <!-- Payment methods -->
    <div class="border-t border-white/10 pt-8 mb-8">
      <div class="flex flex-wrap items-center gap-4">
        <span class="text-[15px] text-[15px] mr-2">Принимаем к оплате:</span>
        <svg width="50" height="24" viewBox="0 0 50 24"><rect width="50" height="24" rx="3" fill="#fff"/><text x="25" y="15" text-anchor="middle" font-size="8" font-weight="bold" fill="#000" font-family="Arial">VISA</text></svg>
        <svg width="50" height="24" viewBox="0 0 50 24"><rect width="50" height="24" rx="3" fill="#fff"/><text x="25" y="15" text-anchor="middle" font-size="7" font-weight="bold" fill="#EB001B" font-family="Arial">MasterCard</text></svg>
        <svg width="50" height="24" viewBox="0 0 50 24"><rect width="50" height="24" rx="3" fill="#fff"/><text x="25" y="15" text-anchor="middle" font-size="7" font-weight="bold" fill="#0070C0" font-family="Arial">МИР</text></svg>
        <svg width="50" height="24" viewBox="0 0 50 24"><rect width="50" height="24" rx="3" fill="#fff"/><text x="25" y="15" text-anchor="middle" font-size="6" font-weight="bold" fill="#333" font-family="Arial">БЕЛКАРТ</text></svg>
        <svg width="50" height="24" viewBox="0 0 50 24"><rect width="50" height="24" rx="3" fill="#fff"/><text x="25" y="15" text-anchor="middle" font-size="6" font-weight="bold" fill="#333" font-family="Arial">Расчет</text></svg>
      </div>
    </div>
    
    <!-- Legal text -->
    <div class="text-[15px] text-black leading-relaxed space-y-3">
      <p>Закрытое акционерное общество «ЛАТИО» 223018, Минская обл., Минский р-н, Дзержинского с/с, 53. Юридический адрес: Минская обл., Минский р-н, Дзержинского с/с, 53, ком. 201. Республика Беларусь</p>
      <p>Режим работы ЧУП «Голас»: с 9.00 до 21.00 ежедневно. Интернет-магазина: с 9.00 до 18.00 ежедневно. Телефон для связи: +375 17 311 03 15</p>
      <p>Дата внесения сведений в Торговый реестр Республики Беларусь - 11.04.2018. № регистрации торговой службы в Торговом реестре: №0010191. Номер свидетельства о регистрации торговой службы в Торговом реестре: №0010191. Согласие на обработку персональных данных посетителей магазина при осуществлении ими покупок товаров и услуг.</p>
      <p>Доставка по городу и пригороду. Адреса пунктов выдачи — на странице доставки. Возврат товара надлежащего качества возможен в течение 14 дней со дня покупки при сохранении товарного вида, упаковки, этикеток и фабричных пломб.</p>
      <p>© Дворжак Элли, 2026. Все права защищены.</p>
    </div>
  </div>
</footer>

<!-- ============ MOBILE MENU ============ -->
<div id="mobileMenu" class="mobile-menu bg-[url('<?php echo esc_url( get_template_directory_uri() . '/img/m-menu-bg.png' ); ?>')] bg-contain">
  <div class="border-b border-[#E8D5BE]">
    <div class="container-main flex items-center justify-between py-4">
    <!-- Logo -->
    <?php
    $logo_id = get_theme_mod('custom_logo');

    if ($logo_id) {
      $logo_url = wp_get_attachment_image_url($logo_id, 'full');
        echo '<a href="' . esc_url(home_url()) . '">';
        echo '<img src="' . esc_url($logo_url) . '" ';
        echo 'alt="' . esc_attr(get_bloginfo('name')) . '" ';
        echo 'class="h-[34px] w-auto object-contain hover:opacity-90 transition-opacity">';
        echo '</a>';
      }
    ?>
      <div class="flex items-center gap-2">
       <button class="relative p-2" aria-label="Корзина">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/img/cart.svg' ); ?>" alt="cart" class="w-[30px]" />
        <span class="absolute -top-0.5 -right-0.5 text-[#E8872C] bg-[#FAF6EF] text-[13px] w-[24px] h-[24px] border border-[1px] border-[#E8872C] rounded-full flex items-center justify-center font-semibold">1</span>
      </button>
        <button id="closeMenuBtn" class="p-2" aria-label="Закрыть меню">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#3A2E24" stroke-width="2" stroke-linecap="round">
            <line x1="5" y1="5" x2="19" y2="19"/>
            <line x1="19" y1="5" x2="5" y2="19"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
  
  <nav class="container-main pt-6">
  <?php wp_nav_menu([
	'menu' => 'main-menu',       
	'menu_class' => 'divide-y divide-[#E8D5BE]',
	'container' => false,
	'link_before' => '<span class="flex items-center justify-between py-4 text-[15px] font-medium">',
  'link_after' => ' <img src="' . get_template_directory_uri() . '/img/right-arrow.svg" alt="arrow" class="w-[24px]" />
    </span>',
	  ]);
  ?>
  </nav>
  
  <!-- Contacts block in mobile menu -->
  <div class="container-main border-t border-[#E8D5BE] pt-3 pb-6 bg-[url('<?php echo esc_url( get_template_directory_uri() . '/img/m-menu-bg.png' ); ?>')] bg-cover bg-position-[center_top_5rem] bg-no-repeat">
    <h3 class="font-['Literata'] text-xl !font-light mb-5">Контакты</h3>
    <ul class="space-y-4 text-base font-medium text-[#6B5A4A] mb-8">
      <li class="flex items-start gap-3">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2" class="mt-1 flex-shrink-0"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span>Минск, пр-т Победителей, 84, 2 этаж, ТЦ «Арена Сити»</span>
      </li>
      <li class="flex items-start gap-3">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2" class="mt-1 flex-shrink-0"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        <a href="tel:+375445743082" class="text-[#3A2E24]">+375 44 574-30-82</a>
      </li>
      <li class="flex items-start gap-3">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2" class="mt-1 flex-shrink-0"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="m22 6-10 7L2 6"/></svg>
        <a href="mailto:naifartsmuseum@yandex.by" class="text-[#3A2E24]">naifartsmuseum@yandex.by</a>
      </li>
    </ul>
    
    <h3 class="font-['Literata'] text-xl !font-light mb-3">Часы работы</h3>
    <p class="text-sm font-semibold text-[#6B5A4A] mb-6">сегодня музей работает с 10:00 до 22:00</p>
    
    <div class="flex items-center gap-3 mb-8">
      <a href="#" class="w-[32px] h-[32px] rounded-full bg-[#F5EADB] flex items-center justify-center" aria-label="Instagram">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/img/instagram.png' ); ?>" />
      </a>
      <a href="#" class="w-10 h-10 rounded-full bg-[#F5EADB] flex items-center justify-center" aria-label="Telegram">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/img/tiktok.png' ); ?>" />
      </a>
    </div>
    
    <a href="#" class="btn-primary w-full">Купить билет</a>
  </div>
</div>

<!-- ============ SCRIPTS ============ -->
<script>
  const menuBtn = document.getElementById('menuBtn');
  const closeMenuBtn = document.getElementById('closeMenuBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  
  if (menuBtn) {
    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
  }
  
  if (closeMenuBtn) {
    closeMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.remove('open');
      document.body.style.overflow = '';
    });
  }
  
  // Close menu on link click (mobile)
  mobileMenu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', (e) => {
      // don't close on phone/email links
      if (link.getAttribute('href') && (link.getAttribute('href').startsWith('tel:') || link.getAttribute('href').startsWith('mailto:'))) {
        return;
      }
      mobileMenu.classList.remove('open');
      document.body.style.overflow = '';
    });
  });
</script>
<?php wp_footer(); ?>

</body>
</html>
