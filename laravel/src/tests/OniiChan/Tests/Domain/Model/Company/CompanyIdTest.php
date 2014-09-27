<?php namespace OniiChan\Tests\Domain\Model\Company;

use Rhumsaa\Uuid\Uuid;
use OniiChan\Domain\Model\Company\CompanyId;

class CompanyIdTest extends \PHPUnit_Framework_TestCase
{
  /** @test */
  public function should_require_instance_of_uuid()
  {
    $this->setExpectedException('Exception');

    $id = new CompanyId;
  }

  /** @test */
  public function should_create_new_company_id()
  {
    $id = new CompanyId(Uuid::uuid4());

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\CompanyId', $id);
  }

  /** @test */
  public function should_generate_new_company_id()
  {
    $id = CompanyId::generate();

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\CompanyId', $id);
  }

  /** @test */
  public function should_create_user_id_from_string()
  {
    $id = CompanyId::fromString('32f840fc-bcef-45d9-a091-887e30441ada');

    $this->assertInstanceOf('OniiChan\Domain\Model\Company\CompanyId', $id);
  }

  /** @test */
  public function should_test_equality()
  {
    $one   = CompanyId::fromString('32f840fc-bcef-45d9-a091-887e30441ada');
    $two   = CompanyId::fromString('32f840fc-bcef-45d9-a091-887e30441ada');
    $three = CompanyId::generate();

    $this->assertTrue($one->equals($two));
    $this->assertFalse($one->equals($three));
  }

  /** @test */
  public function should_return_company_id_as_string()
  {
    $id = CompanyId::fromString('32f840fc-bcef-45d9-a091-887e30441ada');

    $this->assertEquals('32f840fc-bcef-45d9-a091-887e30441ada', $id->toString());
  }
}
