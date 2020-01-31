

const return_item = (id)=>{

    const drno = id.value;

    const name = $('#cname-'+drno).text();
    $('#drno').val(drno);
    $('#cs_name').val(name);
    $('#customer_return').modal('show');
    $('#prod').empty();
    $('#Qty').empty();
    $('#action').empty();

    fetch('/customer/orderlist/'+drno)
        .then((res) => res.json())
            .then((orders) => {
                $('#cs_product').empty();
                $('#cs_product').append('<option value="0" selected disabled="true">Select Product</option>');
                orders.forEach(order => {
                    $('#cs_product').append(' <option value="'+order.id+'">'+order.product_name+' | '+order.description+'</option> ');
                    
                });
                
            })
}

$('#cs_product').on('change',(id)=>{

    const oid = id.target.value;
    
    fetch('/customer/order/item/'+oid)
        .then((res) => res.json())
            .then((item) => {
                console.log(item);
               item.forEach(citem => {

                   $('#prod').append('<input type="hidden" value="'+citem.stock_id+'" name="stock_id[]" />'+
                   '<input class ="form-control text-center max" type="text" name="pad_stock[]" value="ST-'+padDigits(citem.stock_id,8)+'" required/>');
                   $('#Qty').append('<input class = "form-control text-center max" type="number" name="cs_qty[]" max="'+citem.qty+'" value="'+citem.qty+'" required/>');
                    $('#action').append('<select class="form-control cs-top" data-placeholder="Select" name="cs_action[]" required>'+
                    '<option value="Return">Return</option>' +
                    '<option value="Replace">Return/Replace</option>' +
                    '<option value="Disposed">Disposed/Replace</option></select>');
                });
                
            })

});

$('#rtn-clear').on('click',()=>{
   
    $('#prod').empty();
    $('#Qty').empty();
    $('#action').empty();
    $('#cs_product').val('0');

});



