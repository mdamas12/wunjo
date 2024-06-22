<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
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
    <Applayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tigh">
                Registrar Pago de empleado
            </h1>
            <Link
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                :href="route('payrolls.index')"
            >
                <svg
                    class="h-10 w-10 text-cyan-700"
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
                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                </svg>
            </Link>
        </template>
        <!-- Main Add Branch -->
        <div
            class="w-[60%] mx-auto rounded-lg border border-gray-200 p-5 m-5 grid grid-cols-1 gap-3"
        >
            <!--  content -->
            <div
                class="bg-white rounded-lg shadow dark:bg-gray-700 grid grid-cols-1 gap-3"
            >
                <!--  header -->
                <div
                    class="items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                >
                    <h3
                        class="text-lg font-semibold text-gray-900 dark:text-white"
                    >
                        Formulario de pago
                    </h3>
                </div>
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
    </Applayout>
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
