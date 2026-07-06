<?php
/**
 * Template Name: Выставки
 * Template for the Exhibitions page
 */

$hero_title = get_field('vystavki_hero_title') ?: 'Выставки музея';
$hero_description = get_field('vystavki_hero_description') ?: 'Постоянные и временные экспозиции, через которые раскрывается мир наивного искусства, память, дети и живое художественное высказывание.';
$hero_image = get_field('vystavki_hero_image');
$hero_cta_primary_text = get_field('vystavki_hero_cta_primary_text') ?: 'Смотреть текущие выставки';
$hero_cta_primary_url = get_field('vystavki_hero_cta_primary_url') ?: '#';
$hero_cta_secondary_text = get_field('vystavki_hero_cta_secondary_text') ?: 'Купить билет';
$hero_cta_secondary_url = get_field('vystavki_hero_cta_secondary_url') ?: '#';

$filters = get_field('vystavki_filters');

$vystavki_list = get_field('vystavki_list');

$how_title = get_field('vystavki_how_title') ?: 'Как устроены выставки музея';
$how_description = get_field('vystavki_how_description') ?: 'Выставочная программа музея построена так, чтобы посетитель мог увидеть наивное искусство в разных форматах и контекстах.';
$how_items = get_field('vystavki_how_items');

$subscriptions_title = get_field('vystavki_subscriptions_title') ?: 'Абонементы и регулярные форматы';

$cta_background_image = get_field('vystavki_cta_background_image');
$cta_background_image_mobile = get_field('vystavki_cta_background_image_mobile');
$cta_title = get_field('vystavki_cta_title') ?: 'Выберите выставку и приходите в музей';
$cta_primary = get_field('vystavki_cta_primary') ?: 'Купить билет';
$cta_primary_url = get_field('vystavki_cta_primary_url') ?: '#';
$cta_secondary = get_field('vystavki_cta_secondary') ?: 'Посмотреть афишу';
$cta_secondary_url = get_field('vystavki_cta_secondary_url') ?: '#';

function get_vystavki_category_label($category) {
    $labels = array(
        'permanent'    => 'Постоянная экспозиция',
        'temporary'    => 'Временные выставки',
        'accompanying' => 'Сопутствующие',
    );
    return $labels[$category] ?? 'Выставка';
}
?>

<?php get_header(); ?>

<!-- ============ HERO ============ -->
<section class="mt-[40px] relative overflow-hidden h-[236px] lg:h-[376px]">
  <div class="absolute inset-0" style="background-image: url('<?php echo esc_url($hero_image); ?>'); background-size: cover; background-position: center;"></div>

  <div class="container-main relative h-full flex flex-col justify-center py-10">
    <nav class="absolute top-6 left-[20px] lg:left-[20px]">
      <ul class="breadcrumbs">
        <li><a href="/">Главная</a></li>
        <li><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="" class="breadcrumbs-separator"></li>
        <li class="breadcrumbs-current">Выставки</li>
      </ul>
    </nav>

    <div class="">
      <?php if ($hero_title): ?>
      <h1 class="text-[34px] sm:text-[44px] lg:text-[50px] leading-[1.05] mb-4 !font-medium text-[#2D2926]">
        <?php echo esc_html($hero_title); ?>
      </h1>
      <?php endif; ?>
      <?php if ($hero_description): ?>
      <p class="text-[16px] md:text-[20px] max-w-[692px] text-[#2D2926] mb-8 leading-[1.2]">
        <?php echo wp_kses_post($hero_description); ?>
      </p>
      <?php endif; ?>
      <div class="flex flex-col sm:flex-row gap-3 justify-start gap-5 w-full">
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
</section>

<!-- ============ FILTER TABS ============ -->
<?php if ($filters): ?>
<section class="py-8 lg:py-10">
  <div class="container-main">
    <div class="flex flex-wrap gap-3 justify-center lg:justify-start" id="exhibition-filters">
      <?php foreach ($filters as $index => $filter): ?>
      <button
        data-filter="<?php echo esc_attr($filter['slug']); ?>"
        class="filter-btn px-5 py-2.5 rounded-full border text-sm font-medium transition <?php echo $index === 0 ? 'bg-[#F28A2E] text-white border-[#F28A2E]' : 'bg-white text-[#2D2926] border-[#E8D5BE] hover:border-[#F28A2E] hover:text-[#F28A2E]'; ?>"
      >
        <?php echo esc_html($filter['label']); ?>
      </button>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ FEATURED EXHIBITION ============ -->
<?php get_template_part('template-parts/special-exposition'); ?>

