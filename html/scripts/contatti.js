<script type="text/javascript" src="<?php echo BASE_URL ?>/js/jquery.validate.js"></script>

<script type="text/javascript">	
	$(document).ready(function() {	
		$.validator.addMethod("regex", function(value, element, regexpr) {          
		   return regexpr.test(value);
	    }, "Regex"); 

		// validare form campi obbligatori: titolo, luogo, indirizzo, latitudine, longitudine, immagine (?), inizio pubbl, fine pubbl, date events, evento seo url, prezzo
		$("#contatti_form").validate({
			rules: {
				name: { required: true },
				email: { required:true,
					     regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ 
					   },
				message: { required: true }
			},
			messages: {
				name: { required: "Nome obbligatorio" },
				email: { required: "Email obbligatoria",
						 regex: "Per favore inserisci un'email valida" 
					   },
				message: { required: "Messaggio obbligatorio" }
			},
			errorPlacement: function(label, element) {
				label.addClass('text-danger');
				label.insertAfter(element);
			},
			submitHandler: function() {
				var dati=$("#contatti_form").serialize();
				$.post("<?php echo BASE_URL ?>/form/submitcontatti.php",dati,function(resp) {
					var out=jQuery.parseJSON(resp);
					$("#message").removeClass().addClass(out.class).html(out.mess).show();
					$("#contatti_form input,#contatti_form textarea").val("");
				});
			}
		});
	});

</script>
