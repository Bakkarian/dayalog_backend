<template>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <!-- Main area -->
        <div class="mb-8">
            <h1 class="text-xl">Create Driver</h1>
        </div>
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-md border">
                <form @submit.prevent="submitForm">
                    <p class="text-xs mt-0">Field Marked with "<strong>*</strong>" are required</p>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <InputLabel for="name" value="Full Name *" />
                            <div class="mt-2">
                                <TextInput id="name" type="text" placeholder="Plate number of the vehicle" v-model="form.name" />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Email  Address (Optional)" />
                            <div class="mt-2">
                                <TextInput id="email" type="text" placeholder="Driver's email address" v-model="form.email" />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Patasente Merchant Code *" />
                            <div class="mt-2">
                                <TextInput id="patasente_id" type="text"   placeholder="Merchant Code"  v-model="form.patasente_id" />
                                <InputError class="mt-2" :message="form.errors.patasente_id" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Phone Number*" />
                            <div class="mt-2">
                                <TextInput id="patasente_id" type="text"   placeholder="Driver's Phone Number"  v-model="form.phone_number" />
                                <InputError class="mt-2" :message="form.errors.phone_number" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Drivers Licence Number *" />
                            <div class="mt-2">
                                <TextInput id="license_no" type="text" required  placeholder="Drivers Licence Number"  v-model="form.license" />
                                <InputError class="mt-2" :message="form.errors.license" />
                            </div>
                        </div>
                    </div>
                    <FlashMessage />
                    <button type="submit"
                            class="rounded-md mt-12 bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Create Driver
                    </button>
                </form>
            </div>
            <div class="hidden lg:block">
                <img class="max-w-md mx-auto" src="../assets/create-driver.svg">
            </div>
        </div>
    </div>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import FlashMessage from '@/Containers/FlashMessage.vue';
import { useForm } from '@inertiajs/vue3';


    const form = useForm({
    name:"",
    email: "",
    patasente_id:"",
    phone_number:"",
    license:""
    })
    const submitForm = async () => {
        form.submit('post', route('driver.store'))
    };

</script>
