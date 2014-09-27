<?php namespace OniiChan\Tests\Domain\Model\Company;

use OniiChan\Domain\Model\Company\Title;

class TitleTest extends \PHPUnit_Framework_TestCase
{
  /** @test */
  public function should_require_title()
  {
    $this->setExpectedException('Exception');
    $title = new Title;
  }

  /** @test */
  public function should_require_valid_title()
  {
    $this->setExpectedException('Exception');
    $title = new Title('===');
  }

  /** @test */
  public function should_accept_valid_title()
  {
    $title = new Title('Flax & Teal Limited');
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Title', $title);
  }

  /** @test */
  public function should_create_from_native()
  {
    $title = Title::fromNative('Flax & Teal Limited');

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Title', $title);
  }

  /** @test */
  public function should_test_equality()
  {
    $one   = new Title('Flax & Teal Limited');
    $two   = new Title('Flax & Teal Limited');
    $three = new Title('Bongo Components Plc');

    $this->assertTrue($one->equals($two));
    $this->assertFalse($one->equals($three));
  }

  /** @test */
  public function should_return_as_string()
  {
    $title = new Title('Flax & Teal Limited');

    $this->assertEquals('Flax & Teal Limited', $title->toString());
  }
}
