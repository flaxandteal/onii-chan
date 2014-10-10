<?php namespace OniiChan\Application;

use OniiChan\Application\Command;

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
