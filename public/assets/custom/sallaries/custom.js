$(document).ready(function() {
    
    //vanilla selectbox
    selectBox = new vanillaSelectBox(".vanilla_employees", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":220,
        "search": true,
        "placeHolder": "Choose..." 
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
                selectBox = new vanillaSelectBox(".vanilla_employees", {
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
function getemployeeData(id) {
            $('#gratuity').val(0);
            $('#security').val(0);
            $('#advance').val(0);
  
    $.ajax({
        url: "/getEmployeeData",
        type: "POST",
        data: {

            id: id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        cache: false,
        success: function (dataResult) {
            $('#gratuity').val(dataResult.data.gratuity ?? 0);
            $('#security').val(dataResult.data.security ?? 0);
            $('#advance').val(dataResult.data.total_advance ?? 0);
        }


    });

}