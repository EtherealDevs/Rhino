@extends('layouts.app')
@section('content')
    <section>
        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#0051ff] to-[#bb94b7] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            <div class=" text-black font-sans antialiased">
                <div class="container mx-auto flex flex-col items-center ">
                    <div class="flex mt-12 flex-col w-full sticky md:top-36 lg:w-1/3 md:mt-12 px-8">
                        <div class="text-center">
                            <h1 class="text-4xl font-bold text-gray-900 sm:text-6xl">Terminos y Condiciones</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" text-black font-sans py-8">
                <div class="container mx-auto flex flex-col items-start ">
                    <div class="flex justify-center mt-12 w-full md:mt-12 px-8">
                        <div class="bg-white p-7 rounded-xl w-11/12">
                            <p class="mt-6 text-lg text-gray-600">Es requisito necesario para la adquisición de los
                                productos que se ofrecen en este sitio, que lea y acepte los siguientes Términos y
                                Condiciones que a continuación se redactan. El uso de nuestros servicios así como la compra
                                de nuestros productos implicará que usted ha leído y aceptado los Términos y Condiciones de
                                uso en el presente documento. Para adquirir un producto, será necesario el registro por
                                parte del usuario, con ingreso de datos personales fidedignos y definición de una
                                contraseña.


                            <h2 class="font-bold text-xl italic mt-12"> 1. Licencia</h2>
                            <p class="mt-6">
                                A través de su sitio web, RINO Indumentaria concede una licencia limitada, no exclusiva, no
                                transferible para que los usuarios hagan uso personal, no comercial de los productos que han
                                comprado en este sitio web de acuerdo a los Términos y Condiciones que se describen en este
                                documento. Esta licencia no incluye la reventa ni el uso comercial de los productos ni de
                                los contenidos que se muestran en la plataforma.
                            </p>

                            <h2 class="font-bold text-xl italic mt-12"> 2. Uso no autorizado</h2>
                            <p class="mt-6">
                                El usuario no puede copiar ninguno de los productos o contenidos de RINO Indumentaria,
                                modificados o sin modificar, en un CD, sitio web o ningún otro medio, ni ofrecerlos para la
                                redistribución gratuita o la reventa de ningún tipo para el beneficio de un tercero. De
                                hacerlo, RINO Indumentaria podrá cancelar su cuenta en nuestra plataforma.
                            </p>

                            <h2 class="font-bold text-xl italic mt-12">3. Propiedad</h2>
                            <p class="mt-6">
                                El usuario no puede declarar propiedad intelectual o exclusiva a ninguno de los productos o
                                contenidos de RINO Indumentaria, modificados o sin modificar. Todos los productos y
                                contenidos son propiedad de la empresa. En ningún caso esta compañía será responsable de
                                ningún daño incluyendo, pero no limitado a, daños directos, indirectos, especiales,
                                fortuitos o consecuentes u otras pérdidas resultantes del uso o de la imposibilidad de
                                utilizar nuestros productos.
                            </p>

                            <h2 class="font-bold text-xl italic mt-12">4. Modificación y cancelación de servicios</h2>
                            <p class="mt-6">
                                RINO Indumentaria cambia y mejora constantemente sus servicios para brindar una mejor
                                experiencia y calidad a sus usuarios. La empresa puede agregar, modificar o eliminar
                                funciones, características, requisitos, promociones y servicios si lo considera necesario.
                            </p>

                            <h2 class="font-bold text-xl italic mt-12">5. Términos adicionales</h2>
                            <p class="mt-6">
                                Productos: Ropa y accesorios que se ofrecen para la venta a través de nuestra plataforma.

                                Plataforma: Se refiere al sitio web, plataforma virtual y otros medios digitales como
                                nuestra aplicación para smartphone. Sus titulares corresponden a RINO Indumentaria.

                                Condiciones: Términos y condiciones particulares de cada compra.

                                Políticas: Las políticas, tal como es la de Privacidad, en conjunto con nuestros Términos y
                                Condiciones rigen nuestra relación con el usuario dentro de nuestra plataforma.
                            </p>

                            <h2 class="font-bold text-xl italic mt-12">6. Política de Devoluciones y Reembolsos</h2>
                            <p class="mt-6">
                                Nuestra política de devoluciones y reembolsos está diseñada para garantizar la satisfacción de nuestros clientes. Si no está completamente satisfecho con su compra, puede solicitar una devolución o reembolso dentro de los 30 días posteriores a la compra, siempre que el producto se encuentre en las mismas condiciones en las que fue recibido. Consulte nuestra Política de Devoluciones y Reembolsos para más detalles.
                            </p>

                            <h2 class="font-bold text-xl italic mt-12">7. Legislación Aplicable</h2>
                            <p class="mt-6">
                                Estos Términos y Condiciones se rigen por las leyes de la República Argentina. Cualquier disputa que surja de la interpretación o aplicación de estos términos será sometida a los tribunales competentes en la ciudad de Corrientes, Argentina.
                            </p>

                            <h2 class="font-bold text-xl italic mt-12">8. Contacto</h2>
                            <p class="mt-6">
                                Para cualquier consulta relacionada con estos Términos y Condiciones, puede ponerse en contacto con nosotros a través de nuestro correo electrónico <a class="text-blue-600" href="mailto:julia.-castillo@hotmail.com">Mail</a> o llamándonos al <a class="text-green-400" href="https://wa.me/c/5493794316606">Whatsapp</a>.
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#004cff] to-[#0e0953] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
    </section>
@endsection
