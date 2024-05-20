@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('index') }}">Home</a>
                            <a href="{{ route('frontend.products') }}">Shop</a>
                            <span>Shopping Cart</span>
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
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Sale</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart_data as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset($item->product->image) }}" style="width: 100px; height: 100px" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{$item->product->name}}</h6>
                                        </div>
                                    </td>
                                    <td class="cart__price">{{ $item->product->price }}₮</td>
                                    <td class="cart__price">{{ $item->product->sale_percent }}%</td>

                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="number" name="quantity" class="quantity-input"
                                                       value="{{ $item->quantity }}"
                                                       min="1"
                                                       max="{{ $item->product->quantity }}">
                                            </div>
                                        </div>
                                    </td>

                                    <td class="cart__price total-price">{{ $item->quantity * $item->product->price * (1 - $item->product->sale_percent / 100) }}₮</td>
                                    <td class="cart__close">
                                        <i class="fa fa-close remove-item"></i>
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

@section('script')
    <script>
        var proQty = $('.pro-qty-2');
        proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
        proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');

        proQty.on('click', '.qtybtn', function () {
            var $button = $(this);
            var $input = $button.parent().find('input');
            var oldValue = parseInt($input.val());
            var maxVal = parseInt($input.attr('max'));
            var newVal;

            if ($button.hasClass('inc')) {
                newVal = oldValue < maxVal ? oldValue + 1 : maxVal;
            } else {
                newVal = oldValue > 1 ? oldValue - 1 : 1;
            }

            $input.val(newVal).trigger('change');
        });

        $('.quantity-input').on('change', function() {
            var $row = $(this).closest('tr');
            var id = $row.data('id');
            var quantity = $(this).val();

            $.ajax({
                url: '{{ route('frontend.update-cart') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: quantity
                },
                success: function(response) {
                    if(response.success) {
                        $row.find('.total-price').text(response.totalPrice + '₮');
                    }
                }
            });
        });

        $('.remove-item').on('click', function() {
            var $row = $(this).closest('tr');
            var id = $row.data('id');

            $.ajax({
                url: '{{ route('frontend.remove-cart') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    if(response.success) {
                        $row.remove();
                    }
                }
            });
        });
    </script>
@endsection
