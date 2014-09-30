<?php namespace OniiChan\Domain\Model\Company;

use OniiChan\Domain\HasEvents;
use OniiChan\Domain\AggregateRoot;
use OniiChan\Domain\Model\Company\Events\CompanyWasRegistered;
use OniiChan\Domain\Model\Company\Events\TitleWasUpdated;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Mitch\LaravelDoctrine\Traits\Timestamps;
use Mitch\LaravelDoctrine\Traits\SoftDeletes;

/**
 * @ORM\Entity
 * @ORM\Table(name="companies")
 * @ORM\HasLifeCycleCallbacks()
 */
class Company implements AggregateRoot
{
  use HasEvents;
  use Timestamps;
  use SoftDeletes;

  /**
   * @ORM\Id
   * @ORM\Column(type="string")
   */
  private $id;

  /**
   * @ORM\Column(type="string", unique=TRUE)
   */
  private $title;

  /**
   * @ORM\Column(type="integer")
   */
  private $yearStarted;

  /**
   * Create a new company
   *
   * @param CompanyId $companyId
   * @param Title $title
   * @param YearStarted $yearStarted
   * @return void
   */
  private function __construct(CompanyId $companyId, Title $title, YearStarted $yearStarted)
  {
    $this->setId($companyId);
    $this->setTitle($title);
    $this->setYearStarted($yearStarted);

    $this->record(new CompanyWasRegistered($this));
  }

  /**
   * Register a new Company
   *
   * @param CompanyId $companyId
   * @param Title $title
   * @param YearStarted $yearStarted
   * @return Company
   */
  public static function register(CompanyId $companyId, Title $title, YearStarted $yearStarted)
  {
    $company = new Company($companyId, $title, $yearStarted);

    return $company;
  }

  /**
   * Get the Company's ID
   *
   * @return CompanyId
   */
  public function id()
  {
    return CompanyId::fromString($this->id);
  }

  /**
   * Set the Company's ID
   *
   * @param CompanyId $id
   * @return void
   */
  private function setId(CompanyId $id)
  {
    $this->id = $id->toString();
  }

  /**
   * Get the Company's title
   *
   * @return Title
   */
  public function title()
  {
    return Title::fromNative($this->title);
  }

  /**
   * Set the Company's title
   *
   * @param Title $title
   * @return void
   */
  private function setTitle(Title $title)
  {
    $this->title = $title->toString();
  }

  /**
   * Update a Company's title
   *
   * @param Company $company
   * @return void
   */
  public function updateTitle(Title $title)
  {
    $this->setTitle($title);

    $this->record(new TitleWasUpdated($this));
  }

  /**
   * Get the Company's year started
   *
   * @return YearStarted
   */
  public function yearStarted()
  {
    return YearStarted::fromNative($this->yearStarted);
  }

  /**
   * Set the Company's year started
   *
   * @param YearStarted $yearStarted
   * @return void
   */
  private function setYearStarted(YearStarted $yearStarted)
  {
    $this->yearStarted = $yearStarted->toInteger();
  }
}
