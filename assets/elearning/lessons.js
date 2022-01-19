$("#main_form_parent").on('submit','#inscriere',function(e){
    e.preventDefault();
    formAjax('index.php','inscriere','main_lessons_parent');
});