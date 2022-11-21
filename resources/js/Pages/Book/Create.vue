<script lang="ts">
import BaseLayout from '@/Layouts/BaseLayout.vue';
import { Teleport } from 'vue';
export default {
    layout: BaseLayout,
}
</script>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import InputTextWithValidation from '@/Components/InputTextWithValidation.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import { useForm, configure } from 'vee-validate';
import { localize } from '@vee-validate/i18n';

import { defineRule } from 'vee-validate';
import AllRules from '@vee-validate/rules';
import * as ja from '@vee-validate/i18n/dist/locale/ja.json';

Object.keys(AllRules).forEach(rule => {
  defineRule(rule, AllRules[rule]);
});
localize({ ja });

configure({
  generateMessage: localize('ja', {
    messages: {
      tel:'{field}のフォーマットが正しくありません',
    },
  }),
});

const labelValues = {
    name: '作名',
    author:'作者',
    price:'値段',
};

const initialValues = {
    name: '',
    author:'',
    price:'',
};

const schema = {
    name: 'required|max:50',
    author: 'required|max:50',
    price: 'required|max:50',

};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


// サブミットメソッド
const onSubmit = handleSubmit(async (values, actions) => {
    Inertia.post(route('book.store'), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});

</script>

<template>

    <Head title="本の追加" />
    <div class="flex justify-content-center">
        <form @submit="onSubmit">
            <Card style="width: 25em">
                <template #header>
                </template>
                <template #title>
                    本の新規追加
                </template>
                <template #subtitle>

                </template>
                <template #content>
                    <InputTextWithValidation name="name" :label="labelValues.name" :isRequired="true" piClass="building" />
                    <InputTextWithValidation name="author" :label="labelValues.author" :isRequired="true" piClass="building" />
                    <InputTextWithValidation name="price" :label="labelValues.price" :isRequired="true" piClass="building" />
                </template>
                <template #footer>
                    <Button type="submit" :disabled="isSubmitting" icon="pi pi-check" label="登録" />
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
