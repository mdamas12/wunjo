<script setup>
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Inertia } from "@inertiajs/inertia";
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
    payment_methods: {
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
    <FormSection @submitted="validateform()" class="">
        $emit('submit')
        <template #form>
            <div
                class="p-1 grid gap-2 grid-cols-1 md:grid-cols-2 lg:grid-cols-2"
            >
                <div class="text-sm rounded-sm">
                    <InputLabel for="date">Fecha</InputLabel>
                    <div class="relative max-w-sm">
                        <div
                            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
                        >
                            <svg
                                class="w-4 h-4 text-gray-500 dark:text-gray-400 text-sm"
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

                <div class="rounded-lg">
                    <InputLabel for="branch">Paciente:</InputLabel>
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="branch_id"
                        v-model="form.patient_id"
                        @change="search_consultations(form.patient_id)"
                    >
                        <option v-for="patient in patients" :value="patient.id">
                            {{ patient.fist_name }} {{ patient.last_name }}
                        </option>
                    </select>
                    <InputError :message="$page.props.errors.patient_id" />
                </div>
            </div>
            <div class="">
                <div
                    class="overflow-auto rounded-lg shadow p-4"
                    v-if="consultations.length != 0 || packages.length != 0"
                >
                    <h3>Pagos pendientes del cliente :</h3>
                    <table class="w-full protable">
                        <thead>
                            <tr class="text-center">
                                <th>Paciente</th>
                                <th>Fecha</th>
                                <th>Servicio</th>
                                <th>Monto Total</th>
                                <th>Monto Pagado</th>
                                <th>Monto a Pagar</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody v-for="(consultation, index) in consultations">
                            <tr class="divide-y divide-gray-400">
                                <td>
                                    {{ consultation.patient }}
                                </td>
                                <td>
                                    {{ changeFormat(consultation.date) }}
                                </td>
                                <td>Consulta</td>

                                <td>
                                    {{ consultation.amount }}
                                </td>

                                <td>
                                    {{
                                        consultation.amount_paid
                                            ? consultation.amount_paid
                                            : "0"
                                    }}
                                </td>

                                <td>
                                    {{ consultation.amount_payable }}
                                </td>

                                <td>
                                    <input
                                        id="add-consultation"
                                        type="checkbox"
                                        v-model="consultation.checked"
                                        @change="
                                            openAddModal(
                                                consultation,
                                                consultation.checked,
                                                band_consu,
                                                index
                                            )
                                        "
                                        class=""
                                    />
                                </td>
                            </tr>
                        </tbody>

                        <tbody v-for="(packagep, index) in packages">
                            <tr class="divide-y divide-gray-400">
                                <td>
                                    {{ packagep.patient }}
                                </td>
                                <td>
                                    {{ changeFormat(packagep.date) }}
                                </td>
                                <td>
                                    {{ packagep.service_name }}
                                </td>

                                <td>
                                    {{ packagep.price }}
                                </td>

                                <td>
                                    {{
                                        packagep.amount_paid
                                            ? packagep.amount_paid
                                            : "0"
                                    }}
                                </td>
                                <td>
                                    {{ packagep.amount_payable }}
                                </td>

                                <td>
                                    <input
                                        id="add-consultation"
                                        type="checkbox"
                                        v-model="packagep.checked"
                                        @change="
                                            openAddModal(
                                                packagep,
                                                packagep.checked,
                                                band_pack,
                                                index
                                            )
                                        "
                                        class=""
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="msg_nolist != ''">
                    <p class="lg:text-lg md:text-md sm:text-sm text-red-500">
                        {{ msg_nolist }}
                    </p>
                </div>
            </div>

            <div
                class="bg-gray-600 text-white p-1 gap-2 rounded-md my-5 grid"
                v-if="form.amount > 0"
            >
                <span class="rounded-xs p-2">
                    Monto total a cancelar :
                    <span class="text-lg">S/. {{ form.amount }} </span>
                </span>
                <InputError :message="$page.props.errors.amount" />
            </div>
            <h1 class="text-gray-600">Pagos :</h1>
            <div class="bg-gray-50 rounded-lg p-1">
                <div
                    class="p-1 grid gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2"
                >
                    <div class="rounded-lg">
                        <InputLabel for="mop">Metodo de pago:</InputLabel>
                        <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="method_pay"
                            placeholder="Monto a pagar"
                            v-model="method_pay"
                        >
                            <option
                                v-for="method in payment_methods"
                                :value="method"
                            >
                                {{ method.name }}
                            </option>
                        </select>
                    </div>

                    <div class="">
                        <InputLabel for="mp">Monto a pagar:</InputLabel>
                        <input
                            type="number"
                            class="bg-gray-100 border border-gray-300 text-gray-700 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="parcial_amount"
                            id="parcial_amount"
                            placeholder="Monto a pagar"
                            required=""
                        />
                    </div>
                </div>
                <div
                    class="p-1 grid gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2"
                >
                    <div class="">
                        <InputLabel for="reference">Referencia:</InputLabel>
                        <input
                            type="text"
                            class="bg-gray-100 border border-gray-300 text-gray-700 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="reference"
                            id="reference"
                            placeholder="Referencia"
                        />
                    </div>
                    <div class="">
                        <InputLabel for="cap">Comprobante:</InputLabel>
                        <input
                            class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help"
                            id="file_reference"
                            type="file"
                            @change="selectFile"
                        />
                        <p
                            class="mt-1 text-sm text-gray-400 dark:text-gray-300"
                            id="file_input_help"
                        >
                            SVG, PNG, JPG or GIF (MAX. 800x400px).
                        </p>
                    </div>
                </div>
                <div class="items-center content-center">
                    <button
                        type="button"
                        @click="addParcialPayment()"
                        class="w-full inline-flex mx-3 items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        <svg
                            class="h-6 w-6 text-white hover:text-white"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect
                                x="3"
                                y="3"
                                width="18"
                                height="18"
                                rx="2"
                                ry="2"
                            />
                            <line x1="12" y1="8" x2="12" y2="16" />
                            <line x1="8" y1="12" x2="16" y2="12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- TABLA DE PAGOS PARCIALES-->

            <div class="p-1 grid grid-cols-1 gap-2">
                <div class="" v-if="datapay.length != 0">
                    <h3>Pagos Parciales :</h3>
                    <div class="overflow-auto rounded-lg shadow p-4">
                        <table class="w-full protable">
                            <thead>
                                <tr>
                                    <th class="p-3 text-center">
                                        Metodo de pago
                                    </th>
                                    <th class="p-3 text-center">Monto</th>
                                    <th class="p-3 text-center">Referencias</th>
                                    <th class="p-3 text-center">Comprobante</th>
                                    <th class="p-3 text-center">Acciones</th>
                                </tr>
                            </thead>

                            <tbody
                                v-for="(data, index) in datapay"
                                :key="index"
                                class=""
                            >
                                <tr>
                                    <td>
                                        {{ data.method_pay.method_type.name }}
                                        |
                                        {{ data.method_pay.name }}
                                    </td>
                                    <td>
                                        {{ data.parcial_amount }}
                                    </td>
                                    <td>
                                        {{
                                            data.reference
                                                ? data.reference
                                                : "S/R"
                                        }}
                                    </td>

                                    <td>
                                        {{
                                            data.file_reference
                                                ? data.file_reference.name
                                                : "S/R"
                                        }}
                                    </td>

                                    <td>
                                        <button
                                            type="button"
                                            @click="deleteParcialPayment(index)"
                                        >
                                            <svg
                                                class="h-6 w-6 text-red-700"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <line
                                                    x1="18"
                                                    y1="6"
                                                    x2="6"
                                                    y2="18"
                                                />
                                                <line
                                                    x1="6"
                                                    y1="6"
                                                    x2="18"
                                                    y2="18"
                                                />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- add amount pay modal -->
            <div
                id="addModal"
                tabindex="-1"
                v-show="addModal"
                class="overflow-y-auto overflow-x-hidde fixed justify-center items-center w-full md:inset-0 h-modal md:h-full"
            >
                <div
                    class="relative top-0 left-[40%] p-4 w-full max-w-md h-full md:h-auto"
                >
                    <!-- Modal content -->
                    <div
                        class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5"
                    >
                        <button
                            type="button"
                            class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="deleteModal"
                            @click="closeAddModal()"
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
                            class="h-12 w-12 text-green-600 mx-auto"
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
                            <circle cx="12" cy="12" r="9" />
                            <path
                                d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1 -1.8 -1"
                            />
                            <path d="M12 6v2m0 8v2" />
                        </svg>

                        <p class="mb-4 text-gray-500 dark:text-gray-300">
                            Agrega un monto a pagar para este servicio
                        </p>
                        <div class="flex items-center mb-4">
                            <input
                                id="default-radio-1"
                                type="radio"
                                value="true"
                                v-model="radioCheckTotal"
                                name="default-radio"
                                @change="checkRadioTotal()"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            />
                            <label
                                for="default-radio-1"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Pago Total</label
                            >
                        </div>
                        <div class="flex items-center">
                            <input
                                id="default-radio-2"
                                type="radio"
                                value="true"
                                v-model="radioCheckPartial"
                                name="default-radio"
                                @change="checkRadioPartial()"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            />
                            <label
                                for="default-radio-2"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Pago Parcial</label
                            >
                            <input
                                type="number"
                                v-show="hidden_amount"
                                class="bg-gray-100 border border-gray-300 text-gray-700 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                id="amount_paid_service"
                                v-model="amount_paid_service"
                                placeholder="agrega el monto parcial"
                            />
                        </div>
                        <div class="flex justify-center items-center space-x-4">
                            <button
                                @click="closeAddModal()"
                                data-modal-toggle="deleteModal"
                                type="button"
                                class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                            >
                                cancelar
                            </button>
                            <button
                                type="button"
                                @click="check(pending, checked, type, index)"
                                class="py-2 px-3 text-sm font-medium text-center text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-900"
                            >
                                Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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
                {{ updating ? "Actualizar" : "Crear Nuevo" }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>

<script>
export default {
    name: "PaymentForm",

    data() {
        return {
            consultation: [],
            consultations: [],
            packages: [],
            payment_details: [],
            consultationsPendingList: [],
            packagesPendingList: [],

            band_consu: "consultation",
            band_pack: "packages",
            detail_band: "",
            msg_error: "",
            msg_nolist: "",

            method_pay: "",
            parcial_amount: 0,
            reference: "",
            file: null,
            datapay: [],
            total_pay_amount: 0,

            total_amount: false,
            partial_amount: false,
            addModal: false,
            pending: [],
            checked: false,
            type: "",
            index: "",
            hidden_amount: false,
            partial_amount: [],
            amount_paid_service: 0,

            radioCheckTotal: false,
            radioCheckPartial: false,
        };
    },

    methods: {
        search_consultations(patient_id) {
            let data = patient_id;
            this.consultations = [];
            this.packages = [];
            this.form.amount = 0;
            router.visit("searchconsultation", {
                method: "post",
                data: {
                    patient: patient_id,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: (resp) => {
                    let list_consultations =
                        resp.props.jetstream.flash.consultations;
                    list_consultations.forEach((item, index) => {
                        let data = {
                            id: item.id,
                            date: item.date,
                            patient:
                                item.patient.fist_name +
                                " " +
                                item.patient.last_name,
                            employee:
                                item.employee.fist_name +
                                " " +
                                item.employee.last_name,
                            amount: item.amount,
                            amount_paid: item.amount_paid,
                            amount_payable: 0,
                        };
                        this.consultations.push(data);
                    });

                    let packagesList = resp.props.jetstream.flash.packages;
                    packagesList.forEach((item, index) => {
                        let data = {
                            id: item.id,
                            date: item.date,
                            service_name: item.service_name,
                            patient:
                                item.patient.fist_name +
                                " " +
                                item.patient.last_name,
                            price: item.service.price,
                            amount_paid: item.amount_paid,
                            amount_payable: 0,
                        };
                        this.packages.push(data);
                    });
                    this.paymentPendingList = [];
                    if (
                        this.packages.length == 0 &&
                        this.consultations.length == 0
                    ) {
                        this.msg_nolist =
                            "El paciente no tiene consultas o paquetes por cancelar.";
                    }
                },
                onError: (errors) => {
                    console.log("erros");
                },
            });
            return;
        },

        add_detail(consultation) {
            let reg = {
                date: consultation.date,
                type: "CONSULTA",
            };
        },

        changeFormat(date) {
            let newdate = date.split("-");
            return newdate[2] + "/" + newdate[1] + "/" + newdate[0];
        },

        openAddModal(pending, checked, type, index) {
            this.pending = pending;
            this.checked = checked;
            this.type = type;
            this.index = index;

            if (checked == true) {
                this.addModal = true;
            } else {
                this.check(pending, checked, type, index);
            }
            return;
        },
        closeAddModal() {
            this.addModal = false;
            this.checked = false;
        },

        checkRadioPartial() {
            this.hidden_amount = true;
        },

        checkRadioTotal() {
            this.hidden_amount = false;
            if (this.type == "consultation") {
                this.amount_paid_service =
                    this.consultations[this.index].amount -
                    this.consultations[this.index].amount_paid;
            } else {
                this.amount_paid_service =
                    this.packages[this.index].price -
                    this.packages[this.index].amount_paid;
            }
        },

        check(pending, checked, type, index) {
            /**
             *  funcion para agregar un detalle del pago
             */

            if (checked == true) {
                if (
                    this.radioCheckTotal == false &&
                    this.radioCheckPartial == false
                ) {
                    alert("Debes seleccionar una opcion");
                    return;
                }
                this.addModal = false;
                this.hidden_amount = false;
                this.radioCheckTotal = false;
                this.radioCheckPartial = false;
                if (type == "consultation") {
                    let dif =
                        this.consultations[index].amount -
                        this.consultations[index].amount_paid;
                    if (this.amount_paid_service > dif) {
                        alert(
                            "El monto a pagar debe ser menor o igual al monto pendiente"
                        );
                        return;
                    }

                    this.consultations[index].amount_payable =
                        this.amount_paid_service;
                    let detail = {
                        payment_id: "",
                        consultation_id: pending.id,
                        amount_payable: this.amount_paid_service,
                    };
                    this.detail_band = "pass";
                    this.form.consultaDetails.push(detail);

                    this.form.amount =
                        this.amount_paid_service + this.form.amount;
                    this.amount_paid_service = 0;
                } else {
                    let dif =
                        this.packages[index].price -
                        this.packages[index].amount_paid;
                    if (this.amount_paid_service > dif) {
                        alert(
                            "El monto a pagar debe ser menor o igual al monto pendiente"
                        );
                        return;
                    }
                    this.packages[index].amount_payable =
                        this.amount_paid_service;
                    let detail = {
                        payment_id: "",
                        package_id: pending.id,
                        service_id: pending.services_id,
                        amount_payable: this.amount_paid_service,
                    };
                    this.detail_band = "pass";
                    this.form.packagesDetails.push(detail);
                    //let rest_paid = this.amount_paid_service;
                    this.form.amount =
                        this.amount_paid_service + this.form.amount;
                }
            } else {
                /**
                 *  funcion para quitar un detalle del pago
                 */
                this.amount_paid_service = 0;
                if (type == "consultation") {
                    this.form.consultaDetails.forEach((item, index) => {
                        if (item.consultation_id == pending.id) {
                            this.form.consultaDetails.splice(index, 1);

                            this.form.amount =
                                this.form.amount -
                                this.consultations[index].amount_payable;
                        }
                    });
                    this.consultations[index].amount_payable = 0;
                } else {
                    this.form.packagesDetails.forEach((item, index) => {
                        //console.log(pending.id);
                        if (item.package_id == pending.id) {
                            this.form.packagesDetails.splice(index, 1);
                            //let rest_paid = pending.price - pending.amount_paid;

                            this.form.amount =
                                this.form.amount -
                                this.packages[index].amount_payable;
                        }
                    });
                    this.packages[index].amount_payable = 0;
                }
                if (
                    this.form.packagesDetails.length == 0 &&
                    this.form.consultaDetails.length == 0
                ) {
                    this.detail_band = "";
                }
            }
            this.amount_paid_service = 0;
        },

        /**
         *
         * Metodos para pagos parcieles
         */
        selectFile(event) {
            this.file = event.target.files[0];
            //console.log(this.file);
        },

        addParcialPayment() {
            if (this.form.amount <= 0) {
                alert("¡Debes seleccionar algun pago pendiente del paciente!");
                return;
            }
            let validate_amount = this.total_pay_amount + this.parcial_amount;
            if (validate_amount > this.form.amount) {
                alert("¡No puedes superar el monto total a pagar!");
                return;
            }

            let payCheck = {
                method_pay: this.method_pay,
                parcial_amount: this.parcial_amount,
                reference: this.reference,
                file_reference: this.file,
            };
            this.total_pay_amount = this.total_pay_amount + this.parcial_amount;
            this.datapay.push(payCheck);
            this.reference = "";
            this.parcial_amount = 0;

            return;
        },
        deleteParcialPayment(i) {
            this.datapay.forEach((item, index) => {
                if (index == i) {
                    this.total_pay_amount =
                        this.total_pay_amount - item.parcial_amount;
                    this.datapay.splice(index, 1);
                }
            });

            return;
        },

        validateform() {
            if (this.detail_band == "") {
                alert(
                    "¡No puedes continuar sin seleccionar un pago pendiente de la lista!"
                );
                return;
            }
            if (
                this.form.packagesDetails.length == 0 &&
                this.form.consultaDetails.length == 0
            ) {
                alert("¡No puedes continuar sin agregar al menos un pago!");
                return;
            }
            if (this.datapay.length == 0) {
                alert("¡Debes agregar algun pago para continuar!");
                return;
            } else {
                this.form.partialPayments = this.datapay;
            }

            let total_select_details =
                this.form.consultaDetails.length +
                this.form.packagesDetails.length;
            if (this.total_pay_amount < this.form.amount) {
                alert("¡Debes agregar el pago completo!");
                return;
            }

            return this.$emit("submit");
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
        font-size: 0.5rem;
        line-height: 1rem;
    }

    .protable tbody tr td {
        font-size: 0.5rem;
        font-weight: 300;
    }
}
</style>
