<?php

use League\FactoryMuffin\Facade as FactoryMuffin;
use OniiChan\Storage\Exceptions\ModelNotFoundException as ModelNotFoundException;
use OniiChan\Storage\Exceptions\UserNotLoggedInException as UserNotLoggedInException;
use OniiChan\Storage\Exceptions\InsufficientPermissionsException as InsufficientPermissionsException;

class CompanyControllerTest extends TestCase
{

  public function setUp()
  {
    parent::setUp();

    $this->mock_company = $this->mock('OniiChan\Storage\Company\EloquentCompanyRepository');
    $this->mock_listing = $this->mock('OniiChan\Storage\Listing\EloquentListingRepository');
    $this->mock_company->listing = $this->mock_listing;
  }

  public function tearDown()
  {
    Mockery::close();
  }

  public function mock($class)
  {
    $mock = Mockery::mock($class);

    $this->app->instance($class, $mock);

    return $mock;
  }

  public function test_displays_form_to_create_company()
  {
    $this->call('GET', 'companies/create');
    $this->assertResponseOk();
  }

  public function _dummy_listing_and_company($company=NULL, $listing=NULL)
  {
    if ($company === NULL)
      $company = FactoryMuffin::instance('Company');

    if ($listing === NULL)
      $listing = FactoryMuffin::instance('Listing');

    $companyData = array(
      'name' => $company->name,
      'type_id' => $company->type_id,
      'website' => $company->website,
      'endorsements' => $company->endorsements,
      'location' => $company->location,
      'size' => $company->size,
      'founded' => $company->founded
    );

    $listingData = array(
      'interested_in' => $listing->interested_in,
      'interested_in_categories' => $listing->interested_in_categories,
      'experience' => $listing->experience,
      'technologies' => $listing->technologies,
      'career_seekers' => $listing->career_seekers,
      'seeking' => $listing->seeking,
      'tags' => $listing->tags,
      'sections' => $listing->sections
    );

    $postData = $companyData;
    $postData['listing'] = $listingData;

    return [$postData, $companyData, $listingData, $company, $listing];
  }

  public function _create_company($company_validate_ok, $companyData)
  {
    $this->mock_company
      ->shouldReceive('fill')
      ->with($companyData)
      ->once();

    $this->mock_company
      ->shouldReceive('save')
      ->once()
      ->andReturn($company_validate_ok);

    if ( ! $company_validate_ok) {
      $errors = new Illuminate\Support\MessageBag;
      $errors->add('Company Error', 'Testing intended company fail');

      $this->mock_company
        ->shouldReceive('errors')
        ->once()
        ->andReturn($errors);
    }
  }

  public function _update_company($company_find_ok, $company_find_id, $company_validate_ok, $companyData)
  {
    if ($company_find_ok)
    {
      $this->mock_company
        ->shouldReceive('findOrFailForModify')
        ->with($company_find_id)
        ->once()
        ->andReturn($this->mock_company);

      $this->mock_company
        ->shouldReceive('update')
        ->with($companyData)
        ->once();

      $this->mock_company
        ->shouldReceive('save')
        ->once()
        ->andReturn($company_validate_ok);

      if ( ! $company_validate_ok) {
        $errors = new Illuminate\Support\MessageBag;
        $errors->add('Company Error', 'Testing intended company fail');

        $this->mock_company
          ->shouldReceive('errors')
          ->once()
          ->andReturn($errors);
      }
    } else {
      $this->mock_company
        ->shouldReceive('findOrFail')
        ->with($company_find_id)
        ->once()
        ->andThrow(new ModelNotFoundException);
    }
  }

  public function _create_company_and_listing_upon_form_submission()
  {
    list($postData, $companyData, $listingData, $company, $listing) = $this->_dummy_listing_and_company();

    $this->mock_company->listing = $this->mock_listing;

    return [$companyData, $listingData, $postData];
  }

  public function test_fails_create_company_and_listing_upon_form_submission_with_validation_fail()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";
    Sentry::login($user);

    list($companyData, $listingData, $postData) = $this->_create_company_and_listing_upon_form_submission();

    $this->_create_company(false, $postData);

    $this->call('POST', 'companies', $postData);

