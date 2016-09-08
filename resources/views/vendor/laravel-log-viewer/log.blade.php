@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/dataTables.bootstrap.css">


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <h3><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Laravel Log Viewer</h3>
                <div class="list-group">
                    @foreach($files as $file)
                        <a href="?l={{ base64_encode($file) }}" class="list-group-item @if ($current_file == $file) llv-active @endif">
                            {{$file}}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-9 col-md-10 table-container">
                @if ($logs === null)
                    <div>
                        Log file >50M, please download it.
                    </div>
                @else
                    <table id="table-log" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Level</th>
                            <th>Date</th>
                            <th>Content</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($logs as $key => $log)
                            <tr>
                                <td class="text-{{{$log['level_class']}}}"><span class="glyphicon glyphicon-{{{$log['level_img']}}}-sign" aria-hidden="true"></span> &nbsp;{{$log['level']}}</td>
                                <td class="date">{{{$log['date']}}}</td>
                                <td class="text">
                                    @if ($log['stack']) <a class="pull-right expand btn btn-default btn-xs" data-display="stack{{{$key}}}"><span class="glyphicon glyphicon-search"></span></a>@endif
                                    {{{$log['text']}}}
                                    @if (isset($log['in_file'])) <br />{{{$log['in_file']}}}@endif
                                    @if ($log['stack']) <div class="stack" id="stack{{{$key}}}" style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}</div>@endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @endif
                <div>
                    <a href="?dl={{ base64_encode($current_file) }}"><span class="glyphicon glyphicon-download-alt"></span> Download file</a>
                    -
                    <a id="delete-log" href="?del={{ base64_encode($current_file) }}"><span class="glyphicon glyphicon-trash"></span> Delete file</a>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery.dataTables.js"></script>
    <script src="/js/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function(){
            $('#table-log').DataTable({
                "order": [ 1, 'desc' ],
                "stateSave": true,
                "stateSaveCallback": function (settings, data) {
                    window.localStorage.setItem("datatable", JSON.stringify(data));
                },
                "stateLoadCallback": function (settings) {
                    var data = JSON.parse(window.localStorage.getItem("datatable"));
                    if (data) data.start = 0;
                    return data;
                }
            });
            $('.table-container').on('click', '.expand', function(){
                $('#' + $(this).data('display')).toggle();
            });
            $('#delete-log').click(function(){
                return confirm('Are you sure?');
            });
        });
    </script>
@endsection
