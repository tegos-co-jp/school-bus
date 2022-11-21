<script lang="ts">
import BaseLayout from '@/Layouts/BaseLayout.vue';
export default {
    layout: BaseLayout,
}
</script>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import InputTextWithValidation from '@/Components/InputTextWithValidation.vue';
import DropdownWithValidation from '@/components/DropdownWithValidation.vue';
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
defineRule('tel', (value, [], ctx) => {
  if (!value || !value.length) {
    return false;
  }
  //-を外して数値のみでチェック
  var custumTel = value.replace(/[━.‐.―.－.-.ー.-]/gi,'');
  if (!custumTel.match(/^(0[5-9]0[0-9]{8}|0[1-9][1-9][0-9]{7})$/)) {
    return false;
  }
  return true;
});
localize({ ja });

configure({
  generateMessage: localize('ja', {
    messages: {
    },
  }),
});

const props = defineProps({
    control_manager: Object,
    school_groups: Array,
});

const labelValues = {
    school_group_id: '教育委員会',
    name: '氏名',
    email: 'メールアドレス',
    authority_flag: '管理者権限',
    password: 'パスワード',
};

const initialValues = {
    id: props.control_manager.id,
    school_group_id: props.control_manager.school_group_id,
    name: props.control_manager.name,
    email: props.control_manager.email,
    authority_flag: props.control_manager.authority_flag,
    password: props.control_manager.password,
};

const schema = {
    school_group_id: 'required',
    name: 'required|max:50',
    email: 'required|max:50',
    authority_flag: 'required',
    password: 'required|max:50',
};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


// サブミットメソッド
const onSubmit = handleSubmit(async (values, actions) => {
    Inertia.patch(route('controlManager.update', initialValues.id), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});
</script>

<template>

    <Head title="統括責任者更新" />
    <div class="flex justify-content-center">
        <form @submit="onSubmit">
            <Card style="width: 25em">
                <template #header>
                </template>
                <template #title>
                    統括責任者の修正
                </template>
                <template #subtitle>

                </template>
                <template #content>
                    <DropdownWithValidation name="school_group_id" :label="labelValues.school_group_id" :isRequired="true" :options="school_groups"/>
                    <InputTextWithValidation name="name" :label="labelValues.name" :isRequired="true" />
                    <InputTextWithValidation name="email" :label="labelValues.email" :isRequired="true" />
                    <InputTextWithValidation name="authority_flag" :label="labelValues.authority_flag" :isRequired="true" />
                    <InputTextWithValidation name="password" :label="labelValues.password" :isRequired="true" />

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
