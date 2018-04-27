<?php

namespace Drupal\field_duration\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

use Drupal\datetime\Plugin\Field\FieldFormatter\DateTimePlainFormatter;
use Drupal\datetime_range\DateTimeRangeTrait;
//use Drupal\datetime\Plugin\Field\FieldType\DateTimeFormatterBase;

/**
 * Plugin implementation of the 'field_duration_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "field_duration_formatter",
 *   module = "field_duration",
 *   label = @Translation("Duration field formatter"),
 *   field_types = {
 *     "field_duration"
 *   }
 * )
 */
class FieldDurationFormatter extends DateTimePlainFormatter {

  use DateTimeRangeTrait;

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
//        'value' => $item->value,
        'separator' => ['#plain_text' => ' - '],
//        'value2' => $item->value2,
      ];
    }
    return $elements;
  }

}
