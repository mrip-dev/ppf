$(document).ready(function() {
  
    //vanila selectbox 
    var class_id=$("#class_id").val();
    var sect=$("#sect_id").val();
    var topic=$("#top_id").val();
    var type=$("#type").val();
    //getSubjects(class_id,sect);
    getTopics(sect,topic);
    setType(type);
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

function getSubjects(id,sect=null){
    var option = `<option value="">Choose one.....</option>`;
    $('#subject_id').html('');
    $('#subject_id').html(option);

    $.ajax({
        url: "/getQbSubjects",
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
                    var option = `<option  selected value="${element.id}">${element.name}</option>`;
                }else{
                    var option = `<option  value="${element.id}">${element.name}</option>`;
                }
                
                $('#subject_id').append(option);
                
              }); 
           
            
        }
        
    
    }); 

}
function getTopics(id,sect=null){
    var option = `<option value="">Choose one.....</option>`;
    $('#topic_id').html(option);

    $.ajax({
        url: "/getQbTopics",
        type: "POST",
        data: {
            
            subject_id: id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
        cache: false,
        success: function(dataResult){
            console.log(dataResult.data[0].id);
            
            dataResult.data.forEach(element => {
                if(element.id==sect){
                    var option = `<option  selected value="${element.id}">${element.name}</option>`;
                }else{
                    var option = `<option  value="${element.id}">${element.name}</option>`;
                }
                
                $('#topic_id').append(option);
                
              }); 
           
            
        }
        
    
    }); 

}