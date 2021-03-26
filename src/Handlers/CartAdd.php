<?php
namespace EasyShoppingCart\Handlers;
use EasyShoppingCart\Handlers\Helper;
class CartAdd extends Helper{
    private $id;
    private $name;
    private $price;
    private $shipping;
    private $tax;
    private $discount;
    private $options;
    private $quantity;
    public function __construct($id,$name,$price,$quantity,$shipping,$tax,$discount,$options)
    {
        $this->id       =$this->chk_and_filter_id($id);
        
        $this->name     =$this->chk_and_filter_name($name);
        $this->price    =$this->chk_and_filter_number($price);
        $this->quantity =$this->chk_and_filter_number($quantity);
        $this->shipping =$this->chk_and_filter_number($shipping);
        $this->tax      =$this->chk_and_filter_number($tax);
        $this->discount =$this->chk_and_filter_number($discount);
        $this->options  =$this->chk_and_filter_options($options);
        
        $this->add_to_session();

        
        
    }


    private function chk_and_filter_id($id){
        // check is number
        if(!is_numeric($id)){
            exit("There was an error adding the product. Often wrong product id Check that the id is entered correctly"); 
        }
        // check is found
        if($this->is_found_id_product($id)){
            exit("This product has already been added"); 
        }
        return filter_var($id,FILTER_SANITIZE_NUMBER_FLOAT);


    }

    private function add_to_session(){
    
        $product=[

            "id"=>(int)$this->id,
            "name"      =>$this->name,  
            "price"     =>(float)$this->price,
            "quantity"  =>(float)$this->quantity,
            "shipping"  =>(float)$this->shipping,
            "tax"       =>(float)$this->tax,
            "discount"  =>(float)$this->discount,
            "options"   =>$this->options,
            "total_price_product" => $this->total_price_product()
        ];
        $_SESSION['easy_cart_shopping']['products'][]=$product;
        new TotalCart;

        return true;
        
        
    }
    private function chk_and_filter_name($name){
        if(!is_string($name)){
            exit("There was an error adding the product. Often wrong product name Make sure the name is entered correctly");
        }
        return filter_var($name,FILTER_SANITIZE_STRING);
    }

    private function chk_and_filter_number($val){
        if(!is_numeric($val)){
            exit("There was an error adding the product. Often wrong product ".$val." Check that the ".$val." is entered correctly"); 
        }
        return filter_var($val,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION );
    }

    private function chk_and_filter_options($options){

        if(!is_array($options)){
            exit("There was an error adding the product. Often wrong options product make sure options are entered correctly");
        }else{
            $keys=array_keys($options);
            $values=array_values($options);
            $options=[];
            $i=0;
            foreach($values as $value){
                $value_filter=filter_var($value,FILTER_SANITIZE_STRING);
                $key_filter=filter_var($keys[$i],FILTER_SANITIZE_STRING);
                $options[$key_filter]=$value_filter;
                $i++;
            }
            return $options;
        }

    }


    private function total_price_product(){
        // quantity and price
        $total=$this->price * $this->quantity;

        // add shipping and tax
        $total = $total + $this->shipping + $this->tax;
        
        // munise discount 
        $total = $total - $this->discount;
        
        return    $total;
         
    }


    




    






    
}
