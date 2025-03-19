<script setup>
import { computed, watch } from 'vue';
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
import { ref } from 'vue';

defineOptions({ layout: Layout })




const addressData = computed(
    () => props.addresses
)

const countries  = computed(()=>{
    return Object.values(addressData.value.countries);
})


const regions  = computed(()=>{
    if(form.user_meta.country == null || form.user_meta.country == ""){ 
         return []
    };
    const x = Object.values( addressData.value.countries);
    const selectedCountry = x.find(z=>z.name == form.user_meta.country)
    return Object.values(selectedCountry.regions);
})

const subregions  = computed(()=>{
    if(form.user_meta.region == null || form.user_meta.region == ""){
         return []
    };
    const x = Object.values( regions.value);

    const selectedRegion = x.find(z=>z.name == form.user_meta.region)

    return Object.values(selectedRegion.subregions);
})

const districts  = computed(()=>{
    if(form.user_meta.subregion == null || form.user_meta.subregion == ""){ 
        return []
    };
    const x = Object.values( subregions.value);
    const selectedSubregion = x.find(z=>z.name == form.user_meta.subregion)
    return Object.values(selectedSubregion.districts);
})

const cities  = computed(()=>{
    if(form.user_meta.district == null || form.user_meta.district == "") {
        return []
    };
    const x = Object.values( districts.value);
    
    const selectedDistrict = x.find(z=>z.name == form.user_meta.district)
    return Object.values(selectedDistrict.cities);
})

const divisions  = computed(()=>{
    if(form.user_meta.city == null || form.user_meta.city == "") return [];
    const x = Object.values( cities.value);
    const selectedCity = x.find(z=>z.name == form.user_meta.city)
    return Object.values(selectedCity.divisions);
})

const departments = []


const props = defineProps({
    user: Object,
    roles: Array,
    permissions: Array,
    user_meta : Object,
    addresses: Object
})


const form = useForm({
    name: props.user.name,
    email: props.user.email,
    phone_number: props.user.phone_number,
    patasente_id: props.user.patasente_id,
    roles: props.user.roles.map(role => role.name),
    permissions: props.user.permissions.map(permission => permission.name),
    user_meta : {
        reference_id: props.user_meta.reference_id,

        date_of_birth:props.user_meta.date_of_birth,
        gender: props.user_meta.gender,
        marital_status: props.user_meta.marital_status,

        account_type: props.user_meta.account_type,

        business_name : props.user_meta.business_name,
        position : props.user_meta.position,

        occupation : props.user_meta.occupation,
        industry : props.user_meta.industry,

        country: props.user_meta.country,
        region: props.user_meta.region,
        subregion: props.user_meta.subregion,

        district: props.user_meta.district,
        city: props.user_meta.city,
        division: props.user_meta.division,

        market_name: props.user_meta.market_name,
        coordinator: props.user_meta.coordinator,
        stall_number: props.user_meta.stall_number,

        departments: props.user_meta.departments

    },
})


watch(() => [form.user_meta.country ], (newValue, oldValue) => {
    form.user_meta.region = "";
    form.user_meta.subregion = "";
    form.user_meta.district = "";
    form.user_meta.city = "";
    form.user_meta.division = "";
})

watch(() => [form.user_meta.region ], (newValue, oldValue) => {
    form.user_meta.subregion = "";
    form.user_meta.district = "";
    form.user_meta.city = "";
    form.user_meta.division = "";
})

watch(() => [form.user_meta.subregion ], (newValue, oldValue) => {
    form.user_meta.district = "";
    form.user_meta.city = "";
    form.user_meta.division = "";
})

watch(() => [form.user_meta.district ], (newValue, oldValue) => {
    form.user_meta.city = "";
    form.user_meta.division = "";
})

