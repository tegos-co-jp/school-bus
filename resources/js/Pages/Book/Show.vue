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
    book: Object,
});

const form = useForm({
    id: props.book.id,
    name: props.book.name,
    author: props.book.author,
    price: props.book.price,
});

</script>

<template>
<Head title="作名の表示" />
<div class="flex justify-content-center">
    <form @submit.prevent="" >
        <Card style="width: 25em">
            <template #header>
            </template>
            <template #title>
                作名の表示
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
                        <InputLabel for="name" columnTitle="作名" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="author" v-model="form.author.$model"  class="w-full readonly"/>
                        <InputLabel for="author" columnTitle="作者名" />
                    </div>
                </div>

                <div class="field">
                    <div class="p-float-label">
                        <InputText id="price" v-model="form.price.$model"  class="w-full readonly"/>
                        <InputLabel for="price" columnTitle="価格" />
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