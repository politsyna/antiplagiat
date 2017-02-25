<?php

namespace Drupal\antiplagiat\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use \ZipArchive;

/**
 * Controller routines for page example routes.
 */
class PageMain extends ControllerBase {

  /**
   * Page.
   */
  public function page($nid) {

    $node = Node::load($nid);
    $file = $node->field_antiplagiat_zagruzka->entity;
    $path = drupal_realpath($file->uri->value);
    drupal_set_message('Из: ' . $path);
    $put = '/var/www/html/sites/default/files/antiplagiat/' . $nid;

    if (!file_exists($put)) {
      mkdir($put);
    }
    $dest = $put . '/1.zip';
    copy($path, $dest);
    $zip = new ZipArchive();
    if ($zip->open($dest) === TRUE) {
      $zip->extractTo($put . '/unzip');
      $zip->close();
      drupal_set_message('UnZIP OK');
    }
    else {
      drupal_set_message('Не удалось разархивировать', 'errorr');
    }
    // Шаг 1.
    // Этот символ будем вставлять после буквы "а".
    // На шаге 2 будем делать этот символ белым и маленьким.
    $symbol = "ਠ";

    // Наш файл на выходе будет лежать тут.
    $result = $put . '/result.docx';
    // Удаляем существующий файл.
    exec("rm " . $result);
    // Готовим команду, которая сделает архив.
    $command = "cd $put/unzip && zip -r $result *";
    drupal_set_message($command);
    // Запускаем команду создания архива в оболочке линукс.
    exec($command);

    $output = [
      'mssg' => [
        '#type' => 'markup',
        '#markup' => 'R:' . $nid,
      ],
    ];
    return $output;
  }

}
