$(document).ready(function() {
  var active_class=$("#class_search").val();
    getClassSections(active_class);
  //vanila selectbox 
  
  selectBox = new vanillaSelectBox(".vanilla_section_search", {
      "keepInlineStyles":true,
      "maxHeight": 200,
      "minHeight": 200,
      "minWidth":200,
      "search": true,
      "placeHolder": "Choose..." 

  }); 
}); 

function getClassSections(id){
  var option = `<option value="">Choose one.....</option>`;
  var active_section=$("#section_id_h").val();
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
              
              if(active_section==element.id){
                var option = `<option value="${element.id}" selected >${element.section_name}</option>`;
              }else{
                var option = `<option value="${element.id}" >${element.section_name}</option>`;
              }
              
              $('#section_id').append(option);
               
  selectBox = new vanillaSelectBox(".vanilla_section_search", {
      "keepInlineStyles":true,
      "maxHeight": 200,
      "minHeight": 200,
      "minWidth":200,
      "search": true,
      "placeHolder": "Choose..." 

  }); 
            }); 
         
    
  }
      
  
  }); 

}

function default_attend(att,a_date,class_id,section_id){
  
  $.ajax({
		url: "/update-student-attendence-default",
		type: "POST",
		data: {
			  att: att,
		    a_date: a_date,
			  class_id: class_id,
			  section_id: section_id,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult);
            if(dataResult){
              location.reload();  
              
            }
            
			
		}
	});

}
function updateAttendence(att,a_date,id,str){
    $.ajax({
		url: "/update-student-attendence",
		type: "POST",
		data: {
			att: att,
		    a_date: a_date,
			id: id,
			
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
		cache: false,
		success: function(dataResult){
            console.log(dataResult);
            if(dataResult){
                $("#item_"+str+"_"+id).removeClass();
                $("#select_"+str+"_"+id).removeClass();
               if(att=='P'){
                 $("#item_"+str+"_"+id).addClass('td-bg');
                 $("#select_"+str+"_"+id).addClass('form-control present-bg');
                 
               }else if(att=='A'){
                 $("#item_"+str+"_"+id).addClass('td-bg');
                 $("#select_"+str+"_"+id).addClass('form-control absent-bg');

               }else if(att=='L'){
                 $("#item_"+str+"_"+id).addClass('td-bg');
                 $("#select_"+str+"_"+id).addClass('form-control leave-bg');

               }else if(att=='H'){
                $("#item_"+str+"_"+id).addClass('td-bg');
                $("#select_"+str+"_"+id).addClass('form-control halfday-bg');

              }else{
                 $("#item_"+str+"_"+id).addClass('td-bg');
                 $("#select_"+str+"_"+id).addClass('form-control simple-bg');
          
               }
               $("#total_p_"+id).html(dataResult.total_p);
               $("#total_a_"+id).html(dataResult.total_a);
               $("#total_l_"+id).html(dataResult.total_l);
               $("#total_h_"+id).html(dataResult.total_h);

            }
            
			
		}
	});

      
      
    

 }