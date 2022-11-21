<script setup lang="ts">
import { onMounted, onUnmounted } from "vue";

import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Toolbar from 'primevue/toolbar';

import Menubar from 'primevue/menubar';
import Button from 'primevue/button';
import SplitButton from 'primevue/splitbutton';
import Menu from 'primevue/menu';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";

onMounted(() => {
    console.log("Kaji TEST Mount Layout");
});
onUnmounted(() => {
    console.log("Kaji TEST UnMount Layout");
});
const user_menu = ref([
    {
                label:'Edit',
                icon:'pi pi-fw pi-user-edit',

            },
            {
                label:'sign out',
                icon:'pi pi-fw pi-sign-out',
                command: () => {
                    Inertia.post(route("logout"));
                },
            },
]);
const items = ref([
    {
        label:'学校',
        icon:'pi pi-fw pi-building',
        items:[
            {
                label:'教育委員会',
                icon:'pi pi-fw pi-list',
                command: () => {
                    Inertia.get(route("schoolGroup.index"));
                },
            },
            {
                label:'学校',
                icon:'pi pi-fw pi-plus',
                command: () => {
                    Inertia.get(route("school.index"));
                },
            },
            {
                label:'機能',
                icon:'pi pi-fw pi-plus',
                command: () => {
                    Inertia.get(route("feature.index"));
                },
            },
        ]
    },
]);
</script>

<template>
    <div>
        <Toolbar>
            <template #start>
                <Link :href="route('dashboard')">
                    <ApplicationLogo />
                </Link>
                <span>スクールバス</span>
            </template>
            <template #end>
                
                <SplitButton :label="$page.props.auth.user.name" icon="pi pi-user" :model="user_menu" class="p-button-info"></SplitButton>
            </template>
        </Toolbar>
        <div class="flex">
            <Menu :model="items" />
            <main>
                <slot />
            </main>
        </div>


    </div>
</template>
