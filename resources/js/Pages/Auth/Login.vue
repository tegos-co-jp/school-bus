<script setup lang="ts">
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import InputTextWithValidation from '@/components/InputTextWithValidation.vue';
import Button from 'primevue/button';
import { useForm, configure } from 'vee-validate';
import { localize } from '@vee-validate/i18n';

import { defineRule } from 'vee-validate';
import AllRules from '@vee-validate/rules';
import * as ja from '@vee-validate/i18n/dist/locale/ja.json';

Object.keys(AllRules).forEach(rule => {
  defineRule(rule, AllRules[rule]);
});
localize({ ja });

configure({
  generateMessage: localize('ja', {
    messages: {
    },
  }),
});

// import {hogefunction} from '@/Common/validateRule';

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

                        <InputTextWithValidation name="email" :label="labelValues.email" :isRequired="true" piClass="envelope" />
                        <InputTextWithValidation name="password" :label="labelValues.password" type="password" :isRequired="true" />

                        <!-- <div class="flex align-items-center justify-content-between mb-6">
                            <a
                                class="text-sm font-medium no-underline ml-2 text-blue-500 text-right cursor-pointer">パスワードを忘れた場合</a>
                        </div> -->
                        <div class="footer">
                            <Button label="Submit" type="submit" :disabled="isSubmitting" />
                            <Button label="Reset" type="reset" class="p-button-secondary" />
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</template>

<!-- <style>
    margin-bottom: 1.5rem;
</style> -->
