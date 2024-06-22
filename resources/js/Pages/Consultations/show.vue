<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import ConsultationForm from "@/Components/Consultations/Form.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    consultation: {
        type: Object,
        required: false,
    },
});

const formConsultation = useForm({
    date: props.consultation.date,
    hour: props.consultation.hour,
    branch_id: props.consultation.branch_id,
    patient_id: props.consultation.patient_id,
    employee_id: props.consultation.employee_id,
    status_payment: props.consultation.status_payment,
    status: props.consultation.status,
});
</script>

<template>
    <Applayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tigh mb-3">
                Detalle de la consulta
            </h1>
            <Link
                :href="route('consultations.index')"
                class="inline-flex items-center justify-center mx-2 text-base font-medium text-gray-600 rounded-lg bg-slate-50 hover:text-gray-900 hover:bg-slate-200 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white border-2 border-cyan-600"
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
            <div class="grid grid-cols-3 border-b">
                <div class="flex pl-0 mt-3 space-x-1 sm:pl-2 sm:mt-0">
                    <Link
                        v-if="
                            $page.props.user['roles'] == 'supra' ||
                            $page.props.user['roles'] == 'administrator'
                        "
                        :href="route('consultations.edit', consultation.id)"
                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        <svg
                            class="h-8 w-8 text-gray-600"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path
                                d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"
                            />
                            <path
                                d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"
                            />
                            <line x1="16" y1="5" x2="19" y2="8" />
                        </svg>

                        <span class="w-full items-center my-1">Editar</span>
                    </Link>
                    <button
                        @click="addDetail(consultation)"
                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
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
                        <span class="w-full items-center my-1">Detalles</span>
                    </button>
                    <button
                        v-if="
                            $page.props.user['roles'] == 'supra' ||
                            $page.props.user['roles'] == 'employee'
                        "
                        @click="addevaluation(consultation)"
                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        <svg
                            class="h-8 w-8 text-gray-600"
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
                            <circle cx="9" cy="7" r="4" />
                            <path
                                d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"
                            />
                            <line x1="19" y1="7" x2="19" y2="10" />
                            <line x1="19" y1="14" x2="19" y2="14.01" />
                        </svg>
                        <span class="w-full items-center my-1">Evaluación</span>
                    </button>
                    <button
                        v-if="
                            $page.props.user['roles'] == 'supra' ||
                            $page.props.user['roles'] == 'administrator'
                        "
                        @click="deletemsg()"
                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
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
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                            />
                        </svg>
                        <span class="w-full items-center my-1">Eliminar</span>
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
            <div class="">
                <div class="grid grid-cols-3 my-5">
                    <!--  content -->
                    <div class="p-4 md:p-5 border-b rounded-t">
                        <h3>Paciente</h3>

                        <p class="text-base text-gray-500 dark:text-gray-400">
                            {{ consultation.patient.fist_name }}
                            {{ consultation.patient.last_name }}
                        </p>
                    </div>
                    <div class="p-4 md:p-5 border-b rounded-t">
                        <h3>Fecha</h3>
                        <p class="text-base text-gray-500 dark:text-gray-400">
                            {{ consultation.date }}
                        </p>
                    </div>
                    <div class="p-4 md:p-5 border-b rounded-t">
                        <h3>Hora</h3>
                        <p class="text-base text-gray-500 dark:text-gray-400">
                            {{ consultation.hour }}
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-3 my-5">
                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Asiganado A:</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ consultation.employee.fist_name }}
                            {{ consultation.employee.last_name }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Status de consulta</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ consultation.status }}
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-2 my-5">
                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Monto Total</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ consultation.amount }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Status de pago</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{
                                consultation.status_payment == "PAID"
                                    ? "PAGADA"
                                    : consultation.status_payment
                            }}
                        </p>
                    </div>
                </div>
            </div>

            <table
                class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
            >
                <thead class="text-white">
                    <tr
                        class="bg-cyan-600 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                    >
                        <th class="p-3 text-center">Servicio / Paquete</th>
                        <th class="p-3 text-center">Monto</th>
                        <th class="p-3 text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody
                    v-for="detail in list_details"
                    class="flex-1 sm:flex-none"
                >
                    <tr
                        class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
                    >
                        <td
                            class="text-center border-grey-light border hover:bg-gray-100 p-3"
                        >
                            {{
                                detail.service
                                    ? detail.service.name
                                    : detail.package.service_name
                            }}
                        </td>
                        <td
                            class="text-center border-grey-light border hover:bg-gray-100 p-3"
                        >
                            {{
                                detail.service
                                    ? detail.service.price
                                    : detail.package.service.price
                            }}
                        </td>

                        <td
                            class="text-center border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer"
                        >
                            <button
                                @click="deleteDetail(detail)"
                                class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                <svg
                                    class="h-4 w-4 text-white-700"
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
                                    <line x1="4" y1="7" x2="20" y2="7" />
                                    <line x1="10" y1="11" x2="10" y2="17" />
                                    <line x1="14" y1="11" x2="14" y2="17" />
                                    <path
                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"
                                    />
                                    <path
                                        d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"
                                    />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!---->
        <!--Ajustes y pruebas -->

        <!-- Detalle del paquete -->
        <div
            id="defaultd-modal"
            tabindex="-1"
            aria-hidden="true"
            v-show="addDetailShow"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
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
                            Agregar Servicio / Paquete
                        </h3>
                        <button
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            @click="closeDetail()"
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
                    <!-- Modal body -->

                    <div class="col-span-6">
                        <div class="col-span-6 m-1">
                            <select
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="servicio_id"
                                v-model="detail_type"
                                @change="loadselect(consultation, detail_type)"
                            >
                                <option :value="'SERVICIO'">SERVICIO</option>
                                <option :value="'PAQUETE'">PAQUETE</option>
                            </select>
                        </div>
                        <div
                            class="col-span-6 m-1"
                            v-if="detail_type == 'PAQUETE'"
                        >
                            <select
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="servicio_id"
                                v-model="detail"
                            >
                                <option
                                    v-for="packagedet in packages"
                                    :value="packagedet.id"
                                >
                                    {{ packagedet.service_name }}
                                </option>
                            </select>
                        </div>

                        <div class="col-span-6 m-1" v-else>
                            <select
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="servicio_id"
                                v-model="detail"
                            >
                                <option
                                    v-for="service in services"
                                    :value="service.id"
                                >
                                    {{ service.name }}
                                </option>
                            </select>
                        </div>

                        <button
                            id="add"
                            @click="
                                saveDetail(consultation.id, detail_type, detail)
                            "
                            class="m-1 inline-flex items-center justify-center mx-2 text-base font-medium text-gray-600 rounded-lg bg-slate-50 hover:text-gray-900 hover:bg-slate-200 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white border-double border-4 border-cyan-600"
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
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="3"
                                />
                                <line x1="3" y1="10" x2="21" y2="10" />
                                <line x1="7" y1="15" x2="7.01" y2="15" />
                                <line x1="11" y1="15" x2="13" y2="15" />
                            </svg>
                            <span class="w-full">Agregar</span>
                        </button>
                    </div>
                    <!-- Modal footer -->
                </div>
            </div>
        </div>

        <!---->
    </Applayout>
