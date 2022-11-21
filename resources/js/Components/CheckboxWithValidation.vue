<template>
  <div class="field">
    <label :for="`${name}`" :class="{'p-error':errorMessage}">{{ label }}{{ isRequired ? "*" : "" }}</label>
    <Checkbox
      :label="label"
      v-model="value"
      :binary="true"
      trueValue="1"
      falseValue="0"
    />
    <small :id="`${name}-help`" class="p-error">{{ errorMessage }}</small>
  </div>
</template>

<script setup lang="ts">
import { toRef } from 'vue';
import { useField } from 'vee-validate';
import Checkbox from 'primevue/checkbox';

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    required: true,
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
