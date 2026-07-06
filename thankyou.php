<?php
/**
 * Template Name: Спасибо за заказ
 */

get_header();

$bg_image = get_field( 'thankyou_bg' );
$title    = get_field( 'thankyou_title' ) ?: 'Спасибо за заказ';
$text     = get_field( 'thankyou_text' ) ?: "Ваш заказ в магазине музея принят. Мы свяжемся с вами после обработки и уточнения деталей получения.\n\nЕсли выбран самовывоз — мы сообщим, когда заказ будет готов.";
?>

<!-- ============ THANK YOU SECTION ============ -->
<section class="relative max-h-[430px] flex items-center justify-center overflow-hidden">
  <!-- Background -->
  <?php if ( $bg_image ) : ?>
    <div class="absolute inset-0">
      <img src="<?php echo esc_url( $bg_image ); ?>" alt="" class="w-full h-full object-cover">
    </div>
  <?php else : ?>
    <div class="absolute inset-0 bg-[#FAF6EF]"></div>
  <?php endif; ?>

  <!-- Content -->
  <div class="relative z-10 container-main py-20 text-center">
    <h1 class="font-['Literata'] text-[34px] lg:text-[56px] font-semibold text-[#2D2926] mb-6">
      <?php echo esc_html( $title ); ?>
    </h1>
    <div class="max-w-[720px] mx-auto">
      <?php
      $paragraphs = explode( "\n\n", $text );
      foreach ( $paragraphs as $p ) {
        $p = trim( $p );
        if ( $p ) {
          echo '<p class="text-[16px] lg:text-[18px] text-[#2D2926] leading-relaxed mb-4">' . esc_html( $p ) . '</p>';
        }
      }
      ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
