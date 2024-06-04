<script>
export default {
    name: "ConsultationsForm",
};
</script>

<script setup>
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
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
                        <option v-if="updating == true" :value="form.branch_id">
                            {{ form.branch_name }}
                        </option>
                        <option v-for="branch in branches" :value="branch.id">
                            {{ branch.name }}
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
                        required
                    />
                </div>
                <InputError :message="$page.props.errors.hour" />
            </div>

            <div class="col-span-6">
                <InputLabel for="patient">Paciente</InputLabel>
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
            </div>

            <div class="col-span-6">
                <InputLabel for="employee">Asignar a:</InputLabel>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="position_id"
                    v-model="form.employee_id"
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
                    <option selected="">Selecciona un estado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="realizada">Realizada</option>
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
</template>
