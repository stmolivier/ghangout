onClientReady = function(){
    gapi.hangout.onApiReady.add(function(e){
        if (e.isApiReady){
            onApiReady();
        }
    })
};

onApiReady = function(){
    var param = getParameters();
    var now = new Date();

    var hangoutUrl = gapi.hangout.getHangoutUrl();

    var callbackUrl = 'register_hangout_json';

    //Make the call via AJAX
    $.ajax({
        url: callbackUrl,
        datatype: 'json',
        data:{
            "hangoutUrl": hangoutUrl,
            "topic": "SimUSante Hangout"
        }
    }).done( function(data, status, xhr ){
        //Call was made, process results
        $('#msg').html(data.msg);
    }).fail(function(xhr, status, error ){
        $('#msg').html("Problem trying to connect to Hangout. ("+status+")");
    });
};