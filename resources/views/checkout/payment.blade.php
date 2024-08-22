@extends('layouts.app')

@section('content')
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago('TEST-72c541f1-18d2-4c49-9f44-d95167a37771');
    const bricksBuilder = mp.bricks();
    var cart = {!! json_encode($cart) !!}
    var contents = [];
    var prefId = "{{ $pref->id }}";
    var csrf = "{{csrf_token()}}";

    for (const element of cart.contents) {
        var item = {
            units: element.amount,
            value: element.item.sale_price ? element.item.sale_price : element.item.original_price,
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
            preferenceId: prefId,
          },
          customization: {
            enableReviewStep: true,
            paymentMethods: {
              ticket: "all",
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
                    reject();
                  });
              });
            },
            onError: (error) => {
              // callback llamado para todos los casos de error de Brick
              console.error(error);
            },
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
