<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import BranchForm from "@/Components/Branches/Form.vue";

defineProps({
    services: {
        type: Object,
        required: true,
    },
});

const formAdd = useForm({
    name: "",
    address: "",
    email: "",
    phone: "",
    description: "",
    status: false,
});

const deleteService = (id) => {
    if (confirm("estas seguro que deseas eliminar este servicio?")) {
        Inertia.delete(route("services.destroy", id));
    }
};
</script>

<template>
    <wjAppLayout>
        <template #header> </template>
        <div class="w-[90%] mx-auto rounded-lg border border-gray-200 p-5 m-5">
            <div class="flex justify-between mb-5">
                <h1
                    class="flex font-semibold text-md text-gray-700 leading-tigh"
                >
                    Servicios
                </h1>
            </div>
            <!-- PANEL INDEX -->
            <div
                class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700"
            >
                <div class="w-full mb-1">
                    <div class="sm:flex">
                        <div
                            v-if="
                                $page.props.user['roles'] == 'supra' ||
                                $page.props.user['roles'] == 'administrator'
                            "
                            class="flex items-center ml-auto space-x-2 sm:space-x-3"
                        >
                            <Link
                                :href="route('services.create')"
                                class="w-full inline-flex mx-3 items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                <svg
                                    class="w-5 h-5 mr-2 -ml-1"
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
                                Nuevo Servicio
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <!--END PANEL INDEX-->
            <div class="overflow-auto rounded-t-lg">
                <table
                    class="md:table-fixed w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5 overflow-auto"
                >
                    <thead class="text-white">
                        <tr
                            v-for="(service, index) in services.data"
                            class="bg-cyan-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                        >
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Nombre
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Tipo
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Precio
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Status
                            </th>
                            <th
                                class="text-xs text-center wrap p-1 h-14 text-left md:text-xs md:w-10 lg:text-md"
                            >
                                A1
                            </th>
                            <th
                                class="text-xs text-center wrap p-1 h-14 text-left md:text-xs md:w-10 lg:text-md"
                            >
                                A2
                            </th>
                            <th
                                class="text-xs text-center wrap p-1 h-14 text-left md:text-xs md:w-10 lg:text-md"
                            >
                                A3
                            </th>
                        </tr>
                    </thead>
                    <tbody class="flex-1 sm:flex-none md:flex-none">
                        <tr
                            v-for="(service, index) in services.data"
                            class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 md:text-xs lg:text-md"
                        >
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ service.name }}
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ service.type }}
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ service.price }}
                            </td>

                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{
                                    service.status == "true"
                                        ? "ACTIVO"
                                        : "INACTIVO"
                                }}
                            </td>
                            <td
                                class="text-xs text-center content-center wrap border-grey-light border hover:bg-gray-100 p-1 h-14 md:text-xs md:w-9 lg:text-md"
                            >
                                <button
                                    @click="open_DetailService(service)"
                                    class="inline-flex text-md p-1 font-medium text-center text-white bg-sky-500 rounded-lg hover:bg-sky-700 focus:ring-4 focus:ring-sky-300 dark:focus:ring-sky-900"
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
                                </button>
                            </td>
                            <td
                                class="text-xs text-center content-center wrap border-grey-light border hover:bg-gray-100 p-1 h-14 md:text-xs md:w-9 lg:text-md"
                            >
                                <Link
                                    v-if="$page.props.user['roles'] == 'supra'"
                                    :href="route('services.edit', service.id)"
                                    class="inline-flex text-md p-1 font-medium text-center text-white bg-yellow-500 rounded-lg hover:bg-yellow-700 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
                                >
                                    <svg
                                        class="w-4 h-4"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                                        ></path>
                                        <path
                                            fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </Link>
                            </td>
                            <td
                                class="text-xs text-center content-center wrap border-grey-light border hover:bg-gray-100 p-1 h-14 md:text-xs md:w-9 lg:text-md"
                            >
                                <button
                                    v-if="$page.props.user['roles'] == 'supra'"
                                    @click="deleteService(service.id)"
                                    type="button"
                                    class="inline-flex items-center p-1 font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
                                >
                                    <svg
                                        class="w-4 h-4"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- PAGINAIION-->
                <div
                    class="bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between"
                >
                    <div class="flex items-center mb-4 sm:mb-0">
                        <Link
                            v-if="services.current_page > 1"
                            :href="services.prev_page_url"
                            class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <svg
                                class="w-7 h-7"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </Link>
                        <Link
                            v-if="services.current_page < services.last_page"
                            :href="services.next_page_url"
                            class="inline-flex justify-center p-1 mr-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <svg
                                class="w-7 h-7"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </Link>
                        <span
                            class="text-sm font-normal text-gray-500 dark:text-gray-400"
                            >Mostrando
                            <span
                                class="font-semibold text-gray-900 dark:text-white"
                                >{{ services.from }}-{{ services.to }}</span
                            >
                            De
                            <span
                                class="font-semibold text-gray-900 dark:text-white"
                                >{{ services.total }}</span
                            ></span
                        >
                    </div>
                </div>
                <!-- END PAGINAIION-->
            </div>

            <!-- nueva tabla-->

            <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
                <ol class="flex justify-end gap-1 text-xs font-medium">
                    <li v-if="services.current_page > 1">
                        <Link
                            :href="services.prev_page_url"
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

                    <li v-if="services.current_page < services.last_page">
                        <Link
                            :href="services.next_page_url"
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

        <!-- Detalle de Servicio -->
        <div
            id="default-modal"
            tabindex="-1"
            aria-hidden="true"
            v-show="serviceDetail"
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
                            Datos del Servicio
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
                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <p>Nombre</p>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ serviceData.name }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Descripcion</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ serviceData.description }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Precio</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ serviceData.price }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Sesiones</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ serviceData.quantity }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Status</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{
                                serviceData.status == "true"
                                    ? "ACTIVO"
                                    : "INACTIVO"
                            }}
                        </p>
                    </div>
                    <!-- Modal footer -->
                </div>
            </div>
        </div>

        <!---->
    </wjAppLayout>
</template>

<script>
export default {
    name: "ServicesIndex",

    data() {
        return {
            addBranch: false,
            serviceDetail: false,
            serviceData: [],
        };
    },

    methods: {
        open_DetailService(service) {
            this.serviceData = service;
            this.serviceDetail = true;
            return;
        },

        closeDetail() {
            this.serviceDetail = false;
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

.protable thead {
    background-color: #f1f5f9;
}

.protable thead tr th {
    letter-spacing: 0.03em;

    font-size: 0.875rem;
    line-height: 1.75rem;
}

.protable tbody tr {
}

.protable tbody tr td {
    padding: 2px;
    text-align: center;
    color: #374151;
    font-size: 1rem;
    font-weight: 300;
}

@media (max-width: 770px) {
    .protable thead tr th {
        font-size: 0.85rem;
        line-height: 1rem;
    }

    .protable tbody tr td {
        font-size: 0.75rem;
        font-weight: 300;
    }
}

@media (max-width: 500px) {
    .protable thead tr th {
        font-size: 0.6rem;
        line-height: 1rem;
    }

    .protable tbody tr td {
        font-size: 0.6rem;
        font-weight: 300;
    }
}
</style>
