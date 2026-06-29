$(document).ready(function() {
  
    //vanila selectbox 
    
    selectBox = new vanillaSelectBox(".vanilla_subject_class", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":200,
        "search": true,
        "placeHolder": "Choose Class" 

    }); 
    selectBox = new vanillaSelectBox(".vanilla_subject_section", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":200,
        "search": true,
        "placeHolder": "Choose Section" 

    }); 
    selectBox = new vanillaSelectBox(".vanilla_subject_teacher", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":200,
        "search": true,
        "placeHolder": "Choose Teacher" 

    }); 
   
    
}); 

function getSections(id,sect=null){
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
                if(element.id==sect){
                    var option = `<option  selected value="${element.id}">${element.section_name}</option>`;
                }else{
                    var option = `<option  value="${element.id}">${element.section_name}</option>`;
                }
                
                $('#section_id').append(option);
                selectBox = new vanillaSelectBox(".vanilla_subject_section", {
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
