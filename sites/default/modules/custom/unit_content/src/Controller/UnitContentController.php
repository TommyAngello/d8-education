<?php

namespace Drupal\unit_content\Controller;

use Drupal\Core\Controller\ControllerBase;

class UnitContentController extends ControllerBase {

  public function simple() {
    return [
      '#markup' => '<p>Here is our description: </p>
        <p>1. Add text field in referenced node (in our case article) with name color.
        Create some article fill new color field. 
        Create some custom entities and bind some article nodes with filled color field. </p>
        <p>2. Create your custom block that will list created custom entities in previous step. 
        Block should contain javascript that will color up listed custom entity titles 
        in color according to settings in article color field. </p>',
    ];
  }

}
