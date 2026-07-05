<?php
/**
 * Template Name: Main Exhibition page
 * Template for Main Exhibition page
 */

$hero_title = get_field('exhibition_hero_title') ?: 'СССР: Сокровища счастливого советского ребёнка';
$hero_description = get_field('exhibition_hero_description') ?: 'Постоянная экспозиция музея, посвящённая памяти детства, советским игрушкам, предметам быта и визуальной культуре прошлого.';
$hero_image = get_field('exhibition_hero_image');
$hero_cta_primary_text = get_field('exhibition_hero_cta_primary_text') ?: 'Смотреть афишу';
$hero_cta_primary_url = get_field('exhibition_hero_cta_primary_url') ?: '/афиша';
$hero_cta_secondary_text = get_field('exhibition_hero_cta_secondary_text') ?: 'Купить билет';
$hero_cta_secondary_url = get_field('exhibition_hero_cta_secondary_url') ?: '#';

$about_title = get_field('exhibition_about_title') ?: 'Экспозиция о памяти, детстве и вещах, которые узнаются с первого взгляда';
$about_description = get_field('exhibition_about_description') ?: 'Эта экспозиция — не просто место для осмотра предметов, а пространство личной памяти. Проект «СССР: Сокровища счастливого советского ребёнка» — это возможность не просто увидеть прошлое, но и прожить его через визуальные и эмоциональные детали.';
$about_description_2 = get_field('exhibition_about_description_2') ?: 'Здесь собраны игрушки, книги, элементы повседневного быта, визуальные детали и знакомые вещи, которые вызывают воспоминания, тёплую ностальгию и желание рассказать о них снова.';
$about_description_3 = get_field('exhibition_about_description_3') ?: 'Пространство экспозиции помогает не только вспомнить прошлое, но и увидеть его как часть культурной памяти.';
$about_image = get_field('exhibition_about_image');

$what_to_see_title = get_field('exhibition_what_to_see_title') ?: 'Что можно увидеть в экспозиции';
$what_to_see_items = get_field('exhibition_what_to_see_items') ?: array(
	array(
		'image'       => '',
		'title'       => 'Советские игрушки',
		'description' => 'Куклы, машинки, конструкторы и игрушки, которые были частью детства нескольких поколений.',
	),
	array(
		'image'       => '',
		'title'       => 'Предметы детского быта',
		'description' => 'Школьные пеналы, книжки, посуда и мелочи, окрашенные по волшебной жизни, знакомой по памяти и семейной истории.',
	),
	array(
		'image'       => '',
		'title'       => 'Визуальная культура прошлого',
		'description' => 'Открытки, иллюстрации, оформление журналов и рекламные плакаты — всё, что формировало визуальный мир.',
	),
	array(
		'image'       => '',
		'title'       => 'Эмоция узнавания',
		'description' => 'Экспозиция, в которой важно не только то, что展示ано, но и то, что оно вызывает: ассоциации, личные воспоминания и тёплые чувства.',
	),
);

$why_title = get_field('exhibition_why_title') ?: 'Почему сюда хочется прийти';
$why_description = get_field('exhibition_why_description') ?: 'Эта экспозиция работает не только как музейный раздел, но и как личный эмоциональный опыт. Для одних посетителей она становится поводом вспомнить своё детство, для других — возможностью увидеть предметный мир прошлого впервые. Именно поэтому пространство экспозиции построено как историко-культурный проект, семейный повод для посещения и целый маршрут по памяти.';
$why_image = get_field('exhibition_why_image');

$practical_title = get_field('exhibition_practical_title') ?: 'Практическая информация';
$practical_format = get_field('exhibition_practical_format') ?: 'Постоянная экспозиция';
$practical_access = get_field('exhibition_practical_access') ?: 'по входному билету';
$practical_location = get_field('exhibition_practical_location') ?: 'музей Naif Arts';
$practical_additional = get_field('exhibition_practical_additional') ?: 'можно совмещать с другими выставками и событиями музея';
$practical_audience = get_field('exhibition_practical_audience') ?: 'индивидуального и семейного посещения';
$practical_price = get_field('exhibition_practical_price') ?: '00 BYN';
$practical_button_text = get_field('exhibition_practical_button_text') ?: 'Купить билет';

