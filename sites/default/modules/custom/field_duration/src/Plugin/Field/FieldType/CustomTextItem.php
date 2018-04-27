<?php

namespace Drupal\field_duration\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'field_custom_text' field type.
 *
 * @FieldType(
 *   id = "field_custom_text",
 *   label = @Translation("CustomText Example"),
 *   module = "field_duration",
 *   description = @Translation("Demonstrates a field custom text."),
 *   default_widget = "field_custom_text_widget",
 *   default_formatter = "field_custom_text_formatter"
 * )
 */
class CustomTextItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'description' => 'The value.',
          'type' => 'varchar',
          'length' => 20,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Custom text value'));
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }
}