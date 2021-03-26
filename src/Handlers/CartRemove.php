<?php
namespace EasyShoppingCart\Handlers;
use EasyShoppingCart\Handlers\Helper;
class CartRemove extends Helper{
    public function __construct($id){
        $id=$this->chk_found_and_filter_id($id);
        $this->remove_product($id);
        new TotalCart;
        return true;
    }

    private function chk_found_and_filter_id($id){
        // check is number
        if(!is_numeric($id)){
            exit("There was an error adding the product. Often wrong product id Check that the id is entered correctly"); 
        }
        // check is found
        if(!$this->is_found_id_product($id)){
            exit("The ID of the product to be modified does not exist"); 
        }
        return filter_var($id,FILTER_SANITIZE_NUMBER_FLOAT);

    }

    private function remove_product($id){
        $products=$_SESSION['easy_cart_shopping']['products'];
        $keys_products=array_keys($products);
        $i=0;
        foreach($products as $product){
            if($product["id"]==$id){
                $key_product = $keys_products[$i];
                unset($_SESSION['easy_cart_shopping']['products'][$key_product]);
                break;
                
            }
            $i++;
        }
    }
}