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
    school_year: Object,
});

const form = useForm({
    id: props.school_year.id,
    school_id: props.school_year.school_id,
    year: props.school_year.year,
    start_on: props.school_year.start_on,
    end_on: props.school_year.end_on,
    this_year: props.school_year.this_year,
});

</script>

<template>
<Head title="年度更新" />
<div class="flex justify-content-center">
    <form @submit.prevent="" >
        <Card style="width: 25em">
            <template #header>
            </template>
            <template #title>
                年度の表示
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
                        <InputText id="year" v-model="form.year.$model"  class="w-full readonly"/>
                        <InputLabel for="year" columnTitle="年度" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="start_on" v-model="form.start_on"  class="w-full readonly"/>
                        <InputLabel for="start_on" columnTitle="開始日" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="end_on" v-model="form.end_on"  class="w-full readonly"/>
                        <InputLabel for="end_on" columnTitle="終了日" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="this_year" v-model="form.this_year"  class="w-full readonly"/>
                        <InputLabel for="this_year" columnTitle="当年度" />
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