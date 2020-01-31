	let defaultMap = "https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d18358.998038663947!2d121.03231683731941!3d14.68407191779982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x3397b644af22fd13%3A0x21810b16fa5226c7!2sCipher%20Fusion%20Philippines%2C%202nd%20Floor%2C%20Unit%20E%2C%20Citiplaza%202%2C%20Tandang%20Sora%20Ave%2C%20Quezon%20City%2C%201107%20Metro%20Manila!3m2!1d14.6760708!2d121.0449331!4m5!1s0x3397b6d6227c5aa3%3A0x88e67ea174c8f48b!2sTandang%20Sora%2C%20Quezon%20City%2C%20Metro%20Manila!3m2!1d14.6819218!2d121.0421102!5e0!3m2!1sen!2sph!4v1568147756830!5m2!1sen!2sph"; 
	let quirino = "https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d30877.86477736079!2d121.02208813949166!3d14.671082511068581!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3397b70e3e03cbe9%3A0x56a5e07b59ea8de8!2sQuezon%20Memorial%20Circle%2C%20Elliptical%20Road%2C%20Diliman%2C%20Quezon%20City%2C%20Metro%20Manila!3m2!1d14.651561899999999!2d121.0494018!4m5!1s0x3397b12bf0ff4393%3A0x14c98a45414b010d!2s558%20Quirino%20Hwy%2C%20Novaliches%2C%20Quezon%20City%2C%201116%20Metro%20Manila!3m2!1d14.6909336!2d121.0283645!5e0!3m2!1sen!2sph!4v1568658730456!5m2!1sen!2sph";
	$(window).on('load', () => {
		$('#mapLocation').attr('src', defaultMap);
	});	
	$(document).ready(() => {		
		new WOW().init();
	$('#quirino').on('click', () => {
			$('#mapLocation').attr('src', quirino);
		});

	$('#tandangsora').on('click', () => {
		$('#mapLocation').attr('src', defaultMap);
	});

		$('.submitMsg').on('click',()=>{

		   let formData = {
              "name":$('input[name=name]').val(),      
              "message": $('#message').val(),        
              "email": $('input[name=email]').val(),      
              };
				$.ajax({
					 method:'POST',
		        url:"https://script.google.com/macros/s/AKfycbyhDBEoUGaJka28DguZ6nrD5riHVdtwHqU8kuHomjKGonRcTjZv/exec",
		        data: formData,
	           success:function(){      
	                location.reload();
	            }, error: function(msg) {
              console.log(msg);
              swal("Error!", "Something went wrong.", "error");
              alert(msg.status);
          }
			});
	});

	// $('.contacts').keypress((evt) => {
	// 	return(/^[0-9]*\~?[0-9]*$/).test($(this).val()+evt.key);	
	// });

	$('.decimal').keypress(function(evt){
                        return (/^[0-9]*\~?[0-9]*$/).test($(this).val()+evt.key);
                    });


});

