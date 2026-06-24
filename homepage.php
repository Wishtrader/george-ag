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
$upcoming_link_url = get_field('upcoming_link_url');
$upcoming_events = get_field('upcoming_events');

$about_title = get_field('about_title');
$about_description = get_field('about_description');
$about_image = get_field('about_image');
$about_image_bg = get_field('about_image_bg');

$expositions_title = get_field('expositions_title');
$expositions_link_text = get_field('expositions_link_text');
$expositions_link_url = get_field('expositions_link_url');
$expositions_list = get_field('expositions_list');

$special_badge = get_field('special_badge');
$special_title = get_field('special_title');
$special_description = get_field('special_description');
$special_image = get_field('special_image');
$special_button_text = get_field('special_button_text');
$special_button_link = get_field('special_button_link');

$classes_title = get_field('classes_title');
$classes_link_text = get_field('classes_link_text');
$classes_link_url = get_field('classes_link_url');
$classes_main = get_field('classes_main');
$classes_list = get_field('classes_list');

$shop_title = get_field('shop_title');
$shop_link_text = get_field('shop_link_text');
$shop_link_url = get_field('shop_link_url');
$shop_products = get_field('shop_products');

$why_us_title = get_field('why_us_title');
$why_us_items = get_field('why_us_items');

$cta_background_image = get_field('cta_background_image');
$cta_title = get_field('cta_title');
$cta_primary = get_field('cta_primary');
$cta_secondary = get_field('cta_secondary');

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
?>

<?php get_header(); ?>

<!-- ============ HERO ============ -->
<?php if ($hero_title || $hero_description || $hero_cta_primary || $hero_cta_secondary): ?>
<section class="py-10 lg:py-16 relative md:min-h-[900px] overflow-hidden h-full">
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
          <?php echo esc_html($hero_description); ?>
        </p>
        <?php endif; ?>
        <div class="flex flex-col sm:flex-row gap-3 justify-between w-full">
          <?php if ($hero_cta_primary): ?>
            <a href="/афиша" class="btn-primary w-[285px]">
              <?php echo esc_html($hero_cta_primary); ?>
            </a>
          <?php endif; ?>
          <?php if ($hero_cta_secondary): ?>
            <a href="#classes" class="btn-outline">
              <?php echo esc_html($hero_cta_secondary); ?>
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
          <div class="ph ph-hero rounded-2xl aspect-[4/5] lg:aspect-[5/6] w-full lg:w-[120%] lg:-ml-[10%] shadow-lg"></div>
        <?php endif; ?>
      </div>
    </div>
    
    <!-- Event preview cards -->
    <?php if ($preview_events): ?>
    <div class="relative mt-12 h-full grid md:grid-cols-3 gap-5 z-10">
      <?php foreach ($preview_events as $event): ?>
      <div class="bg-white rounded-3xl p-5 flex gap-4 items-start shadow-sm">
        <div class="flex-1">
          <div class="flex items-center justify-between mb-2">
            <span class="event-badge text-[13px] text-[#2D2926] font-medium">
              <?php echo get_event_type_icon($event['type']); ?>
              <?php echo esc_html(get_event_type_label($event['type'])); ?>
            </span>
            <span class="text-[13px] text-[#2D2926] font-medium"><?php echo esc_html($event['date']); ?></span>
          </div>
          <div class="flex justify-between">
          <div class="flex flex-1 flex-col justify-between">
            <p class="text-[22px] leading-[1.2] font-medium mb-3"><?php echo esc_html($event['title']); ?></p>
            <a href="#" class="link-arrow text-base">Записаться
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
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<!-- ============ UPCOMING EVENTS ============ -->
<?php if ($upcoming_events): ?>
<section id="events" class="py-16 lg:py-20">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[32px] lg:text-[44px]">
        <?php echo esc_html($upcoming_title ?: 'Ближайшие события'); ?>
      </h2>
      <?php if ($upcoming_link_url): ?>
        <a href="<?php echo esc_url($upcoming_link_url); ?>" class="link-arrow text-sm">
          <?php echo esc_html($upcoming_link_text ?: 'Смотреть все события'); ?>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      <?php endif; ?>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($upcoming_events as $event): ?>
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
              <?php echo get_event_type_icon($event['type']); ?>
              <?php echo esc_html(get_event_type_label($event['type'])); ?>
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

