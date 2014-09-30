<?php namespace OniiChan\Infrastructure\Repositories;

use Doctrine\ORM\EntityManager;
use OniiChan\Domain\Model\Company\Company;
use OniiChan\Domain\Model\Company\CompanyId;
use OniiChan\Domain\Model\Company\Title;
use OniiChan\Domain\Model\Company\YearStarted;
use OniiChan\Domain\Model\Company\CompanyRepository;

class CompanyDoctrineORMRepository implements CompanyRepository
{
  /**
   * @var EntityManager
   */
  private $em;

  /**
   * @var string
   */
  private $class;

  /**
   * Create a new CompanyDoctrineORMRepository
   *
   * @param EntityManager $em
   * @return void
   */
  public function __construct(EntityManager $em)
  {
    $this->em = $em;
    $this->class = 'OniiChan\Domain\Model\Company\Company';
  }

  /**
   * Get next free identity
   *
   * @return CompanyId
   */
  public function nextIdentity()
  {
    return CompanyId::generate();
  }

  /**
   * Add a company
   *
   * @param Company $company
   * @return void
   */
  public function add(Company $company)
  {
    $this->em->persist($company);
    $this->em->flush();
  }

  /**
   * Update an existing company
   *
   * @param Company $company
   * @return void
   */
  public function update(Company $company)
  {
    $this->em->persist($company);
    $this->em->flush();
  }

  /**
   * Find a company by its title
   *
   * @param Company $company
   * @return Company
   */
  public function companyOfTitle(Title $title)
  {
    return $this->em->getRepository($this->class)->findOneBy([
      'title' => $title->toString()
    ]);
  }
}
