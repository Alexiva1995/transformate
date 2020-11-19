@extends('layouts.instructor')

@push('styles')
    <link rel="stylesheet" href="{{ asset('template/css/shoppingCart.css') }}">
@endpush

@section('content')
    <div class="background-shop">
        <div style="margin-top: 30px; margin-left: 5%; margin-right: 5%;">
            @if (Session::has('msj-exitoso'))
                <div class="uk-alert-success" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <strong>{{ Session::get('msj-exitoso') }}</strong>
                </div>
            @endif
            
            @if ($datosPago->payment_method == 'Transferencia Bancaria')
                <div class="uk-width-1-1" style="padding-bottom: 10px;">
                    <div class="uk-grid">
                        @foreach ($cuentasDisponibles as $cuenta)
                            <div class="uk-width-1-1" style="padding-bottom: 10px;">
                               <h2 style="color: #F02D00; font-size: 25px;">{{ $cuenta->bank }}</h2>
                                <div style="background-color: #E8E8E8; padding: 20px 20px;">
                                    N° CUENTA: <b>{{ $cuenta->account_type }} n. {{ $cuenta->account_number }}</b><br>
                                    BENEFICIARIO: <b>{{ $cuenta->business_name }}</b><br>
                                    RUC: <b>{{ $cuenta->identification }}</b><br>
                                </div>
                            </div>
                        @endforeach
                    </div>    
                </div>
            @endif
            
            <div class="uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>
                {{-- Sección Izquierda --}}
                <div>
                    <div class="paper">
                        <div class="checkout__head">
                            <h1 class="h2">Factura de Compra</h1>
                        </div>
                        <div class="checkout__body">
                        	@if ($datosPago->payment_method == 'Transferencia Bancaria')
                        		<h3>Para completar el proceso de compra usted debe enviar el soporte del pago al correo <a class="link-secondary--underlined" href="mailto:pagos@transformatepro.com">pagos@transformatepro.com</a> ¡Gracias por su colaboración!</h3>
                        		<hr>
                        	@endif
                        	Nombre Cliente: <b>{{ $datosPago->user->names }} {{ $datosPago->user->last_names }}</b><br>
                        	Ubicación: <b>{{ $datosPago->state }} ({{ $datosPago->country }})</b><br>
                            # de Orden: <b>{{ $datosPago->id }}</b><br>
                            Forma de Pago: <b> {{ $datosPago->payment_method }}</b><br>
                            ID de Transacción: <b>{{ $datosPago->payment_id }}</b><br>
                            Fecha de Compra: <b>{{ date('d-m-Y H:i A', strtotime("$datosPago->created_at -5 Hours")) }}</b><br>
                            @if (!is_null($datosPago->coupon)) 
                            	Cupón de Descuento: <b>{{ $datosPago->coupon->name }} ({{ $datosPago->coupon->discount }}%)</b><br>
                            	Monto Original: <b>COP$ {{ number_format($datosPago->original_amount, 0, ',', '.') }} </b><br>
                            	Monto Descontado: <b>COP$ {{ number_format($datosPago->discounted_amount, 0, ',', '.') }}</b><br>
                            @endif
                            Monto Pagado: <b>COP$ {{ number_format($datosPago->amount, 0, ',', '.') }}</b>
                        </div>
                    </div>
                    <div class="checkout__security">
                        <div class="uk-child-width-1-2" uk-grid>
                            <div class="checkout__security__item">
                                <h4 class="h3">Pago 100% seguro</h4>
                                <p>Este certificado garantiza la seguridad de todas tus conexiones mediante cifrado.</p>
                            </div>

                            <div class="checkout__security__item uk-text-right">
                                <ul class="list-inline cards-list">
                                    <li class="list-inline-item">
                                        <div class="card-wrapper">
                                            <img data-srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-visa-8a18fbf2359d9aa9ae996beea6fb859de3be9d8d5256e4fb7c0f926f22f51c45.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-visa@2x-d683b41bd4bdde323cb893fed75b982577c2352b3d22dca76d141ef9ada44113.png 2x" alt="Visa" title="Visa" class=" lazyloaded" src="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-lazyload-6b2937151d7662d2a0b37af79c23a1dfaa812544aa1bd701b42077157c08dd93.svg" srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-visa-8a18fbf2359d9aa9ae996beea6fb859de3be9d8d5256e4fb7c0f926f22f51c45.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-visa@2x-d683b41bd4bdde323cb893fed75b982577c2352b3d22dca76d141ef9ada44113.png 2x">
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="card-wrapper">
                                            <img data-srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-mastercard-ea3facb35831c19f7d184954248b0e458ed8f1efb6495f75bcc797a014252d96.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-mastercard@2x-df0939e975e0b2549a921a8d4754c7c960a55dcdfee81a2a755d0dc6f1610a78.png 2x" alt="MasterCard" title="MasterCard" class=" lazyloaded" src="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-lazyload-6b2937151d7662d2a0b37af79c23a1dfaa812544aa1bd701b42077157c08dd93.svg" srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-mastercard-ea3facb35831c19f7d184954248b0e458ed8f1efb6495f75bcc797a014252d96.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-mastercard@2x-df0939e975e0b2549a921a8d4754c7c960a55dcdfee81a2a755d0dc6f1610a78.png 2x">
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="card-wrapper">
                                            <img data-srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-amex-e085770cc9a90b2d0137362d2368866f03d44eb3cb5d5727f231ddc01981a37b.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-amex@2x-dbe04ea03eba35bef4ab4377ad5a3e96d62567caf3e13615bfa8f21e55227958.png 2x" alt="American Express" title="American Express" class=" lazyloaded" src="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-lazyload-6b2937151d7662d2a0b37af79c23a1dfaa812544aa1bd701b42077157c08dd93.svg" srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-amex-e085770cc9a90b2d0137362d2368866f03d44eb3cb5d5727f231ddc01981a37b.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-amex@2x-dbe04ea03eba35bef4ab4377ad5a3e96d62567caf3e13615bfa8f21e55227958.png 2x">
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="card-wrapper">
                                            <img data-srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-discover-ab22881b089834c3f03d4c4adde12a1e4829082575b2f07f38d19bee36000b36.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-discover@2x-39b7ebaca3f7a78aca6bc3028b2eb7e26e046cd517dc94b8aa9f2d06a81b6243.png 2x" alt="Discover" title="Discover" class=" lazyloaded" src="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-lazyload-6b2937151d7662d2a0b37af79c23a1dfaa812544aa1bd701b42077157c08dd93.svg" srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-discover-ab22881b089834c3f03d4c4adde12a1e4829082575b2f07f38d19bee36000b36.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-discover@2x-39b7ebaca3f7a78aca6bc3028b2eb7e26e046cd517dc94b8aa9f2d06a81b6243.png 2x">
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="card-wrapper">
                                            <img data-srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-jcb-568d3abc2d789efab23cf844d293a23c388d9a8a877940cc2d5950fa25219181.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-jcb@2x-ade6160b5e6ea6bb2b944d29ab2d8ea9f62bc7bc16c966598a33b5fffee0335e.png 2x" alt="JCB" title="JCB" class=" lazyloaded" src="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-lazyload-6b2937151d7662d2a0b37af79c23a1dfaa812544aa1bd701b42077157c08dd93.svg" srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-jcb-568d3abc2d789efab23cf844d293a23c388d9a8a877940cc2d5950fa25219181.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-jcb@2x-ade6160b5e6ea6bb2b944d29ab2d8ea9f62bc7bc16c966598a33b5fffee0335e.png 2x">
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="card-wrapper">
                                            <img data-srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-paypal-ade0ee5fa42753277828096cb7c287be63b3527903f2efbedeafb63ef55556c4.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-paypal@2x-48146b210b75027ddc93d59cd0b229348c1be5e62c6b8411119c9ade8cc02d78.png 2x" alt="PayPal" title="PayPal" class=" lazyloaded" src="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-lazyload-6b2937151d7662d2a0b37af79c23a1dfaa812544aa1bd701b42077157c08dd93.svg" srcset="https://cdn.domestika.org/raw/upload/assets/payment-methods/card-paypal-ade0ee5fa42753277828096cb7c287be63b3527903f2efbedeafb63ef55556c4.png, https://cdn.domestika.org/raw/upload/assets/payment-methods/card-paypal@2x-48146b210b75027ddc93d59cd0b229348c1be5e62c6b8411119c9ade8cc02d78.png 2x">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sección Derecha --}}
                <div>
                    <div class="paper--gray cart__box">
                        <div class="cart__box__head">
                            <div class="align-items-end">
                                <div class="mr-auto">
                                    <h2 class="h3 cart__title">Productos Comprados <span>({{ $cantItems }})</span></h2>
                                </div>
                            </div>
                        </div>
                        <ul class="cart-list cart-list--small">
                            @foreach ($items as $item)
                                <li class="cart-list__item">
                                    <div uk-grid>
                                        <div class="uk-width-expand@m">
                                            <div class="cart-list__details">
                                                @if (!is_null($item->membership_id))
                                                    <h3 class="h4 cart-list__title">{{ $item->membership->name }}</h3>
                                                    
                                                    <div class="cart-list__img">
                                                        <picture><img class="img-item" alt="{{ $item->membership->name }}" src="{{ asset('template/images/ico8.png') }}"></picture>
                                                    </div>
                                                @elseif (!is_null($item->product_id))
                                                    <h3 class="h4 cart-list__title">{{ $item->market_product->name }}</h3>
                                                    <p class="cart-list__info">Un producto de {{ $item->market_product->user->names }} {{ $item->market_product->user->last_names }}</p>
                                                    <div class="cart-list__img">
                                                        <picture><img class="img-item" alt="{{ $item->market_product->name}}" src="{{ asset('uploads/images/products/'.$item->market_product->cover) }}"></picture>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="uk-width-auto@m">
                                            <div class="cart-list__price">COP$ {{ number_format($item->amount, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <div class="purchase-reasons">
                            <h2>¿Qué acabas de comprar?</h2>
                            <ul>
                                <li><i class="fa fa-smile"></i> Acceso ilimitado a los productos que compres que nunca expira para verlos todas las veces que desees.</li>
                                <li><i class="fa fa-film"></i> Acceso por tiempo indefinido a las diferentes unidades del curso, sus lecciones, textos explicativos y recursos adicionales.</li>
                                <li><i class="fa fa-users"></i> Acceso a la comunidad exclusiva del curso donde podrás intercambiar experiencias con el profesor y otros alumnos.</li>
                            </ul>
                            <hr>
                            <ul>
                                <li>
                                    <i class="fa fa-question-circle"></i> Si tienes cualquier pregunta, envíanos un email a <a class="link-secondary--underlined" href="mailto:support@transformatepro.com">support@transformatepro.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection