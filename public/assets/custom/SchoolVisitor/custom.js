$(document).ready(function() {

    //vanila selectbox 

    selectBox = new vanillaSelectBox(".vanilla_session_search", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":200,
        "search": true,
        "placeHolder": "Choose..." 
    });

    selectBox2 = new vanillaSelectBox(".vanilla_class_search", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":200,
        "search": true,
        "placeHolder": "Choose..." 
    });
    selectBox3 = new vanillaSelectBox(".vanilla_status_search", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":200,
        "search": true,
        "placeHolder": "Choose..." 
    });

    

   

    

    

});

function setStatusModal(id,status){
    $("#v_model_id").val('');
    $("#v_model_status").val('');
    
    $("#v_model_id").val(id);
    $("#v_model_status").val(status);   
}
function changeStatus(){
    
    var id=$("#v_model_id").val();
 
    var status=$("#v_model_status").val();
    
    $.ajax({
		url: "/change-visitor-status",
		type: "POST",
		data: {
			id: id,
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
