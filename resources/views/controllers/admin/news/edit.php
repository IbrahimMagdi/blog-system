<?php

$data = validation(
    [
        'title' => 'required|string',
        'category_id' => 'required',
        'image' => 'image',
        'description' => 'required',
        'content' => 'required',
    ],
    [
        'title' => trans('news.title'),
        'category_id' => trans('news.category_id'),
        'image' => trans('news.image'),
        'description' => trans('news.description'),
        'content' => trans('news.content'),
    ]
);
if (!empty($data['image']['tmp_name'])) {
    $news = db_find('news', request('id'));
    redirect_if(empty($news), aurl('news'));
    delete_file($news['image']);
    $data['image'] = store_file($data['image'], 'news/' . file_ext($data['image'])['hash_name']);
} else {
    unset($data['image']);
}
$data['user_id'] = auth()['id'];
$data['updated_at'] = date('Y-m-d H:i:s');
db_update('news', $data, request('id'));
session_flash('old');
session('success', trans('admin.updated'));
redirect(aurl('news/edit?id=' . request('id')));
