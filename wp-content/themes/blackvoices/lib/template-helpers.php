<?php
/**
 * Pagination starter code.
 */

/***
* Get the primary category set with yoast (Yoast SEO plugin must be active or it will return false)
* @param $post_id: str|int -- the post ID
*@param $taxonomy: str -- slug of the taxonomy you want (default is category)
*/
function yoast_get_primary_category($post_id, $taxonomy = 'category') {
  $primary_cat_id = get_post_meta($post_id,'_yoast_wpseo_primary_' . $taxonomy, true);

  if($primary_cat_id){
    return get_term($primary_cat_id, $taxonomy);
  }
  return false;
}

function pagination_helper () {
  global $wp_query;
  if ( $wp_query->max_num_pages <= 1 ) return;
  ?>
  <nav class="pagination-links"><?php
    $bignum = 999999999; // need an unlikely integer
    echo paginate_links( array(
      'base'       => str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) ),
      'format'     => '?paged=%#%', //or ''
      'current' => max( 1, get_query_var('paged') ),
      // 'current'    => max( 1, $paged ),
      'total'      => $wp_query->max_num_pages,
      'mid_size'   => 3,
      'end_size'   => 3,
      'type'       => 'plain', //or list
      'prev_text'  => '&larr;',
      'next_text'  => '&rarr;'
    ) );
    ?>
  </nav><?php
}

function currentURL() {
  return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] : 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}

function string_to_html_ID($str) {
  // preg_replace('/[?\/\|.|!]?/', '', $str)
  $str = preg_replace('/[?\/\|.|!]?/', '', $str);
  return trim(str_replace(' ', '_', str_replace('-', '_', strtolower($str))));
}

function jkb_esc_url($string) {
  return htmlspecialchars(rawurlencode(html_entity_decode(wp_strip_all_tags($string, ENT_COMPAT, 'UTF-8'))));
}

function ccdb_get_terms( $taxonomies, $args = [] ){
  //Parse $args in case its a query string.
  $args = wp_parse_args($args);

  if($args['post_type']) {
    $args['post_type'] = (array) $args['post_type'];
    add_filter( 'terms_clauses','ccdb_filter_terms_by_cpt',10,3);

    function ccdb_filter_terms_by_cpt( $pieces, $tax, $args){
      global $wpdb;

      // Don't use db count
      $pieces['fields'] .=", COUNT(*) " ;

      //Join extra tables to restrict by post type.
      $pieces['join'] .=" INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id 
                          INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id ";

      // Restrict by post type and Group by term_id for COUNTing.
      $post_type_str = implode(',',$args['post_type']);
      $pieces['where'].= $wpdb->prepare(" AND p.post_type IN(%s) GROUP BY t.term_id", $post_type_str);

      remove_filter( current_filter(), __FUNCTION__ );
      return $pieces;
    }
  } // endif post_type set

  return get_terms($taxonomies, $args);           
}

// check if a category or taxonomy term has a parent
function term_has_parent($id, $taxonomy = null) {
  $term = $taxonomy ? get_term($id, $taxonomy) : get_the_category($id);
  if($taxonomy) {
    print_r($term);
    return $term->parent > 0 ? true : false;
  } else {
    return $term->category_parent > 0 ? true : false;
  }
}