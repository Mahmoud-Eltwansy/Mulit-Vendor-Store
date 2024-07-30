<x-front-layout title="Cart">
    {{-- Start Breadcrumb --}}
    <x-slot name=breadcrumbs >
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Cart</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i>Home</a></li>
                            <li><a href="{{ route('products.index')}}">Shop</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    {{-- End Breadcrumb --}}

    {{-- Shopping Cart --}}
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                {{-- Cart List Title --}}
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12 bold">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                {{-- End Cart List Title --}}
                @foreach ($cart->get() as $item )
                {{-- Cart Single List list --}}
                <div class="cart-single-list">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12">
                            <a href="{{ route( 'products.show',$item->product->slug) }}">
                                <img src="{{$item->product->image_url}}" alt="#">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <h5 class="product-name">
                                <a href="{{ route( 'products.show',$item->product->slug) }}">
                                    {{$item->product->name}}
                                </a>
                            </h5>
                            <p class="product-des">
                                <span><em>Type:</em>Mirrorless</span>
                                <span><em>Color:</em>Black</span>
                            </p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="count-input">
                                <input class="form-control" value="{{ $item->quantity }}">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ \App\Helpers\Currency::format($item->quantity * $item->product->price) }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ \App\Helpers\Currency::format(0) }}</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <a href="javascript:void(0)" class="remove-item"><i class="lni lni-close"></i></a>
                        </div>
                    </div>
                </div>
                {{-- End Single List list --}}
                @endforeach
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    {{-- Total Amount --}}
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="coupon" placeholder="Enter Your Coupon">
                                            <div class="button mt-2">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal <span class="pl-4">{{\App\Helpers\Currency::format($cart->total())}}</span></li>
                                        <li>Shipping <span>Free</span></li>
                                        <li>You Save <span>29$</span></li>
                                        <li class="last">You Pay <span></span></li>
                                    </ul>
                                    <div class="button mt-4">
                                        <a href="#" class="btn">Checkout</a>
                                        <a href="#" class="btn btn-alt">Continue Shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Total Amount --}}

                </div>
            </div>
        </div>
    </div>
    {{-- End Shopping Cart --}}

</x-front-layout>
