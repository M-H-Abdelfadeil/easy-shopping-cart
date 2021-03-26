<?php
namespace EasyShoppingCart\Handlers;

class Helper {
    protected function is_found_id_product($id){
        $found=false;
        if(isset($_SESSION['easy_cart_shopping']['products'])){
            $products=$_SESSION['easy_cart_shopping']['products'];
            foreach($products as $product){

                if($product["id"]==$id){
                  
                    $found=true;
                }
            }
        }
        return $found;
    }

    


    
    
    

    
}