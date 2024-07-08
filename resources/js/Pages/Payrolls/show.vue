<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import PayrollsForm from "@/Components/Payrolls/Form.vue";
import html2pdf from "html2pdf.js";
import { router } from "@inertiajs/vue3";

defineProps({
    payroll: {
        type: Object,
        required: true,
    },
    payrollDetail: {
        type: Object,
        required: true,
    },
    payrollPay: {
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
    <wjAppLayout>
        <template #header> </template>
        <!-- Main Add Branch -->
        <div
            class="w-[80%] mx-auto rounded-lg border border-gray-200 p-5 m-5 grid grid-cols-1 gap-3"
        >
            <div
                class="flex justify-between mb-3 pb-2 border-b-gray-200 border-b-2"
            >
                <h1
                    class="flex font-semibold text-xl text-gray-700 leading-tigh"
                >
                    Pago de Empleado
                </h1>
                <Link
                    :href="route('payrolls.index')"
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
            <div class="grid grid-cols-3">
                <div class="flex pl-0 mt-3 space-x-1 sm:pl-2 sm:mt-0">
                    <button
                        @click="exportToPDF"
                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        <svg
                            class="h-6 w-6 text-gray-500"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path
                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                            />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <polyline points="10 9 9 9 8 9" />
                        </svg>
                    </button>
                    <button
                        @click="openDeleteModal()"
                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>

                    <a
                        href="#"
                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"
                            ></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!--
             ELEMENTOS PARA EXPORTAR-->
            <div class="" id="element-to-convert">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3">
                    <div
                        class="text-gray-800 p-4 md:p-5 space-y-4 border-b rounded-t"
                    >
                        <h3>Fecha:</h3>
                        <p
                            class="text-gray-500 leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ payroll.date }}
                        </p>
                    </div>
                    <div
                        class="text-gray-800 p-4 md:p-5 space-y-4 border-b rounded-t"
                    >
                        <h3>Empleado:</h3>
                        <p
                            class="leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ payroll.employee.fist_name }}
                            {{ payroll.employee.last_name }}
                        </p>
                    </div>
                    <div
                        class="text-gray-800 p-4 md:p-5 space-y-4 border-b rounded-t"
                    >
                        <h3>Concepto:</h3>
                        <p
                            class="text-gray-500 leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ payroll.concept }}
                        </p>
                    </div>
                </div>
                <div v-if="payrollDetail.length > 0">
                    <h2 class="text-gray-600 text-center font-bold">
                        Lista de consultas :
                    </h2>
                    <table
                        class="w-full text-xs flex flex-row flex-no-wrap bg-white rounded-lg overflow-hidden shadow-lg my-5 overflow-auto inline-table"
                    >
                        <thead class="text-white">
                            <tr
                                v-for="(detail, index) in payrollDetail"
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
                                    MONTO
                                </th>
                                <th
                                    class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                                >
                                    PAQUETE?
                                </th>
                            </tr>
                        </thead>
                        <tbody class="flex-1 sm:flex-none md:flex-none">
                            <tr
                                v-for="(detail, index) in payrollDetail"
                                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 md:text-xs lg:text-md"
                            >
                                <td
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    {{ changeFormat(detail.consultation.date) }}
                                </td>
                                <td
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    S/. {{ detail.consultation.amount }}
                                </td>
                                <td
                                    class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                >
                                    {{
                                        detail.consultation.haspackage == true
                                            ? "Si"
                                            : "No"
                                    }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="grid grid-cols-3">
                    <div
                        class="text-gray-800 text-center p-4 md:p-5 space-y-4 border-b rounded-t"
                    >
                        <h3>Metodo de pago:</h3>
                        <p
                            class="text-gray-500 text-center leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ getMethodpay(payrollPay.payment_method_id) }}
                        </p>
                    </div>

                    <div
                        class="text-gray-800 text-center p-4 md:p-5 space-y-4 border-b rounded-t"
                    >
                        <h3>Monto pagado:</h3>
                        <p
                            class="text-gray-500 text-center leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            S/. {{ payrollPay.amount }}
                        </p>
                    </div>
                    <div
                        class="text-gray-800 text-center p-4 md:p-5 space-y-4 border-b rounded-t"
                    >
                        <h3>Referencia:</h3>
                        <p
                            class="text-gray-500 text-center leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ payrollPay.reference }}
                        </p>
                    </div>
                </div>
                <h2 class="text-gray-600 text-center font-bold">
                    Comprobante de pago:
                </h2>
                <div class="flex justify-center items-center my-5">
                    <img
                        class="h-auto"
                        :src="'../' + payrollPay.url_capture"
                        alt="image Capture"
                    />
                </div>
            </div>
        </div>

        <!---->

        <!-- Main modal -->
        <div
            id="deleteModal"
            tabindex="-1"
            v-show="ConfirmDelete"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full"
        >
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div
                    class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5"
                >
                    <button
                        type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="deleteModal"
                        @click="closeDeleteModal()"
                    >
                        <svg
                            aria-hidden="true"
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg
                        class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">
                        ¿Estas seguro de eliminar este pago?
                    </p>
                    <div class="flex justify-center items-center space-x-4">
                        <button
                            @click="closeDeleteModal()"
                            data-modal-toggle="deleteModal"
                            type="button"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        >
                            No, cancelar
                        </button>
                        <button
                            @click="deletePAyroll()"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900"
                        >
                            Si, Eliminar Pago.
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </wjAppLayout>
</template>

<script>
export default {
    name: "PayrollsShow",

    data() {
        return {
            ConfirmDelete: false,
        };
    },

    methods: {
        changeFormat(date) {
            let newdate = date.split("-");
            return newdate[2] + "/" + newdate[1] + "/" + newdate[0];
        },

        exportToPDF() {
            let date = this.changeFormat(this.payroll.date);
            html2pdf(document.getElementById("element-to-convert"), {
                margin: 10,
                filename: "Recibo_" + date + ".pdf",
                image: { type: "jpeg", quality: 0.98 },
                html2canvas: {
                    scale: 2,
                    logging: true,
                    dpi: 192,
                    letterRendering: true,
                },
                jsPDF: { unit: "mm", format: "a3", orientation: "portrait" },
            });
        },
        getMethodpay(method) {
            let name = "";
            this.typemethods.forEach((item, index) => {
                if (item.id == method) {
                    name = item.name;
                }
            });
            return name;
        },
        openDeleteModal() {
            this.ConfirmDelete = true;
        },
        closeDeleteModal() {
            this.ConfirmDelete = false;
        },
        deletePAyroll() {
            router.visit("payrolls.destroy", {
                method: "DELETE",
                data: {
                    employee: this.payroll.employee_id,
                    payroll: this.payroll.id,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: (resp) => {},
                onError: (errors) => {
                    console.log("erros");
                },
            });
            return;
        },
    },
};
</script>
<style>
@media (min-width: 640px) {
    table {
        display: inline-table !important;
    }

    thead tr:not(:first-child) {
        display: none;
    }
}

td:not(:last-child) {
    border-bottom: 0;
}

th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}
</style>
