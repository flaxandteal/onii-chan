<?php namespace OniiChan\Domain\Model\Company;

use Rhumsaa\Uuid\Uuid;
use OniiChan\Domain\Identifier;
use OniiChan\Domain\UuidIdentifier;

class CompanyId extends UuidIdentifier implements Identifier
{
  /**
   * @var Uuid
   */
  protected $value;

  /**
   *
   * @return void
   */
  public function __construct(Uuid $value)
  {
    $this->value = $value;
  }
}
