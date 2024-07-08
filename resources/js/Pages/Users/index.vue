<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { router } from "@inertiajs/vue3";

defineProps({
    users: {
        type: Object,
        required: true,
    },
    roles: {
        type: Object,
        required: true,
    },
});

const deleteUser = (id) => {
    if (confirm("estas seguro que deseas eliminar este usuario?")) {
        Inertia.delete(route("users.destroy", id));
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
                    Usuarios
                </h1>
            </div>
            <div
                class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700"
            >
                <div class="w-full mb-1">
                    <div class="sm:flex">
                        <div
                            class="items-center mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700"
                        >
                            <div>
                                <label class="sr-only">Search</label>
                                <div class="relative mt-1 lg:w-64 xl:w-96">
                                    <input
                                        v-on:keyup.enter="
                                            goTosearchUser(searchuser)
                                        "
                                        type="text"
                                        name="user"
                                        id="users-search"
                                        v-model="searchuser"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Buscar usuarios"
                                    />
                                </div>
                            </div>
                            <div
                                class="flex pl-0 mt-3 space-x-1 sm:pl-2 sm:mt-0"
                            >
                                <button
                                    @click="goTosearchUser(searchuser)"
                                    class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                >
                                    <svg
                                        class="h-8 w-8 text-gray-500"
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
                                        <line x1="11" y1="8" x2="11" y2="14" />
                                        <line x1="8" y1="11" x2="14" y2="11" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div
                            v-if="$page.props.user['roles'] == 'supra'"
                            class="flex items-center ml-auto space-x-2 sm:space-x-3"
                        >
                            <Link
                                :href="route('users.create')"
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
                                Nuevo usuario
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-auto rounded-lg shadow p-4">
                <table
                    class="md:table-fixed w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5 overflow-auto"
                >
                    <thead class="text-white">
                        <tr
                            v-for="(user, index) in userslist.data"
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
                                Email
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Role
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
                            v-for="(user, index) in userslist.data"
                            class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 md:text-xs lg:text-md"
                        >
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ user.name }}
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ user.email }}
                            </td>

                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md overflow-auto"
                            >
                                {{ RoleUser(user.id) }}
                            </td>

                            <td
                                class="text-xs text-center content-center wrap border-grey-light border hover:bg-gray-100 p-1 h-14 md:text-xs md:w-9 lg:text-md"
                            >
                                <Link
                                    v-if="$page.props.user['roles'] == 'supra'"
                                    :href="route('users.edit', user.id)"
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
                                    @click="deleteUser(user.id)"
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
            </div>

            <div
                class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700"
            >
                <div class="flex items-center mb-4 sm:mb-0">
                    <Link
                        v-if="userslist.current_page > 1"
                        :href="userslist.prev_page_url"
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
                        v-if="userslist.current_page < userslist.last_page"
                        :href="userslist.next_page_url"
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
                            >{{ userslist.from }}-{{ userslist.to }}</span
                        >
                        De
                        <span
                            class="font-semibold text-gray-900 dark:text-white"
                            >{{ userslist.total }}</span
                        ></span
                    >
                </div>
            </div>
        </div>
    </wjAppLayout>
</template>

<script>
export default {
    name: "Usersindex",

    data() {
        return {
            addBranch: false,
            serviceDetail: false,
            serviceData: [],
            roleuser: [],
            userrole: "",
            searchuser: "",
            userslist: [],
        };
    },
    mounted() {
        this.userslist = this.users;
    },

    methods: {
        RoleUser(user) {
            let role = "";
            this.roles.forEach((item, index) => {
                if (item.model_id == user) {
                    role = item.rolesystem["name"];
                }
            });
            return role;
        },
        goTosearchUser(user) {
            if (user == "") {
                this.userslist = this.users;
                return;
            }
            router.visit("users/searchuser", {
                method: "post",
                data: {
                    user: user,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: (resp) => {
                    this.searchuser = "";
                    this.userslist = resp.props.jetstream.flash.userfound;
                },
                onError: (errors) => {
                    console.log("erros");
                },
            });
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
