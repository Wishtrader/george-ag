<?php
/**
 * Template Name: Афиша
 * Template for the Poster/Schedule page
 */

$hero_title = get_field('afisha_hero_title') ?: 'Афиша музея';
$hero_description = get_field('afisha_hero_description') ?: 'Мастер-классы, лекции, встречи, показы и специальные события, на которые можно записаться уже сейчас.';
$hero_image = get_field('afisha_hero_image');
$hero_cta_primary_text = get_field('afisha_hero_cta_primary_text') ?: 'Ближайшие события';
$hero_cta_primary_url = get_field('afisha_hero_cta_primary_url') ?: '#events';
$hero_cta_secondary_text = get_field('afisha_hero_cta_secondary_text') ?: 'Купить билет';
$hero_cta_secondary_url = get_field('afisha_hero_cta_secondary_url') ?: '#';

$featured_image_left = get_field('afisha_featured_image_left');
$featured_image_right = get_field('afisha_featured_image_right');
$featured_type = get_field('afisha_featured_type');
$featured_type_icon = get_field('afisha_featured_type_icon');
$featured_title = get_field('afisha_featured_title');
$featured_description = get_field('afisha_featured_description');
$featured_location = get_field('afisha_featured_location');
$featured_location_icon = get_field('afisha_featured_location_icon');
$featured_date = get_field('afisha_featured_date');
$featured_time = get_field('afisha_featured_time');
$featured_button_detail_text = get_field('afisha_featured_button_detail_text') ?: 'Подробнее';
$featured_button_detail_url = get_field('afisha_featured_button_detail_url') ?: '#';
$featured_button_buy_text = get_field('afisha_featured_button_buy_text') ?: 'Купить билет';
$featured_button_buy_url = get_field('afisha_featured_button_buy_url') ?: '#';

$cta_background_image = get_field('afisha_cta_background_image');
$cta_background_image_mobile = get_field('afisha_cta_background_image_mobile');
$cta_title = get_field('afisha_cta_title') ?: 'Выберите событие и приходите в музей';
$cta_primary = get_field('afisha_cta_primary') ?: 'Купить билет';
$cta_primary_url = get_field('afisha_cta_primary_url') ?: '#';
$cta_secondary = get_field('afisha_cta_secondary') ?: 'Посмотреть афишу';
$cta_secondary_url = get_field('afisha_cta_secondary_url') ?: '#';

$subscriptions_title = get_field('afisha_subscriptions_title') ?: 'Абонементы и регулярные форматы';

$event_categories = get_terms(array(
	'taxonomy'   => 'event_category',
	'hide_empty' => false,
));

$events_query = new WP_Query(array(
	'post_type'      => 'event',
	'posts_per_page' => 8,
	'orderby'        => 'date',
	'order'          => 'ASC',
));

function get_event_type_label($type) {
	$term = get_term_by('slug', $type, 'event_category');
	return $term ? $term->name : 'Событие';
}

