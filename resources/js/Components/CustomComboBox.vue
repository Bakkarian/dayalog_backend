<script setup>
   import { CheckIcon } from '@heroicons/vue/24/outline'
    import { ChevronUpDownIcon } from '@heroicons/vue/20/solid'
    import {
        Combobox,
        ComboboxButton,
        ComboboxInput,
        ComboboxOption,
        ComboboxOptions,
    } from '@headlessui/vue'
import { computed, ref } from 'vue';

const props = defineProps({
    modelValue: {
        required: true,
    },
    items:{
        type: Array,
        default:[]
    },
    onSearch:{
        type:Function
    }
});

const search = ref("");

defineEmits(['update:modelValue']);


const filteredItems = computed(()=>{
    if(props.items){
       return props.items.filter(item => item.name.toLowerCase().includes(search.value.toLocaleLowerCase()))
    }

    return []
})


const displayValue = (itemId) => {


    if(itemId){
        const item = props.items.find(item => item.id == itemId)
        if(item){
            return  props.items.find(item => item.id == itemId).name
        }
        return ""
    }
    return ""
}


const handleSearch = async (value) => {
    if(props.onSearch){
        await props.onSearch(value)
    }
    search.value = value
}


</script>

<template>
    <Combobox
        class="flex-auto mr-1"
        as="div"
        :modelValue="modelValue"
        @update:modelValue="value => $emit('update:modelValue', value)"
    >
        <div class="relative ">
            <ComboboxInput class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
             :display-value="displayValue"
             @change="handleSearch($event.target.value)"
             />
            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </ComboboxButton>

            <ComboboxOptions v-if="filteredItems.length > 0" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                <ComboboxOption v-for="item in filteredItems" :key="item.id" :value="item.id" as="template" v-slot="{ active, selected }">
                    <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                        <span :class="['block truncate', selected && 'font-semibold']">
                            {{ item.name }}
                        </span>
                            <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                            <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        </span>
                    </li>
                </ComboboxOption>


                <!--<ComboboxOption class="mt-2">
                    <li :class="['relative cursor-default select-none py-2 pl-3 pr-9']" >add a new user </li>
                </ComboboxOption> -->
            </ComboboxOptions>
        </div>
    </Combobox>
</template>
