$(document).ready(function(){
    $('#navmenu').on('click','#ajax-link',function(e){
        $('#result').html('Loading...');
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajax({
            method: 'GET',
            url : $(this).attr('href'),
            success: function(data) {
                $('#result').html(data);
            },
            error: function(xhr, status, err) {
                alert(status + ': ' + xhr.responseText);
            }
        });            
    });
    
    $('#create_link').validationEngine();
    $('#create_link').on('submit',function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        if($(this).validationEngine('validate')){
            $('#result_url').html('Loading...');
            $.ajax({
                data : $(this).serialize() ,
                method: 'GET',
                url : $(this).attr('action'),
                success: function(data) {
                    $('#result_url').html(data);
                },
            });            
        }
    });

});
