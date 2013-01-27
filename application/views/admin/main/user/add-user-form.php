<h1><?php echo $title; ?></h1>
<div id="content-left">
    <form method="post" action="<?php echo site_url('admin/user/add_user'); ?>">
        <p class="small">
            <label> * User Name</label>
            <input type="text" name="username" value="<?php echo set_value('username') ?>"/>
        </p>
        <p class="small">
            <label> * Email Address</label>
            <input type="text" name="email_address" value="<?php echo set_value('email_address') ?>"/>
        </p>
        <p class="small">
            <label> * Password</label>
            <input type="password" name="password" value="<?php echo set_value('password') ?>"/>
        </p>
        <p class="small">
            <label> * Confirm Password</label>
            <input type="password" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>"/>
        </p>
        <p class="green"><button type="submit">Add user</button></p>
    </form>
</div>
<div id="content-right">
    <div id="content-right">
        <div class="text-canvas">
            <h3>Form rules:</h3>
            <p><strong>Username</strong> is a required file, only alphanumeric chars, max length 25 chars.</p>
            <p><strong>Password</strong> is a required file, only alphanumeric chars.</p>
            <p><strong>Email</strong> is a required file, must be a valid email.</p>
        </div>
    <div class="error"><?php echo $error; ?></div>
</div>
</div>