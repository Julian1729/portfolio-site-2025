<?php

use Julian2025\SportsAPI;

// $team_id = $args['team_id'];
// $api = new SportsAPI($team_id);
// $api->fetch_data();

$api = $args['api_obj'] ?? null;

$team = null;

// output all data with var_dump for debugging
// echo '<pre>';
// var_dump($api->get_opponent_logo());
// echo '</pre>';

$opponent_name = $api->get_opponent_name();
$team_score = $api->get_team_score();
$opponent_score = $api->get_opponent_score();
$is_win = $api->is_win();
$team_logo = $api->get_team_logo();
$opponent_logo = $api->get_opponent_logo();
$is_home = $api->is_home_team();

$home_team_logo = $api->is_home_team() ? $team_logo : $opponent_logo;
$away_team_logo = $api->is_home_team() ? $opponent_logo : $team_logo;
$home_team_score = $api->is_home_team() ? $team_score : $opponent_score;
$away_team_score = $api->is_home_team() ? $opponent_score : $team_score;
$home_team_name = $api->is_home_team() ? $api->get_team_name() : $opponent_name;
$away_team_name = $api->is_home_team() ? $opponent_name : $api->get_team_name();

?>

<div class="scorebug scorebug--location--<?php echo $is_home ? 'home' : 'away'; ?> scorebug--<?php echo $is_win ? 'win' : 'lose'; ?>">

  <div class="scorebug__team">
    <div class="scorebug__logo-wrapper">
      <img class="scorebug__logo" src="<?php echo esc_url($home_team_logo); ?>" alt="<?php echo esc_attr($home_team_name); ?> logo">
    </div>
    <p class="scorebug__score"><?php echo esc_html($home_team_score); ?></p>
  </div>

  <div class="scorebug__team">
    <p class="scorebug__score"><?php echo esc_html($away_team_score); ?></p>
    <div class="scorebug__logo-wrapper">
      <img class="scorebug__logo" src="<?php echo esc_url($away_team_logo); ?>" alt="Royals logo">
    </div>
  </div>

</div>