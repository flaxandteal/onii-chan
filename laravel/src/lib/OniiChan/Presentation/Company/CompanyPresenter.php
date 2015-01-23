<?php namespace OniiChan\Presentation\Company;

use OniiChan\Presentation\AbstractPresenter;
use OniiChan\Presentation\Presentable;
use OniiChan\Domain\Model\Company\Company;

class CompanyPresenter extends AbstractPresenter implements Presentable
{
  /**
   * Inject the object to be presented, ensuring the
   * object is of the correct type
   *
   * @param mixed
   */
  public function set(Company $company)
  {
    $this->set_internal($company);
  }

  /**
   * Return the count of endorsements for this Company
   *
   * @retval integer
   */
  public function endorsements()
  {
    return $this->object->endorsers()->count();
  }
}
