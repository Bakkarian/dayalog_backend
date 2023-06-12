<script setup>
import { onMounted, ref, toRefs, computed } from 'vue';

const props = defineProps({
    slot: {
        type: String,
        required: true
    }
});

const { slot } = toRefs(props)

const mounted = ref(false);

onMounted(() => mounted.value = true);

const to = computed(() => {
    return `[data-slot="${slot.value}"]`;
});

</script>

<template>
    <Teleport :to='to' v-if="mounted">
        <slot />
    </Teleport>
</template>
