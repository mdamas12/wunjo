<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    payment: {
        type: Object,
        required: true,
    },
    paymentdetails: {
        type: Object,
        required: true,
    },
    payment_checks: {
        type: Object,
        required: true,
    },
    typemethods: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Applayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tigh mb-3">
                Detalle de pago
            </h1>
            <Link
                :href="route('payments.index')"
                class="inline-flex items-center justify-center mx-2 text-base font-medium text-gray-600 rounded-lg bg-slate-50 hover:text-gray-900 hover:bg-slate-200 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white border-double border-4 border-cyan-600"
            >
                <svg
                    class="h-8 w-8 text-cyan-600"
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
                    <line x1="4" y1="12" x2="14" y2="12" />
                    <line x1="4" y1="12" x2="8" y2="16" />
                    <line x1="4" y1="12" x2="8" y2="8" />
                    <line x1="20" y1="4" x2="20" y2="20" />
                </svg>
                <span class="w-full">Volver</span>
            </Link>
        </template>
        <!-- Main Add Branch -->
        <div class="w-[80%] mx-auto rounded-lg border border-gray-200 p-5 m-5">
            <div class="grid grid-cols-3">
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
                    <ul class="grid grid-cols-4">
                        <li class="p-3 text-center">Fecha</li>
                        <li class="p-3 text-center">Tipo</li>
                        <li class="p-3 text-center">Monto pagado</li>
                        <li class="p-3 text-center">Status de pago</li>
                    </ul>

                    <ul
                        class="grid grid-cols-4"
                        v-for="(detail, index) in paymentdetails"
                    >
                        <li class="text-center border-grey-light border p-3">
                            {{
                                detail.consultation_id
                                    ? changeFormat(detail.consultation.date)
                                    : changeFormat(detail.package.date)
                            }}
                        </li>
                        <li class="text-center border-grey-light border p-3">
                            {{
                                detail.consultation_id ? "CONSULTA" : "PAQUETE"
                            }}
                        </li>
                        <li class="text-center border-grey-light border p-3">
                            {{ detail.amount_payable }}
                        </li>

                        <li class="text-center border-grey-light border p-3">
                            {{
                                detail.consultation_id
                                    ? detail.consultation.status_payment
                                    : detail.package.status_payment
                            }}
                        </li>
                    </ul>
                </div>
            </div>

            <div v-if="paymentdetails.length > 0">
                <h2 class="text-gray-600 text-center font-bold">
                    Pagos Parciales :
                </h2>
                <div
                    class="sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                >
                    <ul class="grid grid-cols-4">
                        <li class="p-3 text-center">Metodo de pago</li>
                        <li class="p-3 text-center">Monto</li>
                        <li class="p-3 text-center">Referencia</li>
                        <li class="p-3 text-center">Comprobante</li>
                    </ul>

                    <ul
                        class="grid grid-cols-4"
                        v-for="(pay, index) in payment_checks"
                    >
                        <li class="text-center border-grey-light border p-3">
                            {{ pay.payment_method_id }}
                        </li>
                        <li class="text-center border-grey-light border p-3">
                            {{ pay.parcial_amount }}
                        </li>
                        <li class="text-center border-grey-light border p-3">
                            {{ pay.reference }}
                        </li>

                        <li
                            v-if="pay.url_capture"
                            class="text-center border-grey-light border p-3"
                        >
                            <div class="flex justify-center items-center my-5">
                                <img
                                    class="h-auto"
                                    :src="'../' + pay.url_capture"
                                    alt="image Capture"
                                />
                            </div>
                        </li>
                        <li
                            v-else
                            class="text-center border-grey-light border p-3"
                        >
                            No Tiene Comprobante
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!---->
    </Applayout>
</template>

<script>
export default {
    name: "PackageShow",

    data() {
        return {};
    },

    methods: {
        changeFormat(date) {
            let newdate = date.split("-");
            return newdate[2] + "/" + newdate[1] + "/" + newdate[0];
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
