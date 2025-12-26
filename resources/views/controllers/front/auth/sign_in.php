<?php


$data =  validation([
    'email'=>'required|email',
    'password'=>'required',
] ,[
    'email'=>trans('admin.email'),
    'password'=>trans('admin.password'),
], 'redirect');


$login = db_first('users', "where  email LIKE '%".$data['email']."%'");

if(empty($login) || (!empty($login) && (!hash_check($data['password'], $login['password']) || $login['user_type'] != 'user'))){
    session('error_sign_in', trans('admin.login_failed'));
    redirect('/'); 
} else {
    session_forget('error_sign_in');
    session_forget('old');
    session('success_auth', json_encode($login));
    redirect('/');
}

