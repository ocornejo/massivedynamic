$(document).ready(function() { 
	/*place jQuery actions here*/ 
	var link = "/index.php/";	
	
	$("section.ficha_producto form").submit(function() {
		// Get the product ID and the quantity 
		var id = $(this).find('input[name=product_id]').val();
		var qty = $(this).find('input[name=quantity]').val();
                
		
		$.post(link + "controller_catalogo/addToCart", { product_id: id,quantity: qty, ajax: '1' },
  		function(data){
 		}); 

		return false;
	});



	
	
});