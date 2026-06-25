<?php
/**
 * WooCommerce Single Product Template
 */

global $product;

$product_id = get_the_ID();
$product = wc_get_product($product_id);

// Get ACF fields
$about_bg = get_field('sp_about_bg');
$about_bg_mobile = get_field('sp_about_bg_mobile');
$char_bg = get_field('sp_char_bg');
$char_bg_mobile = get_field('sp_char_bg_mobile');
$why_bg = get_field('sp_why_bg');
$why_bg_mobile = get_field('sp_why_bg_mobile');
$why_title = get_field('sp_why_title');
$why_items = get_field('sp_why_items');
$delivery_title = get_field('sp_delivery_title');
$delivery_items = get_field('sp_delivery_items');
$banner_title = get_field('sp_banner_title');
$banner_bg = get_field('sp_banner_bg');
$banner_bg_mobile = get_field('sp_banner_bg_mobile');
$banner_button_text = get_field('sp_banner_button_text');

// WooCommerce product data
$product_name = $product ? $product->get_name() : get_the_title();
$product_price = $product ? $product->get_price_html() : '';
$product_desc = $product ? $product->get_short_description() : '';
$product_gallery = $product ? $product->get_gallery_image_ids() : array();
$product_main_image = $product ? wp_get_attachment_url($product->get_image_id()) : '';
?>

<?php get_header(); ?>

<!-- ============ BREADCRUMBS ============ -->
<div class="container-main pt-5 pb-2">
  <nav class="flex items-center gap-2 text-xs lg:text-sm text-[#6B5A4A]">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#E8872C] transition">Главная</a>
    <span>→</span>
    <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="hover:text-[#E8872C] transition">Магазин</a>
    <span>→</span>
    <span class="text-[#2D2926]"><?php echo esc_html($product_name); ?></span>
  </nav>
</div>

