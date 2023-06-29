<template>
    <div class=" border rounded-md p-6 bg-blue-300 bg-opacity-5">
        <Combobox as="div" v-model="selectedValue">
            <ComboboxLabel class="block text-sm font-medium leading-6 text-gray-900">Device</ComboboxLabel>
            <div class="relative mt-2">
                <ComboboxInput
                    class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 \
                     text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 \
                      focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    @change="query = $event.target.value"
                    :display-value="(device) => device?.name" />
                <ComboboxButton
                    class="absolute inset-y-0 right-0 \
                     flex items-center rounded-r-md \
                      px-2 focus:outline-none">
                    <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                </ComboboxButton>

                <ComboboxOptions
                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md \
                        bg-white py-1 text-base shadow-lg ring-1 ring-black \
                         ring-opacity-5 focus:outline-none sm:text-sm">
                    <ComboboxOption
                            v-for="device in filteredDevices"
                            :key="device.id" :value="device" as="template" v-slot="{ active, selected }">
                        <li
                            :class="[
                                'relative cursor-default select-none py-2 pl-3 pr-9',
                                active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                            <div class="flex">
                            <span :class="['truncate', selected && 'font-semibold']">
                            {{ device.name }}
                            </span>
                                <span :class="['ml-2 truncate text-gray-500', active ? 'text-indigo-200' : 'text-gray-500']">
                            {{ device.id }}
                            </span>
                            </div>

                            <span
                                v-if="selected"
                                :class="[
                                    'absolute inset-y-0 right-0 flex items-center pr-4',
                                    active ? 'text-white' : 'text-indigo-600']">
                            <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        </span>
                        </li>
                    </ComboboxOption>
                </ComboboxOptions>
            </div>
        </Combobox>
    </div>
</template>

<script setup>

import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import { Combobox, ComboboxButton, ComboboxInput, ComboboxLabel, ComboboxOption, ComboboxOptions, } from '@headlessui/vue'
import { computed, onMounted, ref, watch} from 'vue'
import { usePage } from '@inertiajs/vue3';

const devices = computed(() => usePage().props.devices)

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])
const selectedValue = ref("")

watch(selectedValue, (newValue, oldValue) => {
    emit('update:modelValue', newValue.id)
});

watch(() => props.modelValue, (newValue, oldValue) => {
    if(newValue == ""){
        selectedValue.value = filteredDevices.value.find(device => device.id == newValue)
    }
})

onMounted(() => {
    selectedValue.value = filteredDevices.value.find(device => device.id == props.modelValue)
})



const value = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})

const query = ref('')
const filteredDevices = computed(()=>{

    return [{
        id:"",
        name:"Select Device"
    },...(query.value === '' ? devices.value : devices.value.filter((person) => {
        return person.name.toLowerCase().includes(query.value.toLowerCase())
    }))]
})

</script>
