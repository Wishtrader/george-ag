<?php
/**
 * Template Name: О музее
 * Template for the About page
 */

$hero_title = get_field('about_hero_title');
$hero_description = get_field('about_hero_description');
$hero_image = get_field('about_hero_image');
$hero_image_mobile = get_field('about_hero_image_mobile');
$hero_cta_primary_text = get_field('about_hero_cta_primary_text');
$hero_cta_primary_url = get_field('about_hero_cta_primary_url');
$hero_cta_secondary_text = get_field('about_hero_cta_secondary_text');
$hero_cta_secondary_url = get_field('about_hero_cta_secondary_url');

$mission_title = get_field('about_mission_title');
$mission_description = get_field('about_mission_description');
$stat_1_icon = get_field('about_stat_1_icon');
$stat_1_number = get_field('about_stat_1_number');
$stat_1_label = get_field('about_stat_1_label');
$stat_2_icon = get_field('about_stat_2_icon');
$stat_2_number = get_field('about_stat_2_number');
$stat_2_label = get_field('about_stat_2_label');
$stat_3_icon = get_field('about_stat_3_icon');
$stat_3_number = get_field('about_stat_3_number');
$stat_3_label = get_field('about_stat_3_label');

$what_to_do_title = get_field('about_what_to_do_title');
$what_to_do_items = get_field('about_what_to_do_items');

$expositions_title = get_field('about_expositions_title');
$expositions_link_text = get_field('about_expositions_link_text');
$expositions_list = get_field('about_expositions_list');

$education_title = get_field('about_education_title');
$education_link_text = get_field('about_education_link_text');
$education_lectures_title = get_field('about_education_lectures_title');
$education_lectures_description = get_field('about_education_lectures_description');
$education_lectures_items = get_field('about_education_lectures_items');
$education_lectures_image = get_field('about_education_lectures_image');
$education_lectures_button = get_field('about_education_lectures_button');
$education_masterclass_title = get_field('about_education_masterclass_title');
$education_masterclass_description = get_field('about_education_masterclass_description');
$education_masterclass_items = get_field('about_education_masterclass_items');
$education_masterclass_image = get_field('about_education_masterclass_image');
$education_masterclass_button = get_field('about_education_masterclass_button');

$shop_title = get_field('about_shop_title');
$shop_link_text = get_field('about_shop_link_text');
$shop_products = wc_get_products(array(
    'status'   => 'publish',
    'limit'    => 4,
    'order'    => 'DESC',
    'orderby'  => 'date',
    'category' => array( 'knigi' ),
));

$events_title = get_field('about_events_title');
$events_link_text = get_field('about_events_link_text');
$events = get_field('about_events_list');

$cta_background_image = get_field('about_cta_background_image');
$cta_background_image_mobile = get_field('about_cta_background_image_mobile');
$cta_title = get_field('about_cta_title');
$cta_primary = get_field('about_cta_primary');
$cta_secondary = get_field('about_cta_secondary');

function get_about_event_type_icon($type) {
    $icons = array(
        'masterclass' => '<img src="' . esc_url(get_template_directory_uri() . '/img/palette-line.svg') . '">',
        'lecture' => '<img src="' . esc_url(get_template_directory_uri() . '/img/book-open-line.svg') . '">',
        'meeting' => '<img src="' . esc_url(get_template_directory_uri() . '/img/chat-3-line.svg') . '">',
        'family' => '<img src="' . esc_url(get_template_directory_uri() . '/img/palette-line.svg') . '">',
    );
    return $icons[$type] ?? $icons['masterclass'];
}

function get_about_event_type_label($type) {
    $labels = array(
        'masterclass' => 'Мастер-класс',
        'lecture' => 'Лекция',
        'meeting' => 'Встреча',
        'family' => 'Семейное занятие',
    );
    return $labels[$type] ?? 'Событие';
}
?>

<?php get_header(); ?>

