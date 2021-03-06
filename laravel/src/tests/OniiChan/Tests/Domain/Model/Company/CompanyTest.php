<?php namespace OniiChan\Tests\Domain\Model\Company;

use Rhumsaa\Uuid\Uuid;
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

class CompanyTest extends \PHPUnit_Framework_TestCase
{
  /** @var CompanyId */
  private $companyId;

  /** @var Title */
  private $title;

  /** @var Blurb */
  private $blurb;

  /** @var YearStarted */
  private $yearStarted;

  public function setUp()
  {
    $this->companyId = new CompanyId(Uuid::uuid4());
    $this->title        = new Title('Flax & Teal Limited');
    $this->yearStarted  = new YearStarted(2013);
    $this->url          = new Url("www.flaxandteal.co.uk");
    $this->email        = new Email("info@flaxandteal.co.uk");
    $this->location     = new Location("Belfast");
    $this->size         = new Size(1);
    $this->interestedIn = new InterestedIn("Web dev, mathematics, education, open source advocacy.");
    $this->experience   = new Experience("New Zealand video tutorials service");
    $this->technologies = new Technologies("Python, C/C++, PHP, Drupal, Laravel");
    $this->vacancies    = new Vacancies("Junior web developer (1 pos.)");
    $this->blurb        = new Blurb(
<<<ENDBLURB
      Flax & Teal is a Belfast-based contracting company. In-house experience 
      in web development, engineering and mathematics. interested in 
      collaborations oriented around numerical analysis or web solutions.

      The company is focused on developing European links with international 
      Commonwealth projects, and Northern Ireland internal collaboration.
ENDBLURB
    );
  }

  /** @test */
  public function should_require_company_id()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      null,
      $this->title,
      $this->yearStarted,
      $this->companyId,
      $this->url,
      $this->email,
      $this->location,
      $this->size,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );
  }

  /** @test */
  public function should_require_title()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      null,
      $this->yearStarted,
      $this->companyId,
      $this->url,
      $this->email,
      $this->location,
      $this->size,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );
  }

  /** @test */
  public function should_require_year_started()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      $this->title,
      null,
      $this->url,
      $this->email,
      $this->location,
      $this->size,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );
  }

  /** @test */
  public function should_require_url()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      null,
      $this->email,
      $this->location,
      $this->size,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );
  }

  /** @test */
  public function should_require_email()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      $this->url,
      null,
      $this->location,
      $this->size,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );
  }

  /** @test */
  public function should_require_location()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      $this->url,
      $this->email,
      null,
      $this->size,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );
  }

  /** @test */
  public function should_require_size()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      $this->url,
      $this->email,
      $this->location,
      null,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );
  }

  /** @test */
  public function should_require_interested_in()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      $this->url,
      $this->email,
      $this->location,
      $this->size,
      null,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );
  }

  /** @test */
  public function should_require_experience()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      $this->url,
      $this->email,
      $this->location,
      $this->size,
      $this->interestedIn,
      null,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );
  }

  /** @test */
  public function should_require_technologies()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      $this->url,
      $this->email,
      $this->location,
      $this->size,
      $this->interestedIn,
      $this->experience,
      null,
      $this->vacancies,
      $this->blurb
    );
  }

  /** @test */
  public function should_require_vacancies()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      $this->url,
      $this->email,
      $this->location,
      $this->size,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      null,
      $this->blurb
    );
  }

  public function should_require_blurb()
  {
    $this->setExpectedException('Exception');

    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      $this->url,
      $this->email,
      $this->location,
      $this->size,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      null
    );
  }

  /** @test */
  public function should_create_new_company()
  {
    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      $this->url,
      $this->email,
      $this->location,
      $this->size,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Company', $company);
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\CompanyId', $company->id());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Title', $company->title());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\YearStarted', $company->yearStarted());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Url', $company->url());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Email', $company->email());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Location', $company->location());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Size', $company->size());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\InterestedIn', $company->interestedIn());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Experience', $company->experience());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Technologies', $company->technologies());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Vacancies', $company->vacancies());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Blurb', $company->blurb());
    $this->assertEquals(1, count($company->release()));
  }

  /** @test */
  public function should_update_title()
  {
    $company = Company::register(
      $this->companyId,
      $this->title,
      $this->yearStarted,
      $this->url,
      $this->email,
      $this->location,
      $this->size,
      $this->interestedIn,
      $this->experience,
      $this->technologies,
      $this->vacancies,
      $this->blurb
    );

    $company->updateTitle(new Title("Flax & Teal Unlimited"));

    $this->assertEquals("Flax & Teal Unlimited", $company->title()->toString());
    $this->count(1, count($company->release()));
  }

  /** @test */
  public function should_endorse_and_have_endorsers()
  {
    $companies = [];

    for ($i = 0; $i < 4 ; $i++)
      $company[] = Company::register(
        new CompanyId(Uuid::uuid4()),
        new Title('Company' . $i),
        $this->yearStarted,
        $this->url,
        $this->email,
        $this->location,
        $this->size,
        $this->interestedIn,
        $this->experience,
        $this->technologies,
        $this->vacancies,
        $this->blurb
      );

    $company[1]->endorse($company[0]);
    $company[2]->endorse($company[0]);
    $company[2]->endorse($company[1]);
    $company[3]->endorse($company[0]);
    $company[3]->endorse($company[1]);
    $company[3]->endorse($company[2]);

    $this->assertEquals(0, $company[0]->endorsing()->count());
    $this->assertEquals(1, $company[1]->endorsing()->count());
    $this->assertEquals(2, $company[2]->endorsing()->count());
    $this->assertEquals(3, $company[3]->endorsing()->count());

    $this->assertEquals(3, $company[0]->endorsers()->count());
    $this->assertEquals(2, $company[1]->endorsers()->count());
    $this->assertEquals(1, $company[2]->endorsers()->count());
    $this->assertEquals(0, $company[3]->endorsers()->count());

    $company[3]->endorse($company[2]);

    $this->assertEquals(1, $company[2]->endorsers()->count());
    $this->assertEquals(3, $company[3]->endorsing()->count());

    $company[3]->unendorse($company[2]);

    $this->assertEquals(0, $company[2]->endorsers()->count());
    $this->assertEquals(2, $company[3]->endorsing()->count());

    $company[2]->unendorse($company[3]);
    $company[3]->unendorse($company[2]);

    $this->assertEquals(0, $company[3]->endorsers()->count());
    $this->assertEquals(2, $company[2]->endorsing()->count());
    $this->assertEquals(0, $company[2]->endorsers()->count());
    $this->assertEquals(2, $company[3]->endorsing()->count());
  }
}
