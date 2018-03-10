 <?php
                $headers=array(
                  'From:Benlaksire@gmail.com',
                  'Content-type:text/html'
                   
                  );
                $to="Benlaksirevlog@gmail.com";
                $subject="Mediaunited Welcomes you";
                $message = "
                <p>
                    Since it started Media United has been at the forefront of 
                    accessing the UK’s black community. We invite you to step into
                    our world and join the thousands of growing members online who
                    benefit from the Media Providers who are our partners. </p>

                    Access your Client Area log in using:</br>
Username: ( insert Username php code) </br>
Password: ( insert Password php code) </br>
BlackLinks ID (optional) : ( insert BlackLinks php code) </br></br>
                                                  ";
              mail($to,$subject,$message,implode("\r\n", $headers)){
                 
                 
                
                ?>