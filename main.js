$(document).ready(function (){
 var id = "";
 var text = "";
 var Nstatus;
 var userName ="";
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
   status: Nstatus,
   code: 1
  });
 });

 //When clicks on number of records to show
 $('#records').on('change',function(){
  var optionText = $("#records option:selected").text();
  var url = $(location).attr('href');
  var afterDomain= url.substring(url.lastIndexOf('/') + 1);
  var beforeQueryString= afterDomain.split("?")[0];
  url = beforeQueryString;
  document.location.href = url+"?page=1&option="+optionText;
 });

// When clicks on pop up to add
 $(document).on('click','.popupBtnn, #dismiss-popup-btn, .exitIcon, .blackBackPop, .emailNotif',function() {
  var bookName = $(this).parent().prev().prev().prev().prev().text();
  userName = $(this).parent().prev().prev().prev().prev().prev().text();
  $('#bookNamePlace').text(bookName);
  $('#userEmail').val(userName);

  $('.issuedName').text(userName);
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

 $(document).on('click','.bookPlace',function() {
  var status = $(this).find("h3").eq(1).attr("class");
  console.log(status);
  window.location.href = "bookSelected.php?bookId=" + $(this).attr("id") + "&status="+status;
 });

 $(document).on('click','.selectedBookButton',function() {
  if($(this).hasClass("blue")){
   var id = $(this).parent().prev().attr("id");
   $.post("actions.php", {
    id: id,
    code: 2
   });
   window.location.href = "studentDashboard.php";
  }
  if($(this).hasClass("green")){
   var id = $(this).parent().prev().attr("id");
   $.post("actions.php", {
    id: id,
    code: 3
   });
   window.location.href = "studentDashboard.php";
  }
 });

 $(document).on('click', '.returnBtn ', function (){
  var id = $(this).attr("id");
  console.log(id);
  $.post("actions.php", {
   id: id,
   code: 4
  });
  window.location.href = "IssueBooks.php?page=1";
 });

 $(document).on('click', '.returnBtnS ', function (){
  var id = $(this).attr("id");
  console.log(id);
  $.post("actions.php", {
   id: id,
   code: 4
  });
  window.location.href = "studentIssueBook.php?page=1";
 });

 $(document).on('click', '.sampleEmail', function () {
  var emailText = $(this).text();
  $.post("actions.php", {
   emailText: emailText,
   userName: userName,
   code: 5
  });
 });
});

