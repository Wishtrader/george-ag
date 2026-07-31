<?php
/**
 * Template Name: Homepage 
 * Template for home page
 */

$hero_title = get_field('hero_title');
$hero_description = get_field('hero_description');
$hero_image = get_field('hero_image');
$hero_cta_primary = get_field('hero_cta_primary');
$hero_cta_secondary = get_field('hero_cta_secondary');
$preview_events = get_field('preview_events');

$upcoming_title = get_field('upcoming_title');
$upcoming_link_text = get_field('upcoming_link_text');
$upcoming_events = get_field('upcoming_events');

usort($upcoming_events, function ($a, $b) {
	$da = parse_event_datetime($a['datetime'] ?? '');
	$db = parse_event_datetime($b['datetime'] ?? '');
	return $da - $db;
});

$about_title = get_field('about_title');
$about_description = get_field('about_description');
$about_image = get_field('about_image');
$about_image_bg = get_field('about_image_bg');

$expositions_title = get_field('expositions_title');
$expositions_link_text = get_field('expositions_link_text');
$expositions_list = get_field('expositions_list');

$special_badge = get_field('special_badge');
$special_title = get_field('special_title');
$special_description = get_field('special_description');
$special_image = get_field('special_image');
$special_button_text = get_field('special_button_text');

$classes_title = get_field('classes_title');
$classes_link_text = get_field('classes_link_text');
$classes_main = get_field('classes_main');
$classes_list = get_field('classes_list');

$shop_title = get_field('shop_title');
$shop_link_text = get_field('shop_link_text');
$shop_products = wc_get_products(array(
    'status' => 'publish',
    'limit'  => 4,
    'order'  => 'DESC',
    'orderby' => 'date',
));

$why_us_title = get_field('why_us_title');
$why_us_items = get_field('why_us_items');

$cta_background_image = get_field('cta_background_image');
$cta_background_image_mobile = get_field('cta_background_image_mobile');
$cta_title = get_field('cta_title');
$cta_primary = get_field('cta_primary');
$cta_secondary = get_field('cta_secondary');

// Парсинг строки даты события в timestamp для сортировки
function parse_event_datetime($datetime) {
	$months = array(
		'января' => 1, 'февраля' => 2, 'марта' => 3, 'апреля' => 4,
		'мая' => 5, 'июня' => 6, 'июля' => 7, 'августа' => 8,
		'сентября' => 9, 'октября' => 10, 'ноября' => 11, 'декабря' => 12,
	);
	if (preg_match('/(\d{1,2})\s+([а-яё]+)/u', $datetime, $m)) {
		$day = (int) $m[1];
		$month = $months[$m[2]] ?? null;
		if ($month) {
			return mktime(0, 0, 0, $month, $day);
		}
	}
	return 0;
}

// Вспомогательная функция для иконки типа события
function get_event_type_icon($type) {
    $icons = array(
        'masterclass' => '<img src="' . esc_url(get_template_directory_uri() . '/img/palette-line.svg') . '">',
        'lecture' => '<img src="' . esc_url(get_template_directory_uri() . '/img/book-open-line.svg') . '">',
        'meeting' => '<img src="' . esc_url(get_template_directory_uri() . '/img/chat-3-line.svg') . '">',
        'family' => '<img src="' . esc_url(get_template_directory_uri() . '/img/palette-line.svg') . '">',
    );
    return $icons[$type] ?? $icons['masterclass'];
}

// Вспомогательная функция для перевода типа события
function get_event_type_label($type) {
    $labels = array(
        'masterclass' => 'Мастер-класс',
        'lecture' => 'Лекция',
        'meeting' => 'Встреча',
        'family' => 'Семейное занятие',
    );
    return $labels[$type] ?? 'Событие';
}

// Вспомогательная функция для получения цвета типа события
function get_event_type_color($type) {
    $colors = array(
        'masterclass' => '#E8A62E',
        'lecture' => '#28B6DA',
        'meeting' => '#C61B8C',
        'family' => '#73B843',
    );
    return $colors[$type] ?? '#6B5A4A';
}
?>

<?php get_header(); ?>

