<?php

/**
 * @file
 * Contains article_entity.page.inc.
 *
 * Page callback for Article entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Article entity templates.
 *
 * Default template: article_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_article_entity(array &$variables) {
  // Fetch ArticleEntity Entity Object.
  $article_entity = $variables['elements']['#article_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
