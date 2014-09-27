<?php namespace OniiChan\Domain\Model\Company;

interface TitleSpecification
{
  /**
   * Check to see if the specification is satisfied
   *
   * @return bool
   */
  public function isSatisfiedBy(Title $title);
}
