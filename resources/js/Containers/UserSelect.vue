<script setup>
    import CustomCombobox from "@/Components/CustomComboBox.vue"
    import { onMounted, ref, watch } from 'vue';

    const props = defineProps({
        modelValue: {
            required: true,
        },
    });
    const emit = defineEmits(['update:modelValue']);

    const accounts = ref([])
    const search = ref("");
    const selectedPerson = ref(null)


    const searchUserHandler = (value) => {
        search.value = value
    }

    watch(search, () => {
        searchUsers()
    })

    watch(selectedPerson, (newPerson)=> {
        emit('update:modelValue', newPerson);
    })

    watch(() => props.modelValue, (newValue, oldValue) => {
        if (newValue != oldValue) {
            findUser(newValue)
                .then((result) => {
                    accounts.value = [...accounts.value ,result.data]
                    selectedPerson.value = result.data.id
                })
                .catch((error) => {
                    console.error('Error finding user:', error);
                });
        } else {
            searchUsers();
        }
    })

    const searchUsers = () => {

        //TODO : throttle this api request
        fetch(route('web_api.searchUsers') + `?q=${search.value}`)
        .then(response => response.json())
        .then(results => {
            accounts.value = results.data
        });

    }

    const findUser = (id) => {
        return fetch(route('web_api.findUser') + `?id=${id}`)
            .then(response => response.json())
            .then(results => {
                return results; // You may want to return some value from here if needed
            });
    }

    onMounted(() => {
        if (props.modelValue) {
            findUser(props.modelValue)
                .then((result) => {
                    accounts.value = [result.data]
                    selectedPerson.value = result.data.id
                })
                .catch((error) => {
                    console.error('Error finding user:', error);
                });
        } else {
            searchUsers();
        }
    });

</script>

<template>
    <CustomCombobox v-model="selectedPerson"  :items="accounts" :onSearch="searchUserHandler"  />
</template>
