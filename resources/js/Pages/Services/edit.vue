<script setup>
import Applayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import ServicesForm from "@/Components/Services/Form.vue";

const props = defineProps({
    service: {
        type: Object,
        required: true,
    },
});

const formAdd = useForm({
    name: props.service.name,
    price: props.service.price,
    quantity: props.service.quantity,
    description: props.service.description,
    type: props.service.type,
    status: props.service.status,
});
</script>

<template>
    <Applayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tigh">
                Editar Servicio
            </h1>
            <Link
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                :href="route('services.index')"
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
                            Formulario Servicio
                        </h3>
                    </div>

                    <!-- Modal body -->
                    <ServicesForm
                        :updating="true"
                        :form="formAdd"
                        @submit="
                            formAdd.put(route('services.update', service.id))
                        "
                    >
                    </ServicesForm>
                </div>
            </div>
        </div>

        <!---->
    </Applayout>
</template>

<script>
export default {
    name: "ServicesEdit",

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
