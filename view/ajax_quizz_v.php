<?php
class ajax_quizz_v extends ajax_page_v
{
    function display()
    {
        $input = $this->getInput();
        ?>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th >My Courses</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ((array)$input['courses'] as $crs) {
                ?>
                <tr>
                    <td><?php echo $crs["crs_title"] ?></td>
                    <th>
                        <a href="index.php?page=exercises&crs_id=<?php echo $crs["crs_id"]?>" class="text-success">exercises</a>
                    </th>
                    <th>
                        <a href="storage/<?php echo $crs["crs_course"] ?>" class="text-success">Lessons<a/>
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