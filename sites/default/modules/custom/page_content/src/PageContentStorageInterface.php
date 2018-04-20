<?php

namespace Drupal\page_content;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface PageContentStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Page content revision IDs for a specific Page content.
   *
   * @param \Drupal\page_content\Entity\PageContentInterface $entity
   *   The Page content entity.
   *
   * @return int[]
   *   Page content revision IDs (in ascending order).
   */
  public function revisionIds(PageContentInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Page content author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Page content revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\page_content\Entity\PageContentInterface $entity
   *   The Page content entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(PageContentInterface $entity);

  /**
   * Unsets the language for all Page content with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
