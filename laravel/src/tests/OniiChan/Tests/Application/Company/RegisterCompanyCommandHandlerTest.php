<?php namespace OniiChan\Tests\Application\Company;

use Mockery as m;
use OniiChan\Application\Company\RegisterCompanyCommandHandler;

class RegisterCompanyCommandHandlerTest extends \PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->registerCompanyService = m::mock('OniiChan\Domain\Services\Company\RegisterCompanyService');
    $this->registerCompanyCommand = m::mock('OniiChan\Application\Company\RegisterCompanyCommand');
  }

  /** @test */
  public function should_trigger_register_company_on_register_company_command()
  {
    $commandHandler = new RegisterCompanyCommandHandler($this->registerCompanyService);

    $title = "Flax & Teal Limited";
    $yearStarted = 2013;

    $this->registerCompanyCommand->shouldReceive('title')->andReturn($title);
    $this->registerCompanyCommand->shouldReceive('yearStarted')->andReturn($yearStarted); // WHY NO ERROR IF NOT CALLED?
    $this->registerCompanyService->shouldReceive('register', $title, $yearStarted);

    $commandHandler->handle($this->registerCompanyCommand);
  }
}
