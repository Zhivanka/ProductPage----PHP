<?php

declare(strict_types=1);

namespace Model;

use Model\Product;

class Book extends Product 
{
  private float $weight;

  public function __construct(string $name, string $sku, float $price, string $productType, float $weight) 
  {
    parent::__construct($name, $sku, $price, $productType);
    $this->weight = $weight;
  }

  public function getWeight(): float
  {
    return $this->weight;
  }

  public function setWeight(float $weight): void
  {
    $this->weight = $weight;
  }

  public function getDimension(): string
  {
    return 'Weight: '.$this->weight. ' KG';
  }

  public function getTableFields(): array
  {
    return ['weight'];
  }
}



