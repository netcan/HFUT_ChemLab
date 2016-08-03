$(".delete").on("submit", function(){
    return confirm("确定要删除？");
});

 tinymce.init({
     selector: 'textarea',
     height: 360,
     plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
     toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
 });
