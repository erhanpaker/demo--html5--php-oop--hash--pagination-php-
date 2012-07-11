function checkUsername(username, validateUsername){
    $.ajax({
        url: "processFrom.php",
        type: "post",
        data: "username="+username+'&validateUsername='+validateUsername,
        dataType: "json",
        beforeSend: function() {
            $('#message').empty();
            $('#loader').show();
        },
        // callback handler that will be called on success
        success: function(html){
            if(html)
                $('#message').empty().html('The username already exist.');
        },
        // callback handler that will be called on error
        error: function(jqXHR, textStatus, errorThrown){
            $('#message').empty().html('The following error occured: ' + textStatus, errorThrown);
        },
        // callback handler that will be called on completion
        // which means, either on success or error
        complete: function(){      
            $('#loader').hide();
        }
    });

}

$(document).ready(function(){
    $("#form").validate({
        rules:
        {
            password:
            {
                required: true,
                minlength: 8
            }

        },
        messages:
        {
            password:
            {
                required: "Please enter the password.",
                minlength: "Tha password is not long enough."
            }
        }
    });
    
    $('#username').focusout(function(){
        checkUsername($('#username').val(), true);
    });
});