<!-- ============ HERO ============ -->
<?php if ($hero_title || $hero_description): ?>
<section class="mt-[40px] lg:mt-[60px] relative overflow-hidden lg:h-[376px]">
  <div class="absolute inset-0 hidden lg:block" style="background-image: url('<?php echo esc_url($hero_image); ?>'); background-size: cover; background-position: center;"></div>

  <div class="container-main relative h-full flex flex-col justify-center py-10">
    <nav class="absolute top-0 lg:top-6 left-[10px] lg:left-[20px]">
      <ul class="breadcrumbs">
        <li><a href="/">Главная</a></li>
        <li><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="" class="breadcrumbs-separator"></li>
        <li class="breadcrumbs-current">О музее</li>
      </ul>
    </nav>

    <div class="">
      <?php if ($hero_title): ?>
      <h1 class="text-[34px] sm:text-[44px] lg:text-[50px] leading-[1.05] mb-4 !font-medium text-[#2D2926]">
        <?php echo esc_html($hero_title); ?>
      </h1>
      <?php endif; ?>
      <?php if ($hero_description): ?>
      <p class="text-[16px] md:text-[20px] max-w-[692px] text-[#2D2926] mb-5 lg:mb-8 leading-[1.2]">
        <?php echo wp_kses_post($hero_description); ?>
      </p>
      <?php endif; ?>
      <div class="flex flex-col sm:flex-row justify-start gap-2.5 lg:gap-5 w-full">
        <?php if ($hero_cta_primary_text): ?>
          <a href="/poster" class="btn-primary md:max-w-[285px]">
            <?php echo esc_html($hero_cta_primary_text); ?>
          </a>
        <?php endif; ?>
        <?php if ($hero_cta_secondary_text): ?>
          <a href="<?php echo esc_url($hero_cta_secondary_url ?: '#'); ?>" class="md:max-w-[285px] btn-secondary">
            <?php echo esc_html($hero_cta_secondary_text); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php if ($hero_image_mobile): ?>
<div class="lg:hidden px-2.5 -mt-4 relative z-10">
  <img src="<?php echo esc_url($hero_image_mobile); ?>" alt="" class="w-full h-auto object-cover rounded-[15px]">
</div>
<?php endif; ?>
<?php endif; ?>

<!-- ============ MISSION / STATS ============ -->
<?php if ($mission_title || $mission_description): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-10 lg:gap-14 items-start">
      <div class="max-w-[590px] w-full	">
        <?php if ($mission_title): ?>
        <h2 class="mb-5 !text-xl lg:!text-4xl text-[#2D2926] !font-normal leading-[1.2]">
          <?php echo esc_html($mission_title); ?>
        </h2>
        <?php endif; ?>
        <?php if ($mission_description): ?>
        <p class="text-[15px] md:text-[20px] text-[#2D2926] leading-[1.2] !leading-[1.2]">
          <?php echo wp_kses_post($mission_description); ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
        <?php if ($stat_1_number): ?>
        <div class="text-center bg-[#F2E8DA] rounded-[24px] border border-px border-[#D9CCBC] shadow-lg lg:px-[20px] lg:py-[50px] p-2.5">
          <?php if ($stat_1_icon): ?>
            <img src="<?php echo esc_url($stat_1_icon); ?>" alt="icon" class="w-auto h-[26px] lg:h-[53px] object-contain mx-auto mb-2.5 lg:mb-5">
          <?php endif; ?>
          <div class="font-['Literata'] text-[20px] lg:text-[36px] font-light text-black mb-2.5 lg:mb-5">
            <?php echo esc_html($stat_1_number); ?>
          </div>
          <div class="text-[13px] lg:text-lg text-black leading-[1.2] font-light">
            <?php echo esc_html($stat_1_label); ?>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($stat_2_number): ?>
        <div class="text-center bg-[#F2E8DA] rounded-[24px] border border-px border-[#D9CCBC] shadow-lg lg:px-[20px] lg:py-[50px] p-2.5">
          <?php if ($stat_2_icon): ?>
            <img src="<?php echo esc_url($stat_2_icon); ?>" alt="" class="w-auto h-[26px] lg:h-[53px] object-contain mx-auto mb-2.5 lg:mb-5">
          <?php endif; ?>
          <div class="font-['Literata'] text-[20px] lg:text-[36px] font-light text-black mb-2.5 lg:mb-5">
            <?php echo esc_html($stat_2_number); ?>
          </div>
          <div class="text-[13px] lg:text-lg text-black leading-[1.2] font-light">
            <?php echo esc_html($stat_2_label); ?>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($stat_3_number): ?>
        <div class="text-center bg-[#F2E8DA] rounded-[24px] border border-px border-[#D9CCBC] shadow-lg lg:px-[20px] lg:py-[50px] col-span-2 lg:col-span-1 p-2.5">
          <?php if ($stat_3_icon): ?>
            <img src="<?php echo esc_url($stat_3_icon); ?>" alt="icon" class="w-auto h-[26px] lg:h-[53px] object-contain mx-auto mb-2.5 lg:mb-5">
          <?php endif; ?>
          <div class="font-['Literata'] text-[20px] lg:text-[36px] font-light text-black mb-2.5 lg:mb-5">
            <?php echo esc_html($stat_3_number); ?>
          </div>
          <div class="text-[13px] lg:text-lg text-black leading-[1.2] font-light">
            <?php echo esc_html($stat_3_label); ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ WHAT TO DO IN MUSEUM ============ -->
