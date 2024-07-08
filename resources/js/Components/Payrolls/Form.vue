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
    employees: {
        type: Object,
        required: true,
    },

    payment_methods: {
        type: Object,
        required: true,
    },

    therapy: {
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
    <FormSection @submitted="Formvalidate()" class="w-full">
        <template #form>
            <div class="grid grid-cols-2">
                <div class="m-2">
                    <InputLabel for="status">Empleado</InputLabel>
                    <select
                        id="employee"
                        v-model="form.employee"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        @change="SearchWorked(form.employee)"
                    >
                        <option v-for="employee in employees" :value="employee">
                            {{ employee.fist_name }} {{ employee.last_name }}
                        </option>
                    </select>
                    <InputError :message="$page.props.errors.employee_id" />
                </div>
                <div class="rounded-lg m-2">
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
            </div>
            <div v-if="employeeSelect.contract == 'PORCENTUAL'">
                <div
                    class="p-1 grid grid-cols-1 gap-2"
                    v-if="payrollDetail.length > 0"
                >
                    <InputLabel for="name"
                        >Seleccionar las consultas
                    </InputLabel>
                    <table
                        class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                    >
                        <thead class="text-white">
                            <tr
                                class="bg-gray-200 text-gray-500 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                            >
                                <th class="p-3 text-center">Fecha</th>
                                <th class="p-3 text-center">Monto</th>
                                <th class="p-3 text-center">Paquete?</th>
                                <th class="p-3 text-center">Seleccionar</th>
                            </tr>
                        </thead>

                        <tbody
                            v-for="(detail, index) in payrollDetail"
                            class="flex-1 sm:flex-none"
                        >
                            <tr
                                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
                            >
                                <td
                                    class="text-center border-grey-light border p-3"
                                >
                                    {{ changeFormat(detail.date) }}
                                </td>
                                <td
                                    class="text-center border-grey-light border p-3"
                                >
                                    {{ detail.amount }}
                                </td>
                                <td
                                    class="text-center border-grey-light border p-3"
                                >
                                    {{
                                        detail.haspackage == false ? "NO" : "SI"
                                    }}
                                </td>
                                <td
                                    class="text-center border-grey-light border p-3 truncate"
                                >
                                    <input
                                        type="checkbox"
                                        v-model="detail.checked"
                                        @change="
                                            selectDetail(detail.checked, detail)
                                        "
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="grid grid-cols-2">
                    <div class="m-2">
                        <InputLabel for="name">Monto Total </InputLabel>
                        <input
                            type="number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="amountTotal"
                            id="amountTotal"
                            disabled
                        />
                    </div>
                    <div class="m-2">
                        <InputLabel for="name"
                            >Monto Porcentual a pagar</InputLabel
                        >
                        <input
                            type="number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            v-model="porcentualPay"
                            id="porcentualPay"
                            disabled
                        />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="rounded-md">
                    <InputLabel for="name">Metodo de Pago</InputLabel>

                    <select
                        class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
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
                <div class="m-2">
                    <InputLabel for="name">Monto de pago</InputLabel>
                    <input
                        type="number"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        v-model="amountPayroll"
                        id="amountPayroll"
                        step=".01"
                    />
                </div>
            </div>

            <div class="grid grid-cols-2">
                <div class="rounded-md">
                    <InputLabel for="name">Concepto de pago</InputLabel>
                    <input
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        v-model="concept"
                        id="concept"
                    />
                </div>
                <div class="m-2">
                    <InputLabel for="name">Referencia</InputLabel>
                    <input
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        v-model="reference"
                        id="reference"
                    />
                </div>
            </div>
            <div class="my-4 mx-2">
                <input
                    class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="Comprobante de pago"
                    id="file_reference"
                    type="file"
                    @change="selectFile"
                />
                <p
                    class="mt-1 text-sm text-gray-400 dark:text-gray-300"
                    id="file_input_text"
                >
                    Comprobante de pago.
                </p>
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
                {{ updating ? "Actualizar" : "Generar Pago" }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
<script>
export default {
    name: "UsersForm",
    data() {
        return {
            payrollDetail: [],
            amountTotal: 0,
            porcentualPay: 0,
            employeeSelect: [],
            method_pay: [],
            reference: "",
            amountPayroll: 0,
            concept: "",
            file: null,
        };
    },
    methods: {
        changeFormat(date) {
            let newdate = date.split("-");
            return newdate[2] + "/" + newdate[1] + "/" + newdate[0];
        },
        selectFile(event) {
            this.file = event.target.files[0];
            //console.log(this.file);
        },
        SearchWorked(employee) {
            this.employeeSelect = employee;
            this.form.payrollsDetails = [];
            this.payrollDetail = [];
            this.amountTotal = 0;
            this.porcentualPay = 0;

            router.visit("searchworked", {
                method: "post",
                data: {
                    employee: employee.id,
                },
                preserveState: true,
                preserveScroll: true,

                onSuccess: (resp) => {
                    let search = resp.props.jetstream.flash.consultations;
                    let amount = 0;
                    let haspackage = false;
                    search.forEach((item, index) => {
                        if (item.haspackage == true) {
                            amount = item.amount + this.therapy.price;
                            haspackage = true;
                        } else {
                            amount = item.amount;
                        }
                        let data = {
                            consultation_id: item.id,
                            date: item.date,
                            amount: amount,
                            haspackage: haspackage,
                        };
                        this.payrollDetail.push(data);
                    });
                },
                onError: (errors) => {
                    console.log("erros");
                },
            });
            return;
        },

        selectDetail(checked, detail) {
            if (checked == true) {
                this.form.payrollsDetails.push(detail);
                this.amountTotal = this.amountTotal + detail.amount;
                this.porcentualPay =
                    Math.floor(this.amountTotal * this.employeeSelect.mount) /
                    100;
            } else {
                this.form.payrollsDetails.forEach((item, index) => {
                    if (item.consultation_id == detail.consultation_id) {
                        this.amountTotal = this.amountTotal - detail.amount;
                        this.form.payrollsDetails.splice(index, 1);
                        this.porcentualPay =
                            Math.floor(
                                this.amountTotal * this.employeeSelect.mount
                            ) / 100;
                    }
                });
            }
        },

        Formvalidate() {
            //console.log(this.amountPayroll + " " + this.porcentualPay);
            if (
                this.employeeSelect.contract == "PORCENTUAL" &&
                this.form.payrollsDetails.length == 0
            ) {
                alert(
                    "Debe seleccionar al menos una consulta de la lista para procesar el pago"
                );
                return;
            }
            if (
                this.employeeSelect.contract == "PORCENTUAL" &&
                this.amountPayroll != this.porcentualPay
            ) {
                alert(
                    "El monto a pagar deber ser igual al calculo determinado por el sistema."
                );
                return;
            }

            if (
                this.method_pay.length == 0 ||
                this.concept == "" ||
                this.reference == "" ||
                this.amountPayroll == 0
            ) {
                alert("Debes llenar los campos de pago correctamente");
                return;
            }

            this.form.employee = this.employeeSelect.id;
            this.form.amount = this.amountPayroll;
            this.form.concept = this.concept;

            this.form.payment_methods_id = this.method_pay.id;
            this.form.amount_pay = this.amountPayroll;
            this.form.reference = this.reference;
            this.form.capture = this.file;

            return this.$emit("submit");
        },
    },
};
</script>
