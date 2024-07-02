<script setup>
import { computed } from 'vue';
import { Head, Link, useForm} from '@inertiajs/vue3'
import Layout from '@/Layouts/MainLayout.vue'
import {
    ExclamationCircleIcon,
    CheckBadgeIcon,
} from '@heroicons/vue/24/solid'
import Pagination from '@/Components/Pagination.vue';
import  TextInput  from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import FlashMessage from '@/Containers/FlashMessage.vue';

defineOptions({ layout: Layout })

const props = defineProps({
    user: Object,
    roles: Array,
    permissions: Array
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    phone_number: props.user.phone_number,
    patasente_id: props.user.patasente_id,
    roles: props.user.roles.map(role => role.name),
    permissions: props.user.permissions.map(permission => permission.name),
})



const selectablePermissions = computed(() => {

    //get selected roles
    const selectedRoles = props.roles.filter(role => form.roles.includes(role.name));

    const selectedPermissions = selectedRoles.reduce((accumulator, role) => {
        return [...accumulator, ...role.permissions];
    }, []);


    const permissions = props.permissions.filter(permission => !selectedPermissions.map(e=> e.name).includes(permission.name));

    return permissions;
});

const submit = () => {
    form.transform((data) => {
        return {
            ...data,
            permissions: data.permissions.filter(
                permission => selectablePermissions.value
                            .map(e=> e.name)
                                .includes(permission)),
        }
    }).put(route('users.update', props.user.id))
}



</script>

<template>
    <Head :title="`Users - `+ user.name" />

    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <!-- Main area -->
        <div class="mb-8">
            <h1 class="text-xl">Edit User, {{ user.name }}</h1>
        </div>
        <div class="">
            <form   @submit.prevent="submit" >
            <div class="bg-white p-8 rounded-md border">

                <div class="grid lg:grid-cols-2 gap-8">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Name" />
                            <div class="mt-2">
                                <TextInput type="text" required placeholder="Plate number of the vehicle" v-model="form.name" />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Email " />
                            <div class="mt-2">
                                <TextInput type="text"  placeholder="email" v-model="form.email" />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="phone_number" value="Phone Number" />
                            <div class="mt-2">
                                <TextInput type="text"   v-model="form.phone_number" />
                                <InputError class="mt-2" :message="form.errors.phone_number" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Patasente Id" />
                            <div class="mt-2">
                                <TextInput type="text" placeholder="" v-model="form.patasente_id" />
                                <InputError class="mt-2" :message="form.errors.patasente_id" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Roles</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Select user roles</p>
                        </div>
                        <div class="sm:col-span-5 grid grid-cols-3 gap-2">
                            <div v-for="role in roles" :key="role.id">
                                <div class="flex items-center">
                                    <input type="checkbox" :value="role.name" v-model="form.roles" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label class="ml-2 block text-sm font-medium leading-6 text-gray-900">{{ role.name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <div>
                                <label for="permissions" class="block text-sm font-medium leading-6 text-gray-900">Permissions</label>
                                <select v-model="form.permissions" id="permissions" name="permissions" multiple class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option :key="permission.name" v-for="permission in selectablePermissions" :value="permission.name">{{ permission.name }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.permissions" />
                            </div>
                        </div>
                    </div>
                </div>
                <FlashMessage />
                <div class="flex justify-end">
                    <button type="submit" class="rounded-md mt-12 bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</template>
