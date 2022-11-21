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
import DropdownWithValidation from '@/components/DropdownWithValidation.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import { useForm, configure } from 'vee-validate';
import { localize } from '@vee-validate/i18n';
import validateFunction from '@/Common/validateRule';

validateFunction();

configure({
  generateMessage: localize('ja', {
    messages: {
      tel:'{field}のフォーマットが正しくありません',
    },
  }),
});

const props = defineProps({
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
    school_group_id: '',
    name: '',
    email: '',
    authority_flag: '',
    password: '',
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
    Inertia.post(route('controlManager.store'), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});

</script>

<template>

    <Head title="統括責任者作成" />
    <div class="flex justify-content-center">
        <form @submit="onSubmit">
            <Card style="width: 25em">
                <template #header>
                </template>
                <template #title>
                    統括責任者の新規登録
                </template>
                <template #subtitle>

                </template>
                <template #content>
                    <DropdownWithValidation name="school_group_id" :label="labelValues.school_group_id" :isRequired="true" :options="school_groups"/>
                    <InputTextWithValidation name="name" :label="labelValues.name" :isRequired="true"/>
                    <InputTextWithValidation name="email" :label="labelValues.email" :isRequired="true"/>
                    <InputTextWithValidation name="authority_flag" :label="labelValues.authority_flag" :isRequired="true"/>
                    <InputTextWithValidation name="password" :label="labelValues.password" :isRequired="true"/>                    
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
