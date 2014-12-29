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
    $title        = $command->title();
    $yearStarted  = $command->yearStarted();
    $url          = $command->url();
    $email        = $command->email();
    $location     = $command->location();
    $size         = $command->size();
    $interestedIn = $command->interestedIn();
    $experience   = $command->experience();
    $technologies = $command->technologies();
    $vacancies    = $command->vacancies();
    $blurb        = $command->blurb();

    $this->registerCompanyService->register(
      $title,
      $yearStarted,
      $url,
      $email,
      $location,
      $size,
      $interestedIn,
      $experience,
      $technologies,
      $vacancies,
      $blurb
    );
  }
}
