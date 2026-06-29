$(document).ready(function () {

    var sclass = $("#s_class").val();
    var sSection = $("#s_section").val();
    var sSubject = $("#s_subject").val();
    if (sclass) {
        getSections(sclass, sSection);
        if (sSection) {
            getSubjects(sSection, sSubject);
            getSubjectsEdit(sSection, sSubject);
        }
    }
    //vanila selectbox 

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
    selectBox = new vanillaSelectBox(".vanilla_exam_subject", {
        "keepInlineStyles": true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth": 200,
        "search": true,
        "placeHolder": "Choose subject"

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
function getSubjects(id, sval = null) {
    $('#subjects_body').html('');

    $.ajax({
        url: "/getSubjects",
        type: "POST",
        data: {

            section_id: id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        cache: false,
        success: function (dataResult) {
            console.log(dataResult.data[0].id);
            dataResult.data.forEach(element => {

                var new_row = `<tr>
                <td><input type="hidden" value="${element.id}" name="subject_ids[${element.id}]" id="">${element.name}</td>
                <td><input type="number" class="form-control" min="0" value="0" name="total_marks[${element.id}]" id=""></td>
                <td> <input type="date" class="form-control" name="dates[${element.id}]" id="date"></td>
                <td><input type="checkbox" checked name="subjects_checked[${element.id}]" id=""></td>
                </tr>`;
                $('#subjects_body').append(new_row);


            });


        }


    });

}
function getSubjects(id, sval = null) {
    $('#subjects_body').html('');

    $.ajax({
        url: "/getSubjects",
        type: "POST",
        data: {

            section_id: id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        cache: false,
        success: function (dataResult) {
            console.log(dataResult.data[0].id);
            dataResult.data.forEach(element => {

                var new_row = `<tr>
                <td><input type="hidden" value="${element.id}" name="subject_ids[${element.id}]" id="">${element.name}</td>
                <td><input type="number" class="form-control" min="0" value="0" name="total_marks[${element.id}]" id=""></td>
                <td> <input type="date" class="form-control" name="dates[${element.id}]" id="date"></td>
                <td><input type="checkbox" checked name="subjects_checked[${element.id}]" id=""></td>
                </tr>`;
                $('#subjects_body').append(new_row);


            });


        }


    });

}
function getSubjectsEdit(id, sval = null) {
  
    var option = `<option value="">Choose one.....</option>`;
    $('#subject_id').html(option);
   

    $.ajax({
        url: "/getSubjects",
        type: "POST",
        data: {

            section_id: id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        cache: false,
        success: function (dataResult) {
          
            dataResult.data.forEach(element => {

               

                if (element.id == sval) {
                    var option = `<option selected value="${element.id}">${element.name}</option>`;
                } else {
                    var option = `<option  value="${element.id}">${element.name}</option>`;
                }
                $('#subject_id').append(option);
                selectBox = new vanillaSelectBox(".vanilla_exam_subject", {
                    "keepInlineStyles": true,
                    "maxHeight": 200,
                    "minHeight": 200,
                    "minWidth": 200,
                    "search": true,
                    "placeHolder": "Choose Subject"

                });


            });


        }


    });
    selectBox = new vanillaSelectBox(".vanilla_exam_subject", {
        "keepInlineStyles": true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth": 200,
        "search": true,
        "placeHolder": "Choose Subject"

    });

}