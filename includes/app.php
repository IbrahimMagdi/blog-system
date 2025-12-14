<?php
ob_start();
$helpers = ['bcrypt', 'request','routing', 'db', 'session', 'auth','helper', 'AES', 'mail', 'translation', 'api', 'validation', 'storage', 'view', 'media', 'date_time'];
foreach($helpers as $helper){
    require __DIR__ .'/helpers/'.$helper.'.php';
}
/**
* session save path in storage in sessions
* weth set ini and start session
**  or Example:
*   session include save path in storage in sessions
*   ini_set('session.save_path', config('session.session_save_path'));
*/
session_save_path(config('session.session_save_path'));
ini_set('session.gc_probability', 1);

session_start([
    'cookie_lifetime' => config('session.expiration_timeout'),
]);
$connect = mysqli_connect(
    config('database.server_name'),
    config('database.user_name'),
    config('database.password'),
    config('database.database'),
    config('database.port')
    
);
# check not connect connection
$query = "";
if(!$connect){
    die("Connection failed: ".mysqli_connect_error());
}


require_once base_path('/routes/web.php');
require_once base_path('/includes/exception_error.php');