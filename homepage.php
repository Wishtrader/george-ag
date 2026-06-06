<?php
/**
 * Template Name: Homepage 
 * Template for home page
 */
?>
<?php get_header();
?>
<!-- ============ HERO ============ -->
<section class="py-10 lg:py-16">
  <div class="container-main">
    <div class="grid lg:grid-cols-[1fr_1fr] gap-8 lg:gap-12 items-center">
      <div>
        <h1 class="text-[34px] sm:text-[44px] lg:text-[56px] leading-[1.05] mb-6">
          Музей наивного искусства, где хочется не только смотреть, но и участвовать
        </h1>
        <p class="text-[17px] text-[#6B5A4A] mb-8 max-w-xl">
          Выставки, мастер-классы, лекции и творческие встречи для детей и взрослых в теплом и живом пространстве музея.
        </p>
        <div class="flex flex-col sm:flex-row gap-3">
          <a href="#events" class="btn-primary">
            Смотреть афишу
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
          <a href="#classes" class="btn-outline">Записаться на мастер-класс</a>
        </div>
      </div>
      
      <!-- Hero image with offset -->
      <div class="relative">
        <div class="ph ph-hero rounded-2xl aspect-[4/5] lg:aspect-[5/6] w-full lg:w-[120%] lg:-ml-[10%] shadow-lg"></div>
      </div>
    </div>
    
    <!-- Event preview cards -->
    <div class="mt-12 grid md:grid-cols-3 gap-5">
      <!-- Card 1 -->
      <div class="bg-white rounded-2xl p-5 flex gap-4 items-start shadow-sm">
        <div class="flex-1">
          <div class="flex items-center justify-between mb-2">
            <span class="event-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2Z"/><path d="M7 12c1-1 2-1 3-1s2 0 3 1 2 1 3 0M8 16c1-1 2-1 4-1s3 0 4 1"/></svg>
              Мастер-класс
            </span>
            <span class="text-xs text-[#6B5A4A] font-medium">18 мая</span>
          </div>
          <h3 class="font-['Literata'] text-base font-semibold mb-3">Рисуем город мечты</h3>
          <a href="#" class="link-arrow text-sm">Записаться
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
        <div class="ph ph-art1 w-20 h-20 rounded-xl flex-shrink-0"></div>
      </div>
      <!-- Card 2 -->
      <div class="bg-white rounded-2xl p-5 flex gap-4 items-start shadow-sm">
        <div class="flex-1">
          <div class="flex items-center justify-between mb-2">
            <span class="event-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 4v4M16 4v4"/></svg>
              Лекция
            </span>
            <span class="text-xs text-[#6B5A4A] font-medium">22 мая</span>
          </div>
          <h3 class="font-['Literata'] text-base font-semibold mb-3">Что такое наивное искусство</h3>
          <a href="#" class="link-arrow text-sm">Подробнее
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
        <div class="ph ph-art2 w-20 h-20 rounded-xl flex-shrink-0"></div>
      </div>
      <!-- Card 3 -->
      <div class="bg-white rounded-2xl p-5 flex gap-4 items-start shadow-sm">
        <div class="flex-1">
          <div class="flex items-center justify-between mb-2">
            <span class="event-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2Z"/><path d="M8 12h8M12 8v8"/></svg>
              Встреча
            </span>
            <span class="text-xs text-[#6B5A4A] font-medium">25 мая</span>
          </div>
          <h3 class="font-['Literata'] text-base font-semibold mb-3">Разговор с художником</h3>
          <a href="#" class="link-arrow text-sm">Подробнее
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
        <div class="ph ph-art3 w-20 h-20 rounded-xl flex-shrink-0"></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ UPCOMING EVENTS ============ -->
