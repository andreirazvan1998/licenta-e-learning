<?php
class ajax_admin_login_v extends ajax_page_v
{
    function display()
    {
        $this->showErrors();
        ?>

        <form class="form" action="index.php" method="post" id="admin_login_form">
            <p>ADMIN LOGIN</p>
            <input type="hidden" name="page" value="admin_login">
            <input type="hidden" name="action" value="do_admin_login">
            <div class="form-group">
                <label class="control-label" for="ad_username">Username</label>
                <input type="text" class="form-control" name="ad_username" id="ad_username" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label class="control-label" for="ad_password">Password</label>
                <input type="password" class="form-control" name="ad_password" id="ad_password" placeholder="Enter password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>

        </form>

        <?php
    }
}