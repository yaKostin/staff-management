@extends('layouts.default')

@section('content')
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                    },
                    "check_callback" : true
                },
                'dnd': {
                    'inside_pos': 'last'
                },
                "plugins" : [
                    "dnd"
                ]
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

        $(document).on("dnd_move.vakata", function (e, data) {
            console.log(data);
        });

        $(document).on("dnd_stop.vakata", function (e, data) {
            $('#users_hierarchy').jstree('refresh');
            var childId = $(data.element).find('span').data('id');
            var t = $(data.event.target);
            var parentNode = t.closest('.jstree-node');
            var parentId = $(parentNode).find('span').data('id');
            $.ajax({
                type: "POST",
                url: 'http://localhost/staff-management/public/employees/change-parent',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'childId': childId,
                    'parentId': parentId
                }
            })
            .done(function(response) {
                //alert( response);
            })
            .fail(function() {
                //alert( "error" );
            });
        });

    </script>
@stop