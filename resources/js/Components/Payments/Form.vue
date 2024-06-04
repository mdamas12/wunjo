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
    <FormSection @submitted="$emit('submit')" class="w-full">
        <template #form>
            <div class="col-span-6">
                <div class="col-span-6">
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
                <InputLabel for="patient">Consultas Pendientes</InputLabel>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="consultation_id"
                    v-model="form.consultation_id"
                >
                    <option value="1">ok ok</option>
                </select>
                <InputError :message="$page.props.errors.consultation_id" />
            </div>

            <div class="col-span-6">
                <InputLabel for="patient">Paquetes Pendientes</InputLabel>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="consultation_id"
                    v-model="form.package_id"
                >
                    <option value="1">ok ok</option>
                </select>
                <InputError :message="$page.props.errors.package_id" />
            </div>
            <div class="col-span-6">
                <InputLabel for="name">Monto a pagar</InputLabel>
                <TextInput
                    type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.amount"
                    id="amount"
                    placeholder="Monto a pagar"
                    required=""
                />
                <InputError :message="$page.props.errors.amount" />
            </div>
            <div class="col-span-6">
                <InputLabel for="name">Referencia de pago</InputLabel>
                <TextInput
                    type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.reference"
                    id="reference"
                    placeholder="Referencia de pago"
                    required=""
                />
                <InputError :message="$page.props.errors.reference" />
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
        return {};
    },

    methods: {
        search_consultations(patient_id) {
            let data = patient_id;
            router.visit("searchconsultation", {
                method: "get",
                data: {
                    patient: "John Doe",
                },
            });
            return;
        },
    },
};
</script>
