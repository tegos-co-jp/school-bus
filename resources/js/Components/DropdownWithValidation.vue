<template>
  <div class="">
    <label :for="`${name}`" :class="{'p-error':errorMessage}">{{ label }}{{ isRequired ? "*" : "" }}</label>
    
    <Dropdown
      :label="label"
      v-model="value"
      :options="options"
      optionLabel="name"
      optionValue="id"
      placeholder="Please select an option"
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
