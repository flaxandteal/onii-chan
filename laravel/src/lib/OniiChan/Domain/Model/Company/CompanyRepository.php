<?php namespace OniiChan\Domain\Model\Company;

interface CompanyRepository
{
  /**
   * Return the next identity
   *
   * @return CompanyId
   */
  public function nextIdentity();

  /**
   * Add a new Company
   *
   * @param Company $company
   * @return void
   */
  public function add(Company $company);

  /**
   * Update an existing Company
   *
   * @param Company $company
   * @return void
   */
  public function update(Company $company);

  /**
   * Find a company by their title
   *
   * @param Title $title
   * @return Company
   */
  public function companyOfTitle(Title $title);
}
