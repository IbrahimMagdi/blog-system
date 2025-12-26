<?php
$comments = db_paginate('comments', 'where status="show" and news_id ="' . request('id') . '"', 15, 'desc', '*', ['id' => request('id')]);

$user = null;
$is_logged_in = false;
if (session_has('success_auth')) {
    $user = json_decode(session('success_auth'), true);
    $is_logged_in = true;
}
?>
<div class="container mt-5 mb-5">

    <div class="row height d-flex justify-content-center align-items-center">

        <div class="col-md-7" style="width:100%">

            <div class="card">

                <div class="p-3">

                    <h6>{{trans('main.comments')}}</h6>

                </div>
                <div class="alert alert-danger error_message d-none"></div>

                <form method="post" id="comment-form" action="<?= url('add/comment?news_id=' . request('id')) ?>">

                    <div class="mt-3 row align-items-start p-3 form-color">

                        <div class="col-auto">
                            <?php if ($is_logged_in): ?>
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&size=60&background=random"
                                    class="rounded-circle"
                                    style="border: 2px solid #eee; box-shadow: 0 0 4px rgba(0,0,0,0.1);">
                            <?php else: ?>
                                <img src="https://ui-avatars.com/api/?name=Guest&size=60&background=cccccc"
                                    class="rounded-circle"
                                    style="border: 2px solid #eee; box-shadow: 0 0 4px rgba(0,0,0,0.1);">
                            <?php endif; ?>
                        </div>

                        <div class="col">
                            <textarea class="form-control mb-2"
                                rows="2"
                                name="comment"
                                placeholder="<?= trans('main.write_comment') ?>"
                                <?= !$is_logged_in ? 'readonly' : '' ?>></textarea>
                        </div>

                        <!-- زر الإضافة -->
                        <div class="col-auto d-flex align-items-start">
                            <button class="btn btn-success add_comment"
                                type="button"
                                data-logged-in="<?= $is_logged_in ? 'true' : 'false' ?>">
                                <?= trans('main.add') ?>
                            </button>
                        </div>

                        <input type="hidden" name="_method" value="post">

                        <?php if ($is_logged_in): ?>
                            <input type="hidden" name="name" value="<?= $user['name'] ?>">
                            <input type="hidden" name="email" value="<?= $user['email'] ?>">
                        <?php endif; ?>

                    </div>
                </form>
                <script>
                    $(document).on('click', '.add_comment', function() {
                        var isLoggedIn = $(this).data('logged-in');

                        if (isLoggedIn !== true && isLoggedIn !== 'true') {
                            $('#loginModal').modal('show');
                            return false;
                        }

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

                    $(document).on('click', 'textarea[readonly]', function() {
                        $('#loginModal').modal('show');
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
                                    </div>
                                    <small><?php echo time_ago($comment['created_at']); ?></small>
                                </div>

                                <p class="text-justify comment-text ms-2">{{ $comment['comment'] }}</p>

                              
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

            </div>
            {{ $comments['render'] }}
        </div>
    </div>

</div>