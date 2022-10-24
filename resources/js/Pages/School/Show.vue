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
    school: Object,
});

const form = useForm({
    id: props.school.id,
    code: props.school.code,
    name: props.school.name,
    zip_code: props.school.zip_code,
    address: props.school.address,
    representative_name: props.school.representative_name,
    phone_number: props.school.phone_number,
    email: props.school.email,
});

</script>

<template>
<Head title="学校更新" />
<div class="flex justify-content-center">
    <form @submit.prevent="" >
        <Card style="width: 25em">
            <template #header>
            </template>
            <template #title>
                学校の表示
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
                        <InputText id="code" v-model="form.code" class="w-full readonly"/>
                        <InputLabel for="code" columnTitle="学校コード"/>
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="name" v-model="form.name.$model"  class="w-full readonly"/>
                        <InputLabel for="name" columnTitle="学校名" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="zip_code" v-model="form.zip_code"  class="w-full readonly"/>
                        <InputLabel for="zip_code" columnTitle="郵便番号" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="address" v-model="form.address"  class="w-full readonly"/>
                        <InputLabel for="address" columnTitle="住所" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="representative_name" v-model="form.representative_name"  class="w-full readonly"/>
                        <InputLabel for="representative_name" columnTitle="代表者氏名" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="phone_number" v-model="form.phone_number"  class="w-full readonly"/>
                        <InputLabel for="phone_number" columnTitle="電話番号" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label p-input-icon-right w-full">
                        <i class="pi pi-envelope" />
                        <InputText id="email" v-model="form.email"  class="w-full readonly"/>
                        <InputLabel for="email" columnTitle="メールアドレス" />
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