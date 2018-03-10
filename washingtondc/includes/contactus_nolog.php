 <style>
      #data{
       margin-left: 15%;
       width: 70%;
       background: white;
       float: left;
       margin-top: 2%;
       padding-top: 1%;
       padding-bottom: 1%;
       border:2px solid #E6E6E6;
       line-height: 45px;
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
      }
      #dam_title{
        font-family: "open sans";
        color:#556272;
        font-weight: bold;
        font-size:24px;
      }
      #ina{
        font-family: "open sans";
        color:#F96E5B;
        font-size: 14px;
      }
      label{
        color: #353535;
        font-family: "open sans";
        font-size:17px;
        font-weight: bold;
      }
      #data input[type="text"]{
           width: 50%;
           height: 5%;
           border:1px solid #ccc;
           font-size: 16px;
           padding-left: 1%;
      }
      textarea{
        resize:none;
        width: 50%;
        padding-left: 1%;
        padding-top: 1%;
        height: 30%;
        font-family: "open sans";
        color:#353535;
        font-size: 17px;
        outline: none;
        font-weight: bold;
      }
      #data input[type="submit"]{
        width: 20%;
        
        background: #F96E5B;
        border:1px solid #F96E5B;

        color:white;
        font-family: "open sans";
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
      }
      #data input[type="submit"]:hover{
        opacity: 0.6;
        transition:1s;
        cursor: pointer;
      }
      #theerror{
        color: #aa0000;
        font-family: "open sans";
        font-size:15px;
      }
      #done{
          color:green;
          font-family: "open sans";
          font-weight: bold;
      }
      </style>
      <div id="data">
      	<div id="damta">
      		<span id="dam_title"> Contact Us : </span></br></br>
      		<span id="ina">If you would like to ask us a question regrading any
           of our services or how to make advertisement, you can get in touch by email, phone, fax or post
          </span></br>

                <?php
                function sanitize($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
              if(isset($_POST['send'])){
              $body=sanitize($_POST['body']);
              $subject=sanitize($_POST['subject']);
              $email=sanitize($_POST['email']);
              $fullname=sanitize($_POST['email']);
              $error_contact="";
              if(!filter_var($email, FILTER_VALIDATE_EMAIL))
               {
                $error_contact="Email is  not Valid";
                 }
              if(empty($body)){
                $error_contact="Subject is Required";
              }

              if(strlen($body)<5){
                 $error_contact="Body is Too Short";
              }
              if(strlen($body)>255){
                $error_contact="Body Is Too Long";
              }
              if(empty($body) OR empty($email) OR empty($fullname)){
                $error_contact="Fields With a Star Are Required.";
              }
              if(isset($subject)){
                if(strlen($subject)!=0){
                if(strlen($subject)<2){
                $error_contact="Subject is too short";
                }
              }
            }

              if(empty($error_contact)){
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= $email;
                $headers .= 'Cc: contact-us|form' . "\r\n";
                $to="Benlaksirevlog@gmail.com";
                $message="by : $email </br></br> $body";
                if(mail($to,$subject,$message,$headers)){
                  $succes="Email Successfully Sent .. We'll Get Back to You as soon as Possible";
                }
              }
            }
              ?>
          <form method="post"></br>
            <?php if(isset($error_contact)){
            ?>
            <small id="theerror"><?php echo $error_contact; ?></small></br></br>
            <?php 
           }
           if(isset($succes)){
            ?>
            <small id="done"><?php echo $succes; ?></small></br></br>
            <?php
           }
           ?>

            <label for="fullname">Full Name :</label></br>

            <input type="text" name="fullname"/></br></br>

            <label for="email">Email :</label></br>
            <input type="text" name="email"/></br></br>

            <label for="subject">Subject :</label></br>
            <input type="text" name="subject"/></br></br>

            <label for="body">Body :</label></br>
            <textarea name="body"></textarea></br></br>

            <input type="submit" name="send" value="Send" />

  
        
      	</div>

      </div>