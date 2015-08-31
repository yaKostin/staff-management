@extends('layouts.default')

@section('content')
    <div class="row">
        <button id="toogle_open_all_nodes_btn" class="btn btn-lg btn-success">Раскрыть все узлы</button>
    </div>

    <div class='row'>
        <div id="users_hierarchy" class="hidden">
            <ul>
                {!! $usersHierarchyHTML !!}
            </ul>
        </div>
    </div>
    
    <script>
        $(function() {
            $('#users_hierarchy').jstree({
                'core': {
                    'themes': {
                        'icons': false,
                    }
                }
            });
        });

        $('#users_hierarchy').on("ready.jstree", function (e, data) {
            $('#users_hierarchy').removeClass('hidden');
        });

        $('#toogle_open_all_nodes_btn').click(function() {
            if ( $('#toogle_open_all_nodes_btn').hasClass('btn-success') ) {
                $('#users_hierarchy').jstree('open_all');     
                $('#toogle_open_all_nodes_btn').removeClass('btn-success').addClass('btn-danger');
                $('#toogle_open_all_nodes_btn').text('Закрыть все узлы');
            }
            else {
                $('#users_hierarchy').jstree('close_all');     
                $('#toogle_open_all_nodes_btn').removeClass('btn-danger').addClass('btn-success');   
                $('#toogle_open_all_nodes_btn').text('Открыть все узлы');
            }
        });
    </script>
@stop