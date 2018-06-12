<?php

namespace Drupal\page_content\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Page content entities.
 */
class PageContentViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
