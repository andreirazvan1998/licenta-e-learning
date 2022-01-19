<?php
class ajax_login_v extends ajax_page_v
{
    function display()
    {
        $this->showErrors();
        ?>
        <form class="form" action="index.php" method="post" id="login_form">
        <input type="hidden" name="page" value="login">
        <input type="hidden" name="action" value="do_login">
        <div class="form-group">
            <label class="control-label" for="usr_username">Username</label>
            <input type="text" class="form-control" name="usr_username" id="usr_username" placeholder="Enter username">
        </div>
        <div class="form-group">
            <label class="control-label" for="usr_password">Password</label>
            <input type="password" class="form-control" name="usr_password" id="usr_password" placeholder="Enter password">
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Log in</button>
        </div>
            <div class="form-group">
                <a href='index.php?page=register '>Register.</a>
            </div>
        </form>

        <?php
    }
}