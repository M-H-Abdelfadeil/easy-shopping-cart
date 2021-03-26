<?php
namespace EasyShoppingCart\Handlers;
use EasyShoppingCart\Handlers\Helper;
class CartUpdate extends Helper{

   

    public function __construct($id,$new_product_update=[])
    {

       $old_product_update=$this->old_product_update($id);
       $data_updated=$this->data_update($old_product_update,$new_product_update) ;
       $id          =$data_updated["id"];
       $name        =$data_updated["name"];
       $price       =$data_updated["price"];
       $quantity    =$data_updated["quantity"];
       $shipping    =$data_updated["shipping"];
       $tax         =$data_updated["tax"];
       $discount    =$data_updated["discount"];
       $options     =$data_updated["options"];

       new CartAdd($id,$name,$price,$quantity,$shipping,$tax,$discount,$options);
    }

    private function chk_and_filter_id($id){
        // check is number
        if(!is_numeric($id)){
            exit("There was an error adding the product. Often wrong product id Check that the id is entered correctly"); 
        }
        // check is notfound
        if(!$this->is_found_id_product($id)){
            exit("The ID of the product to be modified does not exist"); 
        }
        return filter_var($id,FILTER_SANITIZE_NUMBER_FLOAT);


    }

    private function old_product_update($id){
        $products=$_SESSION['easy_cart_shopping']['products'];
        $keys_products=array_keys($products);
        
        $old_product_update;
        $i=0;
        foreach($products as $product){
            if($product["id"]==$id){
                $key_product = $keys_products[$i];
                $old_product_update=$products[$key_product];
                unset($_SESSION['easy_cart_shopping']['products'][$key_product]);
                break;
                
            }
            $i++;
        }
        return  $old_product_update;
    }

    public function data_update($old_product_update,$new_product_update){
        $data_updated=[];
        foreach($old_product_update as $key =>$val){
            if(array_key_exists($key,$new_product_update)){
             $val= $new_product_update[$key];
            }
            $data_updated[$key]=$val;
            
        }
        return $data_updated;
    }




}