<?php
view('admin.layouts.header', ['title' => trans('admin.comments') . '-' . trans('admin.show')]);
$id = validate_id();
if (!$id) {
    redirect(aurl('comments'));
    exit();
}
$comment = db_first(
'comments',
"JOIN news on comments.news_id = news.id
where comments.id=" . $id,
"comments.id,
 comments.name,
 comments.news_id,
 comments.email,
 comments.comment,
 comments.status,
 news.title AS news_name"
);

if (!$comment) {
    redirect(aurl('comments'));
    exit();
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>{{ trans('admin.comments') }} - {{ trans('admin.show')}} #{{$comment['name']}}</h2>
    <a class="btn btn-info" href="{{ aurl('comments')}}" class="btn btn-sm btn-primary">{{ trans('admin.comments')}}</a>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ trans('comment.name') }}</label>
            {{ $comment['name'] }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nwes_id">{{ trans('comment.news') }}</label>
            <a href="{{ aurl('news/show?id='.$comment['news_id'])}}">{{$comment['news_name']}}</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">{{ trans('comment.email') }}</label>
            {{ $comment['email'] }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">{{ trans('comment.status') }}</label>
            {{ trans('comment.'.$comment['status']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="comment">{{ trans('comment.comment') }}</label>
            {{ $comment['comment'] }}
        </div>
    </div>
    
    
</div>


<?php view('admin.layouts.footer'); ?>