<!-- ============ PRODUCT HERO ============ -->
<section class="py-6 lg:py-10">
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-start">
      <!-- Left: Images -->
      <div>
        <!-- Main image -->
        <div class="rounded-[24px] overflow-hidden mb-4">
          <?php if ($product_main_image): ?>
            <img src="<?php echo esc_url($product_main_image); ?>"
                 alt="<?php echo esc_attr($product_name); ?>"
                 class="w-full aspect-[590/472] object-cover"
                 id="mainProductImage">
          <?php else: ?>
            <div class="ph ph-shop aspect-[590/472]"></div>
          <?php endif; ?>
        </div>
        <!-- Gallery thumbnails -->
        <?php if (!empty($product_gallery)): ?>
          <div class="relative">
            <button type="button" id="galleryPrev" class="absolute -left-[6px] top-1/2 -translate-y-1/2 z-10 w-[24px] h-[24px] flex items-center justify-center text-[#E8872C] hover:opacity-70 transition">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <div class="overflow-hidden mx-[28px]">
              <div class="flex gap-3 overflow-x-auto scroll-smooth no-scrollbar" id="productGallery">
                <?php foreach ($product_gallery as $img_id): ?>
                  <?php $thumb_url = wp_get_attachment_image_url($img_id, 'medium'); ?>
                  <img src="<?php echo esc_url($thumb_url); ?>"
                       alt=""
                       class="w-[160px] h-[140px] rounded-[12px] object-cover cursor-pointer flex-shrink-0 hover:opacity-80 transition gallery-thumb"
                       data-full="<?php echo esc_url(wp_get_attachment_url($img_id)); ?>">
                <?php endforeach; ?>
              </div>
            </div>
            <button type="button" id="galleryNext" class="absolute -right-[6px] top-1/2 -translate-y-1/2 z-10 w-[24px] h-[24px] flex items-center justify-center text-[#E8872C] hover:opacity-70 transition">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M9 18l6-6-6-6"/></svg>
            </button>
          </div>
        <?php endif; ?>
      </div>

      <!-- Right: Product info -->
      <div class="lg:pt-4">
        <h1 class="text-[28px] lg:text-[36px] font-['Literata'] leading-[1.15] mb-4">
          <?php echo esc_html($product_name); ?>
        </h1>
        <?php if ($product_price): ?>
          <p class="text-[24px] lg:text-[28px] font-semibold text-[#E8872C] mb-4">
            <?php echo wp_kses_post($product_price); ?>
          </p>
        <?php endif; ?>
        <?php if ($product_desc): ?>
          <p class="text-[15px] text-[#6B5A4A] mb-6 leading-relaxed">
            <?php echo wp_kses_post($product_desc); ?>
          </p>
        <?php endif; ?>

        <!-- Add to cart -->
        <div class="flex items-center gap-3 mb-6">
          <div class="flex items-center border border-[#D9CCBC] rounded-xl h-[52px]">
            <button type="button" class="w-[52px] h-full text-xl text-[#6B5A4A] hover:text-[#E8872C] transition" id="qtyMinus">−</button>
            <input type="number" value="1" min="1" class="w-[60px] h-full text-center text-base font-medium border-x border-[#D9CCBC] bg-transparent outline-none" id="qtyInput">
            <button type="button" class="w-[52px] h-full text-xl text-[#6B5A4A] hover:text-[#E8872C] transition" id="qtyPlus">+</button>
          </div>
          <a href="#" class="btn-primary flex-1 h-[52px]">
            В корзину
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ О ТОВАРЕ ============ -->
<section class="py-8 lg:py-12">
  <div class="container-main">
    <div class="relative rounded-3xl overflow-hidden bg-[#F5EADB]/60 p-8 lg:p-12 min-h-[280px]">
      <!-- Background -->
      <?php if ($about_bg): ?>
        <div class="absolute inset-0 hidden lg:block">
          <img src="<?php echo esc_url($about_bg); ?>" class="w-full h-full object-cover" alt="">
        </div>
        <?php
        $about_bg_m = $about_bg_mobile ?: $about_bg;
        ?>
        <div class="absolute inset-0 block lg:hidden">
          <img src="<?php echo esc_url($about_bg_m); ?>" class="w-full h-full object-cover" alt="">
        </div>
      <?php else: ?>
        <div class="absolute inset-0 bg-gradient-to-br from-[#E8D5BE]/60 to-[#D4BFA6]/40"></div>
      <?php endif; ?>
      <div class="relative z-10 max-w-[700px]">
        <h2 class="text-[28px] lg:text-[40px] mb-4">О товаре</h2>
        <?php if ($product && $product->get_description()): ?>
          <p class="text-[15px] lg:text-[17px] text-[#2D2926] leading-relaxed">
            <?php echo wp_kses_post($product->get_description()); ?>
          </p>
        <?php else: ?>
          <p class="text-[15px] lg:text-[17px] text-[#2D2926] leading-relaxed">
            Каталог объединяет репродукции работ, тексты о выставочном проекте и материалы, раскрывающие тему цвета, личных сюжетов и эмоционального языка наивного искусства. Это издание подойдет тем, кто хочет сохранить впечатления от выставки и вернуться к ней позже.
          </p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ ХАРАКТЕРИСТИКИ ============ -->
<section class="py-4 lg:py-6">
  <div class="container-main">
    <?php
    $attributes = $product ? $product->get_attributes() : array();
    $has_chars = !empty($attributes) || $product;
    ?>
    <?php if ($has_chars): ?>
    <div class="relative rounded-3xl overflow-hidden bg-[#F5EADB]/60 p-8 lg:p-12 min-h-[280px]">
      <!-- Background -->
      <?php if ($char_bg): ?>
        <div class="absolute inset-0 hidden lg:block">
          <img src="<?php echo esc_url($char_bg); ?>" class="w-full h-full object-cover" alt="">
        </div>
        <?php
        $char_bg_m = $char_bg_mobile ?: $char_bg;
        ?>
        <div class="absolute inset-0 block lg:hidden">
          <img src="<?php echo esc_url($char_bg_m); ?>" class="w-full h-full object-cover" alt="">
        </div>
      <?php else: ?>
        <div class="absolute inset-0 bg-gradient-to-br from-[#E8D5BE]/60 to-[#D4BFA6]/40"></div>
      <?php endif; ?>
      <div class="relative z-10 max-w-[700px]">
        <h2 class="text-[28px] lg:text-[40px] mb-6">Характеристики</h2>
        <div class="space-y-3">
          <?php if ($product): ?>
            <?php
            $custom_chars = array(
              array('label' => 'Формат', 'value' => '210 x 280 мм'),
              array('label' => 'Объем', 'value' => '96 страниц'),
              array('label' => 'Обложка', 'value' => 'мягкая'),
              array('label' => 'Язык', 'value' => 'русский'),
              array('label' => 'Год выпуска', 'value' => '2026'),
            );
            foreach ($custom_chars as $char):
            ?>
              <div class="flex items-baseline gap-4">
                <span class="text-[15px] font-semibold text-[#2D2926] min-w-[130px]"><?php echo esc_html($char['label']); ?>:</span>
                <span class="text-[15px] text-[#2D2926]"><?php echo esc_html($char['value']); ?></span>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- ============ ПОЧЕМУ ЭТОТ ТОВАР ВЫБИРАЮТ ============ -->
