// dependencies
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
global.toastr = require('toastr');

$( document ).ready(function() {
    console.log($.fn.tooltip.Constructor.VERSION);
});

// app
$(".delete").on("submit", function(){
    return confirm("确定要删除？");
});

// questions manager
var qurl = "/admin/questions/";
var getAns=function(type,ans) {
    var Ans = ['A', 'B', 'C', 'D', '正确', '错误'];
    return Ans[Number(type)*4+Number(ans)];
};

$('.edit-question').click(function () {
    var qid = $(this).val();
    $.get(qurl+qid, function (data) {
        console.log(data);
        $('#qtype').val(data.type);
        $('#qtype').attr('disabled', 'disabeld');
        $('#qid').val(qid);
        $('#qcontent').val(data.content);
        if(data.type == 0) {
            $('#qA').val(data.A);
            $('#qB').val(data.B);
            $('#qC').val(data.C);
            $('#qD').val(data.D);
            $('#qans').html(
                '<option value="0">A</option>' +
                '<option value="1">B</option>' +
                '<option value="2">C</option>' +
                '<option value="3">D</option>'
            );
            $('#qans').val(data.ans);
        }
        else {
            $('#qselection').hide();
            $('#qans').html(
                '<option value="0">正确</option>' +
                '<option value="1">错误</option>'
            );
            $('#qans').val(data.ans);
        }
    });
    $('#questionModal').modal('show');
});

$('#questionModal').keyup(function (event) {
    if(event.keyCode == 13)
        $('#qsave').click();
});

$('#qsave').click(function (e) {
    var qid = $('#qid').val();
    e.preventDefault(); // 阻止默认事件，即提交事件
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#question input[name="_token"]').val()
        }
    });

    var data = {
        type: $('#qtype').val(),
        content: $('#qcontent').val(),
        A: $('#qA').val(),
        B: $('#qB').val(),
        C: $('#qC').val(),
        D: $('#qD').val(),
        ans: $('#qans').val()
    };

    if($('#qsave').val() == 'update') {
        var type = 'PUT';
        var url = qurl + qid;
    }

    console.log(data);
    console.log(url);

    $.ajax({
        type: type,
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            console.log(data);

            if($('#qsave').val() == 'update') {
                var d = [data.content, data.A, data.B, data.C, data.D, getAns(data.type,data.ans)];
                for(var i=0; i<d.length; ++i)
                    $('#question'+data.id+' td:eq('+Number(i+1)+')').text(d[i]);
                toastr.success('修改成功！');
            }

            $('#questionModal').modal('hide');
            $('#question').trigger('reset');
        },
        error: function (data, json, errorThrown) {
            var errors = data.responseJSON;
            var errorsHtml= '';
            $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>';
            });
            toastr.error( errorsHtml , "Error " + data.status +': '+ errorThrown);

            console.log(errors);
        }
    });
});
