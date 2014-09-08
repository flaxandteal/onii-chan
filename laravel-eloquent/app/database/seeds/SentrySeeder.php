<?php

use App\Models\User;

class SentrySeeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();
    DB::table('groups')->delete();
    DB::table('users_groups')->delete();

    Sentry::getUserProvider()->create(array(
      'email' => 'admin@flaxandteal.co.uk',
      'password' => 'admin',
      'first_name' => 'Administrator',
      'last_name' => 'Test',
      'activated' => 1,
    ));

    Sentry::getGroupProvider()->create(array(
      'name' => 'Admin',
      'permissions' => array('administrator' => 1),
    ));

    $adminUser = Sentry::getUserProvider()->findByLogin('admin@flaxandteal.co.uk');
    $adminGroup = Sentry::getGroupProvider()->findByName('Administrator');
    $adminUser->addGroup($adminGroup);
  }

}
