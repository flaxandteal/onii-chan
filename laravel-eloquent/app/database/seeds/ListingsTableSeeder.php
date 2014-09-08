<?php

class ListingsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('listings')->truncate();

		$listings = array(
      array(
        'interested_in' => 'Bringing Commonwealth companies to Europe',
        'interested_in_categories' => '1,2',
        'experience' => 'Online video tutorials website',
        'technologies' => 'Python, PHP',
        'career_seekers' => 'Junior web developer',
        'seeking' => 'Collaborations',
        'tags' => 'Drupal, Laravel, PHP',
        'sections' => '1,2'
      )
		);

		DB::table('listings')->insert($listings);
	}

}
