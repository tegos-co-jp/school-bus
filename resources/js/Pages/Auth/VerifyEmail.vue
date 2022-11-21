<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components copy/PrimaryButton.vue';
import { Head, Link} from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import InputTextWithValidation from '@/Components/InputTextWithValidation.vue';
import Button from 'primevue/button';
import { useForm, configure } from 'vee-validate';
import { localize } from '@vee-validate/i18n';
import validateFunction from '@/Common/validateRule';

validateFunction();
const props = defineProps({
    status: String,
});

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

const onSubmit = handleSubmit(async (values, actions) => {
    console.log("hoge");
    Inertia.post(route('verification.send'), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});

// const form = useForm();

// const submit = () => {
//     form.post(route('verification.send'));
// };

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>

    <Head title="確認メール" />
    <div class="form">
        <div class="flex justify-content-center">
            <div class="card">
                <div class="text-center mb-5">
                    <ApplicationLogo />
                    <div class="text-900 text-2xl font-medium mb-3">メールアドレス確認</div>
                    <!-- <div class="mb-4 text-sm text-gray-600">
                        サインアップありがとうございます。ご登録を始める前に、Eメールでお送りしたリンクをクリックして、Eメールアドレスの確認をしていただけますか？もし、メールが届いていない場合は、再度お送りします。
                    </div> -->
                    <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent" >
                        確認メールを送信しました。
                    </div>
                </div>

                <div>
                    <form @submit="onSubmit">

                        <!-- <InputTextWithValidation name="email" :label="labelValues.email" :isRequired="true" piClass="envelope" />
                        <InputTextWithValidation name="password" :label="labelValues.password" type="password" :isRequired="true" /> -->
                        <div class="footer">
                            <Button label="送信" type="submit" :disabled="isSubmitting" icon="pi pi-send" class="flex-1"/>
                            <Link :href="route('logout')" class="text-sm no-underline ml-2 text-blue-500 cursor-pointer">ログアウト</Link>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>




        <!-- <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    再送信
                </PrimaryButton>

                <Link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Log Out</Link>
            </div>
        </form> -->
</template>
