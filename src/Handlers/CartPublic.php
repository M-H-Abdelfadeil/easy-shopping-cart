<?php
namespace EasyShoppingCart\Handlers;

use EasyShoppingCart\Handlers\Helper;


class CartPublic extends Helper{

    
    public static function getAll(){
        if(!isset( $_SESSION['easy_cart_shopping'])){
            return false;
        }else{
            if(isset($_SESSION['easy_cart_shopping']['products'])){
                if(empty($_SESSION['easy_cart_shopping']['products'])){
                    return false;
                }
            }
            return $_SESSION['easy_cart_shopping'];
        }
    }

    public static function getProducts(){
        if(!isset( $_SESSION['easy_cart_shopping'])){
            return false;
        }else{
            if(isset($_SESSION['easy_cart_shopping']['products'])){
                if(empty($_SESSION['easy_cart_shopping']['products'])){
                    return false;
                }
            }
            return $_SESSION['easy_cart_shopping']['products'];
        }
    }

    public static function getTotal(){
        if(!isset( $_SESSION['easy_cart_shopping'])){
            return false;
        }else{
            if(isset($_SESSION['easy_cart_shopping']['products'])){
                if(empty($_SESSION['easy_cart_shopping']['products'])){
                    return false;
                }
            }
            return $_SESSION['easy_cart_shopping']['total'];
        }
    }

    public static function AddpublicCart($tax,$shipping,$discount){
        new TotalCart($tax,$shipping,$discount);
    }

    public static function unsetCart(){
        unset($_SESSION['easy_cart_shopping']);
    }
    


    





    
}