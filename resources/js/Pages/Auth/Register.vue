<script setup lang="ts">
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import InputTextWithValidation from '@/Components/InputTextWithValidation.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
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
    name: '名前',
    email: 'メールアドレス',
    password: 'パスワード',
    password_confirmation: 'パスワード（確認用）',
};

const initialValues = {
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
};

const schema = {
    name: 'required',
    email: 'required|email',
    password: 'required|min:8',
    password_confirmation: 'required|min:8|is:@password',
};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


// サブミットメソッド
const onSubmit = handleSubmit(async (values, actions) => {
    Inertia.post(route('register'), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});

</script>

<template>
<Head title="登録" />
    <div class="form-demo">

        <div class="flex justify-content-center">
            <div class="card">
                <div class="text-center mb-5">
                    <ApplicationLogo/>
                    <div class="text-900 text-2xl font-medium mb-3">ユーザー登録</div>
                </div>
                <form @submit="onSubmit">

                    <InputTextWithValidation name="name" :label="labelValues.name" :isRequired="true" />
                    <InputTextWithValidation name="email" :label="labelValues.email" :isRequired="true" />
                    <InputTextWithValidation name="password" :label="labelValues.password" type="password"
                        :isRequired="true" />
                    <InputTextWithValidation name="password_confirmation" :label="labelValues.password_confirmation"
                        type="password" :isRequired="true" />

                        <div class="footer">
                            <Button label="送信" type="submit" :disabled="isSubmitting" icon="pi pi-send" class="flex-1"/>
                            <Button label="リセット" type="reset" class="p-button-secondary flex-1" />
                        </div>

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

