<?php namespace OniiChan\Storage\Listing;

interface ListingRepositoryInterface {

  public function get_rules();

  public function all();

  public function find($id);

  public function findOrFail($id);

  public function fill($attributes);

  public function create($input);

}
