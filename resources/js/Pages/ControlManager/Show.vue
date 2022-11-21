<script lang="ts">
import BaseLayout from '@/Layouts/BaseLayout.vue';

export default {
    layout: BaseLayout,
}

</script>


<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputMask from 'primevue/inputmask';
import InputText from 'primevue/inputtext';

import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    controlManager: Object,
});

const form = useForm({
    id: props.controlManager.id,
    name: props.controlManager.name,
    email: props.controlManager.email,
    authority_flag: props.controlManager.authority_flag,
    password: props.controlManager.password,
});

</script>

<template>
<Head title="統括責任者更新" />
<div class="flex justify-content-center">
    <form @submit.prevent="" >
        <Card style="width: 25em">
            <template #header>
            </template>
            <template #title>
                統括責任者の表示
            </template>
            <template #subtitle>
                
            </template>
            <template #content>
                <div class="field">
                    <div class="p-float-label">
                        <InputText id="id" v-model="form.id"  class="w-full" readonly/>
                        <InputLabel for="id" columnTitle="ID" :pInvalid="false"/>
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="name" v-model="form.name.$model"  class="w-full readonly"/>
                        <InputLabel for="name" columnTitle="氏名" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="email" v-model="form.email"  class="w-full readonly"/>
                        <InputLabel for="email" columnTitle="メールアドレス" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="authority_flag" v-model="form.authority_flag"  class="w-full readonly"/>
                        <InputLabel for="authority_flag" columnTitle="管理者権限" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="password" v-model="form.password"  class="w-full readonly"/>
                        <InputLabel for="password" columnTitle="パスワード" />
                    </div>
                </div>

            </template>
            <template #footer>
            </template>
        </Card>
    </form>
</div>
</template>

<style scoped>
.field {
    margin-bottom: 1.5rem;
}
</style>