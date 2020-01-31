

const add_payment = (id)=> {

    const drno = id.value;
    const payment_term = $('#p-type-'+drno).val();
    const pad_drno = $('#dr-'+drno).text();
    //const pad_ticket = $('#t-'+drno).text();
    const total_amount = $('#total-'+drno).text();
    $('#payment-amount').val(total_amount);
    //$('#payment').val(total_amount);
    //$('#payment-ticket').val(pad_ticket);
    //$('#payment-type').val(payment_term);
    $('#payment-drno').val(pad_drno);
    $('#drno').val(drno);

    fetch('/customer/balance/'+drno)
        .then((res) => res.json())
            .then((data) => {
                $('#total-balance').val(data);
            });          


  
    $('.cheque-info').hide();
    $('.direct-deposit').hide();

    $('#payment').val('');
    $('.dem').val('');
    $('#new-payment').modal('show');
}

$('#payment-type').on('change', (id)=>{

    const payment_term = id.target.value;

    if (payment_term == 'Cash') {
        $('.cheque-info').hide();
        $('.direct-deposit').hide();
        $('.dem').removeAttr('disabled');
        $('#payment').attr('Readonly',true);
        $('#payment').addClass('fblack');
    }
    if(payment_term == 'Cheque'){
        $('.cheque-info').show();
        $('.direct-deposit').hide();
        $('.dem').attr('disabled',true);
        $('#payment').removeAttr('readonly');

    }if(payment_term == 'Direct Deposit'){
        $('.cheque-info').hide();
        $('.direct-deposit').show();
        $('.dem').attr('disabled',true);

    }
    if(payment_term == 'Cash Advance'){
        $('.cheque-info').hide();
        $('.direct-deposit').hide();
        $('.dem').attr('disabled',true);
        var amount = $('#total-balance').val();
        $('#payment').val(amount);

    }

    if(payment_term == 'Withholding Tax'){
        $('.cheque-info').hide();
        $('.direct-deposit').hide();
        $('.dem').attr('disabled',true);
        var amount = $('#total-balance').val();
        $('#payment').val(amount);
    }



})



$('.dem').on('keyup',()=>{

    get_total();
})

const get_total = () =>{

    var sum = 0;

    $(".dem").each(function(){
        // sum += +(Number($(this).val()) * Number( $(this).data("amount")));
        if($(this).val() != "")
        sum += (parseFloat($(this).val()) * parseFloat($(this).data("amount")));  
    });

    // console.log(sum.toFixed(4));

    $('#payment').val(sum.toFixed(2));
}

$('#paid-order').on('click', ()=>{

    const total_amount = $('#payment-amount').val();
    const paid = $('#payment').val();
    const cheque_no = $('#cheque_no').val();
    const payee_no = $('#payee_name').val();
    const payment_term =  $('#payment-type').val();
    const bank = $('#bankname').val();
    const trans = $('#Transaction-no').val();
    const p_date = $('#p-date').val();

    if(p_date == '' || p_date == null){
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Please Select Payment Date',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })
            return;
    }

    if (Number(paid) == null || Number(paid) == NaN || Number(paid) == 0) {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'The Amount of Payment is Required ',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })
            return;
    }

    if (Number(paid) > Number(total_amount)) {
        
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'The Amount of Payment is to large ',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })
            return;
    }else{

        if (payment_term == 'Cash') {
            //submit
            $('#order-payment').submit()
        }
        if(payment_term == 'Cheque'){

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
                    return;
                
            } else {
                //submit
                $('#order-payment').submit()
            }

        }

        if(payment_term == 'Direct Deposit'){

            
            if (bank != '' && trans != '') {
                $('#order-payment').submit()
            }else{
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Select Bank and Transaction Number Cannot be empty please fill it up',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })
                    return;
            }

        }

        if (payment_term == 'Cash Advance') {
            $('#order-payment').submit();
        }

        if (payment_term == 'Withholding Tax') {
            $('#order-payment').submit();
        }

        if (payment_term == 'Commission') {
            $('#order-payment').submit();
        }



    }
    
})