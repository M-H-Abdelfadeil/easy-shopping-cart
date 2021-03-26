<?php
namespace EasyShoppingCart\Handlers;
class TotalCart {
    private $shipping=0;
    private $tax=0;
    private $price=0;
    private $discount=0;
    private $total=0;


    public function __construct($tax_all=0,$shipping_all=0,$discount_all=0)
    {
        if(isset($_SESSION['easy_cart_shopping']['products'])){
            $products=$_SESSION['easy_cart_shopping']['products'];
            foreach($products as $product){
                $this->tax      = $this->tax      + $product['tax'];
                $this->shipping = $this->shipping + $product['shipping'];
                $this->price    = $this->price    + $product['price'];
                $this->discount = $this->discount + $product['discount'];
                $this->total    = $this->total    + $product['total_price_product'];
            }

        }
        
        $this->set_total_cart($tax_all,$shipping_all,$discount_all);
    }

    private function set_total_cart($tax_all,$shipping_all,$discount_all){

        $total_cart=[
            'price_cart'=>$this->price,
            'tax_cart'=>$this->tax+$tax_all,
            'shipping_cart' =>$this->shipping + $shipping_all,
            'discount_cart'=>$this->discount + $discount_all,
            'total_price_cart'=>$this->total +(($tax_all + $shipping_all) - $discount_all)
        ];
        if(isset($_SESSION['easy_cart_shopping']['total'])){
            unset($_SESSION['easy_cart_shopping']['total']);
        }
        $_SESSION['easy_cart_shopping']['total']=$total_cart;
        

    }
}