<section id="events" class="py-16 lg:py-20">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[32px] lg:text-[44px]">Ближайшие события</h2>
      <a href="#" class="link-arrow text-sm">Смотреть все события
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <!-- Event card -->
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-art1 aspect-square"></div>
        <div class="p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="event-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2Z"/><path d="M7 12c1-1 2-1 3-1s2 0 3 1 2 1 3 0"/></svg>
              Мастер-класс
            </span>
            <span class="text-xs text-[#6B5A4A] font-medium">19 мая, вс · 12:00</span>
          </div>
          <h3 class="font-['Literata'] text-lg font-semibold mb-3">Мастер-класс: Рисуем сказочный дом</h3>
          <p class="text-sm text-[#6B5A4A] mb-5">Создаем яркий домик из красок и фантазий. Для детей от 6 лет.</p>
          <a href="#" class="btn-outline w-full !py-2.5 text-sm">Записаться</a>
        </div>
      </div>
      <!-- Event card 2 -->
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-art2 aspect-square"></div>
        <div class="p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="event-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 4v4M16 4v4"/></svg>
              Лекция
            </span>
            <span class="text-xs text-[#6B5A4A] font-medium">21 мая, вт · 18:30</span>
          </div>
          <h3 class="font-['Literata'] text-lg font-semibold mb-3">Лекция: Как понимать наивное искусство</h3>
          <p class="text-sm text-[#6B5A4A] mb-5">О языке, символах и особой искренности наивного искусства.</p>
          <a href="#" class="btn-outline w-full !py-2.5 text-sm">Подробнее</a>
        </div>
      </div>
      <!-- Event card 3 -->
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-art3 aspect-square"></div>
        <div class="p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="event-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2Z"/><path d="M8 12h8M12 8v8"/></svg>
              Встреча
            </span>
            <span class="text-xs text-[#6B5A4A] font-medium">24 мая, пт · 19:00</span>
          </div>
          <h3 class="font-['Literata'] text-lg font-semibold mb-3">Встреча: Диалог с художником</h3>
          <p class="text-sm text-[#6B5A4A] mb-5">О творческом пути и вдохновении. В формате живого общения.</p>
          <a href="#" class="btn-outline w-full !py-2.5 text-sm">Подробнее</a>
        </div>
      </div>
      <!-- Event card 4 -->
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-art4 aspect-square"></div>
        <div class="p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="event-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              Семейное занятие
            </span>
            <span class="text-xs text-[#6B5A4A] font-medium">26 мая, вс · 13:00</span>
          </div>
          <h3 class="font-['Literata'] text-lg font-semibold mb-3">Семейное занятие: Цвет и фантазия</h3>
          <p class="text-sm text-[#6B5A4A] mb-5">Творчество вдвоем: взрослые и дети придумывают свою историю в цвете.</p>
          <a href="#" class="btn-outline w-full !py-2.5 text-sm">Подробнее</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ ABOUT MUSEUM ============ -->
<section id="about" class="py-16 lg:py-20 bg-[#F5EADB]">
  <div class="container-main">
    <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
      <div class="order-2 lg:order-1">
        <div class="ph ph-museum rounded-2xl aspect-[4/5] w-full lg:w-[110%] lg:-ml-[5%]"></div>
      </div>
      <div class="order-1 lg:order-2 relative">
        <h2 class="text-[32px] lg:text-[44px] mb-6">О музее</h2>
        <p class="text-[17px] text-[#6B5A4A] mb-6">
          Naif Arts– музей наивного искусства в Минске, посвященный самобытным художникам и искреннему художественному высказыванию. Здесь соседствуют детское творчество, произведения пожилых авторов и мировое наивное искусство, раскрывающее разные взгляды на мир вне академических правил. Музей - это не только пространство экспозиций, но и место, где проходят мастер-классы, лекции и встречи.
        </p>
        <!-- Decorative illustration -->
        <div class="relative mt-10">
          <div class="hill-shape h-40 w-full"></div>
          <div class="absolute inset-0 flex items-end justify-around pb-2 px-4">
            <!-- SVG illustrations placeholder -->
            <svg width="60" height="80" viewBox="0 0 60 80" fill="none" stroke="#3A2E24" stroke-width="1.5">
              <circle cx="30" cy="15" r="10"/>
              <path d="M30 25v30M20 55h20M20 25l-10 15M40 25l10 15M20 55v15M40 55v15"/>
            </svg>
            <svg width="50" height="70" viewBox="0 0 50 70" fill="none" stroke="#3A2E24" stroke-width="1.5">
              <circle cx="25" cy="12" r="8"/>
              <path d="M25 20v25M18 45h14M18 20l-7 12M32 20l7 12M18 45v12M32 45v12"/>
            </svg>
            <svg width="60" height="80" viewBox="0 0 60 80" fill="none" stroke="#3A2E24" stroke-width="1.5">
              <circle cx="30" cy="15" r="10"/>
              <path d="M30 25v30M20 55h20M20 25l-10 15M40 25l10 15M20 55v15M40 55v15"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ EXPOSITIONS ============ -->