<!-- ============ ABOUT MUSEUM ============ -->
<?php if ($about_title || $about_description || $about_image): ?>
<section id="about" class="py-16 lg:py-20 relative">
  <img src="<?php echo esc_url($about_image_bg); ?>" class="absolute bottom-20 right-0 w-full max-w-[1050px]" /> 
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-0 lg:gap-0 items-start">
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
        <h2 class="text-[32px] lg:text-[44px] mb-6">
          <?php echo esc_html($about_title); ?>
        </h2>
        <?php endif; ?>
        <?php if ($about_description): ?>
        <p class="text-[16px] md:text-[20px] text-[#6B5A4A] mb-6">
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
<section id="expositions" class="py-16 lg:py-20">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[32px] lg:text-[44px]">
        <?php echo esc_html($expositions_title ?: 'Экспозиции музея'); ?>
      </h2>
      <?php if ($expositions_link_url): ?>
        <a href="<?php echo esc_url($expositions_link_url); ?>" class="link-arrow text-sm">
          <?php echo esc_html($expositions_link_text ?: 'Все экспозиции'); ?>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      <?php endif; ?>
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
          <?php if ($special_button_link && $special_button_text): ?>
            <div>
              <a href="<?php echo esc_url($special_button_link); ?>" class="btn-primary">
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

