<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
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
    <Applayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tigh mb-3">
                Detalle del paquete
                {{ patient_package.date }}
            </h1>
            <Link
                :href="route('packages.index')"
                class="inline-flex items-center justify-center mx-2 text-base font-medium text-gray-600 rounded-lg bg-slate-50 hover:text-gray-900 hover:bg-slate-200 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white border-double border-4 border-cyan-600"
            >
                <svg
                    class="h-8 w-8 text-cyan-600"
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
                    <line x1="4" y1="12" x2="14" y2="12" />
                    <line x1="4" y1="12" x2="8" y2="16" />
                    <line x1="4" y1="12" x2="8" y2="8" />
                    <line x1="20" y1="4" x2="20" y2="20" />
                </svg>
                <span class="w-full">Volver</span>
            </Link>

            <Link
                :href="route('packages.edit', patient_package.id)"
                class="inline-flex items-center justify-center mx-2 text-base font-medium text-gray-600 rounded-lg bg-slate-50 hover:text-gray-900 hover:bg-slate-200 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white border-double border-4 border-cyan-600"
            >
                <svg
                    class="h-8 w-8 text-cyan-600"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path
                        d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                    />
                    <path
                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                    />
                </svg>
                <span class="w-full">Editar</span>
            </Link>

            <Link
                href="#"
                class="inline-flex items-center justify-center mx-2 text-base font-medium text-gray-600 rounded-lg bg-slate-50 hover:text-gray-900 hover:bg-slate-200 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white border-double border-4 border-cyan-600"
            >
                <svg
                    class="h-8 w-8 text-cyan-600"
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
                    <rect x="3" y="5" width="18" height="14" rx="3" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                    <line x1="7" y1="15" x2="7.01" y2="15" />
                    <line x1="11" y1="15" x2="13" y2="15" />
                </svg>
                <span class="w-full">Pagar</span>
            </Link>
        </template>
        <!-- Main Add Branch -->
        <div class="w-[80%] mx-auto rounded-lg border border-gray-200 p-5 m-5">
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
    </Applayout>
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
