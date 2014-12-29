<?php namespace OniiChan\Tests\Domain\Model\Company;

use OniiChan\Domain\Model\Company\Blurb;

class BlurbTest extends \PHPUnit_Framework_TestCase
{
  /** @test */
  public function should_require_blurb()
  {
    $this->setExpectedException('Exception');
    $blurb = new Blurb;
  }

  /** @test */
  public function should_require_valid_blurb()
  {
    $this->setExpectedException('Exception');
    $sample = 'asdf ';
    $blurb = '';
    for ($i = 0 ; $i < 3000 / strlen($sample) ; $i++)
      $blurb .= $sample;

    $blurb = new Blurb($blurb);
  }

  /** @test */
  public function should_accept_valid_blurb()
  {
    $blurb = new Blurb($this->createBlurb());
    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Blurb', $blurb);
  }

  /** @test */
  public function should_create_from_native()
  {
    $blurb = Blurb::fromNative($this->createBlurb());

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\Blurb', $blurb);
  }

  /** @test */
  public function should_test_equality()
  {
    $one   = new Blurb($this->createBlurb());
    $two   = new Blurb($this->createBlurb());
    $three = new Blurb('Bongo Components Plc');

    $this->assertTrue($one->equals($two));
    $this->assertFalse($one->equals($three));
  }

  /** @test */
  public function should_return_as_string()
  {
    $title = new Blurb('Flax & Teal Limited');

    $this->assertEquals('Flax & Teal Limited', $title->toString());
  }

  private function createBlurb()
  {
    return
<<<ENDBLURB
      Flax & Teal is a Belfast-based contracting company. In-house experience 
      in web development, engineering and mathematics. interested in 
      collaborations oriented around numerical analysis or web solutions.

      The company is focused on developing European links with international 
      Commonwealth projects, and Northern Ireland internal collaboration.
ENDBLURB;
  }
}
