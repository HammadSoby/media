<?php   session_start();

      include "config.php";
      if(isset($_POST['book'])){
       $username=$_SESSION['user_logged'];
       $type="Tv Adverstising";
       $channels=$_POST['channels'];
       $size=$_POST['size'];
       $time=$_POST['time'];
      
       $slot=$_POST['slots'];
       $created=date("l jS \of F Y ");
       $order_status=0;
          if(isset($_POST['dates1'])){
          $dates1=$_POST['dates1'];
       }
       if(isset($_POST['time1'])){
          $time1=$_POST['time1'];
       }

      /////////

       if(isset($_POST['dates2'])){
        $dates2=$_POST['dates2'];
       }
         if(isset($_POST['time2'])){
        $time2=$_POST['time2'];
       }


      
       if(isset($_POST['dates3'])){
          $dates3=$_POST['dates3'];
       }
         if(isset($_POST['time3'])){
       $time3=$_POST['time3'];
       }


       if(isset($_POST['dates4'])){
          $dates4=$_POST['dates4'];
       }
         if(isset($_POST['time4'])){
       $time4=$_POST['time4'];
       }



       if(isset($_POST['dates5'])){
         $dates5=$_POST['dates5'];
       }
         if(isset($_POST['time5'])){
       $time5=$_POST['time5'];
       }



       if(isset($_POST['dates6'])){
          $dates6=$_POST['dates6'];
       }
         if(isset($_POST['time6'])){
        $time6=$_POST['time6'];
       }



       if(isset($_POST['dates7'])){
         $dates7=$_POST['dates7'];
       }
         if(isset($_POST['time7'])){
        $time7=$_POST['time7'];
       }
       $dates_in=array("$dates1","$dates2","$dates3","$dates4","$dates5","$dates6","$dates7");
       $time_in=array("$time1","$time2","$time3","$time4","$time5","$time6","$time7");
       $dates=implode("   ",$dates_in);
       $time=implode("   ",$time_in);
       

       $allowed_slots=array(
                            '15 Second',
                            '30 Second',
                            '45 Second',
                            '60 Second',
                            
                  
                            );
       $allowed_channels=array(
                             
                             'BEN TV',
                             'VOX Africa',
                             'Voice of africa Radio',
                             'Africa Channel',
                             'Hi TV',
                             'OH TV',
                             
                          );
       $allowed_size=array(
                              '1',
                              '2',
                              '3',
                              '4',
                              '5',
                              '6',
                              '7',
                              
                          );
        $allowed_times=array(
'00:00',
'00:15',
'00:30',
'00:45',
'01:00',
'01:15',
'01:30',
'01:45',
'02:00',
'02:15',
'02:30',
'02:45',
'03:00',
'03:15',
'03:30',
'03:45',
'04:00',
'04:15',
'04:30',
'04:45',
'05:00',
'05:15',
'05:30',
'05:45',
'06:00',
'06:15',
'06:30',
'06:45',
'07:00',
'07:15',
'07:30',
'07:45',
'08:00',
'08:15',
'08:30',
'08:45',
'09:00',
'09:15',
'09:30',
'09:45',
'10:00',
'10:15',
'10:30',
'10:45',
'11:00',
'11:15',
'11:30',
'11:45',
'12:00',
'12:15',
'12:30',
'12:45',
'13:00',
'13:15',
'13:30',
'13:45',
'14:00',
'14:15',
'14:30',
'14:45',
'15:00',
'15:15',
'15:30',
'15:45',
'16:00',
'16:15',
'16:30',
'16:45',
'17:00',
'17:15',
'17:30',
'17:45',
'18:00',
'18:15',
'18:30',
'18:45',
'19:00',
'19:15',
'19:30',
'19:45',
'20:00',
'20:15',
'20:30',
'20:45',
'21:00',
'21:15',
'21:30',
'21:45',
'22:00',
'22:15',
'22:30',
'22:45',
'23:00',
'23:15',
'23:30',
'23:45',
'24:00',
                              
                          );
      
     require'includes/int.price_tv.core.validation.php';
  
    
        
       if(in_array($slot, $allowed_slots)){
        
        if(in_array($channels, $allowed_channels)){
          if(in_array($size, $allowed_size)){
                   if(!empty($dates)){
                    
                   if($membership==1){
     $price=$price; }
     
     if($membership==2){
      $price=$price*30/100;
      }
     
     if($membership==3){
     $price=$price*50/100;
     }
              include 'core/connection.php';
              $insert_order=$pdo->prepare("INSERT INTO orders (username,type,choice,size,dates,slot,time,order_status,full_price,created) VALUES (?,?,?,?,?,?,?,?,?,?)");
              $insert_order->BindValue(1,$username);
              $insert_order->BindValue(2,$type);
              $insert_order->BindValue(3,$channels);
              $insert_order->BindValue(4,$size);
              $insert_order->BindValue(5,$dates);
              $insert_order->BindValue(6,$slot);
              $insert_order->BindValue(7,$time);
              $insert_order->BindValue(8,$order_status);
              $insert_order->BindValue(9,$price);
              $insert_order->BindValue(10,$created);
              $done=$insert_order->execute();
              $getlastid = $pdo->lastInsertId();
              if($done){
              $_SESSION['order']=true;
              }
              ?>

<form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="paypal_form">
<div class="paypal-form">
<input type="hidden" value="<?php echo paypal_email;?>" name="business">
<input type="hidden" value="USD" name="currency_code">
<input type="hidden" value="USD" name="lc">
<input type="hidden" value="Donation" name="item_name">
<input type="hidden" value="<?php echo $price; ?>" name="amount">
<input type="hidden" value="1" name="test">
<input type="hidden" value="<?php echo siteurl;?>result.php" name="return">
<input type="hidden" value="<?php echo $getlastid;?>" name="custom">
<input type="hidden" value="paynow" name="type">
<input type="hidden" value="_xclick" name="cmd">
</div><div class="submit">
<!--input type="submit" value="Pay With Paypal" class="btn btn-primary bold"-->
</div>
</form>
<div style="margin:0 auto; font-size:15px;text-align:center;">Please wait while we redirect to Paypal to complete your payment...</div>
<script>
setTimeout(function(){
document.getElementById("paypal_form").submit();
},3000);
</script>
<?php  } ?>
</body>
</html> 
<?php
        

         
       
  
                   }else{
                    die("empty");
                   }
          
          }else{
            return false;
          }
        }else{
          return false;
        }
          
       }else{
        return false;
       }
      
       
       
      
      

if(isset($error)){
  die($error);
}
?>