<?php
/**
 * Template Name: Мастер-классы
 * Template for master classes page
 */

$hero_title = get_field('mk_hero_title') ?: 'Мастер-классы музея';
$hero_description = get_field('mk_hero_description') ?: 'Практические занятия по наивной живописи, декоративным техникам и творческим форматам для детей и взрослых.';
$hero_image = get_field('mk_hero_image');
$hero_cta_primary_text = get_field('mk_hero_cta_primary_text') ?: 'Ближайшие события';
$hero_cta_primary_url = get_field('mk_hero_cta_primary_url') ?: '#events';
$hero_cta_secondary_text = get_field('mk_hero_cta_secondary_text') ?: 'Купить билет';
$hero_cta_secondary_url = get_field('mk_hero_cta_secondary_url') ?: '#';

$featured_title = get_field('mk_featured_title') ?: 'Живопись акрилом: весенний пейзаж';
$featured_description = get_field('mk_featured_description') ?: 'Пишем яркий пейзаж под руководством преподавателя. Для взрослых и подростков.';
$featured_image = get_field('mk_featured_image');
$featured_date = get_field('mk_featured_date') ?: '23 мая, пт';
$featured_time = get_field('mk_featured_time') ?: '18:30';
$featured_audience = get_field('mk_featured_audience') ?: 'Для взрослых';
$featured_materials = get_field('mk_featured_materials') ?: 'Материалы включены';
$featured_button_detail_text = get_field('mk_featured_button_detail_text') ?: 'Подробнее';
$featured_button_detail_url = get_field('mk_featured_button_detail_url') ?: '#';
$featured_button_buy_text = get_field('mk_featured_button_buy_text') ?: 'Купить билет';
$featured_button_buy_url = get_field('mk_featured_button_buy_url') ?: '#';

$mk_events_query = new WP_Query(array(
	'post_type'      => 'event',
	'posts_per_page' => -1,
	'tax_query'      => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => 'masterclass',
		),
	),
	'orderby'        => 'date',
	'order'          => 'ASC',
));

$formats_title = get_field('mk_formats_title') ?: 'Форматы мастер-классов';
$formats = get_field('mk_formats');

$subscriptions_title = 'Абонементы и регулярные форматы';

$cta_background_image = get_field('mk_cta_background_image');
$cta_background_image_mobile = get_field('mk_cta_background_image_mobile');
$cta_title = get_field('mk_cta_title') ?: 'Выберите мастер-класс и приходите творить';
$cta_primary = get_field('mk_cta_primary') ?: 'Купить билет';
$cta_primary_url = get_field('mk_cta_primary_url') ?: '#';
$cta_secondary = get_field('mk_cta_secondary') ?: 'Посмотреть афишу';
$cta_secondary_url = get_field('mk_cta_secondary_url') ?: '#';

function mk_get_event_type_color($type) {
	$colors = array(
		'masterclass'        => '#E8A62E',
		'lecture'            => '#28B6DA',
		'meeting'            => '#C61B8C',
		'family'             => '#73B843',
		'for_children'       => '#E74C3C',
		'for_adults'         => '#3498DB',
	);
	return $colors[$type] ?? '#6B5A4A';
}

function mk_get_event_type_label($type) {
	$labels = array(
		'masterclass'  => 'Мастер-класс',
		'lecture'      => 'Лекция',
		'meeting'      => 'Встреча',
		'family'       => 'Семейное',
		'for_children' => 'Для детей',
		'for_adults'   => 'Для взрослых',
	);
	return $labels[$type] ?? 'Событие';
}

$subscriptions_query = new WP_Query(array(
	'post_type'      => 'subscription',
	'posts_per_page' => 3,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
));

?>

<?php get_header(); ?>

