<?php namespace OniiChan\Application\Company;

use OniiChan\Application\Command;
use OniiChan\Application\Handler;
use OniiChan\Domain\Services\Company\RegisterCompanyService;

class RegisterCompanyCommandHandler implements Handler {

  /**
   * Domain service for registering a Company
   *
   * @param RegisterCompanyService
   */
  private $registerCompanyService;

  function __construct(RegisterCompanyService $registerCompanyService) {
    $this->registerCompanyService = $registerCompanyService;
  }

  /**
   * Handle the command
   *
   * @param $command
   * @return mixed
   */
  public function handle(Command $command)
  {
    $title = $command->title;
    $yearStarted = $command->yearStarted;
    $this->registerCompanyService->register($title, $yearStarted);
  }
}
