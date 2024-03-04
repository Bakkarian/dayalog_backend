<template>

    <Head title="Add Order" />

    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <!-- Main area -->
        <div class="mb-2">
            <h1 class="text-xl">Create Order</h1>
        </div>
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-md border">
                <form @submit.prevent="submitOrder">
                    <p class="text-xs mt-0">Field Marked with "<strong>*</strong>" are required</p>
                    <div class="mt-10 mb-4 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">

                        <div class="sm:col-span-5">
                            <InputLabel value="Deliver From *" />
                            <div class="mt-2">
                                <div class="flex items-center">
                                    <UserSelect  v-model="form.from" />
                                    <button
                                        @click="creatingNewFromUser = true;creatingNewToUser = false;"
                                        type="button"
                                        class="rounded-md h-fit ml-1 bg-indigo-600 px-2.5 \
                                        py-1.5 text-sm font-semibold text-white shadow-sm \
                                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 \
                                        focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        >New User</button>
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form.errors.from" />
                        </div>



                        <div class="sm:col-span-5">
                            <InputLabel value="Deliver To *" />
                            <div class="mt-2">
                                <div class="flex items-center ">
                                    <UserSelect  v-model="form.to" />
                                    <button
                                        @click="creatingNewToUser = true;creatingNewFromUser = false;"
                                        type="button"
                                        class="rounded-md h-fit ml-1 bg-indigo-600 px-2.5 \
                                        py-1.5 text-sm font-semibold text-white shadow-sm \
                                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 \
                                        focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        >New User</button>
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form.errors.to" />
                        </div>

                        <div class="sm:col-span-5">
                            <InputLabel value="Delivery Notes *" />
                            <div class="mt-2">
                                <TextArea v-model="form.notes" placeholder="Start typing and select"  />
                                <InputError class="mt-2" :message="''" />
                            </div>
                            <InputError class="mt-2" :message="form.errors.notes" />
                        </div>

                    </div>


                    <InputError class="mt-2" :message="form.errors.orderItems" />
                    <CreateOrderItems  v-model="form.orderItems"  />

                    <div class="mt-2 pt-1 border-t">
                        <FlashMessage />
                        <div class="flex flex-row-reverse">
                            <button type="submit"
                                class="rounded-md mt-1 bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Create Order
                        </button>
                        </div>
                    </div>
                </form>
            </div>

            <div v-if="creatingNewFromUser">
                <h3>Create new delivery from user</h3>
                <CreateNewOrderUser   :onCreateNewUser="handleNewFromUser"  />
            </div>

            <div v-if="creatingNewToUser">
                <h3>Create new delivery to user</h3>
                <CreateNewOrderUser   :onCreateNewUser="handleNewToUser"  />
            </div>
        </div>
    </div>


</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextArea from '@/Components/TextArea.vue';
import FlashMessage from '@/Containers/FlashMessage.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import Layout from '@/Layouts/MainLayout.vue'
import UserSelect from '@/Containers/UserSelect.vue';
import CreateOrderItems from '@/Containers/CreateOrderItems.vue'
import CreateNewOrderUser from '@/Containers/CreateNewOrderUser.vue'
import { ref } from 'vue';

defineOptions({ layout: Layout })

const creatingNewFromUser = ref(false)
const creatingNewToUser = ref(false)


const handleNewFromUser = (user) => {

    form.from = user.id;
    creatingNewFromUser.value = false
}

const handleNewToUser = (user) => {
    form.to = user.id;
    creatingNewToUser.value = false
}

const form = useForm('CreateOrder',{
  from: "",
  to: "",
  notes: "",
  orderItems: []
})


const submitOrder = () => {
    form.post(route('order.store'), {
        onSuccess: () => form.reset(),
    })
}


</script>
