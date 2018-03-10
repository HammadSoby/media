<?php 

     if(isset($_POST['book'])){
     
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

<div id="bookin">
        <span id="book_title">You're About to book Ad Space In Tv Adverstising : </span></br>
        <span id="book_down">Please choose one of these Tv Channels :  </span></br>
        <hr/></br>
        <form method="post" action="process.php?type=2" enctype="multipart/form-data">
        <label for="radios">Choose a channel : </label></br>
        <select name="channels">
          <option>BEN TV</option>
          <option>VOX Africa</option>
          <option>Africa Channel</option>
          <option>Hi TV</option>
          <option>OH TV</option>
        </select></br></br>
       
         <label for="dates">Select Size Of Slots :  </label></br>
           <select name="slots">
          <option>15 Second</option>
          <option>30 Second</option>
          <option>45 Second</option>
          <option>60 Second</option>

          

          </select></br></br>
        <label for="size">Select Number Of Slots</label></br>
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
                <input type="text" name="dates1" class='datepicker' ><br>
                <label for="time">Specify(Preferred) Broadcast Time : </label></br>
        <input type="text" name="time1" placeholder="Broadcast Time Should Be For example 13:00 , 13:15 , 11:30 , you can choose a 15 minuts time Format"/></br></br>
            </div>
            <br/><br/>
            <div class="slot2">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates2" class='datepicker'><br>
                <label for="time">Specify(Preferred) Broadcast Time : </label></br>
        <input type="text" name="time2" placeholder="Broadcast Time Should Be For example 13:00 , 13:15 , 11:30 , you can choose a 15 minuts time Format"/></br></br>
            </div>
            <br/><br/>
            <div class="slot3">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates3" class='datepicker'><br/>
                <label for="time">Specify(Preferred) Broadcast Time : </label></br>
        <input type="text" name="time3" placeholder="Broadcast Time Should Be For example 13:00 , 13:15 , 11:30 , you can choose a 15 minuts time Format"/></br></br>
            </div>
            <br/><br/>
            <div class="slot4">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates4" class='datepicker' ><br>
                <label for="time">Specify(Preferred) Broadcast Time : </label></br>
        <input type="text" name="time4" placeholder="Broadcast Time Should Be For example 13:00 , 13:15 , 11:30 , you can choose a 15 minuts time Format"/></br></br>
            </div>
            <br/><br/>
            <div class="slot5">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates5" class='datepicker'><br>
                <label for="time">Specify(Preferred) Broadcast Time : </label></br>
        <input type="text" name="time5" placeholder="Broadcast Time Should Be For example 13:00 , 13:15 , 11:30 , you can choose a 15 minuts time Format"/></br></br>
            </div>
            <br/><br/>
            <div class="slot6">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates6" class='datepicker'><br>
                <label for="time">Specify(Preferred) Broadcast Time : </label></br>
        <input type="text" name="time6" placeholder="Broadcast Time Should Be For example 13:00 , 13:15 , 11:30 , you can choose a 15 minuts time Format"/></br></br>
            </div>
            <br/><br/>
            <div class="slot7">
                <label for="dates">Specify Date(s) To Run Ad : </label><br/>
                <input type="text" name="dates7" class='datepicker'><br>
                <label for="time">Specify(Preferred) Broadcast Time : </label></br>
        <input type="text" name="time7" placeholder="Broadcast Time Should Be For example 13:00 , 13:15 , 11:30 , you can choose a 15 minuts time Format"/></br></br>
            </div>
        </div>
        <br/><br/>
         
       
       
        <script type="text/javascript" src="js/jquery.min.js"></script>
 <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>


<script type="text/javascript" src="js/script.js"></script>
</body>
</html>