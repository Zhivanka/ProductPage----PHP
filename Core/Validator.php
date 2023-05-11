<?php

declare(strict_types=1);

namespace Core;

class Validator 
{
  private array $rules;

  public function __construct($rules) 
  {
    $this->rules = $rules;
  }

  public function validate(array $input): array
  {
    $errors = [];
    $visibleFields = [];
    $productTypeFields = [
      'dvd' => ['sku', 'name', 'price', 'productType', 'size'],
      'book' => ['sku', 'name', 'price', 'productType', 'weight'],
      'furniture' => ['sku', 'name', 'price', 'productType', 'height', 'width', 'length'],
    ];
    
    $productType = $input['productType'] ?? '';
    
    $visibleFields = $productTypeFields[$productType] ?? [];

    if(empty($visibleFields)) {
     $errors[][]='Please provide required data';
     return $errors;} else {
      foreach ($this->rules as $field => $rule) {

       $required = $rule['required'] ?? false;
       $pattern = $rule['pattern'] ?? null;

       if (in_array($field, $visibleFields)) {
         if ($required && empty($input[$field])) {
           $errors[$field][] = 'Please provide required data';
          } 
     
         if ($pattern && !preg_match($pattern, $input[$field])) {
           $errors[$field][] = 'Please provide data of indicated type';
          }
        }
      }
      return $errors;
    }
  }
}