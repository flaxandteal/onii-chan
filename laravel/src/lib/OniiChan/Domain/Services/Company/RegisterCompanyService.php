<?php namespace OniiChan\Domain\Services\Company;

use OniiChan\Domain\Model\Company\Company;
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
use OniiChan\Domain\Model\Company\TitleIsUnique;
use OniiChan\Domain\Model\Company\CompanyRepository;
use OniiChan\Domain\Model\ValueIsNotUniqueException;

class RegisterCompanyService
{
  /**
   * @var Company
   */
  private $company;

  /**
   * @var CompanyRepository
   */
  private $companyRepository;

  /**
   * Create a new RegisterCompanyService
   *
   * @param CompanyRepository $companyRepository
   * @return void
   */
  public function __construct(Company $company, CompanyRepository $companyRepository)
  {
    $this->company = $company;
    $this->companyRepository = $companyRepository;
  }

  /**
   * Register a new Company
   *
   * @param string $title
   * @param integer $yearStarted
   * @param string $url;
   * @param string $email;
   * @param string $location;
   * @param integer $size;
   * @param string $interestedIn;
   * @param string $experience;
   * @param string $technologies;
   * @param string $vacancies;
   * @return void
   */
  public function register($title, $yearStarted, $url, $email, $location, $size,
      $interestedIn, $experience, $technologies, $vacancies)
  {
    $title        = new Title($title);
    $yearStarted  = new YearStarted($yearStarted);
    $url          = new Url($url);
    $email        = new Email($email);
    $location     = new Location($location);
    $size         = new Size($size);
    $interestedIn = new InterestedIn($interestedIn);
    $experience   = new Experience($experience);
    $technologies = new Technologies($technologies);
    $vacancies    = new Vacancies($vacancies);

    $this->checkTitleIsUnique($title);

    $id = $this->companyRepository->nextIdentity();

    $company = $this->company->register(
        $id,
        $title,
        $yearStarted,
        $url,
        $email,
        $location,
        $size,
        $interestedIn,
        $experience,
        $technologies,
        $vacancies
    );
    $this->companyRepository->add($company);

    return $company;
  }

  /**
   * Check that a title is unique
   *
   * @param string $title
   * @throws ValueIsNotUniqueException
   * @return void
   */
  private function checkTitleIsUnique(Title $title)
  {
    $specification = new TitleIsUnique($this->companyRepository);

    if (! $specification->isSatisfiedBy($title)) {
      throw new ValueIsNotUniqueException("$title has already been taken.");
    }
  }
}
