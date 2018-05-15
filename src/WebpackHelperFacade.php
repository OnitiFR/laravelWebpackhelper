<?php
namespace Oniti\WebPackHelper;

class WebpackHelperFacade extends \Illuminate\Support\Facades\Facade
{
  protected static function getFacadeAccessor()
  {
    return 'WebpackHelper';
  }
}
