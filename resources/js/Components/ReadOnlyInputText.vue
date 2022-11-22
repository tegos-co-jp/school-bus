<template>
  <div class="field">
    <label :for="`${name}`">{{ label }}</label>
    <InputText :id="`${name}`" v-model="value" readonly class="w-full" :type="type" />
  </div>
</template>

<script setup lang="ts">
import { toRef } from 'vue';
import { useField } from 'vee-validate';
import InputText from 'primevue/inputtext';

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    default: 'text',
  },
});

const { errorMessage, value } = useField(toRef(props, 'name'));
</script>