<!-- ============ HERO ============ -->
<?php if ($hero_title || $hero_description || $hero_cta_primary || $hero_cta_secondary): ?>
<section class="py-10 lg:py-16 relative md:min-h-[900px] overflow-hidden h-full">
  <div class="container-main !px-2.5 lg:px-5 flex flex-col justify-between h-full">
    <div class="">
      <div class="flex flex-col md:max-w-[58%] h-full items-center lg:pt-11">
        <?php if ($hero_title): ?>
        <h1 class="text-[34px] sm:text-[44px] lg:text-[50px] !leading-[1.5] mb-5 lg:mb-7 !font-medium lg:max-w-[692px]">
          <?php echo esc_html($hero_title); ?>
        </h1>
        <?php endif; ?>
        <?php if ($hero_description): ?>
        <p class="text-[15px] md:text-[20px] text-[#2D2926] mb-7 leading-[1.2]">
          <?php echo esc_html($hero_description); ?>
        </p>
        <?php endif; ?>
        <div class="flex flex-col sm:flex-row gap-3 justify-between w-full mb-10 md:mb-0">
          <?php if ($hero_cta_primary): ?>
            <a href="/poster" class="btn-primary w-full md:max-w-[285px]">
              <?php echo esc_html($hero_cta_primary); ?>
            </a>
          <?php endif; ?>
          <?php if ($hero_cta_secondary): ?>
            <a href="master-klassy" class="btn-outline w-full md:max-w-[285px]">
              <?php echo esc_html($hero_cta_secondary); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
      
      <!-- Hero image -->
      <div class="lg:absolute lg:right-[-60px] lg:top-[40px] lg:max-w-[42.5%] ">
        <?php if ($hero_image): ?>
          <img src="<?php echo esc_url($hero_image); ?>" 
               alt="<?php echo esc_attr($hero_title); ?>" 
               class="rounded-[30px] w-full lg:w-[120%] lg:-ml-[10%] shadow-lg object-cover lg:h-[878px] lg:max-w-[798px]">
        <?php else: ?>
          <div class="ph ph-hero rounded-2xl aspect-[4/5] lg:aspect-[5/6] w-full lg:w-[120%] lg:-ml-[10%] shadow-lg"></div>
        <?php endif; ?>
      </div>
    </div>
    
    <!-- Event preview cards -->
    <?php if ($preview_events): ?>
    <!-- Desktop: grid -->
    <div class="relative mt-12 h-full grid md:grid-cols-3 gap-5 z-10 lg:mt-30 hide-mobile">
      <?php foreach ($preview_events as $event): ?>
      <div class="bg-white rounded-3xl p-2.5 md:p-5 flex gap-4 items-start shadow-lg min-h-[233px]">
        <div class="flex-1 flex flex-col lg:min-h-[193px] h-full gap-5 ">
          <div class="flex items-center justify-between mb-2">
            <span class="event-badge text-[13px] text-[#2D2926] font-medium">
              <?php echo get_event_type_icon($event['type']); ?>
              <?php echo esc_html(get_event_type_label($event['type'])); ?>
            </span>
            <span class="text-[13px] text-[#2D2926] font-medium"><?php echo esc_html($event['date']); ?></span>
          </div>
          <div class="flex justify-between h-full">
          <div class="flex flex-1 flex-col justify-between">
            <p class="text-[22px] leading-[1.2] font-medium mb-3"><?php echo esc_html($event['title']); ?></p>
            <a href="<?php echo esc_url(home_url('/poster/')); ?>" class="link-arrow text-base">Записаться
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </div>
          <?php if (!empty($event['image'])): ?>
          <img src="<?php echo esc_url($event['image']); ?>" 
               alt="<?php echo esc_attr($event['title']); ?>" 
               class="flex-1 w-[164px] h-[117px] rounded-xl flex-shrink-0 object-cover">
          <?php else: ?>
          <div class="ph ph-art1 w-20 h-20 rounded-xl flex-shrink-0"></div>
          <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Mobile: Swiper -->
    <div class="relative mt-12 z-10 hide-desktop">
      <div class="swiper preview-swiper">
        <div class="swiper-wrapper">
          <?php foreach ($preview_events as $event): ?>
          <div class="swiper-slide">
            <div class="bg-white rounded-3xl p-5 flex gap-4 items-start shadow-sm lg:min-h-[233px]">
              <div class="flex-1 flex flex-col h-full justify-between">
                <div class="flex items-center justify-between mb-2">
                  <span class="event-badge text-[13px] text-[#2D2926] font-medium mb-5">
                    <?php echo get_event_type_icon($event['type']); ?>
                    <?php echo esc_html(get_event_type_label($event['type'])); ?>
                  </span>
                  <span class="text-[13px] text-[#2D2926] font-medium"><?php echo esc_html($event['date']); ?></span>
                </div>
                <div class="flex justify-between">
                  <div class="flex flex-1 flex-col justify-between">
                    <p class="text-base lg:text-[22px] leading-[1.2] font-semibold lg:font-medium mb-3"><?php echo esc_html($event['title']); ?></p>
                    <a href="<?php echo esc_url(home_url('/poster/')); ?>" class="link-arrow text-base">Записаться
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </a>
                  </div>
                  <?php if (!empty($event['image'])): ?>
                  <img src="<?php echo esc_url($event['image']); ?>" 
                       alt="<?php echo esc_attr($event['title']); ?>" 
                       class="flex-1 w-[164px] h-[117px] rounded-xl flex-shrink-0 object-cover">
                  <?php else: ?>
                  <div class="ph ph-art1 w-20 h-20 rounded-xl flex-shrink-0"></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<!-- ============ UPCOMING EVENTS ============ -->
