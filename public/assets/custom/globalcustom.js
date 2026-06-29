

function deleteItem(item_id, url){
         $('#item_id_modal').val('');
         $('#url_modal').val('');
         $('#deleteModal').modal('show');
         $('#item_id_modal').val(item_id);
         $('#url_modal').val(url);
      
}
function openNotificationModal(id,father_name,student_name,campus){
    $('#n_id').val('');
    $('#student_name').html('');
    $('#father_name').html('');
    $('#notifyModal').modal('show');
    var title='Birthday';
    var msg=`Dear ${father_name}, We're excited to share that today is ${student_name}'s birthday! Join us in sending best wishes for a day filled with joy and laughter. As ${student_name} continues to grow, we're grateful to have you as part of our school community, contributing to their journey. Your support and involvement are truly appreciated.Warm regards, ${campus}`;

     $('#n_id').val(id);
     $('#father_name').html(father_name);
     $('#student_name').html(student_name);
     $("#n_title").val(title);
     $("#n_body").val(msg);
 
}
function deleteConfirm(){
   
    var item_id=$('#item_id_modal').val();
    var url=$('#url_modal').val();
    var email=$('#delete_email').val();
    var password=$('#delete_password').val();
     $.ajax({
                url:'/delete-confirm',
                type: 'POST',
                data:{
                    email:email,
                    password:password,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
                },
                success: function(response){
                    if(response=='success'){
                        deleteItem2(item_id, url);

                        $('#deleteModal').modal('hide');

                    }else{
                        Swal.fire(
                            'Authentication Error!',
                            'Data Can Not be Deleted.',
                            '!!!!'
                          );
                          $('#deleteModal').modal('hide');
                          $('#item_id_modal').val('');
                          $('#url_modal').val('');
                    }
                   
        
                   
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    }
                });
    
 
}
function deleteItem2(item_id, url){  
      
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
           

            $.ajax({
                url:   url+item_id,
                type: 'DELETE',
                
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
                },
                success: function(response){
                    //console.log(response);
                    //alert('done');

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      );
                        
                    $('#item_'+item_id).remove();
                    if(url=='/RescuePhone/'){
                        $('#item_res_'+item_id).remove();
                    }
                    if(url=='/EmergencyPhone/'){
                        $('#item_em_'+item_id).remove();
                    }
                    
                    
                    
                     $('#item_id_modal').val('');
                     $('#url_modal').val('');
        
                   
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    }
                });
            
          
        }else{
            $('#item_id_modal').val('');
            $('#url_modal').val('');
        }
    });
}
function submitSingleDelete(item_id, url){  
      
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
           

            $.ajax({
                url:   url,
                type: 'POST',
                data:{
                    id:item_id
                },
                
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
                },
                success: function(response){
                    //console.log(response);
                    //alert('done');

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      );
                        
                    $('#item_'+item_id).remove();
                    
        
                   
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    }
                });
            
          
        }else{
          
        }
    });
}
function submitConfirm(item_id){  
      
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, submit it!'
    }).then((result) => {
        if (result.isConfirmed) {
             if(item_id=='pay_student_fee'){
                $('#pay_student_fee_btn').addClass('disabled');
                
              }
              if(item_id=='pay_parent_fee'){
             
                $('#pay_parent_fee_btn').addClass('disabled');
              }
              $('#'+item_id+'_btn').addClass('disabled');
              $("#form_"+item_id).submit(); 
        }
    });
}

