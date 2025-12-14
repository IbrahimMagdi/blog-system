<?php
$data = validation(
       [
        'news_id'=>'required|integer|exists:news,id',
        'name'=>'required|string',
        'email'=>'required|email',
        'comment'=>'required|string',
        'status'=>'required|in:show,hide'
    ],
    [
        'news_id' => trans('comment.news'),
        'name' => trans('comment.name'),
        'email' => trans('comment.email'),
        'comment' => trans('comment.comment'),
        'status' => trans('comment.status'),
    ]
);

$comment = db_find('comments', request('id'));
redirect_if(empty($comment), aurl('comments'));
db_update('comments', $data, request('id'));
session('success', trans('admin.updated'));
redirect(aurl('comments/edit?id=' . request('id')));
