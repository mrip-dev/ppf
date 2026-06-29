function newHead(id,head=null,amount=null){
    var total=$("#total_price").html();
       
     
    var newrow=`<tr id="item_${id}">
                                <td>${head}</td>
                                <td>${amount}</td>
                                <td>
                                <input onkeyup="getDiscount(${amount},${id})"  value="${amount}" id="fee_amount_${id}" type="text" name="fee_amount[]" class="form-control" placeholder="${head}">
                                <input value="0" data-id="0" type="hidden" id="discount_amount_${id}" name="discount_amount[]">
                                <input value="${amount}" type="hidden" name="actual_amount[]">
                                <input value="${head}" type="hidden" name="fee_head[]">
                                <input value="${id}" type="hidden" name="head_id[]" >
                                </td>
                            </tr>`;
       
    if($('#fee_'+id).prop('checked')){
           $("#fee_heads_table tbody").append(newrow);
           var final=parseFloat(total)+parseFloat(amount);
          $("#total_price").html(parseFloat(final).toFixed(2));
    }else{


            var old_discount=$("#total_discount").html();
            var discount_amount=$("#discount_amount_"+id).val();
            var final_discount=parseFloat(old_discount)-parseFloat(discount_amount);
            $("#total_discount").html(parseFloat(final_discount).toFixed(2));
            $("#item_"+id).remove();
            var final=parseFloat(total)-parseFloat(amount);
            $("#total_price").html(parseFloat(final).toFixed(2));
           
   
    
    
   
              
    }                     

}
function getDiscount(amount=0,id){

    var old_discount=$("#total_discount").html();
    var oldValue = $("#discount_amount_"+id).data("id");
    
    var new_amount=$("#fee_amount_"+id).val();
    if(isNaN(new_amount) || new_amount=='' || new_amount==null){
        new_amount=0;
    }
   
       
     
    
    
    var odiscount=parseFloat(old_discount)-parseFloat(oldValue);
    var new_discount=parseFloat(amount)-parseFloat(new_amount);
    
    $("#discount_amount_"+id).val(new_discount);
    $("#discount_amount_"+id).data("id",new_discount);
    var final=parseFloat(new_discount)+parseFloat(odiscount);
   
    $("#total_discount").html(parseFloat(final).toFixed(2));

    

}
function newHead(id,head=null,amount=null){
    var total=$("#total_price").html();
       
     
    var newrow=`<tr id="item_${id}">
                                <td>${head}</td>
                                <td>${amount}</td>
                                <td>
                                <input onchange="getDiscount(${amount},${id})"  value="${amount}" id="fee_amount_${id}" type="text" name="fee_amount[]" class="form-control" placeholder="Registration Fee">
                                <input value="0" data-id="0" type="hidden" id="discount_amount_${id}" name="discount_amount[]">
                                <input value="${amount}" type="hidden" name="actual_amount[]">
                                <input value="${head}" type="hidden" name="fee_head[]">
                                <input value="${id}" type="hidden" name="head_id[]" >
                                </td>
                            </tr>`;
       
    if($('#fee_'+id).prop('checked')){
           $("#fee_heads_table tbody").append(newrow);
           var final=parseFloat(total)+parseFloat(amount);
          $("#total_price").html(parseFloat(final).toFixed(2));
    }else{


            var old_discount=$("#total_discount").html();
            var discount_amount=$("#discount_amount_"+id).val();
            var final_discount=parseFloat(old_discount)-parseFloat(discount_amount);
            $("#total_discount").html(parseFloat(final_discount).toFixed(2));
            $("#item_"+id).remove();
            var final=parseFloat(total)-parseFloat(amount);
            $("#total_price").html(parseFloat(final).toFixed(2));
           
   
    
    
   
              
    }                     

}
function getDiscount(amount,id){

    var old_discount=$("#total_discount").html();
    var oldValue = $("#discount_amount_"+id).data("id");
    
    var new_amount=$("#fee_amount_"+id).val();
    var odiscount=parseFloat(old_discount)-parseFloat(oldValue);
    var new_discount=parseFloat(amount)-parseFloat(new_amount);
    
    $("#discount_amount_"+id).val(new_discount);
    $("#discount_amount_"+id).data("id",new_discount);
    var final=parseFloat(new_discount)+parseFloat(odiscount);
    $("#total_discount").html(parseFloat(final).toFixed(2));

    

}
