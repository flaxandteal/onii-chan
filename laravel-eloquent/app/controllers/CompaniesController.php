<?php
//RMV: USEFUL LINK : http://stackoverflow.com/questions/23972017/ardent-laravel-auto-hydrate-relation

use OniiChan\Storage\Company\CompanyRepositoryInterface as Company;
use OniiChan\Storage\Listing\ListingRepositoryInterface as Listing;

use OniiChan\Storage\Exceptions\ModelNotFoundException as ModelNotFoundException;
use OniiChan\Storage\Exceptions\UserNotLoggedInException as UserNotLoggedInException;
use OniiChan\Storage\Exceptions\InsufficientPermissionsException as InsufficientPermissionsException;

class CompaniesController extends BaseController {

  /**
   * Company Repository
   *
   * @var Company
   */
  protected $company;

  public function __construct(Company $company)
  {
    $this->company = $company;
    $this->beforeFilter('sentry-auth', array('only' => array('create', 'store', 'update', 'destroy', 'edit')));
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $companies = $this->company->all();

    return View::make('companies.index', compact('companies'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return View::make('companies.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $company = $this->company;
    $input = Input::except('_method');
    $company->fill($input);

    try
    {
      if ($this->company->save($company))
      {
        return Redirect::route('companies.index');
      }
    }
    catch (UserNotLoggedInException $e)
    {
      return Redirect::route('companies.create')
        ->withInput()
        ->withErrors(array('message', 'You do not appear to be logged in.'));
    }

    return Redirect::route('companies.create')
      ->withInput()
      ->withErrors($company->errors())
      ->with('message', 'There were validation errors.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    try {

      $company = $this->company->findOrFail($id);

    } catch (ModelNotFoundException $e) {
      $errors = array('Company Error' => 'Requested company not found');

      return Redirect::route('companies.index')
              ->withErrors($errors)
              ->with('message', 'This company not found');
    }

    return View::make('companies.show', compact('company', 'listing'));
  }

  /**
   * Helper function to handle exceptions in find or fail for modify actions
   *
   * @param init $id
   * @return error or Company if found
   */
  public function _findForModify($id)
  {
    try {

      $company = $this->company->findOrFailForModify($id);

    }
    catch (ModelNotFoundException $e)
    {
      return [NULL, Redirect::route('companies.index')
              ->withErrors(array('Company Error' => 'Requested company not found'))];
    }
    catch (UserNotLoggedInException $e)
    {
      return [NULL, Redirect::route('companies.show', $id)
              ->withErrors(array('Company Error' => 'You need to be logged in to perform this action, but do not seem to be.'))];
    }
    catch (InsufficientPermissionsException $e)
    {
      return [NULL, Redirect::route('companies.show', $id)
              ->withErrors(array('Company Error' => 'This does not seem to be your company and you do not have overriding admin privileges.'))];
    }

    return [$company, NULL];
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    list($company, $error_response) = $this->_findForModify($id);

    if ($company !== NULL)
    {
      return View::make('companies.edit', compact('company'));
    }

    return $error_response;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $input = Input::except('_method');

    list($company, $error_response) = $this->_findForModify($id);

    if ($company !== NULL)
    {
      $company->update($input);

      if ($company->save())
      {
        return Redirect::route('companies.show', $id);
      }

      return Redirect::route('companies.edit', $id)
        ->withInput()
        ->withErrors($company->errors())
        ->with('message', 'There were validation errors.');
    }

    return $error_response;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    list($company, $error_response) = $this->_findForModify($id);

    if ($company !== NULL)
    {
        $company->delete();

        return Redirect::route('companies.index')->with('flash', 'Company deleted');
    }

    return $error_response;
  }

}
