@extends('layouts.app')

@section('content')
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const clientToken = "{!! $clientToken !!}";
        const mp = new MercadoPago(clientToken);
        const bricksBuilder = mp.bricks();

        var total = {{ $total }};
        total = {{$total + round($total * 0.0629, 2)}}
        var cartTotal = {{ $cartTotal }};
        var cart = {!! json_encode($cart) !!};
        var shippingCosts = {{ $shippingCosts }};
        var cartItems = {!! json_encode($cartItems) !!};
        var colors = {!! json_encode($colors) !!};
        var address = {!! json_encode($address) !!}
        var contents = [];
        var prefId = "{{ $pref->id }}";
        var csrf = "{{ csrf_token() }}";

        for (const element of cartItems) {
            var item = {
                units: element.units,
                value: element.value,
                name: element.name,
                imageURL: element.imageURL
            }
            contents.push(item);
        }
    </script>


    <div id="paymentBrick_container"></div>
    @if ($errors->has('paymentError'))
    <div class="alert alert-danger">
        {{ $errors->first('paymentError') }}
    </div>
@endif

    @if ($selectedMethod == 'domicilio')
    <script>
        const renderPaymentBrick = async (bricksBuilder) => {
            const settings = {
                initialization: {
                    /*
                     "amount" es el monto total a pagar por todos los medios de pago con excepción de la Cuenta de Mercado Pago y Cuotas sin tarjeta de crédito, las cuales tienen su valor de procesamiento determinado en el backend a través del "preferenceId"
                    */
                    amount: total,
                    items: {
                        totalItemsAmount: cartTotal,
                        itemsList: contents
                    },
                    shipping: { // opcional
                        costs: shippingCosts, // opcional
                        shippingMode: "Envio a domicilio",
                        description: "El paquete llega hasta tu casa mediante el servicio de paqueteria OCA", // opcional
                        receiverAddress: {
                            streetName: address.street,
                            streetNumber: `${address.number}`,
                            complement: address.department,
                            neighborhood: address.city.name, // opcional
                            city: address.province.name, // opcional
                            zipCode: address.zip_code.code,
                            additionalInformation: address.observation, // opcional
                        },
                    },
                    preferenceId: prefId,
                },
                customization: {
                    enableReviewStep: true,
                    paymentMethods: {
                        creditCard: "all",
                        debitCard: "all",
                        mercadoPago: "all",
                    },
                },
                callbacks: {
                    onReady: () => {
                        /*
                         Callback llamado cuando el Brick está listo.
                         Aquí puede ocultar cargamentos de su sitio, por ejemplo.
                        */
                    },
                    onSubmit: ({
                        selectedPaymentMethod,
                        formData
                    }) => {
                        // callback llamado al hacer clic en el botón enviar datos
                        return new Promise((resolve, reject) => {
                            fetch("/process_payment", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": csrf,
                                    },
                                    body: JSON.stringify(formData),
                                })
                                .then((response) => response.json())
                                .then((response) => {
                                    console.log(response);
                                    if (response.status === 'error') {
                                        if (window.paymentBrickController) {
                                        window.paymentBrickController.unmount();
                                        }
                                        // Redirect to the cart page with the session flash message
                                        window.location.href = response.redirect_url;
                                    }
                                    else
                                    {
                                        console.log(response);
                                        // recibir el resultado del pago
                                        resolve();
                                        // Unmount the Payment Brick before navigating away
    
                                        // Create a form dynamically for the POST request
                                        const form = document.createElement('form');
                                        form.method = 'POST';
                                        form.action = "{{route('checkout.handlePayment')}}";
    
                                        // Add CSRF token (since it's a POST request)
                                        const csrfInput = document.createElement('input');
                                        csrfInput.type = 'hidden';
                                        csrfInput.name = '_token';
                                        csrfInput.value = csrf;  // You already have csrf in the script, reuse it here
                                        form.appendChild(csrfInput);
    
                                        // Add hidden inputs for the data you need to pass
                                        const selectedMethodInput = document.createElement('input');
                                        selectedMethodInput.type = 'hidden';
                                        selectedMethodInput.name = 'selectedMethod';
                                        selectedMethodInput.value = 'domicilio';
                                        form.appendChild(selectedMethodInput);
    
                                        const addressInput = document.createElement('input');
                                        addressInput.type = 'hidden';
                                        addressInput.name = 'address_id';
                                        addressInput.value = address.id;
                                        form.appendChild(addressInput);
    
                                        const deliveryPriceInput = document.createElement('input');
                                        deliveryPriceInput.type = 'hidden';
                                        deliveryPriceInput.name = 'delivery_price';
                                        deliveryPriceInput.value = shippingCosts;
                                        form.appendChild(deliveryPriceInput);
    
                                        const mpOrderIdInput = document.createElement('input');
                                        mpOrderIdInput.type = 'hidden';
                                        mpOrderIdInput.name = 'mp_order_id';
                                        mpOrderIdInput.value = response.id;
                                        form.appendChild(mpOrderIdInput);
    
                                        // Append form to the body and submit it
                                        document.body.appendChild(form);
                                        form.submit();
                                    }
                                })
                                .catch((error) => {
                                    // manejar la respuesta de error al intentar crear el pago
                                    // Unmount the Payment Brick in case of an error
                                    console.log(error);
                                    reject();
                                });
                        });
                    },
                    onError: (error) => {
                        // callback llamado para todos los casos de error de Brick
                        console.error(error);
                    },
                    onClickEditShippingData: () => {
                        window.location.href = "/cart"
                    }, // opcional
                    onClickEditBillingData: () => {}, // opcional
                    onRenderNextStep: (currentStep) => {}, // opcional
                    onRenderPreviousStep: (currentStep) => {}, // opcional
                },
            };
            window.paymentBrickController = await bricksBuilder.create(
                "payment",
                "paymentBrick_container",
                settings
            );
        };
        renderPaymentBrick(bricksBuilder);
    </script>
        
    @elseif ($selectedMethod == 'sucursal')
    <script>
        var sucursal = {!! json_encode($sucursal) !!};
        console.log(sucursal);
        const renderPaymentBrick = async (bricksBuilder) => {
            const settings = {
                initialization: {
                    /*
                     "amount" es el monto total a pagar por todos los medios de pago con excepción de la Cuenta de Mercado Pago y Cuotas sin tarjeta de crédito, las cuales tienen su valor de procesamiento determinado en el backend a través del "preferenceId"
                    */
                    amount: total,
                    items: {
                        totalItemsAmount: cartTotal,
                        itemsList: contents
                    },
                    shipping: { // opcional
                        costs: shippingCosts, // opcional
                        shippingMode: "Retiro en sucursal OCA",
                        description: "El paquete se envia a una sucursal de OCA de tu eleccion, donde podes ir a retirarlo", // opcional
                        receiverAddress: {
                            streetName: sucursal.Calle,
                            streetNumber: sucursal.Numero,
                            city: sucursal.Provincia, // opcional
                            zipCode: sucursal.CodigoPostal,
                        },
                    },
                    preferenceId: prefId,
                },
                customization: {
                    enableReviewStep: true,
                    paymentMethods: {
                        creditCard: "all",
                        debitCard: "all",
                        mercadoPago: "all",
                    },
                },
                callbacks: {
                    onReady: () => {
                        /*
                         Callback llamado cuando el Brick está listo.
                         Aquí puede ocultar cargamentos de su sitio, por ejemplo.
                        */
                    },
                    onSubmit: ({
                        selectedPaymentMethod,
                        formData
                    }) => {
                        // callback llamado al hacer clic en el botón enviar datos
                        return new Promise((resolve, reject) => {
                            fetch("/process_payment", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": csrf,
                                    },
                                    body: JSON.stringify(formData),
                                })
                                .then((response) => response.json())
                                .then((response) => {
                                    if (response.status === 'error') {
                                        if (window.paymentBrickController) {
                                        window.paymentBrickController.unmount();
                                        }
                                        // Redirect to the cart page with the session flash message
                                        window.location.href = response.redirect_url;
                                    }
                                    else
                                    {
                                        console.log(response);
                                        // recibir el resultado del pago
                                        resolve();
                                        // Unmount the Payment Brick before navigating away
    
                                        // Create a form dynamically for the POST request
                                        const form = document.createElement('form');
                                        form.method = 'POST';
                                        form.action = "{{route('checkout.handlePayment')}}";
    
                                        // Add CSRF token (since it's a POST request)
                                        const csrfInput = document.createElement('input');
                                        csrfInput.type = 'hidden';
                                        csrfInput.name = '_token';
                                        csrfInput.value = csrf;  // You already have csrf in the script, reuse it here
                                        form.appendChild(csrfInput);
    
                                        // Add hidden inputs for the data you need to pass
                                        const selectedMethodInput = document.createElement('input');
                                        selectedMethodInput.type = 'hidden';
                                        selectedMethodInput.name = 'selectedMethod';
                                        selectedMethodInput.value = 'sucursal';
                                        form.appendChild(selectedMethodInput);
    
                                        const sucursalInput = document.createElement('input');
                                        sucursalInput.type = 'hidden';
                                        sucursalInput.name = 'sucursal';
                                        sucursalInput.value = sucursal.IdCentroImposicion;
                                        form.appendChild(sucursalInput);
                                        
                                        const zipCodeInput = document.createElement('input');
                                        zipCodeInput.type = 'hidden';
                                        zipCodeInput.name = 'zip_code';
                                        zipCodeInput.value = sucursal.CodigoPostal;
                                        form.appendChild(zipCodeInput);
                                        
                                        const deliveryPriceInput = document.createElement('input');
                                        deliveryPriceInput.type = 'hidden';
                                        deliveryPriceInput.name = 'delivery_price';
                                        deliveryPriceInput.value = shippingCosts;
                                        form.appendChild(deliveryPriceInput);
    
                                        const mpOrderIdInput = document.createElement('input');
                                        mpOrderIdInput.type = 'hidden';
                                        mpOrderIdInput.name = 'mp_order_id';
                                        mpOrderIdInput.value = response.id;
                                        form.appendChild(mpOrderIdInput);
    
                                        // Append form to the body and submit it
                                        document.body.appendChild(form);
                                        form.submit();
                                    }
                                })
                                .catch((error) => {
                                    // manejar la respuesta de error al intentar crear el pago
                                    // Unmount the Payment Brick in case of an error
                                    console.log(error);
                                    reject();
                                });
                        });
                    },
                    onError: (error) => {
                        // callback llamado para todos los casos de error de Brick
                        console.error(error);
                    },
                    onClickEditShippingData: () => {}, // opcional
                    onClickEditBillingData: () => {}, // opcional
                    onRenderNextStep: (currentStep) => {}, // opcional
                    onRenderPreviousStep: (currentStep) => {}, // opcional
                },
            };
            window.paymentBrickController = await bricksBuilder.create(
                "payment",
                "paymentBrick_container",
                settings
            );
        };
        renderPaymentBrick(bricksBuilder);
    </script>

    @elseif ($selectedMethod == 'retiro')
    <script>
        console.log(address);
        const renderPaymentBrick = async (bricksBuilder) => {
            const settings = {
                initialization: {
                    /*
                     "amount" es el monto total a pagar por todos los medios de pago con excepción de la Cuenta de Mercado Pago y Cuotas sin tarjeta de crédito, las cuales tienen su valor de procesamiento determinado en el backend a través del "preferenceId"
                    */
                    amount: total,
                    items: {
                        totalItemsAmount: cartTotal,
                        itemsList: contents
                    },
                    shipping: { // opcional
                        costs: 0, // opcional
                        shippingMode: "Retiro en local de Rino",
                        description: "Tu pedido te va a estar esperando en el local de Rino. Acordate de llevar tu DNI con el que hiciste la compra para poder retirarlo.", // opcional
                        receiverAddress: {
                            streetName: 'Milán',
                            streetNumber: '1201',
                            city: "Corrientes Capital", // opcional
                            zipCode: "3400",
                        },
                    },
                    preferenceId: prefId,
                },
                customization: {
                    enableReviewStep: true,
                    paymentMethods: {
                        creditCard: "all",
                        debitCard: "all",
                        mercadoPago: "all",
                    },
                },
                callbacks: {
                    onReady: () => {
                        
                        /*
                         Callback llamado cuando el Brick está listo.
                         Aquí puede ocultar cargamentos de su sitio, por ejemplo.
                        */
                    },
                    onSubmit: ({
                        selectedPaymentMethod,
                        formData
                    }) => {
                        // callback llamado al hacer clic en el botón enviar datos
                        return new Promise((resolve, reject) => {
                            fetch("/process_payment", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": csrf,
                                    },
                                    body: JSON.stringify(formData),
                                })
                                .then((response) => response.json())
                                .then((response) => {
                                    if (response.status === 'error') {
                                        if (window.paymentBrickController) {
                                        window.paymentBrickController.unmount();
                                        }
                                        // Redirect to the cart page with the session flash message
                                        window.location.href = response.redirect_url;
                                    }
                                    else
                                    {
                                        console.log(response);
                                        // recibir el resultado del pago
                                        resolve();
                                        // Unmount the Payment Brick before navigating away
    
                                        // Create a form dynamically for the POST request
                                        const form = document.createElement('form');
                                        form.method = 'POST';
                                        form.action = "{{route('checkout.handlePayment')}}";
    
                                        // Add CSRF token (since it's a POST request)
                                        const csrfInput = document.createElement('input');
                                        csrfInput.type = 'hidden';
                                        csrfInput.name = '_token';
                                        csrfInput.value = csrf;  // You already have csrf in the script, reuse it here
                                        form.appendChild(csrfInput);
    
                                        // Add hidden inputs for the data you need to pass
                                        const selectedMethodInput = document.createElement('input');
                                        selectedMethodInput.type = 'hidden';
                                        selectedMethodInput.name = 'selectedMethod';
                                        selectedMethodInput.value = 'retiro';
                                        form.appendChild(selectedMethodInput);

                                        const deliveryPriceInput = document.createElement('input');
                                        deliveryPriceInput.type = 'hidden';
                                        deliveryPriceInput.name = 'delivery_price';
                                        deliveryPriceInput.value = 0;
                                        form.appendChild(deliveryPriceInput);
    
                                        const mpOrderIdInput = document.createElement('input');
                                        mpOrderIdInput.type = 'hidden';
                                        mpOrderIdInput.name = 'mp_order_id';
                                        mpOrderIdInput.value = response.id;
                                        form.appendChild(mpOrderIdInput);
    
                                        // Append form to the body and submit it
                                        document.body.appendChild(form);
                                        form.submit();
                                    }
                                })
                                .catch((error) => {
                                    // manejar la respuesta de error al intentar crear el pago
                                    // Unmount the Payment Brick in case of an error
                                    console.log(error);
                                    reject();
                                });
                        });
                    },
                    onError: (error) => {
                        // callback llamado para todos los casos de error de Brick
                        console.error(error);
                    },
                    onClickEditShippingData: () => {}, // opcional
                    onClickEditBillingData: () => {}, // opcional
                    onRenderNextStep: (currentStep) => {}, // opcional
                    onRenderPreviousStep: (currentStep) => {}, // opcional
                },
            };
            window.paymentBrickController = await bricksBuilder.create(
                "payment",
                "paymentBrick_container",
                settings
            );
        };
        renderPaymentBrick(bricksBuilder);
    </script>
    @endif
    <script type="text/javascript">
    window.onbeforeunload = confirmExit;

function confirmExit() {
    window.paymentBrickController.unmount()
}
document.addEventListener('paymentComplete', (event) => 
{
  console.log(event.detail.id);
  fetch(`/payment/status/${event.detail.id}`, {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf,
          },
        })
    })
      </script>
@endsection
