<?php

namespace Drupal\page_content;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Page content entity.
 *
 * @see \Drupal\page_content\Entity\PageContent.
 */
class PageContentAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\page_content\Entity\PageContentInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished page content entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published page content entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit page content entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete page content entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add page content entities');
  }

}
