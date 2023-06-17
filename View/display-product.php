<!DOCTYPE html>
<html lang="en">

<?php
require_once('partial\header.php');
?>

<body>
<br/>
  <div class="container">

  <div class="row border-bottom pb-3 mb-3">  

<div class="col">
  <h4>Product List</h4>
</div>

<div class="col-md-auto"> 
    <a href="/add-product" class="btn btn-outline-success my-2 my-sm-0">ADD</a>
</div>

<div class="col col-lg-2">
    <button class="btn btn-danger" type="submit" form="deleteForm" id="delete-product-btn">MASS DELETE</button>
</div>

</div>
<main>

<form id="deleteForm" action="/index.php" method="post">
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col-sm-3 pb-4">
                    <div class="card product-card">
                        <div class="card-body">
                            <label>
                                <input type="checkbox" class="delete-checkbox"
                                       name="sku[]"
                                       value="<?php echo $product->getSku(); ?>">
                            </label>
                            <div class="product-card-body-center text-center">
                                <p class="product-card-text"><?php echo $product->getSku(); ?></p>
                                <p class="product-card-text"><?php echo $product->getName(); ?></p>
                                <p class="product-card-text"><?php echo $product->getPrice() . ' $'; ?></p>
                                <p class="product-card-text"><?php echo $product->getDimension(); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </form>

</main>

<?php require_once('partial\footer.php'); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>