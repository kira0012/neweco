
    function go_back(id){

        const pid = id.value;

        window.location.href='/delivery-order-details/'+pid;
    }

    function edit_order(id){

        var pid = id.value;
        $('#modal-edit').modal('show');
        get_poitem(pid);

        //product_details(pid)
    }

    function del_order(id){

        const item_id = id.value;

                del_item(item_id);

    }






    const edit_product = () => {

        const id = $('#s-id').val();

            $.get('/my-product/'+id, (products)=>{
                
                $.each(products, (index,objproduct)=>{
                    $('#pr-id').append('<option value="'+objproduct.id+'">'+objproduct.product_name+'</option>');
                
                })
            })
        }

    const get_poitem = (id) => {
        edit_product();

        $.get('/getpo/product/'+id, (data) => {
            console.log(data);
            $.each(data , (index,objproduct) => {
                    $('#id-edit-item').val(objproduct.id);
                    $('#pr-id').val(objproduct.products_id);
                    $('#qty').val(objproduct.product_qty);
                    $('#p-desc').val(objproduct.description);
                    $('#unit').val(objproduct.unit);
                    $('#price-unit').val(objproduct.unit_price);
                console.log(objproduct.po_number);
            })

        })
    }

   

    const get_product = () => {

        const id = $('#s-id').val();

        $.get('/my-product/'+id, (products)=>{
            
            $.each(products, (index,objproduct)=>{
                $('#product-id').append('<option value="'+objproduct.id+'">'+objproduct.product_name+'</option>');
            
            })
        })
    }


    const product_details = (id) =>{

        $.get('/get-product/'+id, (product) => {
            $('#p-description').val(product.description);
            $('#p-price').val(product.supplier_price);
            $('#unit-id').val(product.unit);
            $('#p-productcode').val(product.product_code);
         });

    }


    const del_item = (id) => {

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

                    $.get('/delete/po-item/'+id, (data) => {
                        
                        console.log(data);
                        location.reload();
                    })
                })
               
            }
            })

   
    }


    get_product();

    $('#product-id').on('change', function(){

        id = this.value;

        product_details(id)
    });
