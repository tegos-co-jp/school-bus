<script setup lang="ts">
// import GuestLayout from '@/Layouts/GuestLayout.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import InputText from 'primevue/inputtext';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import InputTextWithValidation from '@/components/InputTextWithValidation.vue';
import ReadOnlyInputText from '@/components/ReadOnlyInputText.vue';
import Button from 'primevue/button';
import { useForm, configure} from 'vee-validate';
import { localize } from '@vee-validate/i18n';
import validateFunction from '@/Common/validateRule';

validateFunction();
const props = defineProps({
    email: String,
    token: String,
});

configure({
  generateMessage: localize('ja', {
    messages: {
      tel:'{field}のフォーマットが正しくありません',
    },
  }),
});

const labelValues = {
    email:'メールアドレス',
    password: 'パスワード',
    password_confirmation: 'パスワード確認用',
};

const initialValues = {
    email:props.email,
    password: '',
    password_confirmation: '',
    token: props.token,
};

const schema = {
    email:'required|max:100|email',
    password: 'required|min:8',
    password_confirmation: 'required|min:8|is:@password',
};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


const onSubmit = handleSubmit(async (values, actions) => {
    Inertia.post(route('password.update'), values, {
        onError: (errors) => {
            console.log(values);
            actions.setErrors(errors);
        },
    });
    // パスワードをリセットした通知が必要かもしれない。
});

</script>

<template>
    <Head title="パスワードのリセット" />
            <div class="form-demo">
        <div class="flex justify-content-center">
            <div class="card">
                <div class="text-center mb-5">
                    <ApplicationLogo />
                    <div class="text-900 text-2xl font-medium mb-3">パスワードリセット</div>
                </div>
                <form @submit="onSubmit">
                        <ReadOnlyInputText name="email" :label="labelValues.email"/>
                        <InputTextWithValidation name="password" type="password" :label="labelValues.password" :isRequired="true"/>
                        <InputTextWithValidation name="password_confirmation" type="password" :label="labelValues.password_confirmation" :isRequired="true"/>
                        <div class="footer">
                            <Button label="変更" type="submit" :disabled="isSubmitting" icon="pi pi-send" class="flex-1"/>
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