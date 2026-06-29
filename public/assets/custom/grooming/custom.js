

function validateAndUpdateGrooming(input,month,year,id,key,date,type){
	$("#loaded_"+id+'_'+month+'_'+key).addClass('d-none');
	$("#loader_"+id+'_'+month+'_'+key).removeClass('d-none');
	marks=input.value;
   if(type=='remarks'){

   }else if(type=='auto'){
	$("#loaded_attendance").addClass('d-none');
	$("#loader_attendance").removeClass('d-none');

   }else{
	max_range=input.max;
	if(marks>max_range){
		marks=max_range;
	}
   }
	
	
	const newLocal = "/update-student-grooming";
    $.ajax({
		url: newLocal,
		type: "POST",
		data: {
			  marks: marks,
		      month: month,
		      year: year,
			  id: id,
			  key: key,
			  date: date,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult);
            if(dataResult){
				$("#loader_"+id+'_'+month+'_'+key).addClass('d-none');
				$("#loaded_"+id+'_'+month+'_'+key).val(marks);
				$("#loaded_"+id+'_'+month+'_'+key).removeClass('d-none');
				if(type=='auto'){
					$("#loaded_attendance").removeClass('d-none');
					$("#loader_attendance").addClass('d-none');
				
				}
              
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