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
    roles: {
        type: Object,
        required: true,
    },

    branches: {
        type: Object,
        required: true,
    },
    userbranch: {
        type: Object,
        required: false,
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
    <FormSection @submitted="Formvalidate()" class="w-full">
        <template #form>
            <div class="col-span-6">
                <InputLabel for="name">Nombre</InputLabel>
                <TextInput
                    type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.name"
                    id="name"
                    placeholder="Nombre de usuario"
                    required=""
                />
                <InputError :message="$page.props.errors.name" />
            </div>

            <div class="col-span-6">
                <InputLabel for="email">email</InputLabel>
                <input
                    type="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.email"
                    id="email"
                    placeholder="Email"
                    required=""
                />
                <InputError :message="$page.props.errors.email" />
            </div>
            <div class="col-span-6">
                <InputLabel for="status">Role</InputLabel>
                <select
                    id="role"
                    v-model="form.UserRole"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    @change="BranchValidate()"
                >
                    <option v-for="role in roles" :value="role.name">
                        {{ role.name }}
                    </option>
                </select>
                <InputError :message="$page.props.errors.role" />
            </div>
            <div class="p-1 grid grid-cols-1 gap-2">
                <div
                    v-if="updating == false"
                    class="p-1 grid grid-cols-1 gap-2"
                >
                    <InputLabel for="name">Seleccionar las sedes</InputLabel>
                    <table
                        class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                    >
                        <thead class="text-white">
                            <tr
                                class="bg-gray-200 text-gray-500 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                            >
                                <th class="p-3 text-center">Sede</th>
                                <th class="p-3 text-center">Seleccionar</th>
                            </tr>
                        </thead>

                        <tbody
                            v-for="(branch, index) in branches"
                            class="flex-1 sm:flex-none"
                        >
                            <tr
                                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
                            >
                                <td
                                    class="text-center border-grey-light border p-3"
                                >
                                    {{ branch.name }}
                                </td>
                                <td
                                    class="text-center border-grey-light border p-3 truncate"
                                >
                                    <input
                                        type="checkbox"
                                        v-model="branch.checked"
                                        @change="
                                            branchCheck(
                                                branch.checked,
                                                branch.id
                                            )
                                        "
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- editions-->
                <div v-if="updating == true" class="p-1 grid grid-cols-1 gap-2">
                    <InputLabel for="name">Seleccionar las sedes</InputLabel>
                    <table
                        class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                    >
                        <thead class="text-white">
                            <tr
                                class="bg-gray-200 text-gray-500 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                            >
                                <th class="p-3 text-center">Sede</th>
                                <th class="p-3 text-center">Seleccionar</th>
                            </tr>
                        </thead>

                        <tbody
                            v-for="(branch, index) in brancheslist"
                            class="flex-1 sm:flex-none"
                        >
                            <tr
                                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
                            >
                                <td
                                    class="text-center border-grey-light border p-3"
                                >
                                    {{ branch.name }}
                                </td>
                                <td
                                    class="text-center border-grey-light border p-3 truncate"
                                >
                                    <input
                                        type="checkbox"
                                        v-model="branch.checked"
                                        @change="
                                            branchCheck(
                                                branch.checked,
                                                branch.id
                                            )
                                        "
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div v-if="updating == false" class="col-span-6">
                <InputLabel for="name">Password</InputLabel>
                <input
                    type="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="form.password"
                    id="password"
                    placeholder="password"
                    required=""
                />
                <InputError :message="$page.props.errors.password" />
            </div>
            <div v-if="updating == false" class="col-span-6">
                <InputLabel for="name">Password confirm</InputLabel>
                <input
                    type="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    v-model="confirmPass"
                    id="confirmPass"
                    placeholder="password confirm"
                    required=""
                />
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
                {{ updating ? "Actualizar" : "Crear Nuevo" }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
<script>
export default {
    name: "UsersForm",
    data() {
        return {
            UserRole: "",
            userBranches: [],
            confirmPass: "",
            brancheslist: [],
        };
    },
    mounted() {
        // console.log(this.session);
        if (this.updating == true) {
            this.brancheslist = this.branches;
            this.brancheslist.forEach((branch, i) => {
                this.form.userBranches.forEach((item, j) => {
                    if (item.branch_id == branch.id) {
                        this.brancheslist[i].checked = true;
                    }
                });
            });
        }
        // console.log(this.form.userBranches);
    },
    methods: {
        BranchValidate() {
            // alert(this.UserRole);
        },
        branchCheck(checkValue, branch) {
            // console.log(checkValue + " " + branch);
            if (checkValue == true) {
                let data = {
                    branch_id: branch,
                };
                this.form.userBranches.push(data);
            } else {
                this.form.userBranches.forEach((item, index) => {
                    if (item.branch_id == branch) {
                        this.form.userBranches.splice(index, 1);
                    }
                });
            }
            //console.log(this.form.userBranches);
        },
        Formvalidate() {
            if (this.form.name == "") {
                alert("Debes agegar un nombre al usuario");
                return;
            }
            if (this.form.email == "") {
                alert("Debes agegar un email al usuario");
                return;
            }
            if (this.form.UserRole == "") {
                alert("Debes agegar un role al usuario");
                return;
            }
            if (this.form.userBranches.length == 0) {
                alert("Debes agegar una sede al usuario");
                return;
            }
            if (this.updating == false) {
                if (this.form.password == "") {
                    alert("Debes agegar una constraseña al usuario");
                    return;
                }

                if (this.form.password != this.confirmPass) {
                    alert("La contraseña y su confirmacion deben de coincidir");
                    return;
                }
                return this.$emit("submit");
            } else {
                return this.$emit("submit");
            }
        },
    },
};
</script>
