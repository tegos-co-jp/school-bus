<script lang="ts">
import BaseLayout from '@/Layouts/BaseLayout.vue';
export default {
    layout: BaseLayout,
}
</script>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import InputTextWithValidation from '@/components/InputTextWithValidation.vue';
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
    },
  }),
});

const labelValues = {
    code: '学校コード',
    name: '学校名',
    zip_code: '郵便番号',
    address: '住所',
    representative_name: '代表者氏名',
    phone_number: '電話番号',
    email: 'メールアドレス',
};

const initialValues = {
    code: '',
    name: '',
    zip_code: '',
    address: '',
    representative_name: '',
    phone_number: '',
    email: '',
};

const schema = {
    code: 'required|min:3|max:20',
    name: 'required|max:100',
    zip_code: 'regex:/^[0-9]{3}-[0-9]{4}$/',
    address: 'max:255',
    representative_name: 'max:20',
    // phone_number: 'regex:/(^0(\d-\d{4}|\d{2}-\d{3}|\d{3}-\d{2}|\d{4}-\d)-\d{4}$|^(050|070|080|090)-\d{4}-\d{4}$|^0120-\d{3}-\d{3}$)/',
    email: 'required|email',

};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


// サブミットメソッド
const onSubmit = handleSubmit(async (values, actions) => {
    Inertia.post(route('school.store'), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});

</script>

<template>

    <Head title="学校作成" />
    <div class="flex justify-content-center">
        <form @submit="onSubmit">
            <Card style="width: 25em">
                <template #header>
                </template>
                <template #title>
                    学校の新規登録
                </template>
                <template #subtitle>

                </template>
                <template #content>
                    <InputTextWithValidation name="code" :label="labelValues.code" :isRequired="true" piClass="tag" />
                    <InputTextWithValidation name="name" :label="labelValues.name" :isRequired="true"
                        piClass="building" />
                    <InputTextWithValidation name="zip_code" :label="labelValues.zip_code" :isRequired="true"
                        piClass="flag" />
                    <InputTextWithValidation name="address" :label="labelValues.address" :isRequired="true"
                        piClass="globe" />
                    <InputTextWithValidation name="representative_name" :label="labelValues.representative_name"
                        :isRequired="true" piClass="user" />
                    <InputTextWithValidation name="phone_number" :label="labelValues.phone_number" :isRequired="true"
                        piClass="phone" />
                    <InputTextWithValidation name="email" :label="labelValues.email" :isRequired="true"
                        piClass="envelope" />

                </template>
                <template #footer>
                    <Button type="submit" icon="pi pi-check" label="登録" />
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
