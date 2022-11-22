<script setup lang="ts">
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import InputTextWithValidation from '@/Components/InputTextWithValidation.vue';
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


const labelValues = {
    email: 'メールアドレス',
    password: 'パスワード',
};

const initialValues = {
    email: "",
    password: "",
};

const schema = {
    email: 'required|email',
    password: 'required|min:8',
};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


// サブミットメソッド
const onSubmit = handleSubmit(async (values, actions) => {
    Inertia.post(route('login'), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});
</script>

<template>

    <Head title="ログイン" />
    <div class="form">
        <div class="flex justify-content-center">
            <div class="card">
                <div class="text-center mb-5">
                    <ApplicationLogo />
                    <div class="text-900 text-2xl font-medium mb-3">ログイン</div>
                    <span class="text-600 text-sm line-height-3">初めてご利用ですか？</span>
                    <Link :href="route('register')" class="text-sm no-underline ml-2 text-blue-500 cursor-pointer">
                    アカウントを作成する</Link>
                </div>

                <div>
                    <form @submit="onSubmit">

                        <InputTextWithValidation name="email" :label="labelValues.email" :isRequired="true"/>
                        <InputTextWithValidation name="password" :label="labelValues.password" type="password" :isRequired="true" />

                        <div class="flex align-items-center justify-content-between mb-6">
                            <Link :href="route('password.request')" class="text-sm no-underline ml-2 text-blue-500 cursor-pointer">パスワードを忘れた場合</Link>
                        </div>
                        <div class="footer">
                            <Button label="送信" type="submit" :disabled="isSubmitting" icon="pi pi-send" class="flex-1"/>
                            <Button label="リセット" type="reset" class="p-button-secondary flex-1" />
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</template>

