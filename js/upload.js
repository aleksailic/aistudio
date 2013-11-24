//Callback handler for form submit event
$("#uploadform").submit(function(e)
{
    $('#submitbtn').attr('disabled','disabled');
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: formURL,
    type: 'POST',
        data:  formData,
    mimeType:"multipart/form-data",
    contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {
        $('#submitbtn').removeAttr('disabled');
        var data = JSON.parse(data);

        //output log to stream div and console
        console.log(data.status+": "+data.data);
        if(data.status=='error'){
          streamOutput('<p style="color:rgb(255,0,0)">'+data.data+'</p>');  
        }else{
            streamOutput('<p style="color:rgb(0,255,0)">'+data.data+'</p>');
        }

        //if successful add newly created theme to the list without refreshing the page
        if(data.status=='success'){
            var html='<li data-id="'+data.dir+'">';
            html += $("#theme-name").val();
            html +='<div class="buttons">';
            html +='  <div class="rename"></div>';
            html +='  <div class="remove"></div>';
            html +='</div>';
            html +='</li>';
            $("#theme-list").append(html);
        }
        
 
    },
     error: function(jqXHR, textStatus, errorThrown)
     {
     }         
    });
    e.preventDefault(); //Prevent Default action.
});
 
$("#multiform").submit(); //Submit the form