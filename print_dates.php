<?php 

     if(isset($_POST['book'])){
        if(isset($_POST['dates1'])){
          $dates1=$_POST['dates1'];
       }
       if(!empty($_POST['dates2'])){
        $dates2=$_POST['dates2'];
       }
      
       if(isset($_POST['dates3'])){
          $dates3=$_POST['dates3'];
       }

       if(isset($_POST['dates4'])){
          $dates4=$_POST['dates4'];
       }
       if(isset($_POST['dates5'])){
         $dates5=$_POST['dates5'];
       }
       if(isset($_POST['dates6'])){
          $dates6=$_POST['dates6'];
       }
       if(isset($_POST['dates7'])){
         $dates7=$_POST['dates7'];
       }
       $dates=array("$dates1","$dates2","$dates3","$dates4","$dates5","$dates6","$dates7");
       if(isset($dates)){
        print_r($dates);
       }
     }

?>
<html>
    
    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <style>
        .displayNone{
            display: none;
        }
        </style>
    </head>
    <body> 
<div id="bookin_no">

       <label for="dates">Select Number Of Slots : </label></br>
        <select name="size" id='slots' >
          <option value="-1">Number of Slots</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>

          </select>
        <br/><br/>
        
        <div class="total-slots displayNone">
            <div class="slot1">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="date" name="dates1" class='datepicker' >
            </div>
            <br/><br/>
            <div class="slot2">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates2" class='datepicker'>
            </div>
            <br/><br/>
            <div class="slot3">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates3" class='datepicker'>
            </div>
            <br/><br/>
            <div class="slot4">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates4" class='datepicker' >
            </div>
            <br/><br/>
            <div class="slot5">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates5" class='datepicker'>
            </div>
            <br/><br/>
            <div class="slot6">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates6" class='datepicker'>
            </div>
            <br/><br/>
            <div class="slot7">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates7" class='datepicker'>
            </div>
        </div>
       
         
      </div>
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
 <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>


<script type="text/javascript" src="js/script.js"></script>
</body>
</html>