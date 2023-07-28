<template>
    <Combobox as="div" v-model="selectedValue" >
        <ComboboxLabel class="block text-sm font-medium leading-6 text-gray-900">
            Assigned to <span class="text-gray-500 italic">(Search Below)</span>
        </ComboboxLabel>
        <div class="relative mt-2">
            <ComboboxInput class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 \
                                    text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 \
                                    focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            @change="loadDrivers($event.target.value)" :display-value="(person) => person?.name" />
            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </ComboboxButton>
            <ComboboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto \
                                    rounded-md bg-white py-1 text-base shadow-lg ring-1 \
                                    ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                <ComboboxOption v-for="driver in drivers" :key="driver.driver_id" :value="driver" as="template" v-slot="{ active, selected }">
                    <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                        <div class="flex items-center">
                            <span :class="['inline-block h-2 w-2 flex-shrink-0 rounded-full', driver.valid ? 'bg-green-400' : 'bg-gray-200']" aria-hidden="true" />
                            <span :class="['ml-3 truncate', selected && 'font-semibold']">
                            {{ driver.name }}
                            <span class="sr-only"> is {{ driver.valid ? 'online' : 'offline' }}</span>
                            </span>
                        </div>

                        <span v-if="selected"
                            :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                            <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        </span>
                    </li>
                </ComboboxOption>
            </ComboboxOptions>
        </div>
    </Combobox>
</template>

<script setup>
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import {
      Combobox,
      ComboboxButton,
      ComboboxInput,
      ComboboxLabel,
      ComboboxOption,
      ComboboxOptions,
  } from '@headlessui/vue'
import { ref, onMounted, watch, computed} from 'vue';
  const props = defineProps(['modelValue'])
  const emit = defineEmits(['update:modelValue'])
  const selectedValue = ref("")

  const drivers = ref([]);

    watch(selectedValue, (newValue, oldValue) => {
    emit('update:modelValue', newValue.driver_id)
    });

    watch(() => props.modelValue, (newValue, oldValue) => {
        if(newValue == ""){
            selectedValue.value = drivers.value.find(driver => driver.id == newValue)
        }
    })

    const value = computed({
        get() {
            return props.modelValue
        },
        set(value) {
            emit('update:modelValue', value)
        }
    })


  const loadDrivers = (term) =>{
    fetch(route('driver.search-json', { term : term}))
     .then((res) => {
       return res.json()
      })
     .then(data =>{
         drivers.value = data.data
    })
  }

  onMounted(()=>{
    loadDrivers('')
  })

</script>
