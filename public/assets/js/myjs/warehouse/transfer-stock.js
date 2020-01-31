
    const fill_product = (id) => {


        $('#w-products').empty();
        $('#w-products').append('<option value="" selected="true" disabled="true"></option>');

        $('#p-stock').empty();
        $('#p-stock').append('<option value="" selected="true" disabled="true"></option>');
        $('#available-stock').val('');

        $.get('/warehouse/products/'+id,(records) => {
            $.each(records, (index,fetchobj)=>{

                $('#w-products').append('<option value="'+fetchobj.id+'">'+fetchobj.product_name+'</option>');
            });
        });
    }

    function recieve_stock(id){

        const ticket_id = id.value;

        $('#modalrecieve').modal('show');

        $('#ticket-id').val(ticket_id);

        $.get('/transfer/ticket/'+ticket_id, (record)=>{

                $.each(record, (index, fetchobj) => {
                        $('#product-code').val(fetchobj.product_code);
                        $('#pr-description').val(fetchobj.description);
                        $('#pr-qty').val(fetchobj.no_transfer);
                    
                })
        })

    }

    function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}




    const product_stock = (pid,wid) => {

        $('#p-stock').empty();
        $('#p-stock').append('<option value="" selected="true" disabled="true"></option>');
        $('#available-stock').val('');

        $.get('/warehouse/stock/'+pid+'/'+wid , (records) =>{
            $.each(records, (index, fetchobj) => {
                    var st_code = fetchobj.id;
                $('#p-stock').append('<option value="'+fetchobj.id+'"> ST-'+padDigits(st_code, 8)+'</option>');
            });

        });

    }

    const stock_info = (sid) => {

        $.get('/warehouse/mystock/'+sid ,(records)=> {
            
            $('#available-stock').val(records.stock);
        })
    }


    $('#from-warehouse').on('change', function(d){

        const wid = d.target.value;
        
        fill_product(wid)
    });

    $('#w-products').on('change', (d)=>{

        const pid = d.target.value;
        const wid = $('#from-warehouse').val();

        product_stock(pid,wid);
        
    });

    $('#p-stock').on('change',(d) => {

        const pid = d.target.value;

        stock_info(pid);
    });

    $('#stock-transfer').on('keyup', ()=> {

        let n_items = $('#stock-transfer').val();
        let stock = $('#available-stock').val();
        
        if (n_items == 0) {

            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Please Insert valid Quantity!',
                animation: false,
                customClass: {
                    popup: 'animated rubberBand'
                },
                })
            
        }
       // alert(n_items);
        if (n_items > stock) {

            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Your Quantity is to much Quantity must be less than or equal to '+stock,
                animation: false,
                customClass: {
                    popup: 'animated rubberBand'
                },
                })

                $('#stock-transfer').val('');
            
        }
            
    });

    $('#to-send').on('click', ()=> {

            const transfer_to = $('#transfer-to').val();
            const transfer_from = $('#from-warehouse').val();
            const n_items = $('#stock-transfer').val();
            let stock = $('#available-stock').val();

            if(transfer_to == 0 || transfer_to < 0){

                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please Select Warehouse To Transfer The Stock',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })
            }


            if (n_items == 0 || n_items < 0) {

                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please Enter Valid Quantity, it must be less than or equal to '+stock,
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })
    
                
            }

            if (transfer_to == transfer_from) {

                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'You Cannot Transfer Product in the same Warehouse as the product it is',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })
            }else{

                $('#form-transfer').submit();

                
            }
    });

