<script setup lang="ts">
import { ref, computed } from "vue";

// defineProps(['value','pInvalid','isRequired']);
const props = defineProps({
    columnTitle: {
        type: String,
    },
    pInvalid: {
        type: Boolean,
        default: false
    },
    isRequired: {
        type: Boolean,
        default: false
    }
})
</script>

<template>
    <label class="block font-medium text-sm text-gray-700">
        <!-- <span v-if="value">{{ value }}</span> -->
        <span v-if="columnTitle" :class="{'p-error':pInvalid}">{{ columnTitle }}{{ isRequired ? "*" : "" }}</span>
        <span v-else><slot /></span>
    </label>
</template>