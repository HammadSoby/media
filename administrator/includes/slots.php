<style>
@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);
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
	width: 80%;
	margin-left: 10%;
	padding-left: 1%;
	border-bottom:1px dashed #353535;

	
}
#manage li {
	float: left;
	padding:0px; 
	padding-left: 1%;
	padding-top: 1%;
	text-align: center;
	padding-bottom: 1%;
	border-right:1px solid #353535;
	padding-right:2%;

	
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
	width: 13%;
	
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
#acli{
border-right:none; }
</style>
<body>
	<div id="banner">
		<span>Orders For Print Ad </span>
	</div>
<ul id="menu">
	<li><a href="manage.php?type=clients">Clients</a></li>
	<li><a href="manage.php?type=ra">Radio Adverstising </a> </li>
	<li><a href="manage.php?type=ta">Tv Adverstising </a> </li>
	<li><a href="manage.php?type=pa">Print Adverstising </a></li>
	<li><a href="manage.php?type=slots">Slots </a></li>
	<li><a href="manage.php?type=providers">Providers </a></li>
</ul>
<?php 
        session_start();
        include '../core/connection.php';
        $type="Print Adverstising";
        $type_nospace="slots"; 
        $getorders=$pdo->prepare("SELECT * FROM agencys WHERE id = 12");
        $getorders->execute();
        $getit=$getorders->fetchAll();
        ?>
        <h3 id="tit">All Slots </h3>
        <div id="role">
        <?php
        foreach($getit as $getorder){
           
           ?>
           

           <ul id="manage">
           
           	<li><strong> <?php echo $getorder['username']; ?></strong></li>
           	<li><span> <?php echo $getorder['entity_type']; ?></span></li>
           	<li><span> <?php echo $getorder['media_type']; ?></span></li>
          
           	<li><span>£<?php echo $getorder['media_email']; ?></span></li>
           	<li><span>£<?php echo $getorder['price']; ?></span></li>
           	<li id="acli" ><a href="accepting.php?type=<?php echo $type_nospace;?>&id=<?php echo $getorder['id']; ?>">Accept</a></li></br></br>
           	
           </ul>
       </div>
           <?php


         }

?>
</body>