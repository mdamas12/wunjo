<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { router } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
        required: false,
    },
    canRegister: {
        type: Boolean,
        required: false,
    },
    laravelVersion: {
        type: String,
        required: false,
    },
    phpVersion: {
        type: String,
        required: false,
    },

    ConsultationsPending: {
        type: Object,
        required: false,
    },

    PaymentPending: {
        type: Object,
        required: false,
    },
});
</script>

<template>
    {{ userRole }}
    {{ userSede }}
    <div
        class="grid grid lg:grid-cols-1 md:grid-cols-1 sm:grid-cols-1 gap-2 p-5"
    >
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-10">
            <div class="bg-white border-b border-gray-200">
                <h1 class="mt-1 font-medium text-gray-900 :sm text-xs">
                    Consultas Pendientes para hoy:
                </h1>

                <p>{{ msg_consultList }}</p>
            </div>
            <div class="overflow-x-auto rounded-t-lg p-t-50">
                <table
                    class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                >
                    <thead
                        class="lg:text-md md:text-md sm:text-sm text-white text-center"
                    >
                        <tr
                            class="bg-cyan-600 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0 px-2"
                        >
                            <th>Sede</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Paciente</th>
                            <th>Asignado A</th>
                        </tr>
                    </thead>
                    <tbody
                        v-for="consultation in ConsultationsPending"
                        class="flex-1 sm:flex-none"
                    >
                        <tr
                            class="flex flex-col flex-no sm:table-row mb-2 sm:mb-0 text-center"
                        >
                            <td
                                class="xl:text-sm md:text-sm sm:text-sm border-grey-light border hover:bg-gray-100 truncate"
                            >
                                {{ consultation.branch.name }}
                            </td>
                            <td
                                class="xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"
                            >
                                {{ changeFormat(consultation.date) }}
                            </td>
                            <td
                                class="xl:text-sm md:text-sm sm:text-sm border-grey-light border hover:bg-gray-100 truncate"
                            >
                                {{ consultation.hour }}
                            </td>

                            <td
                                class="xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"
                            >
                                {{ consultation.patient.fist_name }}
                                {{ consultation.patient.last_name }}
                            </td>

                            <td
                                class="xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"
                            >
                                {{ consultation.employee.fist_name }}
                                {{ consultation.employee.last_name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-10">
            <div class="bg-white border-b border-gray-200">
                <h1 class="mt-1 font-medium text-gray-700 :sm text-xs">
                    Consultas Pendientes por Cancelar:
                </h1>
                <p>{{ msg_pending }}</p>
            </div>
            <div class="overflow-x-auto rounded-t-lg p-t-50">
                <table
                    class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                >
                    <thead
                        class="lg:text-md md:text-md sm:text-sm text-white text-center"
                    >
                        <tr
                            class="bg-cyan-600 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0 px-2"
                        >
                            <th>Sede</th>
                            <th>Fecha</th>
                            <th>Paciente</th>
                            <th>Asignado A</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody
                        v-for="consultation in PaymentPending"
                        class="flex-1 sm:flex-none text-center"
                    >
                        <tr
                            class="flex flex-col flex-no sm:table-row mb-2 sm:mb-0"
                        >
                            <td
                                class="xl:text-sm md:text-sm sm:text-sm border-grey-light border hover:bg-gray-100 truncate"
                            >
                                {{ consultation.branch.name }}
                            </td>
                            <td
                                class="xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"
                            >
                                {{ changeFormat(consultation.date) }}
                            </td>

                            <td
                                class="xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"
                            >
                                {{ consultation.patient.fist_name }}
                                {{ consultation.patient.last_name }}
                            </td>

                            <td
                                class="xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"
                            >
                                {{ consultation.employee.fist_name }}
                                {{ consultation.employee.last_name }}
                            </td>
                            <td
                                class="xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"
                            >
                                {{ consultation.amount }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DashboarWolcome",

    data() {
        return {
            modalDetail: false,
            consultations: [],
            pendinglist: [],
            position_name: "",
            msg_consultList: "",
            msg_pending: "",
            userRole: [],
            userSede: [],
        };
    },

    components: {
        Link,
    },

    async mounted() {
        this.userRole = this.$page.props.auth.user.roles[0].name;
        this.userSede = this.$page.props.auth.user.id;
        /*  router.visit("consultations/loadlist", {
            method: "post",
            preserveState: true,
            preserveScroll: true,
            onSuccess: (resp) => {
                this.consultations =
                    resp.props.jetstream.flash.ConsultationsList;
                if (this.consultations.length == 0) {
                    this.msg_consultList =
                        "No hay consultas registradas para el dia de hoy";
                }

                router.visit("consultations/pendingpay", {
                    method: "post",
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (resp) => {
                        this.pendinglist =
                            resp.props.jetstream.flash.pendinglist;
                        if (this.pendinglist.length == 0) {
                            this.msg_pending =
                                "No hay consultas pendientepor cancelar";
                        }
                    },
                    onError: (errors) => {
                        console.log("erros");
                    },
                });
            },
            onError: (errors) => {
                console.log("erros");
            },
        }); */
    },

    methods: {
        changeFormat(date) {
            let newdate = date.split("-");
            return newdate[2] + "/" + newdate[1] + "/" + newdate[0];
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

@media (max-width: 480px) {
    table {
        font-size: 10px;
    }

    .title-card {
        font-size: 14px;
    }
}

td:not(:last-child) {
    border-bottom: 0;
}

th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}
</style>
