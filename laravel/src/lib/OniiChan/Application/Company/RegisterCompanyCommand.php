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
   * @var string
   */
  private $url;

  /**
   * @var string
   */
  private $email;

  /**
   * @var string
   */
  private $location;

  /**
   * @var integer
   */
  private $size;

  /**
   * @var string
   */
  private $interestedIn;

  /**
   * @var string
   */
  private $experience;

  /**
   * @var string
   */
  private $technologies;

  /**
   * @var string
   */
  private $vacancies;

  /**
   * @var string
   */
  private $blurb;

  /**
   * Create a new RegisterCompanyCommand
   *
   * @param string $title
   * @param integer $yearStarted
   * @return RegisterCompanyCommand
   */
  public function __construct($title, $yearStarted, $url,
    $email, $location, $size, $interestedIn, $experience,
    $technologies, $vacancies, $blurb)
  {
    $this->title = $title;
    $this->yearStarted = $yearStarted;
    $this->url = $url;
    $this->email = $email;
    $this->location = $location;
    $this->size = $size;
    $this->interestedIn = $interestedIn;
    $this->experience = $experience;
    $this->technologies = $technologies;
    $this->vacancies = $vacancies;
    $this->blurb = $blurb;
  }
}
