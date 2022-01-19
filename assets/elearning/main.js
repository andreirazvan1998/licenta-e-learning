function clearForm()
{
    $("#usr_email").val(""); //curat
    $("#usr_password").val("");
    $("#usr_name").val("");
    $("#usr_username").val("");
    $("#usr_id").val(0);
}
$("#main_form_parent").on('submit','#main_form',function(e){
    e.preventDefault();
    formAjax('index.php','main_form','main_content_parent',clearForm);    
});