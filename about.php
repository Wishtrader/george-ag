<?php
/**
 * Template Name: О музее
 * Template for the About page
 */

$hero_title = get_field('about_hero_title');
$hero_description = get_field('about_hero_description');
$hero_image = get_field('about_hero_image');
$hero_cta_primary_text = get_field('about_hero_cta_primary_text');
$hero_cta_primary_url = get_field('about_hero_cta_primary_url');
$hero_cta_secondary_text = get_field('about_hero_cta_secondary_text');
$hero_cta_secondary_url = get_field('about_hero_cta_secondary_url');

$mission_title = get_field('about_mission_title');
$mission_description = get_field('about_mission_description');
$stat_1_number = get_field('about_stat_1_number');
$stat_1_label = get_field('about_stat_1_label');
$stat_2_number = get_field('about_stat_2_number');
$stat_2_label = get_field('about_stat_2_label');
$stat_3_number = get_field('about_stat_3_number');
$stat_3_label = get_field('about_stat_3_label');

$what_to_do_title = get_field('about_what_to_do_title');
$what_to_do_items = get_field('about_what_to_do_items');

$expositions_title = get_field('about_expositions_title');
$expositions_link_text = get_field('about_expositions_link_text');
$expositions_list = get_field('about_expositions_list');

$special_badge = get_field('about_special_badge');
$special_title = get_field('about_special_title');
$special_description = get_field('about_special_description');
$special_image = get_field('about_special_image');
$special_button_text = get_field('about_special_button_text');

$education_title = get_field('about_education_title');
$education_link_text = get_field('about_education_link_text');
$education_lectures_title = get_field('about_education_lectures_title');
$education_lectures_items = get_field('about_education_lectures_items');
$education_lectures_image = get_field('about_education_lectures_image');
$education_lectures_button = get_field('about_education_lectures_button');
$education_masterclass_title = get_field('about_education_masterclass_title');
$education_masterclass_items = get_field('about_education_masterclass_items');
$education_masterclass_image = get_field('about_education_masterclass_image');
$education_masterclass_button = get_field('about_education_masterclass_button');

