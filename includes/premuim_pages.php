<?php







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
        	case '0': 
             include 'premuim_log.php';
        	 break;
        	case '1':
        		include 'premuim_log.php';
        		break;
        	case '2':
        		include 'premuim_1_done.php';
        		break;
            case '3':
        		include 'premuim_plus_done.php';
        		break;
        	
        	
        }
    }else{
    	include 'premuim_log.php';
    }

        





        ?>