<?php
$comments = db_paginate('comments', 'where status="show" and news_id ="' . request('id') . '"', 15, 'asc', '*', ['id'=>request('id')]);

?>
<div class="container mt-5 mb-5">

    <div class="row height d-flex justify-content-center align-items-center">

        <div class="col-md-7">

            <div class="card">

                <div class="p-3">

                    <h6>{{trans('main.comments')}}</h6>

                </div>
                <div class="alert alert-danger error_message d-none"></div>
                <form method="post" id="comment-form" action="{{ url('add/comment?news_id='.request('id'))}}">

                    <div class="mt-3 row align-items-start p-3 form-color">

                        <div class="col-auto">
                            <img src="https://ui-avatars.com/api/?name=Ahmed+Ali&size=60&background=random"
                                class="rounded-circle"
                                style="border: 2px solid #eee; box-shadow: 0 0 4px rgba(0,0,0,0.1);">
                        </div>

                        <div class="col">

                            <div class="row mb-2">
                                <div class="col">
                                    <input type="text" class="form-control" name="name" placeholder="{{ trans('main.name') }}">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="email" placeholder="{{ trans('main.email') }}">
                                </div>
                            </div>

                            <textarea class="form-control mb-2" rows="2" name="comment" placeholder="{{ trans('main.write_comment') }}"></textarea>
                        </div>
                        <button class="btn btn-success add_comment" type="button">{{ trans('main.add') }}</button>
                        <input type="hidden" name="_method" value="post">
                    </div>
                </form>
                <script>
                    $(document).on('click', '.add_comment', function() {
                        var form_data = $('#comment-form').serialize();
                        $.ajax({
                            url: $('#comment-form').attr('action'),
                            dataType: 'json',
                            type: 'post',
                            data: form_data,
                            beforeSend: function() {
                                $('.error_message').html('').addClass('d-none');

                            },
                            success: function(data) {
                                if (data.status == true) {
                                    location.reload();
                                    $('.error_message').html('').addClass('d-none');
                                }
                            },
                            error: function(xhr) {
                                var errors = xhr.responseJSON;
                                if (errors != null) {
                                    var error_html = '<ul>';
                                    $.each(errors, function(key, val) {
                                        for (i = 0; i < val.length; i++) {
                                            error_html += '<li>' + val[i] + '</li>';

                                        }
                                    });
                                    error_html += "</ul>";
                                    $('.error_message').html(error_html).removeClass('d-none');
                                }
                            }
                        })
                        return false;
                    });
                </script>
                <div class="mt-2">
                    <?php while ($comment = mysqli_fetch_assoc($comments['query'])): ?>

                        <div class="d-flex flex-row p-3">

                            <img src="https://ui-avatars.com/api/?name={{ $comment['name'] }}&size=50&background=random" width="40" height="40" class="rounded-circle ms-2" style="border: 2px solid #eee; box-shadow: 0 0 4px rgba(0,0,0,0.1);">

                            <div class="w-100">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-row align-items-center">
                                        <span class="ms-2">{{ $comment['name'] }}</span>
                                        <!-- <small class="c-badge">Top Comment</small> -->
                                    </div>
                                    <small><?php echo time_ago($comment['created_at']); ?></small>
                                </div>

                                <p class="text-justify comment-text ms-2">{{ $comment['comment'] }}</p>

                                <!-- <div class="d-flex flex-row user-feed"> -->
                                <!-- <span class="wish"><i class="fa fa-heartbeat ms-2"></i>24</span> -->
                                <!-- <span class="ml-3"><i class="fa fa-comments-o ms-2"></i>Reply</span> -->
                                <!-- </div> -->
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

            </div>
                {{ $comments['render'] }}
        </div>
    </div>

</div>