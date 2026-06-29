$(document).ready(function() {

    //vanila selectbox 

    selectBox = new vanillaSelectBox(".vanilla_fatherscnic", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":445,
        "search": true,
        "placeHolder": "Choose..." 
    });

    selectBox2 = new vanillaSelectBox(".vanilla_class", {
        "keepInlineStyles":true,
        "maxHeight": 200,
        "minHeight": 200,
        "minWidth":445,
        "search": true,
        "placeHolder": "Choose..." 
    });

    //ending vanila selectbox


    $('.select2').select2({
        
    });

    //father select2 

    $('.father_select2').select2({
        
        language: {
        noResults: function() {
            return '<button data-bs-toggle="modal" data-bs-target="#addFather_Modal" class="btn btn-warning" id="no-results-btn">No Result Found. Create New Father</button>';
        },
        },
        escapeMarkup: function(markup) {
        return markup;
        },
        
    });

    //ending father select2

    //family select2 

    $('.family_select2').select2({
        
        language: {
        noResults: function() {
            return '<button data-bs-toggle="modal" data-bs-target="#addFamily_Modal" class="btn btn-warning" id="no-results-btn">No Result Found. Create New Family</button>';
        },
        },
        escapeMarkup: function(markup) {
        return markup;
        },
        
    });

    //ending family select2

    //class select2 

    $('.class_select2').select2({
        
        language: {
        noResults: function() {
            return '<button data-bs-toggle="modal" data-bs-target="#addClass_Modal" class="btn btn-warning" id="no-results-btn">No Result Found. Create New Class</button>';
        },
        },
        escapeMarkup: function(markup) {
        return markup;
        },
        
    });

    //ending class select2

    //class section select2 

    $('.section_select2').select2({
        
        language: {
        noResults: function() {
            return '<button data-bs-toggle="modal" data-bs-target="#addClassSection_Modal" class="btn btn-warning" id="no-results-btn">No Result Found. Create New Section</button>';
        },
        },
        escapeMarkup: function(markup) {
        return markup;
        },
        
    });

    //ending class section select2

    // repeaters 

    $("#resphone_repeater").createRepeater(); 
    $("#emerphone_repeater").createRepeater(); 
    $("#spoken_repeater").createRepeater(); 
    $("#familymembers_repeater").createRepeater(); 
    $("#healthissue_repeater").createRepeater();


    // repeaters ending 

});

function myFunction(id) {

   
    var current_amount = $("#grand_total_b").val();
    var mega_discount=0;
    $('.mega_discount').each(function(){
        mega_discount += parseFloat(this.value);
       
    });
    var new_total = 0;
    $('.paid_amount').each(function(){
        new_total += parseFloat(this.value);
    });

    var decided_total = 0;
    $('.decided_amount').each(function(){
        decided_total += parseFloat($(this).text());
    });

    var discount = decided_total-new_total;
    var new_total =new_total-mega_discount;

    //$('#discount').html(discount);
    $('#megadiscount').html(mega_discount);

    
    $("#grand_total_a").html(new_total);
    $("#grand_total_b").val(new_total);

}



function myInvoice() {

   
    var current_amount = $("#grand_total_b").val();
    var mega_discount=0;
    $('.mega_discount').each(function(){
        mega_discount += parseFloat(this.value);
       
    });
    var new_total = 0;
    $('.paid_amount').each(function(){
        new_total += parseFloat(this.value);
    });

    var decided_total = 0;
    $('.discount_amount').each(function(){
        decided_total += parseFloat($(this).text());
    });

    var discount = decided_total-new_total;
    var new_total =new_total-mega_discount;

    //$('#discount').html(discount);
    $('#megadiscount').html(mega_discount);

    
    $("#grand_total_a").html(new_total);
    $("#grand_total_b").val(new_total);

}
//Create Father

