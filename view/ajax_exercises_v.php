<?php

class ajax_exercises_v extends ajax_page_v
{
    function display()
    {
        $this->showErrors();
        $this->showSuccess();
        $input = $this->getInput(); 

        if (!empty($input["response"]["result"])) {
            ?>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <?php
                    foreach (array_keys($input["response"]["result"][0]) as $key) {
                        ?>
                        <th><?php echo $key ?></th>
                        <?php
                    }
                    ?>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($input["response"]["result"] as $row) {
                    ?>
                    <tr>
                        <?php
                        foreach ($row as $column) {
                            ?>
                            <td><?php echo $column ?></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <?php
        } else {
            echo $input["response"];
        }
    }

    function addForm()
    {
        $input = $this->getInput();
        if (!empty($input['courses_exercises']))
        foreach ($input['courses_exercises'] as $exe) {
            ?>
            <div class="exercises_form_div">
                <form class="form exercise_form" id="exercises<?php echo $exe['cx_id']?>" method="post" data-id="<?php echo $exe['cx_id']?>">
                    <input type="hidden" name="page" value="exercises">
                    <input type="hidden" name="action" value="check">
                    <input type="hidden" name="cx_id" value="<?php echo $exe["cx_id"] ?>">
                    <div class="form-group">
                        <p><?php echo $exe["cx_id"] . ". " . $exe["cx_subject"] ?></p>
                    </div>
                    <div class="form-group">
                        <label for="query">Enter your query</label>
                        <textarea rows="5" cols="80" class="form-control"
                                  placeholder="<?php echo $exe["cx_mock_txt"] ?>" name="q" id="query"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Execute</button>
                    </div>
                </form>
            </div>
            <?php
        }
    }
}