$(document).ready(function(){    
   //$('#table_id').DataTable();
   //$('#tabled').DataTable();
   $('#btnAddProc').click(()=>{    
      $.ajax({
         url: $('#reg_new_prod').attr('action'),
         type: $('#reg_new_prod').attr('method'),
         data: {dato: 5},
         dataType: "json",
         success: function(d){

            $('#slCat').append(
               '<option value="0">- Seleccione una opción -</option>'
             );
     
            $.each(d.Men, function (i,item) {
               $("#slCat").append(
                  "<option value=" + item.ID + ">" + item.NOM + "</option>"
                );
            })
            $('#modal_p').modal('show');
         },        
         error: function(err){
            alert("ERROR ==> " + JSON.stringify(err, null, 2))
         }
      });
   });

   $('#btnAddCat').click(()=>{    
      $('#modal_c').modal('show');
     });
   $('#btnAddEmp').click(()=>{
      $('#modal_p').modal('show');
   })

   $('#btnAddCliente').click(()=>{
      $('#slVend').empty();
      $.ajax({
         url: $('#reg_new_cliente').attr('action'),
         type: $('#reg_new_cliente').attr('method'),
         data: {dato: 5},
         dataType: "json",
         success: function(d){            

            $('#slVend').append(
               '<option value="0">- Seleccione una opción -</option>'
             );
     
            $.each(d.Men, function (i,item) {
               $("#slVend").append(
                  "<option value=" + item.ID + ">" + item.NOM + " - " + item.APE + "</option>"
                );
            })
            $('#modal_p').modal('show');
         },        
         error: function(err){
            alert("ERROR ==> " + JSON.stringify(err, null, 2))
         }
      });      
   })

   //Formularios
   $('#frm_reg_conf').submit((e)=>{
      e.preventDefault();
      console.log($('#frm_reg_conf').attr('action'));
      console.log($('#frm_reg_conf').serialize());
      $.ajax({
         url: $('#frm_reg_conf').attr('action'),
         type: $('#frm_reg_conf').attr('method'),
         data:  $('#frm_reg_conf').serialize(),
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
            console.log(JSON.stringify(err, null, 2));
            alert("ERROR ==> " + JSON.stringify(err, null, 2))
         }
      });
   })

   $('#reg_new_cat').submit(function(e){
      e.preventDefault();
      console.log($('#reg_new_cat').attr('action'));
      $.ajax({
         url: $('#reg_new_cat').attr('action'),
         type: $('#reg_new_cat').attr('method'),
         data:  $('#reg_new_cat').serialize(),
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
            console.log(JSON.stringify(err, null, 2));
            alert("ERROR ==> " + JSON.stringify(err, null, 2))
         }
      });
   }); 

   $('#delete_cat').submit(function(e){
   e.preventDefault();
      $.ajax({
         url: $('#delete_cat').attr('action'),
         type: $('#delete_cat').attr('method'),
         data: $('#delete_cat').serialize(),
         dataType: "json",
         success: function(d){              
            if(d.response){                 
               alert(d.Men)
               window.setTimeout("location.reload()", 2000);
            }else{
            alert(d.Men)
            }
         },
         xhr: function(){
         var xhr = new window.XMLHttpRequest();
         xhr.addEventListener("error", function(evt){
               alert("an error occured");
         }, false);
         xhr.addEventListener("abort", function(){
               alert("cancelled");
         }, false);
   
         return xhr;
      },
         error: function(err){
            alert("ERROR ==> " + JSON.stringify(err, null, 2))
         }
      });
   });

   $('#reg_new_prod').submit((evt)=>{
      evt.preventDefault();
      $.ajax({
      url: $('#reg_new_prod').attr('action'),
      type: $('#reg_new_prod').attr('method'),
      data:  $('#reg_new_prod').serialize(),
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
         alert("ERROR + " + err)
      }
   });
   })

   $('#delete_pro').submit((evt)=>{
      evt.preventDefault();

      $.ajax({
         url: $('#delete_pro').attr('action'),
         type: $('#delete_pro').attr('method'),
         data:  $('#delete_pro').serialize(),
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
   })

   $('#reg_new_emp').submit((evt)=>{
      evt.preventDefault();
      $.ajax({
       url: $('#reg_new_emp').attr('action'),
       type: $('#reg_new_emp').attr('method'),
       data:  $('#reg_new_emp').serialize(),
       dataType: "json",
       success: function(d){  
          console.log(d);            
          if(d.response){                 
             alert(d.Men)
             window.setTimeout("location.reload()", 2000);
          }else{
           alert(d.Men)
          }
       },
       error: function(err){
          alert("ERROR + " + JSON.stringify(err, null, 2))
       }
    });
   })

   $('#delete_emp').submit((evt)=>{
      evt.preventDefault();

      $.ajax({
         url: $('#delete_emp').attr('action'),
         type: $('#delete_emp').attr('method'),
         data:  $('#delete_emp').serialize(),
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
   })

   $('#reg_new_cliente').submit(function(e){
   e.preventDefault();
      $.ajax({
         url: $('#reg_new_cliente').attr('action'),
         type: $('#reg_new_cliente').attr('method'),
         data:  $('#reg_new_cliente').serialize(),
         dataType: "json",
         success: function(d){
            console.log("REGIS ==> " + d);
            if(!d.response){                 
               alert(d.Men);
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
});


function showModalCategoria(id) {

   $('#txtC').val("3");
   $('#txtIDC').val(id);

   $.ajax({
      url: $('#reg_new_cat').attr('action'),
      type: $('#reg_new_cat').attr('method'),
      data:  $('#reg_new_cat').serialize(),
      dataType: "json",
      success: function(d){         
         if(d.response){            
            $('#txtC').val("2");
            $('#txtIDC').val(d.Men.ID);
            $('#txtCategoria').val(d.Men.NOM);
            $('#modal_c').modal('show');
         }else{
            alert(d.Men)
         }
      },
      error: function(){
         alert("ERROR")
      }
   });
   
}

function showModalDeleteCategoria(id){
   
   $('#txtC').val("4");
   $('#txtIDCC').val(id);
   $('#modal_del').modal('show');   
}

function btn_prod_up(id) {
   $('#dato').val("3");
   $('#_id_').val(id);

   $.ajax({
      url: $('#reg_new_prod').attr('action'),
      type: $('#reg_new_prod').attr('method'),
      data:  $('#reg_new_prod').serialize(),
      dataType: "json",
      success: function(d){         
         if(d.response){
            $('#slCat').empty();
            $('#dato').val("2");
            $('#_id_').val(id);
            
            $('#txtCod').val(d.Men.COD);
            $('#txtNom').val(d.Men.NOM);
            $('#txtDescripcion').val(d.Men.DES);
            $('#txtPV').val(d.Men.PV);
            $('#txtPC').val(d.Men.PC);
            $('#txtStock').val(d.Men.STO);
            $('#txtImagen').val(d.Men.IMG);
            
            $('#slCat').append(
               '<option value="0">- Seleccione una opción -</option>'
             );

             $.each(d.MenCT, function (i,item) {

               var select = "";
               if(item.ID == d.Men.CT){
                  select = "selected";
               }                  
               $("#slCat").append(
                  "<option "+select+" value=" + item.ID + ">" + item.NOM + "</option>"
                );
            })

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

function btn_prod_del(id) {
   $('#_id').val(id);
   $('#modal_del_p').modal('show');
}

function btn_emp_up(id) {
   $('#dato').val("3");
   $('#_id_').val(id);

   $.ajax({
      url: $('#reg_new_emp').attr('action'),
      type: $('#reg_new_emp').attr('method'),
      data:  $('#reg_new_emp').serialize(),
      dataType: "json",
      success: function(d){         
         if(d.response){
            $('#slCat').empty();
            $('#dato').val("2");
            $('#_id_').val(id);
            
            $('#txtDoc').val(d.Men.COD);
            $('#txtNom').val(d.Men.NOM);
            $('#txtAPE').val(d.Men.APE);
            $('#txtDirec').val(d.Men.DIR);
            $('#txtTel').val(d.Men.TEL);
            $('#txtUS').val(d.Men.US);
            $('#txtPass').val(d.Men.PASS);

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

function btn_emp_del(id) {
   $('#_id').val(id);
   $('#modal_del_p').modal('show');
}

function btn_cli_up(id) {
   $('#dato').val("3");
   $('#_id_').val(id);

   console.log($('#reg_new_cliente').serialize());

   $.ajax({
      url: $('#reg_new_cliente').attr('action'),
      type: $('#reg_new_cliente').attr('method'),
      data:  $('#reg_new_cliente').serialize(),
      dataType: "json",
      success: function(d){         
         if(d.response){

            console.log(d.Men);

            $('#slVend').empty();
            $('#dato').val("2");
            $('#_id_').val(id);
            
            $('#txtDoc').val(d.Men.DOC);
            $('#txtNom').val(d.Men.NOM);
            $('#txtAPE').val(d.Men.APE);

            $('#txtTel_').val(d.Men.TEL);

            $('#slVend').append(
               '<option value="0">- Seleccione una opción -</option>'
             );

             $.each(d.DES, function (i,item) {

               var select = "";
               if(item.ID == d.Men.IDV){
                  select = "selected";
               }                  
               $("#slVend").append(
                  "<option "+select+" value=" + item.ID + ">" + item.NOM + " - " + item.APE + "</option>"
                );
            })

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

function btn_cli_del(id) {
   $('#_id').val(id);
   $('#modal_del_p').modal('show');
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