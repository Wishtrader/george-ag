<?php
/**
 * Template Part: Особая постоянная экспозиция
 * 
 * Читает ACF-поля со страницы, использующей шаблон homepage.php.
 * Используется на разных страницах для отображения одного и того же контента.
 */

// Находим ID страницы с шаблоном homepage.php
$homepage_page = get_pages(array(
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'homepage.php',
    'number'     => 1,
));
$homepage_id = !empty($homepage_page) ? $homepage_page[0]->ID : 0;

$badge = get_field('special_badge', $homepage_id);
$title = get_field('special_title', $homepage_id);
$description = get_field('special_description', $homepage_id);
$image = get_field('special_image', $homepage_id);
$button_text = get_field('special_button_text', $homepage_id);
$button_url = home_url('/special/');
?>

<?php if ($title || $description): ?>
<section class="py-12">
  <div class="">
    <div class="relative overflow-hidden bg-[#E8872C]/10">
      <div class="grid md:grid-cols-2">
        <div class="p-8 md:p-12 lg:p-14 flex flex-col justify-center">
          <?php if ($badge): ?>
          <span class="text-sm font-medium text-[#E8872C] mb-3 uppercase tracking-wide">
            <?php echo esc_html($badge); ?>
          </span>
          <?php endif; ?>
          <?php if ($title): ?>
          <h2 class="mb-4">
            <?php echo esc_html($title); ?>
          </h2>
          <?php endif; ?>
          <?php if ($description): ?>
          <p class="text-[17px] text-[#6B5A4A] mb-7">
            <?php echo esc_html($description); ?>
          </p>
          <?php endif; ?>
          <?php if ($button_text): ?>
            <div>
              <a href="<?php echo esc_url($button_url); ?>" class="btn-primary">
                <?php echo esc_html($button_text); ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          <?php endif; ?>
        </div>
        <div class="relative">
          <?php if ($image): ?>
            <img src="<?php echo esc_url($image); ?>" 
                 alt="<?php echo esc_attr($title); ?>" 
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