$subscriptions_title = get_field('exhibition_subscriptions_title') ?: 'Абонементы и регулярные форматы';
$subscriptions_items = get_field('exhibition_subscriptions_items') ?: array(
	array(
		'image'       => '',
		'title'       => 'Абонемент в музей',
		'description' => 'Свободное посещение постоянных выставок и временных экспозиций в течение выбранного периода.',
		'includes_title' => 'Что входит',
		'includes_items' => 'посещение музея\nдоступ к постоянной экспозиции\nдоступ к временным выставкам',
		'price'       => 'от 00 BYN',
		'button_text' => 'Подробнее',
	),
	array(
		'image'       => '',
		'title'       => 'Абонемент на мастер-классы',
		'description' => 'Участие в серии творческих занятий по наивной живописи, декоративным техникам и авторским форматам.',
		'includes_title' => 'Что входит',
		'includes_items' => 'несколько мастер-классов\nприоритетная запись\nспециальные форматы для постоянных участников',
		'price'       => 'от 00 BYN',
		'button_text' => 'Подробнее',
	),
	array(
		'image'       => '',
		'title'       => 'Комбинированный формат',
		'description' => 'Посещение выставок, лекций и мастер-классов по одному абонементу — для тех, кто хочет погрузиться с головой.',
		'includes_title' => 'Что входит',
		'includes_items' => 'посещение экспозиции\nучастие в выбранных событиях\nдоступ к регулярным выставкам',
		'price'       => 'от 00 BYN',
		'button_text' => 'Подробнее',
	),
);

$cta_background_image = get_field('exhibition_cta_background_image');
$cta_background_image_mobile = get_field('exhibition_cta_background_image_mobile');
$cta_title = get_field('exhibition_cta_title') ?: 'Приходите увидеть экспозицию, которая возвращает в память детства';
$cta_primary = get_field('exhibition_cta_primary') ?: 'Купить билет';
$cta_secondary = get_field('exhibition_cta_secondary') ?: 'Посмотреть афишу';
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
        <li class="breadcrumbs-current">Выставки</li>
      </ul>
    </nav>

    <div class="max-w-[580px]">
      <h1 class="text-[34px] sm:text-[44px] lg:text-[50px] leading-[1.05] mb-4 !font-medium text-[#2D2926]">
        <?php echo esc_html($hero_title); ?>
      </h1>
      <p class="text-[16px] md:text-[20px] text-[#2D2926] mb-8">
        <?php echo wp_kses_post($hero_description); ?>
      </p>
      <div class="flex flex-col sm:flex-row gap-3 justify-start w-full">
        <a href="<?php echo esc_url($hero_cta_primary_url); ?>" class="btn-primary w-[285px]">
          <?php echo esc_html($hero_cta_primary_text); ?>
        </a>
        <a href="<?php echo esc_url($hero_cta_secondary_url); ?>" class="btn-outline !border-white !text-white hover:!bg-white hover:!text-[#2D2926]">
          <?php echo esc_html($hero_cta_secondary_text); ?>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ============ ABOUT ============ -->
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
      <div>
        <?php if ($about_image): ?>
        <img src="<?php echo esc_url($about_image); ?>" 
             alt="" 
             class="rounded-2xl w-full shadow-lg object-cover aspect-[4/3]">
        <?php else: ?>
        <div class="ph ph-museum rounded-2xl w-full shadow-lg aspect-[4/3]"></div>
        <?php endif; ?>
      </div>
      <div>
        <?php if ($about_title): ?>
        <h2 class="mb-6">
          <?php echo esc_html($about_title); ?>
        </h2>
        <?php endif; ?>
        <?php if ($about_description): ?>
        <p class="text-[16px] text-[#6B5A4A] leading-relaxed mb-4">
          <?php echo wp_kses_post($about_description); ?>
        </p>
        <?php endif; ?>
        <?php if ($about_description_2): ?>
        <p class="text-[16px] text-[#6B5A4A] leading-relaxed mb-4">
          <?php echo wp_kses_post($about_description_2); ?>
        </p>
        <?php endif; ?>
        <?php if ($about_description_3): ?>
        <p class="text-[16px] text-[#6B5A4A] leading-relaxed">
          <?php echo wp_kses_post($about_description_3); ?>
        </p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ WHAT TO SEE ============ -->
<?php if ($what_to_see_items): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <?php if ($what_to_see_title): ?>
    <h2 class="mb-10">
      <?php echo esc_html($what_to_see_title); ?>
    </h2>
    <?php endif; ?>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($what_to_see_items as $item): ?>
      <div>
        <?php if (!empty($item['image'])): ?>
        <img src="<?php echo esc_url($item['image']); ?>" 
             alt="<?php echo esc_attr($item['title']); ?>" 
             class="rounded-2xl w-full aspect-[4/3] object-cover mb-4">
        <?php else: ?>
        <div class="ph ph-art1 rounded-2xl w-full aspect-[4/3] mb-4"></div>
        <?php endif; ?>
        <h3 class="font-['Literata'] text-lg font-semibold mb-2">
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

