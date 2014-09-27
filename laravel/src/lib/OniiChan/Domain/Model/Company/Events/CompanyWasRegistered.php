<?php namespace OniiChan\Domain\Model\Company\Events;

use OniiChan\Gettable;
use BigName\EventDispatcher\Event;
use OniiChan\Domain\Model\Company\Company;

class CompanyWasRegistered implements Event
{
  use Gettable;

  /**
   * @var Company
   */
  private $company;

  /**
   * Create a new CompanyWasRegistered event
   *
   * @param Company $company
   * @return void
   */
  public function __construct(Company $company)
  {
    $this->company = $company;
  }

  /**
   * Return the name of the event
   *
   * @return string
   */
  public function getName()
  {
    return 'CompanyHasRegistered';
  }
}
