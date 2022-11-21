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
import CheckboxWithValidation from '@/components/CheckboxWithValidation.vue';
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
    school_year: Object,
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
    id: props.school_year.id,
    school_id: props.school_year.school_id,
    year: props.school_year.year,
    start_on: props.school_year.start_on,
    end_on: props.school_year.end_on,
    this_year: props.school_year.this_year,
};

const schema = {
    school_id: 'required',
    year: 'required',
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
    Inertia.patch(route('schoolYear.update', initialValues.id), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});
</script>

<template>

    <Head title="年度更新" />
    <div class="flex justify-content-center">
        <form @submit="onSubmit">
            <Card style="width: 25em">
                <template #header>
                </template>
                <template #title>
                    年度の修正
                </template>
                <template #subtitle>

                </template>
                <template #content>
                    <DropdownWithValidation name="school_id" :label="labelValues.school_id" :isRequired="true" :options="schools"/>
                    <InputTextWithValidation name="year" :label="labelValues.year" :isRequired="true"/>
                    <InputTextWithValidation name="start_on" :label="labelValues.start_on" :isRequired="true"/>
                    <InputTextWithValidation name="end_on" :label="labelValues.end_on" :isRequired="true"/>
                    <CheckboxWithValidation name="this_year" :label="labelValues.this_year" :isRequired="true"/>

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
