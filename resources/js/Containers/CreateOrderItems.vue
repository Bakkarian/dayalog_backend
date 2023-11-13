<script setup>
import TextInput from '@/Components/TextInput.vue';
import { ref, watch, onMounted, reactive } from 'vue';
import { LinkIcon, PlusIcon, XMarkIcon } from '@heroicons/vue/20/solid'
import { v4 as uuidv4 } from 'uuid';


const initialItem = {
    item: "",
    qty: "",
    price: "",
    qty_measure: ""
}

const items = ref([])
const newItem = reactive({...initialItem});

const measures = [
    "Litres",
    "Kilograms"
]

const props = defineProps({
        modelValue: {
            required: true,
        },
    });

const emit = defineEmits(['update:modelValue']);

watch(items, (newItems)=> {
    emit('update:modelValue', newItems);
})


const removeItem = (id) => {
    items.value = items.value.filter(item => item.id !== id)
}

const addItem = () => {
    items.value.push({...newItem, id:uuidv4() })
    Object.assign(newItem, initialItem);
}

onMounted(()=>{
    items.value = props.modelValue
})

</script>
<template>
<div>
    <hr />
    <p class="mt-2">Order Items</p>
    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <TextInput v-model="newItem.item" class="my-2" type="text"   placeholder="Item Name"  />
            <TextInput  v-model="newItem.qty" class="my-2" type="text"   placeholder="Quantity"  />
            <TextInput  v-model="newItem.price" class="my-2" type="text"   placeholder="Item Price per quantity"  />
            <select v-model="newItem.qty_measure" id="location" name="location" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6">
                <option selected value="">Select Quantity Measure</option>
                <option v-for="measure in measures" :value="measure">{{ measure }}</option>
            </select>
            <button type="button" @click="addItem" class="mt-2 inline-flex items-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                <PlusIcon class="-ml-0.5 mr-1.5 h-5 w-5" aria-hidden="true" />
                Add Item
            </button>
        </div>
        <div class="border-l border-dashed min-h-[420px]">
            <div v-for="item in items"  :key="item.id" class="ml-4 mb-4 border border-orange-400 rounded-md p-2 bg-orange-400 bg-opacity-5">
                <p class="sm:flex sm:justify-between">
                    <span>{{item.item}}</span>
                    <XMarkIcon @click="removeItem(item.id)" class="-ml-0.5 mr-1.5 h-5 w-5 text-red-400 cursor-pointer" aria-hidden="true" />
                </p>
                <p class="sm:flex sm:justify-between">
                    <span class="text-sm">Qty: {{ item.qty }} {{ item.qty_measure }}</span>
                    <span class="text-sm font-bold">Total: UGX {{ item.price * item.qty }}</span>
                </p>
            </div>
        </div>
    </div>
</div>
</template>
