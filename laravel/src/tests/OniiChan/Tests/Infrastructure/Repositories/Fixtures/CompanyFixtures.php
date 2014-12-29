<?php namespace OniiChan\Tests\Infrastructure\Repositories\Fixtures;

use OniiChan\Domain\Model\Company\Company;
use OniiChan\Domain\Model\Company\CompanyId;
use OniiChan\Domain\Model\Company\Title;
use OniiChan\Domain\Model\Company\YearStarted;
use OniiChan\Domain\Model\Company\Url;
use OniiChan\Domain\Model\Company\Email;
use OniiChan\Domain\Model\Company\Location;
use OniiChan\Domain\Model\Company\Size;
use OniiChan\Domain\Model\Company\InterestedIn;
use OniiChan\Domain\Model\Company\Experience;
use OniiChan\Domain\Model\Company\Technologies;
use OniiChan\Domain\Model\Company\Vacancies;
use OniiChan\Domain\Model\Company\Blurb;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

class CompanyFixtures implements FixtureInterface
{
  /**
   * Load the Company fixtures
   *
   * @param ObjectManager $manager
   * @return void
   */
  public function load(ObjectManager $manager)
  {
    $faker = \Faker\Factory::create();

    $samples = array(
      array("title" => "I K Flank", "yearStarted" => 2007),
      array("title" => "Fortune Testing", "yearStarted" => 2007),
      array("title" => "C Fuller", "yearStarted" => 2012),
      array("title" => "Homeware Plc", "yearStarted" => 2014),
      array("title" => "Human Technologies", "yearStarted" => 1990),
      array("title" => "Z Huntingdon", "yearStarted" => 2003),
      array("title" => "T J Garrick", "yearStarted" => 2010),
      array("title" => "H H Garner", "yearStarted" => 2012),
      array("title" => "Fun IT", "yearStarted" => 2013),
      array("title" => "Fyziks Ltd", "yearStarted" => 2000),
      array("title" => "Holywood IT Services", "yearStarted" => 2009),
      array("title" => "Gateway Services", "yearStarted" => 2007),
      array("title" => "Hotel Computers Ltd", "yearStarted" => 2008),
      array("title" => "R S Galloway", "yearStarted" => 2003),
      array("title" => "Medical IT Services Limited", "yearStarted" => 2004),
      array("title" => "New Arts & Graphics", "yearStarted" => 2012),
      array("title" => "Generation Z Limited", "yearStarted" => 2011),
      array("title" => "Flax & Teal Limited", "yearStarted" => 2013),
      array("title" => "Echo Ltd", "yearStarted" => 2008),
      array("title" => "Drop Table Plc", "yearStarted" => 1999),
      array("title" => "Fenway IT", "yearStarted" => 1997),
      array("title" => "TechComputers Ltd", "yearStarted" => 2003),
      array("title" => "Serious Services", "yearStarted" => 2010)
    );

    foreach ($samples as $varlist) {
      $id = CompanyId::generate();

      $title = new Title($varlist["title"]);
      $yearStarted = new YearStarted($varlist["yearStarted"]);
      $url = new Url($faker->url);
      $email = new Email($faker->email);
      $location = new Location($faker->city);
      $size = new Size($faker->numberBetween(1, 100));
      $interestedIn = new InterestedIn($faker->text);
      $experience = new Experience($faker->text);
      $technologies = new Technologies($faker->text);
      $vacancies = new Vacancies($faker->text);
      $blurb = new Blurb($faker->text);

      $company = Company::register(
        $id,
        $title,
        $yearStarted,
        $url,
        $email,
        $location,
        $size,
        $interestedIn,
        $experience,
        $technologies,
        $vacancies,
        $blurb
      );

      $manager->persist($company);
    }

    $manager->flush();
  }
}
