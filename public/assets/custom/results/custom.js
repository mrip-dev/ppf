

function updateResults(id,marks,exam){
	$("#loaded_"+id).addClass('d-none');
	$("#loader_"+id).removeClass('d-none');
    $.ajax({
		url: "/update-student-result",
		type: "POST",
		data: {
			  marks: marks,
		    exam: exam,
			  id: id,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult);
            if(dataResult){
				$("#loader_"+id).addClass('d-none');
				$("#loaded_"+id).removeClass('d-none');
                 // $("#item_"+id).removeClass();
                //$("#select_"+str+"_"+id).removeClass();
               
              
            }
            
			
		}
	});

      
      
    

 }
 
function changep(id,exam){
	if($("#p-status_"+id).prop('checked') == true){
		var att='P';
	 }else{
		 var att='A';
	 }
	
    $.ajax({
		url: "/update-student-result-att",
		type: "POST",
		data: {
			  att: att,
		    exam: exam,
			  id: id,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult);
            if(dataResult){
				const Toast = Swal.mixin({
					toast: true,
					position: 'center-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})	
				Toast.fire({
					icon: 'success',
					title: 'Success'
				})
            }
            
			
		}
	});

      
      
    

 }
 function updateResults2(id,marks,exam){
	$("#loaded_"+id+"_"+exam).addClass('d-none');
	$("#loader_"+id+"_"+exam).removeClass('d-none');
    $.ajax({
		url: "/update-student-result",
		type: "POST",
		data: {
			  marks: marks,
		    exam: exam,
			  id: id,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult);
            if(dataResult){
				$("#loader_"+id+"_"+exam).addClass('d-none');
				$("#loaded_"+id+"_"+exam).removeClass('d-none');
                 // $("#item_"+id).removeClass();
                //$("#select_"+str+"_"+id).removeClass();
               
              
            }
            
			
		}
	});

      
      
    

 }
 function changep2(id,exam){
	if($("#p-status_"+id+"_"+exam).prop('checked') == true){
		var att='P';
	 }else{
		 var att='A';
	 }
	
    $.ajax({
		url: "/update-student-result-att",
		type: "POST",
		data: {
			  att: att,
		    exam: exam,
			  id: id,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult);
            if(dataResult){
				const Toast = Swal.mixin({
					toast: true,
					position: 'center-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})	
				Toast.fire({
					icon: 'success',
					title: 'Success'
				})
            }
            
			
		}
	});

      
      
    

 }