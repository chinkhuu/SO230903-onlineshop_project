@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>ORDERS</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('index') }}">Home</a>
                            <a href="{{ route('frontend.products') }}">Shop</a>
                            <span>Orders</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping__cart__table">
                        <table >
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Username</th>
                                <th>Payment Mode</th>
                                <th>Ordered Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $item)
                                <tr>
                                    <td class="cart__price">{{ $item->id }}</td>
                                    {{--                                    <td class="cart__price">{{ $item->id }}</td>--}}
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h6>{{$item->lastname}}</h6> <h6>{{$item->firstname}}</h6>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h6>{{ $item->payment_method }}</h6>
                                        </div>
                                    </td>

                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h6>{{ $item->created_at->format('Y-m-d') }}</h6>
                                        </div>
                                    </td>

                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h6>{{ $item->status }}</h6>
                                        </div>
                                    </td>

                                    <td class="cart__close">
                                        <a href="{{route('order.show', ['order' => $item->id])}}">
                                            <i class="fa fa-shopping-basket"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection

