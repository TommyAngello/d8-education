<?php
 
/**
 * @file
 * Contains \Drupal\service_example\ServiceExampleController.
 */
 
namespace Drupal\service_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\service_example\ServiceExampleService;
use Symfony\Component\DependencyInjection\ContainerInterface;
 
class ServiceExampleController extends ControllerBase {

  /**
   * @var \Drupal\service_example\ServiceExampleService
   */
  protected $serviceExampleService;

  /**
   * {@inheritdoc}
   */
  public function __construct(ServiceExampleService $serviceExampleService) {
    $this->serviceExampleService = $serviceExampleService;
  }
 
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('service_example.example_service')
    );
  }
 
  public function simple_example() {

    // ! DO NoT DO ThiS !
    $serviceExampleService = \Drupal::service('service_example.example_service');
    $value = $serviceExampleService->getServiceExampleValue();

    return [
      '#markup' => $this->serviceExampleService->getServiceExampleValue()
//      '#markup' => $value
    ];
  }

}