function get_event_type_color($type) {
	$term = get_term_by('slug', $type, 'event_category');
	if ($term && !empty($term->meta['color'])) {
		return $term->meta['color'];
	}
	$colors = array(
		'masterclass'        => '#E8A62E',
		'lecture'            => '#28B6DA',
		'meeting'            => '#C61B8C',
		'tour'               => '#73B843',
		'movie'              => '#9B59B6',
		'for_children'       => '#E74C3C',
		'for_adults'         => '#3498DB',
		'family'             => '#F39C12',
		'semejnoe-zanyatie'  => '#73B843',
		'free'               => '#1ABC9C',
	);
	return $colors[$type] ?? '#6B5A4A';
}


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
        <li class="breadcrumbs-current">Афиша</li>
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
<?php if ($event_categories && !is_wp_error($event_categories)): ?>
<section class="py-8 lg:py-6">
  <div class="container-main">
    <div class="flex flex-wrap gap-[19px] justify-center lg:justify-start" id="event-filters">
      <button
        data-filter="all"
        class="filter-btn filter-btn--active"
      >
        Все события
      </button>
      <?php foreach ($event_categories as $category): ?>
      <button
        data-filter="<?php echo esc_attr($category->slug); ?>"
        class="filter-btn"
      >
        <?php echo esc_html($category->name); ?>
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
          <?php if ($featured_image_left): ?>
            <img src="<?php echo esc_url($featured_image_left); ?>"
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
            <?php if ($featured_type): ?>
            <div class="featured-card__meta-item">
              <span class="featured-card__meta-icon">
                <?php if ($featured_type_icon): ?>
                  <img src="<?php echo esc_url($featured_type_icon); ?>" alt="" class="featured-card__meta-icon-img">
                <?php else: ?>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                <?php endif; ?>
              </span>
              <span class="featured-card__meta-value" style="color: <?php echo esc_attr(get_event_type_color($featured_type)); ?>">
                <?php echo esc_html(get_event_type_label($featured_type)); ?>
              </span>
            </div>
            <?php endif; ?>
            <?php if ($featured_location): ?>
            <div class="featured-card__meta-item">
              <span class="featured-card__meta-icon">
                <?php if ($featured_location_icon): ?>
                  <img src="<?php echo esc_url($featured_location_icon); ?>" alt="" class="featured-card__meta-icon-img">
                <?php else: ?>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <?php endif; ?>
              </span>
              <span class="featured-card__meta-value" style="color: <?php echo esc_attr(get_event_type_color($featured_type)); ?>">
                <?php echo esc_html($featured_location); ?>
              </span>
            </div>
            <?php endif; ?>
            <?php if ($featured_date || $featured_time): ?>
            <div class="featured-card__meta-item">
              <span class="featured-card__meta-value" style="color: <?php echo esc_attr(get_event_type_color($featured_type)); ?>">
                <?php
                  $parts = array_filter(array($featured_date, $featured_time));
                  echo esc_html(implode(', ', $parts));
                ?>
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
          <?php if ($featured_image_right): ?>
            <img src="<?php echo esc_url($featured_image_right); ?>"
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
<?php if ($events_query->have_posts()): ?>
<section id="events" class="py-6">
  <div class="container-main">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5" id="events-grid">
      <?php while ($events_query->have_posts()): $events_query->the_post();
        $event_id = get_the_ID();
        $event_categories_list = wp_get_post_terms($event_id, 'event_category', array('fields' => 'slugs'));
        $event_date = get_field('event_date');
        $event_time = get_field('event_time');
        $event_location = get_field('event_location');
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
        );
        $audience_label = $audience_labels[$event_audience_type] ?? 'Для детей';
      ?>
      <div class="bg-white rounded-3xl overflow-hidden shadow-sm flex flex-col event-card" data-categories="<?php echo esc_attr(implode(',', $event_categories_list)); ?>">
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
            <span class="flex items-center gap-1.5 text-xs font-medium leading-[1.2]" style="color: <?php echo esc_attr(get_event_type_color($primary_cat)); ?>">
              <?php if ($cat_icon_url): ?>
                <img src="<?php echo esc_url($cat_icon_url); ?>" alt="" class="w-6 h-6">
              <?php endif; ?>
              <?php echo esc_html(get_event_type_label($primary_cat)); ?>
            </span>
            <span class="text-xs font-medium whitespace-nowrap leading-[1.2]" style="color: <?php echo esc_attr(get_event_type_color($primary_cat)); ?>">
              <?php echo esc_html($event_date . ($event_time ? ', ' . $event_time : '')); ?>
            </span>
          </div>
          <h3 class="!font-['Golos_Text'] text-[20px] !font-medium mb-2 lg:mt-2"><?php echo esc_html(get_the_title()); ?></h3>
          <?php if ($event_brief): ?>
          <p class="text-sm text-[#2D2926] mb-2 leading-[1.2] flex-1"><?php echo esc_html($event_brief); ?></p>
          <?php endif; ?>
          <div class="flex items-center gap-2 text-xs text-[#6B5A4A] mb-3">
            <?php if ($event_audience_icon): ?>
              <img src="<?php echo esc_url($event_audience_icon); ?>" alt="" class="w-6 h-6>
            <?php endif; ?>
            <span class="text-base"><?php echo esc_html($audience_label); ?></span>
          </div>
          <?php if ($event_price): ?>
          <p class="text-lg font-medium text-[#2D2926] mb-3"><?php echo esc_html($event_price); ?></p>
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

<!-- ============ SPECIAL EXPOSITION BANNER ============ -->
<?php get_template_part('template-parts/special-exposition'); ?>

<!-- ============ SUBSCRIPTIONS ============ -->
<?php
$subscriptions_query = new WP_Query(array(
	'post_type'      => 'subscription',
	'posts_per_page' => 3,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
));
if ($subscriptions_query->have_posts()):
?>
<section class="py-10 lg:py-16 lg:mt-28">
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
  var filterButtons = document.querySelectorAll('.filter-btn');
  var cards = document.querySelectorAll('.event-card');

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
