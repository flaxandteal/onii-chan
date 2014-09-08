<?php namespace OniiChan\Storage\Company;

interface CompanyRepositoryInterface {

  public function get_rules();

  public function all();

  public function find($id);

  public function findOrFail($id);

  public function findOrFailForModify($id);

  public function fill($attributes);

  public function create($input);

  public function save($model);

}
