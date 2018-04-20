<?php

namespace Drupal\article_content;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Article entity entity.
 *
 * @see \Drupal\article_content\Entity\ArticleEntity.
 */
class ArticleEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\article_content\Entity\ArticleEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished article entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published article entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit article entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete article entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add article entity entities');
  }

}
