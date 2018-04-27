<?php

/**
 * @file
 * Contains \Drupal\duration_field\Plugin\field\field_type\FieldDurationItem.
 */

namespace Drupal\field_duration\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'field_duration' field type.
 *
 * @FieldType(
 *   id = "field_duration",
 *   label = @Translation("Duration"),
 *   module = "field_duration",
 *   description = @Translation("Demonstrates a field duration."),
 *   default_widget = "field_duration_widget",
 *   default_formatter = "field_duration_formatter"
 * )
 */
class FieldDurationItem extends FieldItemBase implements FieldItemInterface {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'description' => 'The start value.',
          'type' => 'varchar', // not timestamp
          'length' => 20,
        ],
        'value2' => [
          'description' => 'The end value.',
          'type' => 'varchar',
          'length' => 20,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   *
   * @ TODO: Implement propertyDefinitions() method.
   * @ TODO: clarify properties and keys.
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Start value'));

    $properties['value2']   = DataDefinition::create('string')
      ->setLabel(t('End value'));
    return $properties;
  }

}