<?php
$what_to_do_items_default = array(
	array(
		'icon'  => get_template_directory_uri() . '/img/ph-museum.svg',
		'title' => 'Посетить музей',
		'description' => 'Постоянные и временные выставки, авторские ландшафты и атмосферные пространства — всё для вдохновения.',
	),
	array(
		'icon'  => get_template_directory_uri() . '/img/ph-museum.svg',
		'title' => 'Выбрать образовательный формат',
		'description' => 'Лекции, экскурсии,meetings в камерном формате и творческие проекты — выбирайте то, что ближе.',
	),
	array(
		'icon'  => get_template_directory_uri() . '/img/ph-museum.svg',
		'title' => 'Прийти на мастер-класс',
		'description' => 'Практические занятия для взрослых и детей, где можно создать свою работу.',
	),
	array(
		'icon'  => get_template_directory_uri() . '/img/ph-museum.svg',
		'title' => 'Купить билет или абонемент',
		'description' => 'Онлайн-покупка билета в музей или абонемента для регулярных визитов.',
	),
	array(
		'icon'  => get_template_directory_uri() . '/img/ph-museum.svg',
		'title' => 'Купить искусство и сувениры',
		'description' => 'Каталоги выставок, постеры, керамика, открытки, авторские сувениры.',
	),
	array(
		'icon'  => get_template_directory_uri() . '/img/ph-museum.svg',
		'title' => 'Стать частью культурной программы',
		'description' => 'Волонтёрство, кураторство, совместные проекты — включайтесь в культурную жизнь.',
	),
);
$what_to_do_items = $what_to_do_items ?: $what_to_do_items_default;
?>
<?php if ($what_to_do_items): ?>
<section class="py-8 lg:py-20 bg-[#FAF6EF]">
  <div class="container-main">
    <h2 class="mb-15">
      <?php echo esc_html($what_to_do_title ?: 'Что можно сделать в музее'); ?>
    </h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      <?php foreach ($what_to_do_items as $item): ?>
      <div class="flex flex-col items-start rounded-[24px] px-3 py-5 shadow-lg border-[1px] border-[#D9CCBC]">
        <?php if (!empty($item['icon'])): ?>
        <div class="w-auto h-[30px] lg:h-[53px] mb-4">
          <img src="<?php echo esc_url($item['icon']); ?>" alt="" class="w-full h-full object-contain">
        </div>
        <?php endif; ?>
        <p class="text-xl lg:text-[28px] font-medium mb-5 text-black leading-[1.2]">
          <?php echo esc_html($item['title']); ?>
        </p>
        <p class="text-[15px] text-[#2D2926] lg:text-lg leading-[1.2]">
          <?php echo esc_html($item['description']); ?>
        </p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ EXPOSITIONS ============ -->
