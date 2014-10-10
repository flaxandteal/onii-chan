<?php

use Doctrine\ORM\EntityManagerInterface;
use OniiChan\Application\CommandBus;
use OniiChan\Domain\Model\Company\CompanyRepository;
use OniiChan\Domain\Model\Company\CompanyId;

class CompanyController extends Controller
{
  protected $commandBus;

  public function __construct(CommandBus $commandBus, CompanyRepository $companyRepository)
  {
    $this->commandBus = $commandBus;
    $this->companyRepository = $companyRepository;
  }

  public function index()
  {
    $companies = $this->companyRepository->findAll();

    return View::make('companies.index')->with('companies', $companies);
  }

  public function create()
  {
  }

  public function store()
  {
    $input = Input::only('title', 'yearStarted');

    $command = new RegisterCompanyCommand($input['title']. $input['yearStarted']);

    $this->commandBus->execute($command);
  }

  public function show($id)
  {
    $uuid = CompanyId::fromString($id);

    $company = $this->companyRepository->companyOfId($uuid);

    return View::make('companies.show')->with('company', $company);
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
