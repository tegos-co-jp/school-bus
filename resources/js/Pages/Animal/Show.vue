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
    animal: Object,
});

const form = useForm({
    id: props.animal.id,
    name: props.animal.name,
    ago: props.animal.ago,
    gender: props.animal.gender,
});

</script>

<template>
<Head title="ペットの表示" />
<div class="flex justify-content-center">
    <form @submit.prevent="" >
        <Card style="width: 25em">
            <template #header>
            </template>
            <template #title>
                ペットの表示
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
                        <InputLabel for="name" columnTitle="名前" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="ago" v-model="form.ago.$model"  class="w-full readonly"/>
                        <InputLabel for="ago" columnTitle="年齢" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="gender" v-model="form.gender.$model"  class="w-full readonly"/>
                        <InputLabel for="gender" columnTitle="性別" />
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