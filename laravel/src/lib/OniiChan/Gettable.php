<?php namespace OniiChan;

trait Gettable
{
  /**
   * Get the private information
   *
   * @param string $key
   * @return mixed
   */
  public function __get($key)
  {
    if (property_exists($this, $key)) {
      return $this->$key;
    }
  }
}
