<?php namespace OniiChan\Application\Company;

use OniiChan\Application\Command;
use OniiChan\Gettable;

class RegisterCompanyCommand implements Command
{
  use Gettable;

  /**
   * @var string
   */
  private $title;

  /**
   * @var integer
   */
  private $yearStarted;

  /**
   * Create a new RegisterCompanyCommand
   *
   * @param string $title
   * @param integer $yearStarted
   * @return RegisterCompanyCommand
   */
  public function __construct($title, $yearStarted)
  {
    $this->title = $title;
    $this->yearStarted = $yearStarted;
  }
}
