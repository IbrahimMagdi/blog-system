<?php
$data = validation(
    [
        'news_id'=>'required|integer|exists:news,id',
        'name'=>'required|string',
        'email'=>'required|email',
        'comment'=>'required|string',
    ],
    [
        'news_id' => trans('comment.news'),
        'name' => trans('main.name'),
        'email' => trans('main.email'),
        'comment' => trans('main.comment'),
    ], 'api'
);
$data['created_at'] = date('Y-m-d H:i:s');
db_create('comments', $data);
echo response(['status'=> true, 'message'=> 'comment added']);
