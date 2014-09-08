<?php namespace OniiChan\Storage\Listing;

use OniiChan\Storage\Listing\ListingRepositoryInterface;
use OniiChan\Storage\Exceptions\ModelNotFoundException as ModelNotFoundException;
use Listing;

class EloquentListingRepository implements ListingRepositoryInterface {

  public function get_rules()
  {
    return Company::rules;
  }

  public function all()
  {
    return Listing::all();
  }

  public function find($id)
  {
    return Listing::find($id);
  }

  public function findOrFail($id)
  {
    try {
      $listing = Listing::findOrFail($id);
    } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      throw new ModelNotFoundException($e->get_message());
    }

    return $listing;
  }

  public function fill($attributes)
  {
    return Listing::fill($attributes);
  }

  public function create($input)
  {
    return Listing::create($input);
  }

}
