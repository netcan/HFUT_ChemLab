// dependencies
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
global.toastr = require('toastr');

$( document ).ready(function() {
    console.log($.fn.tooltip.Constructor.VERSION);
});

// app
$( document ).ready(function() {
    $(".delete").on("submit", function () {
        return confirm("确定要删除？");
    });

// questions manager
    var qurl = "/admin/questions/";
    var getAns = function (type, ans) {
        var Ans = ['A', 'B', 'C', 'D', '正确', '错误'];
        return Ans[Number(type) * 4 + Number(ans)];
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });

    $('body').on('click', '#add-question', function () {
        $('#question').trigger('reset');
        $('#question-title').text('添加题目');
        $('#qsave').text('添加');
        $('#qsave').val('add');
        $('#qtype').removeAttr('disabled');
        $('#qtype').val(0);
        $('#qselection').show();
        $('#qans').html(
            '<option value="">请选择答案</option>' +
            '<option value="0">A</option>' +
            '<option value="1">B</option>' +
            '<option value="2">C</option>' +
            '<option value="3">D</option>'
        );

        $('#qtype').change(function () {
            if ($('#qtype').val() == 1) { // 判断题
                $('#qselection').hide();
                $('#qans').html(
                    '<option value="">请选择答案</option>' +
                    '<option value="0">正确</option>' +
                    '<option value="1">错误</option>'
                );
            }
            else { // 单选题
                $('#qselection').show();
                $('#qans').html(
                    '<option value="">请选择答案</option>' +
                    '<option value="0">A</option>' +
                    '<option value="1">B</option>' +
                    '<option value="2">C</option>' +
                    '<option value="3">D</option>'
                );
            }
        });

        $('#questionModal').modal('show');
    });

    $('body').on('click', '.delete-question', function () {
        var qid = $(this).val();
        toastr.warning('你确定要删除？<br><button class="btn btn-info btn-raised btn-raised" id="delete-question-sure">确定</button>');
        $('#delete-question-sure').click(function () {
            $.ajax({
                url: qurl + qid,
                type: 'DELETE',
                success: function (data) {
                    toastr.info('删除成功');
                    $('#question' + qid).remove();
                },
                error: function (data) {
                    toastr.error('删除失败');
                    // $('.panel-body').append(data.responseText);
                }
            });
        });
    });

    $('body').on('click', '.edit-question', function () {
        $('#question').trigger('reset');
        $('#question-title').text('修改题目');
        $('#qsave').text('更新');
        $('#qsave').val('update');
        var qid = $(this).val();
        $.get(qurl + qid, function (data) {
            console.log(data);
            $('#qtype').val(data.type);
            $('#qtype').attr('disabled', 'disabeld');
            $('#qid').val(qid);
            $('#qcontent').val(data.content);
            if (data.type == 0) {
                $('#qselection').show();
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
        if (event.keyCode == 13)
            $('#qsave').click();
    });

    $('#qsave').click(function (e) {
        var qid = $('#qid').val();
        e.preventDefault(); // 阻止默认事件，即提交事件

        var data = {
            type: $('#qtype').val(),
            content: $('#qcontent').val(),
            A: $('#qA').val(),
            B: $('#qB').val(),
            C: $('#qC').val(),
            D: $('#qD').val(),
            ans: $('#qans').val()
        };

        if ($('#qsave').val() == 'update') {
            var type = 'PUT';
            var url = qurl + qid;
        }
        else {
            var type = 'POST';
            var url = qurl;
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

                var question = '<tr id="question' + data.id + '">' +
                    '<td>' + (data.type == 0 ? "单选" : "判断") + '</td>' +
                    '<td>' + data.content + '</td>' +
                    '<td>' + data.A + '</td>' +
                    '<td>' + data.B + '</td>' +
                    '<td>' + data.C + '</td>' +
                    '<td>' + data.D + '</td>' +
                    '<td>' + getAns(data.type, data.ans) + '</td>' +
                    '<td><button class="btn btn-info edit-question btn-raised" value="' + data.id + '">修改</button> ' +
                    '<button class="btn btn-warning delete-question btn-raised" value="' + data.id + '">删除</button>' +
                    '</td>' +
                    '</tr>';
                console.log(question);

                if ($('#qsave').val() == 'update') {
                    $('#question' + data.id).replaceWith(question);
                    toastr.success('修改成功！');
                }
                else {
                    $('tbody').append(question);
                    toastr.success('添加成功！');
                }

                $('#questionModal').modal('hide');
            },
            error: function (data, json, errorThrown) {
                console.log(data);
                // $('.panel-body').append(data.responseText);
                var errors = data.responseJSON;
                var errorsHtml = '';
                $.each(errors, function (key, value) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error(errorsHtml, "Error " + data.status + ': ' + errorThrown);

            }
        });
    });

// paper manage
    var purl = 'edit/';
    $('body').on('click', '.paper-question-action', function () {
        var button = $(this);
        var action = button.text();
        var qid = button.val();
        console.log(action);
        if (action == '添加') {
            $.ajax({
                type: 'put',
                url: purl + qid,
                success: function (data) {
                    button.attr('class', 'btn btn-warning paper-question-action btn-raised');
                    button.text('移除');
                    console.log(data);
                    toastr.success('添加成功');
                },
                error: function (data, json, errorThrown) {
                    console.log(data);
                    // $('.panel-body').append(data.responseText);
                    var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors, function (key, value) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    toastr.error(errorsHtml, "Error " + data.status + ': ' + errorThrown);
                    $('.panel-body').append(data.responseText);
                }
            });
        }
        else {
            $.ajax({
                type: 'delete',
                url: purl + qid,
                success: function (data) {
                    button.attr('class', 'btn btn-info paper-question-action btn-raised');
                    button.text('添加');
                    console.log(data);
                    toastr.warning('移除成功');
                },
                error: function (data, json, errorThrown) {
                    console.log(data);
                    // $('.panel-body').append(data.responseText);
                    var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors, function (key, value) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    toastr.error(errorsHtml, "Error " + data.status + ': ' + errorThrown);
                    $('.panel-body').append(data.responseText);
                }
            });
        }
    });




});

