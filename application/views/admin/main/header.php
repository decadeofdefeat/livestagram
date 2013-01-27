<div id="header-inside-left">
    <h1>Instagram Admin</h1>
    <p>Moderate photos from the hashtag feed</p>
</div>
<div id="header-inside-right">
    <div class="logout">
        <p>Welcome <?php echo $this->session->userdata('username'); ?>! <a href="<?php echo site_url() . '/admin/login/signout/' ?>">Sign out</a></p>
    </div>
</div>