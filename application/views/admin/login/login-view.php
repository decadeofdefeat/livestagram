            <form action="<?php echo base_url() . 'admin/login/validate/' ?>" method="post">
                <p><label> User Name: </label><input type="text" id="username" name="username" /></p>
                <p><label> Password: </label><input type="password" id="password" name="password" /></p>
                <p><button type="button" id="submit" onclick="loginForm()">Login</button></p>
            </form>