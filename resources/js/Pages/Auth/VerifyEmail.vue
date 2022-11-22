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

const labelValues = {};

const initialValues = {};

const schema = {};

const { errors, meta, handleSubmit, isSubmitting, submitCount } = useForm({
    validationSchema: schema,
    initialValues: initialValues,
});
configure({ generateMessage: localize('ja', { names: labelValues },), });

const onSubmit = handleSubmit(async (values, actions) => {
    Inertia.post(route('verification.send'), values, {
        onError: (errors) => {
            actions.setErrors(errors);
        },
    });
});

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
                    <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent" >
                        確認メールを送信しました。
                    </div>
                </div>

                <form @submit="onSubmit">
                    <div class="footer">
                        <Button label="送信" type="submit" :disabled="isSubmitting" icon="pi pi-send" class="flex-1"/>
                        <Button label="送信" type="submit" class="p-button-secondary flex-1"><Link :href="route('logout')" method="POST" as="text">ログアウト</Link></Button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>
