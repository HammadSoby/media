            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <script>
$(document).ready(function(){
  $("#booknow").click(function(){
    $("#booking").toggle();
  });
});
$(document).ready(function(){
  $("#update_but").click(function(){
    $("#update_div").toggle();
  });
});
</script>
     
      <div id="booking" class="booking">
        <div id="book_in">
             <span id="b_title">Please Choose in which field you would like to advertise : </span></br></br>
             <small id="star">*</small>&nbsp;<a href="book.php?type=radio">Radio Advertising </a></br>
             <small id="star">*</small>&nbsp;<a href="book.php?type=tv">Tv Advertising</a></br>
             <small id="star">*</small>&nbsp;<a href="book.php?type=print">Print Advertising</a></br>
           </div>
      </div>