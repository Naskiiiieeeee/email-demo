<?php 
require('operators.php');

$so = new System_operators();

if(isset($_POST['btnsend'])){
    $email =  $_POST['email'];
    $phone =  $_POST['phone'];
    $message =  $_POST['message'];

    // $so->sendEmail($email,$phone);
    $so->sendSMS($phone,$message);  

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">

</head>
<body>
    <form action="" method="post">
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Phone Number</label>
            <input type="tel" name="phone" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Message</label>
            <textarea name="message" id=""></textarea>
        </div>

        <button type="submit" name="btnsend" class="btn btn-primary">Send</button>
    </form>
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous"></script>
</body>
</html>