<section id="expositions" class="py-16 lg:py-20">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[32px] lg:text-[44px]">Экспозиции музея</h2>
      <a href="#" class="link-arrow text-sm">Все экспозиции
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <!-- Expo card -->
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-art1 aspect-[4/3]"></div>
        <div class="p-5">
          <h3 class="font-['Literata'] text-lg font-semibold mb-2">Наивное искусство без правил</h3>
          <p class="text-sm text-[#6B5A4A] mb-4">Работы художников-примитивистов, в которых особенно чувствуется искренность, свобода взгляда и отсутствие академических рамок.</p>
          <a href="#" class="link-arrow text-sm">Все экспозиции
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </div>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-art2 aspect-[4/3]"></div>
        <div class="p-5">
          <h3 class="font-['Literata'] text-lg font-semibold mb-2">Наивное искусство без правил</h3>
          <p class="text-sm text-[#6B5A4A] mb-4">Работы художников-примитивистов, в которых особенно чувствуется искренность, свобода взгляда и отсутствие академических рамок.</p>
          <a href="#" class="link-arrow text-sm">Все экспозиции
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </div>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-art3 aspect-[4/3]"></div>
        <div class="p-5">
          <h3 class="font-['Literata'] text-lg font-semibold mb-2">Наивное искусство без правил</h3>
          <p class="text-sm text-[#6B5A4A] mb-4">Работы художников-примитивистов, в которых особенно чувствуется искренность, свобода взгляда и отсутствие академических рамок.</p>
          <a href="#" class="link-arrow text-sm">Все экспозиции
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </div>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-art4 aspect-[4/3]"></div>
        <div class="p-5">
          <h3 class="font-['Literata'] text-lg font-semibold mb-2">Наивное искусство без правил</h3>
          <p class="text-sm text-[#6B5A4A] mb-4">Работы художников-примитивистов, в которых особенно чувствуется искренность, свобода взгляда и отсутствие академических рамок.</p>
          <a href="#" class="link-arrow text-sm">Все экспозиции
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ SPECIAL EXPOSITION BANNER ============ -->
<section class="py-12">
  <div class="container-main">
    <div class="relative rounded-3xl overflow-hidden bg-[#E8872C]/10">
      <div class="grid md:grid-cols-2">
        <div class="p-8 md:p-12 lg:p-14 flex flex-col justify-center">
          <span class="text-sm font-medium text-[#E8872C] mb-3 uppercase tracking-wide">Особая постоянная экспозиция</span>
          <h2 class="text-[28px] lg:text-[40px] mb-4">СССР: Сокровища счастливого советского ребенка</h2>
          <p class="text-[17px] text-[#6B5A4A] mb-7">Особая постоянная экспозиция музея, посвященная памяти детства, советским игрушка, предметам быта и визуальной культуре прошлого.</p>
          <div>
            <a href="#" class="btn-primary">Подробнее об экспозиции
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </div>
        </div>
        <div class="relative">
          <div class="ph ph-ussr aspect-[4/3] md:aspect-auto md:h-full"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ MASTER CLASSES AND LECTURES ============ -->
