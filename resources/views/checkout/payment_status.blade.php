@extends('layouts.app')

@section('content')
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago('TEST-72c541f1-18d2-4c49-9f44-d95167a37771');
        const bricksBuilder = mp.bricks();
        var payment = {!! $payment !!};

        var csrf = "{{ csrf_token() }}";
    </script>



    <div id="statusScreenBrick_container"></div>


    <script>
        const renderStatusScreenBrick = async (bricksBuilder) => {
            const settings = {
                initialization: {
                    paymentId: payment, // id de pago para mostrar
                },
                callbacks: {
                    onReady: () => {
                        /*
                          Callback llamado cuando Brick está listo.
                          Aquí puede ocultar cargamentos de su sitio, por ejemplo.
                        */
                    },
                    onError: (error) => {
                        // callback llamado solicitada para todos los casos de error de Brick
                        console.error(error);
                    },
                },
            };
            window.statusScreenBrickController = await bricksBuilder.create(
                'statusScreen',
                'statusScreenBrick_container',
                settings,
            );
        };
        renderStatusScreenBrick(bricksBuilder);
    </script>
    <script type="text/javascript">
        window.onbeforeunload = confirmExit;

        function confirmExit() {
            window.paymentBrickController.unmount()
        } <
        />
    @endsection
