<?php

class CompaniesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('companies')->truncate();

		$companies = array(
      array(
        'user_id' => 1,
        'name' = 'Flax & Teal Limited',
        'type_id' => 1,
        'website' => 'http://flaxandteal.co.uk',
        'endorsements' => 2,
        'location' => 'Belfast',
        'size' => 'Ltd < 5',
        'founded' => 2013
      )
		);

		Uncomment the below to run the seeder
		DB::table('companies')->insert($companies);
	}

}