<section id="classes" class="py-16 lg:py-20">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[32px] lg:text-[44px]">Мастер-классы и лекции</h2>
      <a href="#" class="link-arrow text-sm">Все мастер-классы и лекции
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-5">
      <!-- Big master class card -->
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-art1 aspect-[16/10]"></div>
        <div class="p-6">
          <div class="flex items-center justify-between mb-3">
            <span class="event-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2Z"/><path d="M7 12c1-1 2-1 3-1s2 0 3 1 2 1 3 0"/></svg>
              Мастер-класс
            </span>
            <span class="text-xs text-[#6B5A4A] font-medium">19 мая, вс · 12:00</span>
          </div>
          <h3 class="font-['Literata'] text-xl font-semibold mb-3">Живопись акрилом: весенний пейзаж</h3>
          <p class="text-sm text-[#6B5A4A] mb-5">Пишем яркий пейзаж под руководством преподавателя. Для взрослых и подростков.</p>
          <a href="#" class="btn-outline w-full !py-2.5 text-sm">Записаться</a>
        </div>
      </div>
      
      <!-- Right column - lecture list -->
      <div class="flex flex-col gap-5">
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm grid grid-cols-[1fr_1fr]">
          <div class="ph ph-art2"></div>
          <div class="p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="event-badge">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 4v4M16 4v4"/></svg>
                  Лекция
                </span>
                <span class="text-xs text-[#6B5A4A] font-medium">21 мая, вт · 18:30</span>
              </div>
              <h3 class="font-['Literata'] text-base font-semibold mb-2">Лекция: Как понимать наивное искусство</h3>
              <p class="text-sm text-[#6B5A4A]">О языке, символах и особой искренности наивного искусства.</p>
            </div>
            <a href="#" class="btn-outline w-full !py-2 text-sm mt-4">Подробнее</a>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm grid grid-cols-[1fr_1fr]">
          <div class="ph ph-art3"></div>
          <div class="p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="event-badge">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2Z"/><path d="M8 12h8M12 8v8"/></svg>
                  Встреча
                </span>
                <span class="text-xs text-[#6B5A4A] font-medium">21 мая, вт · 18:30</span>
              </div>
              <h3 class="font-['Literata'] text-base font-semibold mb-2">Лекция: Как понимать наивное искусство</h3>
              <p class="text-sm text-[#6B5A4A]">О языке, символах и особой искренности наивного искусства.</p>
            </div>
            <a href="#" class="btn-outline w-full !py-2 text-sm mt-4">Подробнее</a>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm grid grid-cols-[1fr_1fr]">
          <div class="ph ph-art4"></div>
          <div class="p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="event-badge">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8872C" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 4v4M16 4v4"/></svg>
                  Лекция
                </span>
                <span class="text-xs text-[#6B5A4A] font-medium">21 мая, вт · 18:30</span>
              </div>
              <h3 class="font-['Literata'] text-base font-semibold mb-2">Лекция: Как понимать наивное искусство</h3>
              <p class="text-sm text-[#6B5A4A]">О языке, символах и особой искренности наивного искусства.</p>
            </div>
            <a href="#" class="btn-outline w-full !py-2 text-sm mt-4">Подробнее</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ MUSEUM SHOP ============ -->
<section id="shop" class="py-16 lg:py-20 bg-[#F5EADB]">
  <div class="container-main">
    <div class="flex items-end justify-between mb-10">
      <h2 class="text-[32px] lg:text-[44px]">Магазин музея</h2>
      <a href="#" class="link-arrow text-sm">В магазин
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <!-- Product card -->
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-shop aspect-square"></div>
        <div class="p-5">
          <h3 class="font-['Literata'] text-base font-semibold mb-2">Каталоги выставки</h3>
          <p class="text-sm text-[#6B5A4A] mb-4">«Истории в цвете»: иллюстрированный каталог с текстами о наивном искусстве.</p>
          <div class="flex items-center gap-3">
            <span class="font-semibold text-lg">00 BYN</span>
            <a href="#" class="btn-primary !py-2 !px-4 text-sm ml-auto">В корзину</a>
          </div>
        </div>
      </div>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-shop aspect-square"></div>
        <div class="p-5">
          <h3 class="font-['Literata'] text-base font-semibold mb-2">Каталоги выставки</h3>
          <p class="text-sm text-[#6B5A4A] mb-4">«Истории в цвете»: иллюстрированный каталог с текстами о наивном искусстве.</p>
          <div class="flex items-center gap-3">
            <span class="font-semibold text-lg">00 BYN</span>
            <a href="#" class="btn-primary !py-2 !px-4 text-sm ml-auto">В корзину</a>
          </div>
        </div>
      </div>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-shop aspect-square"></div>
        <div class="p-5">
          <h3 class="font-['Literata'] text-base font-semibold mb-2">Каталоги выставки</h3>
          <p class="text-sm text-[#6B5A4A] mb-4">«Истории в цвете»: иллюстрированный каталог с текстами о наивном искусстве.</p>
          <div class="flex items-center gap-3">
            <span class="font-semibold text-lg">00 BYN</span>
            <a href="#" class="btn-primary !py-2 !px-4 text-sm ml-auto">В корзину</a>
          </div>
        </div>
      </div>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
        <div class="ph ph-shop aspect-square"></div>
        <div class="p-5">
          <h3 class="font-['Literata'] text-base font-semibold mb-2">Каталоги выставки</h3>
          <p class="text-sm text-[#6B5A4A] mb-4">«Истории в цвете»: иллюстрированный каталог с текстами о наивном искусстве.</p>
          <div class="flex items-center gap-3">
            <span class="font-semibold text-lg">00 BYN</span>
            <a href="#" class="btn-primary !py-2 !px-4 text-sm ml-auto">В корзину</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ WHY US ============ -->
