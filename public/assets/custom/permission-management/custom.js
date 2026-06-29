
function changep(id,p){
    
    if($("#p-status_"+p).prop('checked') == true){
       var action='add';
    }else{
        var action='remove';
    }

    $.ajax({
		url: "/change-user-permission",
		type: "POST",
		data: {
			user_id: id,
		    action: action,
			permission: p,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult.data.id);
            Swal.fire({
                icon: 'success',
                title: 'Pemission Updated Successfully!',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Done!'
            }).then((result) => {
                location.reload();
            }); 
            
			
		}
	});


}

function changeSecStatus(id,s,c){
    
    if($("#p-status_"+s).prop('checked') == true){
       var action='add';
    }else{
        var action='remove';
    }

    $.ajax({
		url: "/change-user-section",
		type: "POST",
		data: {
			user_id: id,
		    action: action,
			s: s,
			c: c,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult.data.id);
            Swal.fire({
                icon: 'success',
                title: 'Pemission Updated Successfully!',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Done!'
            }).then((result) => {
                location.reload();
            }); 
            
			
		}
	});


}
function changeGroomingStatus(id,s,c){
    
    if($("#p-status_"+s).prop('checked') == true){
       var action='add';
    }else{
        var action='remove';
    }

    $.ajax({
		url: "/change-grooming-section",
		type: "POST",
		data: {
			user_id: id,
		    action: action,
			s: s,
			c: c,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult.data.id);
            Swal.fire({
                icon: 'success',
                title: 'Pemission Updated Successfully!',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Done!'
            }).then((result) => {
                location.reload();
            }); 
            
			
		}
	});


}
