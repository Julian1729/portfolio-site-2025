<?php

/* -------------------------------------------------------------------------- */
/*                                    Tech                                    */
/* -------------------------------------------------------------------------- */
function julian2025_register_tech_taxonomy()
{
  $labels = array(
    'name' => 'Tech',
    'singular_name' => 'Tech',
    'menu_name' => 'Tech',
    'all_items' => 'All Tech',
    'parent_item' => 'Parent Tech',
    'parent_item_colon' => 'Parent Tech:',
    'new_item_name' => 'New Tech Name',
    'add_new_item' => 'Add New Tech',
    'edit_item' => 'Edit Tech',
    'update_item' => 'Update Tech',
    'view_item' => 'View Tech',
    'separate_items_with_commas' => 'Separate Tech with commas',
    'add_or_remove_items' => 'Add or remove Tech',
    'choose_from_most_used' => 'Choose from the most used',
    'popular_items' => 'Popular Tech',
    'search_items' => 'Search Tech',
    'not_found' => 'Not Found',
    'no_terms' => 'No Tech',
    'items_list' => 'Tech list',
    'items_list_navigation' => 'Tech list navigation',
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => true,
    // 'rewrite' => array('with_front' => false, 'slug' => 'tech'),
  );

  register_taxonomy('tech', ['projects'], $args);
}

add_action('init', 'julian2025_register_tech_taxonomy', 0);