watch(() => [form.user_meta.city ], (newValue, oldValue) => {
    form.user_meta.division = "";
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
                            <InputLabel for="email" value="Binjii Merchant ID" />
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

                <br> 
                <br>



                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <InputLabel for="reference_id" value="Reference ID" />
                        <p class="mt-3  text-sm leading-6 text-gray-500">This can be any form of external unique identifier. For example, an id from another system or records book etc.</p>
                        
                        <div class="mt-2">
                            <TextInput type="text"  placeholder="Reference ID" v-model="form.user_meta.reference_id" />
                            <!-- <InputError class="mt-2" :message="form.errors.user_meta.reference_id" /> -->
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <h2>Personal Information</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-3">
                    <div class="sm:col-span-1">
                        <div>
                            <label for="date-of-birth" class="block text-sm font-medium leading-6 text-gray-900">Date of birth</label>
                            <input type="date" v-model="form.user_meta.date_of_birth" id="date-of-birth" name="date_of_birth" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <!-- <InputError class="mt-2" :message="form.errors.user_meta.date_of_birth" /> -->
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <div>
                            <label for="marital-status" class="block text-sm font-medium leading-6 text-gray-900">Marital Status</label>
                            <select v-model="form.user_meta.marital_status" id="marital-status" name="marital-status" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                            </select>
                            <!-- <InputError class="mt-2" :message="form.errors.user_meta.marital_status" /> -->
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <div>
                            <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
                            <select v-model="form.user_meta.gender" id="gender" name="gender" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <!-- <InputError class="mt-2" :message="form.errors.user_meta.gender" /> -->
                        </div>
                    </div>
                    
                </div>
                <br>

                <h2>Business Information</h2>
                
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-3">
                    <div class="sm:col-span-3">
                        <InputLabel for="how-do-you-work-with-this-user" value="How do you work with this user/client?" />
                        <div class="mt-2 flex items-center space-x-4">
                            <div class="flex items-center">
                                <input v-model="form.user_meta.account_type" id="individual" name="how-do-you-work-with-this-user" type="radio" value="individual" class="focus:ring-indigo-600 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                <label for="individual" class="ml-3 block text-sm font-medium text-gray-700 inline">
                                    Individual
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input v-model="form.user_meta.account_type" id="business" name="how-do-you-work-with-this-user" type="radio" value="business" class="focus:ring-indigo-600 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                <label for="business" class="ml-3 block text-sm font-medium text-gray-700 inline">
                                    Business
                                </label>
                            </div>
                            <!-- <InputError class="mt-2" :message="form.errors.how_do_you_work_with_this_user" /> -->
                        </div>
                    </div>


                    <div class="sm:col-span-3" v-if="form.user_meta?.account_type === 'business'">
                        <InputLabel for="business_name" value="Business Name" />
                        <div class="mt-2">
                            <TextInput id="business_name" type="text"  v-model="form.user_meta.business_name" />
                            <!-- <InputError class="mt-2" :message="form.errors.business_name" /> -->
                        </div>
                    </div>
                    <div class="sm:col-span-3" v-if="form.user_meta?.account_type === 'business'">
                        <InputLabel for="position" value="Position" />
                        <div class="mt-2">
                            <TextInput id="position" type="text"  v-model="form.user_meta.position" />
                            <!-- <InputError class="mt-2" :message="form.errors.position" /> -->
                        </div>
                    </div>                        



                    <div class="sm:col-span-3">
                        <InputLabel for="occupation" value="occupation" />
                        <div class="mt-2">
                            <TextInput id="occupation" type="text"  v-model="form.user_meta.occupation" />
                            <!-- <InputError class="mt-2" :message="form.errors.occupation" /> -->
                        </div>
                    </div>


                    <div class="sm:col-span-3">
                        <InputLabel for="industry" value="Industry" />
                        <div class="mt-2">
                            <TextInput id="industry" type="text"  v-model="form.user_meta.industry" />
                            <!-- <InputError class="mt-2" :message="form.errors.industry" /> -->
                        </div>
                    </div>


                </div>


                <br>
                <h2>Address Information</h2>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <InputLabel for="country" value="Country" />
                        <div class="mt-2">
                            <select v-model="form.user_meta.country" id="country" name="country" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select Country</option>
                                <option :value="country.name" :key="country.name" v-for="country in countries" >{{ country.name }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.country" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="region" value="Region" />
                        <div class="mt-2">
                            <select v-model="form.user_meta.region" id="region" name="region" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select Region</option>
                                <option :value="region.name" :key="region.name" v-for="region in regions" >{{ region.name }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.region" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="subregion" value="Subregion" />
                        <div class="mt-2">
                            <select v-model="form.user_meta.subregion" id="subregion" name="subregion" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select Subregion</option>
                                <option :value="subregion.name" :key="subregion.name" v-for="subregion in subregions" >{{ subregion.name }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.subregion" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="district" value="District" />
                        <div class="mt-2">
                            <select v-model="form.user_meta.district" id="district" name="district" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select District</option>
                                <option :value="district.name" :key="district.code" v-for="district in districts" >{{ district.name }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.district" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="city" value="City" />
                        <div class="mt-2">
                            <select v-model="form.user_meta.city" id="city" name="city" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select City</option>
                                <option :value="city.name" :key="city.code" v-for="city in cities" >{{ city.name }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.city" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="division" value="Division" />
                        <div class="mt-2">
                            <select v-model="form.user_meta.division" id="division" name="division" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select Division</option>
                                <option :value="division.name" :key="division.code" v-for="division in divisions" >{{ division.name }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.division" />
                        </div>
                    </div>
                </div>
                
                <br> 
                
                <h2>Market Information (Only if Applies)</h2>

                <br> 
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <InputLabel for="market_name" value="Market Name" />
                        <div class="mt-2">
                            <input type="text" v-model="form.user_meta.market_name" id="market_name" name="market_name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <!-- <InputError class="mt-2" :message="form.errors.market_name" /> -->
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="coordinator" value="Coordinator" />
                        <div class="mt-2">
                            <input type="text" v-model="form.user_meta.coordinator" id="coordinator" name="coordinator" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <!-- <InputError class="mt-2" :message="form.errors.coordinator" /> -->
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="stall_number" value="Stall Number" />
                        <div class="mt-2">
                            <input type="text" v-model="form.user_meta.stall_number" id="stall_number" name="stall_number" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <!-- <InputError class="mt-2" :message="form.errors.stall_number" /> -->
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="department" value="Department" />
                        <div class="mt-2">
                            <select v-model="form.user_meta.department" id="department" name="department"  class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select Department</option>
                                <option :value="department.name" :key="department.name" v-for="department in departments" >{{ department.name }}</option>
                            </select>
                            <!-- <InputError class="mt-2" :message="form.errors.departments" /> -->
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
