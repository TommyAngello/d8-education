<?php

namespace Drupal\page_content;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Configuration entity entities.
 */
class ConfigurationEntityListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Configuration entity');
    $header['id'] = $this->t('Machine name');
    $header['title'] = $this->t('Title');
    $header['description'] = $this->t('Description');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    $row['title'] = $entity->get('title');
    $row['description'] = $entity->get('description');
    // You probably want a few more properties here...
    return $row + parent::buildRow($entity);
  }

}
