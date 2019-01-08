$(document).ready(function(){
    $('#table_data').DataTable( {
        "ajax":  'http://localhost/ss_training_1/datatable'
    });
    $('#table_data').on('click','#view',function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajax({
            method: 'GET',
            url :  'http://localhost/ss_training_1/view' + "/" + $(this).data('id'),
            success: function(data) {
                bootbox.alert(data);
            },
        });
    });    
});
