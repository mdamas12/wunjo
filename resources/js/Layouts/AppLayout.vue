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

        <div class="min-h-screen items-center">
            <nav class="border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="h-16 items-center content-center">
                        <div class="flex content-center">
                            <!-- Logo -->
                            <div class="flex shrink-0 mb-px">
                                <Link :href="route('dashboard')">
                                    <ApplicationMark class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->

                            <div
                                v-if="
                                    $page.props.user.permissions.includes(
                                        'read_consultation'
                                    )
                                "
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                <NavLink
                                    :href="route('consultations.index')"
                                    :active="route().current('consultations.*')"
                                >
                                    Consultas
                                </NavLink>
                            </div>
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center"
                                v-if="
                                    $page.props.user['roles'] == 'supra' ||
                                    $page.props.user['roles'] ==
                                        'administrator' ||
                                    $page.props.user['roles'] == 'management'
                                "
                            >
                                <Dropdown>
                                    <template #trigger>
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                            :active="
                                                route().current('branches.*')
                                            "
                                        >
                                            Administración

                                            <svg
                                                class="ms-2 -me-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                                />
                                            </svg>
                                        </button>
                                    </template>

                                    <template #content>
                                        <!-- Admin Management -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            Control Administrativo
                                        </div>

                                        <DropdownLink
                                            v-if="
                                                $page.props.user.permissions.includes(
                                                    'read_branch'
                                                )
                                            "
                                            :href="route('branches.index')"
                                            :active="
                                                route().current('branches.*')
                                            "
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
                                            :active="
                                                route().current('services.*')
                                            "
                                        >
                                            Servicios
                                        </DropdownLink>
                                        <DropdownLink
                                            v-if="
                                                $page.props.user.permissions.includes(
                                                    'read_employee'
                                                )
                                            "
                                            :href="route('employees.index')"
                                            :active="
                                                route().current('employees.*')
                                            "
                                        >
                                            Empleados
                                        </DropdownLink>
                                        <DropdownLink
                                            v-if="
                                                $page.props.user.permissions.includes(
                                                    'read_patient'
                                                )
                                            "
                                            :href="route('patients.index')"
                                            :active="
                                                route().current('patients.*')
                                            "
                                        >
                                            Pacientes
                                        </DropdownLink>
                                        <DropdownLink
                                            v-if="
                                                $page.props.user['roles'] ==
                                                'supra'
                                            "
                                            :href="route('users.index')"
                                            :active="route().current('users.*')"
                                        >
                                            Usuarios
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center"
                                v-if="
                                    $page.props.user['roles'] == 'supra' ||
                                    $page.props.user['roles'] ==
                                        'administrator' ||
                                    $page.props.user['roles'] == 'management'
                                "
                            >
                                <Dropdown>
                                    <template #trigger>
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                        >
                                            Contabilidad

                                            <svg
                                                class="ms-2 -me-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                                />
                                            </svg>
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
                                            :active="
                                                route().current('packages.*')
                                            "
                                        >
                                            Paquetes/Promociones
                                        </DropdownLink>
                                        <DropdownLink
                                            v-if="
                                                $page.props.user.permissions.includes(
                                                    'read_payment'
                                                )
                                            "
                                            :href="route('payments.index')"
                                            :active="
                                                route().current('payments.*')
                                            "
                                        >
                                            Pagos Recibidos
                                        </DropdownLink>
                                        <DropdownLink
                                            v-if="
                                                $page.props.user.permissions.includes(
                                                    'read_payment'
                                                )
                                            "
                                            :href="route('payrolls.index')"
                                            :active="
                                                route().current('payrolls.*')
                                            "
                                        >
                                            Pagos empleados
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                            <!-- Acount Settings  -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center"
                            >
                                <Dropdown>
                                    <template #trigger>
                                        <button
                                            v-if="
                                                $page.props.jetstream
                                                    .managesProfilePhotos
                                            "
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                        >
                                            <img
                                                class="h-8 w-8 rounded-full object-cover"
                                                :src="
                                                    $page.props.auth.user
                                                        .profile_photo_url
                                                "
                                                :alt="
                                                    $page.props.auth.user.name
                                                "
                                            />
                                        </button>

                                        <span
                                            v-else
                                            class="inline-flex rounded-md"
                                        >
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            Control de Usiario
                                        </div>

                                        <DropdownLink
                                            :href="route('profile.show')"
                                        >
                                            Mi Perfil
                                        </DropdownLink>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Cerrar Sesion
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 bg-gray-200">
                        <div class="flex items-center px-4">
                            <div
                                v-if="
                                    $page.props.jetstream.managesProfilePhotos
                                "
                                class="shrink-0 me-3"
                            >
                                <img
                                    class="h-10 w-10 rounded-full object-cover"
                                    :src="
                                        $page.props.auth.user.profile_photo_url
                                    "
                                    :alt="$page.props.auth.user.name"
                                />
                            </div>

                            <div class="">
                                <div
                                    class="font-medium text-base text-gray-800"
                                >
                                    Hola, {{ $page.props.auth.user.name }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink
                                v-if="
                                    $page.props.user.permissions.includes(
                                        'read_consultation'
                                    )
                                "
                                :href="route('consultations.index')"
                                :active="route().current('consultations.*')"
                            >
                                Consultas
                            </ResponsiveNavLink>

                            <Dropdown>
                                <template #trigger>
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                        :active="route().current('branches.*')"
                                    >
                                        Administración

                                        <svg
                                            class="ms-2 -me-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                            />
                                        </svg>
                                    </button>
                                </template>

                                <template #content>
                                    <!-- Admin Management -->
                                    <div
                                        class="block px-4 py-2 text-xs text-gray-400"
                                    >
                                        Control Administrativo
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
                                        v-if="
                                            $page.props.user.permissions.includes(
                                                'read_employee'
                                            )
                                        "
                                        :href="route('employees.index')"
                                        :active="route().current('employees.*')"
                                    >
                                        Empleados
                                    </DropdownLink>
                                    <DropdownLink
                                        v-if="
                                            $page.props.user.permissions.includes(
                                                'read_patient'
                                            )
                                        "
                                        :href="route('patients.index')"
                                        :active="route().current('patients.*')"
                                    >
                                        Pacientes
                                    </DropdownLink>
                                    <DropdownLink
                                        v-if="
                                            $page.props.user['roles'] == 'supra'
                                        "
                                        :href="route('users.index')"
                                        :active="route().current('users.*')"
                                    >
                                        Usuarios
                                    </DropdownLink>
                                </template>
                            </Dropdown>

                            <Dropdown>
                                <template #trigger>
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                    >
                                        Contabilidad

                                        <svg
                                            class="ms-2 -me-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                            />
                                        </svg>
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
                                        Paquetes/Promociones
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
                                        Pagos Recibidos
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
                                        Pagos empleados
                                    </DropdownLink>
                                </template>
                            </Dropdown>

                            <ResponsiveNavLink
                                :href="route('profile.show')"
                                :active="route().current('profile.show')"
                            >
                                Mi perfil
                            </ResponsiveNavLink>

                            <ResponsiveNavLink
                                v-if="$page.props.jetstream.hasApiFeatures"
                                :href="route('api-tokens.index')"
                                :active="route().current('api-tokens.index')"
                            >
                                API Tokens
                            </ResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <ResponsiveNavLink as="button">
                                    Cerrar Sesion
                                </ResponsiveNavLink>
                            </form>

                            <!-- Team Management -->
                            <template
                                v-if="$page.props.jetstream.hasTeamFeatures"
                            >
                                <div class="border-t border-gray-200" />

                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <ResponsiveNavLink
                                    :href="
                                        route(
                                            'teams.show',
                                            $page.props.auth.user.current_team
                                        )
                                    "
                                    :active="route().current('teams.show')"
                                >
                                    Team Settings
                                </ResponsiveNavLink>

                                <ResponsiveNavLink
                                    v-if="$page.props.jetstream.canCreateTeams"
                                    :href="route('teams.create')"
                                    :active="route().current('teams.create')"
                                >
                                    Create New Team
                                </ResponsiveNavLink>

                                <!-- Team Switcher -->
                                <template
                                    v-if="
                                        $page.props.auth.user.all_teams.length >
                                        1
                                    "
                                >
                                    <div class="border-t border-gray-200" />

                                    <div
                                        class="block px-4 py-2 text-xs text-gray-400"
                                    >
                                        Switch Teams
                                    </div>

                                    <template
                                        v-for="team in $page.props.auth.user
                                            .all_teams"
                                        :key="team.id"
                                    >
                                        <form
                                            @submit.prevent="switchToTeam(team)"
                                        >
                                            <ResponsiveNavLink as="button">
                                                <div class="flex items-center">
                                                    <svg
                                                        v-if="
                                                            team.id ==
                                                            $page.props.auth
                                                                .user
                                                                .current_team_id
                                                        "
                                                        class="me-2 h-5 w-5 text-green-400"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                        />
                                                    </svg>
                                                    <div>
                                                        {{ team.name }}
                                                    </div>
                                                </div>
                                            </ResponsiveNavLink>
                                        </form>
                                    </template>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
