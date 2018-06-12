<?php

namespace Drupal\page_content\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Page content entities.
 *
 * @ingroup page_content
 */
interface PageContentInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Page content name.
   *
   * @return string
   *   Name of the Page content.
   */
  public function getName();

  /**
   * Sets the Page content name.
   *
   * @param string $name
   *   The Page content name.
   *
   * @return \Drupal\page_content\Entity\PageContentInterface
   *   The called Page content entity.
   */
  public function setName($name);

  /**
   * Gets the Page content creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Page content.
   */
  public function getCreatedTime();

  /**
   * Sets the Page content creation timestamp.
   *
   * @param int $timestamp
   *   The Page content creation timestamp.
   *
   * @return \Drupal\page_content\Entity\PageContentInterface
   *   The called Page content entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Page content published status indicator.
   *
   * Unpublished Page content are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Page content is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Page content.
   *
   * @param bool $published
   *   TRUE to set this Page content to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\page_content\Entity\PageContentInterface
   *   The called Page content entity.
   */
  public function setPublished($published);

  /**
   * Gets the Page content revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Page content revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\page_content\Entity\PageContentInterface
   *   The called Page content entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Page content revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Page content revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\page_content\Entity\PageContentInterface
   *   The called Page content entity.
   */
  public function setRevisionUserId($uid);

}