<!-- ============ MASTER CLASSES AND LECTURES ============ -->
<?php if ($classes_main || $classes_list): ?>
<section id="classes" class="py-16 lg:py-20">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[32px] lg:text-[44px]">
        <?php echo esc_html($classes_title ?: 'Мастер-классы и лекции'); ?>
      </h2>
      <?php if ($classes_link_url): ?>
        <a href="<?php echo esc_url($classes_link_url); ?>" class="link-arrow text-sm">
          <?php echo esc_html($classes_link_text ?: 'Все мастер-классы и лекции'); ?>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      <?php endif; ?>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-5">
      <!-- Main class card -->
      <?php if ($classes_main): ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <?php if (!empty($classes_main['image'])): ?>
          <img src="<?php echo esc_url($classes_main['image']); ?>" 
               alt="<?php echo esc_attr($classes_main['title']); ?>" 
               class="aspect-[16/10] object-cover w-full">
        <?php else: ?>
          <div class="ph ph-art1 aspect-[16/10]"></div>
        <?php endif; ?>
        <div class="p-6">
          <div class="flex items-center justify-between mb-3">
            <span class="event-badge">
              <?php echo get_event_type_icon($classes_main['type']); ?>
              <?php echo esc_html(get_event_type_label($classes_main['type'])); ?>
            </span>
            <span class="text-xs text-[#6B5A4A] font-medium"><?php echo esc_html($classes_main['datetime']); ?></span>
          </div>
          <h3 class="font-['Literata'] text-xl font-semibold mb-3"><?php echo esc_html($classes_main['title']); ?></h3>
          <p class="text-sm text-[#6B5A4A] mb-5"><?php echo esc_html($classes_main['description']); ?></p>
          <a href="#" class="btn-outline w-full !py-2.5 text-sm">
            <?php echo esc_html($classes_main['button_text']); ?>
          </a>
        </div>
      </div>
      <?php endif; ?>
      
      <!-- Right column - classes list -->
      <?php if ($classes_list): ?>
      <div class="flex flex-col gap-5">
        <?php foreach ($classes_list as $class): ?>
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm grid grid-cols-[1fr_1fr]">
          <?php if (!empty($class['image'])): ?>
            <img src="<?php echo esc_url($class['image']); ?>" 
                 alt="<?php echo esc_attr($class['title']); ?>" 
                 class="object-cover w-full h-full">
          <?php else: ?>
            <div class="ph ph-art2"></div>
          <?php endif; ?>
          <div class="p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="event-badge">
                  <?php echo get_event_type_icon($class['type']); ?>
                  <?php echo esc_html(get_event_type_label($class['type'])); ?>
                </span>
                <span class="text-xs text-[#6B5A4A] font-medium"><?php echo esc_html($class['datetime']); ?></span>
              </div>
              <h3 class="font-['Literata'] text-base font-semibold mb-2"><?php echo esc_html($class['title']); ?></h3>
              <p class="text-sm text-[#6B5A4A]"><?php echo esc_html($class['description']); ?></p>
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
<section id="shop" class="py-16 lg:py-20 bg-[#F5EADB]">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[32px] lg:text-[44px]">
        <?php echo esc_html($shop_title ?: 'Магазин музея'); ?>
      </h2>
      <?php if ($shop_link_url): ?>
        <a href="<?php echo esc_url($shop_link_url); ?>" class="link-arrow text-sm">
          <?php echo esc_html($shop_link_text ?: 'В магазин'); ?>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      <?php endif; ?>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($shop_products as $product): ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <?php if (!empty($product['image'])): ?>
          <img src="<?php echo esc_url($product['image']); ?>" 
               alt="<?php echo esc_attr($product['title']); ?>" 
               class="aspect-square object-cover w-full">
        <?php else: ?>
          <div class="ph ph-shop aspect-square"></div>
        <?php endif; ?>
        <div class="p-5">
          <h3 class="font-['Literata'] text-base font-semibold mb-2"><?php echo esc_html($product['title']); ?></h3>
          <p class="text-sm text-[#6B5A4A] mb-4"><?php echo esc_html($product['description']); ?></p>
          <div class="flex items-center gap-3">
            <span class="font-semibold text-lg"><?php echo esc_html($product['price']); ?></span>
            <a href="#" class="btn-primary !py-2 !px-4 text-sm ml-auto">
              <?php echo esc_html($product['button_text']); ?>
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
<section class="py-16 lg:py-20">
  <div class="container-main">
    <h2 class="text-[32px] lg:text-[44px] mb-12 text-center">
      <?php echo esc_html($why_us_title ?: 'Почему приходят к нам'); ?>
    </h2>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
      <?php foreach ($why_us_items as $item): ?>
      <div class="text-center">
        <div class="mx-auto mb-5 w-20 h-20 flex items-center justify-center">
          <?php echo $item['icon']; // Raw SVG allowed ?>
        </div>
        <h3 class="font-['Literata'] text-xl font-semibold mb-3"><?php echo esc_html($item['title']); ?></h3>
        <p class="text-sm text-[#6B5A4A]"><?php echo esc_html($item['description']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ CTA SECTION ============ -->
<?php if ($cta_title || $cta_primary || $cta_secondary): ?>
<section class="py-20 lg:py-28 relative">
  <?php if ($cta_background_image): ?>
    <div class="absolute inset-0" style="background-image: url('<?php echo esc_url($cta_background_image); ?>'); background-size: cover; background-position: center;"></div>
    <div class="absolute inset-0 bg-[#3A2E24]/50"></div>
  <?php else: ?>
    <div class="ph ph-cta absolute inset-0"></div>
    <div class="absolute inset-0 bg-[#3A2E24]/50"></div>
  <?php endif; ?>
  <div class="container-main relative text-center">
    <?php if ($cta_title): ?>
    <h2 class="text-[32px] sm:text-[40px] lg:text-[52px] text-white mb-8 max-w-3xl mx-auto leading-tight">
      <?php echo esc_html($cta_title); ?>
    </h2>
    <?php endif; ?>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
      <?php if ($cta_primary): ?>
        <a href="#" class="btn-primary">
          <?php echo esc_html($cta_primary); ?>
        </a>
      <?php endif; ?>
      <?php if ($cta_secondary): ?>
        <a href="#" class="btn-outline !bg-white/10 !border-white/40 !text-white hover:!bg-white hover:!text-[#3A2E24] hover:!border-white">
          <?php echo esc_html($cta_secondary); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
