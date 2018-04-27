<?php

namespace Drupal\field_duration\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\datetime_range\Plugin\Field\FieldWidget\DateRangeWidgetBase;


/**
 * Plugin implementation of the 'field_duration_widget' widget.
 *
 * @FieldWidget(
 *   id = "field_duration_widget",
 *   module = "field_duration",
 *   label = @Translation("Duration field widget"),
 *   field_types = {
 *     "field_duration"
 *   }
 * )
 */
class FieldDurationWidget extends DateRangeWidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = parent::formElement($items, $delta, $element, $form, $form_state);
    return $element;
  }

}
