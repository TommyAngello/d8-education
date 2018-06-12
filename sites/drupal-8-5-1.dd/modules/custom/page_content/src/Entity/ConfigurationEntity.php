<?php

namespace Drupal\page_content\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Configuration entity entity.
 *
 * @ConfigEntityType(
 *   id = "configuration_entity",
 *   label = @Translation("Configuration entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\page_content\ConfigurationEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\page_content\Form\ConfigurationEntityForm",
 *       "edit" = "Drupal\page_content\Form\ConfigurationEntityForm",
 *       "delete" = "Drupal\page_content\Form\ConfigurationEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\page_content\ConfigurationEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "configuration_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/configuration_entity/{configuration_entity}",
 *     "add-form" = "/admin/structure/configuration_entity/add",
 *     "edit-form" = "/admin/structure/configuration_entity/{configuration_entity}/edit",
 *     "delete-form" = "/admin/structure/configuration_entity/{configuration_entity}/delete",
 *     "collection" = "/admin/structure/configuration_entity"
 *   }
 * )
 */
class ConfigurationEntity extends ConfigEntityBase implements ConfigurationEntityInterface {

  /**
   * The Configuration entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Configuration entity label.
   *
   * @var string
   */
  protected $label;

  /**
   * The Configuration entity title.
   *
   * @var string
   */
  protected $title;

  /**
   * The Configuration entity description.
   *
   * @var text
   */
  protected $description;

}
