<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

import PackageForm from "@/Components/Packages/Form.vue";

defineProps({
    success_message: {
        type: String,
        required: false,
    },
    packages: {
        type: Object,
        required: true,
    },
    patients: {
        type: String,
        required: false,
    },
    services: {
        type: String,
        required: false,
    },
});

const deletePackage = (package_patient) => {
    const formchange = useForm({
        id: package_patient.id,
        date: package_patient.date,
        patient_id: package_patient.patient_id,
        service_id: package_patient.service_id,
        made_quantity: package_patient.made_quantity,
        status: "DELETED",
    });

    if (confirm("estas seguro que deseas eliminar este Consulta?")) {
        //console.log(consultation);
        formchange.post(route("changestatuspackage"), {
            onError: () => {
                console.log(formchange.errors);
                return "existen errores en los datos";
            },
            onSuccess: () => {
                alert("El paquete ha sido elimnado");
            },
        });
        //Inertia.post(route("changestatus", consultation));
    }
};
</script>

<template>
    <Applayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tigh">
                Paquetes de Clientes
                {{ success_message }}
            </h1>
            <Link :href="route('packages.create')" class="w-full">
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
                    <line x1="9" y1="12" x2="15" y2="12" />
                    <line x1="12" y1="9" x2="12" y2="15" />
                    <path
                        d="M4 6v-1a1 1 0 0 1 1 -1h1m5 0h2m5 0h1a1 1 0 0 1 1 1v1m0 5v2m0 5v1a1 1 0 0 1 -1 1h-1m-5 0h-2m-5 0h-1a1 1 0 0 1 -1 -1v-1m0 -5v-2m0 -5"
                    />
                </svg>
            </Link>
        </template>
        <div class="w-[80%] mx-auto rounded-lg border border-gray-200 p-5 m-5">
            <div class="overflow-x-auto rounded-t-lg p-t-50">
                <table
                    class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                >
                    <thead class="text-white">
                        <tr
                            class="bg-cyan-600 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                        >
                            <th class="p-3 text-center">Fecha</th>
                            <th class="p-3 text-center">Paciente</th>
                            <th class="p-3 text-center">Paquete</th>
                            <th class="p-3 text-center">Sesiones</th>
                            <th class="p-3 text-center">Status</th>
                            <th class="p-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody
                        v-for="package_patient in packages.data"
                        class="flex-1 sm:flex-none"
                    >
                        <tr
                            class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
                        >
                            <td
                                class="text-center border-grey-light border hover:bg-gray-100 p-3"
                            >
                                {{ package_patient.date }}
                            </td>
                            <td
                                class="text-center border-grey-light border hover:bg-gray-100 p-3"
                            >
                                {{ package_patient.patient.fist_name }}
                                {{ package_patient.patient.last_name }}
                            </td>
                            <td
                                class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                            >
                                {{ package_patient.service.name }}
                            </td>

                            <td
                                class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                            >
                                {{ package_patient.made_quantity }}
                            </td>

                            <td
                                class="text-center border-grey-light border hover:bg-gray-100 p-3 truncate"
                            >
                                {{ package_patient.status }}
                            </td>
                            <td
                                class="text-center border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer"
                            >
                                <Link
                                    :href="
                                        route(
                                            'packages.show',
                                            package_patient.id
                                        )
                                    "
                                    class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >
                                    <svg
                                        class="h-4 w-4 text-white-700"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <circle cx="11" cy="11" r="8" />
                                        <line
                                            x1="21"
                                            y1="21"
                                            x2="16.65"
                                            y2="16.65"
                                        />
                                    </svg>
                                </Link>

                                <Link
                                    :href="
                                        route(
                                            'packages.edit',
                                            package_patient.id
                                        )
                                    "
                                    class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >
                                    <svg
                                        class="h-4 w-4 text-white-700"
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
                                        <path d="M12 20h9" />
                                        <path
                                            d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"
                                        />
                                    </svg>
                                    <span class="sr-only">Edit</span>
                                </Link>

                                <button
                                    @click="deletePackage(package_patient)"
                                    class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >
                                    <svg
                                        class="h-4 w-4 text-white-700"
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
                                        <line x1="4" y1="7" x2="20" y2="7" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                        <path
                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"
                                        />
                                        <path
                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"
                                        />
                                    </svg>
                                    <span class="sr-only">Delete</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- nueva tabla-->

            <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
                <ol class="flex justify-end gap-1 text-xs font-medium">
                    <li v-if="packages.current_page > 1">
                        <Link
                            :href="packages.prev_page_url"
                            class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180"
                        >
                            <span class="sr-only">Prev Page</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-3 w-3"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </Link>
                    </li>

                    <li v-if="packages.current_page < packages.last_page">
                        <Link
                            :href="packages.next_page_url"
                            class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180"
                        >
                            <span class="sr-only">Next Page</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-3 w-3"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </Link>
                    </li>
                </ol>
            </div>
        </div>

        <!--Ajustes y pruebas -->

        <!-- Detalle del paquete -->
        <div
            id="defaultd-modal"
            tabindex="-1"
            aria-hidden="true"
            v-show="modalDetail"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
        >
            <div class="mx-auto relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div
                    class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                >
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                    >
                        <h3
                            class="text-xl font-semibold text-gray-900 dark:text-white"
                        >
                            Informacion del Paquete
                        </h3>
                        <button
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            @click="closeDetail()"
                        >
                            <svg
                                class="w-3 h-3"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 14 14"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->

                    {{ datax.patient }}
                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <p>fecha</p>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ datax.date }}
                        </p>
                    </div>
                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <p>Paciente</p>
                        {{ datax.patient }}

                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        ></p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Paquete</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        ></p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Sesiones Realizadas</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ datax.made_quantity }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Status</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ datax.status }}
                        </p>
                    </div>
                    <!-- Modal footer -->
                </div>
            </div>
        </div>

        <!---->
    </Applayout>
</template>

<script>
export default {
    name: "PackagesIndex",

    data() {
        return {
            modalDetail: false,
            datax: [],
            position_name: "",
        };
    },

    components: {
        Link,
    },

    async mounted() {},

    methods: {
        open_Detail(package_patient) {
            this.datax = package_patient;
            //this.position_name = this.data.position.name;
            this.modalDetail = true;
            return;
        },

        closeDetail() {
            this.modalDetail = false;
            return;
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