    $this->assertRedirectedToRoute('companies.create');
    $this->assertSessionHasErrors();
  }

  public function test_creates_company_and_listing_upon_form_submission()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";
    Sentry::login($user);

    list($companyData, $listingData, $postData) = $this->_create_company_and_listing_upon_form_submission();

    $this->_create_company(true, $postData);

    $this->call('POST', 'companies', $postData);

    $this->assertRedirectedToRoute('companies.index');
  }

  public function test_displays_form_to_update_company()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";
    Sentry::login($user);

    $company1 = FactoryMuffin::instance('Company');
    $company1->user = $user;

    $this->mock_company
      ->shouldReceive('findOrFail')
      ->with(1)
      ->andReturn($company1);

    $this->call('GET', 'companies/1/edit');
    $this->assertResponseOk();
  }

  public function test_fails_display_form_to_update_company_if_nonexistent()
  {
    $this->mock_company
      ->shouldReceive('findOrFail')
      ->with(1)
      ->andThrow(new ModelNotFoundException);

    $this->call('GET', 'companies/1/edit');
    $this->assertRedirectedToRoute('companies.index');
    $this->assertSessionHasErrors();
  }

  public function test_updates_company_and_listing_upon_form_submission()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";
    Sentry::login($user);

    list($companyData, $listingData, $postData) = $this->_create_company_and_listing_upon_form_submission();

    $this->mock_company->user = $user;

    $this->_update_company(true, 1, true, $postData);

    $this->call('PUT', 'companies/1', $postData);
    $this->assertRedirectedToRoute('companies.show', 1);
  }

  public function test_fails_update_a_company_and_listing_if_nonexistent()
  {
    list($companyData, $listingData, $postData) = $this->_create_company_and_listing_upon_form_submission();

    $this->_update_company(false, 1, true, $companyData);

    $this->call('PUT', 'companies/1', $postData);
    $this->assertRedirectedToRoute('companies.index');
    $this->assertSessionHasErrors();
  }

  public function test_fails_update_company_and_listing_upon_form_submission_with_company_fail()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";
    Sentry::login($user);

    list($companyData, $listingData, $postData) = $this->_create_company_and_listing_upon_form_submission();

    $this->mock_company->user = $user;
    $this->_update_company(true, 1, false, $postData);

    $this->call('PUT', 'companies/1', $postData);
    $this->assertRedirectedToRoute('companies.edit', 1);
    $this->assertSessionHasErrors();
  }

  public function test_deletes_company_and_listing_upon_form_submission()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";
    Sentry::login($user);

    $this->mock_company
      ->shouldReceive('save')
      ->once();

    $this->mock_company
      ->shouldReceive('findOrFail')
      ->with(1)
      ->andReturn($this->mock_company);

    $this->call('DELETE', 'companies/1');

    $this->assertRedirectedToRoute('companies.index', [], ['flash']);
  }

  public function test_fails_delete_a_company_and_listing_if_nonexistent()
  {
    $this->mock_company
      ->shouldReceive('findOrFail')
      ->with(1)
      ->andThrow(new ModelNotFoundException);

    $this->call('DELETE', 'companies/1');

    $this->assertRedirectedToRoute('companies.index');
    $this->assertSessionHasErrors();
  }

  public function test_index_shows_companies_and_listings()
  {
    /* FIXME: I'm not really sure how best to do this, but it seems unreasonable
     * (for a functional test) that
     *  a) the View Facade should need to be mocked (even Taylor and Jeffrey say so!)
     *  b) views should be written only to ever expect an array from the controller
     *  c) the Collection object should be wrapped a la repositories (along with
     *     all other possible related classes of model?)
     * So I guess I should just have a Collection at the ready?
     */
    $collection = new \Illuminate\Database\Eloquent\Collection;
    for ($i = 0 ; $i < 3 ; $i++)
    {
      $company = FactoryMuffin::instance('Company');
      $listing = FactoryMuffin::instance('Listing');
      $company->listing = $listing;
      $collection->add($company);
    }

    $this->mock_company
      ->shouldReceive('all')
      ->andReturn($collection);

    $this->call('GET', 'companies');

    $this->assertResponseOk();
  }

  public function _display_company($company_find_ok)
  {
    $call = $this->mock_company
      ->shouldReceive('findOrFail')
      ->with(1)
      ->once();

    if ( ! $company_find_ok) {
      $call->andThrow(new ModelNotFoundException);
    } else {
      $call->andReturn($this->mock_company);
    }
  }

  public function test_shows_a_company_and_listing()
  {
    $this->_display_company(true);

    $this->call('GET', 'companies/1');

    $this->assertResponseOk();
  }

  public function test_fails_show_a_company_and_listing_if_nonexistent()
  {
    $this->_display_company(false);

    $this->call('GET', 'companies/1');

    $this->assertRedirectedToRoute('companies.index');
    $this->assertSessionHasErrors();
  }

  public function test_fails_show_update_company_and_listing_form_with_insufficient_permissions()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";

    $this->mock_company
      ->shouldReceive('findOrFailForModify')
      ->with(1)
      ->andThrow(new InsufficientPermissionsException);

    $this->call('GET', 'companies/1/edit');
    $this->assertRedirectedToRoute('companies.show', 1);
    $this->assertSessionHasErrors();
  }

  public function test_fails_create_company_and_listing_with_insufficient_permissions()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";

    list($companyData, $listingData, $postData) = $this->_create_company_and_listing_upon_form_submission();

    $this->mock_company
      ->shouldReceive('fill')
      ->with($postData);

    $this->mock_company
      ->shouldReceive('save');

    $this->mock_company
      ->shouldReceive('errors')
      ->once()
      ->andReturn(['Company Error' => 'Testing intended company fail']);

    $this->call('POST', 'companies', $postData);

    $this->assertRedirectedToRoute('companies.create');
    $this->assertSessionHasErrors();
  }

  public function test_fails_update_company_and_listing_with_insufficient_permissions()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";
    list($companyData, $listingData, $postData) = $this->_create_company_and_listing_upon_form_submission();

    $this->mock_company->user = $user;

    $this->mock_company
      ->shouldReceive('findOrFailForModify')
      ->with(1)
      ->andThrow(new InsufficientPermissionsException);

    $this->call('PUT', 'companies/1', $postData);
    $this->assertRedirectedToRoute('companies.show', 1);
    $this->assertSessionHasErrors();
  }

  public function test_fails_delete_company_and_listing_with_insufficient_permissions()
  {
    $this->mock_company
      ->shouldReceive('findOrFailForModify')
      ->with(1)
      ->andThrow(new InsufficientPermissionsException);

    $this->call('DELETE', 'companies/1');

    $this->assertRedirectedToRoute('companies.show', 1);
    $this->assertSessionHasErrors();
  }

  public function test_fails_show_update_company_and_listing_form_with_no_login()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";

    $this->mock_company
      ->shouldReceive('findOrFailForModify')
      ->with(1)
      ->andThrow(new UserNotLoggedInException);

    $this->call('GET', 'companies/1/edit');
    $this->assertRedirectedToRoute('companies.show', 1);
    $this->assertSessionHasErrors();
  }

  public function test_fails_create_company_and_listing_with_no_login()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";

    list($companyData, $listingData, $postData) = $this->_create_company_and_listing_upon_form_submission();

    $this->mock_company
      ->shouldReceive('fill')
      ->with($postData);

    $this->mock_company
      ->shouldReceive('save')
      ->andThrow(new UserNotLoggedInException);

    $this->call('POST', 'companies', $postData);

    $this->assertRedirectedToRoute('companies.create');
    $this->assertSessionHasErrors();
  }

  public function test_fails_update_company_and_listing_with_no_login()
  {
    $user = FactoryMuffin::instance('User');
    $user->email = "admin@flaxandteal.co.uk";
    list($companyData, $listingData, $postData) = $this->_create_company_and_listing_upon_form_submission();

    $this->mock_company->user = $user;

    $this->mock_company
      ->shouldReceive('findOrFailForModify')
      ->with(1)
      ->andThrow(new UserNotLoggedInException);

    $this->call('PUT', 'companies/1', $postData);
    $this->assertRedirectedToRoute('companies.show', 1);
    $this->assertSessionHasErrors();
  }

  public function test_fails_delete_company_and_listing_with_no_login()
  {
    $this->mock_company
      ->shouldReceive('findOrFailForModify')
      ->with(1)
      ->andThrow(new UserNotLoggedInException);

    $this->call('DELETE', 'companies/1');

    $this->assertRedirectedToRoute('companies.show', 1);
    $this->assertSessionHasErrors();
  }

}
