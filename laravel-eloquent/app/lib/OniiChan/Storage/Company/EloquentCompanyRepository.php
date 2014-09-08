<?php namespace OniiChan\Storage\Company;

use OniiChan\Storage\Company\CompanyRepositoryInterface;
use OniiChan\Storage\Exceptions\ModelNotFoundException as ModelNotFoundException;
use Company;

class EloquentCompanyRepository implements CompanyRepositoryInterface {

  protected $eloquentModel;

  public function __construct(Model $company)
  {
    $this->eloquentModel = $company;
  }

  protected function _convert($companyModel)
  {
    if ($companyModel == null)
    {
      return null;
    }
    /* RMV */
  }

  public function get_rules()
  {
    return Company::rules;
  }

  public function all()
  {
    return Company::all();
  }

  public function find($id)
  {
    return Company::find($id);
  }

  public function findOrFail($id)
  {
    try {
      $company = Company::findOrFail($id);
    } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      throw new ModelNotFoundException($e->get_message());
    }

    return $company;
  }

  public function findOrFailForModify($id)
  {
  }

  public function fill($attributes)
  {
    return Company::fill($attributes);
  }

  public function create($input)
  {
    return Company::create($input);
  }

  public function save($model)
  {
    $model->save();
  }

}
