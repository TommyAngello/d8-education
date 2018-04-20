<?php
 
/**
 * @file
 *
 * Contains \Drupal\Tests\test_example\Unit\TestExampleConversionsTest.
 */
 
namespace Drupal\Tests\test_example\Unit;
 
use Drupal\Tests\UnitTestCase;
 
/**
 * Demonstrates how to write tests.
 *
 * @group test_example
 */
class TestExampleConversionsTest extends UnitTestCase {
 
  /**
   * @var \Drupal\test_example\TestExampleConversions
   */
  public $conversionService;
 
  public function setUp() {
    $this->conversionService = new \Drupal\test_example\TestExampleConversions();
  }
 
  /**
   * A simple test that tests our celsiusToFahrenheit() function.
   */
  public function testOneConversion() {
    // Confirm that 0C = 32F.
    $this->assertEquals(32, $this->conversionService->celsiusToFahrenheit(0), 'Compare CelsiusToFahrenheit');
  }

}