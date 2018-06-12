<?php

namespace Drupal\page_content\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigurationEntityForm.
 */
class ConfigurationEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $configuration_entity = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $configuration_entity->label(),
      '#description' => $this->t("Label for the Configuration entity."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $configuration_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\page_content\Entity\ConfigurationEntity::load',
      ],
      '#disabled' => !$configuration_entity->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#maxlength' => 255,
      '#default_value' => $configuration_entity->get('title'),
      '#description' => $this->t("Title for the Configuration entity."),
    ];

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#default_value' => $configuration_entity->get('description'),
      '#description' => $this->t("Description for the Configuration entity."),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $configuration_entity = $this->entity;
    $status = $configuration_entity->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Configuration entity.', [
          '%label' => $configuration_entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Configuration entity.', [
          '%label' => $configuration_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($configuration_entity->toUrl('collection'));
  }

}
