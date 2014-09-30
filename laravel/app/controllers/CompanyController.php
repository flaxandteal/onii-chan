<?php

use Doctrine\ORM\EntityManagerInterface;
use OniiChan\Domain\Model\Company\CompanyRepository;

class CompanyController extends Controller
{
  private $entityManager;

  public function __construct(CompanyRepository $companyRepository)
  {
    $this->companyRepository = $companyRepository;
  }

  public function index()
  {
  }

  public function create()
  {
  }

  public function store()
  {
    
  }

  public function show($id)
  {
    return "LALALALA";
  }

  public function edit($id)
  {
  }

  public function update($id)
  {
  }

  public function destroy($id)
  {
  }
}
