<?php

declare(strict_types=1);

namespace Core;

use Model\{Book, Dvd, Furniture};

class ModelCreator 
{
  public function __construct() 
  {
      
  }

  public function createModel($input): Dvd|Book|Furniture
  {
    //additional arguments
    $classArguments = [
      Dvd::class => ['size'],
      Book::class => ['weight'],
      Furniture::class => ['height', 'width', 'length']
    ];
    
    $productClass = 'Model\\'.ucfirst($input['productType']);

    $argsList = $classArguments[$productClass];
    $arguments = [];
    foreach ($argsList as $argument) {
      $arguments [] = floatval($input[$argument]); 
    }

    $price = floatval($input['price']);
   
    try {
     $product = new $productClass($input['name'], $input['sku'], $price, $input['productType'], ...$arguments);
     $product->setName($input['name']);
     $product->setSku($input['sku']);
     $product->setPrice($price);
     $product->setType($input['productType']);
     foreach ($argsList as $index => $argument) {
        $setter = 'set' . ucfirst($argument);
        $product->$setter($arguments[$index]);
      }
     return $product;
    } catch (\Throwable $e) {
      throw new \Exception('Internal error: ' . $e->getMessage());
      exit;
    }
  }
}

  
    

