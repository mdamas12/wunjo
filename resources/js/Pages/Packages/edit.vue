<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import PackageForm from "@/Components/Packages/Form.vue";

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
    service_name: props.patient_package.service_name,
    made_quantity: props.patient_package.made_quantity,
    date: props.patient_package.date,
    status: props.patient_package.status,
    status_payment: props.patient_package.status_payment,
});
</script>

<template>
    <wjAppLayout>
        <template #header> </template>
        <!-- Main Add Branch -->
        <div class="w-[90%] mx-auto rounded-lg border border-gray-200 p-5 m-5">
            <div class="flex justify-between mb-5">
                <h1
                    class="flex font-semibold text-xl text-gray-700 leading-tigh"
                >
                    Editar Paquete
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
                <div
                    class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                >
                    <!--  header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                    ></div>

                    <!--componente  -->
                    <PackageForm
                        :updating="true"
                        :patients="patients"
                        :services="services"
                        :form="formPackage"
                        @submit="
                            formPackage.put(
                                route('packages.update', patient_package.id)
                            )
                        "
                    >
                    </PackageForm>
                </div>
            </div>
        </div>

        <!---->
    </wjAppLayout>
</template>

<script>
export default {
    name: "PackagesEdit",

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
