 <style>
input[type="text"]{
  width: 30%;
}
</style>
<?php 
   
   if(isset($_POST['getit'])){
    include_once('core/connection.php');
          $username=$_SESSION['user_logged'];
          $decision_maker=$_POST['decision_maker'];
          $entity_type=$_POST['entity_type'];
          $media_type=$_POST['media_type'];
          $media_email=$_POST['media_email'];
          $media_postal_adress=$_POST['media_postal_adress'];
          $nostreet=$_POST['nostreet'];
          $city=$_POST['city'];
          $country=$_POST['country'];
          $post_code=$_POST['post_code'];
          $telephone_number=$_POST['telephone_number'];
          $facsimile_number=$_POST['facsimile_number'];
          $website_adress=$_POST['website_adress'];
          $social_media=$_POST['social_media'];
          
          if(isset($_POST['price_size_15'])){
          $price_15_demo=$_POST['price_size_15'];
          $price_15="15 = $price_15_demo";
           }
           
          if(isset($_POST['price_size_30'])){
          $price_30_demo=$_POST['price_size_30'];
          $price_30="15 = $price_30_demo";
           }
           
            
          if(isset($_POST['price_size_45'])){
          $price_45_demo=$_POST['price_size_45'];
          $price_15="45 = $price_45_demo";
           }
           
            
          if(isset($_POST['price_size_60'])){
          $price_60_demo=$_POST['price_size_60'];
          $price_60="60 = $price_60_demo";
           }
           
           
          
          $prices_in=array("$price_15","$price_30","$price_45","$price_60");
          $price=implode("   ",$prices_in);
          
          $other=$_POST['other'];
          $other_2=$_POST['other_2'];
         $file=$_FILES['filing'];

	//file properties;
	$file_name=$file['name'];
	$file_tmp=$file['tmp_name'];
	$file_size=$file['size'];
  $file_error=$file['error'];
	//working out the file extention
	$file_ext=explode('.', $file_name);
	$file_ext=strtolower(end($file_ext));
	$allowed=array('','jpg','jpeg','png','pdf','avi','mp4','docx','mp3');
	
	if(in_array($file_ext, $allowed)){
	if($file_error===0){
	 if($file_size<= 200000000){
	  $file_name_new=uniqid('',true).'.'.$file_ext;
           $file_destination='uploads/'.$file_name_new; 
           $date=date(H:i:s D M Y );
           if(move_uploaded_file($file_tmp, $file_destination)){
              $insert_provider=$pdo->prepare("INSERT INTO agencys (username,provider_name,entity_type,media_email,media_postal_adress,
                                                                    nostreet,city,country,post_code,telephone_number,facsimile_number,
                                                                    website_adress,social_media,price,other,other_upload,other_2,date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
              $insert_provider->BindValue(1,$username);
              $insert_provider->BindValue(2,$decision_maker);
              $insert_provider->BindValue(3,$entity_type);
              $insert_provider->BindValue(4,$media_email);
              $insert_provider->BindValue(5,$media_postal_adress);
              $insert_provider->BindValue(6,$nostreet);
              $insert_provider->BindValue(7,$city);
              $insert_provider->BindValue(8,$country);
              $insert_provider->BindValue(9,$post_code);
              $insert_provider->BindValue(10,$telephone_number);
              $insert_provider->BindValue(11,$facsimile_number);
              $insert_provider->BindValue(12,$website_adress);
              $insert_provider->BindValue(13,$social_media);
              $insert_provider->BindValue(14,$price);
              $insert_provider->BindValue(15,$other);
              $insert_provider->BindValue(16,$file_destination);
              $insert_provider->BindValue(17,$other_2);
              $insert_provider->BindValue(18,$date);

             
              $inserted=$insert_provider->execute();
              if($inserted){
                ?>
                <script>window.location="board?board=provider";</script>
                <?php
              }
               }else{
           	$error="OH.";
           }


          }else{
          	$error="File is too large.";
          }
             }else{
        	$error="This is empty";        }
   }else{
		$error="Extention is not allowed.";
	}
	   }
   
 

?>
<style>#wh{color:#aa0000; font-family:"open sans"; font-size:14px; } </style>
 <div id="bookin">
        <span id="book_title">You Are About To Enter Your Information For Print Advertising </span></br>
        <span id="book_down">Add your Print Advertising Information :  </span></br>
        <hr/></br>
        <?php
                if(isset($error)){
                 ?>
                 <span id="wh"><?php echo $error; ?></span></br>
                 <?php 
                 }
         ?>
        <form method="post"  enctype="multipart/form-data">
        <label for="decision_maker">Decision Maker :  </label></br>
        <input type="text" name="decision_maker" /></br></br>
        
              <label for="entity_type">Entity Type : Ltd Co, Partnership, Sole Trader, Other ( please specify)  </label></br>
        <input type="text" name="entity_type" /></br></br>
       
              

        <label for="media_email">Media Email Address :  </label></br>
        <input type="text" name="media_email" /></br></br>
        
        <label for="media_postal_adress">Media Postal Adress :  </label></br>
        <input type="text" name="media_postal_adress" /></br></br>

        <label for="nostreet">No,Street/Road/Etc :  </label></br>
        <input type="text" name="nostreet" /></br></br>

        <label for="city">City :  </label></br>
        <input type="text" name="city" /></br></br>

        <label for="country">Country :  </label></br>
        <input type="text" name="country" /></br></br>

        <label for="post_code">Post Code :  </label></br>
        <input type="text" name="post_code" /></br></br>

        <label for="telephone_number">Telephone Number :  </label></br>
        <input type="text" name="telephone_number" /></br></br>

        <label for="facsimile_number">Facsimile Number :  </label></br>
        <input type="text" name="facsimile_number" /></br></br>

        <label for="website_adress">Website Address :  </label></br>
        <input type="text" name="website_adress" /></br></br>

        <label for="social_media">Social Media Adresses :  </label></br>
        <input type="text" name="social_media" /></br></br>
<label for="size">Media Sizes & Prices  </label></br>
        <style>
        #damtab {font-family:"open sans"; }
#damtab  tr td input {
	height:30px;
	font-size:14px;
}
</style>
            <table id="damtab">
