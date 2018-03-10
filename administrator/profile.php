<?php 

if(isset($_GET['id'])){
$id=$_GET['id'];
?>
<style>
body{
	padding:0px;
	margin:0px;
	background:  #E5E5E5;
}
#menu{
	padding:0px; 
	margin:0px;
	background: #353535;
	color:white;
	text-align: center;
}
#menu li a {
	color:white;
	font-family: "open sans";
	text-decoration: none;
	padding-left: 20px;
	padding-right: 20px;
	font-size: 13px;

}
#menu li {
	display: inline-block;
	padding-top: 1%;
	padding-bottom: 1%;

}
#menu li:hover{
	background: #006699;
	cursor: pointer;

}
#tit{
	margin-left: 10%;
	font-family: "open sans";
	font-size:25px;
	color:#353535;
	border-bottom:1px dashed #353535;
	width: 60%;
	padding-left: 1%;
	padding-bottom: 2%;
}
#manage{
	list-style: none;
	padding:0px;
	margin:0px;
	color:#353535;
	font-family: "open sans";
	font-size: 15px;
	width: 70%;
	text-align: left;
	margin-left: 10%;
	padding-left: 1%;
	border-bottom:1px dashed #353535;

	
}
#manage li {
	
	padding:0px; 
	padding-left: 1%;
	padding-top: 1%;
	text-align: left;
	padding-bottom: 1%;
	

	
}
#manage li a {
	color:white;
	background: #F96E5B;
	text-decoration: none;
	padding-top: 3.5%;
	padding-bottom: 3.5%;
	padding-left: 50%;
	padding-right: 50%;
	border-radius: 6px;
	width: 10%;
}
#manage li a:hover{
	opacity: 0.7;
	transition:1s;
	cursor: pointer;
}
#banner{
	width: 100%;
	background: #F96E5B;
	height: 13%;
	padding-top: 1%;
}
#banner span{
	color:white;
	font-weight:100;
	font-family: "open sans";
	font-size: 38px;
	margin-left: 10%;
	background-image: url("https://cdn2.iconfinder.com/data/icons/business-charts/512/service-128.png");
	background-repeat: no-repeat;
	padding-left: 12%;
	padding-bottom: 10%;
}
#role{

}
#done{
	color:green;
	font-family: "open sans";
	font-size: 14px;
}
#help{
	margin-left: 10%;
	font-family: "open sans";
}
</style>
<body>
	<div id="banner">
		<span>Media United Admin Panel</span>
	</div>
<?php 
     
        include '../core/connection.php';
        $getorders=$pdo->prepare("SELECT * FROM providers WHERE id = ?");
        $getorders->BindValue(1,$id);
        $getorders->execute();
        $getit=$getorders->fetchAll();
        ?>
        <h3 id="tit">Providers </h3>
      

        <div id="role">
        <?php
        foreach($getit as $getorder){
           
           ?>
           
   <style>
   #username{
   	color:#aa0000;

   }
   #email{
   	color:green;
   }
   #fullname{
   	color:#006699;
   }
   #phone{
   	color:blue;
   }
   #org_name{
   	color:orange;
   }
   #adress{
   	color:#353535;
   }
   </style>
           <ul id="manage">
           
           	<li>Username : <strong id="username"> <?php echo $getorder['username']; ?></strong></li>
           	<li>Email : <span id="email"> <?php echo $getorder['email']; ?></span></li>
           	<li>Full Name : <strong id="fullname"> <?php echo $getorder['fullname']; ?></strong></li>
           	<li>Phone :<span id="phone"> <?php echo $getorder['phone']; ?></span></li>
           	<li>Organisation name : <strong id="org_name"> <?php echo $getorder['org_name']; ?></strong></li>
           	<li>Adress : <span id="adress"> <?php echo $getorder['adress']; ?></span></li></br></br>
           	<li>Post Adress  : <span id="adress"> <?php echo $getorder['postadress']; ?></span></li></br></br>
           	<li>Country  : <span id="adress"> <?php echo $getorder['country']; ?></span></li></br></br>
           	<li>Time  : <span id="adress"> <?php echo $getorder['time']; ?></span></li></br></br>
        
           
           	
           </ul>
       </div>
           <?php


         }

?>
</body>
<?php
}