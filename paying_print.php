   <?php 
     include "config.php";
      if(isset($_POST['book'])){
       $username=$_SESSION['user_logged'];
       $type="Print Adverstising";
       $newspaper=$_POST['newspaper'];
       $size=$_POST['size'];

       $slot=$_POST['slot'];
       $area=$_POST['area'];
       $adtext=nl2br($_POST['adtext']);
       $created=date("l jS \of F Y ");
       $order_status=0;
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
       $dates_in=array("$dates1","$dates2","$dates3","$dates4","$dates5","$dates6","$dates7");
       $dates=implode("   ",$dates_in);
       $allowed_newspapers=array(

                     'The Voice Newspaper',
                     'The Vision',
                     'GLA News',
                     'Afro News',
                     'Trumpet',
                     'Phoenix',
                     'Black Hair',
                     'Diva Scribe',
                     'Rewind',
                     'Ovation',
                     'Fab Magazine',
                     'Ninetynine Magazine',
                     'Arise Magazine',
                     'Pride',
                     'Afro Pulp',
                     'Tropics',
                     'Zen',
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
    $allowed_areas=array(

                         'Travel',
                         'Entertainment',
                         'Sports',
                         'Business',
                         'Health',
                         'World',
                         'Other',
                      );
    $allowed_slots= array(
                         'A8 (52 x 74 mm)',
                         'A7 (74 x 105 mm)',
                         'A6 (105 x 148 mm)',
                         'A5 (148 x 210 mm)',
                         'A4 (210 x 297 mm)',
                         'A3 (297 x 420 mm)',
      );
   require'includes/int.price_print.core.validation.php';
                     
   
                  if(in_array($slot, $allowed_slots)){
                    if(in_array($newspaper, $allowed_newspapers)){
                       if(in_array($size, $allowed_size)){
                          if(in_array($area, $allowed_areas)){
                            if(!empty($dates)){
                                 
        

        if($membership==1){
     $price=$price; }
     
     if($membership==2){
      $price=$price*30/100;
      }
     
     if($membership==3){
     $price=$price*50/100;
     }
        
              require 'core/connection.php'; 
              $insert_order=$pdo->prepare("INSERT INTO orders 
              	                         (username,type,choice,size,dates,slot,adtext,area,order_status,full_price,created)
              	                          VALUES (?,?,?,?,?,?,?,?,?,?,?)");
              $insert_order->BindValue(1,$username);
              $insert_order->BindValue(2,$type);
              $insert_order->BindValue(3,$newspaper);
              $insert_order->BindValue(4,$size);
              $insert_order->BindValue(5,$dates);
              $insert_order->BindValue(6,$slot);
              $insert_order->BindValue(7,$adtext);
              $insert_order->BindValue(8,$area);
              $insert_order->BindValue(9,$order_status);
              $insert_order->BindValue(10,$price);
              $insert_order->BindValue(11,$created);
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
<?php ?>
</body>
</html> <?php

        

         
       
  }else{
    $error="One of this errors accured : Size is big | extention is not allowed | Or Something just went wrong.";
  }
                            }else{
                              echo "empty";
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
                  }else{
                    return false;
                  }
     


 ?>