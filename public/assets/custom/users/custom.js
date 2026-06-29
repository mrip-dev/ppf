


function setStatusModal(type,id,status){
    $("#user_model_id").val('');
  $("#user_model_type").val('');
  $("#user_model_status").val('');
    
  $("#user_model_id").val(id);
  $("#user_model_type").val(type);
  $("#user_model_status").val(status);
    
}

function changeStatus(){
    
    var id=$("#user_model_id").val();
    var type=$("#user_model_type").val();
    var status=$("#user_model_status").val();
    

    


    $.ajax({
		url: "/change-user-status",
		type: "POST",
		data: {
			user_id: id,
		    type: type,
			status: status,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult.data.id);
            Swal.fire({
                icon: 'success',
                title: 'Status Updated Successfully!',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Done!'
            }).then((result) => {
                location.reload();
            }); 
            
			
		}
	});


}

function changeallStatus(){
  
    var status=$("#user_model_allstatus").val();
    
    $.ajax({
		url: "/change-user-allstatus",
		type: "POST",
		data: {
			
			status: status,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult.data.id);
            Swal.fire({
                icon: 'success',
                title: 'Status Updated Successfully!',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Done!'
            }).then((result) => {
                location.reload();
            }); 
            
			
		}
	});


}