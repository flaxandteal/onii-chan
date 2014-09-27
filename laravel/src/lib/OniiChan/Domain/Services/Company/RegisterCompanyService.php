<?php namespace OniiChan\Domain\Services\Company;

use OniiChan\Domain\Model\Company\Company;
use OniiChan\Domain\Model\Company\Title;
use OniiChan\Domain\Model\Company\YearStarted;
use OniiChan\Domain\Model\Company\TitleIsUnique;
use OniiChan\Domain\Model\Company\CompanyRepository;
use OniiChan\Domain\Model\ValueIsNotUniqueException;

class RegisterCompanyService
{
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
  public function __construct(CompanyRepository $companyRepository)
  {
    $this->companyRepository = $companyRepository;
  }

  /**
   * Register a new Company
   *
   * @param string $title
   * @param integer $yearStarted
   * @return void
   */
  public function register($title, $yearStarted)
  {
    $title       = new Title($title);
    $yearStarted = new YearStarted($yearStarted);

    $this->checkTitleIsUnique($title);

    $id = $this->companyRepository->nextIdentity();

    $company = Company::register($id, $title, $yearStarted);
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
