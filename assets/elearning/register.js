function clearForm()
{
    //callback dummy
    console.log("Callback running");
}
$("#register_form_parent").on('submit','#register_form',function(e){
    e.preventDefault();
    console.log('form submitted');
    formAjax('index.php','register_form','register_form_parent',clearForm);
});