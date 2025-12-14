<?php

$data = validation(
    [
        'name'=>'required|string',
        'icon'=>'required|image',
        'description'=>'required|string',
    ],
    [
        'name' => trans('cat.name'),
        'icon' => trans('cat.icon'),
        'description' => trans('cat.description'),
    ]
);
$data['icon'] = store_file($data['icon'], 'categories/'.file_ext($data['icon'])['hash_name']);
db_create('categories', $data);
session_flash('old');
session('success', trans('admin.added'));
redirect(aurl('categories'));