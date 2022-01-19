function clearForm()
{
    //callback dummy
    $("#query").val("");
    console.log("Callback running");
}
$("#exercises_parent").on('submit','.exercise_form',function(e){
    e.preventDefault();
    var current_id=$(this).data('id');
    formAjax('index.php','exercises'+current_id,'results_parent',clearForm);
});