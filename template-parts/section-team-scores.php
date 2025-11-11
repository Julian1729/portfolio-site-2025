<?php

use Julian2025\SportsAPI;

$eagles_api = new SportsAPI(134936);
$eagles_api->fetch_data();

$phillies_api = new SportsAPI(135276);
$phillies_api->fetch_data();

$emotion_description = '';

if ($eagles_api->is_win() && $phillies_api->is_win()) {
  // double win
  $memoji_image = 'happy_memoji_celebrate.png';
  $emotion_description = 'super happy';
} elseif ($eagles_api->is_win() || $phillies_api->is_win()) {
  // one win, one loss
  $memoji_image = 'mixed_memoji_shrug.png';
  $emotion_description = 'conflicted';
} else {
  // double loss
  $memoji_image = 'sad_memoji_tear.png';
  $emotion_description = 'sad';
}

?>

<div class="about-section__scorebug-container">
  <h3 class="about-section__feeling-heading">How is Julian feeling today?</h3>
  <img class="about-section__scorebug-pipe-top" src="<?php echo get_template_directory_uri(); ?>/assets/images/scorebug-pipe.svg" alt="">
</div>

<div class="about-section__scorebug-container about-section__scorebug-container--top">
  <?php get_template_part('template-parts/content', 'scorebug', ['api_obj' => $eagles_api]); ?>

  <img class="about-section__scorebug-pipe-top" src="<?php echo get_template_directory_uri(); ?>/assets/images/scorebug-pipe.svg" alt="">
</div>

<div class="about-section__scorebug-container">
  <?php get_template_part('template-parts/content', 'scorebug', ['api_obj' => $phillies_api]); ?>
</div>

<div class="about-section__memoji-wrapper">
  <img class="about-section__scorebug-pipe-last" src="<?php echo get_template_directory_uri(); ?>/assets/images/scorebug-pipe-last.svg" alt="">
  <img class="about-section__memoji" src="<?php echo get_template_directory_uri() . '/assets/images/memojis/' . $memoji_image; ?>" alt="<?php echo "Julian's feeling \"$emotion_description\" memoji"; ?>" />

  <!-- <div class="curved-text-container"> -->
  <svg
    class="thetext"
    width="250"
    height="280"
    viewBox="0 0 250 280">
    <!-- arc just below the 200×200 circle -->
    <path
      id="bottomArc"
      d="M 50,200 A 110,110 0 0 0 200,200"
      fill="none" />

    <text font-size="22" fill="orange">
      <textPath
        href="#bottomArc"
        startOffset="50%"
        text-anchor="middle"
        dominant-baseline="hanging">
        <?php echo $emotion_description; ?>
      </textPath>
    </text>
  </svg>
  <!-- </div> -->

</div>