<?php namespace OniiChan\Tests\Infrastructure\Repositories\Fixtures;

use OniiChan\Domain\Model\Company\Company;
use OniiChan\Domain\Model\Company\CompanyId;
use OniiChan\Domain\Model\Company\Title;
use OniiChan\Domain\Model\Company\YearStarted;
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
    $id = CompanyId::generate();
    $title = new Title("Flax & Teal Limited");
    $yearStarted = new YearStarted(2013);

    $company = Company::register($id, $title, $yearStarted);

    $manager->persist($company);
    $manager->flush();
  }
}
