@extends('layouts.app')

@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">

                <form action="{{route('checkout-store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Захиалагчийн мэдээлэл</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Овог<span>*</span></p>
                                        <input type="text" name="lastname" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Нэр<span>*</span></p>
                                        <input type="text" name="firstname" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Утасны дугаар<span>*</span></p>
                                        <input type="number" name="phone_number" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Дүүрэг<span>*</span></p>
                                        <select name="district" required>
                                            <option value="" selected disabled>дүүрэг сонгоно уу</option>
                                            <option value="Багануур">Багануур</option>
                                            <option value="Багахангай">Багахангай</option>
                                            <option value="Баянгол">Баянгол</option>
                                            <option value="Баянзүрх">Баянзүрх</option>
                                            <option value="Налайх">Налайх</option>
                                            <option value="Сонгинохайрхан">Сонгинохайрхан</option>
                                            <option value="Сүхбаатар">Сүхбаатар</option>
                                            <option value="Хан-Уул">Хан-Уул</option>
                                            <option value="Чингэлтэй">Чингэлтэй</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Хороо<span>*</span></p>
                                        <input type="number" name="khoroo" max="50" min="1">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Хаяг<span>*</span></p>
                                <input type="text" placeholder="Дэлгэрэнгүй хаяг бичнэ үү"
                                       name="address">
                            </div>


                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">
                                    Product
                                    <span>Total</span>

                                </div>

                                <ul class="checkout__total__products">
                                    <!-- Loop through the products in the cart -->
                                    @foreach($cart_data as $item)
                                        <li>{{ $item->product->name }} <span>{{ $item->quantity * $item->product->price * (1 - $item->product->sale_percent / 100) }}₮</span></li>
                                    @endforeach
                                </ul>

                                <ul class="checkout__total__all">
                                    <li>Total <span>{{ $total_price }}₮</span></li>
                                </ul>

                                <p>Та худалдан авалтаа дахин хянаарай. Барааг худалдан авсны дараа буцаах боломжгүйг анхаарна уу</p>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
