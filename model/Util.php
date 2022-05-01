<?php

require_once __DIR__.'/../resources/PasswordHash.php';

class Util
{

    public static function calculateAge($birthday){
        list($ano,$mes,$dia) = explode('-',$birthday);
        $ano_diferencia  = date('Y') - $ano;
        $mes_diferencia = date('m') - $mes;
        $dia_diferencia   = date('d') - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
            $ano_diferencia--;
        return $ano_diferencia;
    }

    public static function getDateRecord(){
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('America/Bogota'));
        return $date->format('d-m-Y h:i:s');
    }

    public static function messageAlert($message){
        ?>
        <script>
            alert('<?= $message ?>');
            history.back();
        </script>
        <?php
        exit;
    }

    public static function valideFieldString($field, $message){
        if(filter_var($field, FILTER_SANITIZE_STRING) === '' || empty(filter_var($field, FILTER_SANITIZE_STRING))){
            ?>
            <script>
                alert('<?= $message ?>');
                history.back();
            </script>
            <?php
            exit;
        }
    }

    public static function valideFieldInt($field, $message){
        if(filter_var($field, FILTER_SANITIZE_NUMBER_INT) === '' || empty(filter_var($field, FILTER_SANITIZE_NUMBER_INT))){
            ?>
            <script>
                alert('<?= $message ?>');
                history.back();
            </script>
            <?php
            exit;
        }
    }

    public static function confirmationProcess($message, $url){
        ?>
        <script>
            alert('<?= $message ?>');
            location.href='<?= $url ?>';
        </script>
        <?php
    }

    public static function _token(){
        $randomToken = base64_encode(openssl_random_pseudo_bytes(32));
        $_SESSION['token'] = $randomToken;
        return $_SESSION['token'];
    }

    public static function validate_token($requestToken){
        if( isset($_SESSION['token']) && $requestToken === $_SESSION['token'] ){
            unset($_SESSION['token']);
            return true;
        }
        return false;
    }

    public static function popupMessage($title, $text, $type, $page){
        $message ="<script type='text/javascript'>
				swal({
  					title: '{$title}',
  					text: '{$text}',
  					timer: 3000,
  					type: '{$type}',
  					showConfirmButton: false
				});
	  				setTimeout(function(){
	    				window.location.href='{$page}'; 
	  				}, 2000);
				</script>";

        //$message = "$username";
        return $message;
    }

    public static function redirectTO($page){
        header("location: {$page}");
    }

    public static function guard($url){
        $isValid = true;
        $inactive = 60*30;  # <-- just for testing period  3 minuits..

        $fingerPrint = md5(  $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']  ); // this information will be takenevery time the user opens the website,(ie we get the ip and the the browser data , of every one who opens our website,)
#--> NOTE : this server 'REMOTE_ADDR' can be used to count the no of users, on our website -->  what we can do is make a table in which we store the different ip's of the people and we count these ips this will give the no of different ip users visited on our website

        /* THE REASON OF USING THE FINGERPRINT IS TO PROTECT THE WEBSITE FROM THE SESSION HIGHJACKING,--> SEE HOW ==>
         suppose if we have not done this fingerprint verification ,--> and only the verifaication is that any cookie of named authentication system is set or not and if the data in it matches our database,or not,---> but what a hacker can do is  , after a man signin the website--> his cookie for that website is set for 30 days, say , and if he didnot logout his cookie remians there  --> so the hacker can steel this cookie for the website and, paste,it in his system and go to the site, --> eventually he has opened the users site whose cookie was created there---> this is because, all the conditions are true, the user never loged out and the browser found the cookie with the same data as it needed, even if the system is changed!
        */
        #  isset($_SESSION['username']) -->just to double check
        #this is to secure sesssion highjacking ie. our session is going on (when we loged in) -> so the session variables are also set, ie session[fingerprint] is set , but due to steel of the cookie now the session will be active over there also  as the person never loged out of the website,-> but now we can trac its system information , ie. this is the same pc or not
        if ( isset($_SESSION['fingerPrint']) && ($fingerPrint != $_SESSION['fingerPrint']) && isset($_SESSION['username']) ) {
            $isValid = false;
            self::redirectTO($url);
        }elseif(isset($_SESSION['lastActive']) && (time()-$_SESSION['lastActive'] > $inactive) && isset($_SESSION['username'])){
            $isValid = false;
            #$timeOfLogingOut = $_SESSION['lastActive']; # so when the user logs out that time wil be captured and it will be stored in the database --> to show last active time,--> to their friends, after they loged out

            # NOTE: ITS NOT THAT ACTIVE --> 1. this will work only if the the user is loged out due to the limit of inactivity , and not by if he presses his logout buttton , or if any one uses the above hacking method (--> in these two the user will be loged out but the time  will not be saved into the database,)--> this is because i am coding it in here , so i have TO MAKE A FUNCTION THAT HANDELS THAT LOGOUT AND SIMULTANIOUSLY SAVE THE TIME....

            # 2.
            self::redirectTO($url);
        }elseif(!isset($_SESSION['fingerPrint']) && !isset($_SESSION['username'])){
            $isValid = false;
            #$timeOfLogingOut = $_SESSION['lastActive']; # so when the user logs out that time wil be captured and it will be stored in the database --> to show last active time,--> to their friends, after they loged out

            # NOTE: ITS NOT THAT ACTIVE --> 1. this will work only if the the user is loged out due to the limit of inactivity , and not by if he presses his logout buttton , or if any one uses the above hacking method (--> in these two the user will be loged out but the time  will not be saved into the database,)--> this is because i am coding it in here , so i have TO MAKE A FUNCTION THAT HANDELS THAT LOGOUT AND SIMULTANIOUSLY SAVE THE TIME....

            # 2.
            self::redirectTO($url);
        }else{# this variable will not be set for the user which not loged in --> because for them there does not exist such variable--> but this does not give error (when loading the index page when the user is not signed in)--> theis is becasuse  in the header file (in which the guard function is called every time, -> note also every time the session file goes attached to it ,)--> ie session is started and now we can set these session variable

            $_SESSION['lastActive'] = time(); # NOTE : (on click ,every time the page loads,--> adn this is in the header,so)that if the above two conditons are not true , then the last active time is always set to the current time,
            # that is when the user is loged out(not by pressing the logout button but by any of these two conditions , ) automatically the last inactivetime is set to the time of the system currently (EXample:   if the last active time is greater than the inactve time and we dont do any thing, after an our we refresh the page, --> NOW  this is the time when the script gets run and now THE LAST ACTIVE TIME WILL BE OF ONE HOUR LATE ie. THE TIME OF SYSTEM when the page is loaded)

            $_SESSION['fingerPrint'] = $fingerPrint;# now this will also be set for the first time when some one opens the site , and will be keep track of untill he logouts ,

            //echo self::dateTime1($_SESSION['lastActive']);
            //echo "  hello ";#--> it does not show up as it is in a hidden class (YOU CAN SEE THEM IN THE SOURCE CODE)
        }
        return $isValid; # so for an unloged user it gets the value of TRUE automatically --> that is why it prints 1 in the source code

    }

    public static function fechaCastellano ($fecha) {
        $fechaInicial = $fecha;
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia. ' ' .$numeroDia. ' de ' .$nombreMes. ' de ' .$anio. ' a las '. date('g:i a',strtotime(substr($fechaInicial, 12, 19)));
    }


    public static function dateTime1($dateTime){ # convert it to the date time format from the timestamp format
        $date = new DateTime();
        $date->setTimestamp($dateTime);
        $date_string = date_format($date,'U=Y-m-d H:i:s');

        return $date_string;
    }
#=--------------------------------------- another function for time conversion   -----------------------------------------
    function dateTime2($dateTime){
        $date_string = strftime( "%d %b %y", strtotime($dateTime) );
        return $date_string;
        # what strtotime() does is it converts the timestamp to the human readable time
        # what strftime() --> does is it format this time inro more convinent way
        # ie. %b is for abbrevation of months, eg -> jan, feb etc.
        # and %d is for showing the 2 digits of the date, eg. 02, 04, 29 etc.
        # and %y is for showing the 4 digits of the year, eg. 2000, 2004, 1996 etc.
    }

    public static function passwordCrypt($words){
        $hasher = new PasswordHash(8, FALSE);
        return $hasher->HashPassword($words);
    }

    public static function validatePassword($encripted, $notEncripted){
        $hasher = new PasswordHash(8, FALSE);
        return $hasher->CheckPassword($notEncripted, $encripted);
    }

    public static function moneyFormat($numero){
        return '$'.number_format($numero,0,'.',',');
    }

    public static function getPartUrlForValidation(){
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
        $CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $ultimateUrl = explode('sangabrieladmin/', $CurPageURL);
        return $ultimateUrl[1];
    }
}