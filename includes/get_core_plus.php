
<?php
if(isset($_GET['purchase'])){
        	$purchase=$_GET['purchase'];

               if($purchase="standard"){
                include 'core/connection.php';
               	 $username=$_SESSION['user_logged'];
        $check_status=$pdo->prepare("SELECT * FROM premuim WHERE username = ?");
        $check_status->BindValue(1,$username);
        $check_status->execute();
        $check=$check_status->fetchAll();
        foreach($check as $status);
        $count_premuim=$check_status->RowCount();
        if($count_premuim>0){
        $thestatus=$status['status'];
               	switch ($thestatus) {
               		case '1':
               			include 'includes/standardplus.php';
               			break;
               		case '2':
                    include 'includes/premuim_1_done.php';
                     break;

                  case '3':
                    include 'includes/premuim_plus_done.php';
                     break;


               		default:
               			# code...
               			break;
               	}
               }else{
                include 'standardplus.php';
               }
               }
        }

        ?>