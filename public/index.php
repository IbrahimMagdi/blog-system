<?php
require_once __DIR__ . "/../includes/app.php";



/* var_dump(db_create('users', [
    'name' => 'ayman',
    'email' => 'ftftftftf@n11s232s.com',
    'password' => '123456',
    'mobile' => '123456789'
]));
 */


/* var_dump(db_update('users', [
    'name' => 'ayman updated',
    'email' => 'fffyfyfyf@n11s232s.com',
    'password' => '123456',
    'mobile' => '123456789'
], 16)); */

// var_dump(db_delete('users', 16));

// var_dump(db_find('users', 1));
// var_dump(db_first('users', "where email='aaaaaaa@n11s232s.com' "));  

// $users = db_get('users', 'where email LIKE "%11ss%"');
// if($users['num'] > 0){
//     while($row = $result = mysqli_fetch_assoc($users['query'])){
//         echo $row["name"]."-" . $row["email"]. "<br>";
//     }
// }


// $users = db_paginate('users', "", 2);
// while($row = $result = mysqli_fetch_assoc($users['query'])){
//     echo $row["email"]. "<br>";
// }
// echo $users['render'];

// set data
// session('test', 'new test wwwwww');
// echo session('test');
 // get session 
// session('test');

// destroy session by key
// session_forget('test');
// destroy all session
// session_delete_all();

// send mail test
// var_dump(send_mail(['fake@mail.com'], 'test message', 'welcome to php mail function test kelier'));

# encrypt and decrypt 
// $encrypt = encrypt("welcome to php mail function test kelier");
// echo $encrypt.'<br>';
// echo decrypt($encrypt);

# file management in storage folder
// symlink(base_path('storage/files'), public_path('storage'));
// delete_file('storage/files/test.txt'); 
// storage('storage/images/img.jpg');
// store_file($_FILES['image'], 'images/img.jpg');
// remove_folder('storage/images'); 

route_int();
if(!empty($GLOBALS['query'])){
    mysqli_free_result($GLOBALS['query']);
}
mysqli_close($connect);
// ob_end_clean();
ob_end_flush();
        // return '/'.ltrim($_SERVER['REQUEST_URI'], '/');
