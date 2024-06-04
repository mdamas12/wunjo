<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                Welcome to your wunjo Dashboard application!
            </h1>
        </div>
        <div>
            <!--{{ $page.props }} -->
            <button v-if="$page.props.user.permissions.includes('create_role')">
                Roles
            </button>
            <button
                v-if="$page.props.user.permissions.includes('create_clinic')"
            >
                Clinica
            </button>
            <button
                v-if="$page.props.user.permissions.includes('create_branch')"
            >
                Sucursales
            </button>
        </div>
    </div>
</template>
<style>
button {
    background-color: rgb(7, 120, 63);
    color: #fff;
    padding: 10px;
    margin: 10px;
}
</style>
