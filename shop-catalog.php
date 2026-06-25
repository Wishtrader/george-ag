<?php
/**
 * Template Name: Каталог магазина
 */

// SCF fields
$shop_title = get_field('sc_title');
$shop_description = get_field('sc_description');
$shop_hero_bg = get_field('sc_hero_bg');
$shop_hero_bg_mobile = get_field('sc_hero_bg_mobile');
$delivery_title = get_field('sc_delivery_title');
$delivery_items = get_field('sc_delivery_items');
$banner_title = get_field('sc_banner_title');
$banner_bg = get_field('sc_banner_bg');
$banner_bg_mobile = get_field('sc_banner_bg_mobile');
$banner_btn_primary = get_field('sc_banner_btn_primary');
$banner_btn_secondary = get_field('sc_banner_btn_secondary');

// Get all WooCommerce products
$products = wc_get_products(array(
    'status' => 'publish',
    'limit'  => -1,
    'order'  => 'DESC',
    'orderby' => 'date',
));
?>

<?php get_header(); ?>

<!-- ============ HERO ============ -->
<section class="relative overflow-hidden rounded-b-[20px] lg:rounded-b-[0px]">
  <?php if ($shop_hero_bg): ?>
    <div class="absolute inset-0 hidden lg:block">
      <img src="<?php echo esc_url($shop_hero_bg); ?>" class="w-full h-full object-cover" alt="">
    </div>
  <?php endif; ?>
  <?php
  $hero_bg_m = $shop_hero_bg_mobile ?: $shop_hero_bg;
  if ($hero_bg_m):
  ?>
    <div class="absolute inset-0 block lg:hidden">
      <img src="<?php echo esc_url($hero_bg_m); ?>" class="w-full h-full object-cover" alt="">
    </div>
  <?php endif; ?>
  <div class="relative z-10 container-main py-10 lg:py-16">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs lg:text-sm text-[#6B5A4A] mb-6">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#E8872C] transition">Главная</a>
      <span>→</span>
      <span class="text-[#2D2926]">Магазин</span>
    </nav>
    <div class="max-w-[600px]">
      <h1 class="text-[32px] lg:text-[48px] mb-4">
        <?php echo esc_html($shop_title ?: 'Магазин музея'); ?>
      </h1>
      <?php if ($shop_description): ?>
        <p class="text-[15px] lg:text-[17px] text-[#2D2926] leading-relaxed">
          <?php echo esc_html($shop_description); ?>
        </p>
      <?php else: ?>
        <p class="text-[15px] lg:text-[17px] text-[#2D2926] leading-relaxed">
          Каталоги, открытки, принты, сувениры и другие вещи, которые помогают сохранить впечатление от музея и наивного искусства.
        </p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ============ PRODUCT GRID ============ -->
<section class="py-10 lg:py-16">
  <div class="container-main">
    <?php if (!empty($products)): ?>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5">
        <?php foreach ($products as $product): ?>
          <?php
          $p_id = $product->get_id();
          $p_name = $product->get_name();
          $p_price = $product->get_price_html();
          $p_desc = $product->get_short_description();
          $p_image = wp_get_attachment_url($product->get_image_id());
          $p_link = get_permalink($p_id);
          ?>
          <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col">
            <!-- Image -->
            <a href="<?php echo esc_url($p_link); ?>" class="block">
              <?php if ($p_image): ?>
                <img src="<?php echo esc_url($p_image); ?>"
                     alt="<?php echo esc_attr($p_name); ?>"
                     class="aspect-[4/5] object-cover w-full">
              <?php else: ?>
                <div class="ph ph-shop aspect-[4/5]"></div>
              <?php endif; ?>
            </a>
            <!-- Info -->
            <div class="p-4 lg:p-5 flex flex-col flex-1">
              <h3 class="font-['Literata'] text-[14px] lg:text-[16px] font-semibold mb-1 leading-snug">
                <a href="<?php echo esc_url($p_link); ?>" class="hover:text-[#E8872C] transition">
                  <?php echo esc_html($p_name); ?>
                </a>
              </h3>
              <?php if ($p_desc): ?>
                <p class="text-[12px] lg:text-[14px] text-[#6B5A4A] mb-3 leading-snug line-clamp-3">
                  <?php echo wp_kses_post($p_desc); ?>
                </p>
              <?php endif; ?>
              <div class="mt-auto flex items-center gap-2">
                <?php if ($p_price): ?>
                  <span class="text-[14px] lg:text-[16px] font-semibold text-[#2D2926]"><?php echo wp_kses_post($p_price); ?></span>
                <?php endif; ?>
                <a href="<?php echo esc_url($p_link); ?>" class="btn-primary !py-2 !px-4 text-[13px] lg:text-[14px] ml-auto whitespace-nowrap">
                  В корзину
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="text-center text-[#6B5A4A] py-16">Товары пока не добавлены.</p>
    <?php endif; ?>
  </div>
</section>

<!-- ============ КАК ПОЛУЧИТЬ ЗАКАЗ ============ -->
<?php if ($delivery_items): ?>
<section class="py-8 lg:py-12">
  <div class="container-main">
    <h2 class="text-[28px] lg:text-[40px] mb-8">
      <?php echo esc_html($delivery_title ?: 'Как получить заказ'); ?>
    </h2>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
      <?php foreach ($delivery_items as $item): ?>
        <div class="text-center">
          <div class="w-[70px] h-[70px] lg:w-[100px] lg:h-[100px] mx-auto mb-4 flex items-center justify-center">
            <?php if (!empty($item['icon'])): ?>
              <img src="<?php echo esc_url($item['icon']); ?>" alt="" class="w-full h-full object-contain">
            <?php else: ?>
              <div class="w-full h-full rounded-2xl bg-[#F5EADB]"></div>
            <?php endif; ?>
          </div>
          <h3 class="text-[15px] lg:text-[17px] font-semibold mb-2"><?php echo esc_html($item['title']); ?></h3>
          <p class="text-[13px] lg:text-[15px] text-[#6B5A4A] leading-snug"><?php echo esc_html($item['description']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ БАННЕР ВНИЗУ ============ -->
<section class="relative h-[300px] lg:h-[340px]">
  <?php if ($banner_bg): ?>
    <div class="absolute inset-0 hidden lg:block">
      <img src="<?php echo esc_url($banner_bg); ?>" class="w-full h-full object-cover" alt="">
    </div>
  <?php endif; ?>
  <?php
  $banner_bg_m = $banner_bg_mobile ?: $banner_bg;
  if ($banner_bg_m):
  ?>
    <div class="absolute inset-0 block lg:hidden">
      <img src="<?php echo esc_url($banner_bg_m); ?>" class="w-full h-full object-cover" alt="">
    </div>
  <?php endif; ?>
  <div class="absolute inset-0 bg-[#6B4A2A]/30"></div>
  <div class="relative z-10 max-w-[1200px] w-full mx-auto px-5 flex flex-col items-center justify-center h-full text-center">
    <h2 class="text-[26px] lg:text-[40px] text-white mb-6 max-w-[700px] leading-tight">
      <?php echo esc_html($banner_title ?: 'Выберите вещь, которую захочется забрать с собой'); ?>
    </h2>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
      <?php if ($banner_btn_primary): ?>
        <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="btn-primary">
          <?php echo esc_html($banner_btn_primary); ?>
        </a>
      <?php endif; ?>
      <?php if ($banner_btn_secondary): ?>
        <a href="<?php echo esc_url(home_url('/poster/')); ?>" class="btn-secondary">
          <?php echo esc_html($banner_btn_secondary); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
