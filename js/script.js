
$(document).ready(function() {
  var $productType = $("#productType");
  var $productForm = $('#product_form');
  var $productFormInputs = $('#product_form input, #product_form select');

 
  // Show/hide input elements in the form based on selected product type
  $productType.change(function() {
    if ($(this).val() === 'dvd') {
      $('#DVD').css('display','inline');
      } else {
        $('#DVD').css('display','none');
      }

      if ($(this).val() === 'book') {
        $('#Book').css('display','inline');
        } else {
          $('#Book').css('display','none');
        }

        if ($(this).val() === 'furniture') {
          $('#Furniture').css('display','inline');
          } else {
            $('#Furniture').css('display','none');
          }
      
  });



  // client side validation
  var rules ={};
  $.getJSON('ScandiwebProject/json/validation-rules.json', function(data) {
  rules = data; 
  // Validate form on submit
  $productForm.submit(function(event) {
   event.preventDefault();

  // Validate form fields
  var isValid=true;
  for (var field in rules) {
    var $field = $('#' + field);
    var rule = rules[field];
    var value = $field.val();
    var isFieldValid = true;
    var set = false;

    if($field.is(":visible"))
    {
      if (rule.required && !value) {
      $field.parent().find('.error').remove();
      $($field).after('<div class="error">Please, submit required data</div>');
      set=true;
      isFieldValid=false;
    } else if (rule.pattern && !(new RegExp(rule.pattern.replace(/#/g, ''))).test(value)) {
      $field.parent().find('.error').remove();
      $($field).after('<div class="error">Please, provide the data of indicated type</div>');
      isFieldValid=false; 
    } else {
      $field.parent().find('.error').remove();
      isFieldValid=true;
    }
    if (!isFieldValid) {
      isValid = false;
    }
  }
  }

  if(isValid) {
  $(this).unbind('submit').submit();}
  
   });

  });

//Bind event listener to form fields for real-time validation
  $productFormInputs.on('input change', function() {
  
  var $field = $(this);
  var field = $field.attr('id');
  var rule = rules[field];
  var value = $field.val();
  var $error = $('.error', $field.parent());
  if (rule.required && !value) {
    $error.text('Please, submit required data!');
  } else if (rule.pattern && !(new RegExp(rule.pattern.replace(/#/g, ''))).test(value)) {
    $error.text('Please, provide the data of indicated type!');
  } else {
    $error.text('');
  }

});
});









