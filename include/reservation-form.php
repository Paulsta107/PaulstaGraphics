<?php
if(filter_has_var(INPUT_POST,'submit')){
    $date = htmlspecialchars($_POST['date']);
    $name = htmlspecialchars($_POST['name']);
    $time = htmlspecialchars($_POST['time']);
    $telephone_no = htmlspecialchars($_POST['telephone_no']);
    $people = htmlspecialchars($_POST['people']);
    $email = htmlspecialchars($_POST['email']);

    if(!empty($date) && !empty($name) && !empty($time) && !empty($telephone_no) && !empty($people) && !empty($email)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $msg = "Please use valid email";
            $msgClass = "alert-danger";
        }else{
            $toEmail = 'cafemayfairhillcrest@gmail.com';
            $subject = 'Reservation Requset From <b> '.$name.'</b> for <b>'.$people.'</b>';
            $body = '<h2>Reservation Request</h2></p><hr>
                <h4>Name:</h4>'.$name.'</p>
                <h4>Subject:</h4>'.$subject.'</p>
                <h4>Date:</h4>'.$date.'</p>
                <h4>Time:</h4>'.$time.'</p>
                <h4>Telephone no:</h4>'.$telephone_no.'</p>
                <h4>Email :</h4>'.$email.'</p>
            ';

            //Email headers
            $header = "MINE-version"."\r\n";
            $header .= "Content-type=text/html,charset=utf-8". "\r\n";

            //Additional headers
            $header .= "from".$name."to <".$email.">". "\r\n";

            if(mail($toEmail, $subject, $body, $header)){
                // Email Sent
                $msg = 'Your email has been sent';
                $msgClass = 'alert-success';
            }else{
                // Failed
                $msg = 'Your email was not sent';
                $msgClass = 'alert-danger';
            }
        }
    }else{
        // Failed
        $msg = 'Please fill in all the feilds';
        $msgClass = 'alert-danger';
    }
}else{
    // No Action
    $msg = '';
    $msgClass = '';
}