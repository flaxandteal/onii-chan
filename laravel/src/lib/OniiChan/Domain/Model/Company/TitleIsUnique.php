<?php namespace OniiChan\Domain\Model\Company;

class TitleIsUnique implements TitleSpecification
{
  /**
   * @var CompanyRepository
   */
  private $repository;

  /**
   * Create a new instance of the CompanyIsUnique specification
   *
   * @param CompanyRepository $repository
   */
  public function __construct(CompanyRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Check to see if the specification is satisfied
   *
   * @param Title $title
   * @return bool
   */
  public function isSatisfiedBy(Title $title)
  {
    if (! $this->repository->companyOfTitle($title)) {
      return true;
    }

    return false;
  }
}
