<?php

namespace Unisharp\AuditTrail\Facades;

use Illuminate\Support\Facades\Facade;

class Audit extends Facade {

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  { 
  	return 'audit'; 
  }

}