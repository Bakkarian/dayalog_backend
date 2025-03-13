<template>

    <Head title="Add User" />

    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <!-- Main area -->
        <div class="mb-8">
            <h1 class="text-xl">Create Client</h1>
        </div>
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-md border">
                <form @submit.prevent="submitForm">
                    <p class="text-xs mt-0">Field Marked with "<strong>*</strong>" are required</p>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <InputLabel for="name" value="Full Name *" />
                            <div class="mt-2">
                                <TextInput id="name" type="text" placeholder="Enter Client's full name" v-model="form.name" />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Email  Address (Optional)" />
                            <div class="mt-2">
                                <TextInput id="email" type="text" placeholder="Client's email address" v-model="form.email" />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Patasente Merchant Code" />
                            <div class="mt-2">
                                <TextInput id="patasente_id" type="text"   placeholder="Merchant Code"  v-model="form.patasente_id" />
                                <InputError class="mt-2" :message="form.errors.patasente_id" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Phone Number" />
                            <div class="mt-2">
                                <TextInput id="patasente_id" type="text"   placeholder="Client's Phone Number"  v-model="form.phone_number" />
                                <InputError class="mt-2" :message="form.errors.phone_number" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Business Name" />
                            <div class="mt-2">
                                <TextInput id="business_name" type="text"  placeholder="Business Name"  v-model="form.business_name" />
                                <InputError class="mt-2" :message="form.errors.business_name" />
                            </div>
                        </div>
                    </div>
                    <FlashMessage />
                    <button type="submit"
                            class="rounded-md mt-12 bg-indigo-600 px-3 py-2 text-sm font-semibold \
                                text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 \
                                focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Create Client
                    </button>
                </form>
            </div>
            <div class="hidden lg:block">
                <img class="max-w-md mx-auto" src="@/assets/create-Client.svg">
            </div>
        </div>
    </div>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import FlashMessage from '@/Containers/FlashMessage.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Layout from '@/Layouts/MainLayout.vue'
defineOptions({ layout: Layout })


    const form = useForm({
    name:"",
    email: "",
    patasente_id:"",
    phone_number:"",
    business_name:""
    })

    const submitForm = async () => {
        form.post(route('client.store'), {
            onSuccess:() => {
                form.reset()
            }
        })
    };

</script>
