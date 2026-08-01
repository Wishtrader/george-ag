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
            <img src="<?php echo get_template_directory_uri(); ?>/img/location-outline.svg" class="" alt="pin" />
            <span>Минск, пр-т Победителей, 84,<br/>2 этаж, ТЦ «Арена Сити»</span>
          </li>
          <li class="flex items-start gap-3">
            <img src="<?php echo get_template_directory_uri(); ?>/img/call-outline.svg" class="" alt="call" />
            <a href="tel:+375445743082" class="hover:text-[#E8872C] transition">+375 44 574-30-82</a>
          </li>
          <li class="flex items-start gap-3">
            <img src="<?php echo get_template_directory_uri(); ?>/img/mail-outline.svg" class="" alt="mail" />
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
       <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="relative p-2" aria-label="Корзина">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/img/cart.svg' ); ?>" alt="cart" class="w-[30px]" />
        <span id="mobile-cart-count" class="absolute -top-0.5 -right-0.5 text-[#E8872C] bg-[#FAF6EF] text-[13px] w-[24px] h-[24px] border border-[1px] border-[#E8872C] rounded-full flex items-center justify-center font-semibold <?php echo WC()->cart->get_cart_contents_count() === 0 ? 'hidden' : ''; ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
      </a>
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
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  if (window.innerWidth < 768) {
    new Swiper('.preview-swiper', {
      slidesPerView: 1,
      spaceBetween: 12,
      pagination: {
        el: '.preview-swiper .swiper-pagination',
        clickable: true,
      },
    });

    new Swiper('.upcoming-swiper', {
      slidesPerView: 1,
      spaceBetween: 0,
      navigation: {
        prevEl: '.upcoming-nav-prev',
        nextEl: '.upcoming-nav-next',
      },
    });

    new Swiper('.expositions-swiper', {
      slidesPerView: 1.15,
      spaceBetween: 8,
    });

    new Swiper('.about-expositions-swiper', {
      slidesPerView: 1.15,
      spaceBetween: 8,
    });

    new Swiper('.classes-swiper', {
      slidesPerView: 1,
      spaceBetween: 0,
      navigation: {
        prevEl: '.classes-nav-prev',
        nextEl: '.classes-nav-next',
      },
    });

    new Swiper('.shop-swiper', {
      slidesPerView: 1,
      spaceBetween: 0,
      navigation: {
        prevEl: '.shop-nav-prev',
        nextEl: '.shop-nav-next',
      },
    });

    new Swiper('.about-shop-swiper', {
      slidesPerView: 1,
      spaceBetween: 0,
      navigation: {
        prevEl: '.about-shop-nav-prev',
        nextEl: '.about-shop-nav-next',
      },
    });

    new Swiper('.about-events-swiper', {
      slidesPerView: 1,
      spaceBetween: 0,
      navigation: {
        prevEl: '.about-events-nav-prev',
        nextEl: '.about-events-nav-next',
      },
    });
  }
</script>
<?php wp_footer(); ?>

<script>
(function(){
var EASE = "cubic-bezier(0.25, 0.1, 0.25, 1)";
var done = new WeakSet();

function anim(el, kf, dur, delay) {
  if (!el || done.has(el)) return;
  done.add(el);
  el.style.removeProperty("opacity");
  el.style.removeProperty("transform");
  el.classList.add("m-ready");
  el.animate(kf, { duration: dur, delay: delay, fill: "both", easing: EASE });
}

function kfFor(type) {
  switch(type) {
    case "up":    return [{opacity:0,transform:"translateY(40px)"},{opacity:1,transform:"translateY(0)"}];
    case "left":  return [{opacity:0,transform:"translateX(-50px)"},{opacity:1,transform:"translateX(0)"}];
    case "right": return [{opacity:0,transform:"translateX(50px)"},{opacity:1,transform:"translateX(0)"}];
    case "scale": return [{opacity:0,transform:"scale(0.9)"},{opacity:1,transform:"scale(1)"}];
    case "fade":  return [{opacity:0},{opacity:1}];
    default:      return [{opacity:0},{opacity:1}];
  }
}

function animEl(el, type, delay, dur) {
  anim(el, kfFor(type), (dur||1)*1000, (delay||0)*1000);
}

function animNodes(nodes, baseDelay, stagger, dur) {
  nodes.forEach(function(el, i) {
    animEl(el, el.getAttribute("data-m") || "up", baseDelay + i * stagger, dur);
  });
}

function observeSection(el, callback) {
  if (!el) return;
  var obs = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if (e.isIntersecting) {
        callback(e.target);
        obs.unobserve(e.target);
      }
    });
  }, { rootMargin: "0px 0px -50px 0px", threshold: 0.05 });
  obs.observe(el);
}

