<template>
  <div class="field">
    <label :for="`${name}`" :class="{'p-error':errorMessage}">{{ label }}{{ isRequired ? "*" : "" }}</label>
    <Dropdown 
      :label="label" 
      v-model="value" 
      :options="options" 
      optionLabel="name" 
      optionValue="id" 
      placeholder="選択してください" 
      :class="{ 'p-invalid': errorMessage} "
      class="w-full"
    />
    <small :id="`${name}-help`" class="p-error">{{ errorMessage }}</small>
  </div>
</template>

<script lang="ts" setup>
import { toRef } from 'vue';
import { useField } from 'vee-validate';
import Dropdown from 'primevue/dropdown';

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    required: true,
  },
  options: {
    type: Array,
    required: true,
  },
  isRequired: {
    type: Boolean,
    default: false,
  },
});

const { errorMessage, value } = useField(toRef(props, 'name'));
</script>
