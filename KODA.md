# GeorgeAG Theme - KODA Context

## О проекте

**Тема:** WordPress тема для музея наивного искусства **Naif Arts** (Минск)

**Тип:** Кастомная тема на базе Underscores (_s)

**Стек технологий:**
- WordPress (PHP)
- TailwindCSS v4 (CDN)
- Google Fonts: Literata (заголовки), Golos Text (основной текст)
- JavaScript (ванильный, без фреймворков)

## Цветовая палитра

```css
--brand-orange: #F28A2E      /* Основной оранжевый */
--brand-orange-dark: #D1731F /* Оранжевый для hover */
--brand-cream: #FBF4EA       /* Светлый кремовый фон */
--brand-cream-dark: #F5EADB  /* Кремовый для акцентов */
--brand-text: #3A2E24        /* Основной текст */
--brand-text-light: #6B5A4A  /* Вторичный текст */
```

## Шрифты

- **Заголовки (h1-h6):** `Literata`, serif (7-72pt opsz, weights 400-700)
- **Основной текст:** `Golos Text`, sans-serif (weights 400-700)

## Структура темы

```
georgeag/
├── header.php          # Header с навигацией, логотипом, мобильным меню
├── footer.php          # Footer
├── homepage.php        # Главная страница (шаблон)
├── index.php           # Шаблон списка записей
├── single.php          # Одиночная запись
├── page.php            # Одиночная страница
├── archive.php         # Архив
├── 404.php             # 404 страница
├── functions.php       # Основная логика темы
├── style.css           # Стили (база + кастомные)
├── inc/                # Вспомогательные файлы
│   ├── custom-header.php
│   ├── customizer.php
│   ├── template-tags.php
│   ├── template-functions.php
│   └── jetpack.php
├── js/
│   ├── navigation.js   # Логика мобильного меню
│   └── customizer.js
├── img/                # SVG иконки (cart, alarm, menu, соцсети)
└── template-parts/     # Части шаблонов
```

## Ключевые функции

### Header
- Логотип через `custom_logo` (theme mod)
- Главное меню: `wp_nav_menu()` с меню "main-menu"
- Кнопка "Купить билет"
- Корзина с счётчиком (статическая)
- Мобильное бургер-меню
- Информационная строка с часами работы

### Главная страница (homepage.php)
Секции:
1. **Hero** — заголовок, описание, CTA-кнопки, hero-изображение
2. **Ближайшие события** — сетка карточек событий (мастер-классы, лекции, встречи)
3. **О музее** — описание + декоративная иллюстрация
4. **Экспозиции** — сетка карточек экспозиций
5. **Особая экспозиция (СССР)** — баннер с акцентом
6. **Мастер-классы и лекции** — крупная карточка + список
7. **Магазин** — сетка товаров (заглушки)
8. **Почему приходят к нам** — 4 преимущества с иконками
9. **CTA** — призыв к действию с фоном

### Навигация
- Primary menu в `functions.php` через `register_nav_menus()`
- Мобильное меню: фиксированное, выезжает справа, управляется через `navigation.js`

## Стили

### Кнопки
- `.btn-primary` — оранжевая закрашенная кнопка
- `.btn-outline` — прозрачная с оранжевой границей

### Ссылки
- `.link-arrow` — ссылка с анимированной стрелкой

### Заглушки изображений
- `.ph-*` — классы для placeholder-изображений с градиентами
- `.ph-art1-5` — разные цветовые варианты для артов
- `.ph-hero`, `.ph-museum`, `.ph-ussr`, `.ph-shop`, `.ph-cta` — специфичные секции

### Адаптивность
- `hide-mobile` / `hide-desktop` — для скрытия элементов на разных экранах
- Breakpoints: Tailwind default (sm: 640px, md: 768px, lg: 1024px, xl: 1280px)

## Интеграции

- **TailwindCSS v4** через CDN
- **Google Fonts** в `<head>`
- **WordPress Custom Logo** через `get_theme_mod('custom_logo')`
- **WP Nav Menu** с кастомными стилями ссылок

## Примечания

- Тема на стадии разработки
- Изображения — placeholder-градиенты (заменены на реальные ассеты позже)
- Контент — статический (не из WooCommerce/ACF пока)
- Все тексты на русском языке
- Тема оптимизирована для Минска (музей наивного искусства Naif Arts)

