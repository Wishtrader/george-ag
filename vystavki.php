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
          <a href="<?php echo esc_url($hero_cta_primary_url); ?>" class="btn-primary md:max-w-[285px]">
            <?php echo esc_html($hero_cta_primary_text); ?>
          </a>
        <?php endif; ?>
        <?php if ($hero_cta_secondary_text): ?>
          <a href="<?php echo esc_url($hero_cta_secondary_url); ?>" class="btn-secondary md:max-w-[285px]">
            <?php echo esc_html($hero_cta_secondary_text); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>



<!-- ============ FEATURED EXHIBITION ============ -->
<?php get_template_part('template-parts/special-exposition'); ?>

<!-- ============ EXHIBITIONS GRID ============ -->
<?php
$vystavki_query = new WP_Query( array(
	'post_type'      => 'vystavka',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );
if ( $vystavki_query->have_posts() ):
?>
<section class="py-12 lg:py-16">
  <div class="container-main">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5" id="exhibitions-grid">
      <?php while ( $vystavki_query->have_posts() ): $vystavki_query->the_post();
        $badge      = get_field( 'sv_hero_badge' ) ?: 'Выставка';
        $dates      = get_field( 'sv_hero_dates' );
        $image      = get_field( 'sv_hero_image' );
        $thumb_url  = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
        $card_image = $image ?: $thumb_url;
      ?>
      <a href="<?php the_permalink(); ?>" class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col exhibition-card group">
        <?php if ( $card_image ): ?>
          <img src="<?php echo esc_url( $card_image ); ?>"
               alt="<?php the_title_attribute(); ?>"
               class="aspect-[4/3] object-cover w-full group-hover:scale-105 transition duration-300">
        <?php else: ?>
          <div class="ph ph-art1 aspect-[4/3]"></div>
        <?php endif; ?>
        <div class="p-5 flex-1 flex flex-col">
          <span class="text-xs font-medium text-[#E8872C] mb-2">
            <?php echo esc_html( $badge ); ?>
          </span>
          <h3 class="font-['Literata'] text-lg font-semibold mb-2"><?php the_title(); ?></h3>
          <?php if ( $dates ): ?>
          <p class="text-xs text-[#6B5A4A] mb-2"><?php echo esc_html( $dates ); ?></p>
          <?php endif; ?>
          <p class="text-sm text-[#6B5A4A] mb-4 flex-1"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
          <span class="btn-outline w-full !py-2.5 text-sm mt-auto text-center">
            Подробнее
          </span>
        </div>
      </a>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php wp_reset_postdata(); endif; ?>

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
<section class="py-10 lg:py-16 px-2.5 lg:px-0">
  <div class="max-w-[1200px] mx-auto">
    <?php if ($subscriptions_title): ?>
    <h2 class="mb-10 lg:mb-14 !font-medium"><?php echo esc_html($subscriptions_title); ?></h2>
    <?php endif; ?>
    <!-- Desktop: grid -->
    <div class="hidden sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      <?php while ($subscriptions_query->have_posts()): $subscriptions_query->the_post();
        get_template_part('template-parts/subscription-card');
      endwhile; ?>
    </div>
    <!-- Mobile: Swiper -->
    <div class="sm:hidden">
      <div class="swiper subscriptions-swiper">
        <div class="swiper-wrapper">
          <?php $subscriptions_query->rewind_posts(); while ($subscriptions_query->have_posts()): $subscriptions_query->the_post(); ?>
          <div class="swiper-slide">
            <?php get_template_part('template-parts/subscription-card'); ?>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
      <div class="flex items-center justify-between mt-2">
        <div class="subscriptions-nav-prev cursor-pointer w-12 h-12 flex items-center justify-center rounded-full">
          <img src="<?php echo get_template_directory_uri(); ?>/img/alm.svg" alt="Назад" class="w-6 h-6">
        </div>
        <div class="subscriptions-nav-next cursor-pointer w-12 h-12 flex items-center justify-center rounded-full">
          <img src="<?php echo get_template_directory_uri(); ?>/img/arm.svg" alt="Вперёд" class="w-6 h-6">
        </div>
      </div>
    </div>
  </div>
</section>
<?php wp_reset_postdata(); endif; ?>

<!-- ============ CTA SECTION ============ -->
<?php if ($cta_title || $cta_primary || $cta_secondary): ?>
<section class="bg-white lg:bg-transparent relative h-auto lg:h-[300px] lg:mt-14 shadow-lg">
    <?php if ($cta_background_image): ?>
    <div class="absolute inset-0 hidden lg:block" style="background-image: url('<?php echo esc_url($cta_background_image); ?>'); background-size: cover; background-position: center;"></div>
    <?php endif; ?>
  <div class="max-w-[1200px] w-full mx-auto px-[10px] lg:pl-[200px] lg:pr-[10px] flex flex-col md:flex-row items-center justify-start lg:h-full relative text-center py-10 lg:py-0">
    <div class="flex flex-col flex-1 justify-start w-full">
    <?php if ($cta_title): ?>
    <h2 class="text-[#2D2926] lg:text-white mb-6 max-w-[260px] md:max-w-[480px] text-start !text-[26px] lg:!text-[36px] !font-medium !text-center md:!text-left mx-auto md:mx-0">
      <?php echo esc_html($cta_title); ?>
    </h2>
    <?php endif; ?>
    <div class="flex flex-col sm:flex-row gap-[10px] md:gap-5 justify-start w-full">
      <?php if ($cta_primary): ?>
        <a href="<?php echo esc_url($cta_primary_url); ?>" class="btn-primary !w-full lg:!w-[336px]">
          <?php echo esc_html($cta_primary); ?>
        </a>
      <?php endif; ?>
      <?php if ($cta_secondary): ?>
        <a href="<?php echo esc_url($cta_secondary_url); ?>" class="btn-secondary !w-full lg:!w-[336px]">
          <?php echo esc_html($cta_secondary); ?>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php
  $cta_bg_mobile = $cta_background_image_mobile ?: $cta_background_image;
  if ($cta_bg_mobile):
  ?>
  <div class="max-w-[1200px] mx-auto px-[10px] lg:hidden">
    <img src="<?php echo esc_url($cta_bg_mobile); ?>" alt="" class="w-full h-[190px] object-cover rounded-2xl mt-2">
  </div>
  <?php endif; ?>
</section>
<?php endif; ?>



<?php get_footer(); ?>
