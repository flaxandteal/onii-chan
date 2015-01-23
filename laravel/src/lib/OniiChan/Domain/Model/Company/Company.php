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
   * @ORM\Column(type="string")
   */
  private $url;

  /**
   * @ORM\Column(type="string")
   */
  private $email;

  /**
   * @ORM\Column(type="string")
   */
  private $location;

  /**
   * @ORM\Column(type="integer")
   */
  private $size;

  /**
   * @ORM\Column(type="string")
   */
  private $interestedIn;

  /**
   * @ORM\Column(type="string")
   */
  private $experience;

  /**
   * @ORM\Column(type="string")
   */
  private $technologies;

  /**
   * @ORM\Column(type="string")
   */
  private $vacancies;

  /**
   * @ORM\Column(type="text")
   */
  private $blurb;

  /**
   * @ORM\ManyToMany(targetEntity="Company", mappedBy="endorsing")
   */
  private $endorsers;

  /**
   * @ORM\ManyToMany(targetEntity="Company", inversedBy="endorsers")
   * @ORM\JoinTable(name="endorsers",
   *    joinColumns={@ORM\JoinColumn(name="company_id", referencedColumnName="id")},
   *    inverseJoinColumns={@ORM\JoinColumn(name="endorsing_user_id", referencedColumnName="id")}
   * )
   */
  private $endorsing;

  /**
   * Create a new company
   *
   * @param CompanyId $companyId
   * @param Title $title
   * @param YearStarted $yearStarted
   * @param Url $url
   * @param Email $email
   * @param Location $location
   * @param Size $size
   * @param InterestedIn $interestedIn
   * @param Experience $experience
   * @param Technologies $technologies
   * @param Vacancies $vacancies
   * @param Blurb $blurb
   * @return void
   */
  private function __construct(CompanyId $companyId, Title $title, YearStarted $yearStarted,
    Url $url, Email $email, Location $location, Size $size, InterestedIn $interestedIn,
    Experience $experience, Technologies $technologies, Vacancies $vacancies,
    Blurb $blurb)
  {

    $this->setId($companyId);
    $this->setTitle($title);
    $this->setYearStarted($yearStarted);
    $this->setUrl($url);
    $this->setEmail($email);
    $this->setLocation($location);
    $this->setSize($size);
    $this->setInterestedIn($interestedIn);
    $this->setExperience($experience);
    $this->setTechnologies($technologies);
    $this->setVacancies($vacancies);
    $this->setBlurb($blurb);

    $this->endorsers = new ArrayCollection;
    $this->endorsing = new ArrayCollection;

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
  public static function register(CompanyId $companyId, Title $title, YearStarted $yearStarted,
    Url $url, Email $email, Location $location, Size $size, InterestedIn $interestedIn,
    Experience $experience, Technologies $technologies, Vacancies $vacancies,
    Blurb $blurb)
  {
    $company = new Company($companyId, $title, $yearStarted,
                           $url, $email, $location, $size, $interestedIn, 
                           $experience, $technologies, $vacancies,
                           $blurb);

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

  /**
   * Get the Company's URL
   *
   * @return Url
   */
  public function url()
  {
    return Url::fromNative($this->url);
  }

  /**
   * Set the Company's URL
   *
   * @param Url $url
   * @return void
   */
  private function setUrl(Url $url)
  {
    $this->url = $url->toString();
  }

  /**
   * Get the Company's email
   *
   * @return Email
   */
  public function email()
  {
    return Email::fromNative($this->email);
  }

  /**
   * Set the Company's email
   *
   * @param Email $email
   * @return void
   */
  private function setEmail(Email $email)
  {
    $this->email = $email->toString();
  }

  /**
   * Get the Company's location
   *
   * @return Location
   */
  public function location()
  {
    return Location::fromNative($this->location);
  }

  /**
   * Set the Company's Location
   *
   * @param Location $location
   * @return void
   */
  private function setLocation(Location $location)
  {
    $this->location = $location->toString();
  }

  /**
   * Get the Company's size
   *
   * @return Size
   */
  public function size()
  {
    return Size::fromNative($this->size);
  }

  /**
   * Set the Company's size
   *
   * @param Size $size
   * @return void
   */
  private function setSize(Size $size)
  {
    $this->size = $size->toInteger();
  }

  /**
   * Get the Company's interested in
   *
   * @return InterestedIn $interestedIn
   */
  public function interestedIn()
  {
    return InterestedIn::fromNative($this->interestedIn);
  }

  /**
   * Set the Company's interested in
   *
   * @param InterestedIn $interestedIn
   * @return void
   */
  private function setInterestedIn(InterestedIn $interestedIn)
  {
    $this->interestedIn = $interestedIn->toString();
  }

  /**
   * Get the Company's experience
   *
   * @return Experience
   */
  public function experience()
  {
    return Experience::fromNative($this->experience);
  }

  /**
   * Set the Company's experience
   *
   * @param Experience $experience
   * @return void
   */
  private function setExperience(Experience $experience)
  {
    $this->experience = $experience->toString();
  }

  /**
   * Get the Company's technologies
   *
   * @return Technologies
   */
  public function technologies()
  {
    return Technologies::fromNative($this->technologies);
  }

  /**
   * Set the Company's technologies
   *
   * @param Technologies $technologies
   * @return void
   */
  private function setTechnologies(Technologies $technologies)
  {
    $this->technologies = $technologies->toString();
  }

  /**
   * Get the Company's vacancies
   *
   * @return Vacancies
   */
  public function vacancies()
  {
    return Vacancies::fromNative($this->vacancies);
  }

  /**
   * Set the Company's Vacancies
   *
   * @param Vacancies $vacancies
   * @return void
   */
  private function setVacancies(Vacancies $vacancies)
  {
    $this->vacancies = $vacancies->toString();
  }

  /**
   * Get the Company's blurb
   *
   * @return Blurb
   */
  public function blurb()
  {
    return Blurb::fromNative($this->blurb);
  }

  /**
   * Set the Company's blurb
   *
   * @param Blurb $blurb
   * @return void
   */
  private function setBlurb(Blurb $blurb)
  {
    $this->blurb = $blurb->toString();
  }

  /**
   * Endorse another Company
   *
   * @param Company $company
   * @return void
   */
  public function endorse(Company $company)
  {
    if (!$this->endorsing->contains($company))
    {
      $this->endorsing[] = $company;

      $company->endorsedBy($this);
    }
  }

  /**
   * Return the Companies that this Company has endorsed
   *
   * @return ArrayCollection
   */
  public function endorsing()
  {
    return $this->endorsing;
  }

  /**
   * Return the Companies endorsing this Company
   *
   * @return ArrayCollection
   */
  public function endorsers()
  {
    return $this->endorsers;
  }

  /**
   * Acknowledge endorsement by another Company
   *
   * @param Company $company
   * @return void
   */
  private function endorsedBy(Company $company)
  {
    $this->endorsers[] = $company;
  }

  /**
   * Remove endorsement of another Company
   *
   * @param Company $company
   * @return void
   */
  public function unendorse(Company $company)
  {
    $this->endorsing->removeElement($company);

    $company->unendorsedBy($this);
  }

  /**
   * Acknowledge removal of endorsement by another Company
   *
   * @param Company $company
   * @return void
   */
  public function unendorsedBy(Company $company)
  {
    $this->endorsers->removeElement($company);
  }
}
