<?php

use LaravelBook\Ardent\Ardent;

class Company extends Ardent {
	protected $guarded = array();

  /**
   * Rules for validation
   *
   * @var array
   */
	public static $rules = array(
		'user_id' => 'required|numeric',
		'listing_id' => 'numeric',
		'name' => 'required',
		'type_id' => 'required|numeric',
		'website' => 'required|URL',
		'endorsements' => 'required|numeric',
		'location' => 'required',
		'size' => 'required',
		'founded' => 'required'
	);

  public function listing() {
    return $this->hasOne('Listing');
  }

  public function user()
  {
    return $this->belongsTo('User');
  }
}
