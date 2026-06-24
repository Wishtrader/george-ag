<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GeorgeAG
 */

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Naif Arts — Музей наивного искусства</title>
  
  <!-- Fonts: Literata for headings, Golos Text for content -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400;500;600;700&family=Literata:ital,opsz,wght@0,7..72,400;0,7..72,500;0,7..72,600;0,7..72,700;0,7..72,800;1,7..72,400;1,7..72,500&display=swap" rel="stylesheet" />
  
  <!-- TailwindCSS -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  
  <style>
    :root {
      --brand-orange: #F28A2E;
      --brand-orange-dark: #D1731F;
      --brand-cream: #FBF4EA;
      --brand-cream-dark: #F5EADB;
      --brand-text: #2D2926;
      --brand-text-light: #6B5A4A;
    }
    
    * {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    
    html {
      scroll-behavior: smooth;
    }
    
    body {
      font-family: 'Golos Text', sans-serif;
      color: var(--brand-text);
      background-color: var(--brand-cream);
      font-size: 16px;
      line-height: 1.6;
    }
    
    h1, h2, h3, h4, h5, h6 {
      font-family: 'Literata', serif;
      color: var(--brand-text);
      line-height: 1.15;
      font-weight: 400;
    }
    
    .container-main {
      max-width: 1240px;
      margin: 0 auto;
      padding-left: 20px;
      padding-right: 20px;
    }
    
    .btn-primary {
      background-color: var(--brand-orange);
      color: #fff;
      padding: 12px 28px;
      border-radius: 12px;
      font-weight: 500;
      transition: all .2s;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    .btn-primary:hover {
      background-color: var(--brand-orange-dark);
    }
    
    .btn-outline {
      border: 2px solid var(--brand-orange);
      color: var(--brand-orange);
      padding: 12px 28px;
      border-radius: 12px;
      font-weight: 500;
      transition: all .2s;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      background: transparent;
    }
    .btn-outline:hover {
      background-color: var(--brand-orange);
      color: #fff;
    }
    
    .link-arrow {
      color: var(--brand-orange);
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: gap .2s;
    }
    .link-arrow:hover {
      gap: 10px;
    }
    
    /* Placeholder images */
    .ph {
      background: linear-gradient(135deg, #E8D5BE 0%, #D4BFA6 100%);
      position: relative;
      overflow: hidden;
    }
    .ph::after {
      content: '';
      position: absolute;
      inset: 0;
      background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.08) 10px, rgba(255,255,255,0.08) 20px);
    }
    .ph::before {
      content: 'IMG';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: rgba(255,255,255,0.5);
      font-family: 'Literata', serif;
      font-size: 1.5rem;
      font-weight: 700;
      letter-spacing: 2px;
      z-index: 2;
    }
    
    .ph-art1 { background: linear-gradient(135deg, #F4D4A0 0%, #E8A87C 100%); }
    .ph-art2 { background: linear-gradient(135deg, #C7E9B0 0%, #8BC78B 100%); }
    .ph-art3 { background: linear-gradient(135deg, #F6B6B6 0%, #E89B7C 100%); }
    .ph-art4 { background: linear-gradient(135deg, #B0D4E9 0%, #8BB6D4 100%); }
    .ph-art5 { background: linear-gradient(135deg, #D4B0E9 0%, #B08BD4 100%); }
    .ph-museum { background: linear-gradient(135deg, #E8D5BE 0%, #C9A87C 100%); }
    .ph-hero { background: linear-gradient(135deg, #E8A87C 0%, #C77D4A 100%); }
    .ph-ussr { background: linear-gradient(135deg, #D4A574 0%, #A87040 100%); }
    .ph-shop { background: linear-gradient(135deg, #F0E4D0 0%, #D4BFA6 100%); }
    .ph-cta { background: linear-gradient(135deg, #6B4A2A 0%, #3A2E24 100%); }
    
    /* Decorative SVG icon style */
    .icon-box {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 28px;
      height: 28px;
      border-radius: 8px;
      background: #F5EADB;
    }
    
    /* Event card badge */
    .event-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      color: var(--brand-text-light);
      font-weight: 500;
    }
    
    /* Mobile menu */
    .mobile-menu {
      position: fixed;
      inset: 0;
      background: var(--brand-cream);
      z-index: 100;
      transform: translateX(100%);
      transition: transform .3s ease;
      overflow-y: auto;
    }
    .mobile-menu.open {
      transform: translateX(0);
    }
    
    /* Decorative hill shape behind about illustration */
    .hill-shape {
      background: linear-gradient(135deg, #E5D5C0 0%, #D4BFA6 100%);
      border-radius: 50% 50% 0 0 / 60% 60% 0 0;
    }
    
    /* Scroll snap-like smooth transitions */
    @media (max-width: 768px) {
      .hide-mobile { display: none !important; }
    }
    @media (min-width: 769px) {
      .hide-desktop { display: none !important; }
    }
  </style>
</head>
<body>

<!-- ============ HEADER ============ -->
<header class="sticky top-0 z-50 bg-[#FAF6EF]/95 backdrop-blur">
  <div class="container-main flex items-center justify-between py-4">
    <!-- Logo -->
	<?php
	$logo_id = get_theme_mod('custom_logo');

	if ($logo_id) {
	  $logo_url = wp_get_attachment_image_url($logo_id, 'full');
	    echo '<a href="' . esc_url(home_url()) . '">';
	    echo '<img src="' . esc_url($logo_url) . '" ';
	    echo 'alt="' . esc_attr(get_bloginfo('name')) . '" ';
	    echo 'class="h-[34px] w-auto object-contain hover:opacity-90 transition-opacity">';
	    echo '</a>';
	  }
	?>
    <!-- Desktop Nav -->
    <nav class="hide-mobile items-center gap-7 hidden lg:flex">
      <?php wp_nav_menu([
	'menu' => 'main-menu',       
	'menu_class' => 'flex items-center transition',
	'container' => false,
	'link_before' => '<span class="text-[15px] text-[#2D2926] font-medium hover:text-[#E8872C] transition-all mx-[10px]">',
	'link_after' => '</span>',
	  ]);
      ?>
    </nav>
    
    <!-- Right -->
    <div class="flex items-center gap-3">
      <div class="hidden md:flex">
	<a href="#" class="btn-primary text-base block min-w-[250px] min-h-[52px]">Купить билет</a>
      </div>
      <button class="relative p-2" aria-label="Корзина">
	<img src="<?php echo esc_url( get_template_directory_uri() . '/img/cart.svg' ); ?>" alt="cart" class="w-[30px]" />
        <span class="absolute -top-0.5 -right-0.5 text-[#E8872C] bg-[#FAF6EF] text-[13px] w-[24px] h-[24px] border border-[1px] border-[#E8872C] rounded-full flex items-center justify-center font-semibold">1</span>
      </button>
      <!-- Mobile burger -->
      <button id="menuBtn" class="hide-desktop p-2" aria-label="Меню">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#3A2E24" stroke-width="2" stroke-linecap="round">
          <line x1="3" y1="7" x2="21" y2="7"/>
          <line x1="3" y1="12" x2="21" y2="12"/>
          <line x1="3" y1="17" x2="21" y2="17"/>
        </svg>
      </button>
    </div>
  </div>
</header>

<div class="bg-[#FAF6EF]">
  <div class="container-main py-2.5 text-center text-sm md:text-lg text-[#2D2926]">
    <span class="inline-flex items-center gap-2">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/img/alarm-outline.svg' ); ?>" alt="clock" class="" />
      сегодня музей работает с 10:00 до 22:00
    </span>
  </div>
</div>
