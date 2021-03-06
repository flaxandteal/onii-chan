<?php namespace OniiChan\Tests\Application\Company;

use OniiChan\Application\Company\RegisterCompanyCommand;

class RegisterCompanyCommandTest extends \PHPUnit_Framework_TestCase
{
  /** @test */
  public function should_create_register_company_command()
  {
    $blurb =
<<<ENDBLURB
      Flax & Teal is a Belfast-based contracting company. In-house experience 
      in web development, engineering and mathematics. interested in 
      collaborations oriented around numerical analysis or web solutions.

      The company is focused on developing European links with international 
      Commonwealth projects, and Northern Ireland internal collaboration.
ENDBLURB;
    $command = new RegisterCompanyCommand(
      'Flax & Teal Limited',
      2013,
      'www.flaxandteal.co.uk',
      'info@flaxandteal.co.uk',
      'Belfast',
      1,
      'Web dev, mathematics, education, open source advocacy.',
      'New Zealand video tutorials service',
      'Python, C/C++, PHP, Drupal, Laravel',
      'Junior web developer (1 pos.)',
      $blurb
    );

    $this->assertEquals('Flax & Teal Limited', $command->title);
    $this->assertEquals(2013, $command->yearStarted);
    $this->assertEquals('www.flaxandteal.co.uk', $command->url);
    $this->assertEquals('info@flaxandteal.co.uk', $command->email);
    $this->assertEquals('Belfast', $command->location);
    $this->assertEquals(1, $command->size);
    $this->assertEquals('Web dev, mathematics, education, open source advocacy.', $command->interestedIn);
    $this->assertEquals('New Zealand video tutorials service', $command->experience);
    $this->assertEquals('Python, C/C++, PHP, Drupal, Laravel', $command->technologies);
    $this->assertEquals('Junior web developer (1 pos.)', $command->vacancies);
    $this->assertEquals($blurb, $command->blurb);
  }
}
