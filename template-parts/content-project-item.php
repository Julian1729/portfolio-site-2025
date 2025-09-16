<?php

/**
 * Template part for displaying a project item in a list or grid.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package julian2025
 */

// get project custom fields
$logo = get_field('logo');
$project_link = get_field('link');
$tech_terms = get_the_terms(get_the_ID(), 'tech');
$is_featured = get_field('featured');

$cats = get_the_terms(get_the_ID(), 'category');

?>

<li class="pitem <?php echo $is_featured ? 'pitem--featured js-tilt' : ''; ?>" <?php echo $is_featured ? 'data-tilt data-tilt-perspective="300" data-tilt-speed="600" data-tilt-max="5"' : ''; ?>>
  <a class="pitem__link-wrapper" href="<?php echo esc_url($project_link); ?>" target="_blank" rel="noopener noreferrer">
    <?php echo wp_get_attachment_image($logo, 'full', null, ['class' => 'pitem__logo pitem__logo--id--' . $logo]); ?>


    <div class="pitem__content">
      <div class="pitem__heading">
        <ul class="pitem__cats cats <?php echo !$is_featured ? 'cats--centered' : ''; ?>">
          <?php if ($cats && !is_wp_error($cats)): ?>
            <?php foreach ($cats as $cat): ?>
              <li class="cats__item"><?php echo esc_html($cat->name); ?></li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>

        <h3 class="pitem__title"><?php the_title(); ?></h3>
      </div>

      <p class="pitem__description">
        <?php echo wp_kses_post(get_the_excerpt()); ?>
      </p>

      <ul class="pitem__tech-pills">

        <?php if ($tech_terms && !is_wp_error($tech_terms)): ?>
          <?php foreach ($tech_terms as $term): ?>
            <li class="pitem__tech-pill tech-pill"><?php echo esc_html($term->name); ?></li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>
    </div>


    <?php if ($is_featured) : ?>
      <div class="pitem__image-window">
        <!-- <img class="pitem__image" src="<?php echo get_template_directory_uri(); ?>/assets/images/lasik.png" alt="Screenshot of Lasik.com homepage"> -->
        <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, ['class' => 'pitem__image']); ?>
      </div>
    <?php endif; ?>
  </a>
</li>