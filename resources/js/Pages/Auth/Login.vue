<script setup>
import primary_logo from '@/assets/LOGO-PRIMARY.png'
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout })

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
<template>
        <Head title="Log in" />

            <!-- Start of login -->
                <div class="mx-auto w-full max-w-sm lg:w-96 animate__animated animate__fadeIn">
                    <div>
                    <div class="h-10 overflow-hidden flex items-center">
                        <img class="w-[200px] w-auto" :src=primary_logo alt="dayalog" />
                    </div>
                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Don't have an account?
                        {{ ' ' }}
                        <Link :href="route('register')" class="font-semibold text-[#002760] hover:text-blue-700" >Sign up here</Link>
                    </p>
                    </div>

                <div class="mt-10">
                    <div>
        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <InputLabel for="email" value="Email address" />
                <div class="mt-2">
                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            </div>

            <div>
                <InputLabel for="password" value="Password" />
            <div class="mt-2">

                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
            </div>
        </div>

                        <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <Checkbox  id="remember-me" name="remember-me" v-model:checked="form.remember" />
                            <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-700">Remember me</label>
                        </div>

                        <div class="text-sm leading-6">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                        </div>
                        </div>

                <div>
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Sign In
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
                        <span class="bg-white px-6 text-gray-900">Or Create Account</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <Link :href="route('register')" class="flex w-full justify-center rounded-md bg-blue-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-700 focus-visible:outline">Signup</Link>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End of login -->
</template>

  <style scoped>

  </style>
