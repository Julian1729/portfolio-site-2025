<?php

namespace Julian2025;

/**
 * Sports API Class
 * 
 * Class for fetching and processing sports data from TheSportsDB API
 * 
 * @package julian2025
 */
class SportsAPI
{

  /**
   * API base URL
   * @var string
   */
  protected $api_url;

  /**
   * Raw API response data
   * @var array|null
   */
  protected $raw_data = null;

  /**
   * Processed events data
   * @var array
   */
  protected $events = [];

  /**
   * Team ID for filtering home/away status
   * @var string|int
   */
  protected $team_id;

  /**
   * Constructor
   * 
   * @param string|int $team_id The team ID to track
   */
  public function __construct($team_id)
  {
    $this->team_id = $team_id;
    $this->api_url = "https://www.thesportsdb.com/api/v1/json/123/eventslast.php?id={$team_id}";
  }

  /**
   * Fetch data from API
   * 
   * @return bool Success status
   */
  public function fetch_data()
  {
    if (empty($this->api_url)) {
      return false;
    }

    $response = wp_remote_get($this->api_url, [
      'timeout' => 15,
      'headers' => [
        'User-Agent' => 'WordPress/' . get_bloginfo('version')
      ]
    ]);

    if (is_wp_error($response)) {
      error_log('SportsAPI Error: ' . $response->get_error_message());
      return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
      error_log('SportsAPI JSON Error: ' . json_last_error_msg());
      return false;
    }

    $this->raw_data = $data;
    $this->process_events();

    return true;
  }

  /**
   * Process events from raw data
   * Override in child classes for specific data structures
   */
  protected function process_events()
  {
    // Default processing - assumes 'events' key in response
    if (isset($this->raw_data['events'])) {
      $this->events = $this->raw_data['events'];
    } elseif (isset($this->raw_data['results'])) {
      $this->events = $this->raw_data['results'];
    }
  }

  /**
   * Get all events
   * 
   * @return array
   */
  public function get_events()
  {
    return $this->events;
  }

  /**
   * Get latest event
   * 
   * @return array|null
   */
  public function get_latest_event()
  {
    return !empty($this->events) ? $this->events[0] : null;
  }

  /**
   * Check if team won the latest game
   * 
   * @return bool|null
   */
  public function is_win()
  {
    $event = $this->get_latest_event();

    if (!$event || !$this->team_id) {
      return null;
    }

    $is_home = $this->is_home_team();
    $home_score = (int) ($event['intHomeScore'] ?? $event['home_score'] ?? 0);
    $away_score = (int) ($event['intAwayScore'] ?? $event['away_score'] ?? 0);

    if ($is_home) {
      return $home_score > $away_score;
    } else {
      return $away_score > $home_score;
    }
  }

  /**
   * Check if team lost the latest game
   * 
   * @return bool|null
   */
  public function is_loss()
  {
    $win_result = $this->is_win();
    return $win_result !== null ? !$win_result : null;
  }

  /**
   * Check if game was a tie
   * 
   * @return bool|null
   */
  public function is_tie()
  {
    $event = $this->get_latest_event();

    if (!$event) {
      return null;
    }

    $home_score = (int) ($event['intHomeScore'] ?? $event['home_score'] ?? 0);
    $away_score = (int) ($event['intAwayScore'] ?? $event['away_score'] ?? 0);

    return $home_score === $away_score;
  }

  /**
   * Check if team is playing at home
   * 
   * @return bool|null
   */
  public function is_home_team()
  {
    $event = $this->get_latest_event();

    if (!$event || !$this->team_id) {
      return null;
    }

    $home_team_id = $event['idHomeTeam'] ?? $event['home_team_id'] ?? null;
    return $home_team_id == $this->team_id;
  }

  /**
   * Check if team is playing away
   * 
   * @return bool|null
   */
  public function is_away_team()
  {
    $home_result = $this->is_home_team();
    return $home_result !== null ? !$home_result : null;
  }

  /**
   * Get team's score
   * 
   * @return int|null
   */
  public function get_team_score()
  {
    $event = $this->get_latest_event();

    if (!$event || !$this->team_id) {
      return null;
    }

    $is_home = $this->is_home_team();

    if ($is_home) {
      return (int) ($event['intHomeScore'] ?? $event['home_score'] ?? 0);
    } else {
      return (int) ($event['intAwayScore'] ?? $event['away_score'] ?? 0);
    }
  }

  /**
   * Get opponent's score
   * 
   * @return int|null
   */
  public function get_opponent_score()
  {
    $event = $this->get_latest_event();

    if (!$event || !$this->team_id) {
      return null;
    }

    $is_home = $this->is_home_team();

    if ($is_home) {
      return (int) ($event['intAwayScore'] ?? $event['away_score'] ?? 0);
    } else {
      return (int) ($event['intHomeScore'] ?? $event['home_score'] ?? 0);
    }
  }

  /**
   * Get game result as string
   * 
   * @return string|null
   */
  public function get_result()
  {
    if ($this->is_win()) {
      return 'W';
    } elseif ($this->is_loss()) {
      return 'L';
    } elseif ($this->is_tie()) {
      return 'T';
    }

    return null;
  }

