<?php 

if(!function_exists('auth')){
    function auth(){
        if(session_has('admin')){
            return json_decode(session('admin'), true);
        }else{
            return null;
        }
    }
} 

if(!function_exists('logoute')){
    function logoute(){
       session_forget('admin');
    }
} 