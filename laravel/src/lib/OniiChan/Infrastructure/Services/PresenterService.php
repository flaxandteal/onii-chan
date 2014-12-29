<?php namespace OniiChan\Infrastructure\Services;

use OniiChan\Application\Presentable;
use OniiChan\Domain\AggregateRoot;

class PresenterService
{
  /**
   * Return an instance of an AggregateRoot wrapped
   * in a presenter object
   *
   * @param AggregateRoot $model
   * @param Presentable $presenter
   * @return AggregateRoot
   */
  public function model(AggregateRoot $model, Presentable $presenter)
  {
    $object = clone $presenter;

    $object->set($model);

    return $object;
  }

  /**
   * Return an instance of a Collection with each value
   * wrapped in a presenter object
   *
   * @param array $collection
   * @param Presentable $presenter
   */
  public function collection(array $collection, Presentable $presenter)
  {
    foreach ($collection as $key => $value)
    {
      $collection[$key] = $this->model($value, $presenter);
    }

    return $collection;
  }

  //TODO: Culttt includes a paginator processor
}
