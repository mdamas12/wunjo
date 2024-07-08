<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    payment: {
        type: Object,
        required: true,
    },
    paymentdetails: {
        type: Object,
        required: false,
    },
    payment_checks: {
        type: Object,
        required: false,
    },
    typemethods: {
        type: Object,
        required: false,
    },
});
</script>

<template>
    <wjAppLayout>
        <template #header> </template>
        <!-- Main Add Branch -->
        <div class="w-[90%] mx-auto rounded-lg border border-gray-200 p-5 m-5">
            <div
                class="flex justify-between mb-3 pb-2 border-b-gray-200 border-b-2"
            >
                <h1
                    class="flex font-semibold text-xl text-gray-700 leading-tigh"
                >
                    Pago Recibido
                </h1>
                <Link
                    :href="route('payments.index')"
                    class="w-full inline-flex mx-3 items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    <svg
                        class="h-6 w-6 text-white"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path
                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"
                        />
                        <path d="M20 12h-13l3 -3m0 6l-3 -3" />
                    </svg>
                    Volver
                </Link>
            </div>
            <div
                class="grid gap-2 text-sm lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-3 border-b"
            >
                <div>
                    <button
                        v-if="
                            $page.props.user['roles'] == 'supra' ||
                            $page.props.user['roles'] == 'administrator'
                        "
                        @click="changeStatus(payment)"
                        class="justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        <svg
                            class="h-8 w-8 text-gray-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"
                            />
                        </svg>
                        Confirmar pago
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3">
                <!--  content -->
                <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                    <h3>Fecha</h3>
                    <p
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        {{ payment.date }}
                    </p>
                </div>
                <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                    <h3>Paciente</h3>

                    <p
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        {{ payment.patient.fist_name }}
                        {{ payment.patient.last_name }}
                    </p>
                </div>

                <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                    <h3>Monto</h3>
                    <p
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        {{ payment.amount }}
                    </p>
                </div>
            </div>
            <div v-if="paymentdetails.length > 0">
                <h2 class="text-gray-600 text-center font-bold">
                    Detalles del Pago :
                </h2>
                <div
                    class="sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                >
                    <table
                        class="md:table-fixed w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5 overflow-auto"
                    >
                        <thead class="text-white">
                            <tr
                                v-for="(detail, index) in paymentdetails"
                                class="bg-gray-500 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                            >
                                <th
                                    class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                                >
                                    FECHA
                                </th>
                                <th
                                    class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                                >
                                    TIPO
                                </th>
                                <th
                                    class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                                >
                                    MONTO PAGADO
                                </th>
                                <th
                                    class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                                >
                                    STATUS PAGO
                                </th>
                            </tr>
                        </thead>
                        <tbody class="flex-1 sm:flex-none md:flex-none">
                            <tr
                                v-for="(detail, index) in paymentdetails"
                                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 md:text-xs lg:text-md"
                            >
                                <td
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    {{
                                        detail.consultation_id
                                            ? changeFormat(
                                                  detail.consultation.date
                                              )
                                            : changeFormat(detail.package.date)
                                    }}
                                </td>
                                <td
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    {{
                                        detail.consultation_id
                                            ? "CONSULTA"
                                            : "PAQUETE"
                                    }}
                                </td>
                                <td
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    {{ detail.amount_payable }}
                                </td>

                                <td
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    {{
                                        detail.consultation_id
                                            ? detail.consultation.status_payment
                                            : detail.package.status_payment
                                    }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div v-if="paymentdetails.length > 0">
                <h2 class="text-gray-600 text-center font-bold">
                    Pagos Parciales :
                </h2>
                <div
                    class="sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                >
                    <table
                        class="md:table-fixed w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5 overflow-auto"
                    >
                        <thead class="text-white">
                            <tr
                                v-for="(pay, index) in payment_checks"
                                class="bg-gray-500 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                            >
                                <th
                                    class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                                >
                                    METODO DE PAGO
                                </th>
                                <th
                                    class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                                >
                                    MONTO
                                </th>
                                <th
                                    class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                                >
                                    REFERENCIA
                                </th>
                                <th
                                    class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                                >
                                    COMPROBANTE
                                </th>
                            </tr>
                        </thead>
                        <tbody class="flex-1 sm:flex-none md:flex-none">
                            <tr
                                v-for="(pay, index) in payment_checks"
                                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 md:text-xs lg:text-md"
                            >
                                <td
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    {{
                                        getNameMethod(
                                            pay.payment_method.method_type_id
                                        )
                                    }}
                                </td>
                                <td
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    {{ pay.parcial_amount }}
                                </td>
                                <td
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    {{ pay.reference }}
                                </td>

                                <td
                                    v-if="pay.url_capture"
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    <div
                                        class="flex justify-center items-center my-5"
                                    >
                                        <img
                                            @click="
                                                viewCapture(pay.url_capture)
                                            "
                                            class="h-auto"
                                            :src="'../' + pay.url_capture"
                                            alt="image Capture"
                                        />
                                    </div>
                                </td>
                                <td
                                    v-else
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    No Tiene Comprobante
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!---->
    </wjAppLayout>

    <div
        id="capture-modal"
        tabindex="-1"
        v-show="modalcapture"
        class="overflow-y-auto overflow-x-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
        <div class="mx-auto relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                >
                    <h3
                        class="text-xl font-semibold text-gray-900 dark:text-white"
                    >
                        Comprobante de pago
                    </h3>
                    <!-- <a href="'../' +{{urlCap }} " target="_blank"
                        >Descarga Ahora
                    </a>-->
                    <button
                        type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="closeViewCapture()"
                    >
                        <svg
                            class="w-3 h-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                            />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="flex justify-center items-center my-5">
                    <img
                        class="h-auto"
                        :src="'../' + urlCap"
                        alt="image Capture"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PackageShow",

    data() {
        return {
            modalcapture: false,
            urlCap: "",
        };
    },

    methods: {
        changeFormat(date) {
            let newdate = date.split("-");
            return newdate[2] + "/" + newdate[1] + "/" + newdate[0];
        },

        viewCapture(url_capture) {
            this.urlCap = url_capture;
            this.modalcapture = true;
        },
        closeViewCapture() {
            this.modalcapture = false;
        },
        getNameMethod(method) {
            let name = "";
            this.typemethods.forEach((item, index) => {
                if (item.id == method) {
                    name = item.name;
                }
            });
            return name;
        },

        changeStatus(payment) {
            if (payment.status == "CONFIRMADO") {
                alert("¡El pago ya esta confirmado!");
                return;
            }
            router.visit("processpay", {
                method: "post",
                data: {
                    payment: payment.id,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: (resp) => {
                    alert("¡El pago ha sido confirmado!");
                },
                onError: (errors) => {
                    console.log("erros");
                },
            });
        },
    },
};
</script>
<style>
.b_edit {
    background-color: aquamarine;
    color: antiquewhite;
}
</style>