<!-- ============ HERO ============ -->
<section class="mt-[40px] relative overflow-hidden h-[236px] lg:h-[376px]">
  <?php if ($hero_image): ?>
  <div class="absolute inset-0" style="background-image: url('<?php echo esc_url($hero_image); ?>'); background-size: cover; background-position: center;"></div>
  <?php else: ?>
  <div class="absolute inset-0 ph ph-museum"></div>
  <?php endif; ?>

  <div class="container-main relative h-full flex flex-col justify-center py-10">
    <nav class="absolute top-2 left-[20px] lg:left-[20px]">
      <ul class="breadcrumbs">
        <li><a href="/">Главная</a></li>
        <li><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="" class="breadcrumbs-separator"></li>
        <li class="breadcrumbs-current">Мастер-классы</li>
      </ul>
    </nav>

    <div>
      <?php if ($hero_title): ?>
      <h1 class="text-[34px] sm:text-[44px] lg:text-[50px] leading-[1.05] mb-10 !font-medium text-[#2D2926]">
        <?php echo esc_html($hero_title); ?>
      </h1>
      <?php endif; ?>
      <?php if ($hero_description): ?>
      <p class="text-[16px] md:text-[20px] max-w-[590px] text-[#000000] mb-8 leading-[1.2]">
        <?php echo wp_kses_post($hero_description); ?>
      </p>
      <?php endif; ?>
      <div class="flex flex-col sm:flex-row gap-5 w-full">
        <?php if ($hero_cta_primary_text): ?>
          <a href="<?php echo esc_url($hero_cta_primary_url); ?>" class="btn-primary md:max-w-[285px]">
            <?php echo esc_html($hero_cta_primary_text); ?>
          </a>
        <?php endif; ?>
        <?php if ($hero_cta_secondary_text): ?>
          <a href="<?php echo esc_url($hero_cta_secondary_url); ?>" class="btn-secondary md:max-w-[285px]">
            <?php echo esc_html($hero_cta_secondary_text); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ FILTER TABS ============ -->
<section class="py-8 lg:py-6">
  <div class="container-main">
    <div class="filter-scroll-wrapper">
      <div class="filter-scroll" id="mk-filters">
        <button data-filter="all" class="filter-btn filter-btn--active">
          Все мастер-классы
        </button>
        <button data-filter="for_children" class="filter-btn">
          Для детей
        </button>
        <button data-filter="for_adults" class="filter-btn">
          Для взрослых
        </button>
        <button data-filter="family" class="filter-btn">
          Семейный
        </button>
        <button data-filter="beginners" class="filter-btn">
          Для начинающих
        </button>
        <button data-filter="painting" class="filter-btn">
          Живопись
        </button>
        <button data-filter="decorative" class="filter-btn">
          Декоративные техники
        </button>
        <button data-filter="malevanka" class="filter-btn">
          Малеванка
        </button>
        <button data-filter="embroidery" class="filter-btn">
          Вышивка и текстиль
        </button>
        <button data-filter="custom" class="filter-btn">
          Кастом
        </button>
        <button data-filter="subscription" class="filter-btn">
          По абонементу
        </button>
      </div>
      <div class="filter-dots lg:hidden" id="mk-filter-dots"></div>
    </div>
  </div>
</section>
<style>
  @media (max-width: 1023px) {
    #mk-filters .filter-btn { border-radius: 12px !important; padding: 15px !important; height: auto !important; min-width: max-content !important; }
  }
</style>

<!-- ============ FEATURED CLASS ============ -->
<?php if ($featured_title): ?>
<section class="py-6 lg:py-10">
  <div class="container-main">
    <div class="bg-[#FFFDF8] rounded-3xl shadow-lg overflow-hidden h-[485px] lg:h-[324px]">
      <div class="grid lg:grid-cols-[590px_1fr] gap-5 h-full">
        <!-- Left image -->
        <div class="p-2.5 lg:p-5 lg:pr-0 h-full flex flex-col">
          <?php if ($featured_image): ?>
            <img src="<?php echo esc_url($featured_image); ?>"
                 alt="<?php echo esc_attr($featured_title); ?>"
                 class="w-full h-[284px] object-cover rounded-l-[12px] rounded-r-none">
          <?php else: ?>
            <div class="ph ph-museum w-full h-[284px] rounded-l-[12px] rounded-r-none"></div>
          <?php endif; ?>
        </div>

        <!-- Right content -->
        <div class="flex flex-col justify-center px-5 py-5 lg:px-10 lg:py-10 gap-5">
          <h2 class="!font-['Golos_Text'] text-[20px] lg:!text-[28px] max-w-[390px] !font-medium text-[#000000] leading-[1.2] m-0">
            <?php echo esc_html($featured_title); ?>
          </h2>

          <?php if ($featured_description): ?>
          <p class="!font-['Golos_Text'] text-[13px] lg:text-base text-black max-w-[380px] leading-[1.4] m-0">
            <?php echo wp_kses_post($featured_description); ?>
          </p>
          <?php endif; ?>

          <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-1">
            <?php if ($featured_materials): ?>
            <div class="flex items-center gap-2">
              <span class="inline-flex items-center justify-center flex-shrink-0">
              <img src="<?php echo get_template_directory_uri(); ?>/img/palette-line.svg" alt="palette" class="" />
              </span>
              <span class="font-['Golos_Text'] text-[13px] font-medium text-[#E8A62E]">
                <?php echo esc_html($featured_materials); ?>
              </span>
            </div>
            <?php endif; ?>
            <?php if ($featured_date || $featured_time): ?>
            <span class="font-['Golos_Text'] text-[13px] font-medium text-[#E8A62E]">
              <?php
                $parts = array_filter(array($featured_date, $featured_time));
                echo esc_html(implode(' · ', $parts));
              ?>
            </span>
            <?php endif; ?>
          </div>

          <div class="flex gap-3 mt-auto pt-4">
            <?php if ($featured_button_detail_text): ?>
            <a href="<?php echo esc_url($featured_button_detail_url); ?>" class="btn-outline lg:max-w-[182px] flex-1 h-[52px] text-[15px]">
              <?php echo esc_html($featured_button_detail_text); ?>
            </a>
            <?php endif; ?>
            <?php if ($featured_button_buy_text): ?>
            <a href="<?php echo esc_url($featured_button_buy_url); ?>" class="btn-primary lg:max-w-[182px] flex-1 h-[52px] text-[15px]">
              <?php echo esc_html($featured_button_buy_text); ?>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ CLASSES GRID ============ -->
