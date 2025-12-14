<?php

$GET_ROUTES = isset($routes['GET'])?$routes['GET']:[];
if(!isset($_POST['_method']) && !is_null(segment()) && !in_array(segment(), array_column($GET_ROUTES, 'segment'))){
    http_response_code(404);
    view('404');
    exit();
    // $storage_segment = str_replace('/'.public_().'/', '',segment());
    // if(preg_match("/^storage/i", $storage_segment)){
    //     storage($storage_segment);
    // }else{
    //     view('404');
    //     exit();
    // }
}


// foreach($GET_ROUTES as $rget){
//     if(!is_null($rget['segment']) && $rget['segment'] != segment()){
//         echo ' PAGE NOT FOUND <br>';
//         exit();
//     }
// }
