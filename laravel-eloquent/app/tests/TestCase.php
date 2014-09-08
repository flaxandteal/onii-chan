<?php

/* Useful resource on this topic:
 * http://code.tutsplus.com/tutorials/testing-like-a-boss-in-laravel-models--net-30087
 */

use League\FactoryMuffin\Facade as FactoryMuffin;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

  /**
   * Migrates the database and set pretend mailer.
   */
  private function prepareForTests()
  {
    Artisan::call('migrate');
    Mail::pretend(true);
  }

  /**
   * Preps FactoryMuffin for execution
   */
  public static function setupBeforeClass()
  {
    FactoryMuffin::setFakerLocale('en_EN')->setSaveMethod('save');
    FactoryMuffin::loadFactories(__DIR__ . '/factories');
  }

  /**
   * Tidy up FactoryMuffin
   */
  public static function tearDownAfterClass()
  {
    //FactoryMuffin::setDeleteMethod('delete');
    //FactoryMuffin::deleteSaved();
  }

  /**
   * This gets called by PHPUnit to set up before
   * each test.
   */
  public function setUp()
  {
    parent::setUp();

    $this->prepareForTests();
  }

}
