<?php
class ajax_docker_manager_v extends ajax_page_v
{
    function display()
    {
        $input = $this->getInput();
        ?>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Doocker Name</th>
                <th>Docker used</th>
                <th>data_add</th>
                <th>data_edit</th>
                <th>Docker port</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ((array)$input['docker_containers'] as $usr) {
                ?>
                <tr>
                    <td><?php echo $usr["dck_id"] ?></td>
                    <td><?php echo $usr["dck_name"] ?></td>
                    <td><?php echo $usr["dck_used"] ?></td>
                    <td><?php echo $usr["dck_date_add"] ?></td>
                    <td><?php echo $usr["dck_date_edit"] ?></td>
                    <td><?php echo $usr["dck_port"] ?></td>
                    <th>
                        <a href="#"
                           onclick="loadAjax('index.php','&page=docker_manager&action=load_docker&dck_id=<?php echo $usr['dck_id'] ?>','docker_form_parent');return false;">Edit</a>
                    </th>
                    <th>
                        <a href="#" class="text-danger"
                           onclick="if (confirm('Are you sure?')) loadAjax('index.php','&page=docker_manager&action=delete&dck_id=<?php echo $usr['dck_id'] ?>','docker_content_parent');return false;">Delete</a>
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
        <form class="form" action="index.php" method="post" id="docker_form">
            <input type="hidden" name="page" value="docker_manager">
            <input type="hidden" name="action" value="add">
            <?php
            if (!empty($input['docker_edit'])) {
                //acest parametru folosesti cand ai operatii obisnuite, nu doar editare
                //in acest caz acest input va fi ignorat, il bag aici sa ai forma completa
                ?>
                <input type="hidden" name="dck_id" value="<?php echo $input['docker_edit']['dck_id'] ?>">
                <?php
            }
            ?>
            <div class="form-group">
                <label for="dck_name">Docker Name</label>
                <input required="required" type="text" class="form-control" name="dck_name" id="dck_name"
                       placeholder="Docker name"
                       value="<?php echo !empty($input['docker_edit']['dck_name']) ? $input['docker_edit']['dck_name']: ""; ?>">
            </div>
            <div class="form-group">
                <label for="dck_used">Docker used</label>
                <input type="text" class="form-control" name="dck_used" id="dck_used" placeholder="if is not used add 0 or 1"
                       value="<?php echo !empty($input['docker_edit']['dck_used']) ? $input['docker_edit']['dck_used']: ""; ?>">
            </div>
            <div class="form-group">
                <label for="dck_port">Docker Port</label>
                <input type="text" class="form-control" name="dck_port" id="dck_port" placeholder="Docker port"
                       value="<?php echo !empty($input['docker_edit']['dck_port']) ? $input['docker_edit']['dck_port'] : ""; ?>">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
        <?php
    }

}