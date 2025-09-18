<?php

/**
 * Template part for displaying a work history item.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package julian2025
 */
$item = $args['item'];

$has_company_link = $item['company'] && $item['company']['url'] !== '#' && $item['company']['url'] !== '';
?>

<li class="witem">
  <?php if ($has_company_link): ?>
    <a class="witem__logo-link" href="<?php echo esc_url($item['company']['url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Visit <?php echo esc_attr($item['company']['title']); ?>'s website">
    <?php endif; ?>
    <?php
    if ($item['logo']) {
      echo wp_get_attachment_image($item['logo'], 'full', false, [
        'class' => 'witem__logo witem__logo--company--' . sanitize_title($item['company']['title']),
      ]);
    }
    ?>
    <?php if ($has_company_link): ?>
    </a>
  <?php endif; ?>

  <h3 class="witem__title"><?php echo esc_html($item['title']); ?></h3>

  <ul class="cats witem__meta">
    <li class="cats__item">
      <?php if ($has_company_link): ?>
        <a class="cats__link" href="<?php echo esc_url($item['company']['url']); ?>" target="_blank"><?php echo esc_html($item['company']['title']); ?></a>
      <?php else: ?>
        <span class="cats__text"><?php echo esc_html($item['company']['title']); ?></span>
      <?php endif; ?>
    </li>
    <li class="cats__item">March 2021 - February 2024</li>
  </ul>

  <div class="witem__description">
    <?php echo wp_kses_post($item['description']); ?>
  </div>
</li>