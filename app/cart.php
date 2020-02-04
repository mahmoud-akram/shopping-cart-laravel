<?php

namespace App;

//use Illuminate\Database\Eloquent\Model; he need one product not all in table 

class cart 

{
    public $items = []; // num of products in basket
    public $totalQty ; //count
    public $totalPrice;

    public function __Construct($cart = null) { //ini the object 
        if($cart) {
            $this->items = $cart->items;
            $this->totalQty = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
        } else {
            $this->items = [];
            $this->totalQty = 0; //ini values
            $this->totalPrice = 0;
        }
    }

    public function add($product) {
        
        $item = [

            'id' => $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'qty' => 0,
            'image' => $product->image,
        ];

        if( !array_key_exists($product->id, $this->items)) { // if user press on buy is product exist?
            $this->items[$product->id] = $item ;
            $this->totalQty +=1;
            $this->totalPrice += $product->price; 
        } else { // ok add it
            $this->totalQty +=1 ;
            $this->totalPrice += $product->price; 
        }

        $this->items[$product->id]['qty']  += 1 ;
    }



    public function remove($id) {

        if( array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty']; //remove the value
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
            unset($this->items[$id]);

        }

    }


     public function updateQty($id, $qty) {
        
        //reset qty and price in the cart ,
        $this->totalQty -= $this->items[$id]['qty'] ;
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['qty']   ;
        // add the item with new qty
        $this->items[$id]['qty'] = $qty;

        // total price and total qty in cart
        $this->totalQty += $qty ;
        $this->totalPrice += $this->items[$id]['price'] * $qty   ;

    }
    

} 