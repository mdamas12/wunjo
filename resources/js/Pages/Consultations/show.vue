<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import ConsultationForm from "@/Components/Consultations/Form.vue";
import { Inertia } from "@inertiajs/inertia";
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
                    Detalle de Consulta
                </h1>
                <Link
                    :href="route('consultations.index')"
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
                        @click="goToedit(consultation.id)"
                        class="p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
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
                        Editar
                    </button>
                </div>
                <div>
                    <button
                        @click="addDetail(consultation)"
                        class="p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        <svg
                            class="h-8 w-8 text-gray-700"
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
                            <rect x="4" y="5" width="16" height="16" rx="2" />
                            <line x1="16" y1="3" x2="16" y2="7" />
                            <line x1="8" y1="3" x2="8" y2="7" />
                            <line x1="4" y1="11" x2="20" y2="11" />
                            <line x1="10" y1="16" x2="14" y2="16" />
                            <line x1="12" y1="14" x2="12" y2="18" />
                        </svg>
                        Tratamiento
                    </button>
                </div>
                <div>
                    <button
                        v-if="
                            $page.props.user['roles'] == 'supra' ||
                            $page.props.user['roles'] == 'employee'
                        "
                        @click="addevaluation()"
                        class="justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
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
                        Evaluación
                    </button>
                </div>
                <div>
                    <button
                        v-if="
                            $page.props.user['roles'] == 'supra' ||
                            $page.props.user['roles'] == 'administrator'
                        "
                        @click="changeStatus(consultation)"
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
                        Procesar
                    </button>
                </div>
                <div>
                    <a
                        href="#"
                        class="justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
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
                <div
                    class="grid lg:grid-cols-4 lg:grid-cols-2 sm:grid-cols-2 text-sm my-5"
                >
                    <!--  content -->
                    <div class="p-2 md:p-2 border-b rounded-t">
                        <h3>Paciente</h3>

                        <p class="text-base text-gray-500 dark:text-gray-400">
                            {{ consultation.patient.fist_name }}
                            {{ consultation.patient.last_name }}
                        </p>
                    </div>
                    <div class="p-2 md:p-2 border-b rounded-t">
                        <h3>Fecha</h3>
                        <p class="text-base text-gray-500 dark:text-gray-400">
                            {{ changeFormat(consultation.date) }}
                        </p>
                    </div>
                    <div class="p-2 md:p-2 border-b rounded-t">
                        <h3>Hora</h3>
                        <p class="text-base text-gray-500 dark:text-gray-400">
                            {{ consultation.hour }}
                        </p>
                    </div>
                    <div class="p-2 md:p-2 border-b rounded-t">
                        <h3>Sede</h3>

                        <p class="text-base text-gray-500 dark:text-gray-400">
                            {{ consultation.branch.name }}
                        </p>
                    </div>
                </div>

                <div
                    class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-1 text-sm my-5"
                >
                    <div class="p-2 border-b rounded-t">
                        <h3>Asiganado A:</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ consultation.employee.fist_name }}
                            {{ consultation.employee.last_name }}
                        </p>
                    </div>

                    <div class="p-2 border-b rounded-t">
                        <h3>Status de consulta</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ consultation.status }}
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-2 my-5 sm:text-sm">
                    <div class="p-2 border-b rounded-t">
                        <h3>Monto Total</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            S/. {{ consultation.amount }}
                        </p>
                    </div>

                    <div class="p-2 border-b rounded-t">
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
            <div class="overflow-auto rounded-lg shadow p-4">
                <table class="w-full protable">
                    <thead>
                        <tr>
                            <th>Servicio / Paquete</th>
                            <th>Monto</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody v-for="detail in list_details">
                        <tr>
                            <td>
                                {{
                                    detail.service
                                        ? detail.service.name
                                        : detail.package.service_name
                                }}
                            </td>
                            <td>
                                {{
                                    detail.service
                                        ? detail.service.price
                                        : detail.package.service.price
                                }}
                            </td>

                            <td>
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
            <div
                class="grid grid-cols-1 my-5 text-sm md:grid-cols-2 lg:grid-cols-2"
            >
                <div class="p-2 border border-grey-200 mx-2 rounded-t">
                    <h3>Evaluación</h3>
                    <p
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        {{ consultation.evaluation }}
                    </p>
                </div>

                <div class="p-2 border border-grey-200 mx-2 rounded-t">
                    <h3>Diagnóstico</h3>
                    <p
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        {{ consultation.diagnostic }}
                    </p>
                </div>
            </div>
        </div>

        <!-- TRATAMIENTOS -->
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

                    <div class="col-span-6 p-3">
                        <div class="col-span-6 my-2">
                            <h3>Selecciona el tipo</h3>
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
                            class="col-span-6 my-3"
                            v-if="detail_type == 'PAQUETE'"
                        >
                            <h3>Selecciona el paquete</h3>
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

                        <div class="col-span-6 my-3" v-else>
                            <h3>Selecciona el Servicio</h3>
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

        <!-- EVALUACION / DIAGNOSTICO -->
        <div
            id="diagnostic-modal"
            tabindex="-1"
            aria-hidden="true"
            v-show="evaluation_modal"
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
                            Agregar Evaluación / Diagnóstico
                        </h3>
                        <button
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            @click="closeEvaluation_modal()"
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

                    <div class="col-span-6 p-5">
                        <div class="col-span-6 my-3">
                            <InputLabel for="evaluation">Evaluación</InputLabel>
                            <textarea
                                id="evaluation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                v-model="consultation.evaluation"
                                rows="4"
                                placeholder="Evaluación del paciente"
                            ></textarea>
                        </div>
                        <div class="col-span-6">
                            <InputLabel for="diagnosticlabel"
                                >Diagnóstico</InputLabel
                            >
                            <textarea
                                id="diagnostic"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                v-model="consultation.diagnostic"
                                rows="4"
                                placeholder="Diagnóstico del paciente"
                            ></textarea>
                        </div>

                        <button
                            id="add_evadiag"
                            @click="
                                add_evaluationDiagnostic(
                                    consultation.id,
                                    consultation.evaluation,
                                    consultation.diagnostic
                                )
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
    </wjAppLayout>
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
            evaluation_modal: false,
        };
    },

    mounted() {
        this.loadDetails(this.consultation);
    },

    methods: {
        goToedit(consultation) {
            Inertia.get(route("consultations.edit", consultation));
            //router.visit("edit", consultation);
        },
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

        changeStatus(consultation) {
            let status_payment = "PENDIENTE";

            if (this.list_details[0].package) {
                if (this.list_details[0].package.status_payment == "PAID") {
                    status_payment = "PAID";
                }
                if (this.list_details[0].package.status_payment == "PARTIAL") {
                    status_payment = "PARTIAL";
                } else {
                    status_payment = "PENDIENTE";
                }
            }
            else{
                status_payment = consultation.status_payment;
            }

            if (consultation.status == "REALIZADA") {
                alert("¡La Cunsulta ya esta procesada!");
                return;
            }
            router.visit("process", {
                method: "post",
                data: {
                    consultation: consultation.id,
                    status_payment: status_payment,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: (resp) => {
                    this.evaluation_modal = false;
                    alert("¡La Consulta ha sido procesada!");
                },
                onError: (errors) => {
                    console.log("erros");
                },
            });
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

        add_evaluationDiagnostic(consultation, evaluation, diagnostic) {
            router.visit("addevaluation", {
                method: "post",
                data: {
                    consultation: consultation,
                    evaluation: evaluation,
                    diagnostic: diagnostic,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: (resp) => {
                    this.evaluation_modal = false;
                    alert("¡Evaluacion / Diagnostico agregado con exito!");
                },
                onError: (errors) => {
                    console.log("erros");
                },
            });
            //alert(evaluation);
        },

        addevaluation() {
            this.evaluation_modal = true;
        },
        closeEvaluation_modal() {
            this.evaluation_modal = false;
        },

        addDiagnostico() {
            console.log("diagnostico");
        },
        changeFormat(date) {
            let newdate = date.split("-");
            return newdate[2] + "/" + newdate[1] + "/" + newdate[0];
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

.protable thead {
    background-color: #f1f5f9;
}

.protable thead tr th {
    letter-spacing: 0.03em;
    color: #475569;
    font-size: 0.875rem;
    line-height: 1.75rem;
}

.protable tbody tr {
    background-color: #f8fafc;
}

.protable tbody tr td {
    padding: 2px;
    text-align: center;
    color: #374151;
    font-size: 1rem;
    font-weight: 300;
}

@media (max-width: 770px) {
    .protable thead tr th {
        font-size: 0.85rem;
        line-height: 1rem;
    }

    .protable tbody tr td {
        font-size: 0.75rem;
        font-weight: 300;
    }
}

@media (max-width: 500px) {
    .protable thead tr th {
        font-size: 0.6rem;
        line-height: 1rem;
    }

    .protable tbody tr td {
        font-size: 0.6rem;
        font-weight: 300;
    }
}
</style>
