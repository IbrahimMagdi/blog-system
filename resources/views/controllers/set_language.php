<?php
if(in_array(request('lang'), ['ar', 'en'])){
    set_local(request('lang'));
}

back();