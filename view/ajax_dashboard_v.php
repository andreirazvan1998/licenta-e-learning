<?php
class ajax_dashboard_v extends ajax_page_v
{
    function display()
    {
        $input = $this->getInput();
        ?>
        <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Docker</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ((array)$input['users'] as $usr) {
            ?>
            <tr>
                <td><?php echo $usr["usr_id"] ?></td>
                <td><?php echo $usr["usr_name"] ?></td>
                <td><?php echo $usr["usr_username"] ?></td>
                <td><?php echo $usr["usr_email"] ?></td>
                <td><?php echo $usr["dck_name"] ?></td>
                <th>
                    <a href="#"
                       onclick="loadAjax('index.php','&page=dashboard&action=load_user&usr_id=<?php echo $usr['usr_id'] ?>','main_form_parent');return false;">Edit</a>
                </th>
                <th>
                    <a href="#" class="text-danger"
                       onclick="loadAjax('index.php','&page=dashboard&action=delete_user&usr_id=<?php echo $usr['usr_id'] ?>','main_content_parent');return false;">Delete</a>
                </th>

            </tr>
            <?php
        }
        ?>
        </tbody>
        </table>
        <?php
    }
        function addForm()
        {
            $input = $this->getInput();
            //asta intra in sidebar
            ?>
            <form class="form" action="index.php" method="post" id="main_form">
                <input type="hidden" name="page" value="dashboard">
                <input type="hidden" name="action" value="add">
                <?php
                if (!empty($input['user_edit'])) {
                    //acest parametru folosesti cand ai operatii obisnuite, nu doar editare
                    //in acest caz acest input va fi ignorat, il bag aici sa ai forma completa
                    ?>
                    <input type="hidden" name="usr_id" value="<?php echo $input['user_edit']['usr_id'] ?>">
                    <?php
                }
                ?>
                <div class="form-group">
                    <label for="usr_username">Username</label>
                    <input required="required" type="text" class="form-control" name="usr_username" id="usr_username"
                           placeholder="Username"
                           value="<?php echo !empty($input['user_edit']['usr_username']) ? $input['user_edit']['usr_username'] : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="usr_password">Password</label>
                    <input type="text" class="form-control" name="usr_password" id="usr_password"
                           placeholder="Password, leave empty if you do not want to change">
                </div>
                <div class="form-group">
                    <label for="usr_name">Name</label>
                    <input type="text" class="form-control" name="usr_name" id="usr_name" placeholder="Full name"
                           value="<?php echo !empty($input['user_edit']['usr_name']) ? $input['user_edit']['usr_name'] : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="usr_name">Docker Container</label>
                    <input type="text" class="form-control" name="usr_dck_id" id="usr_dck_id" placeholder="Docker Container"
                           value="<?php echo !empty($input['user_edit']['usr_dck_id']) ? $input['user_edit']['usr_dck_id'] : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="usr_email">Email</label>
                    <input type="email" class="form-control" name="usr_email" id="usr_email" placeholder="Email"
                           value="<?php echo !empty($input['user_edit']['usr_email']) ? $input['user_edit']['usr_email'] : ""; ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
            <?php
        }


}