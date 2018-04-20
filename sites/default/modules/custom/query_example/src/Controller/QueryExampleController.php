<?php
/**
 * @file
 * Contains \Drupal\query_example\Controller\QueryExampleController.
 */
 
namespace Drupal\query_example\Controller;
 
use Drupal\Core\Entity\Query\QueryFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
 
/**
 * Controller routines for page example routes.
 */
class QueryExampleController extends ControllerBase {
 
  protected $entity_query;
 
  public function __construct(QueryFactory $entity_query) {
    $this->entity_query = $entity_query;
  }
 
  public static function create(ContainerInterface $container) {
    return new static(
     $container->get('entity.query')
    );
  }
 
  protected function simpleQuery() {
    $query = $this->entity_query->get('node')
      ->condition('status', 1);
    $nids = $query->execute();
    return array_values($nids);
  }
 
  public function basicQuery() {

//    $ids = $this->simpleQuery();
//    dsm($ids);
//    $node = entity_load('node', $ids[0]);
//    $node = \Drupal\node\Entity\Node::load($ids[0]);
//    dsm($node);
//    $nodes = entity_load_multiple('node', $ids);
//    dsm($nodes);
//    $nodes = \Drupal\node\Entity\Node::loadMultiple($ids);
//    dsm($nodes);

    return [
      '#title' => 'Published Nodes',
      'content' => [
        '#theme' => 'item_list',
        '#items' => $this->simpleQuery()
      ]
    ];
  }
 
  protected function intermediateQuery() {
    $query = $this->entity_query->get('node')
      ->condition('status', 1)
      ->condition('changed', REQUEST_TIME, '<')
      ->condition('title', 'ipsum lorem', 'CONTAINS')
      ->condition('field_tags.entity.name', 'test');
    $nids = $query->execute();
    return array_values($nids);
  }
 
  public function conditionalQuery() {
    return [
      '#title' => 'Published Nodes Called "ipsum lorem" That Have a Tag "test"',
      'content' => [
        '#theme' => 'item_list',
        '#items' => $this->intermediateQuery()
      ]
    ];
  }
 
  protected function advancedQuery() {
    $query = $this->entity_query->get('node')
      ->condition('status', 1)
      ->condition('changed', REQUEST_TIME, '<');
    $group = $query->orConditionGroup()
      ->condition('title', 'ipsum lorem', 'CONTAINS')
      ->condition('field_tags.entity.name', 'test');
    $nids = $query->condition($group)->execute();
    return array_values($nids);
  }
 
  public function conditionalGroupQuery() {
    return [
      '#title' => 'Published Nodes That Are Called "ipsum lorem" Or Have a Tag "test"',
      'content' => [
        '#theme' => 'item_list',
        '#items' => $this->advancedQuery()
      ]
    ];
  }
 
}