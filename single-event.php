<?php
/**
 * Single Event Template
 *
 * @package GeorgeAG
 */

get_header();

// Get event data from ACF fields
$event_date = get_field('event_date');
$event_time = get_field('event_time');
$event_duration = get_field('event_duration');
$event_location = get_field('event_location');
$event_price = get_field('event_price');
$event_age = get_field('event_age');
$event_brief_description = get_field('event_brief_description');
$event_description = get_field('event_description');
$event_what_to_expect_icon = get_field('event_what_to_expect_icon');
$event_what_to_expect = get_field('event_what_to_expect');
$event_audience = get_field('event_audience');
$event_speaker_name = get_field('event_speaker_name');
$event_speaker_image = get_field('event_speaker_image');
$event_speaker_bio = get_field('event_speaker_bio');
$event_hero_image = get_field('event_hero_image');
$event_icon_date = get_field('event_icon_date');
$event_icon_time = get_field('event_icon_time');
$event_icon_duration = get_field('event_icon_duration');
$event_icon_format = get_field('event_icon_format');
$event_icon_location = get_field('event_icon_location');
$event_icon_price = get_field('event_icon_price');
$event_icon_age = get_field('event_icon_age');
$event_cta_background_image = get_field('event_cta_background_image');
$event_cta_title = get_field('event_cta_title');
$event_cta_primary = get_field('event_cta_primary');
$event_cta_primary_url = get_field('event_cta_primary_url');
$event_cta_secondary = get_field('event_cta_secondary');
$event_cta_secondary_url = get_field('event_cta_secondary_url');

// Get event type from taxonomy
$event_terms = get_the_terms( get_the_ID(), 'event_category' );
$event_type_label = '';
if ( $event_terms && ! is_wp_error( $event_terms ) ) {
	$term = $event_terms[0];
	$event_type_label = $term->name;
}

// Build practical info items array
$practical_items = array();
$practical_svgs = array(
	'date'     => '<svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',
	'time'     => '<svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
	'duration' => '<svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
	'format'   => '<svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>',
	'location' => '<svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
	'price'    => '<svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
	'age'      => '<svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>',
);

$practical_fields = array(
	array( 'key' => 'date',     'label' => 'Дата:',          'value' => $event_date,     'icon' => $event_icon_date ),
	array( 'key' => 'time',     'label' => 'Время:',         'value' => $event_time,     'icon' => $event_icon_time ),
	array( 'key' => 'duration', 'label' => 'Длительность:',  'value' => $event_duration, 'icon' => $event_icon_duration ),
	array( 'key' => 'format',   'label' => 'Формат:',        'value' => $event_type_label, 'icon' => $event_icon_format ),
	array( 'key' => 'location', 'label' => 'Место:',         'value' => $event_location, 'icon' => $event_icon_location ),
	array( 'key' => 'price',    'label' => 'Стоимость:',     'value' => $event_price,    'icon' => $event_icon_price ),
	array( 'key' => 'age',      'label' => 'Возраст:',       'value' => $event_age,      'icon' => $event_icon_age ),
);

foreach ( $practical_fields as $item ) {
	if ( ! empty( $item['value'] ) ) {
		$practical_items[] = $item;
	}
}

// Get featured image for fallback
$thumbnail_id = get_post_thumbnail_id();
$thumbnail_url = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : '';
$hero_url = $event_hero_image ? $event_hero_image : $thumbnail_url;

