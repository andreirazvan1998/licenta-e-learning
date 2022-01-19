<?php
class ajax_add_course_v extends ajax_page_v
{
    function display()
    {
        $this->showErrors();
        ?>
        <form class="form" action="index.php" method="post" id="course_form">
            <input type="hidden" name="page" value="add_courses">
            <input type="hidden" name="action" value="add_course">
            <div class="form-group">
                <label class="control-label" for="crs_title">Course Title</label>
                <input type="text" class="form-control" name="crs_title" id="crs_title" placeholder="Enter course title">
            </div>
            <div class="form-group">
                <label class="control-label" for="crs_description">Course description</label>
                <input type="text" class="form-control" name="crs_description" id="crs_description" placeholder="Enter Description">
            </div>
            <div class="form-group">
                <label class="control-label" for="crs_points">Course points</label>
                <input type="text" class="form-control" name="crs_points" id="crs_points" placeholder="Enter course points">
            </div>
            <div class="form-group">
                <label class="control-label" for="crs_order">Course Order</label>
                <input type="text" class="form-control" name="crs_order" id="crs_order" placeholder="enter course order">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add course</button>
            </div>
        </form>
        <?php
    }
}