</template>

<script>
export default {
    name: "consultationShow",

    data() {
        return {
            addDetailShow: false,
            service_id: "",
            services: [],
            packages: [],
            list_details: [],
            detail: "",
            detail_type: "",
        };
    },

    mounted() {
        this.loadDetails(this.consultation);
    },

    methods: {
        loadDetails(consultation) {
            router.visit("listdetails", {
                method: "post",
                data: {
                    consultation_id: consultation.id,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: (resp) => {
                    //console.log(resp.props.jetstream.flash.services);
                    let array_details = resp.props.jetstream.flash.details;
                    let services = resp.props.jetstream.flash.services;
                    for (let i = 0; i < array_details.length; i++) {
                        for (let j = 0; j < services.length; j++) {
                            if (array_details[i].package) {
                                if (
                                    array_details[i].package.service_id ==
                                    services[j].id
                                ) {
                                    array_details[i].package.service =
                                        services[j];
                                }
                            }
                        }
                    }
                    this.list_details = array_details;
                    // console.log(array_details);
                },
                onError: (errors) => {
                    console.log("erros");
                },
            });
        },

        loadselect(consultation, type) {
            if (type == "SERVICIO") {
                router.visit("loadservices", {
                    method: "post",
                    data: {
                        consultation_id: consultation.id,
                    },
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (resp) => {
                        this.services = resp.props.jetstream.flash.services;
                        //console.log(this.services);
                    },
                    onError: (errors) => {
                        console.log("erros");
                    },
                });
            } else {
                router.visit("loadpackages", {
                    method: "post",
                    data: {
                        patient_id: consultation.patient_id,
                        consultation_id: consultation.id,
                    },
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (resp) => {
                        this.packages = resp.props.jetstream.flash.packages;
                        //console.log(this.packages);
                    },
                    onError: (errors) => {
                        console.log("erros");
                    },
                });
            }
        },
        addDetail(consultation) {
            this.addDetailShow = true;
        },

        closeDetail() {
            this.addDetailShow = false;
        },

        deletemsg() {
            alert(
                "Por seguridad, puedes eliminar la consulta desde la lista principal"
            );
        },

        saveDetail(consultation, detail_type, detail_id) {
            if (detail_type == "SERVICIO") {
                router.visit("savedetail", {
                    method: "post",
                    data: {
                        consultation_id: consultation,
                        service_id: detail_id,
                    },
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (resp) => {
                        this.addDetailShow = false;
                        this.consultation.amount =
                            resp.props.jetstream.flash.amount;
                        this.detail_type = "";
                        this.detail = "";
                        this.loadDetails(this.consultation);
                    },
                    onError: (errors) => {
                        console.log("erros");
                    },
                });
            } else {
                router.visit("savedetail", {
                    method: "post",
                    data: {
                        consultation_id: consultation,
                        package_id: detail_id,
                    },
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (resp) => {
                        this.addDetailShow = false;
                        this.consultation.amount =
                            resp.props.jetstream.flash.amount;
                        this.detail_type = "";
                        this.detail = "";
                        this.loadDetails(this.consultation);
                    },
                    onError: (errors) => {
                        console.log("erros");
                    },
                });
            }
        },
        deleteDetail(detail) {
            router.visit("deletedetail", {
                method: "post",
                data: {
                    detail_id: detail.id,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: (resp) => {
                    this.loadDetails(this.consultation);
                    this.consultation.amount =
                        resp.props.jetstream.flash.amount;
                    //this.list_details = resp.props.jetstream.flash.details;
                },
                onError: (errors) => {
                    console.log("erros");
                },
            });
        },

        addevaluation(consultation) {
            console.log("evaluation");
        },

        addDiagnostico() {
            console.log("diagnostico");
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
