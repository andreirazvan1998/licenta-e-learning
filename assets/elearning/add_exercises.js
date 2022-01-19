function clearForm()
{
    $("#cx_cit_id").val(0); //curat
    $("#cx_subject").val("");
    $("#cx_solution").val("");
    $("#cx_points").val(0)
    $("#cx_mock_txt").val("")
    $("#cx_id").val(0);
}
$("#exercises_form_parent").on('submit','#add_exercises',function(e){
    e.preventDefault();
    console.log('form submitted');
    formAjax('index.php','add_exercises','exercises_content_parent',clearForm);
});
