<?php namespace OniiChan\Application\Company;

use Illuminate\Foundation\Application;
use OniiChan\Application\Container;

class ApplicationContainer implements Container {

  /**
   * Laravel IoC container
   *
   * @var App
   */
  private $app;

  function __construct(Application $app)
  {
    $this->app = $app;
  }

  public function make($class)
  {
    return $this->app->make($class);
  }
}
