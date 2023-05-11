<?php

declare(strict_types=1);

namespace Controller;

use Repository\ProductRepository;
use Core\{Validator, ModelCreator, ViewCreator};
use JsonException;

class ProductController
{
    //all the validation data is imported as const from json file
    private const RULES_FILE_PATH = 'json/validation-rules.json';
    private $repository;
    
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    //display product
    public function index(): void
    {   
        $products = $this->repository->getProducts();
        ViewCreator::render('View/display-product.php', ['products' => $products]); 
    }

    //create product on submit form
    public function create($input): void
    {
        //1.validate
        try {
        $rules = json_decode(file_get_contents(self::RULES_FILE_PATH), true);
        } catch (JsonException $e){
            echo $e;
        }
        $validator = new Validator($rules);
        $errors = $validator->validate($input);
        if (!empty($errors)) {
            ViewCreator::render('View/exceptions/internal-error.php',[]);
            exit;
        }
        
         //2.create model
         $model = new ModelCreator();
         $product=$model->createModel($input);

         //3.save the product
         $this->repository->save($product);
        
         //4. redirect to view
         header('Location: index.php');
        exit;
    
    }

    //delete product
    public function delete(): void
    {
        $this->repository->delete();
        header('Location: index.php');
        exit;
    }

    //show add-product page
    public function add(): void
    {
        ViewCreator::render('View/add-product.php',[]);
    }      
}
