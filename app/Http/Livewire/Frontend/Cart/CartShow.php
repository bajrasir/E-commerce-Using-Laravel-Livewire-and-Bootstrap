<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;

public function incrementQuantity(int $cart_id)
{
    $cartData = Cart::where('id', $cart_id)->where('user_id', auth()->user()->id)->first();
    if($cartData)
    {
        if($cartData->productColor()->where('id',$cartData->product_color_id)->exists())
        {
            $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first();
            if($productColor->quantity > $cartData->quantity)
            {
                $cartData->increment('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
            else
            {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Only' .$productColor->quantity . 'Quantity Available',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        }
        else
        {
            if($cartData->product->quantity > $cartData->quantity)
            {

                $cartData->increment('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
            else
            {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Only' .$cartData->product->quantity . 'Quantity Available',
                    'type' => 'success',
                    'status' => 200
                ]);
            }

        }
    }
    else
    {
        $this->dispatchBrowserEvent('message', [
            'text' => 'Something Went Wrong',
            'type' => 'error',
            'status' => 404
        ]);
    }
}

public function decrementQuantity(int $cart_id)
{
    $cartData = Cart::where('id',$cart_id)->where('user_id', auth()->user()->id)->first();
        if($cartData)
        {
            if($cartData->quantity > 1){

                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                ]);
            }else{
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity cannot be less than 1',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        }else{

            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong!',
                'type' => 'error',
                'status' => 404
            ]);
        }
}

public function removeCartItem(int $cart_id)
{
   $cartRemoveData = Cart::where('user_id', auth()->user()->id)->where('id', $cart_id)->first();
   if($cartRemoveData)
   {
    $cartRemoveData->delete();
    $this->emit('CartAddedUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Cart Item Removed Successfully',
            'type' => 'success',
            'status' => 200
        ]);
   }
   else
   {
    $this->dispatchBrowserEvent('message', [
        'text' => 'Something Went Wrong',
        'type' => 'error',
        'status' => 500
    ]);
   }
}

    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
