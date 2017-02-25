<?php

namespace Drupal\antiplagiat\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use \ZipArchive;

/**
 * Controller routines for page example routes.
 */
class RobokassaSuccess extends ControllerBase {


  /**
   * Page.
   */
  public function success() {

    $output = [
      'mssg' => [
        '#type' => 'markup',
        '#markup' => 'Ваша работа оплачена. Спасибо!',
      ],
    ];
    return $output;
  }

}