<!-- ============ WHY + PRACTICAL INFO ============ -->
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-10 lg:gap-12">
      <!-- Left: Why -->
      <div>
        <?php if ($why_title): ?>
        <h2 class="mb-6">
          <?php echo esc_html($why_title); ?>
        </h2>
        <?php endif; ?>
        <?php if ($why_description): ?>
        <p class="text-[16px] text-[#6B5A4A] leading-relaxed mb-8">
          <?php echo wp_kses_post($why_description); ?>
        </p>
        <?php endif; ?>
        <?php if ($why_image): ?>
        <img src="<?php echo esc_url($why_image); ?>" 
             alt="" 
             class="rounded-2xl w-full shadow-lg object-cover aspect-[16/9]">
        <?php else: ?>
        <div class="ph ph-museum rounded-2xl w-full shadow-lg aspect-[16/9]"></div>
        <?php endif; ?>
      </div>

      <!-- Right: Practical info -->
      <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm h-fit">
        <?php if ($practical_title): ?>
        <h3 class="text-xl font-semibold mb-6"><?php echo esc_html($practical_title); ?></h3>
        <?php endif; ?>
        
        <div class="space-y-5">
          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#F5EADB] flex items-center justify-center flex-shrink-0">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div>
              <p class="text-sm text-[#6B5A4A]">Формат:</p>
              <p class="text-[15px] font-medium"><?php echo esc_html($practical_format); ?></p>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#F5EADB] flex items-center justify-center flex-shrink-0">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2"><path d="M15 5v2"/><path d="M15 11v2"/><path d="M15 17v2"/><rect width="17" height="17" x="1" y="3" rx="2"/></svg>
            </div>
            <div>
              <p class="text-sm text-[#6B5A4A]">Доступ:</p>
              <p class="text-[15px] font-medium"><?php echo esc_html($practical_access); ?></p>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#F5EADB] flex items-center justify-center flex-shrink-0">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div>
              <p class="text-sm text-[#6B5A4A]">Место:</p>
              <p class="text-[15px] font-medium"><?php echo esc_html($practical_location); ?></p>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#F5EADB] flex items-center justify-center flex-shrink-0">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
            </div>
            <div>
              <p class="text-sm text-[#6B5A4A]">Дополнительно:</p>
              <p class="text-[15px] font-medium"><?php echo esc_html($practical_additional); ?></p>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#F5EADB] flex items-center justify-center flex-shrink-0">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
              <p class="text-sm text-[#6B5A4A]">Подходит для:</p>
              <p class="text-[15px] font-medium"><?php echo esc_html($practical_audience); ?></p>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#F5EADB] flex items-center justify-center flex-shrink-0">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div>
              <p class="text-sm text-[#6B5A4A]">Стоимость:</p>
              <p class="text-[15px] font-medium"><?php echo esc_html($practical_price); ?></p>
            </div>
          </div>
        </div>

        <a href="<?php echo esc_url($hero_cta_secondary_url); ?>" class="btn-primary w-full mt-8">
          <?php echo esc_html($practical_button_text); ?>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ============ SUBSCRIPTIONS ============ -->
<?php if ($subscriptions_items): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <?php if ($subscriptions_title): ?>
    <h2 class="mb-10">
      <?php echo esc_html($subscriptions_title); ?>
    </h2>
    <?php endif; ?>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      <?php foreach ($subscriptions_items as $item): ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col">
        <?php if (!empty($item['image'])): ?>
        <img src="<?php echo esc_url($item['image']); ?>" 
             alt="<?php echo esc_attr($item['title']); ?>" 
             class="w-full aspect-[16/10] object-cover">
        <?php else: ?>
        <div class="ph ph-art2 w-full aspect-[16/10]"></div>
        <?php endif; ?>
        <div class="p-6 flex flex-col flex-1">
          <h3 class="font-['Literata'] text-xl font-semibold mb-3">
            <?php echo esc_html($item['title']); ?>
          </h3>
          <p class="text-sm text-[#6B5A4A] leading-relaxed mb-4">
            <?php echo esc_html($item['description']); ?>
          </p>
          
          <?php if (!empty($item['includes_title'])): ?>
          <p class="text-sm font-semibold mb-2"><?php echo esc_html($item['includes_title']); ?></p>
          <?php endif; ?>
          
          <?php if (!empty($item['includes_items'])): ?>
          <ul class="text-sm text-[#6B5A4A] mb-6 space-y-1.5 flex-1">
            <?php foreach (explode("\n", $item['includes_items']) as $include_item): ?>
            <li class="flex items-start gap-2">
              <span class="text-[#F28A2E] mt-1">•</span>
              <?php echo esc_html(trim($include_item)); ?>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          
          <div class="mt-auto">
            <p class="text-sm text-[#6B5A4A] mb-4"><?php echo esc_html($item['price']); ?></p>
            <a href="#" class="btn-outline w-full !py-2.5 text-sm">
              <?php echo esc_html($item['button_text']); ?>
            </a>
          </div>
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