?>

  <!-- ===== HERO BANNER (full width) ===== -->
  <section class="w-full">
    <div class="relative">
      <!-- Background image -->
      <div class="img-placeholder-dark w-full h-[280px] sm:h-[340px] lg:h-[464px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $hero_url ); ?>');">
        
      </div>
      <!-- Content -->
      <div class="absolute inset-0 flex items-start top-[10px]">
        <div class="max-w-[1200px] mx-auto px-[10px] lg:px-5 w-full">
          <!-- Breadcrumb -->
          <nav class="mb-4 lg:mb-10">
            <ol class="flex items-center gap-2 text-[13px] text-[#7C6E63]">
              <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition">Главная</a></li>
              <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="arrow-forward class="" />
              <li><a href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>" class="hover:text-white transition">Афиша</a></li>
              <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-forward-outline.svg" alt="arrow-forward class="" />
              <li class="text-[#2D2926]"><?php echo esc_html( $event_type_label ?: 'Лекция' ); ?></li>
            </ol>
          </nav>

          <div class="max-w-lg lg:max-w-[590px]">
            <h1 class="font-['Literata'] text-2xl sm:text-3xl lg:text-[50px] !font-medium !leading-[1.4] mb-3 lg:mb-4">
              <?php the_title(); ?>
            </h1>
            <p class="text-black text-base lg:text-xl leading-[1.2] mb-5 lg:mb-[30px]">
              <?php echo esc_html( $event_brief_description ); ?>
            </p>

            <!-- Meta tags row -->
            <div class="flex flex-wrap items-center gap-2 lg:gap-3 mb-5 lg:mb-[30px] text-[13px] font-body">
              <?php if ( $event_date && $event_time ) : ?>
                <span class="text-white/60 lg:mr-16 font-body">
                  <?php echo esc_html( $event_date . ', ' . $event_time ); ?>
                </span>
              <?php endif; ?>
              <?php if ( $event_location ) : ?>
                <span class="text-white/60 lg:mr-16">
                  <?php echo esc_html( $event_location ); ?>
                </span>
              <?php endif; ?>
              <?php if ( $event_price ) : ?>
                <span class="text-white/60">
                  <?php echo esc_html( $event_price ); ?>
                </span>
              <?php endif; ?>
            </div>

            <!-- Mobile: "Смотреть афишу" link -->
            <div class="lg:hidden mb-4">
              <a href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>" class="text-orange-300 text-sm font-medium flex items-center gap-1">
                Смотреть афишу
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
              </a>
            </div>

            <!-- Buy ticket button -->
            <a href="#" class="flex items-center justify-center w-full lg:w-[285px] lg:h-[52px] bg-[#FAF6EF] border border-[#F28A2E] text-[#F28A2E] px-8 py-2.5 rounded-[12px] text-base font-medium hover:bg-[#F28A2E] hover:text-white hover:border-white transition">
              Купить билет
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== MOBILE: Practical Info card (shown before "О событием" on mobile) ===== -->
  <section class="lg:hidden bg-[#FFFDF8]/95 pt-6 px-4">
    <div class="border border-gray-200 rounded-2xl p-5">
      <h3 class="font-heading text-base font-bold text-gray-800 mb-4">Практическая информация</h3>
      <div class="space-y-3">
        <?php foreach ( $practical_items as $item ) : ?>
        <div class="flex items-start gap-3">
          <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0 mt-0.5">
            <?php if ( $item['icon'] ) : ?>
            <img src="<?php echo esc_url( $item['icon'] ); ?>" alt="" class="w-4 h-4" />
            <?php else : ?>
            <?php echo $practical_svgs[ $item['key'] ]; ?>
            <?php endif; ?>
          </div>
          <div>
            <p class="text-xs text-gray-400"><?php echo esc_html( $item['label'] ); ?></p>
            <p class="text-sm text-gray-800 font-medium"><?php echo esc_html( $item['value'] ); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <!-- Buy button -->
      <a href="#" class="block w-full bg-orange-400 text-white text-center py-3 rounded-full font-semibold text-sm mt-5 hover:bg-orange-500 transition">
        Купить билет
      </a>
    </div>
  </section>

  <!-- ===== ABOUT EVENT + SIDEBAR ===== -->
  <section class="py-10 lg:py-16 bg-[#FAF6EF]">
    <div class="max-w-[1240px] mx-auto px-2 lg:px-5">
      <div class="flex flex-col lg:flex-row">
        <!-- LEFT COLUMN: Main content -->
        <div class="lg:w-[58%] xl:w-[60%] pr-5">

          <!-- О событии -->
          <?php if ( $event_description ) : ?>
          <div class="mb-10 lg:mb-15">
            <h2 class="font-heading text-xl lg:text-[36px] font-bold text-black mb-4 lg:mb-5">О событии</h2>
            <p class="text-[15px] lg:text-xl text-black leading-[1.2]">
              <?php echo esc_html( $event_description ); ?>
            </p>
          </div>
          <?php endif; ?>

          <!-- Что вас ждет -->
          <?php if ( $event_what_to_expect ) : ?>
          <div class="mb-10 lg:mb-12">
            <h2 class="font-heading text-xl lg:text-[36px] font-bold text-black mb-4 lg:mb-5">Что вас ждёт</h2>
            <div class="space-y-4">
              <?php foreach ( $event_what_to_expect as $item ) : ?>
              <div class="flex items-start gap-3">
                <?php if ( $event_what_to_expect_icon ) : ?>
                <img src="<?php echo esc_url( $event_what_to_expect_icon ); ?>" alt="" class="w-6 h-6 mt-0.5 flex-shrink-0" />
                <?php endif; ?>
                <p class="text-sm lg:text-base text-[#2D2926] leading-relaxed">
                  <?php echo esc_html( $item['text'] ); ?>
                </p>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>

          <!-- Кому подойдет событие -->
          <?php if ( $event_audience ) : ?>
          <div class="mb-10 lg:mb-12">
            <h2 class="font-heading text-xl lg:text-[36px] font-bold text-black mb-4 lg:mb-5">Кому подойдёт событие</h2>
            <p class="text-[15px] lg:text-xl text-black leading-[1.2]">
              <?php echo esc_html( $event_audience ); ?>
            </p>
          </div>
          <?php endif; ?>

          <!-- Спикер -->
          <?php if ( $event_speaker_name || $event_speaker_bio ) : ?>
          <div class="mb-0 lg:mb-0">
            <h2 class="font-heading text-xl lg:text-[36px] font-bold text-black mb-4 lg:mb-5">Спикер</h2>
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-5">
              <?php if ( $event_speaker_image ) : ?>
              <img src="<?php echo esc_url( $event_speaker_image ); ?>" alt="<?php echo esc_attr( $event_speaker_name ?: 'Спикер' ); ?>" class="w-[100px] h-[100px] lg:w-[183px] lg:h-[188px] rounded-[24px] object-cover flex-shrink-0">
              <?php else : ?>
              <div class="img-placeholder-avatar w-[100px] h-[100px] lg:w-[183px] lg:h-[188px] rounded-[24px] flex-shrink-0">
                <span>Photo</span>
              </div>
              <?php endif; ?>
              <div>
                <?php if ( $event_speaker_name ) : ?>
                <h3 class="font-heading text-xl lg:text-[28px] font-semibold text-black mb-2 lg:mb-5"><?php echo esc_html( $event_speaker_name ); ?></h3>
                <?php endif; ?>
                <?php if ( $event_speaker_bio ) : ?>
                <p class="text-base lg:text-xl text-black leading-[1.2]">
                  <?php echo esc_html( $event_speaker_bio ); ?>
                </p>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>

        </div>

      <!-- RIGHT COLUMN: Practical Info Sidebar (Desktop only) -->
      <div class="hidden lg:block lg:w-[42%] xl:w-[40%]">
        <div class="sticky top-22 bg-[#FFFDF8]/95 rounded-b-2xl p-5 lg:pb-12">
            <h3 class="!font-body text-lg lg:text-xl text-black mb-5">Практическая информация</h3>
            <div class="space-y-4">
              <?php foreach ( $practical_items as $item ) : ?>
              <div class="flex items-start gap-5">
                  <?php if ( $item['icon'] ) : ?>
                  <img src="<?php echo esc_url( $item['icon'] ); ?>" alt="" class="w-[44px] h-[44px]" />
                  <?php else : ?>
                  <svg class="w-[18px] h-[18px] text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php
                    echo match( $item['key'] ) {
                      'date'     => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                      'time'     => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                      'duration' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                      'format'   => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z',
                      'location' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z',
                      'price'    => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                      'age'      => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                      default    => '',
                    };
                  ?>" /></svg>
                  <?php endif; ?>
                <div>
                  <p class="text-base text-black leading-none mb-2"><?php echo esc_html( $item['label'] ); ?></p>
                  <p class="text-xl text-black font-light"><?php echo esc_html( $item['value'] ); ?></p>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
            <!-- Buy ticket button -->
            <a href="#" class="flex items-center justify-center w-full h-[52px] bg-[#F28A2E] text-white text-center rounded-[12px] font-medium text-base mt-5 hover:bg-[#D1731F] transition">
              Купить билет
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===== SUBSCRIPTIONS / REGULAR FORMATS ===== -->
  <section class="py-10 lg:py-16 bg-cream">
    <div class="max-w-content mx-auto px-4 lg:px-6">
      <h2 class="font-heading text-[26px] lg:text-[48px] font-bold text-black mb-6 lg:mb-8">Абонементы и регулярные форматы</h2>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-6">

        <!-- Card 1: Абонемент в музей -->
        <div class="bg-white/95 rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex flex-col">
          <div class="img-placeholder w-full aspect-[16/9]"><span>Subscription Image 1</span></div>
          <div class="p-5 lg:p-6 flex flex-col flex-1">
            <h3 class="font-heading text-lg font-bold text-gray-900 mb-2">Абонемент в музей</h3>
            <p class="text-sm text-gray-600 leading-relaxed mb-4">
              Свободное посещение постоянной экспозиции и временных выставок в течении выбранного периода
            </p>
            <p class="text-sm text-orange-500 font-semibold mb-3">Что входит</p>
            <ul class="space-y-1.5 mb-5 flex-1">
              <li class="flex items-start gap-2 text-sm text-gray-600">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full mt-1.5 flex-shrink-0"></span>
                <span>посещение музея</span>
              </li>
              <li class="flex items-start gap-2 text-sm text-gray-600">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full mt-1.5 flex-shrink-0"></span>
                <span>доступ к постоянной экспозиции</span>
              </li>
              <li class="flex items-start gap-2 text-sm text-gray-600">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full mt-1.5 flex-shrink-0"></span>
                <span>доступ к временным выставкам</span>
              </li>
            </ul>
            <div class="flex items-center justify-between mt-auto pt-2">
              <span class="text-base font-bold text-gray-900">от 00 BYN</span>
              <a href="#" class="border border-orange-400 text-orange-500 text-sm px-5 py-2 rounded-full font-medium hover:bg-orange-50 transition">Подробнее</a>
            </div>
          </div>
        </div>

        <!-- Card 2: Абонемент на мастер-классы -->
        <div class="bg-white/95 rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex flex-col">
          <div class="img-placeholder w-full aspect-[16/9]"><span>Subscription Image 2</span></div>
          <div class="p-5 lg:p-6 flex flex-col flex-1">
            <h3 class="font-heading text-lg font-bold text-gray-900 mb-2">Абонемент на мастер-классы</h3>
            <p class="text-sm text-gray-600 leading-relaxed mb-4">
              Участие в серии творческих занятий по наивной живописи, декоративным техникам и практическим форматам.
            </p>
            <p class="text-sm text-orange-500 font-semibold mb-3">Что входит</p>
            <ul class="space-y-1.5 mb-5 flex-1">
              <li class="flex items-start gap-2 text-sm text-gray-600">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full mt-1.5 flex-shrink-0"></span>
                <span>несколько мастер-классов</span>
              </li>
              <li class="flex items-start gap-2 text-sm text-gray-600">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full mt-1.5 flex-shrink-0"></span>
                <span>приоритетная запись</span>
              </li>
              <li class="flex items-start gap-2 text-sm text-gray-600">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full mt-1.5 flex-shrink-0"></span>
                <span>специальные форматы для постоянных участников</span>
              </li>
            </ul>
            <div class="flex items-center justify-between mt-auto pt-2">
              <span class="text-base font-bold text-gray-900">от 00 BYN</span>
              <a href="#" class="border border-orange-400 text-orange-500 text-sm px-5 py-2 rounded-full font-medium hover:bg-orange-50 transition">Подробнее</a>
            </div>
          </div>
        </div>

        <!-- Card 3: Комбинированный формат -->
        <div class="bg-white/95 rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex flex-col">
          <div class="img-placeholder w-full aspect-[16/9]"><span>Subscription Image 3</span></div>
          <div class="p-5 lg:p-6 flex flex-col flex-1">
            <h3 class="font-heading text-lg font-bold text-gray-900 mb-2">Комбинированный формат</h3>
            <p class="text-sm text-gray-600 leading-relaxed mb-4">
              Посещение выставок, лекций и мастер-классов по одному абонементу - для тех, кто хочет познакомится с музеей глубже.
            </p>
            <p class="text-sm text-orange-500 font-semibold mb-3">Что входит</p>
            <ul class="space-y-1.5 mb-5 flex-1">
              <li class="flex items-start gap-2 text-sm text-gray-600">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full mt-1.5 flex-shrink-0"></span>
                <span>посещение экспозиций</span>
              </li>
              <li class="flex items-start gap-2 text-sm text-gray-600">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full mt-1.5 flex-shrink-0"></span>
                <span>участие в выбранных событиях</span>
              </li>
              <li class="flex items-start gap-2 text-sm text-gray-600">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full mt-1.5 flex-shrink-0"></span>
                <span>доступ к регулярной выставкам</span>
              </li>
            </ul>
            <div class="flex items-center justify-between mt-auto pt-2">
              <span class="text-base font-bold text-gray-900">от 00 BYN</span>
              <a href="#" class="border border-orange-400 text-orange-500 text-sm px-5 py-2 rounded-full font-medium hover:bg-orange-50 transition">Подробнее</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===== CTA BANNER ===== -->
  <section class="relative bg-[#FAF6EF] h-[300px]">
    <div class="relative h-full overflow-hidden">
      <!-- Background image -->
      <?php if ( $event_cta_background_image ) : ?>
      <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $event_cta_background_image ); ?>');"></div>
      <?php endif; ?>

      <div class="relative h-full max-w-[1240px] mx-auto px-5 lg:px-10 flex items-center">
        <div class="w-full lg:ml-[33%] lg:w-[67%] flex flex-col items-start text-left">
          <h2 class="font-['Literata'] text-[26px] sm:text-[32px] lg:text-[42px] text-[#2D2926] leading-[1.25] mb-8 lg:mb-10">
            <?php echo esc_html( $event_cta_title ?: 'Выберите событие и приходите в музей' ); ?>
          </h2>
          <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <?php if ( $event_cta_secondary ) : ?>
            <a href="<?php echo esc_url( $event_cta_secondary_url ?: get_post_type_archive_link( 'event' ) ); ?>" class="border-2 border-[#F28A2E] text-[#F28A2E] bg-white px-10 py-3.5 rounded-full text-base font-medium hover:bg-[#F28A2E] hover:text-white transition text-center min-w-[260px]">
              <?php echo esc_html( $event_cta_secondary ); ?>
            </a>
            <?php endif; ?>
            <?php if ( $event_cta_primary ) : ?>
            <a href="<?php echo esc_url( $event_cta_primary_url ?: '#' ); ?>" class="bg-[#F28A2E] text-white px-10 py-3.5 rounded-full text-base font-semibold hover:bg-[#D1731F] transition text-center min-w-[260px]">
              <?php echo esc_html( $event_cta_primary ); ?>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
