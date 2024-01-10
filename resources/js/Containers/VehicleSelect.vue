<script setup>
    import CustomCombobox from "@/Components/CustomComboBox.vue"
    import { onMounted, ref, watch } from 'vue';

    const props = defineProps({
        modelValue: {
            required: true,
        },
    });
    const emit = defineEmits(['update:modelValue']);

    const vehicles = ref([])
    const search = ref("");
    const selectedVehicle = ref(null)


    const searchVehicleHandler = (value) => {
        search.value = value
    }

    watch(search, () => {
        searchVehicles()
    })

    watch(selectedVehicle, (newPerson)=> {
        emit('update:modelValue', newPerson);
    })

    watch(() => props.modelValue, (newValue, oldValue) => {
        if (newValue != oldValue) {
            findVehicle(newValue)
                .then((result) => {
                    vehicles.value = [...vehicles.value ,result.data]
                    selectedVehicle.value = result.data.id
                })
                .catch((error) => {
                    console.error('Error finding user:', error);
                });
        } else {
            searchVehicles();
        }
    })

    const searchVehicles = () => {

        //TODO : throttle this api request
        fetch(route('web_api.searchVehicles') + `?q=${search.value}`)
        .then(response => response.json())
        .then(results => {
            vehicles.value = results.data
        });

    }

    const findVehicle = (id) => {
        return fetch(route('web_api.findVehicle') + `?id=${id}`)
            .then(response => response.json())
            .then(results => {
                return results; // You may want to return some value from here if needed
            });
    }

    onMounted(() => {
        if (props.modelValue) {
            findVehicle(props.modelValue)
                .then((result) => {
                    vehicles.value = [result.data]
                    selectedVehicle.value = result.data.id
                })
                .catch((error) => {
                    console.error('Error finding vehicle:', error);
                });
        } else {
            searchVehicles();
        }
    });

</script>

<template>
    <CustomCombobox v-model="selectedVehicle"  :items="vehicles" :onSearch="searchVehicleHandler"  />
</template>
