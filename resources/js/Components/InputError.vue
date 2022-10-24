<script setup lang="ts">
// defineProps(['message','vuelidate','columnTitle','submitted']);

const props = defineProps({
    message: String,
    vuelidate: Object,
    columnTitle: String,
    submitted: {
        type: Boolean,
        default: false
    },
})
</script>

<template>
    <div>
        <!-- <span v-if="vuelidate.$error && submitted">
            <span v-for="(error, index) of vuelidate.$errors" :key="index">
            <small class="p-error">{{error.$message}}</small>
            </span>
        </span>
        <small v-else-if="(vuelidate.$invalid && submitted) || vuelidate.$pending.$response" class="p-error">{{vuelidate.required.$message}}</small> -->

        <span v-if="vuelidate.$silentErrors && submitted">
            <span v-for="(error, index) of vuelidate.$silentErrors" :key="index">
            <small class="p-error">{{error.$message}}</small>
            </span>
        </span>
        <small v-else-if="(vuelidate.$invalid && submitted) || vuelidate.$pending.$response" class="p-error">{{vuelidate.required.$message}}</small>
        

        <span v-show="message">
            <small class="p-error">{{ message }}</small>
        </span>
    </div>

</template>
