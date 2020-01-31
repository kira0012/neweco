$('.cheque-info').hide();

const add_payment = (id)=> {
    
    const po = id.value;
    const payment_term = $('#p-type').val();
    const pad_po = $('#po-'+po).text();
    const total_amount = $('#total-'+po).text();
    const remarks = $('#remarks-'+po).text();
    $('#payment-amount').val(total_amount);
    $('#no-orders').val(remarks);
    // $('#payment').val(total_amount);
    $('#payment-type').val(payment_term);
    $('#payment-po').val(pad_po);
    $('#po').val(po);


    fetch('/payment/do-balance/'+po)
        .then((res) => res.json())
            .then((data) => {
                $('#remaining-balance').val(data);
            });

    $('#new-payment').modal('show');
}

$('#payment-type').on('change', (id)=>{


    const tid = id.target.value;

    if(tid == 2){
        $('.cheque-info').show();
        $('#cheque_no').val('');
        $('#payee_name').val('');

    }else{

        $('.cheque-info').hide();
        $('#cheque_no').val('');
        $('#payee_name').val('');

    }
})

$('#paid-order').on('click', ()=>{

    const total_amount = $('#payment-amount').val();
    const paid = $('#payment').val();
    const cheque_no = $('#cheque_no').val();
    const payee_no = $('#payee_name').val();
    const payment_term =  $('#payment-type').val();


    if (Number(paid) > Number(total_amount)) {
        
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'The Amount of Payment is to large or insuficent',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })

    }else{

        if (payment_term == '1') {
            //submit
            $('#order-payment').submit()
        }else{

            if (cheque_no == '' || payee_no == '') {

                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Cheque or Payee Name Cannot be empty please fill it up',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })
                
            } else {
                //submit
                $('#order-payment').submit()
            }

        }


    }
    
})