<tr id="damtr">

<td id="damtd"> <strong> 15 Seconds </strong> </td>
<td id="damtd"> <strong> 30 Seconds </strong> </td>
<td id="damtd"> <strong> 45 Seconds </strong> </td>
<td id="damtd"> <strong> 60 Seconds </strong> </td>

</tr>
<tr id="damtr">
<td id="damtd"><input type="text" name="price_size_15" placeholder="Input Price in £'s"/></td>
<td id="damtd"><input type="text" name="price_size_30" placeholder="Input Price in £'s"/></td>
<td id="damtd"><input type="text" name="price_size_45" placeholder="Input Price in £'s"/></td>
<td id="damtd"><input type="text" name="price_size_60" placeholder="Input Price in £'s"/></td>
</tr>
</table>
</br>
  
        
<span id="ila"> <h2> You are asked to provide any additional Media Information. </h2> </span> 
Info 1- <strong> <font color="red" > Please state any other Media Products or Services for sale and your Mediapack and Marketing information </font> </strong>
<textarea name="other" placeholder="Type:  Information 1"></textarea></br>
<span id="ila">OR -Upload your information as a PDF or DOC –Click Browse</span>
 
        <input type="file" name="filing" /></br></br>

        
<span id="ila"> <h2> You are asked to provide any additional Media Information. </h2> </span> 
Info 1- <strong> <font color="red" > Please state any other Media Products or Services for sale and your Mediapack and Marketing information </font> </strong>
<textarea name="other_2" placeholder="Type:  Information 1"></textarea></br>
          <style>
          #checkout_button{
            color:red;
            font-family: "open sans";
            font-weight: normal;
            cursor: pointer;

          }
          #ila{
          color:#006699;
          font-family:"open sans";
          font-weight:normal;
          font-size:13px;
          }
          </style>
          <span id="rem">By Clicking Submit You accept our <a href="https://www.dropbox.com/s/em6m28vnli0ouu6/Terms%20and%20Conditions%20%28Providers%20and%20Purchasers%29%281%29.docx?dl=0">Terms & Condition</a></span></br></br>
          
          <input type="submit" name="getit" id="booka" value="Submit" /> 
        </form>
      </div>