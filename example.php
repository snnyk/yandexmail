<?php 

require __DIR__.'/vendor/autoload.php';


//create new mail object
$mail = new Snnyk\Yandex\Mail([
        'key' => 'youdomainkey',
        'domain' => 'yourdomain.com'
]);


// $add = $mail->addUser(['username' => 'test1234' , 'password' => '123456uu']);
// var_dump($add);



// $delete = $mail->deleteUser('test1234');
// var_dump($delete);



// $edit = $mail->editUser(['username' => 'test1234' , 'password' => '123e4r5']);
// var_dump($edit);


$list =  $mail->getList();
var_dump($list->accounts);

