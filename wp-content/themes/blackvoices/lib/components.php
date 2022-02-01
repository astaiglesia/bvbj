<?php
////////////////////////////////////////////////////////////////////
// Component Functions:
////////////////////////////////////////////////////////////////////

// Returns a maximum number of words from a string with an ellipsis if the limit has been hit
function limit_text($text, $limit = 35) {
  if (str_word_count($text, 0) > $limit) {
      $words = str_word_count($text, 2);
      $pos = array_keys($words);
      $text = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}

/**
 * Load a component into a template while supplying data.
 *
 * @param string $slug The slug name for the generic template.
 * @param array $params An associated array of data that will be extracted into the templates scope
 * @param bool $output Whether to output component or return as string.
 * @return string
 */

function get_component($slug, array $params = array()) {
  ob_start();
  if ($template_file = locate_template("components/{$slug}.php", false, false)) {
    extract($params, EXTR_SKIP);
    require($template_file);
    return ob_get_clean();
  }

  return false;
}