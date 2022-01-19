function clearForm()
{
    $("#dck_name").val(""); //curat
    $("#dck_port").val("");
    $("#dck_used").prop('checked',false);
    $("#dck_id").val(0);
}
$("#docker_form_parent").on('submit','#docker_form',function(e){
    e.preventDefault();
    formAjax('index.php','docker_form','docker_content_parent',clearForm);
});