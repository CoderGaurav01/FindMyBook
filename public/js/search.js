$(document).ready(function(){
$("#seeAnotherField").change(function() {
  if ($(this).val() == "yes") {
    $('#otherFieldDiv').show();
    $('#otherField').attr('required', '');
    $('#otherField').attr('data-error', 'This field is required.');

    $('#searchbardiv').hide();
    $('#searchbardiv').removeAttr('required');
    $('#searchbardiv').removeAttr('data-error');

    $('#searchbardiv2').hide();
    $('#searchbardiv2').removeAttr('required');
    $('#searchbardiv2').removeAttr('data-error');

  } 
 else if(($(this).val() == "search") ) {
  
     
    $('#searchbardiv').show();
    $('#searchbar').attr('required', '');
    $('#searchbar').attr('data-error', 'This field is required.');
 
  
  

    $('#otherFieldDiv').hide();
    $('#otherField').removeAttr('required');
    $('#otherField').removeAttr('data-error');

    $('#searchbardiv2').hide();
    $('#searchbardiv2').removeAttr('required');
    $('#searchbardiv2').removeAttr('data-error');
  
 }

 else if(($(this).val() == "search2") ) {
  
     
  $('#searchbardiv2').show();
  $('#searchbardiv2').attr('required', '');
  $('#searchbardiv2').attr('data-error', 'This field is required.');


  $('#searchbardiv').hide();
  $('#searchbardiv').removeAttr('required');
  $('#searchbardiv').removeAttr('data-error');

  $('#otherFieldDiv').hide();
  $('#otherField').removeAttr('required');
  $('#otherField').removeAttr('data-error');

}

  else {
    $('#searchbardiv').hide();
    $('#searchbardiv').removeAttr('required');
    $('#searchbardiv').removeAttr('data-error');


    $('#otherFieldDiv').hide();
    $('#otherField').removeAttr('required');
    $('#otherField').removeAttr('data-error');

    $('#searchbardiv2').hide();
    $('#searchbardiv2').removeAttr('required');
    $('#searchbardiv2').removeAttr('data-error');

  }
});
$("#seeAnotherField").trigger("change");
$("#searchbardiv").trigger("change");
$("#searchbardiv2").trigger("change");



});
