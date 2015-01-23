<?php

use Doctrine\ORM\EntityManagerInterface;
use OniiChan\Application\CommandBus;
use OniiChan\Domain\Model\Company\CompanyRepository;
use OniiChan\Domain\Model\Company\CompanyId;
use OniiChan\Presentation\Company\CompanyPresenter;
use OniiChan\Presentation\Services\PresenterService;

class CompanyController extends Controller
{
  protected $commandBus;

  public function __construct(CommandBus $commandBus, CompanyRepository $companyRepository,
    PresenterService $presenterService, CompanyPresenter $companyPresenter)
  {
    $this->commandBus = $commandBus;
    $this->companyRepository = $companyRepository;
    $this->presenterService = $presenterService;
    $this->companyPresenter = $companyPresenter;
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

    $companies = $this->presenterService->collection($companies, $this->companyPresenter);

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

    $company = $this->presenterService->model($company, $this->companyPresenter);

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
