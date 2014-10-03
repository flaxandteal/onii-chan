<?php namespace OniiChan\Application;

class CommandBus
{
  /**
   * @var CommandTranslator
   *
   * @param CommandTranslator $commandTranslator
   * @return void
   */
  protected $commandTranslator;

  /**
   * @var Container
   */
  private $container;

  /**
   * Create a new CommandBus
   *
   * @param Container $container
   * @return void
   */
  public function __construct(Container $container, CommandTranslator $commandTranslator)
  {
    $this->container = $container;
    $this->commandTranslator = $commandTranslator;
  }

  /**
   * Execute a Command by passing it to a Handler
   *
   * @param Command $command
   * @return void
   */
  public function execute(Command $command)
  {
    $handler = $this->comandTranslator->toCommandHandler($command);

    return $container->make($handler)->handle($command);
  }
}
