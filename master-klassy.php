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

$filters = get_field('mk_filters');

$featured_title = get_field('mk_featured_title') ?: 'Живопись акрилом: весенний пейзаж';
$featured_description = get_field('mk_featured_description') ?: 'Пишем яркий пейзаж под руководством преподавателя. Для взрослых и подростков.';
$featured_image = get_field('mk_featured_image');
$featured_date = get_field('mk_featured_date') ?: '23 мая, пт';
$featured_time = get_field('mk_featured_time') ?: '18:30';
$featured_audience = get_field('mk_featured_audience') ?: 'Для взрослых';
$featured_button_detail_text = get_field('mk_featured_button_detail_text') ?: 'Подробнее';
$featured_button_detail_url = get_field('mk_featured_button_detail_url') ?: '#';
$featured_button_buy_text = get_field('mk_featured_button_buy_text') ?: 'Купить билет';
$featured_button_buy_url = get_field('mk_featured_button_buy_url') ?: '#';

$classes_title = get_field('mk_classes_title') ?: 'Мастер-классы';
$classes = get_field('mk_classes');

$formats_title = get_field('mk_formats_title') ?: 'Форматы мастер-классов';
$formats = get_field('mk_formats');

$subscriptions_title = get_field('mk_subscriptions_title') ?: 'Абонементы и регулярные форматы';

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
    <div class="flex flex-wrap gap-[10px] lg:gap-[19px] justify-center lg:justify-start" id="mk-filters">
      <button data-filter="all" class="filter-btn filter-btn--active">
        Все мастер-классы
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

<!-- ============ FEATURED CLASS ============ -->
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
              <span class="featured-card__meta-value" style="color: #E8A62E;">
                <?php echo esc_html($featured_date); ?>
              </span>
            </div>
            <?php if ($featured_time): ?>
            <div class="featured-card__meta-item">
              <span class="featured-card__meta-value" style="color: #E8A62E;">
                <?php echo esc_html($featured_time); ?>
              </span>
            </div>
            <?php endif; ?>
            <?php if ($featured_audience): ?>
            <div class="featured-card__meta-item">
              <span class="featured-card__meta-value" style="color: #E8A62E;">
                <?php echo esc_html($featured_audience); ?>
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

<!-- ============ CLASSES GRID ============ -->
<?php if ($classes): ?>
<section id="events" class="py-6">
  <div class="container-main">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5" id="mk-grid">
      <?php foreach ($classes as $class):
        $audience_labels = array(
          'for_children' => 'Для детей',
          'for_adults'   => 'Для взрослых',
          'family'       => 'Семейное',
        );
        $audience_label = $audience_labels[$class['audience']] ?? 'Для детей';
        $audience_icon_url = '';
        if (!empty($class['audience_icon'])) {
          $audience_icon_url = $class['audience_icon'];
        }
      ?>
      <div class="bg-white rounded-3xl overflow-hidden shadow-sm flex flex-col mk-card" data-categories="<?php echo esc_attr($class['category'] ?? ''); ?>">
        <?php if (!empty($class['image'])): ?>
          <img src="<?php echo esc_url($class['image']); ?>"
               alt="<?php echo esc_attr($class['title']); ?>"
               class="w-full h-[162px] object-cover">
        <?php else: ?>
          <div class="ph ph-art1 w-full h-[162px]"></div>
        <?php endif; ?>
        <div class="p-5 flex-1 flex flex-col">
          <div class="flex items-center justify-between mb-3">
            <span class="flex items-center gap-1.5 text-xs font-medium leading-[1.2]" style="color: <?php echo esc_attr(mk_get_event_type_color($class['category'] ?? '')); ?>">
              <?php echo esc_html(mk_get_event_type_label($class['category'] ?? '')); ?>
            </span>
            <span class="text-xs font-medium whitespace-nowrap leading-[1.2]" style="color: <?php echo esc_attr(mk_get_event_type_color($class['category'] ?? '')); ?>">
              <?php echo esc_html($class['date'] ?? ''); ?>
            </span>
          </div>
          <h3 class="!font-['Golos_Text'] text-[16px] lg:text-[18px] !font-medium mb-2 leading-snug"><?php echo esc_html($class['title']); ?></h3>
          <?php if (!empty($class['description'])): ?>
          <p class="text-[13px] lg:text-[14px] text-[#2D2926] mb-2 leading-[1.2] flex-1 line-clamp-3"><?php echo esc_html($class['description']); ?></p>
          <?php endif; ?>
          <div class="flex items-center gap-2 text-xs text-[#6B5A4A] mb-3">
            <?php if ($audience_icon_url): ?>
              <img src="<?php echo esc_url($audience_icon_url); ?>" alt="" class="w-5 h-5">
            <?php endif; ?>
            <span class="text-[13px]"><?php echo esc_html($audience_label); ?></span>
          </div>
          <?php if (!empty($class['price'])): ?>
          <p class="text-[15px] font-medium text-[#2D2926] mb-3"><?php echo esc_html($class['price']); ?></p>
          <?php endif; ?>
          <?php if (!empty($class['button_text']) && !empty($class['button_url'])): ?>
          <a href="<?php echo esc_url($class['button_url']); ?>" class="btn-outline w-full !py-2.5 text-sm mt-auto">
            <?php echo esc_html($class['button_text']); ?>
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
  <div class="container-main !px-5">
    <h2 class="mb-10 lg:mb-14 !font-medium"><?php echo esc_html($subscriptions_title); ?></h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:pt-[10px]">
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
