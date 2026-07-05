<?php
/**
 * Template Name: Contacts page
 * Template for Contacts page
 */

$hero_title = get_field('contacts_hero_title') ?: 'Контакты музея';
$hero_description = get_field('contacts_hero_description') ?: 'Свяжитесь с нами, запланируйте посещение музея или найдите удобный способ добраться до Naif Arts';
$hero_image = get_field('contacts_hero_image');

$address_title = get_field('contacts_address_title') ?: 'Адрес музея';
$address_text = get_field('contacts_address_text') ?: 'Минск, пр-т Победителей, 84, 2 этаж, ТЦ «Арена Сити»';
$address_map_query = get_field('contacts_address_map_query') ?: 'Минск, пр-т Победителей, 84';

$phone_title = get_field('contacts_phone_title') ?: 'Телефон';
$phone_text = get_field('contacts_phone_text') ?: '+375 44 574-30-82';
$phone_link = get_field('contacts_phone_link') ?: 'tel:+375445743082';

$email_title = get_field('contacts_email_title') ?: 'E-mail';
$email_text = get_field('contacts_email_text') ?: 'naifartsmuseum@yandex.by';
$email_link = get_field('contacts_email_link') ?: 'mailto:naifartsmuseum@yandex.by';

$socials_title = get_field('contacts_socials_title') ?: 'Мы в социальных сетях';
$socials_instagram = get_field('contacts_socials_instagram') ?: 'https://www.instagram.com/naifartsmuseum';
$socials_tiktok = get_field('contacts_socials_tiktok') ?: 'https://www.tiktok.com/@naifartsmuseum';

$hours_title = get_field('contacts_hours_title') ?: 'Часы работы';
$hours_text = get_field('contacts_hours_text') ?: 'Музей работает с 10:00 до 22:00';

$how_to_get_title = get_field('contacts_how_to_get_title') ?: 'Как добраться';

$form_bg_image = get_field('contacts_form_bg_image');
$form_title = get_field('contacts_form_title') ?: 'Напишите нам';
$form_name_placeholder = get_field('contacts_form_name_placeholder') ?: 'Иван Иванов';
$form_phone_placeholder = get_field('contacts_form_phone_placeholder') ?: '+375 XX XXX-XX-XX';
$form_comment_placeholder = get_field('contacts_form_comment_placeholder') ?: 'Опишите, какая упаковка вам нужна...';
$form_checkbox_text = get_field('contacts_form_checkbox_text') ?: 'Я согласен (на) на обработку персональных данных';
$form_button_text = get_field('contacts_form_button_text') ?: 'Отправить заявку';

$requisites_title = get_field('contacts_requisites_title') ?: 'Реквизиты';
$requisites_text = get_field('contacts_requisites_text') ?: 'ООО "Джордж Эйджи"
УНП: 690663385
Счет: BY58PJCB30120683671000000933
ОАО "Приорбанк"
БИК: PJCVBY2X
Юридический адрес: 220062 Республика Беларусь, г.Минск, ул Ржавецкая, д.5. пом.158/2
Директор: Жуковская Полина Константиновна действующая на основании Устава';
$requisites_image = get_field('contacts_requisites_image');

$map_api_key = get_field('contacts_map_api_key') ?: '';
$map_center_lat = get_field('contacts_map_center_lat') ?: '53.9386';
$map_center_lon = get_field('contacts_map_center_lon') ?: '27.4855';
$map_zoom = get_field('contacts_map_zoom') ?: 16;
?>

<?php get_header(); ?>

<!-- ============ HERO ============ -->
<section class="mt-[40px] lg:mt-[60px] relative overflow-hidden h-[400px] lg:h-[380px]">
  <?php if ($hero_image): ?>
  <div class="absolute inset-0" style="background-image: url('<?php echo esc_url($hero_image); ?>'); background-size: cover; background-position: center;"></div>
  <?php else: ?>
  <div class="absolute inset-0 ph ph-museum"></div>
  <?php endif; ?>
  <div class="absolute inset-0 bg-black/20"></div>

  <div class="container-main relative h-full flex flex-col justify-center py-10">
    <nav class="absolute top-6 left-[20px] lg:left-[20px]">
      <ul class="breadcrumbs">
        <li><a href="/">Главная</a></li>
        <li><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="" class="breadcrumbs-separator"></li>
        <li class="breadcrumbs-current">Контакты</li>
      </ul>
    </nav>

    <div class="max-w-[540px]">
      <h1 class="text-[34px] sm:text-[44px] lg:text-[50px] leading-[1.05] mb-4 !font-medium text-[#2D2926]">
        <?php echo esc_html($hero_title); ?>
      </h1>
      <p class="text-[16px] md:text-[20px] text-[#2D2926]">
        <?php echo wp_kses_post($hero_description); ?>
      </p>
    </div>
  </div>
