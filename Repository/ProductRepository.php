<?php

declare(strict_types=1);

namespace Repository;

use PDO;
use PDOException;
use Model\Product;
use Core\{ModelCreator, ViewCreator};
use Database\Database;

Class ProductRepository 
{
  private Database $pdo;

  public function __construct(Database $pdo)
  {
    $this->pdo = $pdo;
  }

  //get products from the DB
  public function getProducts(): array
  {
   $query = "SELECT sku, name, price, productType, size, weight, height, width, length FROM product 
   LEFT JOIN dvd ON product.id = dvd.product_id 
   LEFT JOIN book ON product.id = book.product_id 
   LEFT JOIN furniture ON product.id = furniture.product_id 
   WHERE dvd.product_id IS NOT NULL OR book.product_id IS NOT NULL OR furniture.product_id IS NOT NULL 
   ORDER BY product.id ASC";

   $stmt = $this->pdo->prepare($query);
   $stmt->execute();
   
   $products = [];
   $model = new ModelCreator();
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $product=$model->createModel($row);
     $products[] = $product; 
    }
    return $products;
  }

  //DELETE products from the DB
  public function delete(): void
  { 
   if($_SERVER['REQUEST_METHOD'] === 'POST') {
     $selectedProducts = $_POST['sku'];
     
     if(!empty($selectedProducts)) {
        $this->pdo->beginTransaction();
        try {
         $skuList = implode(',', array_fill(0, count($selectedProducts), '?'));
         $stmt = $this->pdo->prepare("DELETE FROM product WHERE sku IN ($skuList)");
         $stmt->execute($selectedProducts);
         $this->pdo->commit();
        } catch(PDOException $e) {
         $this->pdo->rollBack();
         ViewCreator::render('View/exceptions/internal-error.php',[]);
         exit;
        }
      }
    }
  
  }

  //SAVE products to DB
  public function save(Product $productObj): void
  {
    $this->pdo->beginTransaction();
    try {
     if (!$this->checkDuplicate($productObj->getSku())) {
       $message = "Error: SKU already exists";
       include("View/exceptions/error.php");
       exit;
      }

      $stmt = $this->pdo->prepare("INSERT INTO product (name, sku, price, productType) VALUES (?, ?, ?, ?)");
      $stmt->execute([$productObj->getName(), $productObj->getSku(), $productObj->getPrice(), $productObj->getType()]);

      $productId = $this->pdo->lastInsertId();
      $childTable = $productObj->getType();
      $childFields = $productObj->getTableFields();

      $stmtChild = $this->pdo->prepare("INSERT INTO $childTable 
      (product_id, " . implode(',', $childFields) . ") 
      VALUES (?" . str_repeat(',?', count($childFields)) . ")");
      $childValues = array_merge([$productId], 
      
      array_map(function($field) use ($productObj) 
      { return $productObj->{'get' . ucfirst($field)}(); }, $childFields));
      $stmtChild->execute($childValues);
      $this->pdo->commit();
    } catch (PDOException $e) {
      $this->pdo->rollBack();
      ViewCreator::render('View/exceptions/internal-error.php',[]);
      exit;
    }
  }

  //check duplicate SKU in DB
  public function checkDuplicate(string $sku): bool
  {
    $stmtSKU = $this->pdo->prepare("SELECT * FROM product WHERE sku = ?");
    $stmtSKU->execute([$sku]);
    $row = $stmtSKU->fetch(PDO::FETCH_ASSOC);
    return ($row === false);
  }
}