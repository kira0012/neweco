
const cancel_order = (id)=>{

    const oid = id.value;
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
        confirmButtonText: 'Yes, Cancel Order!'
        }).then((result) => {
        if (result.value) {
            Swal.fire(
            'Confirm! Half Way There!',
            'Click OK to Procced!',
            'success'
            ).then((result) =>{
                if(result.value){
    
    const order = {"orderid":oid};
    CancelmyOrder(order);  
    setTimeout(function(){ location.href = '/customer-order/cancel-order'; }, 1500);
                }
            })
        }
    })
}



const CancelmyOrder = async (oid) => {
  
    const settings = {
      method: 'POST',
      body: JSON.stringify(oid),
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        
      }
    }
  
    const response = await fetch('/cancel/customer-order', settings);
  
    try {
      const data = await response.json();
      console.log(data);
      //location.reload();
    } catch (err) {
      throw err;
    }
  };