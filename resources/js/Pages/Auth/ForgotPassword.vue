<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import InputText from 'primevue/inputtext';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import InputTextWithValidation from '@/components/InputTextWithValidation.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import { useForm, configure } from 'vee-validate';
import { localize } from '@vee-validate/i18n';
import validateFunction from '@/Common/validateRule';

validateFunction();
defineProps({
    status: String,
});
configure({
  generateMessage: localize('ja', {
    messages: {
      tel:'{field}のフォーマットが正しくありません',
    },
  }),
});


const labelValues = {
    email: 'メールアドレス',
};

const initialValues = {
    email: '',
};

const schema = {
    email: 'required|max:100|email',
};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


const onSubmit = handleSubmit(async (values, actions) => {
    Inertia.post(route('password.email'), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
    // 送信したことがわかるような処理が必要かも。
});
</script>

<template>
    <Head title="パスワードを忘れた" />
        <div class="form-demo">
            <div class="flex justify-content-center">
                <div class="card">
                    <div class="text-center mb-5">
                        <ApplicationLogo/>
                        <div class="text-900 text-2xl font-medium mb-3">パスワードを忘れた場合</div>
                        <div class="mb-4 text-sm text-gray-600">メールを再送信します</div>
                    </div>
                    <form @submit.prevent="onSubmit">
                        <div>
                            <InputTextWithValidation name="email" :label="labelValues.email" :isRequired="true"/>
                        </div>
                        <Button label="送信" type="submit" :disabled="isSubmitting" icon="pi pi-send" class="flex-1"/>
                    </form>
                </div>
            </div>
        </div>
</template>
<style scoped>
.form-demo .card {
    min-width: 450px;
}

.form-demo form {
    margin-top: 2rem;
}

.form-demo .field {
    margin-bottom: 1.5rem;
}


@media screen and (max-width: 960px) {
    .form-demo .card {
        width: 80%;
    }
}
</style>