<?php namespace OniiChan\Tests;

use Mockery as m;
use OniiChan\Application\ApplicationContainer;
use OniiChan\Application\Company\RegisterCompanyCommandHandler;

class ApplicationContainerTest extends \PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->app = m::mock('Illuminate\Foundation\Application');
    $this->registerCompanyCommandHandler = m::mock('OniiChan\Application\Company\RegisterCompanyCommandHandler');
  }

  /** @test */
  public function should_resolve_register_company_command_handler()
  {
    $applicationContainer = new ApplicationContainer($this->app);

    $this->app->shouldReceive('make')->andReturn($this->registerCompanyCommandHandler);
    $this->registerCompanyCommandHandler->shouldReceive('handle');


    $handler = $applicationContainer->make('OniiChan\Application\Company\RegisterCompanyCommandHandler');

    $this->assertInstanceOf('OniiChan\Application\Company\RegisterCompanyCommandHandler', $handler);
  }
}
