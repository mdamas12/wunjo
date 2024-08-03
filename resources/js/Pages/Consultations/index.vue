<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import wjAppLayout from "@/Layouts/WunjoLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { router } from "@inertiajs/vue3";

import ConsultationForm from "@/Components/Branches/Form.vue";

defineProps({
    consultations_all: {
        type: Object,
        required: true,
    },
    sede: {
        type: String,
        required: false,
    },
    success_message: {
        type: String,
        required: false,
    },
});

const deleteConsultation = (consultation) => {
    const formchange = useForm({
        id: consultation.id,
        date: consultation.date,
        hour: consultation.hour,
        patient_id: consultation.patient_id,
        employee_id: consultation.employee_id,
        branch_id: consultation.branch_id,
        status_payment: consultation.status_payment,
        status: "DELETED",
    });

    if (confirm("estas seguro que deseas eliminar este Consulta?")) {
        //console.log(consultation);
        formchange.post(route("changestatus"), {
            onError: () => {
                console.log(formchange.errors);
                return "existen errores en los datos";
            },
            onSuccess: () => {
                alert("la consulta ha sido elimnada");
            },
        });
        //Inertia.post(route("changestatus", consultation));
    }
};

const StatusConsultation = (consultation) => {
    if (confirm("estas seguro que deseas eliminar este Consulta?")) {
        Inertia.put(route("change", consultation));
    }
};
</script>

