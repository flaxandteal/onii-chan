<?php

class Company extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'listing_id' => 'required',
		'name' => 'required',
		'type_id' => 'required',
		'website' => 'required',
		'endorsements' => 'required',
		'location' => 'required',
		'size' => 'required',
		'founded' => 'required'
	);
}
