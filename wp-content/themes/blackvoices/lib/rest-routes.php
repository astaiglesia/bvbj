<?php
global $post;

add_action( 'rest_api_init', 'register_routes' );

function register_routes () {
  register_rest_route( 'insight/v1', 'get-posts', array(
    'methods' => 'GET',
    'callback' => 'api_get_posts',
  ));

  register_rest_route( 'insight/v1', 'get-case-studies', array(
    'methods' => 'GET',
    'callback' => 'api_get_case_studies',
  ));

  /**
   * GET /insight/vi/set-cookie
   * retrieves component HTML for a row of companies
   */
  register_rest_route('insight/v1', 'set-cookie', [
    'methods' => 'GET',
    'callback' => 'api_set_cookie',
  ]);

  /**
   * GET /insight/vi/get-cookie
   * retrieves component HTML for a row of companies
   */
  register_rest_route('insight/v1', 'get-cookie', [
    'methods' => 'GET',
    'callback' => 'api_get_cookie',
  ]);

  /**
   * GET /insight/vi/get-companies
   * retrieves component JSON for a row of companies
   */
  register_rest_route('insight/v1', 'get-companies', [
    'methods' => 'GET',
    'callback' => 'api_get_companies',
  ]);

  /**
   * GET /insight/vi/get-users
   * retrieves component JSON for a row of users
   */
  register_rest_route('insight/v1', 'get-users', [
    'methods' => 'GET',
    'callback' => 'api_get_users',
  ]);
}

// return query results
function api_get_posts () {
  // get posts by type
  $args = [
    'post_type' => $_GET['type'] ? $_GET['type'] : 'post'
  ];

  $posts = new WP_Query($args);

  return json_encode([
    'request' => $_GET,
    'max' => $posts->max_num_pages,
    'posts' => $posts
  ]);
}

// get modal html for piano keys
function api_get_case_studies () {
  // get posts by type
  if($_GET['id']) {
    $id = intval($_GET['id']);
    // $content = get_field('case_studies', $id);
    $html = get_component('piano-key-modal-content', ['id' => $id]);

    return json_encode([
      'request' => $_GET,
      'content' => $html
    ]);
  }
  return false;
}


/**
 * Retrieve "sfcompany" posts for the index page.
 */
function api_get_companies() {
  $stages = $_GET['stages'] ?? [];
  $verticals = $_GET['verticals'] ?? [];
  $regions = $_GET['regions'] ?? [];
  $search = $_GET['search'] ?? '';
  $rows = [];

  $args = [
    'post_type' => 'sfcompany',
    'posts_per_page' => 12,
    'paged' => $_GET['page'] ?? false,
    'meta_query' => [
      'relation' => 'AND',
    ],
  ];

  if ($stages) $args['meta_query'][] = [
    'key' => 'stage',
    'value' => $stages,
    'compare' => 'IN',
  ];

  if ($verticals) $args['meta_query'][] = [
    'key' => 'verticals_$',
    'value' => $verticals,
    'compare' => 'IN',
  ];

  if ($regions) $args['meta_query'][] = [
    'key' => 'regions_$',
    'value' => $regions,
    'compare' => 'IN',
  ];

  if ($search) $args['meta_query'][] = [
    'key' => 'name',
    'value' => $search,
    'compare' => 'LIKE',
  ];

  $posts = new WP_Query($args);
  if ($posts->have_posts()) {
    while ($posts->have_posts()) {
      $posts->the_post();
      $post = get_post();
      $logo = get_field('logo', $post->ID);
      $verticals = [];
      foreach (get_field('verticals', $post->ID) as $vertical) {
        $verticals[] = $vertical['vertical'];
      }

      $rows[] = [
        'id' => $post->ID,
        'name' => get_field('name', $post->ID),
        'location' => get_field('location', $post->ID),
        'verticals' => $verticals,
        'stage' => get_field('stage', $post->ID),
        'logo' => $logo ? [
          'url' => $logo['url'],
          'alt' => $logo['alt'],
        ] : null,
      ];
    }
  }

  return json_encode([
    'request' => $_GET,
    'max' => $posts->found_posts,
    'rows' => $rows,
  ]);
}


/**
 * Retrieve "sfuser" posts for the index page.
 */
function api_get_users() {
  $search = $_GET['search'] ?? '';
  $department = $_GET['department'] ?? '';
  $rows = [];

  $args = [
    'post_type' => 'sfuser',
    'posts_per_page' => -1,
    'paged' => $_GET['page'] ?? false,
    'meta_query' => [
      'relation' => 'OR',
    ],
    'tax_query' => [],
  ];

  if ($department) $args['tax_query'][] = [
    'taxonomy' => 'departments',
    'field' => 'term_id',
    'terms' => $department,
  ];

  if ($search) {
    $args['meta_query'][] = [
      'key' => 'full_name',
      'value' => $search,
      'compare' => 'LIKE',
    ];
    $args['meta_query'][] = [
      'key' => 'position',
      'value' => $search,
      'compare' => 'LIKE',
    ];
  }

  $posts = new WP_Query($args);
  if ($posts->have_posts()) {
    while ($posts->have_posts()) {
      $posts->the_post();
      $post = get_post();

      $rows[] = [
        'id' => $post->ID,
        'full_name' => get_field('full_name', $post->ID),
        'position' => get_field('position', $post->ID),
      ];
    }
  }

  return json_encode([
    'request' => $_GET,
    'max' => $posts->found_posts,
    'rows' => $rows,
  ]);
}

function api_get_cookie() {
  $val = $_COOKIE[$_GET['cname']];
  return json_encode([
    'response' => $val,
    'data' => $_GET,
    'cookie' => $_COOKIE
  ]);
}

function api_set_cookie() {
  $expire = time() + 30*24*3600;

  if($_GET['cname'] && $_GET['cval']) {
    setcookie($_GET['cname'], $_GET['cval'], $expire, "/");
    return json_encode([
      'response' => 'success',
      'data' => $_GET,
      'cookie' => $_COOKIE
    ]);
  } else {
    return json_encode([
      'response' => 'failed',
      'data' => $_GET
    ]);
  }
}