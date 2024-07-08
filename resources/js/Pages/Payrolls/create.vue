<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import PayrollsForm from "@/Components/Payrolls/Form.vue";

defineProps({
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
});

const form = useForm({
    employee: "",
    date: "",
    amount: 0,
    status: true,
    concept: "",

    payrollsDetails: [],

    payment_methods_id: "",
    amount_pay: 0,
    reference: "",
    capture: null,
});
</script>

<template>
    <wjAppLayout>
        <template #header> </template>
        <!-- Main Add Branch -->
        <div
            class="w-[90%] mx-auto rounded-lg border border-gray-200 p-5 m-5 grid grid-cols-1 gap-3"
        >
            <!--  content -->
            <div
                class="flex-no text-center justify-center mb-5 text-sm md:text-md lg:text-lg md:justify-between lg:justify-between md:flex lg:flex"
            >
                <h1 class="flex text-center font-semibold text-gray-700">
                    Formulario de pago
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
            <div
                class="bg-white rounded-lg shadow dark:bg-gray-700 grid grid-cols-1 gap-3"
            >
                <!--  header -->
                <div
                    class="items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                ></div>
                <!-- Modal body -->
                <PayrollsForm
                    :form="form"
                    :employees="employees"
                    :payment_methods="payment_methods"
                    :therapy="therapy"
                    @submit="form.post(route('payrolls.store'))"
                >
                </PayrollsForm>
            </div>
        </div>

        <!---->
    </wjAppLayout>
</template>

<script>
export default {
    name: "PaymentCreate",

    data() {
        return {};
    },

    methods: {},
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
