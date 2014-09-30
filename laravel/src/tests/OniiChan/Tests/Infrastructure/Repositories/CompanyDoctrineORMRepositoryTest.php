<?php namespace OniiChan\Tests\Infrastructure\Repositories;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

use OniiChan\Domain\Model\Company\Company;
use OniiChan\Domain\Model\Company\CompanyId;
use OniiChan\Domain\Model\Company\Title;
use OniiChan\Domain\Model\Company\YearStarted;
use OniiChan\Infrastructure\Repositories\CompanyDoctrineORMRepository;
use OniiChan\Tests\Infrastructure\Repositories\Fixtures\CompanyFixtures;

class CompanyDoctrineORMRepositoryTest extends \TestCase
{
  /** @var CompanyDoctrineORMRepository */
  private $repository;

  /** @var EntityManager */
  private $em;

  /** @var ORMExecutor */
  private $executor;

  /** @var Loader */
  private $loader;

  public function setUp()
  {
    parent::setUp();

    Artisan::call('doctrine:schema:create');

    $this->em = App::make('Doctrine\ORM\EntityManagerInterface');
    $this->repository = new CompanyDoctrineORMRepository($this->em);

    $this->executor = new ORMExecutor($this->em, new ORMPurger);
    $this->loader = new Loader;
    $this->loader->addFixture(new CompanyFixtures);
  }

  /** @test */
  public function should_return_next_identity()
  {
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\CompanyId', $this->repository->nextIdentity());
  }

  /** @test */
  public function should_find_company_by_title()
  {
    $this->executor->execute($this->loader->getFixtures());

    $company = $company = $this->repository->companyOfTitle(new Title("Flax & Teal Limited"));

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Company', $company);
  }

  /** @test */
  public function should_add_new_company()
  {
    $id = CompanyId::generate();
    $title = new Title("Flax & Teal Limited");
    $yearStarted = new YearStarted(2013);

    $this->repository->add(Company::register($id, $title, $yearStarted));

    $this->em->clear();

    $company = $this->repository->companyOfTitle(new Title("Flax & Teal Limited"));

    $this->assertEquals($id, $company->id());
    $this->assertEquals($title, $company->title());
    $this->assertEquals($yearStarted, $company->yearStarted());
  }

  /** @test */
  public function should_update_existing_company()
  {
    $this->executor->execute($this->loader->getFixtures());

    $company = $company = $this->repository->companyOfTitle(new Title("Flax & Teal Limited"));

    $company->updateTitle(new Title("Flax & Teal Unlimited"));

    $this->repository->update($company);

    $this->em->clear();

    $company = $this->repository->companyOfTitle(new Title("Flax & Teal Unlimited"));

    $this->assertInstanceOf("OniiChan\Domain\Model\Company\Company", $company);
  }
}
