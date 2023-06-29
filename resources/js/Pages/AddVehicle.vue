<template>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6 max-w-7xl">
        <!-- Main area -->
        <div class="mb-8">
            <h1 class="text-xl">Add Vehicle</h1>
        </div>
        <div class="">
            <form @submit.prevent="submitForm">
            <div class="bg-white p-8 rounded-md border">
                <p class="text-xs mt-0">Field Marked with "<strong>*</strong>" are required</p>
                <div class="grid lg:grid-cols-2 gap-8">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Number Plate / Plate Number *" />
                            <div class="mt-2">
                                <TextInput type="text" required placeholder="Plate number of the vehicle" v-model="form.number_plate" />
                                <InputError class="mt-2" :message="form.errors.number_plate" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Vin Number *" />
                            <div class="mt-2">
                                <TextInput type="text" required placeholder="VIN" v-model="form.vin" />
                                <InputError class="mt-2" :message="form.errors.vin" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Make *" />
                            <div class="mt-2">
                                <TextInput type="text" required placeholder="Eg: Mercedes" v-model="form.make" />
                                <InputError class="mt-2" :message="form.errors.make" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Model *" />
                            <div class="mt-2">
                                <TextInput type="text" required placeholder="Eg: Actros 2330" v-model="form.model" />
                                <InputError class="mt-2" :message="form.errors.model" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <div>
                                <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Availability</label>
                                <select v-model="form.availability" id="location" name="location" required class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option :value="true">Yes</option>
                                    <option :value="false">No</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.availability" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Capacity Weight (Kgs) *" />
                            <div class="mt-2">
                                <TextInput type="number" required placeholder="Weight Capacity of vehicle" v-model="form.capacity_weight" />
                                <InputError class="mt-2" :message="form.errors.capacity_weight" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Capacity Volume (litres)*" />
                            <div class="mt-2">
                                <TextInput type="number" required placeholder="Cargo Space of the Vehicle" v-model="form.capacity_volume" />
                                <InputError class="mt-2" :message="form.errors.capacity_volume" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Insurance Policy Number *" />
                            <div class="mt-2">
                                <TextInput type="text" required placeholder="Insurance" v-model="form.insurance_policy_number" />
                                <InputError class="mt-2" :message="form.errors.insurance_policy_number" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Insurance Coverage" />
                            <div class="mt-2">
                                <TextInput type="text" required placeholder="Coverage" v-model="form.insurance_coverage" />
                                <InputError class="mt-2" :message="form.errors.insurance_coverage" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <InputLabel for="email" value="Insurance Expiration" />
                            <div class="mt-2">
                                <TextInput type="date" placeholder="" v-model="form.insurance_expiration" />
                                <InputError class="mt-2" :message="form.errors.insurance_expiration" />
                            </div>
                        </div>
                        <div class="sm:col-span-5">
                            <AttachDevice  v-model="form.attached_device_id" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="rounded-md mt-12 bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Vehicle</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import AttachDevice from '@/Containers/AttachDevice.vue'
import { useForm } from '@inertiajs/vue3'
import  TextInput  from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const form = useForm({
    vin:"",
    number_plate:"",
    make:"",
    model:"",
    capacity_weight:"",
    capacity_volume:"",
    availability:true,
    insurance_policy_number:"",
    insurance_coverage:"",
    insurance_expiration:"",
    attached_device_id: "",
})

const submitForm = () =>
{
    form.post(route('vehicle.store'),{
        onSuccess:() => {
            form.reset()
        }
    })
}

</script>
