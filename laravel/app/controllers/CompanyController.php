<?php

use Doctrine\ORM\EntityManagerInterface;
use OniiChan\Application\CompanyBus;

class CompanyController extends Controller
{
  protected $commandBus;

  public function __construct(CommandBus $commandBus);
  {
    $this->commandBus = $companyRepository;
  }

  public function index()
  {
  }

  public function create()
  {
  }

  public function store()
  {
    $input = Input::only('title', 'yearStarted');

    new RegisterCompanyCommand($input['title']. $input['yearStarted']);

    $this->commandBus->execute($command);
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
