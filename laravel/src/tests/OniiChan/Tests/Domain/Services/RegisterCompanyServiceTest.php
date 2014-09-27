<?php namespace OniiChan\Tests\Domain\Services;

use Mockery as m;
use OniiChan\Domain\Model\Company\CompanyId;
use OniiChan\Domain\Services\Company\RegisterCompanyService;

class RegisterCompanyServiceTest extends \PHPUnit_Framework_TestCase
{
  /** @var CompanyRepository */
  private $repository;

  /** @var RegisterCompanyService */
  private $registerCompanyService;

  public function setUp()
  {
    $this->repository = m::mock('OniiChan\Domain\Model\Company\CompanyRepository');

    $this->registerCompanyService = new RegisterCompanyService($this->repository);
  }

  /** @test */
  public function should_throw_exception_if_title_is_not_unique()
  {
    $this->setExpectedException('OniiChan\Domain\Model\ValueIsNotUniqueException');

    $this->repository->shouldReceive('companyOfTitle')->andReturn(true);

    $company = $this->registerCompanyService->register('Flax & Teal Limited', 2013);
  }

  /** @test */
  public function should_register_new_company()
  {
    $this->repository->shouldReceive('companyOfTitle')->andReturn(null);
    $this->repository->shouldReceive('nextIdentity')->andReturn(CompanyId::generate());
    $this->repository->shouldReceive('add');

    $company = $this->registerCompanyService->register('Flax & Teal Limited', 2013);
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Company', $company);
  }
}
