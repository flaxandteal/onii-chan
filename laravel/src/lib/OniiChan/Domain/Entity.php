<?php namespace OniiChan\Domain;

interface Entity
{
  /**
   * Return an Entity identifier
   *
   * @return Identifier
   */
  public function id();
}
