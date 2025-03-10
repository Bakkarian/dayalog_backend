<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
  name: '',
});
</script>

<template>
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">
      <h2 class="text-xl font-bold mb-4 text-center">Create Organization</h2>
      <form @submit.prevent="form.post(route('org.store'))">
        <div class="mb-4">
          <InputLabel for="name" value="Organization Name" />
          <TextInput
            id="name"
            v-model="form.name"
            type="text"
            class="mt-1 block w-full"
            autofocus
          />
          <InputError :message="form.errors.name" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
          <PrimaryButton class="ml-4" :disabled="form.processing">
            Create
          </PrimaryButton>
        </div>
      </form>
    </div>
  </div>
</template>

