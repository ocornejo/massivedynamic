$(document).ready(function() { 
	/*place jQuery actions here*/ 
	var link = "/index.php/";
	
	
	$("section.products form").submit(function() {
		// Get the product ID and the quantity 
		var id = $(this).find('input[name=idProductos]').val();
		//var qty = $(this).find('input[name=quantity]').val();
		
		 $.post(link + "controller_catalago/addToCart", { product_id: id, ajax: '1' },
  			function(data){
  			
  			if(data == 'true'){
    			
    			$.get(link + "controller_catalago/showCart", function(cart){
  					$("#cart_content").html(cart);
				});

    		}else{
    			alert("Product does not exist");
    		}	
    		
 		 }); 

		return false;
	});
	
	$(".empty").live("click", function(){
    	$.get(link + "controller_catalago/emptyCart", function(){
    		$.get(link + "controller_catalago/showCart", function(cart){
  				$("#cart_content").html(cart);
			});
		});
		
		return false;
    });


	
	
});