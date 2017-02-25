<?php

namespace Drupal\antiplagiat\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Drupal\node\Entity\Node;

/**
 * Controller routines for page example routes.
 */
class PageMain extends ControllerBase {

  /**
   * Page.
   */
  public function page($nid) {

    $node = Node::load($nid);
    //dsm($node);
    //dsm($node->title->value);
    //dsm($node->field_antiplagiat_name->value);
    $file_id = $node->field_antiplagiat_zagruzka->entity->id();
    $file = File::load($file_id);
    dsm($file);
    dsm($file->uri->value);
    $path = drupal_realpath($file->uri->value);
    dsm($path);

    $output = [
      'mssg' => [
        '#type' => 'markup',
        '#markup' => 'R:' . $nid,
      ],
    ];

    return $output;
  }

}
