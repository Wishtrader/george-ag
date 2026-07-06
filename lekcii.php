<?php
/**
 * Template Name: Лекции и Встречи
 * Template for lectures and meetings page
 */

$hero_title = get_field('lk_hero_title') ?: 'Лекции и встречи';
$hero_description = get_field('lk_hero_description') ?: 'Экскурсии, лекции, встречи и творческие форматы для тех, кто хочет узнать больше об искусстве и музее.';
$hero_image = get_field('lk_hero_image');
$hero_cta_primary_text = get_field('lk_hero_cta_primary_text') ?: 'Ближайшие события';
$hero_cta_primary_url = get_field('lk_hero_cta_primary_url') ?: '#events';
$hero_cta_secondary_text = get_field('lk_hero_cta_secondary_text') ?: 'Купить билет';
$hero_cta_secondary_url = get_field('lk_hero_cta_secondary_url') ?: '#';

$filters = get_field('lk_filters');

$featured_title = get_field('lk_featured_title') ?: 'Лекция: Как понимать наивное искусство';
$featured_description = get_field('lk_featured_description') ?: 'Разбираемся в языке, символах и особой искренности наивного искусства. Для всех, кто интересуется искусством.';
$featured_image = get_field('lk_featured_image');
$featured_date = get_field('lk_featured_date') ?: '25 мая, вт';
$featured_time = get_field('lk_featured_time') ?: '18:30';
$featured_location = get_field('lk_featured_location') ?: 'Лекторий музея';
$featured_button_detail_text = get_field('lk_featured_button_detail_text') ?: 'Подробнее';
$featured_button_detail_url = get_field('lk_featured_button_detail_url') ?: '#';
$featured_button_buy_text = get_field('lk_featured_button_buy_text') ?: 'Купить билет';
$featured_button_buy_url = get_field('lk_featured_button_buy_url') ?: '#';

$events_title = get_field('lk_events_title') ?: 'Лекции и встречи';
$events = get_field('lk_events');

$formats_title = get_field('lk_formats_title') ?: 'Форматы лекций';
$formats = get_field('lk_formats');

$subscriptions_title = get_field('lk_subscriptions_title') ?: 'Абонементы и регулярные форматы';

$cta_background_image = get_field('lk_cta_background_image');
$cta_background_image_mobile = get_field('lk_cta_background_image_mobile');
$cta_title = get_field('lk_cta_title') ?: 'Выберите лекцию и приходите в музей';
$cta_primary = get_field('lk_cta_primary') ?: 'Купить билет';
$cta_primary_url = get_field('lk_cta_primary_url') ?: '#';
$cta_secondary = get_field('lk_cta_secondary') ?: 'Посмотреть афишу';
$cta_secondary_url = get_field('lk_cta_secondary_url') ?: '#';

function lk_get_event_type_color($type) {
	$colors = array(
		'masterclass'  => '#E8A62E',
		'lecture'      => '#28B6DA',
		'meeting'      => '#C61B8C',
		'tour'         => '#73B843',
		'for_children' => '#E74C3C',
		'for_adults'   => '#3498DB',
		'family'       => '#F39C12',
	);
	return $colors[$type] ?? '#6B5A4A';
}