  /**
   * Get formatted score string
   * 
   * @return string|null
   */
  public function get_score_string()
  {
    $team_score = $this->get_team_score();
    $opponent_score = $this->get_opponent_score();

    if ($team_score === null || $opponent_score === null) {
      return null;
    }

    return $team_score . '-' . $opponent_score;
  }

  /**
   * Get opponent team name
   * 
   * @return string|null
   */
  public function get_opponent_name()
  {
    $event = $this->get_latest_event();

    if (!$event || !$this->team_id) {
      return null;
    }

    $is_home = $this->is_home_team();

    if ($is_home) {
      return $event['strAwayTeam'] ?? $event['away_team'] ?? null;
    } else {
      return $event['strHomeTeam'] ?? $event['home_team'] ?? null;
    }
  }

  // create function to get team name
  public function get_team_name()
  {
    $event = $this->get_latest_event();
    if (!$event || !$this->team_id) {
      return null;
    }
    $is_home = $this->is_home_team();
    if ($is_home) {
      return $event['strHomeTeam'] ?? $event['home_team'] ?? null;
    } else {
      return $event['strAwayTeam'] ?? $event['away_team'] ?? null;
    }
  }

  // create function to get opponent team logo
  public function get_opponent_logo()
  {
    $event = $this->get_latest_event();

    if (!$event || !$this->team_id) {
      return null;
    }

    $is_home = $this->is_home_team();

    if ($is_home) {
      return $event['strAwayTeamBadge'] ?? $event['away_team_logo'] ?? null;
    } else {
      return $event['strHomeTeamBadge'] ?? $event['home_team_logo'] ?? null;
    }
  }

  public function get_team_logo()
  {
    $event = $this->get_latest_event();

    if (!$event || !$this->team_id) {
      return null;
    }

    $is_home = $this->is_home_team();

    if ($is_home) {
      return $event['strHomeTeamBadge'] ?? $event['home_team_logo'] ?? null;
    } else {
      return $event['strAwayTeamBadge'] ?? $event['away_team_logo'] ?? null;
    }
  }

  /**
   * Get game date
   * 
   * @return string|null
   */
  public function get_game_date()
  {
    $event = $this->get_latest_event();

    if (!$event) {
      return null;
    }

    return $event['dateEvent'] ?? $event['date'] ?? null;
  }

  /**
   * Check if game is completed
   * 
   * @return bool
   */
  public function is_game_completed()
  {
    $event = $this->get_latest_event();

    if (!$event) {
      return false;
    }

    // Check if scores exist and are not null
    $home_score = $event['intHomeScore'] ?? $event['home_score'] ?? null;
    $away_score = $event['intAwayScore'] ?? $event['away_score'] ?? null;

    return $home_score !== null && $away_score !== null;
  }

  /**
   * Get win/loss record
   * 
   * @param int $limit Number of recent games to check
   * @return array ['wins' => int, 'losses' => int, 'ties' => int]
   */
  public function get_record($limit = 10)
  {
    $record = ['wins' => 0, 'losses' => 0, 'ties' => 0];
    $events = array_slice($this->events, 0, $limit);

    foreach ($events as $event) {
      if (!$this->is_event_completed($event)) {
        continue;
      }

      if ($this->is_event_win($event)) {
        $record['wins']++;
      } elseif ($this->is_event_loss($event)) {
        $record['losses']++;
      } else {
        $record['ties']++;
      }
    }

    return $record;
  }

  /**
   * Helper: Check if specific event is completed
   * 
   * @param array $event
   * @return bool
   */
  private function is_event_completed($event)
  {
    if (!$event) {
      return false;
    }

    $home_score = $event['intHomeScore'] ?? $event['home_score'] ?? null;
    $away_score = $event['intAwayScore'] ?? $event['away_score'] ?? null;

    return $home_score !== null && $away_score !== null;
  }

  /**
   * Helper: Check if team won specific event
   * 
   * @param array $event
   * @return bool|null
   */
  private function is_event_win($event)
  {
    if (!$event || !$this->team_id) {
      return null;
    }

    $is_home = $this->is_event_home_team($event);
    $home_score = (int) ($event['intHomeScore'] ?? $event['home_score'] ?? 0);
    $away_score = (int) ($event['intAwayScore'] ?? $event['away_score'] ?? 0);

    if ($is_home) {
      return $home_score > $away_score;
    } else {
      return $away_score > $home_score;
    }
  }

  /**
   * Helper: Check if team lost specific event
   * 
   * @param array $event
   * @return bool|null
   */
  private function is_event_loss($event)
  {
    $win_result = $this->is_event_win($event);
    return $win_result !== null ? !$win_result : null;
  }

  /**
   * Helper: Check if team is home in specific event
   * 
   * @param array $event
   * @return bool|null
   */
  private function is_event_home_team($event)
  {
    if (!$event || !$this->team_id) {
      return null;
    }

    $home_team_id = $event['idHomeTeam'] ?? $event['home_team_id'] ?? null;
    return $home_team_id == $this->team_id;
  }

  /**
   * Get raw API data
   * 
   * @return array|null
   */
  public function get_raw_data()
  {
    return $this->raw_data;
  }
}
