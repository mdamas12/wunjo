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
            <div class="p-1 grid grid-cols-2 gap-2">
                <div class="rounded-lg">
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
            <div class="p-1 grid grid-cols-1 gap-2">
                <div
                    class=""
                    v-if="consultations.length != 0 || packages.length != 0"
                >
                    <h3>Pagos pendientes del cliente :</h3>
                    <table
                        class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                    >
                        <thead class="text-white">
                            <tr
                                class="bg-cyan-600 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                            >
                                <th class="p-3 text-center">Paciente</th>
                                <th class="p-3 text-center">Fecha</th>
                                <th class="p-3 text-center">Servicio</th>
                                <th class="p-3 text-center">Monto Total</th>
                                <th class="p-3 text-center">Monto Pagado</th>
                                <th class="p-3 text-center">Monto a Pagar</th>
                                <th class="p-3 text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody
                            v-for="(consultation, index) in consultations"
                            class="flex-1 sm:flex-none"
                        >
                            <tr
                                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
                            >
                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3"
                                >
                                    {{ consultation.patient }}
                                </td>
                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3"
                                >
                                    {{ changeFormat(consultation.date) }}
                                </td>
                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
                                    Consulta
                                </td>

                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
                                    {{ consultation.amount }}
                                </td>

                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
                                    {{
                                        consultation.amount_paid
                                            ? consultation.amount_paid
                                            : "0"
                                    }}
                                </td>

                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
                                    {{ consultation.amount_payable }}
                                </td>

                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
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
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    />
                                </td>
                            </tr>
                        </tbody>

                        <tbody
                            v-for="(packagep, index) in packages"
                            class="flex-1 sm:flex-none"
                        >
                            <tr
                                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
                            >
                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3"
                                >
                                    {{ packagep.patient }}
                                </td>
                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3"
                                >
                                    {{ changeFormat(packagep.date) }}
                                </td>
                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
                                    {{ packagep.service_name }}
                                </td>

                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
                                    {{ packagep.price }}
                                </td>

                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
                                    {{
                                        packagep.amount_paid
                                            ? packagep.amount_paid
                                            : "0"
                                    }}
                                </td>
                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
                                    {{ packagep.amount_payable }}
                                </td>

                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
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
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <h3 class="text-red-500">
                        El paciente no tiene servicio pendiente por cancelar
                    </h3>
                </div>
            </div>

            <div
                class="bg-cyan-600 text-white p-1 grid grid-cols-2 gap-2 rounded-md mb-10"
                v-if="form.amount > 0"
            >
                <span class="rounded-xs p-2">
                    Monto total a cancelar : {{ form.amount }}
                </span>
                <InputError :message="$page.props.errors.amount" />
            </div>
            <h1>Agregar Pagos</h1>
            <div class="bg-gray-50 rounded-lg p-1 grid grid-cols-1 gap-2">
                <div class="p-1 grid grid-cols-2 gap-2">
                    <div class="rounded-lg">
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
                                {{ method.method_type.name }} ||
                                {{ method.bank }}
                            </option>
                        </select>
                    </div>

                    <div class="">
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
                <div class="p-1 grid grid-cols-2 gap-2">
                    <div class="">
                        <input
                            type="text"
                            class="bg-gray-100 border border-gray-300 text-gray-700 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="reference"
                            id="reference"
                            placeholder="Referencia"
                        />
                    </div>
                    <div class="">
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
                    <button type="button" @click="addParcialPayment()">
                        <svg
                            class="h-6 w-6 text-cyan-500"
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
                    <table
                        class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                    >
                        <thead class="text-white">
                            <tr
                                class="bg-cyan-600 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                            >
                                <th class="p-3 text-center">Metodo de pago</th>
                                <th class="p-3 text-center">Monto</th>
                                <th class="p-3 text-center">Referencias</th>
                                <th class="p-3 text-center">Comprobante</th>
                                <th class="p-3 text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody
                            v-for="(data, index) in datapay"
                            :key="index"
                            class="flex-1 sm:flex-none"
                        >
                            <tr
                                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
                            >
                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3"
                                >
                                    {{ data.method_pay.method_type.name }} ||
                                    {{ data.method_pay.bank }}
                                </td>
                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3"
                                >
                                    {{ data.parcial_amount }}
                                </td>
                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
                                    {{
                                        data.reference ? data.reference : "S/R"
                                    }}
                                </td>

                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
                                    {{
                                        data.file_reference
                                            ? data.file_reference.name
                                            : "S/R"
                                    }}
                                </td>

                                <td
                                    class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                                >
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

            <!-- add amount pay modal -->
            <div
                id="addModal"
                tabindex="-1"
                v-show="addModal"
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
                                class="py-2 px-3 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-900"
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
            checked: "",
            band_consu: "consultation",
            band_pack: "packages",
            detail_band: "",
            msg_error: "",

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
</style>
