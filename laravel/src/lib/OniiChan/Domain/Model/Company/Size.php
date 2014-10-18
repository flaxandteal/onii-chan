<?php namespace OniiChan\Domain\Model\Company;

use Assert\Assertion;
use OniiChan\Domain\ValueObject;

class Size implements ValueObject
{
  /**
    * @var integer
   */
  protected $value;

  /**
   * Create a new Size
   *
   * @param integer $value
   * @return void
   */
  public function __construct($value)
  {
    Assertion::integer($value);

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
    return new Size($integer);
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
