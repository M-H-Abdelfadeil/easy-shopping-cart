<?php
namespace EasyShoppingCart;
session_start();
use EasyShoppingCart\Handlers\CartAdd;
use EasyShoppingCart\Handlers\CartUpdate;
use EasyShoppingCart\Handlers\CartRemove;
use EasyShoppingCart\Handlers\CartPublic;
class Cart {

    public static function  add($id,$name,$price,$quantity=1,$shipping=0,$tax=0,$discount=0,$options=[]){

        new CartAdd($id,$name,$price,$quantity,$shipping,$tax,$discount,$options);

    }

    public static function update($id,$data=[]){
         new CartUpdate($id,$data);
    }

    public function remove($id){
         new CartRemove($id);
    }

    public static function getAll(){
        return CartPublic::getAll();
    }

    public static function getProducts(){
        return CartPublic::getProducts();
    }

    public static function getTotal(){
        return CartPublic::getTotal();
    }

    public static function AddpublicCart($tax=0,$shipping=0,$discount=0){
        CartPublic::AddpublicCart($tax,$shipping,$discount);
    }

    public static function  unsetCart(){
        CartPublic::unsetCart();
    }

}