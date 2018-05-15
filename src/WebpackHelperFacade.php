<?php
namespace Oniti\WebpackHelper;

class WebpackHelperFacade extends \Illuminate\Support\Facades\Facade
{
  protected static function getFacadeAccessor()
  {
    return 'WebpackHelper';
  }
}
