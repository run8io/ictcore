<?php

namespace ICT\Core\Application;

/* * ***************************************************************
 * Copyright © 2015 ICT Innovations Pakistan All Rights Reserved   *
 * Developed By: Nasir Iqbal                                       *
 * Website : http://www.ictinnovations.com/                        *
 * Mail : nasir@ictinnovations.com                                 *
 * *************************************************************** */

use ICT\Core\Application;
use ICT\Core\Service\Fax;
use ICT\Core\Service\Voice;
use ICT\Core\Spool;

class Disconnect extends Application
{

  /** @var string */
  public $name = 'disconnect';

  /**
   * @property-read string $type
   * @var string
   */
  protected $type = 'disconnect';

  /**
   * ******************************************** Default Application Values **
   */

  /**
   * default condition
   * @var array 
   */
  public static $defaultCondition = array('result' => 'success');

  /**
   * All possible results to use 
   * normally this application has no result, so only success
   * @var array 
   */
  public static $supportedResult = array(
      'result' => array('success')
  );

  public function execute()
  {
    if ($this->oTransmission->service_flag == Voice::SERVICE_FLAG) {
      $oService = new Voice();
    } else if ($this->oTransmission->service_flag == Fax::SERVICE_FLAG) {
      $oService = new Fax();
    }

    $template_path = $oService->template_path('disconnect');
    $oService->application_execute($this, $template_path, 'template');
  }

  public function process()
  {
    // TODO call duration, call response
    // no need to check result, in either case disconnect mean success
    return Spool::STATUS_DONE;
  }

}