function lk_get_event_type_label($type) {
	$labels = array(
		'masterclass'  => 'Мастер-класс',
		'lecture'      => 'Лекция',
		'meeting'      => 'Встреча',
		'tour'         => 'Экскурсия',
		'for_children' => 'Для детей',
		'for_adults'   => 'Для взрослых',
		'family'       => 'Семейное',
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
        <li class="breadcrumbs-current">Лекции и встречи</li>
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
          <a href="<?php echo esc_url($hero_cta_primary_url); ?>" class="btn-primary w-[285px]">
            <?php echo esc_html($hero_cta_primary_text); ?>
          </a>
        <?php endif; ?>
        <?php if ($hero_cta_secondary_text): ?>
          <a href="<?php echo esc_url($hero_cta_secondary_url); ?>" class="btn-secondary">
            <?php echo esc_html($hero_cta_secondary_text); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ FILTER TABS ============ -->
<?php if ($filters): ?>
<section class="py-8 lg:py-6">
  <div class="container-main">
    <div class="flex flex-wrap gap-[10px] lg:gap-[19px] justify-center lg:justify-start" id="lk-filters">
      <button data-filter="all" class="filter-btn filter-btn--active">
        Все события
      </button>
      <?php foreach ($filters as $filter): ?>
      <button data-filter="<?php echo esc_attr($filter['slug']); ?>" class="filter-btn">
        <?php echo esc_html($filter['label']); ?>
      </button>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ FEATURED EVENT ============ -->
<?php if ($featured_title): ?>
<section class="py-6 lg:py-10">
  <div class="container-main">
    <div class="featured-card rounded-3xl overflow-hidden">
      <div class="grid lg:grid-cols-[1fr_auto_1fr] gap-0">
        <!-- Left image -->
        <div class="featured-card__image featured-card__image--left">
          <?php if ($featured_image): ?>
            <img src="<?php echo esc_url($featured_image); ?>"
                 alt="<?php echo esc_attr($featured_title); ?>"
                 class="w-full h-full object-cover">
          <?php else: ?>
            <div class="ph ph-museum w-full h-full"></div>
          <?php endif; ?>
        </div>

        <!-- Center content -->
        <div class="featured-card__content !justify-start">
          <h2 class="featured-card__title !font-['Golos_Text'] !font-medium">
            <?php echo esc_html($featured_title); ?>
          </h2>

          <?php if ($featured_description): ?>
          <p class="featured-card__desc">
            <?php echo wp_kses_post($featured_description); ?>
          </p>
          <?php endif; ?>

          <div class="featured-card__meta">
            <div class="featured-card__meta-item">
              <span class="featured-card__meta-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              </span>
              <span class="featured-card__meta-value" style="color: #28B6DA;">
                <?php echo esc_html($featured_date); ?>
              </span>
            </div>
            <?php if ($featured_time): ?>
            <div class="featured-card__meta-item">
              <span class="featured-card__meta-value" style="color: #28B6DA;">
                <?php echo esc_html($featured_time); ?>
              </span>
            </div>
            <?php endif; ?>
            <?php if ($featured_location): ?>
            <div class="featured-card__meta-item">
              <span class="featured-card__meta-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </span>
              <span class="featured-card__meta-value" style="color: #28B6DA;">
                <?php echo esc_html($featured_location); ?>
              </span>
            </div>
            <?php endif; ?>
          </div>

          <div class="featured-card__actions !mt-auto">
            <?php if ($featured_button_detail_text): ?>
            <a href="<?php echo esc_url($featured_button_detail_url); ?>" class="btn-outline featured-card__btn">
              <?php echo esc_html($featured_button_detail_text); ?>
            </a>
            <?php endif; ?>
            <?php if ($featured_button_buy_text): ?>
            <a href="<?php echo esc_url($featured_button_buy_url); ?>" class="btn-primary featured-card__btn">
              <?php echo esc_html($featured_button_buy_text); ?>
            </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Right image -->
        <div class="featured-card__image featured-card__image--right">
          <?php if ($featured_image): ?>
            <img src="<?php echo esc_url($featured_image); ?>"
                 alt="<?php echo esc_attr($featured_title); ?>"
                 class="w-full h-full object-cover">
          <?php else: ?>
            <div class="ph ph-art2 w-full h-full"></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ EVENTS GRID ============ -->
<?php if ($events): ?>
<section id="events" class="py-6">
  <div class="container-main">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5" id="lk-grid">
      <?php foreach ($events as $event):
        $audience_labels = array(
          'for_children' => 'Для детей',
          'for_adults'   => 'Для взрослых',
          'family'       => 'Семейное',
        );
        $audience_label = $audience_labels[$event['audience']] ?? 'Для взрослых';
        $audience_icon_url = '';
        if (!empty($event['audience_icon'])) {
          $audience_icon_url = $event['audience_icon'];
        }
        $type_label = lk_get_event_type_label($event['category'] ?? 'lecture');
        $type_color = lk_get_event_type_color($event['category'] ?? 'lecture');
      ?>
      <div class="bg-white rounded-3xl overflow-hidden shadow-sm flex flex-col lk-card" data-categories="<?php echo esc_attr($event['category'] ?? ''); ?>">
        <?php if (!empty($event['image'])): ?>
          <img src="<?php echo esc_url($event['image']); ?>"
               alt="<?php echo esc_attr($event['title']); ?>"
               class="w-full h-[162px] object-cover">
        <?php else: ?>
          <div class="ph ph-art1 w-full h-[162px]"></div>
        <?php endif; ?>
        <div class="p-5 flex-1 flex flex-col">
          <div class="flex items-center justify-between mb-3">
            <span class="flex items-center gap-1.5 text-xs font-medium leading-[1.2]" style="color: <?php echo esc_attr($type_color); ?>">
              <?php echo esc_html($type_label); ?>
            </span>
            <span class="text-xs font-medium whitespace-nowrap leading-[1.2]" style="color: <?php echo esc_attr($type_color); ?>">
              <?php echo esc_html($event['date'] ?? ''); ?>
            </span>
          </div>
          <h3 class="!font-['Golos_Text'] text-[16px] lg:text-[18px] !font-medium mb-2 leading-snug"><?php echo esc_html($event['title']); ?></h3>
          <?php if (!empty($event['description'])): ?>
          <p class="text-[13px] lg:text-[14px] text-[#2D2926] mb-2 leading-[1.2] flex-1 line-clamp-3"><?php echo esc_html($event['description']); ?></p>
          <?php endif; ?>
          <div class="flex items-center gap-2 text-xs text-[#6B5A4A] mb-3">
            <?php if ($audience_icon_url): ?>
              <img src="<?php echo esc_url($audience_icon_url); ?>" alt="" class="w-5 h-5">
            <?php endif; ?>
            <span class="text-[13px]"><?php echo esc_html($audience_label); ?></span>
          </div>
          <?php if (!empty($event['price'])): ?>
          <p class="text-[15px] font-medium text-[#2D2926] mb-3"><?php echo esc_html($event['price']); ?></p>
          <?php endif; ?>
          <?php if (!empty($event['button_text']) && !empty($event['button_url'])): ?>
          <a href="<?php echo esc_url($event['button_url']); ?>" class="btn-outline w-full !py-2.5 text-sm mt-auto">
            <?php echo esc_html($event['button_text']); ?>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

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
<section class="py-10 lg:py-16 lg:mt-10">
  <div class="max-w-[1200px] mx-auto">
    <h2 class="mb-10 lg:mb-14 !font-medium"><?php echo esc_html($subscriptions_title); ?></h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      <?php while ($subscriptions_query->have_posts()): $subscriptions_query->the_post();
        get_template_part('template-parts/subscription-card');
      endwhile; ?>
    </div>
  </div>
</section>
<?php wp_reset_postdata(); endif; ?>

<!-- ============ CTA SECTION ============ -->
<?php if ($cta_title || $cta_primary || $cta_secondary): ?>
<section class="relative h-[347px] lg:h-[300px] lg:mt-14">
    <?php if ($cta_background_image): ?>
    <div class="absolute inset-0 hidden lg:block" style="background-image: url('<?php echo esc_url($cta_background_image); ?>'); background-size: cover; background-position: center;"></div>
    <?php endif; ?>
    <?php
    $cta_bg_mobile = $cta_background_image_mobile ?: $cta_background_image;
    if ($cta_bg_mobile):
    ?>
    <div class="absolute inset-0 block lg:hidden" style="background-image: url('<?php echo esc_url($cta_bg_mobile); ?>'); background-size: cover; background-position: center;"></div>
    <?php endif; ?>
  <div class="max-w-[1200px] w-full mx-auto px-[10px] flex flex-col md:flex-row items-center justify-start h-full relative text-center">
    <div class="flex flex-col flex-1"></div>
    <div class="flex flex-col flex-1 justify-start lg:-ml-40">
    <?php if ($cta_title): ?>
    <h2 class="text-white mb-6 max-w-[260px] md:max-w-[380px] text-start !text-[26px] lg:!text-[36px] !font-medium">
      <?php echo esc_html($cta_title); ?>
    </h2>
    <?php endif; ?>
    <div class="flex flex-col sm:flex-row gap-[10px] md:gap-5 justify-start w-full">
      <?php if ($cta_primary): ?>
        <a href="<?php echo esc_url($cta_primary_url); ?>" class="btn-primary lg:!min-w-[336px]">
          <?php echo esc_html($cta_primary); ?>
        </a>
      <?php endif; ?>
      <?php if ($cta_secondary): ?>
        <a href="<?php echo esc_url($cta_secondary_url); ?>" class="btn-secondary lg:!min-w-[336px]">
          <?php echo esc_html($cta_secondary); ?>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var filterButtons = document.querySelectorAll('#lk-filters .filter-btn');
  var cards = document.querySelectorAll('.lk-card');

  filterButtons.forEach(function(btn) {
    btn.addEventListener('click', function() {
      filterButtons.forEach(function(b) {
        b.classList.remove('filter-btn--active');
      });
      btn.classList.add('filter-btn--active');

      var filter = btn.getAttribute('data-filter');

      cards.forEach(function(card) {
        var categories = card.getAttribute('data-categories');
        if (filter === 'all' || categories.indexOf(filter) !== -1) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
});
</script>

<?php get_footer(); ?>
