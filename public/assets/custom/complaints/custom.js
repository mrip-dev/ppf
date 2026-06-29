function getSections(id){
    var option = `<option value="">Choose one.....</option>`;
    $('#section_id').html(option);

    $.ajax({
		url: "/getClassSections",
		type: "POST",
		data: {
			
			class_id: id,
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult.data[0].id);
            
            dataResult.data.forEach(element => {
                var option = `<option value="${element.id}">${element.section_name}</option>`;
                $('#section_id').append(option);
              }); 
           
			
		}
        
    
    }); 

}

function getClasses(id){
    var option = `<option value="">Choose one.....</option>`;
    $('#class_search_id').html(option);

    $.ajax({
		url: "/getClasses",
		type: "POST",
		data: {
			
			campus_id: id,
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult.data[0].id);
            
            dataResult.data.forEach(element => {
                var option = `<option value="${element.id}">${element.class_name}</option>`;
                $('#class_search_id').append(option);
              }); 
           
			
		}
        
    
    }); 

}

