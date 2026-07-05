<?php
/**
 * Template Name: Cafe page
 * Template for Cafe page
 */

$hero_title = get_field('cafe_hero_title') ?: 'Кафе музея';
$hero_description = get_field('cafe_hero_description') ?: 'Пространство для отдыха, разговоров и вкусной паузы после знакомства с искусством.';
$hero_image = get_field('cafe_hero_image');
$hero_cta_primary_text = get_field('cafe_cta_primary_text') ?: 'Смотреть афишу';
$hero_cta_primary_url = get_field('cafe_cta_primary_url') ?: '/афиша';
$hero_cta_secondary_text = get_field('cafe_cta_secondary_text') ?: 'Связаться с музеем';
$hero_cta_secondary_url = get_field('cafe_cta_secondary_url') ?: '#contacts';

$about_title = get_field('cafe_about_title') ?: 'Искусство хочется не только смотреть, но и обсуждать';
$about_description = get_field('cafe_about_description') ?: 'Посещение музея — это событие не только эстетическое, но и гастрономическое. Увиденное хочется обсудить, обсудить и прожить чуть дольше — за чашкой чая, кофе или десертом. Поэтому мы создали музейное кафе, где можно комфортно провести время после экспозиции с постоянной экспозицией и новыми выставками.';

$features_title = get_field('cafe_features_title') ?: 'Что вас ждет';
$features_items = get_field('cafe_features_items') ?: array(
	array(
		'icon'        => get_template_directory_uri() . '/img/palette-line.svg',
		'title'       => 'Кафе и десерты',
		'description' => 'Идеальное место для короткой паузы, неспешного разговора и отдыха после прогулки по музею.',
		'image'       => '',
	),
	array(
		'icon'        => get_template_directory_uri() . '/img/palette-line.svg',
		'title'       => 'Легкий перекус',
		'description' => 'Здесь можно легко перекусить, чтобы продолжить знакомство с экспозицией.',
		'image'       => '',
	),
);

$creative_title = get_field('cafe_creative_title') ?: 'Творческая пауза внутри музейного маршрута';
$creative_description = get_field('cafe_creative_description') ?: 'Кафе продолжает атмосферу музея: здесь можно сделать паузу, обсудить увиденное, встретиться с друзьями или просто спокойно провести время в красивом пространстве.';
$creative_image = get_field('cafe_creative_image');

$important_title = get_field('cafe_important_title') ?: 'Важно знать перед посещением';
$important_items = get_field('cafe_important_items') ?: array(
	array(
		'icon'        => get_template_directory_uri() . '/img/palette-line.svg',
		'title'       => 'Посещение по билету музея',
		'description' => 'Для посещения кафе и бара необходим действующий билет в музей.',
	),
	array(
		'icon'        => get_template_directory_uri() . '/img/palette-line.svg',
		'title'       => 'Кафе внутри музея',
		'description' => 'Кафе удобно включить в маршрут посещения постоянной экспозиции и выставок.',
	),
	array(
		'icon'        => get_template_directory_uri() . '/img/palette-line.svg',
		'title'       => 'Меню будет представлено позже',
		'description' => 'Сейчас на странице показана общая информация о кафе и его атмосфере.',
	),
);

$gallery_title = get_field('cafe_gallery_title') ?: 'Пространство для отдыха и разговоров';
$gallery_images = get_field('cafe_gallery_images') ?: array(
	array('url' => '', 'alt' => 'Кафе музея 1'),
	array('url' => '', 'alt' => 'Кафе музея 2'),
	array('url' => '', 'alt' => 'Кафе музея 3'),
	array('url' => '', 'alt' => 'Кафе музея 4'),
);

$cta_background_image = get_field('cafe_cta_background_image');
$cta_background_image_mobile = get_field('cafe_cta_background_image_mobile');
$cta_title = get_field('cafe_cta_title') ?: 'Хотите провести время в музейном кафе?';
$cta_primary = get_field('cafe_cta_primary') ?: 'Купить билет';
$cta_secondary = get_field('cafe_cta_secondary') ?: 'Связаться с музеем';
?>

<?php get_header(); ?>

