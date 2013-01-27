<h1><?php echo $title; ?></h1>
<div id="content-left">
    <form method="post" action="<?php echo site_url('admin/user/update_user'); ?>">
        <p class="small">
            <label> * User Name</label>
            <input type="text" name="username" value="<?php echo $result->username; ?>"/>
        </p>
        <p class="small">
            <label> * Email Address</label>
            <input type="text" name="email_address" value="<?php echo $result->email_address; ?>"/>
        </p>
        <p><input type="hidden" name="id" value="<?php echo $id; ?>"></p>
        <p class="green"><button type="submit">Edit user</button></p>
    </form>
</div>
<div id="content-right">
    <div id="content-right">
        <div class="text-canvas">
            <h3>Form rules:</h3>
            <p><strong>Username</strong> is a requiered file, only alfanumeric chars, max length 25 chars.</p>
            <p><strong>Email</strong> is a requiered file, must be a valid email.</p>
        </div>
    <div class="error"><?php echo $error; ?></div>
</div>
</div>