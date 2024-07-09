<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { router } from "@inertiajs/vue3";

import PackageForm from "@/Components/Packages/Form.vue";

defineProps({
    success_message: {
        type: String,
        required: false,
    },
    payments: {
        type: Object,
        required: true,
    },
    patients: {
        type: String,
        required: false,
    },
    payment_method: {
        type: String,
        required: false,
    },
    consultations: {
        type: String,
        required: false,
    },
    packages: {
        type: String,
        required: false,
    },
});

const deletepayment = (payment) => {
    const formchange = useForm({
        /* areglar*/
        id: package_patient.id,
        date: package_patient.date,
        patient_id: package_patient.patient_id,
        service_id: package_patient.service_id,
        made_quantity: package_patient.made_quantity,
        status: "DELETED",
    });

    if (confirm("estas seguro que deseas eliminar este Pago?")) {
        //console.log(consultation);
        formchange.post(route("changestatuspayment"), {
            onError: () => {
                console.log(formchange.errors);
                return "existen errores en los datos";
            },
            onSuccess: () => {
                alert("El pago ha sido elimnado");
            },
        });
        //Inertia.post(route("changestatus", consultation));
    }
};
</script>

<template>
    <wjAppLayout>
        <template #header> </template>
        <div class="w-[90%] mx-auto rounded-lg border border-gray-200 p-5 m-5">
            <div class="flex justify-between mb-5">
                <h1
                    class="flex font-semibold text-xl text-gray-700 leading-tigh"
                >
                    Pagos Recibidos
                </h1>
            </div>
            <!-- PANEL INDEX -->
            <div
                class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700"
            >
                <div class="w-full mb-1">
                    <div class="sm:flex">
                        <div
                            class="items-center mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700"
                        >
                            <div>
                                <label class="sr-only">Search</label>
                                <div class="relative mt-1 lg:w-64 xl:w-96">
                                    <input
                                        v-on:keyup.enter="goTosearch()"
                                        type="text"
                                        name="user"
                                        id="patient-search"
                                        v-model="patient"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Busqueda por paciente"
                                    />
                                </div>
                            </div>
                            <div
                                class="flex pl-0 mt-3 space-x-1 sm:pl-2 sm:mt-0"
                            >
                                <button
                                    @click="goTosearch()"
                                    class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                >
                                    <svg
                                        class="h-8 w-8 text-gray-500"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <circle cx="11" cy="11" r="8" />
                                        <line
                                            x1="21"
                                            y1="21"
                                            x2="16.65"
                                            y2="16.65"
                                        />
                                        <line x1="11" y1="8" x2="11" y2="14" />
                                        <line x1="8" y1="11" x2="14" y2="11" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div
                            v-if="
                                $page.props.user['roles'] == 'supra' ||
                                $page.props.user['roles'] == 'administrator'
                            "
                            class="flex items-center ml-auto space-x-2 sm:space-x-3"
                        >
                            <Link
                                :href="route('payments.create')"
                                class="w-full inline-flex mx-3 items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                <svg
                                    class="w-5 h-5 mr-2 -ml-1"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                Agregar pago
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <!--END PANEL INDEX-->
            <div class="overflow-auto rounded-t-lg">
                <table
                    class="md:table-fixed w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5 overflow-auto"
                >
                    <thead class="text-white">
                        <tr
                            v-for="payment in payments.data"
                            class="bg-cyan-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                        >
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                FECHA
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                PACIENTE
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                MONTO
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                STATUS
                            </th>
                            <th
                                class="text-xs text-center wrap p-1 h-14 text-left md:text-xs md:w-10 lg:text-md"
                            >
                                A1
                            </th>
                            <th
                                class="text-xs text-center wrap p-1 h-14 text-left md:text-xs md:w-10 lg:text-md"
                            >
                                A2
                            </th>
                        </tr>
                    </thead>
                    <tbody class="flex-1 sm:flex-none md:flex-none">
                        <tr
                            v-for="payment in payments.data"
                            class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 md:text-xs lg:text-md"
                        >
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ changeFormat(payment.date) }}
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ payment.patient.fist_name }}
                                {{ payment.patient.last_name }}
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ payment.amount }}
                            </td>

                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ payment.status }}
                            </td>

                            <td
                                class="text-xs text-center content-center wrap border-grey-light border hover:bg-gray-100 p-1 h-14 md:text-xs md:w-9 lg:text-md"
                            >
                                <Link
                                    :href="route('payments.show', payment.id)"
                                    class="inline-flex text-md p-1 font-medium text-center text-white bg-sky-500 rounded-lg hover:bg-sky-700 focus:ring-4 focus:ring-sky-300 dark:focus:ring-sky-900"
                                >
                                    <svg
                                        class="h-4 w-4 text-white-700"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <circle cx="11" cy="11" r="8" />
                                        <line
                                            x1="21"
                                            y1="21"
                                            x2="16.65"
                                            y2="16.65"
                                        />
                                    </svg>
                                </Link>
                            </td>
                            <!--
                                <Link
                                    v-if="
                                        $page.props.user['roles'] == 'supra' ||
                                        $page.props.user['roles'] ==
                                            'administrator'
                                    "
                                    :href="route('payments.edit', payment.id)"
                                    class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >
                                    <svg
                                        class="h-4 w-4 text-white-700"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path d="M12 20h9" />
                                        <path
                                            d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"
                                        />
                                    </svg>
                                    <span class="sr-only">Edit</span>
                                </Link>
