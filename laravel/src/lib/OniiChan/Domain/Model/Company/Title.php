<?php namespace OniiChan\Domain\Model\Company;

use Assert\Assertion;
use OniiChan\Domain\ValueObject;

class Title implements ValueObject
{
  /**
   * @var string
   */
  private $value;

  /**
   * Create a new username
   *
   * @param string $username
   * @return void
   */
  public function __construct($value)
  {
    Assertion::regex($value, '/^[\pL\pM\pN\pZ\pP]+$/u');

    $this->value = $value;
  }

  /**
   * Return the object as a string
   *
   * @return string
   */
  public function __toString()
  {
    return $this->value;
  }

  /**
   * Create a new instance from a native form
   *
   * @param mixed $native
   * @return ValueObject
   */
  public static function fromNative($native)
  {
    return new Title($native);
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
  public function toString()
  {
    return $this->value;
  }
}
