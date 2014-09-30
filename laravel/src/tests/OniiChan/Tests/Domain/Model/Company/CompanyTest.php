<?php namespace OniiChan\Tests\Domain\Model\Company;

use Rhumsaa\Uuid\Uuid;
use OniiChan\Domain\Model\Company\Company;
use OniiChan\Domain\Model\Company\CompanyId;
use OniiChan\Domain\Model\Company\Title;
use OniiChan\Domain\Model\Company\YearStarted;

class CompanyTest extends \PHPUnit_Framework_TestCase
{
  /** @var CompanyId */
  private $companyId;

  /** @var Title */
  private $title;

  /** @var YearStarted */
  private $yearStarted;

  public function setUp()
  {
    $this->companyId = new CompanyId(Uuid::uuid4());
    $this->title = new Title('Flax & Teal Limited');
    $this->yearStarted = new YearStarted(2013);
  }

  /** @test */
  public function should_require_company_id()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(null, $this->title, $this->yearStarted);
  }

  /** @test */
  public function should_require_title()
  {
    $this->setExpectedException('Exception');

    $company = Company::register($this->companyId, null, $this->yearStarted);
  }

  /** @test */
  public function should_require_year_started()
  {
    $this->setExpectedException('Exception');

    $company = Company::register($this->companyId, $this->title, null);
  }

  /** @test */
  public function should_create_new_company()
  {
    $company = Company::register($this->companyId, $this->title, $this->yearStarted);

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Company', $company);
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\CompanyId', $company->id());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Title', $company->title());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\YearStarted', $company->yearStarted());
    $this->assertEquals(1, count($company->release()));
  }

  /** @test */
  public function should_update_title()
  {
    $company = Company::register($this->companyId, $this->title, $this->yearStarted);

    $company->updateTitle(new Title("Flax & Teal Unlimited"));

    $this->assertEquals("Flax & Teal Unlimited", $company->title()->toString());
    $this->count(1, count($company->release()));
  }
}
