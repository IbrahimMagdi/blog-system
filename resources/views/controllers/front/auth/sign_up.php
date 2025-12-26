<?php
$data = validation(
    [
        'name'     => 'required|string',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|string',
        'mobile'   => 'required|unique:users,mobile',
    ],
    [
        'name'     => trans('user.name'),
        'email'    => trans('user.email'),
        'password' => trans('user.password'),
        'mobile'   => trans('user.mobile'),
    ],
    'redirect'
);

$data['password'] = bcrypt($data['password']);
$data['user_type'] = 'user';

 db_create('users', $data);


session_forget('old');
session_forget('errors');

session('success_auth', json_encode($data));

redirect('/');