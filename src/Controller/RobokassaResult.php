<?php

namespace Drupal\antiplagiat\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller routines for page example routes.
 */
class RobokassaResult extends ControllerBase {

  /**
   * Page.
   */
  public function result() {
    if (isset($_GET['inv_id']) && is_numeric($_GET['inv_id'])) {
      $node = Node::load($_GET['inv_id']);
      $node->field_antiplagiat_status->setValue("ok");
      $node->save(TRUE);
    }
    $message = 'Test';
    $message = print_r($_GET, true);
    \Drupal::logger('RobokassaResult')->notice($message);

    $response = new Response("OK" . $_GET['inv_id'] . "\n");
    $response->headers->set('Content-Type', 'text/plain');
    return $response;
  }

}
