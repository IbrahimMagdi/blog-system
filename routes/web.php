<?php

include base_path('routes/admin.php');

route_post('sign-in', 'controllers.front.auth.sign_in');
route_get('register', 'front.auth.sign_up');
route_post('register', 'controllers.front.auth.sign_up');
route_get('sign-out', 'controllers.front.auth.sign_out');

route_get('/', 'front.home');
route_get('news/archive', 'front.archive');
route_get('category', 'front.categories.category');
route_get('news', 'front.categories.news');
route_post('add/comment', 'controllers.front.add_comment');


route_get('lang', 'controllers/set_language');
route_post('upload', 'controllers/upload');

