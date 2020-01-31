
var items = 0;
let total_order = 0;

//fetch note...
// const getrequest = (url) =>{
// fetch(url)
//   .then(function(response) {
//     return response.json();
//   })
//   .then(function(myJson) {
//     // console.log(JSON.stringify(myJson));
//     return myJson;
//   });
// }
const gettotal = () => {

    var sum = 0;
    $(".sub-total").each(function() {
    sum += parseFloat(this.value);
        });

        var total = sum.toFixed(4);
$('#total-cost').val(total);
}

const remove_order = (order) => {

    const id = order.value;

                Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            animation: false,
            customClass: {
                popup: 'animated tada'
            },
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Remove it!'
            }).then((result) => {
            if (result.value) {
                $('#order-'+id).remove();
                Swal.fire(
                'Deleted!',
                'Selected Order has been Removed.',
                'success'
                )
                gettotal();
            }
            })

   
}

const add_to_po_list = (order_details) =>{

       $('#po-list').append('<tr id="order-'+order_details.counter+'">'+
       '<td class="text-center">'+order_details.product_code+'<input type="hidden" value="'+order_details.product_id+'" name="products[]" /></td>'+
       '<td class="text-center">'+order_details.product_qty+'<input type="hidden" value="'+order_details.product_qty+'" name="p_quantities[]" /></td>'+
       '<td class="text-center">'+order_details.product_total+'<input type="hidden" class="sub-total" value="'+order_details.product_total+'" name="sub_totals[]" /></td>'+
       '<input type="hidden" value="'+order_details.unit_price+'" name="unit_price[]" />'+
       '<td class="text-center"><button type="button" onclick=remove_order(this) value="'+order_details.counter+'" class="btn btn-circle waves-effect waves-circle waves-float del">'+
       '<i class="material-icons i-del">delete</i>'+
       '</button></td></tr>');
}

const clear_product = () =>{

    $('#p-description').val('');
    $('#p-qty').val('');
    $('#p-price').val(0);
    $('#unit-id').val(0);
    $('#product-id').val(0);

}


//pages event

$('#unit-id').prop('disabled', 'disabled');
$('#unit-id').css('color','black');
$('#place-order').on('click', ()=> {

    var chk = $('#total-cost').val();

    if (chk == '' || chk== 0) {

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Please Select Product First!'
            })
    }else{

        $('#form-order').submit();
    }
})

$('#supplier-id').on('change', function(){
    

    const id = this.value;

    const orderdate = $('#orderdate').val();
    const total_cost = $('#total-cost').val();
    if (total_cost > 0) {
        
        Swal.fire({
            title: 'Are you sure?',
            text: "If You Change the Supplier The Order you made a while ago will be deleted!",
            type: 'warning',
            showCancelButton: true,
            animation: false,
            customClass: {
                popup: 'animated tada'
            },
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Remove it!'
            }).then((result) => {
            if (result.value) {

                $('#po-list').empty();
                $('#product-id').empty();
                $('#product-id').append('<option value="0" selected="true" disabled="true">Select Product</option>');
                $('#total-cost').val(0);
                clear_product();
                
                Swal.fire(
                'Deleted!',
                'Selected Order has been Removed.',
                'success'
                )
              
            }else{
                const chk = $('#s-check').val();
                $('#supplier-id').val(chk);
            }
            })


    }else{


    if (orderdate == '') {

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Please Select Order Date First!',
            customClass: {
                popup: 'animated tada'
            }
            })

            $('#supplier-id').val(0);
    }else{
    
        $('#product-id').empty();
        $('#product-id').append('<option value="0" selected="true" disabled="true">Select Product</option>');
        $('#s-check').val(id);
        clear_product();
            $.get('/my-product/'+id, (products)=>{
            
                $.each(products, (index,objproduct)=>{
                    $('#product-id').append('<option value="'+objproduct.id+'">'+objproduct.product_name+'</option>');
                
                })
            })

    }

    }
});



$('#product-id').on('change', function(){

    var id = this.value;
    $('#p-qty').val();
        $.get('/get-product/'+id, (product) => {
       $('#p-description').val(product.description);
       $('#p-price').val(product.supplier_price);
       $('#unit-id').val(product.unit);
       $('#p-productcode').val(product.product_code);
   });

    
});

$('#to-orderlist').on('click', function(){

    const product_id = $('#product-id').val();
    const product = $('#p-productcode').val();
    const product_price = $('#p-price').val();
    const product_qty = $('#p-qty').val();

    if (product_qty == '' || product_qty == '0' || product_price == '' || product_price == '0') {
        
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Please Enter Quantity and Price',
            customClass: {
                popup: 'animated tada'
            }
            })
        
    }else{
        

    const sub_total = (Number(product_price) * Number(product_qty)).toFixed(4);

    items += 1;

    var order_details = {
        "counter":items,
        "product_id":product_id,
        "product_code":product,
        "product_total":sub_total,
        "product_qty":product_qty,
        "unit_price":product_price,
        };
            add_to_po_list(order_details);
            gettotal();
            clear_product();
    }
            
});

