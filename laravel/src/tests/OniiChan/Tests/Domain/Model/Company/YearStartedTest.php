<?php namespace OniiChan\Tests\Domain\Model\YearStarted;

use Rhumsaa\Uuid\Uuid;
use OniiChan\Domain\Model\Company\YearStarted;

class YearStartedTest extends \PHPUnit_Framework_TestCase
{
  /** @test */
  public function should_require_instance_of_integer()
  {
    $this->setExpectedException('Exception');

    $id = new YearStarted;
  }

  /** @test */
  public function should_require_year_before_current()
  {
    $this->setExpectedException('Exception');

    $id = new YearStarted(2113);
  }

  /** @test */
  public function should_require_year_since_1500()
  {
    $this->setExpectedException('Exception');

    $id = new YearStarted(1435);
  }

  /** @test */
  public function should_create_new_year_started()
  {
    $id = new YearStarted(2013);

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\YearStarted', $id);
  }

  /** @test */
  public function should_create_year_from_string()
  {
    $id = YearStarted::fromNative(2012);

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\YearStarted', $id);
  }

  /** @test */
  public function should_test_equality()
  {
    $one   = YearStarted::fromNative(2013);
    $two   = YearStarted::fromNative(2013);
    $three = YearStarted::fromNative(2012);

    $this->assertTrue($one->equals($two));
    $this->assertFalse($one->equals($three));
  }

  /** @test */
  public function should_return_year_started_as_string()
  {
    $id = new YearStarted(2013);

    $this->assertEquals(2013, $id->toInteger());
  }
}
