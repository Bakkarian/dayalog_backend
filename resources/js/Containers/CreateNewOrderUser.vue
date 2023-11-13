<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, reactive } from 'vue';

const page = usePage();
const csrf_token = computed(() => page.props.csrf_token)
const props  = defineProps({
    onCreateNewUser: {

    }
})

const formData = reactive({
    name:"",
    email:""
})


const createUser = async (event) => {
    try {
    const response = await fetch(route('web_api.createUser'), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': csrf_token.value
      },
      body: JSON.stringify(formData)
    });

    if (!response.ok) {
      throw new Error('Failed to create user');
    }

    // Reset form data after successful user creation
    formData.name = '';
    formData.email = '';

    // Optionally, you can handle the response here (e.g., show a success message)
    const result = await response.json();
    props.onCreateNewUser(result)

  } catch (error) {
    console.error('Error creating user:', error.message);
  }

}

</script>
<template>
<form  >
    <div class="">
        <div  class="bg-white p-4 rounded-md border max-w-[400px] animate__animated animate__fadeInRight">
            <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                <div class="mt-2">
                    <input  type="text" v-model="formData.name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Full Name" />
                </div>
            </div>
            <div class="mt-2">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                    <input type="email" v-model="formData.email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="you@example.com" />
                </div>
            </div>
            <button type="button" @click="createUser" class="rounded-md mt-4 bg-green-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500">Add User</button>
        </div>
    </div>
</form>
</template>