<?php if ($why_items): ?>
<section class="py-4 lg:py-6">
  <div class="container-main">
    <div class="relative rounded-3xl overflow-hidden bg-[#F5EADB]/60 p-8 lg:p-12 min-h-[280px]">
      <!-- Background -->
      <?php if ($why_bg): ?>
        <div class="absolute inset-0 hidden lg:block">
          <img src="<?php echo esc_url($why_bg); ?>" class="w-full h-full object-cover" alt="">
        </div>
        <?php
        $why_bg_m = $why_bg_mobile ?: $why_bg;
        ?>
        <div class="absolute inset-0 block lg:hidden">
          <img src="<?php echo esc_url($why_bg_m); ?>" class="w-full h-full object-cover" alt="">
        </div>
      <?php else: ?>
        <div class="absolute inset-0 bg-gradient-to-br from-[#E8D5BE]/60 to-[#D4BFA6]/40"></div>
      <?php endif; ?>
      <div class="relative z-10 max-w-[700px]">
        <h2 class="text-[28px] lg:text-[40px] mb-6">
          <?php echo esc_html($why_title ?: 'Почему этот товар выбирают'); ?>
        </h2>
        <div class="space-y-3">
          <?php foreach ($why_items as $item): ?>
            <div class="flex items-center gap-3">
              <?php if (!empty($item['icon'])): ?>
                <img src="<?php echo esc_url($item['icon']); ?>" alt="" class="w-7 h-7 object-contain flex-shrink-0">
              <?php else: ?>
                <div class="w-7 h-7 rounded-full bg-[#E8872C]/20 flex-shrink-0"></div>
              <?php endif; ?>
              <span class="text-[15px] text-[#2D2926]"><?php echo esc_html($item['text']); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

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
    <h2 class="text-[26px] lg:text-[48px] text-white mb-6 max-w-[600px] leading-tight">
      <?php echo esc_html($banner_title ?: 'Продолжите знакомство с музеем'); ?>
    </h2>
    <a href="<?php echo esc_url(home_url('/poster/')); ?>" class="btn-primary">
      <?php echo esc_html($banner_button_text ?: 'Посмотреть афишу'); ?>
    </a>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Gallery thumb click
  const mainImage = document.getElementById('mainProductImage');
  const thumbs = document.querySelectorAll('.gallery-thumb');
  thumbs.forEach(function(thumb) {
    thumb.addEventListener('click', function() {
      if (mainImage) mainImage.src = this.dataset.full;
      thumbs.forEach(function(t) { t.classList.remove('ring-2', 'ring-[#E8872C]'); });
      this.classList.add('ring-2', 'ring-[#E8872C]');
    });
  });

  // Gallery arrows
  const gallery = document.getElementById('productGallery');
  const prevBtn = document.getElementById('galleryPrev');
  const nextBtn = document.getElementById('galleryNext');
  const scrollAmount = 172;

  if (gallery && prevBtn && nextBtn) {
    prevBtn.addEventListener('click', function() {
      gallery.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });
    nextBtn.addEventListener('click', function() {
      gallery.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
  }

  // Quantity controls
  const qtyInput = document.getElementById('qtyInput');
  const qtyMinus = document.getElementById('qtyMinus');
  const qtyPlus = document.getElementById('qtyPlus');
  if (qtyMinus) qtyMinus.addEventListener('click', function() {
    if (qtyInput && parseInt(qtyInput.value) > 1) qtyInput.value = parseInt(qtyInput.value) - 1;
  });
  if (qtyPlus) qtyPlus.addEventListener('click', function() {
    if (qtyInput) qtyInput.value = parseInt(qtyInput.value) + 1;
  });
});
</script>

<?php get_footer(); ?>