</section>

<!-- ============ CONTACT INFO + MAP ============ -->
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-10 lg:gap-12">
      <div class="space-y-8">
        <div>
          <h3 class="text-xl font-semibold mb-3"><?php echo esc_html($address_title); ?></h3>
          <div class="flex items-start gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2" class="mt-0.5 flex-shrink-0">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <span class="text-[16px] text-[#6B5A4A]"><?php echo esc_html($address_text); ?></span>
          </div>
        </div>

        <div>
          <h3 class="text-xl font-semibold mb-3"><?php echo esc_html($phone_title); ?></h3>
          <div class="flex items-start gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2" class="mt-0.5 flex-shrink-0">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
            <a href="<?php echo esc_url($phone_link); ?>" class="text-[16px] text-[#6B5A4A] hover:text-[#F28A2E] transition">
              <?php echo esc_html($phone_text); ?>
            </a>
          </div>
        </div>

        <div>
          <h3 class="text-xl font-semibold mb-3"><?php echo esc_html($email_title); ?></h3>
          <div class="flex items-start gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2" class="mt-0.5 flex-shrink-0">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <path d="m22 6-10 7L2 6"/>
            </svg>
            <a href="<?php echo esc_url($email_link); ?>" class="text-[16px] text-[#6B5A4A] hover:text-[#F28A2E] transition">
              <?php echo esc_html($email_text); ?>
            </a>
          </div>
        </div>

        <div>
          <h3 class="text-xl font-semibold mb-3"><?php echo esc_html($socials_title); ?></h3>
          <div class="flex items-center gap-3">
            <a href="<?php echo esc_url($socials_instagram); ?>" class="w-10 h-10 rounded-full bg-[#F5EADB] flex items-center justify-center hover:bg-[#F28A2E]/20 transition" aria-label="Instagram">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/img/instagram.png'); ?>" alt="Instagram" class="w-5 h-5">
            </a>
            <a href="<?php echo esc_url($socials_tiktok); ?>" class="w-10 h-10 rounded-full bg-[#F5EADB] flex items-center justify-center hover:bg-[#F28A2E]/20 transition" aria-label="TikTok">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/img/tiktok.png'); ?>" alt="TikTok" class="w-5 h-5">
            </a>
          </div>
        </div>

        <div>
          <h3 class="text-xl font-semibold mb-3"><?php echo esc_html($hours_title); ?></h3>
          <div class="flex items-start gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2" class="mt-0.5 flex-shrink-0">
              <circle cx="12" cy="12" r="10"/>
              <polyline points="12 6 12 12 16 14"/>
            </svg>
            <span class="text-[16px] text-[#6B5A4A]"><?php echo esc_html($hours_text); ?></span>
          </div>
        </div>
      </div>

      <div>
        <h2 class="mb-6">
          <?php echo esc_html($how_to_get_title); ?>
        </h2>
        <div id="yandex-map" class="w-full h-[400px] lg:h-[480px] rounded-2xl overflow-hidden shadow-sm bg-gray-200"></div>
      </div>
    </div>
  </div>
</section>

