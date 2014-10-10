<?php namespace OniiChan\Domain\Model\Company;

use Assert\Assertion;
use OniiChan\Domain\ValueObject;

class YearStarted implements ValueObject
{
  /**
    * @var integer
   */
  protected $value;

  /**
   * Create a new Year Started
   *
   * @param integer $value
   * @return void
   */
  public function __construct($value)
  {
    Assertion::integer($value);
    Assertion::true($value > 1500 && $value <= date("Y"));

    $this->value = $value;
  }

  /**
   * Create a new instance from an integer
   *
   * @param mixed $native
   * @return ValueObject
   */
  public static function fromNative($integer)
  {
    return new YearStarted($integer);
  }

  /**
   * Determine equality with another Value Object
   *
   * @param ValueObject $object
   * @return bool
   */
  public function equals(ValueObject $object)
  {
    return $this == $object;
  }

  /**
   * Return the object as a string
   *
   * @return string
   */
  public function toInteger()
  {
    return $this->value;
  }

  /**
   * Return the object as a string
   *
   * @return string
   */
  public function __toString()
  {
    return (string)$this->value;
  }
}