/* ── HEADER — smooth slide down ────────────────────────── */
document.querySelectorAll('[data-m="header"]').forEach(function(el, i) {
  anim(el, [
    {opacity: 0, transform: "translateY(-15px)"},
    {opacity: 1, transform: "translateY(0)"}
  ], 900, i * 120);
});

var h1 = document.querySelector("h1");
if (!h1) return;
var hero = h1.closest("section") || h1.parentElement;

/* ── HERO — pure fade-in on all pages ─────────────────── */
animEl(h1, "fade", 0.3, 1.0);

var col = h1.parentElement;
if (col) {
  var p = col.querySelector("p");
  if (p) animEl(p, "fade", 0.5, 1.0);
  col.querySelectorAll("a").forEach(function(a, i) {
    animEl(a, "fade", 0.7 + i * 0.15, 0.8);
  });
}

hero.querySelectorAll("img").forEach(function(img) {
  animEl(img, "fade", 0.2, 1.2);
});

// Background image div (div with background-image style or .ph-* placeholder)
var heroBgDiv = hero.querySelector(".absolute.inset-0");
if (heroBgDiv && !heroBgDiv.querySelector("img")) {
  animEl(heroBgDiv, "fade", 0, 1.2);
}
var ph = hero.querySelector(".ph-hero, .ph-museum");
if (ph) animEl(ph, "fade", 0, 1.2);

/* ── UNIVERSAL SCROLL SECTIONS ──────────────────────── */
function animSection(s) {
  var container = s.querySelector(".container-main");
  if (!container) return;

  // h2 titles
  s.querySelectorAll("h2").forEach(function(h2) {
    if (h2.closest(".swiper")) return;
    animEl(h2, "up", 0, 1.2);
  });

  // Left/right two-column layouts (image + text)
  var grid = s.querySelector(".grid");
  if (grid && grid.children.length === 2) {
    var left = grid.children[0];
    var right = grid.children[1];
    var leftImg = left.querySelector("img, [class*='ph-']");
    var leftH2 = left.querySelector("h2");
    var rightImg = right.querySelector("img, [class*='ph-']");
    var rightH2 = right.querySelector("h2");
    if (leftImg && rightH2) {
      animEl(leftImg, "left", 0.2, 1.3);
      animEl(right, "right", 0.2, 1.3);
    } else if (rightImg && leftH2) {
      animEl(left, "left", 0.2, 1.3);
      animEl(rightImg, "right", 0.2, 1.3);
    } else {
      animEl(left, "left", 0.2, 1.3);
      animEl(right, "right", 0.2, 1.3);
    }
  }

  // Card grids (3 or 4 columns)
  var cards = [];
  s.querySelectorAll(".grid > div").forEach(function(c) {
    if (c.closest(".swiper")) return;
    if (c.querySelector("h3") || c.querySelector("h2") || c.querySelector("img")) cards.push(c);
  });
  if (cards.length > 0) {
    animNodes(cards, 0.3, 0.12, 1.0);
  }

  // Full-width images / placeholders
  s.querySelectorAll("img, [class*='ph-']").forEach(function(img) {
    if (img.closest(".grid") || img.closest(".swiper") || img.closest("nav") || img.closest("button")) return;
    if (img.closest(".container-main") && !img.querySelector("h2")) {
      animEl(img, "scale", 0.2, 1.4);
    }
  });

  // CTA sections (bg image + h2 + buttons)
  var bgImg = s.querySelector("[class*='bg-'] img, [class*='ph-']");
  if (bgImg && s.querySelector("h2") && (s.querySelector(".btn-primary") || s.querySelector(".btn-secondary"))) {
    animEl(bgImg, "scale", 0.1, 1.6);
    s.querySelectorAll("h2, .btn-primary, .btn-secondary").forEach(function(el) {
      animEl(el, "up", 0.3, 1.2);
    });
  }

  // Practical info cards (icon + label + value rows)
  var infoRows = [];
  s.querySelectorAll("h3").forEach(function(h3) {
    var parent = h3.closest(".bg-white") || h3.closest(".rounded-3xl") || h3.closest("[class*='bg-']");
    if (parent && parent.querySelector("img")) {
      infoRows.push(parent);
    }
  });
  if (infoRows.length > 0) {
    animNodes(infoRows, 0.3, 0.15, 1.0);
  }

  // Subscription cards
  s.querySelectorAll("template-parts/subscription-card, [class*='subscription']").forEach(function(card) {
    animEl(card, "up", 0.3, 1.0);
  });
}

// Observe ALL sections except hero
document.querySelectorAll("section").forEach(function(s) {
  if (s === hero) return;
  if (s.querySelector("h1")) return;
  if (s.closest("header") || s.closest("footer")) return;
  observeSection(s, function() { animSection(s); });
});

})();
</script>

</body>
</html>
