<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import ConsultationsForm from "@/Components/Consultations/Form.vue";

const props = defineProps({
    consultation: {
        type: Object,
        required: true,
    },
    patients: {
        type: Object,
        required: true,
    },
    employees: {
        type: Object,
        required: true,
    },
    branches: {
        type: Object,
        required: true,
    },
    updating: {
        type: Boolean,
        required: false,
        default: false,
    },
});

const formConsultation = useForm({
    date: props.consultation.date,
    hour: props.consultation.hour,
    patient_id: props.consultation.patient_id,
    employee_id: props.consultation.employee_id,
    branch_id: props.consultation.branch_id,
    status_payment: props.consultation.status_payment,
    status: props.consultation.status,

    branch_name: props.consultation.branch.name,
});
</script>

<template>
    <Applayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tigh">
                Editar Consulta
            </h1>
            <Link
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                :href="route('consultations.index')"
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
                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                </svg>
            </Link>
        </template>
        <!-- Main Add Branch -->
        <div class="w-[60%] mx-auto rounded-lg border border-gray-200 p-5 m-5">
            <div class="">
                <!--  content -->
                <div
                    class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                >
                    <!--  header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                    >
                        <h3
                            class="text-lg font-semibold text-gray-900 dark:text-white"
                        >
                            Formulario Consulta
                        </h3>
                    </div>

                    <!--componente  -->
                    <ConsultationsForm
                        :updating="true"
                        :branches="branches"
                        :patients="patients"
                        :employees="employees"
                        :form="formConsultation"
                        @submit="
                            formConsultation.put(
                                route('consultations.update', consultation)
                            )
                        "
                    >
                    </ConsultationsForm>
                </div>
            </div>
        </div>

        <!---->
    </Applayout>
</template>

<script>
export default {
    name: "ConsultationsEdit",

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
