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
   * Find a Company by its title
   *
   * @param Title $title
   * @return Company
   */
  public function companyOfTitle(Title $title)
  {
    return $this->em->getRepository($this->class)->findOneBy([
      'title' => $title->toString()
    ]);
  }

  /**
   * Find a Company by its ID
   *
   * @param CompanyId $id
   * @return Company
   */
  public function companyOfId(CompanyId $id)
  {
    return $this->em->getRepository($this->class)->findOneBy([
      'id' => $id->toString()
    ]);
  }

  /**
   * Find all companies
   *
   * @param integer $limit
   * @return array(Company)
   */
  public function findAll($limit = null)
  {
    if ($limit && is_integer($limit))
    {
      return $this->em->getRepository($this->class)
        ->findBy(array(), null, $limit);
    }

    return $this->em->getRepository($this->class)->findAll();
  }

  /**
   * Find companies whose title contains a search-string
   *
   * @param string $substring
   * @param integer $limit
   * @param integer $offset
   * @return array(Company)
   */
  public function companiesByTitleSubstring($substring, $limit = null, $offset = null)
  {
    $queryBuilder = $this->em->getRepository($this->class)->createQueryBuilder('c');
    $query = $queryBuilder
      ->where('c.title LIKE :substring')
      ->setParameter('substring', '%' . $substring . '%');

    if ($limit && is_integer($limit))
    {
      $query = $query->setMaxResults($limit);

      if ($offset && is_integer($offset))
        $query = $query->setFirstResult($offset);
    }

    return $query->getQuery()->getResult();
  }
}