<template>
    <wjAppLayout>
        <template #header> </template>
        <div class="w-[100%] mx-auto rounded-lg border border-gray-200 p-5">
            <div class="mb-5">
                <h1 class="font-semibold text-xl text-gray-700 leading-tigh">
                    Consultas
                </h1>
            </div>
            <div class="overflow-auto rounded-lg shadow p-4">
                <!-- PANEL INDEX -->
                <div
                    class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5"
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
                                            type="text"
                                            name="user"
                                            id="patient-search"
                                            v-model="search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Busqueda"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="flex pl-0 mt-3 space-x-1 sm:pl-2 sm:mt-0"
                                >
                                    <button
                                        @click="goTosearch('patient')"
                                        class="inline-flex justify-center border p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                    >
                                        Paciente
                                    </button>
                                </div>
                                <div
                                    class="flex pl-0 mt-3 space-x-1 sm:pl-2 sm:mt-0"
                                >
                                    <button
                                        @click="goTosearch('employee')"
                                        class="inline-flex justify-center border p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                    >
                                        Empleado
                                    </button>
                                </div>
                                <div
                                    class="flex pl-0 mt-3 space-x-1 sm:pl-2 sm:mt-0"
                                >
                                    <button
                                        @click="goTosearch('date')"
                                        class="inline-flex justify-center border p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                    >
                                        Fecha
                                    </button>
                                </div>
                            </div>
                            <div
                                v-if="
                                    $page.props.user['roles'] == 'supra' ||
                                    $page.props.user['roles'] == 'administrator'
                                "
                                class="flex items-center ml-auto space-x-2 sm:space-x-3"
                            >
                                <Link
                                    :href="route('consultations.create')"
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
                                    Nueva Consulta
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END PANEL INDEX-->

                <table
                    class="md:table-fixed w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5 overflow-auto"
                >
                    <thead class="text-white">
                        <tr
                            v-for="(consultation, index) in consultations.data"
                            class="bg-cyan-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                        >
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Sede
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Fecha
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Hora
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Paciente
                            </th>
                            <th
                                class="text-xs text-center wrap p-3 h-14 text-left md:text-xs lg:text-md"
                            >
                                Asignado
                            </th>
                            <th
                                class="text-xs text-center wrap p-1 h-14 text-left md:text-xs md:w-10 lg:text-md"
                            >
                                St
                            </th>
                            <th
                                class="text-xs text-center wrap p-1 h-14 text-left md:text-xs md:w-9 lg:text-md"
                            >
                                A1
                            </th>
                            <th
                                class="text-xs text-center wrap p-1 h-14 text-left md:text-xs md:w-9 lg:text-md"
                            >
                                A2
                            </th>
                            <th
                                class="h-14 text-xs text-center wrap p-1 text-left md:text-xs md:w-9 lg:text-md"
                            >
                                A3
                            </th>
                        </tr>
                    </thead>
                    <tbody class="flex-1 sm:flex-none md:flex-none">
                        <tr
                            v-for="(consultation, index) in consultations.data"
                            class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 md:text-xs lg:text-md"
                        >
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md"
                            >
                                {{ consultation.branch.name }}
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md"
                            >
                                {{ changeFormat(consultation.date) }}
                            </td>
                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md"
                            >
                                {{ consultation.hour }}
                            </td>

                            <td
                                class="text-xs h-14 text-center border-grey-light border p-3 md:text-xs lg:text-md"
                            >
                                {{ consultation.patient.fist_name }}
                                {{ consultation.patient.last_name }}
                            </td>

                            <td
                                class="text-xs text-center wrap border-grey-light border p-3 h-14 md:text-xs lg:text-md"
                            >
                                {{ consultation.employee.fist_name }}
                                {{ consultation.employee.last_name }}
                            </td>

                            <td
                                class="text-xs text-center content-center wrap border-grey-light border p-1 h-14 text-center md:text-xs md:w-10 lg:text-md"
                            >
                                <Link
                                    href="#"
                                    class="inline-flex text-md p-1 font-medium text-center text-white rounded-lg"
                                >
                                    <svg
                                        v-if="
                                            consultation.status == 'REALIZADA'
                                        "
                                        class="h-8 w-8 text-green-600 content-center"
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
                                        <path
                                            d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2"
                                        />
                                        <rect
                                            x="9"
                                            y="3"
                                            width="6"
                                            height="4"
                                            rx="2"
                                        />
                                        <path d="M9 14l2 2l4 -4" />
                                    </svg>

                                    <svg
                                        v-if="
                                            consultation.status == 'PENDIENTE'
                                        "
                                        class="h-7 w-7 text-red-700"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path
                                            d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"
                                        />
                                        <rect
                                            x="8"
                                            y="2"
                                            width="8"
                                            height="4"
                                            rx="1"
                                            ry="1"
                                        />
                                    </svg>
                                </Link>
                            </td>

                            <td
                                class="text-xs text-center content-center wrap border-grey-light border hover:bg-gray-100 p-1 h-14 md:text-xs md:w-9 lg:text-md"
                            >
                                <Link
                                    :href="
                                        route(
                                            'consultations.show',
                                            consultation.id
                                        )
                                    "
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
                                </Link>
                            </td>
                            <td
                                class="text-xs text-center content-center wrap border-grey-light border hover:bg-gray-100 p-1 h-14 md:text-xs md:w-9 lg:text-md"
                            >
                                <Link
                                    v-if="
                                        $page.props.user['roles'] == 'supra' ||
                                        $page.props.user['roles'] ==
                                            'administrator'
                                    "
                                    :href="
                                        route(
                                            'consultations.edit',
                                            consultation.id
                                        )
                                    "
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
                                    v-if="
                                        $page.props.user['roles'] == 'supra' ||
                                        $page.props.user['roles'] ==
                                            'administrator'
                                    "
                                    @click="deleteConsultation(consultation)"
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
            <!-- PAGINAIION-->
            <div
                class="text-gray-800 bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between"
            >
                <div class="text-gray-800 flex items-center mb-4 sm:mb-0">
                    <Link
                        v-if="consultations.current_page > 1"
                        :href="consultations.prev_page_url"
                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100"
                    >
                        <svg
                            class="w-7 h-7 text-gray-80"
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
                        v-if="
                            consultations.current_page < consultations.last_page
                        "
                        :href="consultations.next_page_url"
                        class="inline-flex justify-center p-1 mr-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100"
                    >
                        <svg
                            class="w-7 h-7 text-gray-80"
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
                    <span class="text-sm font-normal text-gray-600"
                        >Mostrando
                        <span class="font-semibold text-gray-800"
                            >{{ consultations.from }}-{{
                                consultations.to
                            }}</span
                        >
                        De
                        <span class="font-semibold text-gray-800">{{
                            consultations.total
                        }}</span></span
                    >
                </div>
            </div>
            <!-- END PAGINAIION-->
        </div>

        <!--Ajustes y pruebas -->

        <!-- Detalle de Servicio -->
        <div
            id="default-modal"
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
                            Informacion del Empleado
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
                            {{ data.fist_name }}
                        </p>
                    </div>
                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <p>Apellido</p>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ data.last_name }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Identificacion</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ data.identification }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Email</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ data.email }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Telefono</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ data.phone }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Posición</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ position_name }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Contrato</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ data.contract }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Monto</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ data.phone }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Descripcion</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ data.description }}
                        </p>
                    </div>

                    <div class="p-4 md:p-5 space-y-4 border-b rounded-t">
                        <h3>Status</h3>
                        <p
                            class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                        >
                            {{ data.status == "true" ? "ACTIVO" : "INACTIVO" }}
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
    name: "ConsultationsIndex",

    data() {
        return {
            modalDetail: false,
            data: [],
            position_name: "",
            search: "",
            consultations: [],
        };
    },

    components: {
        Link,
    },

    async mounted() {
        this.consultations = this.consultations_all;
    },

    methods: {
        async open_Detail(employee) {
            this.data = employee;
            this.position_name = this.data.position.name;
            this.modalDetail = true;
            return;
        },

        closeDetail() {
            this.modalDetail = false;
            return;
        },
        changeFormat(date) {
            let newdate = date.split("-");
            return newdate[2] + "/" + newdate[1] + "/" + newdate[0];
        },
        goTosearch(filter) {
            // alert(filter);
            let data_search = this.search;

            if (filter == "date") {
                let date = data_search.split("/");
                if (date.length <= 1) {
                    alert(
                        "Debes escribir un formato de fecha dd/mm/AAAA, ejemplo: 01/03/2024"
                    );
                    return;
                } else {
                    data_search = date[2] + "-" + date[1] + "-" + date[0];
                }
            }

            router.visit("consultations/filtersearch", {
                method: "post",
                data: {
                    search: data_search,
                    filter: filter,
                },
                preserveState: true,
                preserveScroll: true,

                onSuccess: (resp) => {
                    //this.consultations = resp.props.jetstream.flash.listsearch;
                    let listsearch = resp.props.jetstream.flash.listsearch;
                    this.consultations = listsearch;
                    // console.log(listsearch);
                    return;
                },
                onError: (errors) => {
                    console.log("erros");
                    return;
                },
            });
        },
    },
};
</script>
