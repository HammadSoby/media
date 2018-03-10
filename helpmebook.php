<head>
  <title>Dashboard | Demo </title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
 <div id="controls_remember">

     <?php include 'includes/leftmenu.php'; ?>

    </div>
      </div>
      <div id="menu">
         <nav>
                <span class="show_menu"></span>

            <ul class="ul">
                <li><a href="aboutradio.php">Radio Ads</a></li>
                <li><a href="abouttv.php">Tv Ads</a></li>
                <li><a href="aboutprint.php">Print Ads</a></li>
                <li><a href="aboutod.php">Outdoor Ads</a></li>
                <li><a href="aboutmp.php">Media Packages</a></li>
                <li><a href="contactus.php">Contact us</a></li>
            </ul>
            </nav>
      </div>
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
      <span id="booknow" >Book New Ad </span>
      <div id="booking" class="booking">
        <div id="book_in">
             <span id="b_title">Please Choose in wich field you would like to advertise : </span></br></br>
             <small id="star">*</small>&nbsp;<a href="book.php?type=radio">Radio Advertising </a></br>
             <small id="star">*</small>&nbsp;<a href="book.php?type=tv">Tv Channel Advertising</a></br>
             <small id="star">*</small>&nbsp;<a href="book.php?type=print">Print Advertising</a></br>
           </div>
      </div>
      <style>
      #data{
       margin-left: 25%;
       width: 70%;
       background: white;
       float: left;
       margin-top: 2%;
       padding-top: 1%;
       padding-bottom: 1%;
       border:2px solid #E6E6E6;
       text-align:center;
      }
      #damta{
      	padding-top: 2%;
      	width: 92%;
      	margin-left: 1%;
      	float: left;
      	background: white;
      	padding-left: 3%;
      	padding-right: 0.5%;
      	line-height: 25px;
      	background: #F4F4F4;
      	border:6px solid #E6E6E6;

      }
      #da_title{
      	font-family: "open sans";
      	color:black;
      	font-weight: bold;
      	font-size: 17px;
      }
      #body{
      	color:#353535;
      	font-family: "open sans";
      	font-weight: normal;
      	font-size:15px;
      }
      #damta h4{
      	font-family: "open sans";
      	color:#556272;
      	font-weight: bold;
      	font-size:24px;
      }
      </style>
      <div id="data">
      	<div id="damta">
      		<h4> Learn How To Book A Slot : </h4></br>
      		<span id="da_title"> Size of Slots  ? </span></br></br>

          <span id="body"> Your size of slot is the maximum duration of your broadcast and is normally for 15, 30 ,45or 60 seconds for Radio
            and Television  but can change dependant on your media provider. If you require a mixture of slots you must create
            a new  booking for each size.
        </span>
        </br></br></br>
        <span id="da_title"> Number of Slots  </span></br></br>

          <span id="body"> Enter a number up to any maximum . Each slot needs to be allocated a broadcast date and an optional “Time of

Day”.
        </span>
        </br></br></br>
        <span id="da_title"> Size of Slots  ? </span></br></br>

          <span id="body"> Your size of slot is the maximum duration of your broadcast and is normally for 15, 30 ,45or 60 seconds for Radio
            and Television  but can change dependant on your media provider. If you require a mixture of slots you must create
            a new  booking for each size.
        </span>
        </br></br></br>
        <span id="da_title"> Discount on Price  ?  ? </span></br></br>

          <span id="body"> Your discount on price is given as a % off  the total amount payable for your booking. Where we can this does result

in an additional saving of up to 25%  on the price we offer. Please note that our price is already below the best
        </span>
        </br></br></br>
        <span id="da_title"> Size of Slots  ? </span></br></br>

          <span id="body"> Your size of slot is the maximum duration of your broadcast and is normally for 15, 30 ,45or 60 seconds for Radio
            and Television  but can change dependant on your media provider. If you require a mixture of slots you must create
            a new  booking for each size.
        </span>
        </br></br></br>
        <span id="da_title"> Your Price per Slot </span></br></br>

          <span id="body"> Your Price per Slot normally reduces based on the number of slots selected and the discount given. The amount

shown is calculated using the  single slot price, discount and number of slots .
        </span>
        </br></br></br>
        <span id="da_title"> Comparison Price ? </span></br></br>

          <span id="body"> The  Comparison Price  is the  price that  we  would have to pay for the identical or similar item based on our last

known data. If you are able to find a more current and competitive comparisons then please let us know. We

constantly revise our details to remain competitive.
        </span>
        </br></br></br>
        <span id="da_title"> Saving  ? </span></br></br>

          <span id="body"> The Saving is the real savings you receive as a paid up member of Media United. We at Media United have with

united with our partners, the Media Providers. They allow us to purchase space sold at a premium rate to the public.

We through our affiliations with business owners and organisations sell at a discount to you. This discount is the

saving you make in using our service.
        </span>
        </br></br></br>
         <span id="da_title"> Specify Date(s) </span></br></br>

          <span id="body"> This is the date(s) you would like your advertisement to be broadcast and must equal the Number of Slots selected.

Where the date selected is before the earliest  deadline date for broadcast you should reselect a future date. Each

Media Provider has a Deadline Date for every broadcast that is stated in their profile.
        </span>
        </br></br></br>
         <span id="da_title"> Optional: Specify Time of Day ? </span></br></br>

          <span id="body"> This “Optional: Specify Time of Day” is a suggested time slot for the production to be broadcast. The Media

Provider is under no obligation to comply but it is helpful in allocating a preferred time . Securing a specific time

may be available by contacting the Media Provider direct and may attract additional costs.
        </span>
        </br></br></br>

         <span id="da_title"> Deadline Date(s) ? </span></br></br>

          <span id="body"> This is the date(s) your advertisement in its  final acceptable format to be broadcast must be with the Media Provider

to ensure broadcast is possible. Please note that Media United will NOT be liable for failure to adhere to this

stipulation
        </span>
        </br></br>
      	</div>

      </div>