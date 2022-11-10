<template>
  <div class="field">
    <label :for="`${name}`" :class="{'p-error':errorMessage}">{{ label }}{{ isRequired ? "*" : "" }}</label>
    <InputText :id="`${name}`" v-model="value" :aria-describedby="`${name}-help`" :class="{ 'p-invalid': errorMessage }"
      class="w-full" :type="type" />
    <small :id="`${name}-help`" class="p-error">{{ errorMessage }}</small>
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
  isRequired: {
    type: Boolean,
    default: false,
  },
  piClass: {
    type: String,
    default: ''
  }
});

const { errorMessage, value } = useField(toRef(props, 'name'));
</script>

<style lang="postcss" scoped>
.field * {
  display: block;
}
</style>