<?php if ($mk_events_query->have_posts()): ?>
<section id="events" class="py-6">
  <div class="container-main">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5" id="mk-grid">
      <?php while ($mk_events_query->have_posts()): $mk_events_query->the_post();
        $event_id = get_the_ID();
        $event_categories_list = wp_get_post_terms($event_id, 'event_category', array('fields' => 'slugs'));
        $event_date = get_field('event_date');
        $event_time = get_field('event_time');
        $event_price = get_field('event_price');
        $event_brief = get_field('event_brief_description');
        $event_thumbnail = get_field('event_thumbnail');
        $event_hero_image = get_field('event_hero_image');
        $event_audience_type = get_field('event_audience_type');
        $event_audience_icon = get_field('event_audience_icon');
        $primary_cat = !empty($event_categories_list) ? $event_categories_list[0] : '';
        $cat_icon_url = '';
        if ($primary_cat) {
          $cat_term = get_term_by('slug', $primary_cat, 'event_category');
          if ($cat_term) {
            $cat_icon_url = get_term_meta($cat_term->term_id, 'event_cat_icon', true);
          }
        }
        $audience_labels = array(
          'for_children' => 'Для детей',
          'for_adults'   => 'Для взрослых',
          'family'       => 'Семейный',
          'beginners'    => 'Для начинающих',
          'painting'     => 'Живопись',
          'decorative'   => 'Декоративные техники',
          'malevanka'    => 'Малеванка',
          'embroidery'   => 'Вышивка и текстиль',
          'custom'       => 'Кастом',
          'subscription' => 'По абонементу',
        );
        $audience_label = $audience_labels[$event_audience_type] ?? 'Для детей';
      ?>
      <div class="bg-white rounded-3xl overflow-hidden shadow-sm flex flex-col mk-card" data-audience="<?php echo esc_attr($event_audience_type); ?>">
        <?php if ($event_thumbnail): ?>
          <img src="<?php echo esc_url($event_thumbnail); ?>"
               alt="<?php echo esc_attr(get_the_title()); ?>"
               class="w-full h-[162px] object-cover">
        <?php elseif ($event_hero_image): ?>
          <img src="<?php echo esc_url($event_hero_image); ?>"
               alt="<?php echo esc_attr(get_the_title()); ?>"
               class="w-full h-[162px] object-cover">
        <?php else: ?>
          <div class="ph ph-art1 w-full h-[162px]"></div>
        <?php endif; ?>
        <div class="p-5 flex-1 flex flex-col">
          <div class="flex items-center justify-between mb-3">
            <span class="flex items-center gap-1.5 text-xs font-medium leading-[1.2]" style="color: <?php echo esc_attr(mk_get_event_type_color($primary_cat)); ?>">
              <?php if ($cat_icon_url): ?>
                <img src="<?php echo esc_url($cat_icon_url); ?>" alt="" class="w-5 h-5">
              <?php endif; ?>
              <?php echo esc_html(mk_get_event_type_label($primary_cat)); ?>
            </span>
            <span class="text-xs font-medium whitespace-nowrap leading-[1.2]" style="color: <?php echo esc_attr(mk_get_event_type_color($primary_cat)); ?>">
              <?php echo esc_html($event_date . ($event_time ? ', ' . $event_time : '')); ?>
            </span>
          </div>
          <h3 class="!font-['Golos_Text'] text-[16px] lg:text-[18px] !font-medium mb-2 leading-snug"><?php echo esc_html(get_the_title()); ?></h3>
          <?php if ($event_brief): ?>
          <p class="text-[13px] lg:text-[14px] text-[#2D2926] mb-2 leading-[1.2] flex-1 line-clamp-3"><?php echo esc_html($event_brief); ?></p>
          <?php endif; ?>
          <div class="flex items-center gap-2 text-xs text-[#6B5A4A] mb-3">
            <?php if ($event_audience_icon): ?>
              <img src="<?php echo esc_url($event_audience_icon); ?>" alt="" class="w-5 h-5">
            <?php endif; ?>
            <span class="text-[13px]"><?php echo esc_html($audience_label); ?></span>
          </div>
          <?php if ($event_price): ?>
          <p class="text-[15px] font-medium text-[#2D2926] mb-3"><?php echo esc_html($event_price); ?></p>
          <?php endif; ?>
          <a href="<?php echo esc_url(get_permalink()); ?>" class="btn-outline w-full !py-2.5 text-sm mt-auto">
            Подробнее
          </a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php wp_reset_postdata(); endif; ?>

