<script setup>
// import GuestLayout from '@/Layouts/GuestLayout.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import InputTextWithValidation from '@/Components/InputTextWithValidation.vue';
import { Head, Link} from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
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
    password: 'パスワード',
};

const initialValues = {
    password: "",
};

const schema = {
    password: 'required',
};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });


// サブミットメソッド
const onSubmit = handleSubmit(async (values, actions) => {
    console.log(values);
    Inertia.post(route('password.confirm'), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});

</script>

<template>
    <Head title="パスワード確認" />
        <div class="form">
        <div class="flex justify-content-center">
            <div class="card">
                <div class="text-center mb-5">
                    <ApplicationLogo />
                    <div class="text-900 text-2xl font-medium mb-3"> パスワード確認</div>
                </div>

                <div>
                    <form @submit="onSubmit">
                        <InputTextWithValidation name="password" :label="labelValues.password" type="password"/>

                        <!-- <div class="flex align-items-center justify-content-between mb-6">
                            <Link :href="route('password.request')" class="text-sm no-underline ml-2 text-blue-500 cursor-pointer">パスワードを忘れた場合</Link>
                        </div> -->
                        <div class="footer">
                            <Button label="確認" type="submit" :disabled="isSubmitting" icon="pi pi-send" class="flex-1"/>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</template>
