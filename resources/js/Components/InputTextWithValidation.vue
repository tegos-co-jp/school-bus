<template>
  <div class="field">
    <span class="p-float-label p-input-icon-right w-full">
      <i v-if="piClass!==''" :class="`pi pi-${piClass}`" />

      <InputText
      v-model="value"
      :aria-describedby="`${name}-help`"
      :class="{ 'p-invalid': errorMessage }"
      class="w-full"
      :type="type"
      />
      <label class="block font-medium text-sm text-gray-700">
        <span v-if="label" :class="{'p-error':errorMessage}">{{ label }}{{ isRequired ? "*" : "" }}</span>
        <span v-else><slot /></span>
      </label>
    </span>


    <!-- <label :for="name">{{ label }}</label>
    <InputText
      v-model="value"
      :aria-describedby="`${name}-help`"
      :class="{ 'p-invalid': errorMessage }"
      :type="type"
    /> -->
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
