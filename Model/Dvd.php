<?php

declare(strict_types=1);

namespace Model;

use Model\Product;

class Dvd extends Product 
{
  private float $size;

  public function __construct(string $name, string $sku, float $price, string $productType, float $size) 
  {
    parent::__construct( $name, $sku, $price, $productType);
    $this->size = $size;
  }

  public function getSize(): float
  {
    return $this->size;
  }
  
  public function setSize(float $size): void
  {
    $this->size = $size;
  }

  public function getDimension(): string
  {
    return 'Size: '.$this->size.' MB';
  }


  public function getTableFields(): array
  {
    return ['size'];
  }
  
}