<section class="py-16 lg:py-20">
  <div class="container-main">
    <h2 class="text-[32px] lg:text-[44px] mb-12 text-center">Почему приходят к нам</h2>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="text-center">
        <div class="mx-auto mb-5 w-20 h-20 flex items-center justify-center">
          <svg width="64" height="64" viewBox="0 0 64 64" fill="none" stroke="#E8872C" stroke-width="2" stroke-linecap="round">
            <path d="M32 8c-8 0-16 8-16 18 0 14 12 22 16 22s16-8 16-22c0-10-8-18-16-18z"/>
            <path d="M22 20l8 8M42 20l-8 8M20 34h24"/>
            <circle cx="52" cy="12" r="2" fill="#E8872C"/>
            <circle cx="10" cy="46" r="1.5" fill="#E8872C"/>
          </svg>
        </div>
        <h3 class="font-['Literata'] text-xl font-semibold mb-3">Живая атмосфера</h3>
        <p class="text-sm text-[#6B5A4A]">Уютное пространство, где искусство становится ближе, музей воспринимается неформально и по-домашнему.</p>
      </div>
      <div class="text-center">
        <div class="mx-auto mb-5 w-20 h-20 flex items-center justify-center">
          <svg width="64" height="64" viewBox="0 0 64 64" fill="none" stroke="#E8872C" stroke-width="2" stroke-linecap="round">
            <circle cx="22" cy="22" r="8"/>
            <path d="M14 44c0-4 4-8 8-8s8 4 8 8v4H14v-4z"/>
            <circle cx="42" cy="18" r="6"/>
            <path d="M36 40c0-3 3-6 6-6s6 3 6 6v4h-12v-4z"/>
          </svg>
        </div>
        <h3 class="font-['Literata'] text-xl font-semibold mb-3">Интересно всей семье</h3>
        <p class="text-sm text-[#6B5A4A]">Программы события для детей, взрослых, семейные посещения с возможностью совместного творческого опыта.</p>
      </div>
      <div class="text-center">
        <div class="mx-auto mb-5 w-20 h-20 flex items-center justify-center">
          <svg width="64" height="64" viewBox="0 0 64 64" fill="none" stroke="#E8872C" stroke-width="2" stroke-linecap="round">
            <path d="M8 50c12-4 20-8 24-20"/>
            <path d="M32 30l10-10 14 4-4 14z"/>
            <circle cx="56" cy="14" r="4"/>
            <path d="M48 22l-6-6"/>
          </svg>
        </div>
        <h3 class="font-['Literata'] text-xl font-semibold mb-3">Можно не только смотреть</h3>
        <p class="text-sm text-[#6B5A4A]">Мастер-классы, лекции, встречи с творческими людьми — знакомитесь с искусством, а становитесь его участником.</p>
      </div>
      <div class="text-center">
        <div class="mx-auto mb-5 w-20 h-20 flex items-center justify-center">
          <svg width="64" height="64" viewBox="0 0 64 64" fill="none" stroke="#E8872C" stroke-width="2" stroke-linecap="round">
            <rect x="8" y="12" width="48" height="40" rx="4"/>
            <path d="M8 22h48M18 8v8M46 8v8"/>
            <circle cx="32" cy="40" r="6"/>
            <path d="M32 37l-3 4 3 4 3-4z" fill="#E8872C"/>
          </svg>
        </div>
        <h3 class="font-['Literata'] text-xl font-semibold mb-3">События круглый год</h3>
        <p class="text-sm text-[#6B5A4A]">Постоянная афиша, выставки, образовательные форматы и специальные проекты — всегда есть повод прийти снова.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA SECTION ============ -->
<section class="py-20 lg:py-28 relative">
  <div class="ph ph-cta absolute inset-0"></div>
  <div class="absolute inset-0 bg-[#3A2E24]/50"></div>
  <div class="container-main relative text-center">
    <h2 class="text-[32px] sm:text-[40px] lg:text-[52px] text-white mb-8 max-w-3xl mx-auto leading-tight">
      Проведите день в мире искреннего искусства
    </h2>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
      <a href="#" class="btn-primary">
        Купить билет
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
      <a href="#" class="btn-outline !bg-white/10 !border-white/40 !text-white hover:!bg-white hover:!text-[#3A2E24] hover:!border-white">
        Посмотреть афишу
      </a>
    </div>
  </div>
</section>
<?php
/* get_template_part( 'template-parts/home/form', 'form' ); */
get_footer();

