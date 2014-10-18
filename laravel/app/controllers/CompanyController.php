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
    $offset = Input::get('offset');
    $limit = Input::get('limit');

    if (empty(Input::get('query')))
    {
      $companies = $this->companyRepository->findAll($limit);
    }
    else
    {
      $companies = $this->companyRepository->companiesByTitleSubstring(Input::get('query'), (int)$limit, (int)$offset);
    }

    $count = count($companies);

    $displayLimit = Config::get('onii.company_count_display_limit');
    if ($displayLimit)
      $companies = array_slice($companies, 0, $displayLimit);

    $html = View::make('companies.index')->with('companies', $companies)->render();

    return Response::json(array(
      "count" => $count,
      "html" => $html
    ));
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
