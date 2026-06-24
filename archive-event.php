<?php
/**
 * Events Archive Template
 *
 * @package GeorgeAG
 */

get_header();

$event_title = get_field('upcoming_title') ?: 'Афиша событий';
$events = get_field('upcoming_events');
?>

<section class="py-10 lg:py-16">
  <div class="max-w-content mx-auto px-4 lg:px-6">
    <h1 class="font-heading text-3xl lg:text-[40px] font-bold text-gray-900 mb-8"><?php echo esc_html( $event_title ); ?></h1>

    <?php if ( $events ) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
      <?php foreach ( $events as $event ) : ?>
      <article class="bg-white/95 rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition">
        <div class="img-placeholder h-48 lg:h-56 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $event['image'] ?? '' ); ?>');">
          <span>Event Image</span>
        </div>
        <div class="p-5 lg:p-6">
          <div class="flex items-center gap-2 mb-3">
            <span class="text-xs font-medium text-orange-500 uppercase"><?php echo esc_html( $event['type'] ); ?></span>
            <span class="text-xs text-gray-400">•</span>
            <span class="text-xs text-gray-500"><?php echo esc_html( $event['datetime'] ); ?></span>
          </div>
          <h2 class="font-heading text-lg lg:text-xl font-bold text-gray-900 mb-3">
            <?php echo esc_html( $event['title'] ); ?>
          </h2>
          <p class="text-sm text-gray-600 mb-4 line-clamp-2">
            <?php echo esc_html( $event['description'] ); ?>
          </p>
          <a href="<?php echo esc_url( $event['link'] ); ?>" class="inline-flex items-center gap-1 text-orange-500 text-sm font-medium hover:text-orange-600 transition">
            <?php echo esc_html( $event['button_text'] ?? 'Подробнее' ); ?>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php else : ?>
    <p class="text-gray-600">События не найдены.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