<!-- ============ FORMATS ============ -->
<?php if ($formats): ?>
<section class="py-10 lg:py-16">
  <div class="container-main">
    <h2 class="mb-10 lg:mb-14 !font-medium"><?php echo esc_html($formats_title); ?></h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12 lg:pt-[10px]">
      <?php foreach ($formats as $format): ?>
      <div class="text-center">
        <div class="mx-auto mb-5 lg:mb-6 w-[60px] h-[60px] lg:w-[80px] lg:h-[80px] flex items-center justify-center">
          <?php if (!empty($format['icon'])): ?>
          <img src="<?php echo esc_url($format['icon']); ?>" alt="" class="w-full h-full object-contain" />
          <?php endif; ?>
        </div>
        <h3 class="!font-['Golos_Text'] text-[16px] lg:text-[20px] !font-medium mb-3 text-[#2D2926]"><?php echo esc_html($format['title']); ?></h3>
        <?php if (!empty($format['description'])): ?>
        <p class="text-[14px] lg:text-[16px] text-[#6B5A4A] leading-[1.3]"><?php echo esc_html($format['description']); ?></p>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ SUBSCRIPTIONS ============ -->
<?php if ($subscriptions_query->have_posts()): ?>
<section class="py-10 lg:py-16 px-2.5 lg:px-0">
  <div class="max-w-[1200px] mx-auto">
    <h2 class="mb-10 lg:mb-14 !font-medium"><?php echo esc_html($subscriptions_title); ?></h2>
    <!-- Desktop: grid -->
    <div class="hidden sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      <?php while ($subscriptions_query->have_posts()): $subscriptions_query->the_post();
        get_template_part('template-parts/subscription-card');
      endwhile; ?>
    </div>
    <!-- Mobile: Swiper -->
    <div class="sm:hidden">
      <div class="swiper subscriptions-swiper">
        <div class="swiper-wrapper">
          <?php $subscriptions_query->rewind_posts(); while ($subscriptions_query->have_posts()): $subscriptions_query->the_post(); ?>
          <div class="swiper-slide">
            <?php get_template_part('template-parts/subscription-card'); ?>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
      <div class="flex items-center justify-between mt-2">
        <div class="subscriptions-nav-prev cursor-pointer w-12 h-12 flex items-center justify-center rounded-full">
          <img src="<?php echo get_template_directory_uri(); ?>/img/alm.svg" alt="Назад" class="w-6 h-6">
        </div>
        <div class="subscriptions-nav-next cursor-pointer w-12 h-12 flex items-center justify-center rounded-full">
          <img src="<?php echo get_template_directory_uri(); ?>/img/arm.svg" alt="Вперёд" class="w-6 h-6">
        </div>
      </div>
    </div>
  </div>
