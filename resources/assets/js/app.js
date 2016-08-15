// dependencies
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

$( document ).ready(function() {
    console.log($.fn.tooltip.Constructor.VERSION);
});

// app
$(".delete").on("submit", function(){
    return confirm("确定要删除？");
});

