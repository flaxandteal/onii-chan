<?php namespace OniiChan\Tests\Presentation\Company;

use Mockery as m;
use Doctrine\Common\Collections\ArrayCollection;
use OniiChan\Domain\Model\Company\Company;
use OniiChan\Presentation\Company\CompanyPresenter;

class CompanyPresenterTest extends \PHPUnit_Framework_TestCase
{
  /** @var Company */
  protected $company;

  /** @test */
  public function should_show_endorsements()
  {
    $collection = new ArrayCollection;
    $collection[] = 1;
    $collection[] = 2;
    $collection[] = 'foo';

    $this->company = m::mock('OniiChan\Domain\Model\Company\Company');

    $this->company->shouldReceive('endorsers')->once()->andReturn($collection);

    $presenter = new CompanyPresenter();

    $presenter->set($this->company);

    $this->assertEquals($presenter->endorsements(), 3);
  }
}
