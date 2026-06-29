$(document).ready(function() {
  
    //vanila selectbox 
    
    selectBox = new vanillaSelectBox(".vanilla_paid_class", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":200,
        "search": true,
        "placeHolder": "Choose Class" 

    }); 
    selectBox = new vanillaSelectBox(".vanilla_paid_students", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":200,
        "search": true,
        "placeHolder": "Choose Section" 

    }); 
   
   
    
}); 

function getStudents(id){
    var option = `<option value="">Choose one.....</option>`;
    $('#student_id').html(option);

    $.ajax({
        url: "/getStudents",
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
              
                    var option = `<option  value="${element.id}">${element.student_name}</option>`;
                
                $('#student_id').append(option);
                selectBox = new vanillaSelectBox(".vanilla_paid_students", {
                    "keepInlineStyles":true,
                    "maxHeight": 200,
                    "minHeight": 200,
                    "minWidth":200,
                    "search": true,
                    "placeHolder": "Choose Section" 
            
                }); 
              }); 
           
            
        }
        
    
    }); 

}
