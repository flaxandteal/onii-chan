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
   * Find a Company by its title
   *
   * @param Title $title
   * @return Company
   */
  public function companyOfTitle(Title $title);

  /**
   * Find a Company by its ID
   *
   * @param CompanyId $id
   * @return Company
   */
  public function companyOfId(CompanyId $id);

  /**
   * Find all companies
   *
   * @param integer $limit
   * @return array(Company)
   */
  public function findAll($limit = null);

  /**
   * Find companies whose title contains a search-string
   *
   * @param string $substring
   * @param integer $limit
   * @param integer $offset
   * @return array(Company)
   */
  public function companiesByTitleSubstring($substring, $limit, $offset);
}
