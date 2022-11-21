<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
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
    <GuestLayout>
        <Head title="パスワードを忘れた" />

        <div class="mb-4 text-sm text-gray-600">
            パスワードをお忘れになりましたか？問題ありません。メールアドレスをお知らせいただければ、パスワード再設定用のリンクをメールでお送りしますので、新しいパスワードをお選びください。
        </div>

        <form @submit.prevent="onSubmit">
            <div>
                <InputTextWithValidation name="email" :label="labelValues.email" :isRequired="true" piClass="building" />
            </div>
            <Button label="送信" type="submit" :disabled="isSubmitting" icon="pi pi-send" class="flex-1"/>
        </form>
    </GuestLayout>
</template>
