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
import ZipCodeInputTextWithValidation from '@/components/InputTextWithValidationZipCode.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import { useForm, configure } from 'vee-validate';
import { localize } from '@vee-validate/i18n';
import validateFunction from '@/Common/validateRule';

validateFunction();

configure({
  generateMessage: localize('ja', {
    messages: {
    },
  }),
});

const props = defineProps({
    school: Object,
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
    id: props.school.id,
    school_group_id: props.school.school_group_id,
    code: props.school.code,
    name: props.school.name,
    short_name: props.school.short_name,
    zip_code: props.school.zip_code,
    address: props.school.address,
    reception_finish_time: props.school.reception_finish_time,
    phone_number: props.school.phone_number,
};

const schema = {
    school_group_id: 'required',
    code: 'required|alpha_num|min:3|max:20',
    name: 'required|max:100',
    short_name: 'required|max:10',
    zip_code: 'required|regex:[0-9]{3}-[0-9]{4}',
    address: 'max:255',
    reception_finish_time: '',
    phone_number: 'tel',

};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


// サブミットメソッド
const onSubmit = handleSubmit(async (values, actions) => {
    Inertia.patch(route('school.update', initialValues.id), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});
</script>

<template>

    <Head title="学校更新" />
    <div class="flex justify-content-center">
        <form @submit="onSubmit">
            <Card style="width: 25em">
                <template #header>
                </template>
                <template #title>
                    学校の修正
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
