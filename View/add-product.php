
<!DOCTYPE html>
<html lang="en">

<?php require_once('partial\header.php'); ?>

<body>
<br/>
  <div class="container">

  <div class="row border-bottom pb-3 mb-3">  

<div class="col">
  <h4>Product Add</h4>
</div>

<div class="col-md-auto"> 
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" form="product_form" id="saveButton">Save</button>
</div>

<div class="col col-lg-2">
     <a href="index.php">
    <button class="btn btn-outline-success my-2 my-sm-0" type="" type="button">Cancel</button>
    </a>
</div>

</div>


<form id="product_form" action="/add-product" method="POST">
  <div class="form-group row pb-3 mb-3">
    <label for="sku" class="col-sm-2 col-form-label">SKU</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter SKU">
    </div>
  </div>
  <div class="form-group row pb-3 mb-3">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
    </div>
  </div>
  <div class="form-group row pb-3 mb-3">
    <label for="price" class="col-sm-2 col-form-label">Price ($)</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" step="0.01" id="price" name="price" placeholder="Enter price">
    </div>
  </div>
  <div class="form-group row pb-3 mb-3">
      <label for="type" class="col-sm-2 col-form-label">Type Switcher</label>
      <div class="col-sm-3">
      <select id="productType" class="form-select" name="productType">
        <option selected disabled>Type Switcher</option>
        <option value="dvd">DVD</option>
        <option value="book">Book</option>
        <option value="furniture">Furniture</option>
      </select>
    </div>
</div>
    <div class="form-group row pb-3 mb-3" id="DVD">
    <div class="form-group row pb-3 mb-3">
      <label for="price" class="col-sm-2 col-form-label">Size (MB)</label>
      <div class="col-sm-3">
        <input type="text" id="size" class="form-control" name="size" placeholder="Please enter size">
</div>
    </div>
    <label for="price" class="col-sm-2 col-form-label">Please, provide size</label>
  </div>
  <div class="form-group row pb-3 mb-3" id="Book">
  <div class="form-group row pb-3 mb-3">
      <label for="price" class="col-sm-2 col-form-label">Weight (KG)</label>
      <div class="col-sm-3">
      <input type="text" id="weight" class="form-control" name="weight" placeholder="Please enter weight">
    </div>
</div>
<label for="price" class="col-sm-2 col-form-label">Please, provide weight</label>
  </div>
  <div class="form-group row pb-3 mb-3" id="Furniture">
  <div class="form-group row pb-3 mb-3">
      <label for="price" class="col-sm-2 col-form-label">Height (CM)</label>
      <div class="col-sm-3">
      <input type="text" id="height" class="form-control" name="height" placeholder="Please enter height">
    </div>
</div>
<div class="form-group row pb-3 mb-3">
    <label for="price" class="col-sm-2 col-form-label">Width (CM)</label>
      <div class="col-sm-3">
      <input type="text" id="width" class="form-control" name="width" placeholder="Please enter width">
    </div>
</div>
<div class="form-group row pb-3 mb-3">
    <label for="price" class="col-sm-2 col-form-label">Length (CM)</label>
      <div class="col-sm-3">
      <input type="text" id="length" class="form-control" name="length" placeholder="Please enter lenght">
    </div>
</div>
<label for="price" class="col-sm-6 col-form-label">Please, provide dimensions in HxWxL format</label>
  </div>

</div>
</form>


<?php require_once('partial\footer.php'); ?>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>