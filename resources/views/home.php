<?php
 view('layout.header', ['title' => trans('main.home')]); 


// set_local('ar');
// session('locale', 'ar');
 ?>

<h1>home page</h1>
<br>
@if(any_errors())
    <div class='alert alert-danger'>
        <ol>
        @foreach(all_errors() as $error)
            <li><?php echo $error; ?></li>
        @endforeach
        </ol>
    </div>
@endif

@php 
$email_valid = get_error('email');
$mobil_valid = get_error('mobile');
$address_valid = get_error('address');
end_errors();
@endphp
 {{ 'welcom to view engine' }}
 <br>
 {{ url('upload') }}
<form method="post" action="<?php echo url('upload'); ?>" enctype="multipart/form-data">
    <label>email:</label>
    <input type="text" value="<?php echo old('email')?>" name="email" class="from-control <?php echo !empty($email_valid)? 'is-invalid' : 'is-valid' ?>" />
    <div class="<?php echo !empty($email_valid)? 'invalid-feedback' : 'valid-feedback' ?>">
        <?php echo $email_valid ?>
    </div>
    <label>mobile:</label>
    <input type="text" value="<?php echo old('mobile')?>" name="mobile" class="from-control <?php echo !empty($mobil_valid)? 'is-invalid' : 'is-valid' ?>" />
    <div class="<?php echo !empty($mobil_valid)? 'invalid-feedback' : 'valid-feedback' ?>">
        <?php echo $mobil_valid ?>
    </div>
    <label>address:</label>
    <input type="text" value="<?php echo old('address')?>" name="address" class="from-control <?php echo !empty($address_valid)? 'is-invalid' : 'is-valid' ?>" />
    <div class="<?php echo !empty($address_valid)? 'invalid-feedback' : 'valid-feedback' ?>">
        <?php echo $address_valid ?>
    </div>
    <input type="hidden" name="_method" value="post" />
    <input type="submit" class="btn btn-success" value="send" />
</form>


<?php view('layout.footer'); ?>
