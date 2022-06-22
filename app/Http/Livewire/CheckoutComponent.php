<?php

namespace App\Http\Livewire;

use App\Mail\OrderMail;
use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Shipping;
use Cart;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Stripe;

class CheckoutComponent extends Component
{

    public $ship_to_different;

    public $firstname;
    public $lastname;
    public $email;
    public $mobile;
    public $line1;
    public $line2;
    public $zipcode;
    public $city;
    public $province;
    public $country;
    public $order_id;

    public $shipping_firstname;
    public $shipping_lastname;
    public $shipping_email;
    public $shipping_mobile;
    public $shipping_line1;
    public $shipping_line2;
    public $shipping_zipcode;
    public $shipping_city;
    public $shipping_province;
    public $shipping_country;

    public $paymentmode;
    public $thankyou;

    public $card_number;
    public $exp_month;
    public $exp_year;
    public $cvc;

    public function updated($fields)
    {
        //Billing address form
        $this->validateOnly($fields, [
            'firstname' => 'required',
             'lastname' => 'required',
             'email' => 'required | email',
             'mobile' => 'required | numeric',
             'line1' => 'required',
             'zipcode' => 'required',
             'city' => 'required',
             'province' => 'required',
             'country' => 'required',
             'paymentmode' => 'required'
        ]);

        //Shipping address form
        if($this->ship_to_different)
        {   

            $this->validateOnly($fields, [
                'shipping_firstname' => 'required',
                'shipping_lastname' => 'required',
                'shipping_email' => 'required | email',
                'shipping_mobile' => 'required | numeric',
                'shipping_line1' => 'required',
                'shipping_zipcode' => 'required',
                'shipping_city' => 'required',
                'shipping_province' => 'required',
                'shipping_country' => 'required'
           ]);
        }

        //Form for card input when payment mode is via cards
        if($this->paymentmode == 'card')
        {
            $this->validateOnly($fields, [
                'card_number' => 'required | numeric',
                'exp_month' => 'required | numeric',
                'exp_year' => 'required | numeric',
                'cvc' => 'required | numeric'
            ]);
        }
       
    }

    public function placeOrder()
    {
        $this->validate([
             'firstname' => 'required',
             'lastname' => 'required',
             'email' => 'required | email',
             'mobile' => 'required | numeric',
             'line1' => 'required',
             'zipcode' => 'required',
             'city' => 'required',
             'province' => 'required',
             'country' => 'required',
             'paymentmode' => 'required'
        ]);

        if($this->paymentmode == 'card')
        {
            $this->validate([
                'card_number' => 'required | numeric',
                'exp_month' => 'required | numeric',
                'exp_year' => 'required | numeric',
                'cvc' => 'required | numeric'
            ]);
        }

        $order = new Order();

        $order->user_id = Auth::user()->id;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'];

        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->email = $this->email;
        $order->mobile = $this->mobile;
        $order->line1 = $this->line1;
        $order->line2 = $this->line2;
        $order->zipcode = $this->zipcode;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->country = $this->country;
        $order->status = 'ordered';
        $order->is_shipping_different = $this->ship_to_different ? 1:0;

        $order->save();

        foreach(Cart::instance('cart')->content() as $item)
        {
            $orderItem = new OrderItem();

            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->quantity = $item->qty;
            $orderItem->price = $item->price;
            if($item->options)
            {
                $orderItem->options = serialize($item->options);
            }
            $orderItem->save();
        }

        if($this->ship_to_different)
        {
            $this->validate([
                'shipping_firstname' => 'required',
                'shipping_lastname' => 'required',
                'shipping_email' => 'required | email',
                'shipping_mobile' => 'required | numeric',
                'shipping_line1' => 'required',
                'shipping_zipcode' => 'required',
                'shipping_city' => 'required',
                'shipping_province' => 'required',
                'shipping_country' => 'required'
           ]);
           
            $shipping = new Shipping();

            $shipping->order_id = $order->id;
            $shipping->firstname = $this->shipping_firstname;
            $shipping->lastname = $this->shipping_lastname;
            $shipping->email = $this->shipping_email;
            $shipping->mobile = $this->shipping_mobile;
            $shipping->line1 = $this->shipping_line1;
            $shipping->line2 = $this->shipping_line2;
            $shipping->zipcode = $this->shipping_zipcode;
            $shipping->city = $this->shipping_city;
            $shipping->province = $this->shipping_province;
            $shipping->country = $this->shipping_country;

            $shipping->save();

        }

        if($this->paymentmode == 'cod')
        {
            $this->makeTransaction($order_id, 'pending');
            $this->resetCart();
        }

        else if($this->paymentmode == 'card')
        {
            //Configure stripe payment gateway
            $stripe = Stripe::make(env('STRIPE_KEY'));

            try{
                //Create Card token with card details
                $token = $stripe->tokens()->create([
                    'card'=>[
                        'number' => $this->card_number,
                        'exp_month' => $this->exp_month,
                        'exp_year' => $this->exp_year,
                        'cvc' => $this->cvc
                    ]
                ]);

                //if the token is not set, flash error message, dont render thankyou page
                if(!isset($token['id']))
                {
                    session()->flash('stripe_error','The stripe token was not generated correctly!');
                    $this->thankyou = 0;
                }

                //create customer
                $customer = $stripe->customers()->create([
                    'name' => $this->firstname . '' . $this->lastname,
                    'email' => $this->email,
                    'address' => [
                        'line1' => $this->line1,
                        'postal_code' => $this->zipcode,
                        'city' => $this->city,
                        'state' => $this->province,
                        'country' => $this->country
                    ],

                    'shipping' => [
                        'name' => $this->firstname . ' ' . $this->lastname,
                        'address' => [
                            'line1' => $this->line1,
                            'postal_code' => $this->zipcode,
                            'city' => $this->city,
                            'state' => $this->province,
                            'country' => $this->country
                        ],
                    ],
                    'source' =>$token['id']
                ]);

                //create charge object
                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'USD',
                    'amount' => session()->get('checkout')['total'],
                    'description' => 'Payment for order number ' . $order->id,
                ]);

                //check payment status
                if($charge['status'] == 'succeeded')
                {   
                    //approve order and clear cart
                    $this->makeTransaction($order->id, 'approved');
                    $this->resetCart();
                }

                else
                {
                    //flash stripe error if status is not succeeded
                    session()->flash('stripe_error','Error in transaction!');
                    $this->thankyou = 0;
                }
            } catch(Exception $e){
                session()->flash('stripe_error', $e->getMessage());
                $this->thankyou = 0;
            }
        }  

        $this->sendOrderConfirmationMail($order);

    }

    public function resetCart()
    {
        $this->thankyou = 1;  //Return thankyou page / message
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
    }

    public function makeTransaction($order_id, $status)
        {
            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->order_id = $order_id;
            $transaction->mode = $this->paymentmode;
            $transaction->status = $status;
            $transaction->save();
        }

        public function sendOrderConfirmationMail($order)
        {
            Mail::to($order->email)->send(new OrderMail($order));
        }

    public function verifyForCheckout()
    {
        if(!Auth::check()) //If user is not authenticated redirects to login
        {
            return redirect()->route('login');
        }

        else if($this->thankyou) //If user is authenticated returns thankyou page
        {
            return redirect()->route('thankyou');
        }

        else if(!session()->get('checkout')) //If session does not have checkout key, redirects to cart
        {
            return redirect()->route('product.cart');
        }  
    }
    
    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}
