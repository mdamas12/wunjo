<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(
        route("current-team.update"),
        {
            team_id: team.id,
        },
        {
            preserveState: false,
        }
    );
};

const logout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="h-screen w-full bg-white flex overflow-hidden">
            <!-- Logo Dash 
            <div
                class="h-20 w-15 mx-1 flex items-center justify-center rounded-lg cursor-pointer hover:text-gray-800 hover:bg-white hover:duration-300 hover:ease-linear focus:bg-white"
            >
                <Link :href="route('dashboard')">
                    <ApplicationMark class="block h-9 w-auto" />
                </Link>
            </div>
-->
            <div class="grid-cols-2 bg-gray-800">
                <div class="h-20 w-auto mx-1 flex items-center justify-center">
                    <Link :href="route('dashboard')">
                        <ApplicationMark class="block h-9 w-auto" />
                    </Link>
                </div>
                <nav
                    class="navpro h-full w-auto flex flex-col space-y-1 md:space-y-10 lg:space-y-10 items-left bg-gray-800 text-white p-2 overflow-x-hidden overflow-y-auto shadow px-3"
                >
                    <!--CONSULTAS-->
                    <div
                        id="consultas"
                        class="flex items-left justify-left cursor-pointer hover:duration-300 hover:ease-linear"
                    >
                        <NavLink
                            class="flex items-left justify-left"
                            :href="route('consultations.index')"
                            :active="route().current('consultations.*')"
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
                                <rect
                                    x="4"
                                    y="5"
                                    width="16"
                                    height="16"
                                    rx="2"
                                />
                                <line x1="16" y1="3" x2="16" y2="7" />
                                <line x1="8" y1="3" x2="8" y2="7" />
                                <line x1="4" y1="11" x2="20" y2="11" />
                                <line x1="10" y1="16" x2="14" y2="16" />
                                <line x1="12" y1="14" x2="12" y2="18" />
                            </svg>
                            <span
                                class="text-sm hidden md:block lg:block lg:text-md mx-1 text-white"
                                >Consultas</span
                            >
                        </NavLink>
                    </div>
                    <!-- PACIENTES -->
                    <div
                        id="pacientes"
                        class="flex items-left justify-left cursor-pointer hover:duration-300 hover:ease-linear"
                        v-if="
                            $page.props.user['roles'] == 'supra' ||
                            $page.props.user['roles'] == 'administrator'
                        "
                    >
                        <NavLink
                            class="flex items-left justify-left"
                            :href="route('patients.index')"
                            :active="route().current('patients.*')"
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
                                <circle cx="17" cy="6" r="2" />
                                <path d="M9 11a4.97 4.97 0 1 0 3.95 7.95" />
                                <path d="M19 20l-4 -5h-4l3 -5l-4 -3l-4 1" />
                            </svg>
                            <span
                                class="text-sm hidden md:block lg:block lg:text-md mx-1 text-white"
                                >Pacientes</span
                            >
                        </NavLink>
                    </div>

                    <!--PAGOS-->
                    <div
                        id="pagos"
                        class="flex items-left justify-left cursor-pointer hover:duration-300 hover:border-b-2 hover:border-white"
                        v-if="
                            $page.props.user['roles'] == 'supra' ||
                            $page.props.user['roles'] == 'administrator'
                        "
                    >
                        <Dropdown class="mx-2">
                            <template #trigger>
                                <button
                                    type="button"
                                    class="h-10 w-auto flex items-center text-white justify-center"
                                >
                                    <svg
                                        class="h-6 w-6 text-white"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>

                                    <span
                                        class="text-sm hidden md:block lg:block lg:text-md mx-1 text-white"
                                        >Pagos</span
                                    >
                                </button>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Control de Pagos
                                </div>

                                <DropdownLink
                                    v-if="
                                        $page.props.user.permissions.includes(
                                            'read_package'
                                        )
                                    "
                                    :href="route('packages.index')"
                                    :active="route().current('packages.*')"
                                >
                                    Paquetes
                                </DropdownLink>
                                <DropdownLink
                                    v-if="
                                        $page.props.user.permissions.includes(
                                            'read_payment'
                                        )
                                    "
                                    :href="route('payments.index')"
                                    :active="route().current('payments.*')"
                                >
                                    Recibidos
                                </DropdownLink>
                                <DropdownLink
                                    v-if="
                                        $page.props.user.permissions.includes(
                                            'read_payment'
                                        )
                                    "
                                    :href="route('payrolls.index')"
                                    :active="route().current('payrolls.*')"
                                >
                                    Empleados
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>

                    <!-- EMPLEADOS -->
                    <div
                        id="empleados"
                        class="flex items-left justify-left cursor-pointer hover:duration-300 hover:ease-linear"
                        v-if="
                            $page.props.user['roles'] == 'supra' ||
                            $page.props.user['roles'] == 'administrator'
                        "
                    >
                        <NavLink
                            class="flex items-left justify-left"
                            :href="route('employees.index')"
                            :active="route().current('employees.*')"
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
                                <circle cx="9" cy="7" r="4" />
                                <path
                                    d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"
                                />
                                <line x1="19" y1="7" x2="19" y2="10" />
                                <line x1="19" y1="14" x2="19" y2="14.01" />
                            </svg>

                            <span
                                class="text-sm hidden md:block lg:block lg:text-md mx-1 text-white"
                                >Empleados</span
                            >
                        </NavLink>
                    </div>

                    <!-- REPORTES 
                    <div
                        id="reportes"
                        class="flex items-left justify-left cursor-pointer hover:duration-300 hover:ease-linear"
                    >
                        <NavLink
                            class="flex items-left justify-left"
                            :href="route('consultations.index')"
                            :active="route().current('consultations.*')"
                        >
                            <svg
                                class="h-6 w-6 text-white"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path
                                    d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                                />
                                <polyline points="14 2 14 8 20 8" />
                                <line x1="16" y1="13" x2="8" y2="13" />
                                <line x1="16" y1="17" x2="8" y2="17" />
                                <polyline points="10 9 9 9 8 9" />
                            </svg>
                            <span
                                class="text-sm hidden md:block lg:block lg:text-md mx-1 text-white"
                                >Reportes</span
                            >
                        </NavLink>
                    </div>
                    -->
                    <!--Ajustes-->
                    <div
                        id="ajustes"
                        class="flex items-left justify-left cursor-pointer hover:duration-300 hover:border-b-2 hover:border-white"
                    >
                        <Dropdown class="mx-2">
                            <template #trigger>
                                <button
                                    type="button"
                                    class="h-10 w-auto flex items-center text-white justify-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                    </svg>
                                    <span
                                        class="text-sm hidden md:block lg:block lg:text-md mx-1 text-white"
                                        >Ajustes</span
                                    >
                                </button>
                            </template>

                            <template #content>
                                <!-- configurations -->
                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Ajustes del Centro
                                </div>

                                <DropdownLink
                                    v-if="
                                        $page.props.user.permissions.includes(
                                            'read_branch'
                                        )
                                    "
                                    :href="route('branches.index')"
                                    :active="route().current('branches.*')"
                                >
                                    Sedes
                                </DropdownLink>
                                <DropdownLink
                                    v-if="
                                        $page.props.user.permissions.includes(
                                            'read_service'
                                        )
                                    "
                                    :href="route('services.index')"
                                    :active="route().current('services.*')"
                                >
                                    Servicios
                                </DropdownLink>

                                <DropdownLink
                                    v-if="$page.props.user['roles'] == 'supra'"
                                    :href="route('users.index')"
                                    :active="route().current('users.*')"
                                >
                                    Usuarios
                                </DropdownLink>

                                <!-- Authentication -->
                                <DropdownLink :href="route('profile.show')">
                                    Mi Perfil
                                </DropdownLink>
                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">
                                        Cerrar Sesion
                                    </DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </div>
                </nav>
            </div>
            <div class="w-full h-full flex flex-col justify-between">
                <!-- Header -->
                <header
                    v-if="$slots.header"
                    class="h-16 w-full flex items-center relative justify-end px-5 space-x-10 bg-gray-800"
                >
                    <!-- Informação -->
                    <div
                        class="flex flex-shrink-0 items-center space-x-4 text-white"
                    >
                        <!-- Texto -->
                        <div class="flex flex-col items-end">
                            <!-- Nome -->
                            <div class="text-md font-medium">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <!-- Título -->
                            <div class="text-sm font-regular">
                                {{ $page.props.user["roles"][0] }}
                            </div>
                        </div>

                        <!-- Profile -->
                        <div
                            class="h-10 w-10 flex items-center justify-center rounded-lg cursor-pointer hover:text-gray-800 hover:bg-white hover:duration-300 hover:ease-linear focus:bg-white"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                    </div>
                </header>

                <!-- Main -->
                <main class="w-full h-full flex relative overflow-auto">
                    <!-- Container -->
                    <div class="h-full w-full m-2 p-5">
                        <!-- Container -->

                        <slot />
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
<style>
@media (max-width: 710px) {
    .navpro {
        align-items: center;
        align-content: center;
    }
    .nav-label {
        display: none;
    }
}
</style>
