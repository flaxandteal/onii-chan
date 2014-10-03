<?php namespace OniiChan\Application;

use Excpetion;

class CommandTranslator {

  public function toCommandHandler($command)
  {
    $handler = str_replace('Command', 'CommandHandler', get_class($command));

    if ( ! class_Exists($handler))
    {
      $message = "Command handler [$handler] does not exist.";

      throw new Exception($message);
    }

    return $handler;
  }
}