<!-- Yandex Maps API -->
<script src="https://api-maps.yandex.ru/2.1/?<?php echo $map_api_key ? 'apikey=' . esc_attr($map_api_key) . '&' : ''; ?>lang=ru_RU"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof ymaps === 'undefined') {
    document.getElementById('yandex-map').innerHTML = '<div class="flex items-center justify-center h-full text-[#6B5A4A]">Карта не загружена. Проверьте API-ключ.</div>';
    return;
  }

  ymaps.ready(function() {
    var address = <?php echo json_encode($address_map_query); ?>;
    var centerLat = <?php echo json_encode($map_center_lat); ?>;
    var centerLon = <?php echo json_encode($map_center_lon); ?>;
    var zoom = <?php echo json_encode($map_zoom); ?>;

    var map = new ymaps.Map('yandex-map', {
      center: [centerLat, centerLon],
      zoom: zoom,
      controls: ['zoomControl', 'fullscreenControl']
    });

    var placemark = new ymaps.Placemark([centerLat, centerLon], {
      balloonContent: address
    }, {
      preset: 'islands#orangeDotIcon',
      iconColor: '#F28A2E'
    });

    map.geoObjects.add(placemark);

    ymaps.geocode(address).then(function(res) {
      var firstGeoObject = res.geoObjects.get(0);
      if (firstGeoObject) {
        var coords = firstGeoObject.geometry.getCoordinates();
        map.setCenter(coords, zoom);
        placemark.geometry.setCoordinates(coords);
        placemark.properties.set('balloonContent', firstGeoObject.getAddressLine());
      }
    });
  });
});
</script>

<!-- ============ FORM + REQUISITES ============ -->
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-10 lg:gap-12">
      <div class="relative overflow-hidden rounded-2xl">
        <?php if ($form_bg_image): ?>
        <div class="absolute inset-0" style="background-image: url('<?php echo esc_url($form_bg_image); ?>'); background-size: cover; background-position: center;"></div>
        <div class="absolute inset-0 bg-[#FAF6EF]/80"></div>
        <?php endif; ?>
        <div class="relative p-6 lg:p-8">
          <h2 class="mb-6">
            <?php echo esc_html($form_title); ?>
          </h2>
          <form class="space-y-5">
            <div>
              <label class="block text-sm font-medium text-[#2D2926] mb-2">Ваше имя</label>
              <input type="text" 
                     placeholder="<?php echo esc_attr($form_name_placeholder); ?>" 
                     class="w-full px-4 py-3 rounded-xl border border-[#E8D5BE] bg-white text-[#2D2926] placeholder-[#9B8B7A] focus:outline-none focus:border-[#F28A2E] transition">
            </div>
            <div>
              <label class="block text-sm font-medium text-[#2D2926] mb-2">Телефон</label>
              <input type="tel" 
                     placeholder="<?php echo esc_attr($form_phone_placeholder); ?>" 
                     class="w-full px-4 py-3 rounded-xl border border-[#E8D5BE] bg-white text-[#2D2926] placeholder-[#9B8B7A] focus:outline-none focus:border-[#F28A2E] transition">
            </div>
            <div>
              <label class="block text-sm font-medium text-[#2D2926] mb-2">Комментарий (не обязательно)</label>
              <textarea rows="4" 
                        placeholder="<?php echo esc_attr($form_comment_placeholder); ?>" 
                        class="w-full px-4 py-3 rounded-xl border border-[#E8D5BE] bg-white text-[#2D2926] placeholder-[#9B8B7A] focus:outline-none focus:border-[#F28A2E] transition resize-none"></textarea>
            </div>
            <div class="flex items-start gap-3">
              <input type="checkbox" id="privacy" class="mt-1 w-4 h-4 accent-[#F28A2E]">
              <label for="privacy" class="text-sm text-[#6B5A4A]">
                <?php echo esc_html($form_checkbox_text); ?>
              </label>
            </div>
            <button type="submit" class="btn-primary w-full">
              <?php echo esc_html($form_button_text); ?>
            </button>
          </form>
        </div>
      </div>

      <div class="relative overflow-hidden rounded-2xl">
        <?php if ($requisites_image): ?>
        <div class="absolute inset-0" style="background-image: url('<?php echo esc_url($requisites_image); ?>'); background-size: cover; background-position: center;"></div>
        <div class="absolute inset-0 bg-[#FAF6EF]/80"></div>
        <?php endif; ?>
        <div class="relative p-6 lg:p-8">
          <h2 class="mb-6">
            <?php echo esc_html($requisites_title); ?>
          </h2>
          <div class="text-[16px] text-[#6B5A4A] leading-relaxed whitespace-pre-line">
            <?php echo nl2br(esc_html($requisites_text)); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
