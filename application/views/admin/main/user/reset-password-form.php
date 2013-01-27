<h1><?php echo $title; ?></h1>
<div id="content-left">
    <form action="<?php echo site_url('admin/user/reset_password'); ?>" method="post">
        <p class="small">
            <label>* Password: </label>
            <input type="password" name="password" value="<?php echo set_value('password'); ?>"/>
        </p>
        <p class="small">
            <label>* Confirm password: </label>
            <input type="password" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>"/>
        </p>
        <p><input type="hidden" name="id" value="<?php echo $id; ?>"/></p>
        <p class="green">
            <button type="submit">Reset password</button>
        </p>
    </form>
</div>
<div id="content-right">
    <div class="text-canvas">
        <h3>Form rules</h3>
        <p><strong>Both fields</strong> is a requiered file, only alphanumeric characters are permited</p>
    </div>
    <div class="error"><?php echo $error; ?></div>
</div>