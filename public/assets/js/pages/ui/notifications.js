"use strict";
$(function() {



  function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
    try {
      decimalCount = Math.abs(decimalCount);
      decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
  
      const negativeSign = amount < 0 ? "-" : "";
  
      let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
      let j = (i.length > 3) ? i.length % 3 : 0;
  
      return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    } catch (e) {
      console.log(e)
    }
  };

  // $( window ).load(function() {
    function padDigits(number, digits) {
      return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
  }
  $('#c-list').empty();

  const display_clist = (chlist)=>{

    $('#c-list').append('<tr class="text-center">'+
    '<td class="text-center"><b>'+chlist.incdate+'</b></td>'+
    '<td class="text-center"><b>'+chlist.amount+'</b></td>'+
    '<td class="text-center"><b>'+chlist.payee+'</b></td>'+
    '<td class="text-center"><b>'+chlist.details+'</b></td>'+
    '</tr>');
  }


  fetch('/notif/order/post-dated')
    .then((res) => res.json())
      .then((data)=>{
        var currentDate = new Date();
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1;
        var year = currentDate.getFullYear();
        var todayis = year+'-'+padDigits(month,2)+'-'+day;



        data.forEach(notif => {
            console.log(notif.payment_date);
            var placementFrom = 'top';
            var placementAlign = 'right';
            var animateEnter = 'animated bounceIn';
            var animateExit = 'animated bounceOut';
            var colorName = 'bg-black';

            var clist = {
              "incdate":notif.payment_date,
              "amount":formatMoney(notif.amount),
              "payee":notif.payee,
              "details":'Customer Payment DR NO:'+padDigits(notif.drno,8)
            }
            
            display_clist(clist);
           
           
            if (todayis == notif.payment_date) {
              var text = 'You have Posted Dated Check For encashment Today with cheque number'+notif.checkno;
            }else{
              var text = 'You have Posted Dated Check For encashment for '+notif.payment_date+' with cheque number '+notif.checkno;
            }
            showNotification(
              colorName,
              text,
              placementFrom,
              placementAlign,
              animateEnter,
              animateExit
            );


        });
      })
  



  fetch('/notif/payment/post-dated')
    .then((res) => res.json())
      .then((data)=>{
	

        var currentDate = new Date();
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1;
        var year = currentDate.getFullYear();
        var todayis = year+'-'+padDigits(month,2)+'-'+day;

        data.forEach(notif => {
            console.log(notif.payment_date);
            var placementFrom = 'top';
            var placementAlign = 'right';
            var animateEnter = 'animated bounceIn';
            var animateExit = 'animated bounceOut';
            var colorName = 'bg-black';

			var clist = {
				"incdate":notif.payment_date,
				"amount":formatMoney(notif.amount),
				"payee":notif.payee,
				"details":'Order Payment DO NO:'+padDigits(notif.po_id,8)
			}
			
			display_clist(clist);
		

           
            if (todayis == notif.payment_date) {
              var text = 'You have a Check for Delivery Order Payment, For InCashment Today with cheque number '+notif.checkno;
            }else{
              var text = 'You have Posted Dated Payment Check For InCashment '+notif.payment_date+' with cheque number '+notif.checkno;
			}
			
            showNotification(
              colorName,
              text,
              placementFrom,
              placementAlign,
              animateEnter,
              animateExit
            );


        })
      })


//job order

fetch('/notif/joborder/post-dated')
    .then((res) => res.json())
      .then((data)=>{

        var currentDate = new Date();
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1;
        var year = currentDate.getFullYear();
        var todayis = year+'-'+padDigits(month,2)+'-'+day;

        data.forEach(notif => {
       
            var placementFrom = 'top';
            var placementAlign = 'right';
            var animateEnter = 'animated bounceIn';
            var animateExit = 'animated bounceOut';
			var colorName = 'bg-black';
			
			var clist = {
				"incdate":notif.payment_date,
				"amount":formatMoney(notif.amount),
				"payee":notif.payee,
				"details":'Job Order Payment JO NO:'+padDigits(notif.jo_id,8)
			}
			
			display_clist(clist);
		
           
            if (todayis == notif.payment_date) {
              var text = 'You have Posted Dated Check For Incashment Today from Job Order with cheque number '+notif.checkno;
            }else{
              var text = 'You have Posted Dated Check For In Cashment from Job Order for '+notif.payment_date+' with cheque number '+notif.checkno;
			}
			
            showNotification(
              colorName,
              text,
              placementFrom,
              placementAlign,
              animateEnter,
              animateExit
            );


        })
      })


      fetch('/notif/cheque-issue/post-dated')
         .then((res) => res.json())
          .then((data) => {

            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            var todayis = year+'-'+padDigits(month,2)+'-'+day;


            data.forEach(notif => {
              
              var placementFrom = 'top';
              var placementAlign = 'right';
              var animateEnter = 'animated bounceIn';
              var animateExit = 'animated bounceOut';
        var colorName = 'bg-black';
        
      
        if (notif.trans_type == '1') {
          var clist = {
            "incdate":notif.transaction_date,
            "amount":formatMoney(notif.amount),
            "payee":notif.payee,
            "details":'Cheque Deposit on '+notif.bank+' w/ acc: '+notif.bank_account+' Remarks:('+notif.remarks+')'
          }
          display_clist(clist);
        
  
        } else {
          var clist = {
            "incdate":notif.transaction_date,
            "amount":formatMoney(notif.amount),
            "payee":notif.payee,
            "details":'Cheque Issued on '+notif.bank+' w/ acc: '+notif.bank_account+' Remarks:('+notif.remarks+')'
          }
          display_clist(clist);
        
  
        }

              if (todayis == notif.transaction_date) {

                  if (notif.trans_type == '1') {
                    var text = 'You have Deposit Posted Dated Check For Incashment Today with cheque number '+notif.cheque_no;
                  } else {
                    var text = 'You have Issued Posted Dated Check For Incashment Today with cheque number '+notif.cheque_no;
                  }
              }else{

                if (notif.trans_type == '1') {
                      var text = 'You have Deposit Posted Dated Check For In Cashment on '+notif.transaction_date+' with cheque number '+notif.cheque_no;
                } else {
                    var text = 'You have Issued Posted Dated Check For In Cashment on '+notif.transaction_date+' with cheque number '+notif.cheque_no;
                }
                
        }
        
              showNotification(
                colorName,
                text,
                placementFrom,
                placementAlign,
                animateEnter,
                animateExit
              );
  
  
          })


    
          })


//end

    })

    function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
      try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
    
        const negativeSign = amount < 0 ? "-" : "";
    
        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;
    
        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
      } catch (e) {
        console.log(e)
      }
    };


function showNotification(
  colorName,
  text,
  placementFrom,
  placementAlign,
  animateEnter,
  animateExit
) {
  if (colorName === null || colorName === "") {
    colorName = "bg-black";
  }
  if (text === null || text === "") {
    text = "Turning standard Bootstrap alerts";
  }
  if (animateEnter === null || animateEnter === "") {
    animateEnter = "animated fadeInDown";
  }
  if (animateExit === null || animateExit === "") {
    animateExit = "animated fadeOutUp";
  }
  var allowDismiss = true;

  $.notify(
    {
      message: text
    },
    {
      type: colorName,
      allow_dismiss: allowDismiss,
      newest_on_top: true,
      timer: 1000,
      placement: {
        from: placementFrom,
        align: placementAlign
      },
      animate: {
        enter: animateEnter,
        exit: animateExit
      },
      template:
        '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
        (allowDismiss ? "p-r-35" : "") +
        '" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        "</div>" +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
        "</div>"
    }
  );
}