<!-- ============ HERO ============ -->
<section class="mt-0 lg:mt-[60px] relative overflow-hidden h-[400px] lg:h-[380px]">
  <!-- Background image -->
  <?php if ($hero_image): ?>
  <div class="absolute inset-0" style="background-image: url('<?php echo esc_url($hero_image); ?>'); background-size: cover; background-position: center;"></div>
  <?php else: ?>
  <div class="absolute inset-0 ph ph-museum"></div>
  <?php endif; ?>
  <!-- Overlay -->
  <div class="absolute inset-0 bg-black/20"></div>
  
  <div class="container-main relative h-full flex flex-col justify-center py-10">
    <!-- Breadcrumb -->
    <nav class="absolute top-6 left-[20px] lg:left-[20px]">
      <ul class="breadcrumbs">
        <li><a href="/">Главная</a></li>
        <li><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="" class="breadcrumbs-separator"></li>
        <li class="breadcrumbs-current">Кафе</li>
      </ul>
    </nav>

    <div class="max-w-[540px]">
      <?php if ($hero_title): ?>
      <h1 class="text-[34px] sm:text-[44px] lg:text-[50px] leading-[1.05] mb-4 !font-medium text-[#2D2926]">
        <?php echo esc_html($hero_title); ?>
      </h1>
      <?php endif; ?>
      <?php if ($hero_description): ?>
      <p class="text-[16px] md:text-[20px] text-[#2D2926] mb-8">
        <?php echo wp_kses_post($hero_description); ?>
      </p>
      <?php endif; ?>
      <div class="flex flex-col sm:flex-row gap-3 justify-start w-full">
        <?php if ($hero_cta_primary_text): ?>
          <a href="<?php echo esc_url($hero_cta_primary_url ?: '#'); ?>" class="btn-primary w-[285px]">
            <?php echo esc_html($hero_cta_primary_text); ?>
          </a>
        <?php endif; ?>
        <?php if ($hero_cta_secondary_text): ?>
          <a href="<?php echo esc_url($hero_cta_secondary_url ?: '#'); ?>" class="btn-outline !border-white !text-white hover:!bg-white hover:!text-[#2D2926]">
            <?php echo esc_html($hero_cta_secondary_text); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ ABOUT ============ -->
<?php if ($about_title || $about_description): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-8 lg:gap-20 items-start">
      <div>
        <?php if ($about_title): ?>
        <h2 class="mb-6">
          <?php echo esc_html($about_title); ?>
        </h2>
        <?php endif; ?>
      </div>
      <div>
        <?php if ($about_description): ?>
        <p class="text-[16px] md:text-[20px] text-[#6B5A4A] leading-relaxed">
          <?php echo wp_kses_post($about_description); ?>
        </p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ FEATURES ============ -->
<?php if ($features_items): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <?php if ($features_title): ?>
    <h2 class="mb-10">
      <?php echo esc_html($features_title); ?>
    </h2>
    <?php endif; ?>
    
    <div class="grid sm:grid-cols-2 gap-5">
      <?php foreach ($features_items as $item): ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="p-6">
          <?php if (!empty($item['icon'])): ?>
          <div class="w-12 h-12 mb-4">
            <img src="<?php echo esc_url($item['icon']); ?>" alt="" class="w-full h-full object-contain">
          </div>
          <?php endif; ?>
          <h3 class="font-['Literata'] text-xl font-semibold mb-3">
            <?php echo esc_html($item['title']); ?>
          </h3>
          <p class="text-sm text-[#6B5A4A] leading-relaxed mb-5">
            <?php echo esc_html($item['description']); ?>
          </p>
        </div>
        <?php if (!empty($item['image'])): ?>
          <img src="<?php echo esc_url($item['image']); ?>" 
               alt="<?php echo esc_attr($item['title']); ?>" 
               class="w-full aspect-[16/9] object-cover">
        <?php else: ?>
          <div class="ph ph-art1 w-full aspect-[16/9]"></div>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ CREATIVE PAUSE ============ -->
<?php if ($creative_title || $creative_description): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
      <div>
        <?php if ($creative_title): ?>
        <h2 class="mb-6">
          <?php echo esc_html($creative_title); ?>
        </h2>
        <?php endif; ?>
        <?php if ($creative_description): ?>
        <p class="text-[16px] md:text-[20px] text-[#6B5A4A] leading-relaxed">
          <?php echo wp_kses_post($creative_description); ?>
        </p>
        <?php endif; ?>
      </div>
      <div>
        <?php if ($creative_image): ?>
          <img src="<?php echo esc_url($creative_image); ?>" 
               alt="<?php echo esc_attr($creative_title); ?>" 
               class="rounded-2xl w-full shadow-lg object-cover aspect-[4/3]">
        <?php else: ?>
          <div class="ph ph-museum rounded-2xl w-full shadow-lg aspect-[4/3]"></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ IMPORTANT INFO ============ -->
<?php if ($important_items): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <?php if ($important_title): ?>
    <h2 class="mb-10">
      <?php echo esc_html($important_title); ?>
    </h2>
    <?php endif; ?>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      <?php foreach ($important_items as $item): ?>
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

<!-- ============ GALLERY ============ -->
<?php if ($gallery_images): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <?php if ($gallery_title): ?>
    <h2 class="mb-10">
      <?php echo esc_html($gallery_title); ?>
    </h2>
    <?php endif; ?>
    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
      <?php foreach ($gallery_images as $image): ?>
        <?php if (is_array($image) && !empty($image['url'])): ?>
          <img src="<?php echo esc_url($image['url']); ?>" 
               alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" 
               class="rounded-2xl w-full aspect-square object-cover shadow-sm">
        <?php elseif (is_string($image) && !empty($image)): ?>
          <img src="<?php echo esc_url($image); ?>" 
               alt="" 
               class="rounded-2xl w-full aspect-square object-cover shadow-sm">
        <?php else: ?>
          <div class="ph ph-museum rounded-2xl w-full aspect-square shadow-sm"></div>
        <?php endif; ?>
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
    <h2 class="text-white mb-6 mx-auto max-w-[260px] md:max-w-full">
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
