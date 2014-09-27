<?php namespace OniiChan\Domain;

use BigName\EventDispatcher\Event;

trait HasEvents
{
  /**
   * @var array
   */
  private $events;

  /**
   * Record that an event has occurred
   *
   * @param Event $event
   * @return void
   */
  public function record(Event $event)
  {
    $this->events[] = $event;
  }

  /**
   * Release the pending events
   *
   * @return array
   */
  public function release()
  {
    $events = $this->events;

    $this->events = [];

    return $events;
  }
}
