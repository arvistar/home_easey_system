<?php

require_once 'session.php';
require_once 'DB.php';
require_once 'helpers.php';

if (isset($_POST['register'])) {
    $input = clean($_POST);

    $name = $input['name'];
    $contact = $input['contact']; 
    $adder1 = $input['adder1'];
    $city = $input['city'];
    $password = $input['password'];
    


    $isProviderCreated = DB::query("INSERT INTO Customer values(DEFAULT, ?, ?, ?, ?, ?)", [
            $name,$contact,$adder1,$city,$password
        ]);

    if ($isProviderCreated) {
        header('Location: ../registercustomer.php?msg=success');
        exit();
    } else {
       
        header('Location: ../registercustomer.php?msg=failed');
        exit();
    }
}
