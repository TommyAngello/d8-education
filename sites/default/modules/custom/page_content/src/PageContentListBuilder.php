<?php

namespace Drupal\page_content;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Page content entities.
 *
 * @ingroup page_content
 */
class PageContentListBuilder extends EntityListBuilder {

  /**
   * @override default method getEntityIds() in EntityListBuilder.php
   *
   * Loads entity IDs using a pager sorted by the entity id.
   *
   * @return array
   *   An array of entity IDs.
   */
  protected function getEntityIds() {
    $query = $this->getStorage()->getQuery()
      ->sort($this->entityType->getKey('id'));

    // Only add the pager if a limit is specified.
    if ($this->limit) {
      $query->pager($this->limit);
    }

    // My modify.
    // Display only current language entites.
    if ($this->moduleHandler->moduleExists('content_translation')) {
      $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
      $query->condition('langcode', $langcode);
    }

    return $query->execute();
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Page content ID');
    $header['name'] = $this->t('Name');
    $header['language'] = $this->t('Language');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\page_content\Entity\PageContent */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.page_content.edit_form',
      ['page_content' => $entity->id()]
    );
    $row['language'] = $entity->language()->getName();
    return $row + parent::buildRow($entity);
  }

}
