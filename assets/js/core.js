$(document).ready(function() { 
    /*place jQuery actions here*/ 
    var link = "/index.php/";	
	
    $("section.ficha_producto form").submit(function() {
        // Get the product ID and the quantity 
        var id = $(this).find('input[name=product_id]').val();
        var qty = $(this).find('input[name=quantity]').val();
             
		
        $.post(link + "controller_catalogo/addToCart", {
            product_id: id,
            quantity: qty, 
            ajax: '1'
        },
        function(data){
            var json = $.parseJSON(data);
            
            if(json.retorno==1){
               
                location.reload(true);
                //$.get(link + "controller_catalogo/showCart", function(cart){ // Get the contents of the url cart/show_cart  
                //    $("#cart_content").html(cart); // Replace the information in the div #cart_content with the retrieved data  
                //});            
  
            }else{  
                alert("El producto no existe");  
            }  
        }); 
                
        return false;
    });
        
    $(".empty").live("click", function(){
            
          
        $.get(link + "controller_catalogo/emptyCart", function(){
            
            $.get(link + "controller_catalogo/showCart", function(cart){
                
                $("#cart_content").html(cart);  
            });  
        });  
        
        return false;  
    });  



	
	
});