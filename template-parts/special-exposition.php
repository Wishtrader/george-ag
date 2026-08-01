<?php
/**
 * Template Part: Особая постоянная экспозиция
 * 
 */

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
<section class="relative pb-6 lg:py-12 px-2.5 md:px-0">
  <div class="relative h-[450px] md:h-[412px] overflow-hidden rounded-2xl">
    <?php if ($image): ?>
      <img src="<?php echo esc_url($image); ?>" 
           alt="<?php echo esc_attr($title); ?>" 
           class="absolute inset-0 w-full h-full object-cover hide-mobile">
    <?php else: ?>
      <div class="absolute inset-0 ph ph-ussr hide-mobile"></div>
    <?php endif; ?>
    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/specials-m.png'); ?>" 
         alt="<?php echo esc_attr($title); ?>" 
         class="absolute inset-0 w-full h-full object-cover hide-desktop">
    <div class="relative p-2.5 md:p-12 lg:p-14 flex flex-col justify-center h-full max-w-[1200px] mx-auto">
      <?php if ($badge): ?>
      <span class="text-[13px] font-medium text-[#F1645A] mb-3">
        <?php echo esc_html($badge); ?>
      </span>
      <?php endif; ?>
      <?php if ($title): ?>
      <h2 class="mb-4 text-[#2D2926] !max-w-[570px] !font-normal text-[20px]! md:text-[36px]!">
        <?php echo esc_html($title); ?>
      </h2>
      <?php endif; ?>
      <?php if ($description): ?>
      <p class="text-[15px] md:text-[18px] text-[#2D2926] mb-7 max-w-[560px] leading-[1.2]">
        <?php echo esc_html($description); ?>
      </p>
      <?php endif; ?>
      <?php if ($button_text): ?>
        <div class="mt-auto"">
          <a href="<?php echo esc_url($button_url); ?>" class="btn-primary md:max-w-[330px]">
            <?php echo esc_html($button_text); ?>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>
