$(document).ready(function (){
 var id = "";
 var text = "";
 var Nstatus;

 //When clicks on block or unblock to block or unblock
 $(document).on('click','.block, .unblock',function() {
  id = $(this).attr("id");
  console.log($(this).attr("class"));
  text = $(this).text();
  //console.log(text);

  if(text === "Block"){
   Nstatus = 0;
  }else if(text === "Unblock"){
   Nstatus = 1;
  }
  $.post("actions.php", {
   id: $(this).attr("id"),
   status: Nstatus
  });
 });

 //When clicks on number of records to show
 $('#records').on('change',function(){
  var optionText = $("#records option:selected").text();
  console.log(optionText);
  var url = $(location).attr('href');
  var afterDomain= url.substring(url.lastIndexOf('/') + 1);
  var beforeQueryString= afterDomain.split("?")[0];
  url = beforeQueryString;
  document.location.href = url+"?page=1&option="+optionText;
 });

// When clicks on pop up to add
 $(document).on('click','.popupBtnn, #dismiss-popup-btn, .exitIcon, .blackBackPop',function() {
  $(".popup").toggleClass("activePop");
  $(".blackBackPop").toggleClass("activePop");
 });

 //When clicks on pop up to edit
 $(document).on('click','.edit, .exitIconEdit, .blackBackPopEdit',function() {
  id = $(this).attr("id");
  if($(this).hasClass("CategoryPage")){
   CategoryName = $(this).parent().prev().prev().prev().text();
   $("#authorPlaceHolder").val(CategoryName);
  }else if($(this).hasClass("BookPage")){
   BookName = $(this).parent().prev().prev().prev().prev().prev().prev().text();
   AuthorName = $(this).parent().prev().prev().prev().prev().prev().text();
   Price = $(this).parent().prev().prev().prev().text();
   ISBN = $(this).parent().prev().prev().text();
   $("#authorPlaceHolder").val(BookName);
   $("#authorHolder").val(AuthorName);
   $("#priceHolder").val(Price);
   $("#ISBNHolder").val(ISBN);
  }else{
   AuthorName = $(this).parent().prev().prev().text();
   $("#authorPlaceHolder").val(AuthorName);
  }

  $("#authorIdPlaceHolder").val(id);
  $(".popupEdit").toggleClass("activePop");
  $(".blackBackPopEdit").toggleClass("activePop");
 });

});

