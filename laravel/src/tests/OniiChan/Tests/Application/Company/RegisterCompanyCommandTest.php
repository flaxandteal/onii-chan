<?php namespace OniiChan\Application\Company;

use OniiChan\Application\Company\RegisterCompanyCommand;

class RegisterCompanyCommandTest extends \PHPUnit_Framework_TestCase
{
  /** @test */
  public function should_create_register_company_command()
  {
    $command = new RegisterCompanyCommand('Flax & Teal Limited', 2013);

    $this->assertEquals('Flax & Teal Limited', $command->title);
    $this->assertEquals(2013, $command->yearStarted);
  }
}
