<?php
class ajax_lessons_v extends ajax_page_v
{

    function display()
    {
        $input = $this->getInput();
        $this->showErrors("");
        ?>
        <table class="table table-bordered table-hover" id="inscriere">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th class="dropdown">description</th>
                <th >Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ((array)$input['courses'] as $crs) {
                ?>
                <tr>
                    <td><?php echo $crs["crs_id"] ?></td>
                    <td><?php echo $crs["crs_title"] ?></td>
                    <td><?php echo $crs["crs_description"] ?></td>
                    <th>
                        <a href="#" class="text-success"
                           onclick="loadAjax('index.php','&page=lessons&action=load_course&crs_id=<?php echo $crs['crs_id'] ?>','main_form_parent');return false;">Inscriere</a>
                    </th>


                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }

}

?>