<!-- ============ EXHIBITIONS GRID ============ -->
<?php if ($vystavki_list): ?>
<section class="py-12 lg:py-16">
  <div class="container-main">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5" id="exhibitions-grid">
      <?php foreach ($vystavki_list as $expo): ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col exhibition-card" data-category="<?php echo esc_attr($expo['category']); ?>">
        <?php if (!empty($expo['image'])): ?>
          <img src="<?php echo esc_url($expo['image']); ?>" 
               alt="<?php echo esc_attr($expo['title']); ?>" 
               class="aspect-[4/3] object-cover w-full">
        <?php else: ?>
          <div class="ph ph-art1 aspect-[4/3]"></div>
        <?php endif; ?>
        <div class="p-5 flex-1 flex flex-col">
          <span class="text-xs font-medium text-[#E8872C] mb-2">
            <?php echo esc_html(get_vystavki_category_label($expo['category'])); ?>
          </span>
          <h3 class="font-['Literata'] text-lg font-semibold mb-2"><?php echo esc_html($expo['title']); ?></h3>
          <p class="text-sm text-[#6B5A4A] mb-4 flex-1"><?php echo esc_html($expo['description']); ?></p>
          <a href="<?php echo esc_url($expo['button_url'] ?: '#'); ?>" class="btn-outline w-full !py-2.5 text-sm mt-auto">
            <?php echo esc_html($expo['button_text'] ?: 'Подробнее'); ?>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ HOW EXHIBITIONS WORK ============ -->
<?php if ($how_items): ?>
<section class="py-16 lg:py-20">
  <div class="container-main">
    <div class="grid lg:grid-cols-[1fr_1.5fr] gap-10 lg:gap-14 items-start">
      <div class="max-w-[590px] w-full">
        <?php if ($how_title): ?>
        <h2 class="mb-6">
          <?php echo esc_html($how_title); ?>
        </h2>
        <?php endif; ?>
        <?php if ($how_description): ?>
        <p class="text-[16px] md:text-[20px] text-[#6B5A4A] leading-[1.2]">
          <?php echo wp_kses_post($how_description); ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="grid sm:grid-cols-3 gap-5">
        <?php foreach ($how_items as $item): ?>
        <div class="text-center">
          <div class="mx-auto mb-5 lg:mb-8 w-[75px] h-[75px] lg:w-[100px] lg:h-[100px] flex items-center justify-center">
            <?php if (!empty($item['icon'])): ?>
            <img src="<?php echo esc_url($item['icon']); ?>" alt="" class="w-full h-full object-contain" />
            <?php endif; ?>
          </div>
          <h3 class="!font-body text-base lg:text-lg !font-medium mb-3"><?php echo esc_html($item['title']); ?></h3>
          <p class="text-sm text-[#6B5A4A] leading-[1.2]"><?php echo esc_html($item['description']); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ SUBSCRIPTIONS ============ -->
<?php
$subscriptions_query = new WP_Query(array(
	'post_type'      => 'subscription',
	'posts_per_page' => 3,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
));
if ($subscriptions_query->have_posts()):
?>
<section class="py-16 lg:py-20 bg-[#FAF6EF]">
  <div class="max-w-[1200px] mx-auto">
    <?php if ($subscriptions_title): ?>
    <h2 class="mb-10">
      <?php echo esc_html($subscriptions_title); ?>
    </h2>
    <?php endif; ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      <?php while ($subscriptions_query->have_posts()): $subscriptions_query->the_post();
        get_template_part('template-parts/subscription-card');
      endwhile; ?>
    </div>
  </div>
</section>
<?php wp_reset_postdata(); endif; ?>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
  const filterButtons = document.querySelectorAll('.filter-btn');
  const cards = document.querySelectorAll('.exhibition-card');

  filterButtons.forEach(function(btn) {
    btn.addEventListener('click', function() {
      filterButtons.forEach(function(b) {
        b.classList.remove('bg-[#F28A2E]', 'text-white', 'border-[#F28A2E]');
        b.classList.add('bg-white', 'text-[#2D2926]', 'border-[#E8D5BE]');
      });
      btn.classList.remove('bg-white', 'text-[#2D2926]', 'border-[#E8D5BE]');
      btn.classList.add('bg-[#F28A2E]', 'text-white', 'border-[#F28A2E]');

      var filter = btn.getAttribute('data-filter');

      cards.forEach(function(card) {
        if (filter === 'all' || card.getAttribute('data-category') === filter) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
});
</script>

<?php get_footer(); ?>
