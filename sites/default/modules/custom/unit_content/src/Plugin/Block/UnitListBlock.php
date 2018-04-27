<?php

namespace Drupal\unit_content\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\page_content\PageContentStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Annotation.
 *
 * Provides 'Unit Content Block' block.
 *
 * @Block(
 *   id = "unit_list",
 *   admin_label = @Translation("Unit Content: Unit Entity List")
 * )
 *
 * @todo: use ContainerFactoryPluginInterface for DI in Plugins.
 * @see Drupal\migrate_drupal\Plugin\migrate\destination\EntityFieldStorageConfig.php
 */
class UnitListBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity page_content.
   *
   * @var \Drupal\page_content\PageContentStorageInterface
   */
  protected $pageContentStorage;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, PageContentStorageInterface $pageContentStorage) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->pageContentStorage = $pageContentStorage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity.manager')->getStorage('page_content')
    );
  }

  /**
   * @return header array.
   */
  protected function getHeader() {
    return ['id', 'title', 'color'];
  }

  /**
   * Build rows for table.
   *
   *  @return array
   */
  protected function getRows() {
    $rows = [];
    $color = '';

    // LanguageManager can be move into __construct().
    $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();

    $entities = $this->pageContentStorage->loadByProperties(['status' => NODE_PUBLISHED, 'langcode' => $langcode]);

    foreach ($entities as $entity) {
      if ($entity->hasField('definition')) {
        $nodes = $entity->get('definition')->referencedEntities();
      }

      if (!empty($nodes)) {
        $node = array_shift($nodes);
      }

      if (!empty($node) && $node->hasField('field_color') && !$node->get('field_color')->isEmpty()) {
        $color = $node->get('field_color')->getValue()[0]['value'];
      }

      $rows[] = [
        'data' => [$entity->id(), $entity->label(), $color],
        'id' => 'custom-row-' . $entity->id()
      ];
    }

    return $rows;
  }

  /**
   * Render results.
   *
   * @return array
   * @todo: see return \Drupal::entityTypeManager()->getListBuilder('page_content')->render();
   */
  public function build() {

    // Build render array.
    $build = [
      '#type' => 'table',
      '#header' => $this->getHeader(),
      '#rows' => $this->getRows(),
      '#attached' => [
        'library' => [
          'unit_content/unit_content.colors'
        ],
      ]
    ];

    // Additionally add settings about each row is js: { id : color }.
    $rows = $this->getRows();
    foreach($this->getRows() as $row) {
      $build['#attached']['drupalSettings']['unit_content']['color'][$row['id']] = $row['data'][2];
    }
    return $build;
  }

}
