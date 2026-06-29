$(document).ready(function() {
    
    //vanilla selectbox
    selectBox = new vanillaSelectBox(".vanilla_reports", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":220,
        "search": true,
        "placeHolder": "Choose..." 
    });

});
$(document).ready(function() {
    
    //vanilla selectbox
    selectBox = new vanillaSelectBox(".vanilla_reports2", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":220,
        "search": true,
        "placeHolder": "Choose..." 
    });

});

$(document).ready(function() {
    
    //vanilla selectbox
    selectBox = new vanillaSelectBox(".vanilla_reports3", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":220,
        "search": true,
        "placeHolder": "Choose..." 
    });
    selectBox = new vanillaSelectBox(".vanilla_exam_class", {
        "keepInlineStyles": true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth": 200,
        "search": true,
        "placeHolder": "Choose Class"

    });
    selectBox = new vanillaSelectBox(".vanilla_exam_section", {
        "keepInlineStyles": true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth": 200,
        "search": true,
        "placeHolder": "Choose Section"

    });

});


function getSections(id, sval = null) {
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
        success: function (dataResult) {
            console.log(dataResult.data[0].id);

            dataResult.data.forEach(element => {
                if (element.id == sval) {
                    var option = `<option selected value="${element.id}">${element.section_name}</option>`;
                } else {
                    var option = `<option  value="${element.id}">${element.section_name}</option>`;
                }



                $('#section_id').append(option);
                selectBox = new vanillaSelectBox(".vanilla_exam_section", {
                    "keepInlineStyles": true,
                    "maxHeight": 200,
                    "minHeight": 200,
                    "minWidth": 200,
                    "search": true,
                    "placeHolder": "Choose Section"

                });
            });


        }


    });

}