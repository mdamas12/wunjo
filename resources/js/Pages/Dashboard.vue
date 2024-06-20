<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { Head, Link } from "@inertiajs/vue3";
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
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

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <div v-if="$page.props.auth.user">
        <AppLayout title="Dashboard">
            <template #header>
                <span class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </span>
            </template>

            <div>
                <div class="mx-auto sm:px-6 lg:px-8">
                    <div class="">
                        <Welcome
                            :ConsultationsPending="ConsultationsPending"
                            :PaymentPending="PaymentPending"
                        />
                    </div>
                </div>
            </div>
        </AppLayout>
    </div>
    <div v-else><h1>hola no hay sesion abierta</h1></div>
</template>
