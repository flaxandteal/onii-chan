<?php namespace OniiChan\Application\Company;

use OniiChan\Application\Company\Command;

interface Handler
{
  /**
   * Handle a Command object
   *
   * @param Command $command
   * @return void
   */
  public function handle(Command $command);
}
