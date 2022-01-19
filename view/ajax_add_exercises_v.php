<?php


class ajax_add_exercises_v extends ajax_page_v
{
    public function display()
    {
        $input=$this->getInput();
        ?>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Exercise ID</th>
                <th>Course ID</th>
                <th>Cerinta</th>
                <th>Solutie</th>
                <th>Punctaj exercitiu</th>
                <th>Mock text</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($input['courses_exercises'] as $exe) {
                ?>
                <tr>
                    <td><?php echo $exe["cx_id"] ?></td>
                    <td><?php echo $exe["cx_crs_id"] ?></td>
                    <td><?php echo $exe["cx_subject"] ?></td>
                    <td><?php echo $exe["cx_solution"] ?></td>
                    <td><?php echo $exe["cx_points"] ?></td>
                    <td><?php echo $exe["cx_mock_txt"] ?></td>
                    <th>
                        <a href="#"
                           onclick="loadAjax('index.php','&page=add_exercises&action=load_exercises&cx_id=<?php echo $exe['cx_id'] ?>','exercises_form_parent');return false;">Edit</a>
                    </th>
                    <th>
                        <a href="#" class="text-danger"
                           onclick="if (confirm('Are you sure?')) loadAjax('index.php','&page=add_exercises&action=delete&cx_id=<?php echo $exe['cx_id'] ?>','exercises_content_parent');return false;">Delete</a>
                    </th>

                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
    function addExercises(){
        $input = $this->getInput();
        ?>
        <form class="form" action="index.php" method="post" id="add_exercises">
            <input type="hidden" name="page" value="add_exercises">
            <input type="hidden" name="action" value="add_exe">
            <?php
            if (!empty($input['exe_edit'])) {
                ?>
                <input type="hidden" name="cx_id" value="<?php echo $input['exe_edit']['cx_id'] ?>">
                <?php
            }
            ?>
            <div class="form-group">
                <label class="control-label" for="cx_cit_id">courses id</label>
                <input type="text" class="form-control" name="cx_crs_id" id="cx_crs_id" placeholder="courses id"
                       value="<?php echo !empty($input['exe_edit']['cx_crs_id']) ? $input['exe_edit']['cx_crs_id']: ""; ?>">
            </div>
            <div class="form-group">
                <label class="control-label" for="cx_subject">Cerinta</label>
                <input type="text" class="form-control" name="cx_subject" id="cx_subject" placeholder="Enter exercise subject"
                       value="<?php echo !empty($input['exe_edit']['cx_subject']) ? $input['exe_edit']['cx_subject']: ""; ?>">
            </div>
            <div class="form-group">
                <label class="control-label" for="cx_solution">Solutie</label>
                <input type="text" class="form-control" name="cx_solution" id="cx_solution" placeholder="solutie"
                       value="<?php echo !empty($input['exe_edit']['cx_solution']) ? $input['exe_edit']['cx_solution']: ""; ?>">
            </div>
            <div class="form-group">
                <label class="control-label" for="cx_points">Punctaj exercitiu</label>
                <input type="text" class="form-control" name="cx_points" id="cx_points" placeholder="punctaj curs"
                       value="<?php echo !empty($input['exe_edit']['cx_points']) ? $input['exe_edit']['cx_points']: ""; ?>">
            </div>
            <div class="form-group">
                <label class="control-label" for="cx_mock_txt">Mock text</label>
                <input type="text" class="form-control" name="cx_mock_txt" id="cx_mock_txt" placeholder="mock text"
                       value="<?php echo !empty($input['exe_edit']['cx_mock_txt']) ? $input['exe_edit']['cx_mock_txt']: ""; ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">add exercises</button>
            </div>

        </form>
        <?php
    }

}