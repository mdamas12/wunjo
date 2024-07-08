<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import PackagesForm from "@/Components/Consultations/Form.vue";

const props = defineProps({
    patient_package: {
        type: Object,
        required: true,
    },
    patients: {
        type: Object,
        required: true,
    },
    services: {
        type: Object,
        required: true,
    },
    updating: {
        type: Boolean,
        required: false,
        default: false,
    },
});

const formPackage = useForm({
    patient_id: props.patient_package.patient_id,
    service_id: props.patient_package.service_id,
    made_quantity: props.patient_package.made_quantity,
    date: props.patient_package.date,
    status: props.patient_package.status,
    /*Relaciones*/
    patient_fullname:
        props.patient_package.patient.fist_name +
        " " +
        props.patient_package.patient.last_name,
    service_name: props.patient_package.service.name,
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
                    Paquete
                </h1>
                <Link
                    :href="route('packages.index')"
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
            <div class="">
                <!--  content -->
                <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                    <h3>Fecha</h3>
                    <p
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        {{ patient_package.date }}
                    </p>
                </div>
                <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                    <h3>Paciente</h3>

                    <p
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        {{ patient_package.patient.fist_name }}
                        {{ patient_package.patient.last_name }}
                    </p>
                </div>

                <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                    <h3>Paquete</h3>
                    <p
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        {{ patient_package.service.name }}
                    </p>
                </div>

                <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                    <h3>Sesiones Realizadas</h3>
                    <p
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        {{ patient_package.made_quantity }}
                    </p>
                </div>

                <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                    <h3>Status</h3>
                    <p
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        {{ patient_package.status }}
                    </p>
                </div>
            </div>
        </div>

        <!---->
    </wjAppLayout>
</template>

<script>
export default {
    name: "PackageShow",

    data() {
        return {};
    },

    methods: {},
};
</script>
<style>
.b_edit {
    background-color: aquamarine;
    color: antiquewhite;
}
</style>
