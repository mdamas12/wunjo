<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
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
    <Applayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tigh">
                Sedes
            </h1>
            <Link
                v-if="$page.props.user['roles'] == 'supra'"
                :href="route('branches.create')"
                class="w-full"
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
                    class="min-w-full mx-auto divide-y-2 divide-gray-200 text-sm"
                >
                    <thead class="ltr:text-left rtl:text-right bg-cyan-600">
                        <tr class="">
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-gray-100"
                            >
                                Nombre
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-100"
                            >
                                Direccion
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-100"
                            >
                                Telefono
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-100"
                            >
                                Status
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-100"
                            >
                                Accion
                            </th>
                        </tr>
                    </thead>

                    <tbody
                        class="divide-y divide-gray-200 mx-auto"
                        v-for="branch in branches.data"
                    >
                        <tr class="justify-items-center">
                            <td
                                class="text-center whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ branch.name }}
                            </td>
                            <td
                                class="text-center whitespace-nowrap px-4 py-2 text-gray-700"
                            >
                                {{ branch.address }}
                            </td>
                            <td
                                class="text-center whitespace-nowrap px-4 py-2 text-gray-700"
                            >
                                {{ branch.phone }}
                            </td>
                            <td
                                v-if="branch.status == 'true'"
                                class="text-center whitespace-nowrap px-4 py-2 text-gray-700"
                            >
                                ACTIVA
                            </td>
                            <td
                                v-if="branch.status == 'false'"
                                class="text-center whitespace-nowrap px-4 py-2 text-gray-700"
                            >
                                INACTIVA
                            </td>
                            <td
                                class="text-center whitespace-nowrap px-4 py-2 text-gray-700"
                            >
                                <Link
                                    v-if="$page.props.user['roles'] == 'supra'"
                                    :href="route('branches.edit', branch.id)"
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
                                    @click="deleteBranch(branch.id)"
                                    class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    v-if="$page.props.user['roles'] == 'supra'"
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

            <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
                <ol class="flex justify-end gap-1 text-xs font-medium">
                    <li v-if="branches.current_page > 1">
                        <Link
                            :href="branches.prev_page_url"
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

                    <li v-if="branches.current_page < branches.last_page">
                        <Link
                            :href="branches.next_page_url"
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

        <!---->
    </Applayout>
</template>

<script>
export default {
    name: "BranchesIndex",

    data() {
        return {
            addBranch: false,
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
</style>
