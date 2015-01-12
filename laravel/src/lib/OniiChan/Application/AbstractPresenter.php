<?php namespace OniiChan\Application;

abstract class AbstractPresenter
{
  /**
   * The object to present
   *
   * @var mixed
   */
  protected $object;

  /**
   * Inject the object to be presented
   *
   * @param mixed
   */
  public function set($object)
  {
    $this->object = $object;
  }

  /**
   * Check to see if there is a presenter
   * method. If not pass to the object
   *
   * @param string $key
   */
  public function __call($key, $arguments)
  {
    if (method_exists($this, $key))
    {
      return call_user_func_array(array($this, $key), $arguments);
    }

    return call_user_func_array(array($this->object, $key), $arguments);
  }
}
