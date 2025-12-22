<?php


$data =  validation([
    'email'=>'required|email',
    'password'=>'required',
] ,[
    'email'=>trans('admin.email'),
    'password'=>trans('admin.password'),
]);


$login = db_first('users', "where  email LIKE '%".$data['email']."%'");

if(empty($login) || !empty($login) && (!hash_check($data['password'],$login['password']) || $login['user_type'] != 'user')){
    session('error_login', trans('admin.login_failed'));
}else{
    session('success_sign_in', json_encode($login));
    redirect('/');
}