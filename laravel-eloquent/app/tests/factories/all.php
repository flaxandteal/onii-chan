<?php

use League\FactoryMuffin\Facade as FactoryMuffin;


FactoryMuffin::define('Company', array(
  'user_id' => 'factory|User',
  'name' => 'company',
  'type_id' => 'randomDigitNotNull',
  'website' => 'url',
  'endorsements' => 'randomDigit',
  'location' => 'string',
  'size' => 'string',
  'founded' => 'string'
));

FactoryMuffin::define('Listing', array(
  'company_id' => 'randomDigitNotNull',
  'interested_in' => 'text',
  'interested_in_categories' => 'integer',
  'experience' => 'text',
  'technologies' => 'text',
  'career_seekers' => 'text',
  'seeking' => 'text',
  'tags' => 'word',
  'sections' => 'randomDigitNotNull'
));

FactoryMuffin::define('User', array(
  'email' => 'email',
  'first_name' => 'firstNameFemale',
  'password' => 'md5',
  'last_name' => 'lastName',
  'activated' => 1
));
