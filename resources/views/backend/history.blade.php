<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
<script src="{!!asset('assets/js/datatables.min.js')!!}"></script>
<script src="{!!asset('assets/js/bootbox.min.js')!!}"></script>

<?php
$data = \DB::table('links')->where('user_id',\Session::get('id'))->get();
?>


<table class="table table-bordered table-hover" id="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Original Link</th>
            <th>Start Date</th>
            <th>Expired Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script>
    $('#table').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "{{url('datatable')}}"
    });
    $('#table').on('click','a',function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({
                method: 'GET',
                url : '{{url("view")}}' + "/" + $(this).data('id'),
                success: function(data) {
                    bootbox.alert(data);
                },
            });
        });    
</script>