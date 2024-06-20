<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
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
    <Applayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tigh">
                Editar Paquete de cliente
            </h1>
            <Link
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                :href="route('packages.index')"
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
        <div class="w-[60%] mx-auto rounded-lg border border-gray-200 p-5 m-5">
            <div class="">
                <!--  content -->
                <div
                    class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                >
                    <!--  header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                    >
                        <h3
                            class="text-lg font-semibold text-gray-900 dark:text-white"
                        >
                            Formulario Paquete
                        </h3>
                    </div>

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
    </Applayout>
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
