<?php

/**
 * @file
 * Contains \Drupal\field_example\Controller\FieldExampleDefaultController.
 */

namespace Drupal\field_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\Query\QueryFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller routines for field example routes.
 */
class FieldExampleDefaultController extends ControllerBase {

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entity_type;

  /**
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  protected $query_factory;

  /**
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type
   * @param \Drupal\Core\Entity\Query\QueryFactory $query_factory
   */
  public function __construct(EntityTypeManagerInterface $entity_type, QueryFactory $query_factory) {
    $this->entity_type = $entity_type;
    $this->query_factory = $query_factory;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager'),
      $container->get('entity.query')
    );
  }

  /**
   * Provides a render array containing a single node's body field.
   *
   * @return array
   */
  public function simple() {
    /**
     * @var $query \Drupal\Core\Entity\Query\QueryInterface
     */
    $query = $this->query_factory->get('node');

    // Retrieve an array of entity ids.
    $nids = $query->execute();

    // If there are no nodes, we exit.
    if (count($nids) < 1) {
      return ['#markup' => $this->t('No nodes found.')];
    }

    /**
     * @var $entity_storage \Drupal\Core\Entity\EntityStorageInterface
     */
    $entity_storage = $this->entity_type->getStorage('node');

    /**
     * @var $entity \Drupal\Core\Entity\ContentEntityInterface
     */
     $entity = $entity_storage->load(array_values($nids)[0]);
    // We will get the values from here.

    /**
     * @var $body_field \Drupal\Core\Field\FieldItemList
     */
    $body_field = $entity->get('body');

    // If we want a value off the first item, we can use a magic method __get()
    // Which is sometimes easier to use.
    $simple_value = $body_field->value;

    // We get an array of items for this field.
    // Unlike Drupal 7, there are no language keys.
    $field_value = $body_field->getValue();

    // We will set the summary to the value.
    // We don't need to update the entity because the field setValue does that already.
    $body_field->summary = $body_field->value;

    // or
    $field_value[0]['summary'] = $field_value[0]['value'];
    $body_field->setValue($field_value);

    /**
     * @var $definition \Drupal\Core\Field\BaseFieldDefinition
     */
    $definition = $body_field->getFieldDefinition();

    $field_type = $definition->get('field_type');

    //        return [
    //          '#markup' => 'placeholder',
    //        ];

    return [
      'field_type' => [
        '#markup' => 'Field Type: ' . $field_type,
        '#theme_wrappers' => ['container'],
      ],
      'field_value' => [
        '#markup' => 'Field Value: ' . $simple_value,
        '#theme_wrappers' => ['container'],
      ],
    ];
  }
}