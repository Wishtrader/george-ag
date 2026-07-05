<?php
/**
 * The template for displaying single vystavka (exhibition) posts
 *
 * @package GeorgeAG
 */

$hero_badge = get_field('sv_hero_badge') ?: 'Временная выставка';
$hero_dates = get_field('sv_hero_dates') ?: '12 апреля–12 июня';
$hero_description = get_field('sv_hero_description') ?: 'Выставочный проект о цвете, личных сюжетах и радости наивного художественного высказывания.';
$hero_image = get_field('sv_hero_image');
$hero_cta_primary_text = get_field('sv_hero_cta_primary_text') ?: 'Смотреть афишу';
$hero_cta_primary_url = get_field('sv_hero_cta_primary_url') ?: '#';
$hero_cta_secondary_text = get_field('sv_hero_cta_secondary_text') ?: 'Купить билет';
$hero_cta_secondary_url = get_field('sv_hero_cta_secondary_url') ?: '#';

$about_title = get_field('sv_about_title') ?: 'О выставке';
$about_description = get_field('sv_about_description');

$what_to_see_title = get_field('sv_what_to_see_title') ?: 'Что можно увидеть в экспозиции';
$what_to_see_items = get_field('sv_what_to_see_items');

$why_title = get_field('sv_why_title') ?: 'Почему эта выставка важна';
$why_description = get_field('sv_why_description');
$why_image = get_field('sv_why_image');

$practical_title = get_field('sv_practical_title') ?: 'Практическая информация';
$practical_format = get_field('sv_practical_format') ?: 'времренная выставка';
$practical_dates = get_field('sv_practical_dates') ?: '15 июня — 20 августа';
$practical_location = get_field('sv_practical_location') ?: 'Музей Naif Arts';
$practical_audience = get_field('sv_practical_audience') ?: 'самостоятельно или с экскурсоводом';
$practical_for_whom = get_field('sv_practical_for_whom') ?: 'индивидуального и семейного посещения';
$practical_access = get_field('sv_practical_access') ?: 'по входному билету';
$practical_button_text = get_field('sv_practical_button_text') ?: 'Купить билет';

$cta_background_image = get_field('sv_cta_background_image');
$cta_background_image_mobile = get_field('sv_cta_background_image_mobile');
$cta_title = get_field('sv_cta_title') ?: 'Выберите выставку и приходите в музей';
$cta_primary = get_field('sv_cta_primary') ?: 'Купить билет';
$cta_primary_url = get_field('sv_cta_primary_url') ?: '#';
$cta_secondary = get_field('sv_cta_secondary') ?: 'Посмотреть афишу';
$cta_secondary_url = get_field('sv_cta_secondary_url') ?: '#';
?>

<?php get_header(); ?>

<!-- ============ HERO ============ -->
<section class="mt-[40px] lg:mt-[60px] relative overflow-hidden h-[400px] lg:h-[460px]">
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
        <li><a href="<?php echo esc_url(home_url('/vystavki/')); ?>">Выставки</a></li>
        <li><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="" class="breadcrumbs-separator"></li>
        <li class="breadcrumbs-current"><?php the_title(); ?></li>
      </ul>
    </nav>

    <div class="grid lg:grid-cols-2 gap-8 items-center">
      <div>
        <h1 class="text-[34px] sm:text-[44px] lg:text-[50px] leading-[1.05] mb-4 !font-medium text-white">
          <?php the_title(); ?>
        </h1>
        <?php if ($hero_description): ?>
        <p class="text-[16px] md:text-[20px] text-white/90 mb-6 leading-[1.2]">
          <?php echo wp_kses_post($hero_description); ?>
        </p>
        <?php endif; ?>
        <div class="flex flex-wrap items-center gap-4 mb-8 text-sm text-white/80">
          <?php if ($hero_badge): ?>
          <span class="flex items-center gap-2">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <?php echo esc_html($hero_badge); ?>
          </span>
          <?php endif; ?>
          <?php if ($hero_dates): ?>
          <span class="flex items-center gap-2">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <?php echo esc_html($hero_dates); ?>
          </span>
          <?php endif; ?>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 justify-start w-full">
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
  </div>
</section>

<!-- ============ О ВЫСТАВКЕ ============ -->
<?php if ($about_title || $about_description): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="max-w-[800px]">
      <?php if ($about_title): ?>
      <h2 class="mb-6">
        <?php echo esc_html($about_title); ?>
      </h2>
      <?php endif; ?>
      <?php if ($about_description): ?>
      <p class="text-[16px] md:text-[18px] text-[#6B5A4A] leading-[1.6]">
        <?php echo wp_kses_post($about_description); ?>
      </p>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ ЧТО МОЖНО УВИДЕТЬ ============ -->
