<script setup>
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { router } from "@inertiajs/vue3";
defineProps({
    form: {
        type: Object,
        required: true,
    },

    patients: {
        type: Object,
        required: true,
    },
    branches: {
        type: Object,
        required: true,
    },
    employees: {
        type: Object,
        required: true,
    },

    updating: {
        type: Boolean,
        required: false,
        default: false,
    },
});

defineEmits(["submit"]);
</script>

<template>
    <FormSection @submitted="$emit('submit')" class="w-full">
        <template #form>
            <div class="col-span-6">
                <div class="col-span-6">
                    <InputLabel for="branch">Sede:</InputLabel>
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="branch_id"
                        v-model="form.branch_id"
                    >
                        <option
                            v-for="branch in branches"
                            :value="branch.branch_id"
                        >
                            {{ branch.branch.name }}
                        </option>
                    </select>
                    <InputError :message="$page.props.errors.employee_id" />
                </div>

                <InputLabel for="date">Fecha</InputLabel>
                <div class="relative max-w-sm">
                    <div
                        class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
                    >
                        <svg
                            class="w-4 h-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                            />
                        </svg>
                    </div>
                    <input
                        datepicker
                        datepicker-buttons
                        datepicker-autoselect-today
                        type="date"
                        v-model="form.date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date"
                    />
                </div>
                <InputError :message="$page.props.errors.date" />
            </div>
            <div class="col-span-6">
                <InputLabel for="hour">Hora</InputLabel>
                <div class="relative">
                    <div
                        class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none"
                    >
                        <svg
                            class="w-4 h-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <input
                        type="time"
                        id="time"
                        v-model="form.hour"
                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        min="07:00"
                        max="22:00"
                        value="00:00"
                    />
                </div>
                <InputError :message="$page.props.errors.hour" />
            </div>

            <div
                class="col-span-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 my-2"
            >
                <div>
                    <InputLabel for="patient">Paciente</InputLabel>
                    <div class="items-center mb-3">
                        <div class="w-[100%]">
                            <label class="sr-only">Search</label>
                            <div class="relative mt-1">
                                <input
                                    v-on:keyup="goTosearch(patient)"
                                    type="text"
                                    name="user"
                                    id="patient-search"
                                    v-model="patient"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500"
                                    placeholder="Buscar paciente"
                                />
                            </div>
                            <ul
                                v-show="patient_list"
                                class="z-30 absolute bg-gray-200 border-red-400 w-[60%] h-[100px] overflow-auto"
                            >
                                <li
                                    class="p-0.5 mt-0.5 text-gray-700"
                                    v-for="patient in searchPatients"
                                >
                                    <button
                                        type="button"
                                        @click="addPatient(patient)"
                                    >
                                        {{ patient.fist_name }}
                                        {{ patient.last_name }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!--
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="position_id"
                        v-model="form.patient_id"
                    >
                        <option v-for="patient in patients" :value="patient.id">
                            {{ patient.fist_name }} {{ patient.last_name }}
                        </option>
                    </select>
                    <InputError :message="$page.props.errors.patient_id" />
                    -->
                </div>
                <div class="space-x-1 sm:pl-2 sm:mt-0 content-center">
                    <button
                        @click="openModalPatientNew()"
                        type="button"
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
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="16" />
                            <line x1="8" y1="12" x2="16" y2="12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="col-span-6">
                <InputLabel for="employee">Asignar a:</InputLabel>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="position_id"
                    v-model="form.employee_id"
                    @change="prueba(form.employee_id)"
                >
                    <option v-for="employee in employees" :value="employee.id">
                        {{ employee.fist_name }} {{ employee.last_name }}
                    </option>
                </select>
                <InputError :message="$page.props.errors.employee_id" />
            </div>

            <div class="col-span-6" v-if="updating == true">
                <InputLabel for="status">Status</InputLabel>
                <select
                    id="status"
                    v-model="form.status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                >
                    <option value="PENDIENTE">PENDIENTE</option>
                    <option value="REALIZADA">REALIZADA</option>
                    <option value="CANCELADA">CANCELADA</option>
                </select>
                <InputError :message="$page.props.errors.status" />
            </div>
            <!--
            <div class="col-span-6">
                <InputLabel for="status_payment">Pago</InputLabel>
                <select
                    id="status_payment"
                    v-model="form.status_payment"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                >
                    <option selected="">Selecciona un Status</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="parcial">Parcial</option>
                    <option value="pagada">Pagada</option>
                </select>
                <InputError :message="$page.props.errors.status_payment" />
            </div>
            -->
        </template>

        <template #actions>
            <PrimaryButton
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                <svg
                    class="me-1 -ms-1 w-5 h-5"
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
                {{ updating ? "Actualizar" : "Crear Nueva" }}
            </PrimaryButton>
        </template>
    </FormSection>
    <!-- MODAL para Registrar nuevo paciente -->
    <div
        id="modal-addpatient"
        tabindex="-1"
        v-show="ModalAddPatient"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
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
                        Registrar nuevo paciente
                    </h3>
                    <button
                        type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="closeModalPatientNew()"
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
                <div class="p-2">
                    <div class="col-span-6">
                        <InputLabel for="name">Nombre</InputLabel>
                        <TextInput
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="patient_fistname"
                            id="fistname"
                            placeholder="Nombre del paciente"
                            required=""
                        />
                        <InputError :message="$page.props.errors.first_name" />
                    </div>
                    <div class="col-span-6">
                        <InputLabel for="name">Apellido</InputLabel>
                        <TextInput
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="patient_lastname"
                            id="lastname"
                            placeholder="Apellido del paciente"
                            required=""
                        />
                        <InputError :message="$page.props.errors.last_name" />
                    </div>
                    <div class="col-span-6">
                        <InputLabel for="name">Identificacion</InputLabel>
                        <input
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="patient_identification"
                            id="identification"
                            placeholder="identificacion del paciente"
                        />
                    </div>
                    <div class="col-span-6">
                        <InputLabel for="name">Telefono</InputLabel>
                        <input
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="patient_phone"
                            id="phone"
                            placeholder="Numero de telefono"
                        />
                    </div>

                    <div class="col-span-6">
                        <InputLabel for="name">Email</InputLabel>
                        <input
                            type="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="patient_email"
                            id="email"
                            placeholder="Email del paciente"
                        />
                    </div>
                    <div class="col-span-6">
                        <InputLabel for="name">Direccion</InputLabel>
                        <input
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="patient_address"
                            id="address"
                            placeholder="Direccion del paciente"
                        />
                    </div>
                    <div class="grid grid-cols-1 content-center my-2">
                        <button
                            type="button"
                            @click="SavePatient()"
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
                            Registrar
                        </button>
                    </div>
                </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>
    <!---->
</template>

<script>
export default {
    name: "ConsultationsForm",

    data() {
        return {
            patient: "",
            searchPatients: [],
            patient_list: false,
            ModalAddPatient: false,
            patient_fistname: "",
            patient_lastname: "",
            patient_identification: "",
            patient_phone: "",
            patient_email: "",
            patient_address: "",
        };
    },

    methods: {
        goTosearch(search) {
            let fist_name = "";
            let last_name = "";
            let splitsearch = search.split(" ");

            if (splitsearch.length > 1) {
                fist_name = splitsearch[0];
                last_name = splitsearch[1];
            } else {
                fist_name = search;
            }
            router.visit("searchp", {
                method: "post",
                data: {
                    fist_name: fist_name,
                    last_name: last_name,
                },
                preserveState: true,
                preserveScroll: true,

                onSuccess: (resp) => {
                    this.searchPatients = resp.props.jetstream.flash.patients;
                    this.patient_list = true;
                    return;
                },
                onError: (errors) => {
                    console.log("erros");
                    return;
                },
            });
        },
        prueba(empleado) {
            //console.log(empleado);
            return;
        },
        addPatient(patient) {
            this.patient = patient.fist_name + " " + patient.last_name;
            this.form.patient_id = patient.id;
            this.patient_list = false;
            return;
        },
        openModalPatientNew() {
            this.ModalAddPatient = true;
        },
        closeModalPatientNew() {
            this.ModalAddPatient = false;
        },
        SavePatient() {
            router.visit("savepatient", {
                method: "post",
                data: {
                    fist_name: this.patient_fistname,
                    last_name: this.patient_lastname,
                    identification: this.patient_identification,
                    phone: this.patient_phone,
                    email: this.patient_email,
                    address: this.patient_address,
                },
                preserveState: true,
                preserveScroll: true,

                onSuccess: (resp) => {
                    let newPatient = resp.props.jetstream.flash.patientnew;
                    //console.log(newPatient);
                    this.patient =
                        this.patient_fistname + " " + this.patient_lastname;
                    this.form.patient_id = newPatient.id;
                    this.ModalAddPatient = false;
                    return;
                },
                onError: (errors) => {
                    console.log("erros");
                    return;
                },
            });
        },
        submit_validate() {},
    },
};
</script>