</section>
<?php wp_reset_postdata(); endif; ?>

<!-- ============ CTA SECTION ============ -->
<?php if ($cta_title || $cta_primary || $cta_secondary): ?>
<section class="bg-white lg:bg-transparent relative h-auto lg:h-[300px] lg:mt-14 shadow-lg">
    <?php if ($cta_background_image): ?>
    <div class="absolute inset-0 hidden lg:block" style="background-image: url('<?php echo esc_url($cta_background_image); ?>'); background-size: cover; background-position: center;"></div>
    <?php endif; ?>
  <div class="max-w-[1200px] w-full mx-auto px-[10px] lg:pl-[200px] lg:pr-[10px] flex flex-col md:flex-row items-center justify-start lg:h-full relative text-center py-10 lg:py-0">
    <div class="flex flex-col flex-1 justify-start">
    <?php if ($cta_title): ?>
    <h2 class="text-[#2D2926] lg:text-white mb-6 max-w-[260px] md:max-w-[380px] text-start !text-[26px] lg:!text-[36px] !font-medium">
      <?php echo esc_html($cta_title); ?>
    </h2>
    <?php endif; ?>
    <div class="flex flex-col sm:flex-row gap-[10px] md:gap-5 justify-start w-full">
      <?php if ($cta_primary): ?>
        <a href="<?php echo esc_url($cta_primary_url); ?>" class="btn-primary w-full lg:!w-[336px]">
          <?php echo esc_html($cta_primary); ?>
        </a>
      <?php endif; ?>
      <?php if ($cta_secondary): ?>
        <a href="<?php echo esc_url($cta_secondary_url); ?>" class="btn-secondary w-full lg:!w-[336px]">
          <?php echo esc_html($cta_secondary); ?>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php
  $cta_bg_mobile = $cta_background_image_mobile ?: $cta_background_image;
  if ($cta_bg_mobile):
  ?>
  <div class="max-w-[1200px] mx-auto px-[10px] lg:hidden">
    <img src="<?php echo esc_url($cta_bg_mobile); ?>" alt="" class="w-full h-[190px] object-cover rounded-2xl mt-2">
  </div>
  <?php endif; ?>
</section>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var filterButtons = document.querySelectorAll('#mk-filters .filter-btn');
  var cards = document.querySelectorAll('.mk-card');

  filterButtons.forEach(function(btn) {
    btn.addEventListener('click', function() {
      filterButtons.forEach(function(b) {
        b.classList.remove('filter-btn--active');
      });
      btn.classList.add('filter-btn--active');

      var filter = btn.getAttribute('data-filter');

      cards.forEach(function(card) {
        var audience = card.getAttribute('data-audience');
        if (filter === 'all' || audience === filter) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  var scrollContainer = document.querySelector('#mk-filters');
  var dotsContainer = document.getElementById('mk-filter-dots');

  if (scrollContainer && dotsContainer) {
    function isMobile() {
      return window.innerWidth < 1024;
    }

    function updateDots() {
      if (!isMobile()) {
        dotsContainer.innerHTML = '';
        return;
      }

      var totalWidth = scrollContainer.scrollWidth;
      var visibleWidth = scrollContainer.clientWidth;
      var maxScroll = totalWidth - visibleWidth;

      if (maxScroll <= 10) {
        dotsContainer.innerHTML = '';
        return;
      }

      var numDots = Math.ceil(totalWidth / visibleWidth);
      var currentDot = Math.round(scrollContainer.scrollLeft / (maxScroll / (numDots - 1 || 1)));

      dotsContainer.innerHTML = '';
      for (var i = 0; i < numDots; i++) {
        var dot = document.createElement('div');
        dot.className = 'filter-dot' + (i === currentDot ? ' filter-dot--active' : '');
        dot.setAttribute('data-index', i);
        dot.addEventListener('click', function() {
          var idx = parseInt(this.getAttribute('data-index'));
          var targetScroll = (maxScroll / (numDots - 1 || 1)) * idx;
          scrollContainer.scrollTo({ left: targetScroll, behavior: 'smooth' });
        });
        dotsContainer.appendChild(dot);
      }
    }

    scrollContainer.addEventListener('scroll', updateDots);
    updateDots();
    window.addEventListener('resize', updateDots);
  }
});
</script>

<?php get_footer(); ?>