<?php if ($upcoming_events): ?>
<section id="events" class="py-0 lg:py-16 overflow-x-hidden">
  <div class="container-main !p-2.5 md:p-5">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-10 gap-5">
      <h2>
        <?php echo esc_html($upcoming_title ?: 'Ближайшие события'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/poster/')); ?>" class="link-arrow text-base lg:mt-4">
        <?php echo esc_html($upcoming_link_text ?: 'Смотреть все события'); ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" class="w-6 h-6" />
      </a>
    </div>
    
    <!-- Desktop grid -->
    <div class="hidden sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:mt-16">
      <?php foreach ($upcoming_events as $event): ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col">
        <?php if (!empty($event['image'])): ?>
          <img src="<?php echo esc_url($event['image']); ?>" 
               alt="<?php echo esc_attr($event['title']); ?>" 
               class="w-full h-[162px] object-cover">
        <?php else: ?>
          <div class="ph ph-art1 w-full h-[162px]"></div>
        <?php endif; ?>
        <div class="p-5 flex-1 flex flex-col">
          <div class="flex items-center justify-between mb-3">
            <span class="event-badge leading-[1.2] <?php
              if ($event['type'] === 'masterclass') echo 'text-[#E8A62E]';
              elseif ($event['type'] === 'lecture') echo 'text-[#28B6DA]';
              elseif ($event['type'] === 'meeting') echo 'text-[#C61B8C]';
              elseif ($event['type'] === 'family') echo 'text-[#73B843]';
              else echo 'text-[#6B5A4A]';
            ?>">
              <?php if (!empty($event['icon'])): ?>
                <img src="<?php echo esc_url($event['icon']); ?>" alt="">
              <?php else: ?>
                <?php echo get_event_type_icon($event['type']); ?>
              <?php endif; ?>
              <?php echo esc_html(get_event_type_label($event['type'])); ?>
            </span>
            <span class="text-xs font-medium whitespace-nowrap leading-[1.2] <?php
              if ($event['type'] === 'masterclass') echo 'text-[#E8A62E]';
              elseif ($event['type'] === 'lecture') echo 'text-[#28B6DA]';
              elseif ($event['type'] === 'meeting') echo 'text-[#C61B8C]';
              elseif ($event['type'] === 'family') echo 'text-[#73B843]';
              else echo 'text-[#6B5A4A]';
            ?>"><?php echo esc_html($event['datetime']); ?></span>
          </div>
          <h3 class="!font-['Golos_Text'] text-[20px] !font-medium mb-3"><?php echo esc_html($event['title']); ?></h3>
          <p class="text-base text-[#2D2926] mb-2 leading-[1.2]"><?php echo esc_html($event['description']); ?></p>
          <a href="#" class="btn-outline w-full !py-2.5 text-sm mt-auto">
            <?php echo esc_html($event['button_text']); ?>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>

  <!-- Mobile: Swiper -->
  <div class="sm:hidden mt-0 px-2.5">
    <div class="swiper upcoming-swiper">
      <div class="swiper-wrapper">
        <?php foreach ($upcoming_events as $event): ?>
        <div class="swiper-slide">
          <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col">
            <?php if (!empty($event['image'])): ?>
              <img src="<?php echo esc_url($event['image']); ?>" 
                   alt="<?php echo esc_attr($event['title']); ?>" 
                   class="w-full h-[162px] object-cover">
            <?php else: ?>
              <div class="ph ph-art1 w-full h-[162px]"></div>
            <?php endif; ?>
            <div class="p-2.5 md:p-5 flex-1 flex flex-col">
              <div class="flex items-center justify-between mb-3">
                <span class="event-badge leading-[1.2] <?php
                  if ($event['type'] === 'masterclass') echo 'text-[#E8A62E]';
                  elseif ($event['type'] === 'lecture') echo 'text-[#28B6DA]';
                  elseif ($event['type'] === 'meeting') echo 'text-[#C61B8C]';
                  elseif ($event['type'] === 'family') echo 'text-[#73B843]';
                  else echo 'text-[#6B5A4A]';
                ?>">
                  <?php if (!empty($event['icon'])): ?>
                    <img src="<?php echo esc_url($event['icon']); ?>" alt="">
                  <?php else: ?>
                    <?php echo get_event_type_icon($event['type']); ?>
                  <?php endif; ?>
                  <?php echo esc_html(get_event_type_label($event['type'])); ?>
                </span>
                <span class="text-xs font-medium whitespace-nowrap leading-[1.2] <?php
                  if ($event['type'] === 'masterclass') echo 'text-[#E8A62E]';
                  elseif ($event['type'] === 'lecture') echo 'text-[#28B6DA]';
                  elseif ($event['type'] === 'meeting') echo 'text-[#C61B8C]';
                  elseif ($event['type'] === 'family') echo 'text-[#73B843]';
                  else echo 'text-[#6B5A4A]';
                ?>"><?php echo esc_html($event['datetime']); ?></span>
              </div>
              <h3 class="!font-['Golos_Text'] text-base md:text-[20px] !font-semibold md:!font-medium mb-3"><?php echo esc_html($event['title']); ?></h3>
              <p class="text-[13px] md:text-base text-[#2D2926] mb-2 leading-[1.2]"><?php echo esc_html($event['description']); ?></p>
              <a href="#" class="btn-outline w-full !py-2.5 text-sm mt-auto">
                <?php echo esc_html($event['button_text']); ?>
              </a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="flex items-center justify-between  mt-2">
      <div class="upcoming-nav-prev cursor-pointer w-12 h-12 flex items-center justify-center rounded-full">
        <img src="<?php echo get_template_directory_uri(); ?>/img/alm.svg" alt="Назад" class="w-6 h-6">
      </div>
      <div class="upcoming-nav-next cursor-pointer w-12 h-12 flex items-center justify-center rounded-full">
        <img src="<?php echo get_template_directory_uri(); ?>/img/arm.svg" alt="Вперёд" class="w-6 h-6">
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ ABOUT MUSEUM ============ -->
<?php if ($about_title || $about_description || $about_image): ?>
<section id="about" class="py-16 lg:py-14 relative overflow-hidden">
  <img src="<?php echo esc_url($about_image_bg); ?>" class="absolute bottom-15 -right-60 w-full max-w-[1050px]" /> 
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-5 lg:gap-[30px] items-start">
      <div class="order-2 lg:order-1">
        <?php if ($about_image): ?>
          <img src="<?php echo esc_url($about_image); ?>" 
               alt="<?php echo esc_attr($about_title); ?>" 
               class="rounded-2xl w-full lg:w-[110%] lg:-ml-[22%] object-cover relative lg:min-h-[720px]">
        <?php else: ?>
          <div class="ph ph-museum rounded-2xl aspect-[4/5] w-full lg:w-[110%] lg:-ml-[5%]"></div>
        <?php endif; ?>
      </div>
      <div class="order-1 lg:order-2 relative lg:-ml-[18%] max-w-[684px]">
        <?php if ($about_title): ?>
        <h2 class="mb-6">
          <?php echo esc_html($about_title); ?>
        </h2>
        <?php endif; ?>
        <?php if ($about_description): ?>
        <p class="text-[15px] md:text-[20px] text-[#6B5A4A] mb-6 leading-[1.2]">
          <?php echo esc_html($about_description); ?>
        </p>
        <?php endif; ?>
        <!-- Decorative illustration -->
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ EXPOSITIONS ============ -->
<?php if ($expositions_list): ?>
<section id="expositions" class="py-4 lg:pt-18">
  <div class="container-main">
    <div class="flex flex-col md:flex-row gap-5 items-start lg:items-center justify-between mb-10">
      <h2 class="!font-medium">
        <?php echo esc_html($expositions_title ?: 'Экспозиции музея'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/expositions/')); ?>" class="link-arrow text-base mr-1">
        <?php echo esc_html($expositions_link_text ?: 'Все экспозиции'); ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="arrow" class="w-6 h-6" />
      </a>
    </div>
    
    <!-- Desktop grid -->
    <div class="hidden sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:mt-16">
      <?php foreach ($expositions_list as $expo): ?>
      <div class="bg-white rounded-3xl overflow-hidden shadow-sm">
        <?php if (!empty($expo['image'])): ?>
          <img src="<?php echo esc_url($expo['image']); ?>" 
               alt="<?php echo esc_attr($expo['title']); ?>" 
               class="aspect-[4/3] object-cover w-full h-[162px]">
        <?php else: ?>
          <div class="ph ph-art1 aspect-[4/3]"></div>
        <?php endif; ?>
        <div class="p-5">
          <h3 class="!font-['Golos_Text'] text-base lg:text-xl !font-medium mb-2"><?php echo esc_html($expo['title']); ?></h3>
          <p class="text-sm lg:text-base text-[#2D2926] mb-2 leading-[1.2] pt-1"><?php echo esc_html($expo['description']); ?></p>
          <a href="vystavki" class="link-arrow text-base">
            <?php echo esc_html($expositions_link_text ?: 'Все экспозиции'); ?>
            <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="arrow" class="w-6 h-6 ml-1" />
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Mobile: Swiper -->
    <div class="sm:hidden mt-2">
      <div class="swiper expositions-swiper">
        <div class="swiper-wrapper">
          <?php foreach ($expositions_list as $expo): ?>
          <div class="swiper-slide">
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm">
              <?php if (!empty($expo['image'])): ?>
                <img src="<?php echo esc_url($expo['image']); ?>" 
                     alt="<?php echo esc_attr($expo['title']); ?>" 
                     class="aspect-[4/4] object-cover w-full h-[162px]">
              <?php else: ?>
                <div class="ph ph-art1 aspect-[4/4]"></div>
              <?php endif; ?>
              <div class="p-5">
                <h3 class="!font-['Golos_Text'] text-base lg:text-xl !font-medium mb-2"><?php echo esc_html($expo['title']); ?></h3>
                <p class="text-sm lg:text-base text-[#2D2926] mb-2 leading-[1.2] pt-1"><?php echo esc_html($expo['description']); ?></p>
                <a href="vystavki" class="link-arrow text-base">
                  <?php echo esc_html($expositions_link_text ?: 'Все экспозиции'); ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="arrow" class="w-6 h-6 ml-1" />
                </a>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ SPECIAL EXPOSITION BANNER ============ -->
<?php get_template_part('template-parts/special-exposition'); ?>

<!-- ============ MASTER CLASSES AND LECTURES ============ -->
<?php if ($classes_main || $classes_list): ?>
<section id="classes" class="py-16 lg:py-24">
  <div class="container-main lg:pt-20">
    <div class="flex items-center justify-between mb-10">
      <h2 class="!font-medium">
        <?php echo esc_html($classes_title ?: 'Мастер-классы и лекции'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/classes/')); ?>" class="link-arrow text-base">
        <?php echo esc_html($classes_link_text ?: 'Все мастер-классы и лекции'); ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="arrow" class="w-6 h-6 ml-1" />

      </a>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-5 lg:pt-[26px]">
<!-- Main class card -->
       <?php if ($classes_main): ?>
<div class="bg-white rounded-3xl overflow-hidden shadow-sm">
         <?php if (!empty($classes_main['image'])): ?>
           <img src="<?php echo esc_url($classes_main['image']); ?>" 
                alt="<?php echo esc_attr($classes_main['title']); ?>" 
                class="aspect-[16/10] object-cover w-full rounded-t-2xl md:h-[558px]">
         <?php else: ?>
           <div class="ph ph-art1 aspect-[16/10] rounded-t-2xl md:h-[558px]"></div>
         <?php endif; ?>
        <div class="p-6">
<div class="flex items-center justify-between mb-3">
              <span class="event-badge" style="color: <?php echo esc_attr(get_event_type_color($classes_main['type'])); ?>">
                <?php echo get_event_type_icon($classes_main['type']); ?>
                <?php echo esc_html(get_event_type_label($classes_main['type'])); ?>
              </span>
              <span class="text-xs font-medium" style="color: <?php echo esc_attr(get_event_type_color($classes_main['type'])); ?>"><?php echo esc_html($classes_main['datetime']); ?></span>
            </div>
          <h3 class="!font-['Golos_Text'] text-base !font-medium text-[#2D2926] lg:text-xl mb-3 !important"><?php echo esc_html($classes_main['title']); ?></h3>
          <p class="text-sm text-[#6B5A4A] mb-5 lg:text-base leading-[1.2]"><?php echo esc_html($classes_main['description']); ?></p>
          <a href="/classes" class="btn-primary !min-w-full !py-2.5 text-base">
            <?php echo esc_html($classes_main['button_text']); ?>
          </a>
        </div>
      </div>
      <?php endif; ?>
      
<!-- Right column - classes list -->
       <?php if ($classes_list): ?>
       <div class="flex flex-col gap-5">
         <?php foreach ($classes_list as $class): ?>
<div class="bg-white rounded-3xl overflow-hidden shadow-sm grid grid-cols-[1fr_1fr] gap-0 md:grid-cols-[285px_1fr]">
           <?php if (!empty($class['image'])): ?>
             <img src="<?php echo esc_url($class['image']); ?>" 
                  alt="<?php echo esc_attr($class['title']); ?>" 
                  class="object-cover w-full h-full rounded-l-3xl">
           <?php else: ?>
             <div class="ph ph-art2 w-full h-full md:h-[259px] rounded-l-3xl"></div>
           <?php endif; ?>
          <div class="p-5 flex flex-col justify-between">
            <div>
<div class="flex items-center justify-between mb-3">
                 <span class="event-badge" style="color: <?php echo esc_attr(get_event_type_color($class['type'])); ?>">
                   <?php echo get_event_type_icon($class['type']); ?>
                   <?php echo esc_html(get_event_type_label($class['type'])); ?>
                 </span>
                 <span class="text-xs font-medium" style="color: <?php echo esc_attr(get_event_type_color($class['type'])); ?>"><?php echo esc_html($class['datetime']); ?></span>
               </div>
              <h3 class="!font-['Golos_Text'] text-base !font-medium text-[#2D2926] lg:!text-xl mb-2 !important leading-[1.2]"><?php echo esc_html($class['title']); ?></h3>
              <p class="text-base text-[#6B5A4A] leading-[1.2]"><?php echo esc_html($class['description']); ?></p>
            </div>
            <a href="#" class="btn-outline w-full !py-2 text-sm mt-4">
              <?php echo esc_html($class['button_text']); ?>
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ MUSEUM SHOP ============ -->
<?php if ($shop_products): ?>
<section id="shop" class="py-16 lg:py-7 bg-[#F5EADB]">
  <div class="container-main">
    <div class="flex items-center justify-between mb-10">
      <h2 class="!font-medium">
        <?php echo esc_html($shop_title ?: 'Магазин музея'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="link-arrow text-base lg:mt-4">
        <?php echo esc_html($shop_link_text ?: 'В магазин'); ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="arrow" class="w-6 h-6 ml-1" />
      </a>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:pt-6">
      <?php foreach ($shop_products as $product): ?>
        <?php
        $p_id = $product->get_id();
        $p_name = $product->get_name();
        $p_price = $product->get_price_html();
        $p_desc = $product->get_short_description();
        $p_image = wp_get_attachment_url($product->get_image_id());
        $p_link = get_permalink($p_id);
        ?>
        <div class="bg-[#FFFDF8] rounded-3xl overflow-hidden shadow-sm flex flex-col">
          <a href="<?php echo esc_url($p_link); ?>" class="block">
            <?php if ($p_image): ?>
              <img src="<?php echo esc_url($p_image); ?>"
                   alt="<?php echo esc_attr($p_name); ?>"
                   class="object-cover w-full min-h-[343px]">
            <?php else: ?>
              <div class="ph ph-shop aspect-square"></div>
            <?php endif; ?>
          </a>
          <div class="p-5 flex flex-col flex-1">
            <h3 class="!font-['Golos_Text'] text-xl mb-2 leading-snug text-medium">
              <a href="<?php echo esc_url($p_link); ?>" class="hover:text-[#E8872C] transition">
                <?php echo esc_html($p_name); ?>
              </a>
            </h3>
            <?php if ($p_desc): ?>
              <p class="text-sm text-[#2D2926] mb-4 leading-snug line-clamp-3 lg:text-base leading-[1.2]">
                <?php echo wp_kses_post($p_desc); ?>
              </p>
          <div class="border-b-[1px] border-[#D9CCBC] mb-5"></div>
            <?php endif; ?>
            <div class="mt-auto flex items-center gap-3 text-xl text-[#E8872C] font-medium">
              <?php if ($p_price): ?>
                <?php
                 $price_html = wp_kses_post($p_price);
                 $price_html = str_replace('Br', '<span class="font-medium">BYN</span>', $price_html);
                 echo $price_html;
                 ?>
              <?php endif; ?>
              <a href="<?php echo esc_url($p_link); ?>" class="btn-primary !py-2 !px-4 text-sm ml-auto whitespace-nowrap">
                В корзину
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ WHY US ============ -->
<?php if ($why_us_items): ?>
<section class="py-16 lg:py-29">
  <div class="container-main">
    <h2 class="mb-12 text-start lg:mb-16 text-black !font-medium">
      <?php echo esc_html($why_us_title ?: 'Почему приходят к нам'); ?>
    </h2>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($why_us_items as $item): ?>
      <div class="text-center">
        <div class="mx-auto mb-5 lg:mb-10 w-auto h-[75px] lg:h-[150px] flex items-center justify-center">
          <?php if ($item['icon']): ?>
          <img src="<?php echo esc_url($item['icon']); ?>" alt="" class="w-full h-full object-contain" />
          <?php endif; ?>
        </div>
        <h3 class="!font-body text-lg lg:text-[28px] !font-medium mb-5"><?php echo esc_html($item['title']); ?></h3>
        <p class="text-[15px] lg:text-lg text-[#2D2926] leading-[1.2]"><?php echo esc_html($item['description']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ CTA SECTION ============ -->
<?php if ($cta_title || $cta_primary || $cta_secondary): ?>
<section class="relative h-[347px] lg:h-[300px]">
    <?php if ($cta_background_image): ?>
    <div class="absolute inset-0 hidden lg:block" style="background-image: url('<?php echo esc_url($cta_background_image); ?>'); background-size: cover; background-position: center;"></div>
    <?php endif; ?>
    <?php
    $cta_bg_mobile = $cta_background_image_mobile ?: $cta_background_image;
    if ($cta_bg_mobile):
    ?>
    <div class="absolute inset-0 block lg:hidden" style="background-image: url('<?php echo esc_url($cta_bg_mobile); ?>'); background-size: cover; background-position: center;"></div>
    <?php endif; ?>
  <div class="max-w-[1200px] w-full mx-auto px-[10px] flex flex-col items-center justify-center h-full relative text-center">
    <?php if ($cta_title): ?>
    <h2 class="!text-[#FFFDF8] mb-6 mx-auto max-w-[260px] md:max-w-full">
      <?php echo esc_html($cta_title); ?>
    </h2>
    <?php endif; ?>
    <div class="flex flex-col sm:flex-row gap-[10px] md:gap-5 justify-center w-full">
      <?php if ($cta_primary): ?>
        <a href="#" class="btn-primary md:max-w-[285px]">
          <?php echo esc_html($cta_primary); ?>
        </a>
      <?php endif; ?>
      <?php if ($cta_secondary): ?>
        <a href="/poster" class="btn-secondary md:max-w-[285px]">
          <?php echo esc_html($cta_secondary); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