<?php
$expositions_query = new WP_Query( array(
	'post_type'      => 'event',
	'posts_per_page' => 4,
	'tax_query'      => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => 'vystavki',
		),
	),
	'orderby'        => 'date',
	'order'          => 'DESC',
) );
if ( $expositions_query->have_posts() ):
?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="flex flex-col md:flex-row lg:items-end gap-5 justify-between mb-10">
      <h2 class="!font-medium md:mb-10">
        <?php echo esc_html($expositions_title ?: 'Экспозиции музея'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/events/')); ?>" class="link-arrow text-base md:mb-10">
        <?php echo esc_html($expositions_link_text ?: 'Все экспозиции'); ?>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>

    <!-- Desktop: Grid -->
    <div class="hidden sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php while ( $expositions_query->have_posts() ): $expositions_query->the_post();
        $event_id = get_the_ID();
        $event_date = get_field('event_date');
        $event_time = get_field('event_time');
        $event_brief = get_field('event_brief_description');
        $event_thumbnail = get_field('event_thumbnail');
        $event_hero_image = get_field('event_hero_image');
        $card_image = $event_thumbnail ?: $event_hero_image;
        $event_terms = get_the_terms( $event_id, 'event_category' );
        $cat_label = '';
        $cat_icon_url = '';
        if ( $event_terms && ! is_wp_error( $event_terms ) ) {
          $cat_label = $event_terms[0]->name;
          $cat_icon_url = get_term_meta( $event_terms[0]->term_id, 'event_cat_icon', true );
        }
      ?>
      <a href="<?php the_permalink(); ?>" class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col group">
        <?php if ( $card_image ): ?>
          <img src="<?php echo esc_url( $card_image ); ?>"
               alt="<?php the_title_attribute(); ?>"
               class="aspect-[4/3] object-cover w-full group-hover:scale-105 transition duration-300 max-h-[162px]">
        <?php else: ?>
          <div class="ph ph-art1 aspect-[4/3]"></div>
        <?php endif; ?>
        <div class="p-5 flex-1 flex flex-col">
          <h3 class="!font-['Golos_Text'] text-base lg:text-xl !font-medium mb-2"><?php the_title(); ?></h3>
          <?php if ( $event_brief ): ?>
          <p class="text-base text-black mb-4 flex-1 leading-[1.2]"><?php echo wp_trim_words( $event_brief, 20 ); ?></p>
          <?php endif; ?>
          <span class="link-arrow text-base mt-auto">
            Подробнее
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </span>
        </div>
      </a>
      <?php endwhile; ?>
    </div>

    <!-- Mobile: Swiper -->
    <div class="sm:hidden">
      <div class="swiper about-expositions-swiper">
        <div class="swiper-wrapper">
          <?php $expositions_query->rewind_posts(); while ( $expositions_query->have_posts() ): $expositions_query->the_post();
            $event_id = get_the_ID();
            $event_brief = get_field('event_brief_description');
            $event_thumbnail = get_field('event_thumbnail');
            $event_hero_image = get_field('event_hero_image');
            $card_image = $event_thumbnail ?: $event_hero_image;
            $event_terms = get_the_terms( $event_id, 'event_category' );
            $cat_label = '';
            $cat_icon_url = '';
            if ( $event_terms && ! is_wp_error( $event_terms ) ) {
              $cat_label = $event_terms[0]->name;
              $cat_icon_url = get_term_meta( $event_terms[0]->term_id, 'event_cat_icon', true );
            }
          ?>
          <div class="swiper-slide">
            <a href="<?php the_permalink(); ?>" class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col group">
              <?php if ( $card_image ): ?>
                <img src="<?php echo esc_url( $card_image ); ?>"
                     alt="<?php the_title_attribute(); ?>"
                     class="aspect-[4/3] object-cover w-full max-h-[162px]">
              <?php else: ?>
                <div class="ph ph-art1 aspect-[4/3]"></div>
              <?php endif; ?>
              <div class="p-2.5 flex-1 flex flex-col">
                <h3 class="!font-['Golos_Text'] text-base !font-medium mb-2"><?php the_title(); ?></h3>
                <?php if ( $event_brief ): ?>
                <p class="text-[13px] text-black mb-4 flex-1 leading-[1.2]"><?php echo wp_trim_words( $event_brief, 20 ); ?></p>
                <?php endif; ?>
                <span class="btn-primary mt-auto">Подробнее</span>
              </div>
            </a>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>

  </div>
</section>
<?php wp_reset_postdata(); endif; ?>

<!-- ============ SPECIAL EXPOSITION BANNER ============ -->
<?php get_template_part('template-parts/special-exposition'); ?>

<!-- ============ EDUCATION PROGRAM ============ -->
<?php
$education_lectures_items_default = array(
	array('text' => 'Групповые и индивидуальные экскурсии'),
	array('text' => 'Авторские лекции по истории искусства'),
	array('text' => 'Тематические встречи с искусствоведами'),
);
$education_lectures_items = $education_lectures_items ?: $education_lectures_items_default;

$education_masterclass_items_default = array(
	array('text' => 'Пейзажная живопись'),
	array('text' => 'Портретная живопись'),
	array('text' => 'Рисунок карандашом и красками'),
);
$education_masterclass_items = $education_masterclass_items ?: $education_masterclass_items_default;
?>
<?php if ($education_lectures_title || $education_masterclass_title): ?>
<section class="py-8 lg:py-20">
  <div class="container-main">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-5">
      <h2 class="!font-medium max-w-[680px] md:!leading-[1.6]">
        <?php echo esc_html($education_title ?: 'Образовательная и творческая программа'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/classes/')); ?>" class="link-arrow text-base">
        <?php echo esc_html($education_link_text ?: 'Все мастер-классы и лекции'); ?>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>

    <!-- Lectures: Image left, text right -->
    <div class="grid lg:grid-cols-[3fr_2fr] gap-8 lg:gap-5 mb-10 lg:mb-14 items-center">
      <div class="rounded-[24px] overflow-hidden order-2 lg:order-1">
        <?php if ($education_lectures_image): ?>
          <img src="<?php echo esc_url($education_lectures_image); ?>"
               alt="<?php echo esc_attr($education_lectures_title); ?>"
               class="w-full h-auto object-cover">
        <?php else: ?>
          <div class="ph ph-art1 aspect-[4/3]"></div>
        <?php endif; ?>
      </div>
      <div class="flex flex-col order-1 lg:order-2">
        <?php if ($education_lectures_title): ?>
        <h3 class="!font-['Golos_Text'] text-[20px] lg:text-[28px] !font-medium mb-4 lg:mb-[58px] text-black leading-[1.2]">
          <?php echo esc_html($education_lectures_title); ?>
        </h3>
        <?php endif; ?>
        <?php if ($education_lectures_description): ?>
        <p class="text-[15px] lg:text-xl text-[#2D2926] mb-6 leading-[1.2]">
          <?php echo wp_kses_post($education_lectures_description); ?>
        </p>
        <?php endif; ?>
        <?php if ($education_lectures_items): ?>
        <ul class="text-[15px] lg:text-lg text-black mb-10 leading-[1.2]">
          <?php foreach ($education_lectures_items as $item): ?>
          <li class="flex items-start gap-2">
            <span class="text-[#2D2926] mt-0.5">&#8226;</span>
            <span><?php echo esc_html($item['text']); ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <?php if ($education_lectures_button): ?>
        <a href="<?php echo esc_url(home_url('/classes/')); ?>" class="btn-primary w-full text-center">
          <?php echo esc_html($education_lectures_button); ?>
        </a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Masterclasses: Text left, image right -->
    <div class="grid lg:grid-cols-[2fr_3fr] gap-8 lg:gap-5 items-center">
      <div class="flex flex-col order-1 lg:order-1">
        <?php if ($education_masterclass_title): ?>
        <h3 class="!font-['Golos_Text'] text-[20px] lg:text-[28px] !font-medium mb-4 lg:mb-[28px] text-black leading-[1.2]">
          <?php echo esc_html($education_masterclass_title); ?>
        </h3>
        <?php endif; ?>
        <?php if ($education_masterclass_description): ?>
        <p class="text-[15px] lg:text-xl text-[#2D2926] mb-5 leading-[1.2]">
          <?php echo wp_kses_post($education_masterclass_description); ?>
        </p>
        <?php endif; ?>
        <?php if ($education_masterclass_items): ?>
        <ul class="text-[15px] lg:text-lg text-black mb-10 leading-[1.2]">
          <?php foreach ($education_masterclass_items as $item): ?>
          <li class="flex items-start gap-2">
            <span class="text-[#2D2926] mt-0.5">&#8226;</span>
            <span><?php echo esc_html($item['text']); ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <?php if ($education_masterclass_button): ?>
        <a href="<?php echo esc_url(home_url('/classes/')); ?>" class="btn-primary w-full text-center">
          <?php echo esc_html($education_masterclass_button); ?>
        </a>
        <?php endif; ?>
      </div>
      <div class="rounded-[24px] overflow-hidden order-2 lg:order-2">
        <?php if ($education_masterclass_image): ?>
          <img src="<?php echo esc_url($education_masterclass_image); ?>"
               alt="<?php echo esc_attr($education_masterclass_title); ?>"
               class="w-full h-auto object-cover">
        <?php else: ?>
          <div class="ph ph-art2 aspect-[4/3]"></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ MUSEUM SHOP ============ -->
<?php if ($shop_products): ?>
<section class="py-8 lg:py-16">
  <div class="container-main">
    <div class="flex flex-col lg:flex-row gap-5 lg:items-center justify-between mb-8 lg:mb-[60px]">
      <h2 class="max-w-[740px] leading-[1.2] !font-medium">
        <?php echo esc_html($shop_title ?: 'Искусство, книги и музейные сувениры'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/magazin/')); ?>" class="link-arrow text-base">
        <?php echo esc_html($shop_link_text ?: 'В магазин'); ?>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    
    <!-- Desktop: Grid -->
    <div class="hidden sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($shop_products as $product): ?>
        <?php
        $p_id = $product->get_id();
        $p_name = $product->get_name();
        $p_price = $product->get_price_html();
        $p_desc = $product->get_short_description();
        $p_image = wp_get_attachment_url($product->get_image_id());
        $p_link = get_permalink($p_id);
        ?>
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col">
          <a href="<?php echo esc_url($p_link); ?>" class="block">
            <?php if ($p_image): ?>
              <img src="<?php echo esc_url($p_image); ?>"
                   alt="<?php echo esc_attr($p_name); ?>"
                   class="aspect-square object-cover w-full">
            <?php else: ?>
              <div class="ph ph-shop aspect-square"></div>
            <?php endif; ?>
          </a>
          <div class="p-5 flex flex-col flex-1">
            <h3 class="!font-['Golos_Text'] text-base lg:text-xl mb-2 leading-[1.2]">
              <a href="<?php echo esc_url($p_link); ?>" class="hover:text-[#E8872C] transition">
                <?php echo esc_html($p_name); ?>
              </a>
            </h3>
            <?php if ($p_desc): ?>
              <p class="text-[13px] lg:text-base text-[#2D2926] mb-4 leading-[1.2] line-clamp-3">
                <?php echo wp_kses_post($p_desc); ?>
              </p>
              <hr class="text-[#D9CCBC] mb-5" />
            <?php endif; ?>
            <div class="mt-auto flex items-center gap-3">
              <?php if ($p_price): ?>
                <span class="font-medium text-xl text-[#DA7421]"><?php echo wp_kses_post($p_price); ?></span>
              <?php endif; ?>
              <a href="<?php echo esc_url($p_link); ?>" class="btn-primary !py-2 !px-4 text-sm ml-auto whitespace-nowrap">
                В корзину
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Mobile: Swiper -->
    <div class="sm:hidden">
      <div class="swiper about-shop-swiper">
        <div class="swiper-wrapper">
          <?php foreach ($shop_products as $product): ?>
            <?php
            $p_id = $product->get_id();
            $p_name = $product->get_name();
            $p_price = $product->get_price_html();
            $p_desc = $product->get_short_description();
            $p_image = wp_get_attachment_url($product->get_image_id());
            $p_link = get_permalink($p_id);
            ?>
          <div class="swiper-slide">
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col">
              <a href="<?php echo esc_url($p_link); ?>" class="block">
                <?php if ($p_image): ?>
                  <img src="<?php echo esc_url($p_image); ?>"
                       alt="<?php echo esc_attr($p_name); ?>"
                       class="object-cover w-full min-h-[280px]">
                <?php else: ?>
                  <div class="ph ph-shop aspect-square"></div>
                <?php endif; ?>
              </a>
              <div class="p-5 flex flex-col flex-1">
                <h3 class="!font-['Golos_Text'] text-base mb-2 leading-[1.2]">
                  <a href="<?php echo esc_url($p_link); ?>" class="hover:text-[#E8872C] transition">
                    <?php echo esc_html($p_name); ?>
                  </a>
                </h3>
                <?php if ($p_desc): ?>
                  <p class="text-[13px] text-[#2D2926] mb-4 leading-[1.2] line-clamp-3">
                    <?php echo wp_kses_post($p_desc); ?>
                  </p>
                  <hr class="text-[#D9CCBC] mb-5" />
                <?php endif; ?>
                <div class="mt-auto flex items-center gap-3">
                  <?php if ($p_price): ?>
                    <span class="font-medium text-xl text-[#DA7421]"><?php echo wp_kses_post($p_price); ?></span>
                  <?php endif; ?>
                  <a href="<?php echo esc_url($p_link); ?>" class="btn-primary !py-2 !px-4 text-sm ml-auto whitespace-nowrap">
                    В корзину
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="flex items-center justify-between mt-2">
        <div class="about-shop-nav-prev cursor-pointer w-12 h-12 flex items-center justify-center rounded-full">
          <img src="<?php echo get_template_directory_uri(); ?>/img/alm.svg" alt="Назад" class="w-6 h-6">
        </div>
        <div class="about-shop-nav-next cursor-pointer w-12 h-12 flex items-center justify-center rounded-full">
          <img src="<?php echo get_template_directory_uri(); ?>/img/arm.svg" alt="Вперёд" class="w-6 h-6">
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ EVENTS ============ -->
<?php
$events_default = array(
	array(
		'image'       => '',
		'type'        => 'masterclass',
		'datetime'    => '22 июня, 15:00',
		'title'       => 'Мастер-класс: Создаём свою картину для детей и взрослых',
		'description' => 'Создайте свою картину для детей и взрослых.',
		'button_text' => 'Подробнее',
	),
	array(
		'image'       => '',
		'type'        => 'lecture',
		'datetime'    => '25 июня, 19:00',
		'title'       => 'Лекция: Как понимать искусство',
		'description' => 'О жанрах, стилях и ощущениях.',
		'button_text' => 'Подробнее',
	),
	array(
		'image'       => '',
		'type'        => 'meeting',
		'datetime'    => '28 июня, 18:00',
		'title'       => 'Встреча: Дизайн и пространство',
		'description' => 'О дизайне, архитектуре и урбанистике.',
		'button_text' => 'Подробнее',
	),
	array(
		'image'       => '',
		'type'        => 'family',
		'datetime'    => '30 июня, 12:00',
		'title'       => 'Семейное занятие: Цвет и форма',
		'description' => 'Семейное творческое занятие в музее.',
		'button_text' => 'Подробнее',
	),
);
$events = $events ?: $events_default;
?>
<?php if ($events): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2>
        <?php echo esc_html($events_title ?: 'События, ради которых хочется возвращаться'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/events/')); ?>" class="link-arrow text-sm">
        <?php echo esc_html($events_link_text ?: 'Смотреть все события'); ?>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($events as $event): ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <?php if (!empty($event['image'])): ?>
          <img src="<?php echo esc_url($event['image']); ?>" 
               alt="<?php echo esc_attr($event['title']); ?>" 
               class="aspect-square object-cover w-full">
        <?php else: ?>
          <div class="ph ph-art1 aspect-square"></div>
        <?php endif; ?>
        <div class="p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="event-badge">
              <?php echo get_about_event_type_icon($event['type']); ?>
              <?php echo esc_html(get_about_event_type_label($event['type'])); ?>
            </span>
            <span class="text-xs text-[#6B5A4A] font-medium"><?php echo esc_html($event['datetime']); ?></span>
          </div>
          <h3 class="font-['Literata'] text-lg font-semibold mb-3"><?php echo esc_html($event['title']); ?></h3>
          <p class="text-sm text-[#6B5A4A] mb-5"><?php echo esc_html($event['description']); ?></p>
          <a href="#" class="btn-outline w-full !py-2.5 text-sm">
            <?php echo esc_html($event['button_text']); ?>
          </a>
        </div>
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
  <div class="max-w-[1200px] w-full mx-auto px-[10px] flex flex-col lg:flex-row items-center justify-center lg:justify-between h-full relative text-center">
    <?php if ($cta_title): ?>
    <h2 class="!text-white mb-6 mx-auto max-w-[230px] md:max-w-full lg:text-left !leading-[1.5]">
      <?php echo esc_html($cta_title); ?>
    </h2>
    <?php endif; ?>
    <div class="flex flex-col gap-[10px] md:gap-5 justify-center w-full lg:items-end">
      <?php if ($cta_primary): ?>
        <a href="#" class="btn-primary md:max-w-[485px]">
          <?php echo esc_html($cta_primary); ?>
        </a>
      <?php endif; ?>
      <?php if ($cta_secondary): ?>
        <a href="#" class="btn-secondary md:max-w-[485px]">
          <?php echo esc_html($cta_secondary); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
