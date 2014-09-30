<?php namespace OniiChan\Infrastructure\Services;

use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider {

  /**
   * Register our binding
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind(
      'OniiChan\Domain\Model\Company\CompanyRepository',
      'OniiChan\Infrastructure\Repositories\CompanyDoctrineORMRepository'
    );
  }

}
