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
    code: '学校コード',
    name: '学校名',
    short_name: '略称',
    zip_code: '郵便番号',
    address: '住所',
    reception_finish_time : '当日バス予約締切時間',
    phone_number: '予約締切後電話番号',
};

const initialValues = {
    school_group_id: '',
    code: '',
    name: '',
    short_name: '',
    zip_code: '',
    address: '',
    reception_finish_time: '',
    phone_number: '',
};

const schema = {
    school_group_id: 'required',
    code: 'required|alpha_num|min:3|max:20',
    name: 'required|max:100',
    short_name: 'required|max:10',
    zip_code: 'regex:[0-9]{3}-[0-9]{4}',
    address: 'max:255',
    reception_finish_time: '',
    // phone_number: 'tel',
    phone_number: '',

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
                    <DropdownWithValidation name="school_group_id" :label="labelValues.school_group_id" :isRequired="true" :options="school_groups"/>
                    <InputTextWithValidation name="code" :label="labelValues.code" :isRequired="true"/>
                    <InputTextWithValidation name="name" :label="labelValues.name" :isRequired="true"/>
                    <InputTextWithValidation name="short_name" :label="labelValues.short_name" :isRequired="true"/>
                    <InputTextWithValidation name="zip_code" :label="labelValues.zip_code" />
                    <InputTextWithValidation name="address" :label="labelValues.address" />
                    <InputTextWithValidation name="phone_number" :label="labelValues.phone_number" />

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
