<script>
export default {
    name: "EmployeesForm",
};
</script>

<script setup>
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
defineProps({
    form: {
        type: Object,
        required: true,
    },

    positions: {
        type: Object,
        required: true,
    },

    updating: {
        type: Boolean,
        required: false,
        default: false,
    },
});

defineEmits(["submit"]);
</script>

<template>
    <FormSection @submitted="$emit('submit')" class="w-full">
        <template #form>
            <div class="col-span-6">
                <InputLabel for="name">Nombre</InputLabel>
                <TextInput
                    type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.fist_name"
                    id="fist_name"
                    placeholder="Nombre del Empleado"
                    required=""
                />
                <InputError :message="$page.props.errors.first_name" />
            </div>
            <div class="col-span-6">
                <InputLabel for="name">Apellido</InputLabel>
                <TextInput
                    type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.last_name"
                    id="address"
                    placeholder="Apellido del empleado"
                    required=""
                />
                <InputError :message="$page.props.errors.last_name" />
            </div>
            <div class="col-span-6">
                <InputLabel for="name">Identificacion</InputLabel>
                <input
                    type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.identification"
                    id="identification"
                    placeholder="identificacion del empleado"
                    required=""
                />
                <InputError :message="$page.props.errors.identification" />
            </div>
            <div class="col-span-6">
                <InputLabel for="name">Telefono</InputLabel>
                <input
                    type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.phone"
                    id="phone"
                    placeholder="Numero de telefono"
                    required=""
                />
                <InputError :message="$page.props.errors.phone" />
            </div>

            <div class="col-span-6">
                <InputLabel for="name">Email</InputLabel>
                <input
                    type="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.email"
                    id="email"
                    placeholder="Email del empleado"
                    required=""
                />
                <InputError :message="$page.props.errors.email" />
            </div>

            <div class="col-span-6">
                <InputLabel for="name">Posicion</InputLabel>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="position_id"
                    v-model="form.position_id"
                >
                    <option :value="form.position_id">
                        {{ form.position_name }}
                    </option>

                    <option v-for="position in positions" :value="position.id">
                        {{ position.name }}
                    </option>
                </select>
                <InputError :message="$page.props.errors.position_id" />
            </div>

            <div class="col-span-6">
                <InputLabel for="name">Contrato</InputLabel>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="contract"
                    v-model="form.contract"
                >
                    <option value="FIJO">Fijo</option>
                    <option value="PORCENTUAL">Porcentual</option>
                </select>
                <InputError :message="$page.props.errors.contract" />
            </div>
            <div class="col-span-6">
                <InputLabel for="name">Monto</InputLabel>
                <input
                    type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.mount"
                    id="mount"
                    placeholder="monto"
                    required=""
                />
                <InputError :message="$page.props.errors.amount" />
            </div>
            <div class="col-span-6">
                <InputLabel for="status">Status</InputLabel>
                <select
                    id="status"
                    v-model="form.status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                >
                    <option selected="">Selecciona un estado</option>
                    <option value="true">Activo</option>
                    <option value="false">Inactivo</option>
                </select>
                <InputError :message="$page.props.errors.status" />
            </div>
            <div class="col-span-6">
                <InputLabel for="description">Descripcion</InputLabel>
                <textarea
                    id="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.description"
                    rows="4"
                    placeholder="Descripcion de la nueva sucursal"
                ></textarea>
                <InputError :message="$page.props.errors.description" />
            </div>
        </template>

        <template #actions>
            <PrimaryButton
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                <svg
                    class="me-1 -ms-1 w-5 h-5"
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
                {{ updating ? "Actualizar" : "Crear Nueva" }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
