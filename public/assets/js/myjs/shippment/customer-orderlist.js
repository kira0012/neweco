// $(window).load(()=>{
//     var pid = $('.my-pterm').val();

//     alert(pid);

// });
function go_back(){

    location.href ='/customer-orders';
}

// const p_term = ()=>{
//     const pid = $('#my-pterm').val();

//     if (pid != 0) {
//         alert('pepe');
//     } else {
        
//     }
// }

const edit_stock_info = (oid) => {

    $.get('/customer/order/item/'+oid ,(record)=>{

        console.log(record);

        var obj = record;

       // edit_stock(obj[0].product_id);
      

        $.each(record, (index, fetchobj) => {
           // console.log(fetchobj.stock_id);
           //edit_stock(fetchobj.product_id);
            $('#order-id').val(fetchobj.id);
            $('#product').val(fetchobj.product_id); 
            console.log(fetchobj.stock_id);
            $('#chker-stock').val(fetchobj.stock_id)
            $('#stock').val('ST-'+padDigits(fetchobj.stock_id, 8));
            $('#wr').val(fetchobj.warehouse_id);
            $('#available').val(fetchobj.available);
            $('#ini-available').val(fetchobj.available);
            $('#stk-price').val(fetchobj.price);
            $('#ord-qty').val(fetchobj.qty);
            $('#ini-qty').val(fetchobj.qty);
            $('#nt-price').val(fetchobj.total)
        });
        
    })

    
}

const remove = (id)=>{

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
            
            Swal.fire(
            'Deleted!',
            'Selected Order has been Removed.',
            'success'
            ).then( ()=>{
                console.log(id);


                $.get('/customer/remove/order/'+id, (data) => {
                    
                        if (data == 1) {
                            location.reload();
                        }else{

                            go_back();
                        }

                   
                })
            })
           
        }
        })
        
}



function edit_order(id){

    const orderid = id.value;
    edit_stock_info(orderid);

    $('#editorder').modal('show');
    
}

function del_to_itemlist(id){

    const orderid = id.value;

    remove(orderid);
   
}





$('#add-order').on('click', ()=> {
    const qty =  $('#order-qty').val();


    if (qty == '' || qty == 0)  {
        
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Please Fill Out All required Information',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })

    }else{

       
        $('#form-add-dr').submit();

    }
})


$('#ord-qty').on('keyup',()=>{

    const ini = Number($('#ini-qty').val());
    const n_qty = Number($('#ord-qty').val());
    const ini_stock = Number($('#ini-available').val());
    const a_stock = Number($('#available').val());
    const price = Number($('#stk-price').val());

    const f_qty = ini - n_qty;
    const f_stock = ini_stock + f_qty;

   const total = price * n_qty;
  

        if (f_stock < 0) {

            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Insuficient Number of Stock',
                animation: false,
                customClass: {
                    popup: 'animated rubberBand'
                },
                })

                $('#ord-qty').val(ini);
                $('#available').val(ini_stock);
                $('#nt-price').val(price * ini);    
        }else{

            $('#ord-qty').val(n_qty);
            $('#available').val(f_stock);  
            $('#nt-price').val(total);
            
        }

})

$('#product').on('change', ()=>{

    const pid = $('#product').val();
    const chk_pid = $('chker-product').val();

    if (pid != chk_pid) {

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'This section cannot be change Please contact your system administrator',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })

            $('#product').val(chk_pid);

    }

});

$('#update-order').on('click', ()=> {

    const qty = $('#ord-qty').val();

    if (qty == 0 || qty == '') {

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Please Insert Valid Quantity This Section Cannot be null',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })
    }else{

            $('#edit-dr-order').submit();
    }


});


$('#create-dr').on('click', ()=>{

    const payment = $('#p-type').val();

    if (payment == ''|| payment == null) {

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Please Select Terms of Payment',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })

            //$('#p-type').click();

    }else{

        $('#c-dr-form').submit();

    }
})