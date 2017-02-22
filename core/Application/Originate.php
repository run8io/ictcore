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

class Originate extends Application
{

  /** @var string */
  public $name = 'originate';

  /**
   * @property-read string $type
   * @var string
   */
  protected $type = 'originate';

  /**
   * This application initial application will start a new transmission
   * @var int weight
   */
  public $weight = Application::ORDER_INIT;

  public function execute()
  {
    if ($this->oTransmission->service_flag == Voice::SERVICE_FLAG) {
      $oService = new Voice();
    } else if ($this->oTransmission->service_flag == Fax::SERVICE_FLAG) {
      $oService = new Fax();
    }
    $template_path = $oService->template_path('originate');
    $oService->application_execute($this, $template_path, 'template');
  }

}