-->
                            <td
                                class="text-xs text-center content-center wrap border-grey-light border hover:bg-gray-100 p-1 h-14 md:text-xs md:w-9 lg:text-md"
                            >
                                <button
                                    v-if="
                                        $page.props.user['roles'] == 'supra' ||
                                        $page.props.user['roles'] ==
                                            'administrator'
                                    "
                                    @click="openDeleteModal(payment)"
                                    class="inline-flex items-center p-1 font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
                                >
                                    <svg
                                        class="w-4 h-4"
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
                                    <span class="sr-only">Delete</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- PAGINAIION-->
                <div
                    class="bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between"
                >
                    <div class="flex items-center mb-4 sm:mb-0">
                        <Link
                            v-if="payments.current_page > 1"
                            :href="payments.prev_page_url"
                            class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700"
                        >
                            <svg
                                class="w-7 h-7"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </Link>
                        <Link
                            v-if="payments.current_page < payments.last_page"
                            :href="payments.next_page_url"
                            class="inline-flex justify-center p-1 mr-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700"
                        >
                            <svg
                                class="w-7 h-7"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </Link>
                        <span class="text-sm font-normal text-gray-500"
                            >Mostrando
                            <span class="font-semibold text-gray-900"
                                >{{ payments.from }}-{{ payments.to }}</span
                            >
                            De
                            <span class="font-semibold text-gray-900">{{
                                payments.total
                            }}</span></span
                        >
                    </div>
                </div>
                <!-- END PAGINAIION-->
            </div>
        </div>

        <!--Ajustes y pruebas -->

        <!-- Detalle del paquete -->
        <div
            id="view-payment-modal"
            tabindex="-1"
            v-show="modalpayment"
            class="overflow-y-auto overflow-x-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
        >
            <div class="mx-auto relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div
                    class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                >
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                    >
                        <h3
                            class="text-xl font-semibold text-gray-900 dark:text-white"
                        >
                            Informacion del pago
                        </h3>
                        <button
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            @click="closeViewModal()"
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

                    <div
                        v-if="paymentview.lenth > 0"
                        class="grid grid grid-cols-4 gap-2 text-base leading-relaxed text-gray-500 dark:text-gray-400 p-5"
                    >
                        <div>
                            <p><b>Fecha</b></p>
                            {{ paymentview.date }}
                        </div>
                        <div>
                            <p><b>Paciente</b></p>
                            {{ paymentview.patient.fist_name }}
                            {{ paymentview.patient.last_name }}
                        </div>
                        <div>
                            <p><b>Monto</b></p>
                            {{ paymentview.amount }}
                        </div>
                        <div>
                            <p><b>Status</b></p>
                            {{ paymentview.status }}
                        </div>
                    </div>
                    <div
                        v-if="listServicesPaid"
                        class="grid grid grid-cols-1 gap-2 text-base leading-relaxed text-gray-500 dark:text-gray-400 p-5"
                    >
                        <h1>Lista de Servicios:</h1>
                        <table
                            class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                        >
                            <thead>
                                <tr
                                    class="bg-cyan-600 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                                >
                                    <th class="p-3 text-center text-white">
                                        Fecha
                                    </th>
                                    <th class="p-3 text-center text-white">
                                        Tipo
                                    </th>
                                    <th class="p-3 text-center text-white">
                                        Asignado A
                                    </th>
                                    <th class="p-3 text-center text-white">
                                        Monto
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                v-for="servicePaid in listServicesPaid"
                                class="flex-1 sm:flex-none"
                            >
                                <tr
                                    class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
                                >
                                    <td
                                        class="text-center border-grey-light border p-3"
                                    >
                                        {{
                                            servicePaid.consultation_id
                                                ? servicePaid.consultation.date
                                                : servicePaid.package.date
                                        }}
                                    </td>
                                    <td
                                        class="text-center border-grey-light border p-3"
                                    >
                                        {{
                                            servicePaid.consultation_id
                                                ? "Consulta"
                                                : servicePaid.package
                                                      .service_name
                                        }}
                                    </td>
                                    <td
                                        class="text-center border-grey-light border p-3"
                                    >
                                        {{
                                            servicePaid.consultation_id
                                                ? servicePaid.consultation
                                                      .employee_id
                                                : "--"
                                        }}
                                    </td>

                                    <td
                                        class="text-center border-grey-light border p-3"
                                    >
                                        {{
                                            servicePaid.consultation_id
                                                ? servicePaid.consultation
                                                      .amount
                                                : servicePaid.package
                                                      .amount_paid
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!---->
                    <div
                        v-if="paymentsList"
                        class="grid grid grid-cols-1 gap-2 text-base leading-relaxed text-gray-500 dark:text-gray-400 p-5"
                    >
                        <h1>Resumen de pago:</h1>
                        <table
                            class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                        >
                            <thead>
                                <tr
                                    class="bg-cyan-600 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                                >
                                    <th class="p-3 text-center text-white">
                                        Metodo de pago
                                    </th>
                                    <th class="p-3 text-center text-white">
                                        Monto
                                    </th>
                                    <th class="p-3 text-center text-white">
                                        Referencia
                                    </th>
                                    <th class="p-3 text-center text-white">
                                        Comprobante
                                    </th>
                                    <th class="p-3 text-center text-white">
                                        Comprobante
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                v-for="paymentsCheck in paymentsList"
                                class="flex-1 sm:flex-none"
                            >
                                <tr
                                    class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
                                >
                                    <td
                                        class="text-center border-grey-light border p-3"
                                    >
                                        {{ paymentsCheck.payment_method.name }}
                                        |
                                        {{ paymentsCheck.payment_method.bank }}
                                    </td>
                                    <td
                                        class="text-center border-grey-light border p-3"
                                    >
                                        {{ paymentsCheck.parcial_amount }}
                                    </td>
                                    <td
                                        class="text-center border-grey-light border p-3"
                                    >
                                        {{ paymentsCheck.reference }}
                                    </td>

                                    <td
                                        class="text-center border-grey-light border p-3"
                                    >
                                        {{
                                            paymentsCheck.url_capture
                                                ? paymentsCheck.url_capture
                                                : "S/C"
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main modal -->
        <div
            id="deleteModal"
            tabindex="-1"
            v-show="deleteModal"
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
                            @click="deletePayment(dataPayment)"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900"
                        >
                            Si, Eliminar Pago.
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!---->
    </wjAppLayout>
</template>

<script>
export default {
    name: "PaymentsIndex",

    data() {
        return {
            modalpayment: false,
            patient: "",
            deleteModal: false,
            dataPayment: [],
            paymentview: [],
            position_name: "",
            listServicesPaid: [],
            paymentsList: [],
        };
    },

    components: {
        Link,
    },

    async mounted() {},

    methods: {
        open_Detail(package_patient) {
            this.datax = package_patient;
            //this.position_name = this.data.position.name;
            this.modalDetail = true;
            return;
        },

        closeViewModal() {
            this.modalpayment = false;
            return;
        },
        changeFormat(date) {
            let newdate = date.split("-");
            //console.log(date);
            return newdate[2] + "/" + newdate[1] + "/" + newdate[0];
        },

        viewPayment(payment) {
            this.paymentview = payment;
            router.visit("payments/servicespayment", {
                method: "post",
                data: {
                    payment_id: payment,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: (resp) => {
                    this.listServicesPaid =
                        resp.props.jetstream.flash.serviceslistpayment;
                    //console.log(this.listServicesPaid);
                    this.paymentsList =
                        resp.props.jetstream.flash.paymentDetailList;
                },
                onError: (errors) => {
                    console.log("erros");
                },
            });
            //console.log(this.listServicesPaid.lenth);
            this.modalpayment = true;
            return;
        },
        openDeleteModal(payment) {
            this.dataPayment = payment;
            this.deleteModal = true;
        },
        closeDeleteModal() {
            this.deleteModal = false;
        },
        deletePayment(payment) {
            router.visit("payments/deletepayment", {
                method: "post",
                data: {
                    payment_id: payment.id,
                    payment_amount: payment.amount,
                    services: this.listServicesPaid,
                    payments: this.paymentsList,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: (resp) => {
                    this.deleteModal = false;
                    alert(resp.props.jetstream.flash.message);
                },
                onError: (errors) => {
                    console.log("erros");
                },
            });
        },

        goTosearch() {
            alert("Accion no valida!");
        },
    },
};
</script>
