<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import EmployeesForm from "@/Components/Employees/Form.vue";

const props = defineProps({
    employee: {
        type: Object,
        required: true,
    },
    positions: {
        type: Object,
        required: true,
    },
});

const formEmployee = useForm({
    fist_name: props.employee.fist_name,
    last_name: props.employee.last_name,
    identification: props.employee.identification,
    position_id: props.employee.position_id,
    position_name: props.employee.position.name,
    phone: props.employee.phone,
    email: props.employee.email,
    contract: props.employee.contract,
    mount: props.employee.mount,
    description: props.employee.description,
    status: props.employee.status,
});
</script>

<template>
    <Applayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tigh">
                Editar Empleado
            </h1>
            <Link
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                :href="route('employees.index')"
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
                            Formulario Empleado
                        </h3>
                    </div>

                    <!-- Modal body -->
                    <EmployeesForm
                        :updating="true"
                        :positions="positions"
                        :form="formEmployee"
                        @submit="
                            formEmployee.put(
                                route('employees.update', employee.id)
                            )
                        "
                    >
                    </EmployeesForm>
                </div>
            </div>
        </div>

        <!---->
    </Applayout>
</template>

<script>
export default {
    name: "EmployeesEdit",

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
