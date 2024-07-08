<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import BranchForm from "@/Components/Branches/Form.vue";

defineProps({
    branches: {
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

const deleteBranch = (id) => {
    if (confirm("estas seguro que deseas eliminar esta sede?")) {
        Inertia.delete(route("branches.destroy", id));
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
                    Sedes
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
                                :href="route('branches.create')"
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
                                Nueva Sede
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
                            v-for="(branch, index) in branches.data"
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
                                Direccion
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Telefono
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
                        </tr>
                    </thead>

                    <tbody class="flex-1 sm:flex-none md:flex-none">
                        <tr
                            v-for="(branch, index) in branches.data"
                            class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 md:text-xs lg:text-md"
                        >
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ branch.name }}
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ branch.address }}
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ branch.phone }}
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                v-if="branch.status == 'true'"
                            >
                                ACTIVA
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                                v-if="branch.status == 'false'"
                            >
                                INACTIVA
                            </td>
                            <td
                                class="text-xs text-center content-center wrap border-grey-light border hover:bg-gray-100 p-1 h-14 md:text-xs md:w-9 lg:text-md"
                            >
                                <Link
                                    v-if="$page.props.user['roles'] == 'supra'"
                                    :href="route('branches.edit', branch.id)"
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
                                    @click="deleteBranch(branch.id)"
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
                            v-if="branches.current_page > 1"
                            :href="branches.prev_page_url"
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
                            v-if="branches.current_page < branches.last_page"
                            :href="branches.next_page_url"
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
                                >{{ branches.from }}-{{ branches.to }}</span
                            >
                            De
                            <span
                                class="font-semibold text-gray-900 dark:text-white"
                                >{{ branches.total }}</span
                            ></span
                        >
                    </div>
                </div>
                <!-- END PAGINAIION-->
            </div>
        </div>

        <!--Ajustes y pruebas -->

        <!---->
    </wjAppLayout>
</template>

<script>
export default {
    name: "BranchesIndex",

    data() {
        return {
            addBranch: false,
            sede: "",
        };
    },

    methods: {
        open_addbranch() {
            this.addBranch = true;
            return;
        },

        close_addBranch() {
            this.addBranch = false;
            return;
        },
    },
};
</script>
<style>
.b_edit {
    background-color: aquamarine;
    color: antiquewhite;
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
