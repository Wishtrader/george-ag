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
    <div class="flex flex-col lg:flex-row justify-start items-start gap-9">
      <!-- Logo column -->
      <div class="flex flex-col md:flex-row w-full justify-between lg:justify-start items-start gap-9">
      <div class="min-w-[350px]">
            <!-- Logo -->
        <a href="/" class="">
          <img src="<?php echo get_template_directory_uri(); ?>/img/footer-logo.png" class="w-[340px] mb-5" />
        </a>
        <div class="flex items-center gap-3 mb-6">
          <a href="https://www.instagram.com/naifartsmuseum" class="w-10 h-10 p-[6px] flex items-center justify-center transition" aria-label="Instagram">
            <img src="<?php echo get_template_directory_uri(); ?>/img/instagram.png" class="" />
          </a>
          <a href="https://www.tiktok.com/@naifartsmuseum" class="w-10 h-10 p-[6px] flex items-center justify-center transition" aria-label="TikTok">
            <img src="<?php echo get_template_directory_uri(); ?>/img/tiktok.png" class="" />
          </a>
        </div>
              <div class="mt-9">
          <?php wp_nav_menu([
              'menu' => 'left-menu',       
              'menu_class' => '',
              'container' => false,
              'link_before' => '<span class="flex items-center justify-between mb-5 text-[15px] font-medium hover:text-[#f28a2e] transition">',
              'link_after' => '</span>',
	  ]);
          ?>
          <p class="mb-5 text-[15px] font-medium hover:text-[#f28a2e] transition">©Джордж Эйджи, 2026. Все права защищены.</p>
      </div>

      </div>
      
      <!-- Navigation -->
      <div>
        <p class="text-xl lg:text-3xl font-medium mb-5 min-w-[350px] lg:min-w-0">Навигация</p>
          <?php wp_nav_menu([
              'menu' => 'footer-menu',       
              'menu_class' => '',
              'container' => false,
              'link_before' => '<span class="flex items-center justify-between mb-5 text-[15px] font-medium hover:text-[#F28A2E] transition">',
              'link_after' => '</span>',
	  ]);
  ?>
        </div>
      </div>
      
      <!-- Contacts -->
      <div class="flex flex-col md:flex-row w-full justify-between lg:justify-start items-start gap-9">
      <div class="min-w-[350px] lg:min-w-0">
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
      <div class="min-w-[350px] lg:min-w-0">
        <p class="text-2xl font-medium mb-5">Часы работы</p>
        <p class="text-[15px] font-medium leading-relaxed text-black mb-6">
          сегодня музей работает с<br> 10:00 до 22:00</span>
        </p>
      </div>
    </div>
</div>
  <div class="border border-[#D9CCBC] border-[0.5px] mb-4 w-full"></div>
<div class="grid md:grid-cols-2 lg:grid-cols-3 mt-12 gap-5 text-[13px] lg:text-base text-black leading-[1.2] pb-[10px] lg:pb-[50px]">
  <p>
    Закрытое акционерное общество «ПАТИО» 223018, Минская обл., Минский р-н, Ждановичский с/с, 53, вблизи д.Тарасово, оф. 503.1. Свидетельство о государственной регистрации ЗАО «ПАТИО» выдано Мингорисполкомом на основании решения от 18.04.2001 № 491. УНП 100183195. Режим работы интернет-магазина: с 9.00 до 21.00 ежедневно.
  </p>
      <p>
        Дата включения сведений об интернет-магазине 5element.by в Торговый реестр Республики Беларусь - 11.04.2018, № регистрации 412542. Номер телефона работников, уполномоченных рассматривать обращения покупателей в соответствии с законодательством об обращениях граждан и юридических лиц: +375172702914 - Минский районный исполнительный комитет , отдел торговли и услуг.
  </p>
  <div>
        <p class="text-xl text-black">Принимаем к оплате</p>
        <div class="flex justify-between mt-3">
  <img src="<?php echo get_template_directory_uri() ?>/img/visa.svg" alt="payment" class="" />
  <img src="<?php echo get_template_directory_uri() ?>/img/mc.svg" alt="payment" class="" />
  <img src="<?php echo get_template_directory_uri() ?>/img/belcard.svg" alt="payment" class="" />
  <img src="<?php echo get_template_directory_uri() ?>/img/raschet.svg" alt="payment" class="" />
  <img src="<?php echo get_template_directory_uri() ?>/img/bepaid.svg" alt="payment" class="" />
        </div>
  </div>
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