$shop_title = get_field('about_shop_title');
$shop_link_text = get_field('about_shop_link_text');
$shop_products = wc_get_products(array(
    'status' => 'publish',
    'limit'  => 4,
    'order'  => 'DESC',
    'orderby' => 'date',
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
<section class="py-10 lg:py-16 relative overflow-hidden h-full">
  <div class="container-main flex flex-col justify-between h-full">
    <div class="">
      <div class="flex flex-col md:max-w-[57%] h-full items-start">
        <?php if ($hero_title): ?>
        <h1 class="text-[34px] sm:text-[44px] lg:text-[50px] leading-[1.05] mb-6 !font-medium">
          <?php echo esc_html($hero_title); ?>
        </h1>
        <?php endif; ?>
        <?php if ($hero_description): ?>
        <p class="text-[16px] md:text-[20px] text-[#2D2926] mb-8">
          <?php echo wp_kses_post($hero_description); ?>
        </p>
        <?php endif; ?>
        <div class="flex flex-col sm:flex-row gap-3 justify-between w-full">
          <?php if ($hero_cta_primary_text): ?>
            <a href="<?php echo esc_url($hero_cta_primary_url ?: '#'); ?>" class="btn-primary w-[285px]">
              <?php echo esc_html($hero_cta_primary_text); ?>
            </a>
          <?php endif; ?>
          <?php if ($hero_cta_secondary_text): ?>
            <a href="<?php echo esc_url($hero_cta_secondary_url ?: '#'); ?>" class="btn-outline">
              <?php echo esc_html($hero_cta_secondary_text); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
      
      <!-- Hero image -->
      <div class="absolute right-[-60px] top-[40px] max-w-[42%]">
        <?php if ($hero_image): ?>
          <img src="<?php echo esc_url($hero_image); ?>" 
               alt="<?php echo esc_attr($hero_title); ?>" 
               class="rounded-2xl aspect-[4/5] lg:aspect-[5/6] w-full lg:w-[120%] lg:-ml-[10%] shadow-lg object-cover">
        <?php else: ?>
          <div class="ph ph-museum rounded-2xl aspect-[4/5] lg:aspect-[5/6] w-full lg:w-[120%] lg:-ml-[10%] shadow-lg"></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ MISSION / STATS ============ -->
<?php if ($mission_title || $mission_description): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-10 lg:gap-20 items-start">
      <div>
        <?php if ($mission_title): ?>
        <h2 class="text-[32px] lg:text-[44px] mb-6">
          <?php echo esc_html($mission_title); ?>
        </h2>
        <?php endif; ?>
        <?php if ($mission_description): ?>
        <p class="text-[16px] md:text-[20px] text-[#6B5A4A] leading-relaxed">
          <?php echo wp_kses_post($mission_description); ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="grid grid-cols-3 gap-4">
        <?php if ($stat_1_number): ?>
        <div class="text-center p-4">
          <div class="font-['Literata'] text-[28px] lg:text-[40px] font-semibold text-[#F28A2E] mb-2">
            <?php echo esc_html($stat_1_number); ?>
          </div>
          <div class="text-sm lg:text-base text-[#6B5A4A]">
            <?php echo esc_html($stat_1_label); ?>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($stat_2_number): ?>
        <div class="text-center p-4">
          <div class="font-['Literata'] text-[28px] lg:text-[40px] font-semibold text-[#F28A2E] mb-2">
            <?php echo esc_html($stat_2_number); ?>
          </div>
          <div class="text-sm lg:text-base text-[#6B5A4A]">
            <?php echo esc_html($stat_2_label); ?>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($stat_3_number): ?>
        <div class="text-center p-4">
          <div class="font-['Literata'] text-[28px] lg:text-[40px] font-semibold text-[#F28A2E] mb-2">
            <?php echo esc_html($stat_3_number); ?>
          </div>
          <div class="text-sm lg:text-base text-[#6B5A4A]">
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
<section class="py-16 lg:py-20 bg-[#FAF6EF]">
  <div class="container-main">
    <h2 class="text-[32px] lg:text-[44px] mb-10">
      <?php echo esc_html($what_to_do_title ?: 'Что можно сделать в музее'); ?>
    </h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      <?php foreach ($what_to_do_items as $item): ?>
      <div class="bg-white rounded-2xl p-6 shadow-sm">
        <?php if (!empty($item['icon'])): ?>
        <div class="w-12 h-12 mb-4">
          <img src="<?php echo esc_url($item['icon']); ?>" alt="" class="w-full h-full object-contain">
        </div>
        <?php endif; ?>
        <h3 class="font-['Literata'] text-lg font-semibold mb-3">
          <?php echo esc_html($item['title']); ?>
        </h3>
        <p class="text-sm text-[#6B5A4A] leading-relaxed">
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
$expositions_list_default = array(
	array(
		'image'       => '',
		'title'       => 'Наивное искусство Беларуси',
		'description' => 'Коллекция работ белорусских художников-самоучек.',
	),
	array(
		'image'       => '',
		'title'       => 'Детство как искусство творчества',
		'description' => 'Детское творчество как источник вдохновения.',
	),
	array(
		'image'       => '',
		'title'       => 'Подарки тетрадки и летний артбук',
		'description' => 'Работы в технике коллажа, смешанной техники и авторской графики.',
	),
	array(
		'image'       => '',
		'title'       => 'Мудрость имени народного искусства',
		'description' => 'Традиции народного искусства в современном прочтении.',
	),
);
$expositions_list = $expositions_list ?: $expositions_list_default;
?>
<?php if ($expositions_list): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[32px] lg:text-[44px]">
        <?php echo esc_html($expositions_title ?: 'Экспозиции музея'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/expositions/')); ?>" class="link-arrow text-sm">
        <?php echo esc_html($expositions_link_text ?: 'Все экспозиции'); ?>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($expositions_list as $expo): ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <?php if (!empty($expo['image'])): ?>
          <img src="<?php echo esc_url($expo['image']); ?>" 
               alt="<?php echo esc_attr($expo['title']); ?>" 
               class="aspect-[4/3] object-cover w-full">
        <?php else: ?>
          <div class="ph ph-art1 aspect-[4/3]"></div>
        <?php endif; ?>
        <div class="p-5">
          <h3 class="font-['Literata'] text-lg font-semibold mb-2"><?php echo esc_html($expo['title']); ?></h3>
          <p class="text-sm text-[#6B5A4A] mb-4"><?php echo esc_html($expo['description']); ?></p>
          <a href="#" class="link-arrow text-sm">
            <?php echo esc_html($expositions_link_text ?: 'Все экспозиции'); ?>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ SPECIAL EXPOSITION BANNER ============ -->
<?php if ($special_title || $special_description): ?>
<section class="py-12">
  <div class="">
    <div class="relative overflow-hidden bg-[#E8872C]/10">
      <div class="grid md:grid-cols-2">
        <div class="p-8 md:p-12 lg:p-14 flex flex-col justify-center">
          <?php if ($special_badge): ?>
          <span class="text-sm font-medium text-[#E8872C] mb-3 uppercase tracking-wide">
            <?php echo esc_html($special_badge); ?>
          </span>
          <?php endif; ?>
          <?php if ($special_title): ?>
          <h2 class="text-[28px] lg:text-[40px] mb-4">
            <?php echo esc_html($special_title); ?>
          </h2>
          <?php endif; ?>
          <?php if ($special_description): ?>
          <p class="text-[17px] text-[#6B5A4A] mb-7">
            <?php echo esc_html($special_description); ?>
          </p>
          <?php endif; ?>
          <?php if ($special_button_text): ?>
            <div>
              <a href="<?php echo esc_url(home_url('/special/')); ?>" class="btn-primary">
                <?php echo esc_html($special_button_text); ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          <?php endif; ?>
        </div>
        <div class="relative">
          <?php if ($special_image): ?>
            <img src="<?php echo esc_url($special_image); ?>" 
                 alt="<?php echo esc_attr($special_title); ?>" 
                 class="aspect-[4/3] md:aspect-auto md:h-full object-cover w-full">
          <?php else: ?>
            <div class="ph ph-ussr aspect-[4/3] md:aspect-auto md:h-full"></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

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
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[32px] lg:text-[44px]">
        <?php echo esc_html($education_title ?: 'Образовательная и творческая программа'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/classes/')); ?>" class="link-arrow text-sm">
        <?php echo esc_html($education_link_text ?: 'Все мастер-классы и лекции'); ?>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-5">
      <!-- Lectures -->
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <?php if ($education_lectures_image): ?>
          <img src="<?php echo esc_url($education_lectures_image); ?>" 
               alt="<?php echo esc_attr($education_lectures_title); ?>" 
               class="aspect-[16/10] object-cover w-full">
        <?php else: ?>
          <div class="ph ph-art1 aspect-[16/10]"></div>
        <?php endif; ?>
        <div class="p-6">
          <?php if ($education_lectures_title): ?>
          <h3 class="font-['Literata'] text-xl font-semibold mb-4">
            <?php echo esc_html($education_lectures_title); ?>
          </h3>
          <?php endif; ?>
          <?php if ($education_lectures_items): ?>
          <ul class="text-sm text-[#6B5A4A] mb-5 space-y-2">
            <?php foreach ($education_lectures_items as $item): ?>
            <li class="flex items-start gap-2">
              <span class="text-[#F28A2E] mt-1">&#8226;</span>
              <?php echo esc_html($item['text']); ?>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <?php if ($education_lectures_button): ?>
          <a href="<?php echo esc_url(home_url('/classes/')); ?>" class="btn-primary">
            <?php echo esc_html($education_lectures_button); ?>
          </a>
          <?php endif; ?>
        </div>
      </div>
      
      <!-- Masterclasses -->
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <?php if ($education_masterclass_image): ?>
          <img src="<?php echo esc_url($education_masterclass_image); ?>" 
               alt="<?php echo esc_attr($education_masterclass_title); ?>" 
               class="aspect-[16/10] object-cover w-full">
        <?php else: ?>
          <div class="ph ph-art2 aspect-[16/10]"></div>
        <?php endif; ?>
        <div class="p-6">
          <?php if ($education_masterclass_title): ?>
          <h3 class="font-['Literata'] text-xl font-semibold mb-4">
            <?php echo esc_html($education_masterclass_title); ?>
          </h3>
          <?php endif; ?>
          <?php if ($education_masterclass_items): ?>
          <ul class="text-sm text-[#6B5A4A] mb-5 space-y-2">
            <?php foreach ($education_masterclass_items as $item): ?>
            <li class="flex items-start gap-2">
              <span class="text-[#F28A2E] mt-1">&#8226;</span>
              <?php echo esc_html($item['text']); ?>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <?php if ($education_masterclass_button): ?>
          <a href="<?php echo esc_url(home_url('/classes/')); ?>" class="btn-primary">
            <?php echo esc_html($education_masterclass_button); ?>
          </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ MUSEUM SHOP ============ -->
<?php if ($shop_products): ?>
<section class="py-16 lg:py-20 bg-[#F5EADB]">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[26px] lg:text-[48px]">
        <?php echo esc_html($shop_title ?: 'Искусство, книги и музейные сувениры'); ?>
      </h2>
      <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="link-arrow text-sm">
        <?php echo esc_html($shop_link_text ?: 'В магазин'); ?>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
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
            <h3 class="font-['Literata'] text-base mb-2 leading-snug">
              <a href="<?php echo esc_url($p_link); ?>" class="hover:text-[#E8872C] transition">
                <?php echo esc_html($p_name); ?>
              </a>
            </h3>
            <?php if ($p_desc): ?>
              <p class="text-sm text-[#6B5A4A] mb-4 leading-snug line-clamp-3">
                <?php echo wp_kses_post($p_desc); ?>
              </p>
            <?php endif; ?>
            <div class="mt-auto flex items-center gap-3">
              <?php if ($p_price): ?>
                <span class="font-semibold text-lg"><?php echo wp_kses_post($p_price); ?></span>
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
      <h2 class="text-[32px] lg:text-[44px]">
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
  <div class="max-w-[1200px] w-full mx-auto px-[10px] flex flex-col items-center justify-center h-full relative text-center">
    <?php if ($cta_title): ?>
    <h2 class="text-[26px] lg:text-[48px] text-white mb-6 mx-auto !leading-[1.4] max-w-[260px] md:max-w-full">
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
        <a href="#" class="btn-secondary md:max-w-[285px]">
          <?php echo esc_html($cta_secondary); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>