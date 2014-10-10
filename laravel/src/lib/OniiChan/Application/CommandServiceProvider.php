<?php namespace OniiChan\Application;

use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider {

  /**
   * Register our binding
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind(
      'OniiChan\Application\Container',
      'OniiChan\Application\ApplicationContainer'
    );
  }

}

