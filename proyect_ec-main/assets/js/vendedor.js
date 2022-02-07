$(document).ready(()=>{
    $('#btn_').click(function(){
        $('#modal_c').modal('show');
    })
    
    $("#txtCad").keyup(()=>{
        var pv = $('#txtPV').val()
        var c = $("#txtCad").val()
        var st = $('#txtStock').val()

        console.log("ST ==> " + st + " C ==> " + c);

        if(c>st){
            alert("La cantidad no puede ser mayor que el stock")
            return;
        }
        $("#txtTotal").val(pv*c)
    })

    $('#frm_add_cart').submit((e)=>{
        e.preventDefault();
        
        console.log($('#frm_add_cart').serialize());
        $.ajax({
            url: $('#frm_add_cart').attr('action'),
            type: $('#frm_add_cart').attr('method'),
            data:  $('#frm_add_cart').serialize(),
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
                console.log(JSON.stringify(err, null, 2));
                alert("ERROR " + JSON.stringify(err, null, 2))
            }
        });
    })

    $('#btnAddCliente').click(()=>{
        $('#modal_p').modal('show');    
     })

     $('#reg_cliente').submit(function(e){
        e.preventDefault();
        console.log($('#reg_cliente').serialize());
        $.ajax({
            url: $('#reg_cliente').attr('action'),
            type: $('#reg_cliente').attr('method'),
            data:  $('#reg_cliente').serialize(),
            dataType: "json",
            success: function(d){              
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
    });

    $('#delete_cli').submit(function(e){
        e.preventDefault();
        console.log($('#delete_cli').serialize());
        $.ajax({
            url: $('#delete_cli').attr('action'),
            type: $('#delete_cli').attr('method'),
            data:  $('#delete_cli').serialize(),
            dataType: "json",
            success: function(d){              
                if(d.response){                 
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
    });
})

function btn_cli_del(id) {
    $('#_id').val(id);
    $('#modal_del_p').modal('show');
 }
 

function btn_cli_up(id) {
    $('#dato').val("3");
    $('#_id_').val(id);
 
    console.log($('#reg_cliente').serialize());
 
    $.ajax({
       url: $('#reg_cliente').attr('action'),
       type: $('#reg_cliente').attr('method'),
       data:  $('#reg_cliente').serialize(),
       dataType: "json",
       success: function(d){         
          if(d.response){
 
             $('#dato').val("2");
             $('#_id_').val(id);
             
             $('#txtDoc').val(d.Men.DOC);
             $('#txtNom').val(d.Men.NOM);
             $('#txtAPE').val(d.Men.APE);

             $('#txtTel_').val(d.Men.TEL);
 
             $('#modal_p').modal('show');
          }else{
             alert(d.Men)
          }
       },
       error: function(err){
          alert("ERROR " + JSON.stringify(err, null, 2))
       }
    });
 }


function modal_add_cart_idex(id) {
    $.ajax({
        url: '../../service/serviceVendedor.php',
        type: 'post',
        data:  {dato: 2},
        dataType: "json",
        success: function(d){         
           if(d.response){
               $('#dato').val(1)
               $('#_id').val(d.Men.ID)
               console.log(d);
               $('#txtCod').val(d.Men.COD)
               $('#txtNom').val(d.Men.NOM)
               $('#txtStock').val(d.Men.ST)
               $('#txtPV').val(d.Men.PV)
              $('#modal_c').modal('show');
           }else{
              alert(d.Men)
           }
        },
        error: function(err){
           alert("ERROR " + JSON.stringify(err, null, 2))
        }
     });    
}


function logout() {
    $.ajax({
       url: $('#frm_logout').attr('action'),
       type: $('#frm_logout').attr('method'),
       data:  $('#frm_logout').serialize(),
       dataType: "json",
       success: function(d){
          alert('Sesion cerrada')
          window.setTimeout("location.reload()", 2000);
       },
       error: function(err){
          alert("ERROR " + JSON.stringify(err, null, 2))
       }
    });
 }

 function details(id) {
     $('#tbl_vent_').empty();
    $.ajax({
        url: '../../service/serviceVendedor.php',
        type: 'post',
        data:  {dato: 1, id: id},
        dataType: "json",
        success: function(d){         
           if(d.response){
               console.log(d);
               $('#tbl_vent_').empty();
               var val = 0;
               $.each(d.Men, function (i,item) {
                                    
                    $("#tbl_vent_").append("<tr>");

                    $("#tbl_vent_").append("<td>" + item.COD + "</td>");
                    $("#tbl_vent_").append("<td>" + item.NOM + "</td>");
                    $("#tbl_vent_").append("<td>" + item.CANT + "</td>");
                    $("#tbl_vent_").append("<td>" + convertDivisas(item.P_V) + "</td>");
                    $("#tbl_vent_").append("<td>" + convertDivisas(item.TOTAL) + "</td>");
                    $("#tbl_vent_").append("<td>" + item.CAT + "</td>");

                    $("#tbl_vent_").append("</tr>");

                    let number = Number(item.TOTAL)
                    val = val + number;
                })

                console.log('VAL ==> ' + val);
                
                $('#tt').text(convertDivisas(val))
                
               $('#modal_p').modal('show');
           }else{
              alert(d.Men)
           }
        },
        error: function(err){
           alert("ERROR " + JSON.stringify(err, null, 2))
        }
     });
 }


 function convertDivisas(params) {
     return Intl.NumberFormat("en-US",{style: "currency", currency:"USD"}).format(params);
 }