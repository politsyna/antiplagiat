<?php

namespace Drupal\antiplagiat\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use \ZipArchive;

/**
 * Controller routines for page example routes.
 */
class RobokassaFail extends ControllerBase {

  /**
   * Page.
   */
  public function fail() {

    $output = [
      'mssg' => [
        '#type' => 'markup',
        '#markup' => 'Оплата не удалась. Попробуйте еще раз',
      ],
    ];
    return $output;
  }

}
