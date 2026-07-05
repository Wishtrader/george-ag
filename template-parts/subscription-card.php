<?php
/**
 * Template Part: Subscription Card
 *
 * @package GeorgeAG
 */

$subscription_id    = get_the_ID();
$subscription_title = get_the_title();
$subscription_desc  = get_field('subscription_description');
$subscription_price = get_field('subscription_price');
$subscription_btn_text = get_field('subscription_button_text') ?: 'Подробнее';
$subscription_btn_url  = get_field('subscription_button_url') ?: '#';
$what_includes      = get_field('subscription_what_includes');
$thumbnail_url      = get_the_post_thumbnail_url($subscription_id, 'full');
?>

<div class="subscription-card">
  <?php if ($thumbnail_url): ?>
  <div class="subscription-card__image">
    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($subscription_title); ?>" class="subscription-card__img">
  </div>
  <?php else: ?>
  <div class="subscription-card__image">
    <div class="ph ph-museum subscription-card__img"></div>
  </div>
  <?php endif; ?>

  <div class="subscription-card__body">
    <h3 class="subscription-card__title"><?php echo esc_html($subscription_title); ?></h3>

    <?php if ($subscription_desc): ?>
    <p class="subscription-card__desc"><?php echo wp_kses_post($subscription_desc); ?></p>
    <?php endif; ?>

    <?php if ($what_includes): ?>
    <div class="subscription-card__includes">
      <span class="subscription-card__includes-label">Что входит</span>
      <div class="subscription-card__includes-line"></div>
    </div>
    <ul class="subscription-card__list">
      <?php foreach ($what_includes as $row): ?>
      <li class="subscription-card__list-item">
        <span class="subscription-card__list-icon">
          <?php if (!empty($row['icon'])): ?>
            <img src="<?php echo esc_url($row['icon']); ?>" alt="" class="subscription-card__list-icon-img">
          <?php else: ?>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="12" r="10" stroke="#E8A62E" stroke-width="1.5"/>
              <path d="M8 12l2.5 2.5L16 9" stroke="#E8A62E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          <?php endif; ?>
        </span>
        <span class="subscription-card__list-text"><?php echo esc_html($row['item']); ?></span>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <div class="subscription-card__footer">
      <span class="subscription-card__price">от <strong><?php echo esc_html($subscription_price); ?></strong></span>
      <a href="<?php echo esc_url($subscription_btn_url); ?>" class="btn-outline subscription-card__btn">
        <?php echo esc_html($subscription_btn_text); ?>
      </a>
    </div>
  </div>
</div>
