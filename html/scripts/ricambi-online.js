<script type="text/javascript" src="<?php echo BASE_URL ?>/js/jquery.validate.js"></script>

<script type="text/javascript">
	var ajx="<?php echo BASE_URL ?>/form/form.php?s=maker";
	$.getJSON(ajx,function(data){
		$.each(data.risultato, function(key,value) {
			$("#maker").append('<option value="'+value.maker+'">'+value.maker+'</option>');
		});
	});
	
	$("#maker").on("change",function(){
		var maker=$(this).val();
		var ajx="<?php echo BASE_URL ?>/form/form.php?s=model&maker="+maker;
		$("#model").html('<option value="">--- Seleziona un modello ---</option>');
		$("#anno").html('<option value="">--- Anno di costruzione ---</option>');
		if (maker!=""){				
			$.getJSON(ajx,function(data){
				console.log(data);
				$.each(data.risultato, function(key,value) {
					$("#model").append('<option value="'+value.model+'">'+value.model+'</option>');
				});
				$("#model").attr("disabled",false);
			});
		}else{
			$("#model").attr("disabled",true);
			$("#anno").attr("disabled",true);
		}
	});
	
	$("#model").on("change",function(){
		var model=$(this).val();
		var maker=$("#maker").val();
		var ajx="<?php echo BASE_URL ?>/form/form.php?s=anno&model="+model+"&maker="+maker;
		$("#anno").html('<option value="">--- Anno di costruzione ---</option>');
		if (model!=""){				
			$.getJSON(ajx,function(data){
				var anni=[];
				$.each(data.risultato, function(key,value) {		
					var start=value.prod_years_start;
					var end=value.prod_years_end;

					var questo=new Date().getFullYear();
					if (end=="") end=questo;
					for (n=start;n<=end;n++){
						var a=anni.indexOf(parseInt(n,10));
						if (a==-1) anni.push(n);
					}
				});
				$.each(anni, function(key,value) {
					$("#anno").append('<option value="'+value+'">'+value+'</option>');
				});
				$("#anno").attr("disabled",false);
			});
		}else{
			$("#anno").attr("disabled",true);
		}
	});

	$(document).ready(function() {	
		$.validator.addMethod("regex", function(value, element, regexpr) {          
		   return regexpr.test(value);
	    }, "Regex"); 

		// validare form campi obbligatori: titolo, luogo, indirizzo, latitudine, longitudine, immagine (?), inizio pubbl, fine pubbl, date events, evento seo url, prezzo
		$("#ricambi_form").validate({
			rules: {
				name: { required: true },
				email: { required:true,
					     regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ 
					   },
				maker: { required: true },
				model: { required: true }
			},
			messages: {
				name: { required: "Nome obbligatorio" },
				email: { required: "Email obbligatoria",
						 regex: "Per favore inserisci un'email valida" 
					   },
				maker: { required: "Costruttore obbligatorio" },
				model: { required: "Modello obbligatorio" }
			},
			errorPlacement: function(label, element) {
				label.addClass('text-danger');
				label.insertAfter(element);
			},
			submitHandler: function() {
				var dati=$("#ricambi_form").serialize();
				$.post("<?php echo BASE_URL ?>/form/submitauto.php",dati,function(resp) {
					var out=jQuery.parseJSON(resp);
					alert(out.mess);
				});
			}
		});
	});

</script>
