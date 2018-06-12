<?php

namespace Drupal\article_content\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Article entity entities.
 *
 * @ingroup article_content
 */
interface ArticleEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Article entity name.
   *
   * @return string
   *   Name of the Article entity.
   */
  public function getName();

  /**
   * Sets the Article entity name.
   *
   * @param string $name
   *   The Article entity name.
   *
   * @return \Drupal\article_content\Entity\ArticleEntityInterface
   *   The called Article entity entity.
   */
  public function setName($name);

  /**
   * Gets the Article entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Article entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Article entity creation timestamp.
   *
   * @param int $timestamp
   *   The Article entity creation timestamp.
   *
   * @return \Drupal\article_content\Entity\ArticleEntityInterface
   *   The called Article entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Article entity published status indicator.
   *
   * Unpublished Article entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Article entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Article entity.
   *
   * @param bool $published
   *   TRUE to set this Article entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\article_content\Entity\ArticleEntityInterface
   *   The called Article entity entity.
   */
  public function setPublished($published);

}
