<?php namespace OniiChan\Tests\Domain\Services;

use Mockery as m;
use OniiChan\Domain\Model\Company\Company;
use OniiChan\Domain\Model\Company\CompanyId;
use OniiChan\Domain\Services\Company\RegisterCompanyService;

class RegisterCompanyServiceTest extends \PHPUnit_Framework_TestCase
{
  /** @var Company */
  private $company;

  /** @var CompanyRepository */
  private $repository;

  /** @var RegisterCompanyService */
  private $registerCompanyService;

  public function setUp()
  {
    parent::setUp();

    $this->company = m::mock('OniiChan\Domain\Model\Company\Company');
    $this->repository = m::mock('OniiChan\Domain\Model\Company\CompanyRepository');

    $this->registerCompanyService = new RegisterCompanyService($this->company, $this->repository);
  }

  public function tearDown()
  {
    parent::tearDown();
    m::close();
  }

  /** @test */
  public function should_throw_exception_if_title_is_not_unique()
  {
    $this->setExpectedException('OniiChan\Domain\Model\ValueIsNotUniqueException');

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
    $blurb = $this->createBlurb();

    $this->repository->shouldReceive('companyOfTitle')->andReturn(true);

    $company = $this->registerCompanyService->register(
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
  }

  /** @test */
  public function should_register_new_company()
  {
    $this->repository->shouldReceive('companyOfTitle')->andReturn(null);
    $this->repository->shouldReceive('nextIdentity')->andReturn(CompanyId::generate());
    $this->repository->shouldReceive('add');

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
    $blurb = $this->createBlurb();

    $this->company->shouldReceive('register')->andReturn($this->company);

    $company = $this->registerCompanyService->register(
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
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Company', $company);
  }

  private function createBlurb()
  {
    return
<<<ENDBLURB
      Flax & Teal is a Belfast-based contracting company. In-house experience 
      in web development, engineering and mathematics. interested in 
      collaborations oriented around numerical analysis or web solutions.

      The company is focused on developing European links with international 
      Commonwealth projects, and Northern Ireland internal collaboration.
ENDBLURB;
  }
}
