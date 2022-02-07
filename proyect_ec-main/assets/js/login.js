$(document).ready(()=>{
    $('#frm_login').submit((e)=>{
        e.preventDefault();
        $.ajax({
            url: $('#frm_login').attr('action'),
            type: $('#frm_login').attr('method'),
            data:  $('#frm_login').serialize(),
            dataType: "json",
            success: function(d){   
                console.log(d);           
               if(!d.response){                 
                  alert(d.Men)
                  window.setTimeout("location.reload()", 2000);
               }else{
               alert(d.Men)
               }
            },
            error: function(err){
               alert("ERROR " + JSON.stringify(err, null, 2))
            }
         });
    })
})