<?php namespace OniiChan\Tests\Application\Company;

use stdClass;
use OniiChan\Application\Company\CompanyPresenter;

class PresenterTestFoo {
  public function foo() { return 'bar'; }
}

class PresenterTest extends \PHPUnit_Framework_TestCase
{
  /** @test */
  public function should_wrap_get()
  {
    $object = new PresenterTestFoo;

    $presenter = new CompanyPresenter();

    $presenter->set($object);

    $this->assertEquals($presenter->foo(), $object->foo());
  }
}