## ACF Поля (Advanced Custom Fields)

Все поля создаются автоматически через `inc/acf-fields.php`. В админке WordPress появятся следующие группы:

### Группы полей (в порядке отображения):

1. **Hero Section: Главный экран** (`group_hero_section`)
   - `hero_title` — Заголовок (text)
   - `hero_description` — Описание (textarea)
   - `hero_image` — Изображение героя (image)
   - `hero_cta_primary` — Главная кнопка (group: text, link)
   - `hero_cta_secondary` — Вторичная кнопка (group: text, link)

2. **Preview Events: Превью событий** (`group_preview_events`)
   - `preview_events` — Repeater (max 3): type, date, title, image, link

3. **Upcoming Events: Ближайшие события** (`group_upcoming_events`)
   - `upcoming_title` — Заголовок секции
   - `upcoming_link_text` — Текст ссылки
   - `upcoming_link_url` — Ссылка
   - `upcoming_events` — Repeater (max 4): type, datetime, title, description, image, link, button_text

4. **About Museum: О музее** (`group_about_museum`)
   - `about_title` — Заголовок
   - `about_description` — Описание
   - `about_image` — Изображение

5. **Expositions: Экспозиции музея** (`group_expositions`)
   - `expositions_title` — Заголовок
   - `expositions_link_text` — Текст ссылки
   - `expositions_link_url` — Ссылка
   - `expositions_list` — Repeater (max 4): title, description, image, link

6. **Special Exposition: Особая экспозиция** (`group_special_exposition`)
   - `special_badge` — Метка
   - `special_title` — Заголовок
   - `special_description` — Описание
   - `special_image` — Изображение
   - `special_button_text` — Текст кнопки
   - `special_button_link` — Ссылка кнопки

7. **Classes & Lectures: Мастер-классы и лекции** (`group_classes_lectures`)
   - `classes_title` — Заголовок
   - `classes_link_text` — Текст ссылки
   - `classes_link_url` — Ссылка
   - `classes_main` — Group (главный мастер-класс): type, datetime, title, description, image, link, button_text
   - `classes_list` — Repeater (max 3): type, datetime, title, description, image, link, button_text

8. **Museum Shop: Магазин музея** (`group_museum_shop`)
   - `shop_title` — Заголовок
   - `shop_link_text` — Текст ссылки
   - `shop_link_url` — Ссылка
   - `shop_products` — Repeater (max 4): title, description, price, image, link, button_text

9. **Why Us: Почему приходят к нам** (`group_why_us`)
   - `why_us_title` — Заголовок
   - `why_us_items` — Repeater (max 4): icon (SVG код), title, description

10. **CTA Section: Призыв к действию** (`group_cta_section`)
    - `cta_background_image` — Фоновое изображение
    - `cta_title` — Заголовок
    - `cta_primary` — Group: text, link
    - `cta_secondary` — Group: text, link

### Типы полей:
- **text** — Однострочный текст
- **textarea** — Многострочный текст
- **image** — Изображение (возвращается как URL)
- **url** — Ссылка
- **select** — Выпадающий список (type события)
- **group** — Группировка полей (кнопки)
- **repeater** — Повторяющаяся группа (карточки)

### Доступ к данным в шаблоне:
```php
// Простое поле
$title = get_field('hero_title');

// Групповое поле
$cta = get_field('hero_cta_primary');
echo $cta['text']; // Текст кнопки
echo $cta['link']; // Ссылка

// Repeater
$events = get_field('upcoming_events');
if ($events) {
    foreach ($events as $event) {
        echo $event['title'];
    }
}
```

## Паттерны реализации

### Dark Mode (если понадобится)
См. `.kodacli/KODA.md` в корневой директории проекта

### Добавление секции с кастомными стилями
1. Добавить уникальный класс-идентификатор секции в HTML
2. Использовать CSS селекторы с этим классом для точечного управления
3. Для dark mode: `.dark .уникальный-класс { ... }`

### Вывод данных из WooCommerce (если понадобится)
```php
get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false, 'number' => 4]);
```

### Ссылки на страницы по названию
```php
$page = get_page_by_title('Название');
get_permalink($page->ID);
```
