$(document).ready(function() {

    //father select2 

    $('.employee_select2').select2({
        
        language: {
        noResults: function() {
            return '<button data-bs-toggle="modal" data-bs-target="#addEmployee_Modal" class="btn btn-warning" id="no-results-btn">No Result Found. Create New Employeer</button>';
        },
        },
        escapeMarkup: function(markup) {
        return markup;
        },
        
    });

    //ending father select2

});