<?php namespace OniiChan\Tests\Application\Company;

use Mockery as m;
use OniiChan\Application\Company\RegisterCompanyCommandHandler;

class RegisterCompanyCommandHandlerTest extends \PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    parent::setUp();
    $this->registerCompanyService = m::mock('OniiChan\Domain\Services\Company\RegisterCompanyService');
    $this->registerCompanyCommand = m::mock('OniiChan\Application\Company\RegisterCompanyCommand');
  }

  public function tearDown()
  {
    m::close();
  }

  /** @test */
  public function should_trigger_register_company_on_register_company_command()
  {
    $commandHandler = new RegisterCompanyCommandHandler($this->registerCompanyService);

    $title = "Flax & Teal Limited";
    $yearStarted = 2013;
    $url = "www.flaxandteal.co.uk";
    $email = "info@flaxandteal.co.uk";
    $location = "Belfast";
    $size = 1;
    $interestedIn = "Web dev, mathematics, education, open source advocacy.";
    $experience = "New Zealand video tutorials service";
    $technologies = "Python, C/C++, PHP, Drupal, Laravel";
    $vacancies = "Junior web developer (1 pos.)";

    $this->registerCompanyCommand->shouldReceive('title')->andReturn($title)->once();
    $this->registerCompanyCommand->shouldReceive('yearStarted')->andReturn($yearStarted)->once(); // WHY NO ERROR IF NOT CALLED?
    $this->registerCompanyCommand->shouldReceive('url')->andReturn($url)->once();
    $this->registerCompanyCommand->shouldReceive('email')->andReturn($email)->once();
    $this->registerCompanyCommand->shouldReceive('location')->andReturn($location)->once();
    $this->registerCompanyCommand->shouldReceive('size')->andReturn($size)->once();
    $this->registerCompanyCommand->shouldReceive('interestedIn')->andReturn($interestedIn)->once();
    $this->registerCompanyCommand->shouldReceive('experience')->andReturn($experience)->once();
    $this->registerCompanyCommand->shouldReceive('technologies')->andReturn($technologies)->once();
    $this->registerCompanyCommand->shouldReceive('vacancies')->andReturn($vacancies)->once();
    $this->registerCompanyService->shouldReceive('register')->with($title, $yearStarted, $url, $email, $location, $size, $interestedIn,
      $experience, $technologies, $vacancies)->once();

    $commandHandler->handle($this->registerCompanyCommand);
  }
}
