$(document).ready(function() {
  
    questionCount('mcq_tbl_tr','mcq_counter');
    questionCount('blanks_tbl_tr','blanks_counter');
    questionCount('short_tbl_tr','short_counter');
    questionCount('long_tbl_tr','long_counter');
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
function questionCount(class_name,id_name){
    
    var numItems = $('.'+class_name).length;
    $("#"+id_name).html(numItems);

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
function setMcq(id,paper,type){
    let timerInterval
    Swal.fire({
    title: 'Paper Composer!',
    html: 'Processing............',
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval);
       
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer');
        questionCount('mcq_tbl_tr','mcq_counter');
    }
    });


        
    if($("#mcq_"+id+"_"+type).prop('checked') == true){
        $.ajax({
            url: "/set-paper-question",
            type: "POST",
            data: {
                
                id: id,
                paper:paper,
                type:1,
                marks:1,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
            },
            cache: false,
            success: function(dataResult){
                console.log(dataResult.data.id);
                if(dataResult.code==1){
                    console.log(dataResult.code);
                    Swal.fire({
                        title: 'Duplication!',
                        html: 'Already Added'});
                }else{
                    var quest=`<div class="row m-2 mcq_tbl_tr" id="mcq_tbl_tr_${dataResult.data.q_id}">
                     
                     <div class="col-9">
                     <p >Q: ${dataResult.data.question_text}</p>                
                     <p style="margin-left:10px;">(A) ${dataResult.data.o1}</p>                
                     <p style="margin-left:10px;">(A) ${dataResult.data.o2}</p>                
                     <p style="margin-left:10px;">(A) ${dataResult.data.o3}</p>                
                     <p style="margin-left:10px;">(A) ${dataResult.data.o4}</p>                
                     </div>
                     <div class="col-3 text-end">
                        <input type="number" min="1" onchange="updateMarks(this.value,${dataResult.data.id})" value="${dataResult.data.marks}" placeholder="Marks: " style="width:100px;height:40px;" name="mcq_number_${dataResult.data.q_id}" id="mcq_numbers_${dataResult.data.q_id}" >
   
                     </div>
                     
                   </div>`;
                    $("#mcq_tbl").append(quest);
                }
               
            }
            
        
        }); 
       
    }else if($("#mcq_"+id+"_"+type).prop('checked') == false){
        $.ajax({
            url: "/set-paper-question",
            type: "POST",
            data: {
                
                id: id,
                paper:paper,
                type:0,
                
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
            },
            cache: false,
            success: function(dataResult){
                console.log(dataResult.data.id);
                $("#mcq_tbl_tr_"+id).remove();
            }
            
        
        }); 
       
     }
     
}
function setBlank(id,paper,type){
    let timerInterval
    Swal.fire({
    title: 'Paper Composer!',
    html: 'Processing............',
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer');
        questionCount('blanks_tbl_tr','blanks_counter');
    }
    });

    
if($("#blanks_"+id+"_"+type).prop('checked') == true){
    $.ajax({
        url: "/set-paper-question",
        type: "POST",
        data: {
            
            id: id,
            paper:paper,
            type:1,
            marks:1,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
        cache: false,
        success: function(dataResult){
            console.log(dataResult.data.id);
            if(dataResult.code==1){
                console.log(dataResult.code);
                Swal.fire({
                    title: 'Duplication!',
                    html: 'Already Added'});
            }else{
            var quest=`<div class="row m-2 blanks_tbl_tr" id="blanks_tbl_tr_${dataResult.data.q_id}">
                     
                     <div class="col-9">
                     <p >Q: ${dataResult.data.question_text}__________${dataResult.data.after_blank}</p>                
                                   
                     </div>
                     <div class="col-3 text-end">
                     <label for="">Marks</label>
                        <input type="number" min="1" onchange="updateMarks(this.value,${dataResult.data.id})" value="${dataResult.data.marks}" placeholder="Marks: " style="width:100px;height:40px;" name="blanks_number_${dataResult.data.q_id}" id="blanks_numbers_${dataResult.data.q_id}" >
                        <label for="">Blank Dash Lines</label>
                            <input type="number" min="1" class="mt-1" value="${dataResult.data.after_lines}" onchange="updateLines(this.value,${dataResult.data.id})" placeholder="Blank Dash Lines:" style="width:100px;height:40px;" name="blanks_lines_${dataResult.data.q_id}" id="blanks_lines_${dataResult.data.q_id}" >

                     </div>
                     
                   </div>`;
            $("#blanks_tbl").append(quest);
            }
        }
        
    
    }); 
    
}else if($("#blanks_"+id+"_"+type).prop('checked') == false){
    $.ajax({
        url: "/set-paper-question",
        type: "POST",
        data: {
            
            id: id,
            paper:paper,
            type:0,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
        cache: false,
        success: function(dataResult){
            console.log(dataResult.data.id);
            $("#blanks_tbl_tr_"+id).remove();
        }
        
    
    }); 
    
    
 }
}
function setShort(id,paper,type){
    let timerInterval
    Swal.fire({
    title: 'Paper Composer!',
    html: 'Processing............',
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer');
        questionCount('short_tbl_tr','short_counter');
    }
    });

    
if($("#short_"+id+"_"+type).prop('checked') == true){
    $.ajax({
        url: "/set-paper-question",
        type: "POST",
        data: {
            
            id: id,
            paper:paper,
            type:1,
            marks:5,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
        cache: false,
        success: function(dataResult){
            console.log(dataResult.data.id);
            if(dataResult.code==1){
                console.log(dataResult.code);
                Swal.fire({
                    title: 'Duplication!',
                    html: 'Already Added'});
            }else{
            var quest=`<div class="row m-2 short_tbl_tr" id="short_tbl_tr_${dataResult.data.q_id}">
                     
                     <div class="col-9">
                     <p >Q: ${dataResult.data.question_text}</p>                
                                   
                     </div>
                     <div class="col-3 text-end">
                     <label for="">Marks</label>
                        <input type="number" min="1" onchange="updateMarks(this.value,${dataResult.data.id})" value="${dataResult.data.marks}" placeholder="Marks: " style="width:100px;height:40px;" name="short_number_${dataResult.data.q_id}" id="short_numbers_${dataResult.data.q_id}" >
                        <label for="">Lines</label>
                            <input type="number" min="1" class="mt-1" value="${dataResult.data.after_lines}" onchange="updateLines(this.value,${dataResult.data.id})" placeholder="Lines:" style="width:100px;height:40px;" name="short_lines_${dataResult.data.q_id}" id="short_lines_${dataResult.data.q_id}" >

                     </div>
                     
                   </div>`;
            $("#short_tbl").append(quest);
            }
        }
        
    
    }); 
    
}else if($("#short_"+id+"_"+type).prop('checked') == false){
    $.ajax({
        url: "/set-paper-question",
        type: "POST",
        data: {
            
            id: id,
            paper:paper,
            type:0,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
        cache: false,
        success: function(dataResult){
            console.log(dataResult.data.id);
            $("#short_tbl_tr_"+id).remove();
        }
        
    
    }); 
    
    
 }
}
function setLong(id,paper,type){
    let timerInterval
    Swal.fire({
    title: 'Paper Composer!',
    html: 'Processing............',
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer');
        questionCount('long_tbl_tr','long_counter');
    }
    });

   
if($("#long_"+id+"_"+type).prop('checked') == true){
    $.ajax({
        url: "/set-paper-question",
        type: "POST",
        data: {
            
            id: id,
            paper:paper,
            type:1,
            marks:10,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
        cache: false,
        success: function(dataResult){
            console.log(dataResult.data.id);
            if(dataResult.code==1){
                console.log(dataResult.code);
                Swal.fire({
                    title: 'Duplication!',
                    html: 'Already Added'});
            }else{
            var quest=`<div class="row m-2 long_tbl_tr" id="long_tbl_tr_${dataResult.data.q_id}">
                     
                     <div class="col-9">
                     <p >Q: ${dataResult.data.question_text}</p>                
                                   
                     </div>
                     <div class="col-3 text-end">
                     <label for="">Marks</label>
                        <input type="number" min="1" onchange="updateMarks(this.value,${dataResult.data.id})" value="${dataResult.data.marks}" placeholder="Marks: " style="width:100px;height:40px;" name="long_number_${dataResult.data.q_id}" id="long_numbers_${dataResult.data.q_id}" >
                        <label for="">Lines</label>
                        <input type="number" min="1" class="mt-1" value="${dataResult.data.after_lines}" onchange="updateLines(this.value,${dataResult.data.id})" placeholder="Lines:" style="width:100px;height:40px;" name="long_lines_${dataResult.data.q_id}" id="long_lines_${dataResult.data.q_id}" >

                     </div>
                     
                   </div>`;
            $("#long_tbl").append(quest);
            }
        }
        
    
    });
    
}else if($("#long_"+id+"_"+type).prop('checked') == false){
    $.ajax({
        url: "/set-paper-question",
        type: "POST",
        data: {
            
            id: id,
            paper:paper,
            type:0,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
        cache: false,
        success: function(dataResult){
            console.log(dataResult.data.id);
            $("#long_tbl_tr_"+id).remove();
        }
        
    
    });
   
 }
}
function updateMarks(marks,id){
    let timerInterval
    Swal.fire({
    title: 'Paper Composer!',
    html: 'Updating Marks............',
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer');
       
    }
    });
    $.ajax({
        url: "/set-paper-marks",
        type: "POST",
        data: {
            
            id: id,
            marks:marks,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
        cache: false,
        success: function(dataResult){
            console.log(dataResult.data.id);
            
        }
        
    
    });
    

}
function updateLines(lines,id){
    let timerInterval
    Swal.fire({
    title: 'Paper Composer!',
    html: 'Updating Lines............',
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer');
       
    }
    });
    $.ajax({
        url: "/set-paper-lines",
        type: "POST",
        data: {
            
            id: id,
            lines:lines,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
        cache: false,
        success: function(dataResult){
            console.log(dataResult.data.id);
            
        }
        
    
    });
    

}