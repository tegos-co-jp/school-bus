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
import ZipCodeInputTextWithValidation from '@/components/InputTextWithValidationZipCode.vue';
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

const props = defineProps({
    school_group: Object,
});

const labelValues = {
    code: 'コード',
    name: '名称',
    zip_code: '郵便番号',
    address: '住所',
    representative_name: '代表者氏名',
    phone_number: '電話番号',
    email: 'メールアドレス',
};

const initialValues = {
    id: props.school_group.id,
    code: props.school_group.code,
    name: props.school_group.name,
};

const schema = {
    code: 'required|alpha_num|min:3|max:20',
    name: 'required|max:100',

};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


// サブミットメソッド
const onSubmit = handleSubmit(async (values, actions) => {
    Inertia.patch(route('schoolGroup.update', initialValues.id), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});
</script>

<template>

    <Head title="教育委員会更新" />
    <div class="flex justify-content-center">
        <form @submit="onSubmit">
            <Card style="width: 25em">
                <template #header>
                </template>
                <template #title>
                    教育委員会の修正
                </template>
                <template #subtitle>

                </template>
                <template #content>
                    <InputTextWithValidation name="code" :label="labelValues.code" :isRequired="true" piClass="tag" />
                    <InputTextWithValidation name="name" :label="labelValues.name" :isRequired="true" piClass="building" />

                </template>
                <template #footer>
                    <Button type="submit" icon="pi pi-check" label="更新" />
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
