<?php

$skills = get_field('skills', 'option');

if (!$skills) return;
?>

<ul class="skills-list">
  <?php foreach ($skills as $skill) : ?>
    <li class="skills-list__item skills-list__item--name--<?php echo sanitize_title($skill['name']); ?>">
      <p class="skills-list__name"><?php echo esc_html($skill['name']); ?></p>
      <?php echo wp_get_attachment_image($skill['icon'], null, false, ['class' => 'skills-list__icon']); ?>
    </li>
  <?php endforeach; ?>
</ul>