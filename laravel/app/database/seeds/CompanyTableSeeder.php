<?php

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
use OniiChan\Domain\Model\Company\CompanyRepository;

class CompanyTableSeeder extends Seeder {

  /**
   * Repository for Company data
   *
   * @var CompanyRepository
   */
  private $companyRepository;

  function __construct(CompanyRepository $companyRepository)
  {
    $this->companyRepository = $companyRepository;
  }

  public function run()
  {
    $faker = Faker\Factory::create();

    $samples = array();

    $entries = 100;
    for ($i = 0; $i < $entries ; $i++)
      $samples[] = array (
        "title" => $faker->company(),
        "yearStarted" => $faker->numberBetween(1800, 2014),
        "url" => $faker->url(),
        "email" => $faker->email(),
        "location" => $faker->city(),
        "size" => $faker->numberBetween(1, 10000),
        "interestedIn" => $faker->text(),
        "experience" => $faker->text(),
        "technologies" => $faker->text(),
        "vacancies" => $faker->text()
      );

    $samples[rand(0, $entries)] = array(
      "title" => "Flax & Teal Limited",
      "yearStarted" => 2013,
      "url" => "www.flaxandteal.co.uk",
      "email" => "info@flaxandteal.co.uk",
      "location" => "Belfast",
      "size" => 1,
      "interestedIn" => "Web dev, mathematics, education, open source advocacy.",
      "experience" => "New Zealand video tutorials service",
      "technologies" => "Python, C/C++, PHP, Drupal, Laravel",
      "vacancies" => "Junior web developer (1 pos.)"
    );

    $preferred = array(
      array("title" => "I K Flank", "size" => 1),
      array("title" => "Fortune Testing"),
      array("title" => "C Fuller", "size" => 1),
      array("title" => "Homeware Plc"),
      array("title" => "Human Technologies"),
      array("title" => "Z Huntingdon"),
      array("title" => "T J Garrick", "size" => 1),
      array("title" => "H H Garner", "size" => 1),
      array("title" => "Fun IT"),
      array("title" => "Fyziks Ltd"),
      array("title" => "Holywood IT Services", "location" => "Holywood"),
      array("title" => "Gateway Services"),
      array("title" => "Hotel Computers Ltd"),
      array("title" => "R S Galloway", "size" => 1),
      array("title" => "Medical IT Services Limited"),
      array("title" => "New Arts & Graphics"),
      array("title" => "Generation Z Limited"),
      array("title" => "Echo Ltd"),
      array("title" => "Drop Table Plc"),
      array("title" => "Fenway IT"),
      array("title" => "TechComputers Ltd"),
      array("title" => "Serious Services")
    );

    $picked = array();
    foreach ($preferred as $entry)
    {
      do {
        $i = rand(0, $entries);
      } while (in_array($i, $picked) && count($picked) < count($samples));

      $picked[] = $i;
      foreach ($entry as $k => $v)
        $samples[$i][$k] = $v;
    }

    foreach ($samples as $varlist) {
      $id = CompanyId::generate();

      $title        = new Title($varlist["title"]);
      $yearStarted  = new YearStarted($varlist["yearStarted"]);
      $url          = new Url($varlist["url"]);
      $email        = new Email($varlist["email"]);
      $location     = new Location($varlist["location"]);
      $size         = new Size($varlist["size"]);
      $interestedIn = new InterestedIn($varlist["interestedIn"]);
      $experience   = new Experience($varlist["experience"]);
      $technologies = new Technologies($varlist["technologies"]);
      $vacancies    = new Vacancies($varlist["vacancies"]);

      $this->companyRepository->add(Company::register(
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
        $vacancies
      ));
    }
  }

}
