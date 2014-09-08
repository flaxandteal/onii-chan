<?php namespace OniiChan\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind(
      'OniiChan\Storage\Company\CompanyRepositoryInterface',
      'OniiChan\Storage\Company\EloquentCompanyRepository'
    );

    $this->app->bind(
      'OniiChan\Storage\Listing\ListingRepositoryInterface',
      'OniiChan\Storage\Listing\EloquentListingRepository'
    );
  }

}