<?php if ($what_to_see_items): ?>
<section class="py-16 lg:py-20 bg-[#FAF6EF]">
  <div class="container-main">
    <?php if ($what_to_see_title): ?>
    <h2 class="mb-10">
      <?php echo esc_html($what_to_see_title); ?>
    </h2>
    <?php endif; ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($what_to_see_items as $item): ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <?php if (!empty($item['image'])): ?>
          <img src="<?php echo esc_url($item['image']); ?>" 
               alt="<?php echo esc_attr($item['title']); ?>" 
               class="aspect-[4/3] object-cover w-full">
        <?php else: ?>
          <div class="ph ph-art1 aspect-[4/3]"></div>
        <?php endif; ?>
        <div class="p-5">
          <h3 class="font-['Literata'] text-lg font-semibold mb-2"><?php echo esc_html($item['title']); ?></h3>
          <p class="text-sm text-[#6B5A4A]"><?php echo esc_html($item['description']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ ПОЧЕМУ ВАЖНА + ПРАКТИКА ============ -->
<?php if ($why_title || $why_description): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="grid lg:grid-cols-[1.2fr_1fr] gap-10 lg:gap-14 items-start">
      <div>
        <?php if ($why_title): ?>
        <h2 class="mb-6">
          <?php echo esc_html($why_title); ?>
        </h2>
        <?php endif; ?>
        <?php if ($why_description): ?>
        <p class="text-[16px] md:text-[18px] text-[#6B5A4A] leading-[1.6] mb-8">
          <?php echo wp_kses_post($why_description); ?>
        </p>
        <?php endif; ?>
        <?php if ($why_image): ?>
          <img src="<?php echo esc_url($why_image); ?>" 
               alt="<?php echo esc_attr($why_title); ?>" 
               class="rounded-2xl w-full object-cover">
        <?php else: ?>
          <div class="ph ph-art2 rounded-2xl aspect-[16/10]"></div>
        <?php endif; ?>
      </div>
      
      <!-- Практическая информация -->
      <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm">
        <?php if ($practical_title): ?>
        <h3 class="font-['Literata'] text-xl font-semibold mb-6">
          <?php echo esc_html($practical_title); ?>
        </h3>
        <?php endif; ?>
        <div class="space-y-4 mb-6">
          <div class="flex items-start gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2" class="mt-0.5 flex-shrink-0"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            <div>
              <span class="text-sm text-[#6B5A4A]">формат:</span>
              <p class="text-[#2D2926] font-medium"><?php echo esc_html($practical_format); ?></p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2" class="mt-0.5 flex-shrink-0"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <div>
              <span class="text-sm text-[#6B5A4A]">Даты:</span>
              <p class="text-[#2D2926] font-medium"><?php echo esc_html($practical_dates); ?></p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2" class="mt-0.5 flex-shrink-0"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <div>
              <span class="text-sm text-[#6B5A4A]">Место:</span>
              <p class="text-[#2D2926] font-medium"><?php echo esc_html($practical_location); ?></p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2" class="mt-0.5 flex-shrink-0"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <div>
              <span class="text-sm text-[#6B5A4A]">Можно посетить:</span>
              <p class="text-[#2D2926] font-medium"><?php echo esc_html($practical_audience); ?></p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2" class="mt-0.5 flex-shrink-0"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            <div>
              <span class="text-sm text-[#6B5A4A]">Подходит для:</span>
              <p class="text-[#2D2926] font-medium"><?php echo esc_html($practical_for_whom); ?></p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F28A2E" stroke-width="2" class="mt-0.5 flex-shrink-0"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            <div>
              <span class="text-sm text-[#6B5A4A]">Доступ:</span>
              <p class="text-[#2D2926] font-medium"><?php echo esc_html($practical_access); ?></p>
            </div>
          </div>
        </div>
        <?php if ($practical_button_text): ?>
        <a href="<?php echo esc_url($hero_cta_secondary_url ?: '#'); ?>" class="btn-primary w-full">
          <?php echo esc_html($practical_button_text); ?>
        </a>
        <?php endif; ?>
      </div>
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
        <a href="<?php echo esc_url($cta_primary_url); ?>" class="btn-primary md:max-w-[285px]">
          <?php echo esc_html($cta_primary); ?>
        </a>
      <?php endif; ?>
      <?php if ($cta_secondary): ?>
        <a href="<?php echo esc_url($cta_secondary_url); ?>" class="btn-secondary md:max-w-[285px]">
          <?php echo esc_html($cta_secondary); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
