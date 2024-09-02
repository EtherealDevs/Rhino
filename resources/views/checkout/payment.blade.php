@extends('layouts.app')

@section('content')
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago('TEST-72c541f1-18d2-4c49-9f44-d95167a37771');
    const bricksBuilder = mp.bricks();
    var cart = {!! json_encode($cart) !!};
    var colors = {!! json_encode($colors) !!};
    var address = {!! json_encode($address) !!}
    console.log(colors);
    console.log(address);
    console.log(address.province.name);
    console.log(address.city.name);
    console.log(address.zip_code.code);
    var contents = [];
    var prefId = "{{ $pref->id }}";
    var csrf = "{{csrf_token()}}";

    for (const element of cart.contents) {
        var item = {
            units: element.amount,
            value: element.item.sale_price ? element.item.sale_price / 100 : element.item.original_price / 100,
            name: element.item.product.name,
            imageURL: element.item.images[0].url
        }
        contents.push(item);
    }
    console.log(contents);

</script>


    <div id="paymentBrick_container"></div>

    <script>
        const renderPaymentBrick = async (bricksBuilder) => {
        const settings = {
          initialization: {
            /*
             "amount" es el monto total a pagar por todos los medios de pago con excepción de la Cuenta de Mercado Pago y Cuotas sin tarjeta de crédito, las cuales tienen su valor de procesamiento determinado en el backend a través del "preferenceId"
            */
            amount: cart.total / 100,
            items: {
            totalItemsAmount: cart.total / 100,
            itemsList: contents
            },
            shipping: { // opcional
      costs: 5, // opcional
      shippingMode: "<SHIPPING_MODE>",
      description: "<SHIPPING_DESCRIPTION>", // opcional
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
            onSubmit: ({ selectedPaymentMethod, formData }) => {
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
                    // recibir el resultado del pago
                    resolve();
                  })
                  .catch((error) => {
                    // manejar la respuesta de error al intentar crear el pago
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
    <script type="text/javascript">
        window.onbeforeunload = confirmExit;
        function confirmExit()
        {
            window.paymentBrickController.unmount()
        }
      </script>
@endsection
