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
        const date = new Date(props.modelValue * 1000); // Convert Unix timestamp to milliseconds
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        
        return `${year}-${month}-${day}T${hours}:${minutes}`;
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
