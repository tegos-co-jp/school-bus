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
import CalendarWithValidation from '@/Components/CalendarWithValidation.vue';
import InputSwitchWithValidation from '@/components/InputSwitchWithValidation.vue';
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
    schools: Array,
});

const labelValues = {
    school_id: '学校',
    year: '年度',
    start_on: '開始日',
    end_on: '終了日',
    this_year: '当年度',
};

const initialValues = {
    school_id: '',
    year: '',
    start_on: '',
    end_on: '',
    this_year: '',
};

const schema = {
    school_id: 'required',
    year: 'required|between:2020,2030',
    start_on: 'required',
    end_on: 'required',
    this_year: 'required',

};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


// サブミットメソッド
const onSubmit = handleSubmit(async (values, actions) => {
    console.log("YearCreate",values);
    Inertia.post(route('schoolYear.store'), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});

</script>

<template>

    <Head title="年度作成" />
    <div class="flex justify-content-center">
        <form @submit="onSubmit">
            <Card style="width: 25em">
                <template #header>
                </template>
                <template #title>
                    年度の新規登録
                </template>
                <template #subtitle>

                </template>
                <template #content>
                    <DropdownWithValidation name="school_id" :label="labelValues.school_id" :isRequired="true" :options="schools"/>
                    <InputTextWithValidation name="year" :label="labelValues.year" :isRequired="true"/>
                    <CalendarWithValidation name="start_on" :label="labelValues.start_on" :isRequired="true"/>
                    <CalendarWithValidation name="end_on" :label="labelValues.end_on" :isRequired="true" />
                    <InputSwitchWithValidation name="this_year" :label="labelValues.this_year" :isRequired="true" />

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
