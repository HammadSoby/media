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
       text-align: center;
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
        line-height: 35px;
        text-align: center;
      }
      #damta h4{
        font-family: "open sans";
        color:#556272;
        font-weight: bold;
        font-size:24px;
      }
      #f{
        color:#353535;
        font-family: "open sans";
      }
      #prem_tab{
      width: 98%;
      text-align: center;
      margin-top: 3%;
      background: white;
      border-collapse: separate;
      border-spacing: 0px 0px;
      font-family: 'open sans';
      border:none;
      border-radius: 2px;
box-shadow: 1px 1px 2px rgba(0,0,0,.08);
      }
      #othe{
        border:1px solid #e5e5e5;
        padding-top:1.7%;
        padding-bottom: 1.7%;
        padding-left: 1%;
        padding-right: 1%;
        line-height: 25px;
        color:gray;
        color: #999999;
      }
      #m{
        font-size: 22px;
      }
      #ftd{
        padding-top: 2%;
        padding-bottom: 2%;
        border:1px solid #e5e5e5;
        padding-left: 1%;
        padding-right: 1%;
        line-height: 25px;
        color:#353535;
      }
      #gray{
        color: gray;
      }
      strong{
        color:#353535;
      }
  .btn {
  background: #db4040;
  background-image: -webkit-linear-gradient(top, #db4040, #d15e5e);
  background-image: -moz-linear-gradient(top, #db4040, #d15e5e);
  background-image: -ms-linear-gradient(top, #db4040, #d15e5e);
  background-image: -o-linear-gradient(top, #db4040, #d15e5e);
  background-image: linear-gradient(to bottom, #db4040, #d15e5e);
  -webkit-border-radius: 11;
  -moz-border-radius: 11;
  border-radius: 11px;
  font-family: Arial;
  color: #ffffff;
  font-size: 16px;
  padding: 8px 37px 8px 37px;
  text-decoration: none;
  font-family: "open sans";
  border:none;
}

.btn:hover {
  background: #ff7a7a;
  background-image: -webkit-linear-gradient(top, #ff7a7a, #db4040);
  background-image: -moz-linear-gradient(top, #ff7a7a, #db4040);
  background-image: -ms-linear-gradient(top, #ff7a7a, #db4040);
  background-image: -o-linear-gradient(top, #ff7a7a, #db4040);
  background-image: linear-gradient(to bottom, #ff7a7a, #db4040);
  text-decoration: none;
  cursor: pointer;

}
#oi{
  background: white;
  border:1px solid #e5e5e5;
  padding:3%;
  font-family: "open sans";
  color:#353535;
}
      </style>
      <?php   

      include "config.php";
      if(isset($_POST['purchase'])){
              $username=$_SESSION['user_logged'];
              $type="standard";
              $status="1";
              $price="200";
              $standard=$pdo->prepare("INSERT INTO premuim (username,type,status) VALUES (?,?,?)");
              $standard->BindValue(1,$username);
              $standard->BindValue(2,$type);
              $standard->BindValue(3,$status);
              $standard->execute();
              $getlastid = $pdo->lastInsertId();
              ?>

<form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="paypal_form">
<div class="paypal-form">
<input type="hidden" value="<?php echo paypal_email;?>" name="business">
<input type="hidden" value="GBP" name="currency_code">
<input type="hidden" value="GBP" name="lc">
<input type="hidden" value="Donation" name="item_name">
<input type="hidden" value="<?php echo $price; ?>" name="amount">
<input type="hidden" value="1" name="test">
<input type="hidden" value="<?php echo siteurl;?>succes.php" name="return">
<input type="hidden" value="<?php echo $getlastid;?>" name="custom">
<input type="hidden" value="paynow" name="type">
<input type="hidden" value="_xclick" name="cmd">
</div><div class="submit">
<!--input type="submit" value="Pay With Paypal" class="btn btn-primary bold"-->
</div>
</form>
<div style="margin:0 auto; font-size:15px;text-align:center;"><?php $while="Please Wait While We Redirect you to Paypal to process your payment ... "; ?></div>
<script>
setTimeout(function(){
document.getElementById("paypal_form").submit();
},3000);
</script>
<?php } ?>
</body>
</html> 
<?php

if(isset($error)){
  die($error);
}
?>
<style>
#wd{
  color:green;
  font-family: "open sans";

}
</style>
      <div id="data">
      	<div id="damta">
      		<h4> Standard Membership : </h4></br>
        
           <div id="oi">
              <?php
           if(isset($while)){
          ?><span id="wd"> <?php echo $while?></span></br></br>
          <?php
          }
          ?>
            You are about to pay £200 To be a standard member on Media United and enjoy all the feautures we offer .</br></br></br>

             <form method="post">
            
              <input type="submit" class="btn" name="purchase" value="Upgrade" />
            </form>

          </div>
  
          <span id="body">
          
        </span>
        </br></br>
      	</div>

      </div>