<?php

// Register Projects Post Type
function julian2025_projects_post_type()
{
  $labels = array(
    'name' => _x('Projects', 'julian2025'),
    'singular_name' => _x('Projects', 'julian2025'),
    'menu_name' => 'Projects',
    'name_admin_bar' => 'Projects',
    'archives' => 'Projects',
    'attributes' => 'Project Attributes',
    'parent_item_colon' => 'Parent Project:',
    'all_items' => 'All Projects',
    'add_new_item' => 'Add New Project',
    'add_new' => 'Add Project',
    'new_item' => 'New Project',
    'edit_item' => 'Edit Project',
    'update_item' => 'Update Project',
    'view_item' => 'View Project',
    'view_items' => 'View Projects',
    'search_items' => 'Search Projects',
    'not_found' => 'Not found',
    'not_found_in_trash' => 'Not found in Trash',
    'featured_image' => 'Project Image',
    'set_featured_image' => 'Set Project image',
    'remove_featured_image' => 'Remove Project image',
    'use_featured_image' => 'Use as project image',
    'insert_into_item' => 'Insert into Project',
    'uploaded_to_this_item' => 'Uploaded to this Project',
    'items_list' => 'Project list',
    'items_list_navigation' => 'Project list navigation',
    'filter_items_list' => 'Filter Project list',
  );
  $args = array(
    'label' => 'Projects',
    'description' => 'Projects Post Type',
    'labels' => $labels,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'taxonomies' => ['category'],
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    // 'menu_icon' => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaWQ9IkxheWVyXzEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMwIDMwOyIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgMzAgMzAiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+Cgkuc3Qwe2ZpbGw6I0ZENkE3RTt9Cgkuc3Qxe2ZpbGw6IzE3Qjk3ODt9Cgkuc3Qye2ZpbGw6Izg3OTdFRTt9Cgkuc3Qze2ZpbGw6IzQxQTZGOTt9Cgkuc3Q0e2ZpbGw6IzM3RTBGRjt9Cgkuc3Q1e2ZpbGw6IzJGRDlCOTt9Cgkuc3Q2e2ZpbGw6I0Y0OThCRDt9Cgkuc3Q3e2ZpbGw6I0ZGREYxRDt9Cgkuc3Q4e2ZpbGw6I0M2QzlDQzt9Cjwvc3R5bGU+PHBhdGggY2xhc3M9InN0OCIgZD0iTTYsOS4zTDMuOSw1LjhsMS40LTEuNGwzLjUsMi4xdjEuNGwzLjYsMy42YzAsMC4xLDAsMC4yLDAsMC4zTDExLjEsMTNMNy40LDkuM0g2eiBNMjEsMTcuOGMtMC4zLDAtMC41LDAtMC44LDAgIGMwLDAsMCwwLDAsMGMtMC43LDAtMS4zLTAuMS0xLjktMC4ybC0yLjEsMi40bDQuNyw1LjNjMS4xLDEuMiwzLDEuMyw0LjEsMC4xYzEuMi0xLjIsMS4xLTMtMC4xLTQuMUwyMSwxNy44eiBNMjQuNCwxNCAgYzEuNi0xLjYsMi4xLTQsMS41LTYuMWMtMC4xLTAuNC0wLjYtMC41LTAuOC0wLjJsLTMuNSwzLjVsLTIuOC0yLjhsMy41LTMuNWMwLjMtMC4zLDAuMi0wLjctMC4yLTAuOEMyMCwzLjQsMTcuNiwzLjksMTYsNS42ICBjLTEuOCwxLjgtMi4yLDQuNi0xLjIsNi44bC0xMCw4LjljLTEuMiwxLjEtMS4zLDMtMC4xLDQuMWwwLDBjMS4yLDEuMiwzLDEuMSw0LjEtMC4xbDguOS0xMEMxOS45LDE2LjMsMjIuNiwxNS45LDI0LjQsMTR6Ii8+PC9zdmc+',
    'menu_icon' => 'dashicons-welcome-view-site',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'show_in_rest' => true,
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'rewrite' => array(
      'with_front' => false,
      'slug' => 'projects'
    ),
  );

  register_post_type('projects', $args);
}
add_action('init', 'julian2025_projects_post_type', 0);


// disable gutenberg editor for custom post types
function julian2025_disable_gutenberg_editor($is_enabled, $post_type)
{
  if ($post_type === 'projects') {
    return false;
  }
  return $is_enabled;
}
add_filter('use_block_editor_for_post_type', 'julian2025_disable_gutenberg_editor', 10, 2);
