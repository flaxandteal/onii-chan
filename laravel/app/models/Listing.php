<?php

class Listing extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'company_id' => 'required',
		'interested_in' => 'required',
		'interested_in_categories' => 'required',
		'experience' => 'required',
		'technologies' => 'required',
		'career_seekers' => 'required',
		'seeking' => 'required',
		'tags' => 'required',
		'sections' => 'required'
	);
}
