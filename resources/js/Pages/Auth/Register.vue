<script setup>
import primary_logo from '@/assets/LOGO-PRIMARY.png'
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout })
const form = useForm({
    name: '',
    email: '',
    password: ''
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
        <Head title="Register" />
                <!-- start of sign up -->
                <div class="mx-auto w-full max-w-sm lg:w-96 animate__animated animate__fadeIn">
                <div>
                    <div class="h-10 overflow-hidden flex items-center">
                    <img class="w-[200px] w-auto" :src=primary_logo alt="dayalog" />
                    </div>
                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Create a new account</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                    Already have an account?

                        <Link :href="route('login')" class="font-semibold text-[#002760] hover:text-blue-700" >Login here</Link>
                    </p>
                </div>

                <div class="mt-10">
                    <div>
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <InputLabel for="name" value="Full Name" />
                <div class="mt-2">
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="my-2" :message="form.errors.name" />
                        </div>
                        </div>
                        <div>

                <InputLabel for="email" value="Email address" />
                <div class="mt-2">


                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                        </div>
                        </div>

                        <div>
                <InputLabel for="password" value="Password" />

                <div class="mt-2">
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
                        </div>
                        </div>

            <div>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Sign Up
                </PrimaryButton>
                        </div>
                    </form>
                    </div>

                    <div class="mt-10">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200" />
                        </div>
                        <div class="relative flex justify-center text-sm font-medium leading-6">
                        <span class="bg-white px-6 text-gray-900">Or Login To Your Account</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <Link :href="route('login')" class="flex w-full justify-center rounded-md bg-blue-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-700 focus-visible:outline">Sign In</Link>
                    </div>
                    </div>
                </div>
                </div>
                <!-- end of signup -->
</template>

<style scoped>

</style>
