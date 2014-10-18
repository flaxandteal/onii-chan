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
use OniiChan\Domain\Model\Company\Url;
use OniiChan\Domain\Model\Company\Email;
use OniiChan\Domain\Model\Company\Location;
use OniiChan\Domain\Model\Company\Size;
use OniiChan\Domain\Model\Company\InterestedIn;
use OniiChan\Domain\Model\Company\Experience;
use OniiChan\Domain\Model\Company\Technologies;
use OniiChan\Domain\Model\Company\Vacancies;
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

    $company = $this->repository->companyOfTitle(new Title("Flax & Teal Limited"));

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Company', $company);
  }

  /** @test */
  public function should_find_company_by_id()
  {
    $this->executor->execute($this->loader->getFixtures());

    $companies = $this->repository->findAll();
    $this->assertTrue(count($companies) > 0);
    $company_id = (string)$companies[0]->id();

    $company = $this->repository->companyOfId(CompanyId::fromString($company_id));

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Company', $company);
  }

  /** @test */
  public function should_add_new_company()
  {
    $id = CompanyId::generate();
    $title = new Title("Flax & Teal Limited");
    $yearStarted  = new YearStarted(2013);
    $url          = new Url("www.flaxandteal.co.uk");
    $email        = new Email("info@flaxandteal.co.uk");
    $location     = new Location("Belfast");
    $size         = new Size(1);
    $interestedIn = new InterestedIn("Web dev, mathematics, education, open source advocacy.");
    $experience   = new Experience("New Zealand video tutorials service");
    $technologies = new Technologies("Python, C/C++, PHP, Drupal, Laravel");
    $vacancies    = new Vacancies("Junior web developer (1 pos.)");

    $this->repository->add(Company::register($id,
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

    $this->em->clear();

    $company = $this->repository->companyOfTitle(new Title("Flax & Teal Limited"));

    $this->assertEquals($id, $company->id());
    $this->assertEquals($title, $company->title());
    $this->assertEquals($yearStarted, $company->yearStarted());
    $this->assertEquals($url, $company->url());
    $this->assertEquals($email, $company->email());
    $this->assertEquals($location, $company->location());
    $this->assertEquals($size, $company->size());
    $this->assertEquals($interestedIn, $company->interestedIn());
    $this->assertEquals($experience, $company->experience());
    $this->assertEquals($technologies, $company->technologies());
    $this->assertEquals($vacancies, $company->vacancies());
  }

  /** @test */
  public function should_update_existing_company()
  {
    $this->executor->execute($this->loader->getFixtures());

    $company = $this->repository->companyOfTitle(new Title("Flax & Teal Limited"));

    $company->updateTitle(new Title("Flax & Teal Unlimited"));

    $this->repository->update($company);

    $this->em->clear();

    $company = $this->repository->companyOfTitle(new Title("Flax & Teal Unlimited"));

    $this->assertInstanceOf("OniiChan\Domain\Model\Company\Company", $company);
  }

  /** @test */
  public function should_find_all_companies()
  {
    $this->executor->execute($this->loader->getFixtures());

    $companies = $this->repository->findAll();

    $this->assertTrue(count($companies) > 1);
    $this->assertInstanceOf("OniiChan\Domain\Model\Company\Company", $companies[0]);
  }

  /** @test */
  public function should_find_companies_by_title_substring()
  {
    $this->executor->execute($this->loader->getFixtures());

    $companies = $this->repository->companiesByTitleSubstring("imited", FALSE, FALSE);

    $this->assertTrue(count($companies) == 3);
    $this->assertInstanceOf("OniiChan\Domain\Model\Company\Company", $companies[0]);
  }

  /** @test */
  public function should_offset_and_limit_companies_found_by_title_substring()
  {
    $this->executor->execute($this->loader->getFixtures());

    $limit = 2;
    $offset = 1;

    $companies = $this->repository->companiesByTitleSubstring("imited", $limit, $offset);

    $this->assertTrue(count($companies) == 2);
    $this->assertTrue($companies[1]->title()->toString() == "Flax & Teal Limited");
    $this->assertInstanceOf("OniiChan\Domain\Model\Company\Company", $companies[0]);
  }
}
