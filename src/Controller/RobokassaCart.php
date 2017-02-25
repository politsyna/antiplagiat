<?php

namespace Drupal\antiplagiat\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use \ZipArchive;

/**
 * Controller routines for page example routes.
 */
class RobokassaCart extends ControllerBase {

  /**
   * Page.
   */
  public function cart($id, $nid) {

    // your registration data
    $mrh_login = "v.politsyna";      // your login here
    $mrh_pass1 = "Pz1st1G146hGCFeWcVRk";   // merchant pass1 here

    // order properties
    $inv_id    = $nid;        // shop's invoice number
                           // (unique for shop's lifetime)
    $inv_desc  = "оплата за antiplagiat:" . $nid;   // invoice desc
    $out_summ  = "100";   // invoice summ
    $node = Node::load($nid);
    $email = $node->field_antiplagiat_email->value;
    $node->field_antiplagiat_status->setValue("fail");
    $node->save(TRUE);
    // build CRC value
    $crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

    // build URL
    $url = "https://auth.robokassa.ru/Merchant/Index.aspx?MrchLogin=$mrh_login&".
        "OutSum=$out_summ&InvId=$inv_id&Desc=$inv_desc&Email=$email&SignatureValue=$crc";
    if (TRUE){
      $url .= '&IsTest=1';
    }

    $output = [
      'mssg' => [
        '#type' => 'markup',
        '#markup' => ' Номер заказа: ' . $nid . '<br />' . ' Сумма для оплаты: ' . $out_summ . '<br />',
      ],
      'cart' => [
        '#type' => 'markup',
        '#markup' => '<a href="' . $url . '">Нажмите для оплаты</a>',
      ],
    ];
    return $output;
  }

}
