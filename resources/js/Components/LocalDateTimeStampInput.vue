<script setup>
import { computed, onMounted, ref } from 'vue';

    const props = defineProps({
        modelValue: {
            required: true,
        },
    });

   const emit = defineEmits(['update:modelValue']);

    const input = ref(null);

    onMounted(() => {
        if (input.value.hasAttribute('autofocus')) {
            input.value.focus();
        }
    });

    defineExpose({ focus: () => input.value.focus() });

    const dateFormat = computed(() => {
        const date = new Date(props.modelValue * 1000); // Convert to milliseconds
        const isoString = date.toISOString();
        return isoString.slice(0, 16); // 'YYYY-MM-DDTHH:MM'
    });

    // Update the timestamp when user changes the datetime-local input
    const updateTimestamp = (event) => {
        const newDateTime = event.target.value;
        const date = new Date(newDateTime);
        const timestamp= Math.floor(date.getTime() / 1000); // Convert back to Unix timestamp

        emit('update:modelValue', timestamp)

    };


</script>

<template>

    <input 
     ref="input"
        @input="updateTimestamp"
        :value="dateFormat" 
        type="datetime-local" 
        id="start-date"   
        class="w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset \
            ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset \
            focus:ring-indigo-600 sm:text-sm sm:leading-6">
</template>
