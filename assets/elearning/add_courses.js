function clearForm()
{
    //callback dummy
    console.log("Callback running");
}
$("#course_form_parent").on('submit','#course_form',function(e){
    e.preventDefault();
    console.log('form submitted');
    formAjax('index.php','course_form','course_form_parent',clearForm);
});