$(document).ready(function() {
    
    //vanilla selectbox
    selectBox = new vanillaSelectBox(".vanilla_student_search", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":220,
        "search": true,
        "placeHolder": "Choose..." 
    });
    selectBoxcl = new vanillaSelectBox(".vanilla_class_search", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":220,
        "search": true,
        "placeHolder": "Choose..." 
    });
    const newLocal = ".vanilla_fam_search";
    selectBoxfg = new vanillaSelectBox(newLocal, {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":200,
        "search": true,
        "placeHolder": "Choose..." 

    }); 

});

