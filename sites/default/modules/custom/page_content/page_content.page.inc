<?php

/**
 * @file
 * Contains page_content.page.inc.
 *
 * Page callback for Page content entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Page content templates.
 *
 * Default template: page_content.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_page_content(array &$variables) {
  // Fetch PageContent Entity Object.
  $page_content = $variables['elements']['#page_content'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
