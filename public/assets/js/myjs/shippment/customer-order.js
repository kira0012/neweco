
            $('.hideto').hide();
function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}

function order_list(id) {
    
    const oid = id.value;
            location.href = '/customer/my-order/'+oid;
}

function send_to_truck(id){


    const drno = id.value;
    $('#dr-trip').val(drno);

    $('#add-to-trip').modal('show');
}

function print_dr(id){

    const drno = id.value;
    
    location.href = '/customer/print/dr-form/'+drno;
    
}

const view_order = (id)=>{

    const drno = id.value;
    location.href = '/customer/order/view/'+drno;
}

const new_product = () => {

    $('chk-wr').val('');
    $('#p-wr').val('0');
    $('#stock-price').val('');
    $('#available-stock').val('');
    $('#order-qty').val('');

}

const all_stock = (pid) => {

    $('#p-stock').empty();
    $('#p-stock').append('<option value="" selected="true" disabled="true"></option>');
    $('#available-stock').val('');


    $.get('/product/available/'+pid , (records) => {
        $.each(records, (index, fetchobj) => {
                    var st_code = fetchobj.id;
                $('#p-stock').append('<option value="'+fetchobj.id+'"> ST-'+padDigits(st_code, 8)+'</option>');
            });

    })

}

const stock_info = (sid) => {

    $.get('/warehouse/mystock/'+sid ,(records)=> {
        console.log(records);
        $('#available-stock').val(records.available);
        $('chk-wr').val(records.warehouse_id);
        $('#p-wr').val(records.warehouse_id);
        $('#stock-price').val(records.price);
    })
}

const price_order = () =>{

    let order_qty = $('#order-qty').val();
    let stock_price = $('#stock-price').val();

    const total = Number(order_qty) * Number(stock_price);
    console.log(total);
    $('#order-price').val(total);
}


$('#p-product').on('change', () =>{

    const pid = $('#p-product').val();
    new_product();
    all_stock(pid);
    
});

$('#p-stock').on('change', ()=> {

        const sid = $('#p-stock').val();

        stock_info(sid);
});

$('#order-qty').on('keyup', () =>{

    price_order ();

    let order = $('#order-qty').val();
    let available = $('#available-stock').val();

    if (Number(order) > Number(available)) {
        

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Insufficent Number of Stock',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })

            $('#order-qty').val('');
            $('#order-price').val('');
    }
});

$('#stock-price').on('keyup', ()=>{

price_order();
});

$('#c-dr').on('click',()=>{

    const customer = $('#bussiness').val();
    const qty =  $('#order-qty').val();


    if (customer == '' || qty == '' || qty == 0)  {
        
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

        $('#dr-form').submit();


    }
})

$('#ship-type').on('change', ()=>{

    const stype = $('#ship-type').val();

        if (stype == '1') {
            
            $('.hideto').show();
        }else{
            $('.hideto').hide();
            $('#trip-sched').val('');
        }
});


$('#intransit').on('click',()=>{

    const trip_ticket = $('#trip-sched').val();
    const stype = $('#ship-type').val();

    if (stype == '' || stype == null) {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Please Select Delivery Type',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })
        
    }
    
    if (stype == '1') {
        if (trip_ticket == '' || trip_ticket == null) {

            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Please Select Trip Schedule',
                animation: false,
                customClass: {
                    popup: 'animated rubberBand'
                },
                })
            
        } else {
    
            $('#form-Ordersend').submit();
            
        }
    } if(stype == '2') {

        $('#form-Ordersend').submit();
    } 

});