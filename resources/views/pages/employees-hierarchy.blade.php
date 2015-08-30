@extends('layouts.default')
@section('content')
    <div class="title"> 
        <h1>Иерархия сотрудников</h1>
    </div>
    <div class="row">
        <button id="toogle_open_all_nodes_btn" class="btn btn-success">Раскрыть все узлы</button>
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

                $('#users_hierarchy').jstree('set_icon', 'j1_1_anchor', 'http://maps.google.com/mapfiles/kml/pal3/icon55.png');     
                
            }
            else {
                $('#users_hierarchy').jstree('close_all');     
                $('#toogle_open_all_nodes_btn').removeClass('btn-danger').addClass('btn-success');   
                $('#toogle_open_all_nodes_btn').text('Открыть все узлы');
            }
        });
    </script>
@stop

