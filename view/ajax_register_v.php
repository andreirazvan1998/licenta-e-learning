<?php
class ajax_register_v extends ajax_page_v
{
    function display()
    {
        $this->showErrors();
        ?>
        <form class="form" action="index.php" method="post" id="register_form">
            <input type="hidden" name="page" value="register">
            <input type="hidden" name="action" value="do_register">
            <div class="form-group">
                <label class="control-label" for="usr_username">Username</label>
                <input type="text" class="form-control" name="usr_username" id="usr_username" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label class="control-label" for="usr_name">Full Name</label>
                <input type="text" class="form-control" name="usr_name" id="usr_name" placeholder="Enter Full Name">
            </div>
            <div class="form-group">
                <label class="control-label" for="usr_password">Password</label>
                <input type="password" class="form-control" name="usr_password" id="usr_password" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label class="control-label" for="usr_repeat_password">repeat password</label>
                <input type="password" class="form-control" name="usr_repeat_password" id="usr_repeat_password" placeholder="Repeat password">
            </div>
            <div class="form-group">
                <label class="control-label" for="usr_email">Email</label>
                <input type="text" class="form-control" name="usr_email" id="usr_email" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>

        </form>
        <div class="form-group">
            <a href='index.php?page=login '>redirect</a>
        </div>
        <?php
    }
}