<?php

namespace Drupal\page_content;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\page_content\Entity\PageContentInterface;

/**
 * Defines the storage handler class for Page content entities.
 *
 * This extends the base storage class, adding required special handling for
 * Page content entities.
 *
 * @ingroup page_content
 */
class PageContentStorage extends SqlContentEntityStorage implements PageContentStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(PageContentInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {page_content_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {page_content_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(PageContentInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {page_content_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('page_content_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

  public function doLoadMultiple(array $ids = NULL) {
    return parent::doLoadMultiple($ids);
  }

}
