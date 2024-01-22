<template>
<Loader v-if="loading" />
<div v-else class="bg-white sm:rounded-md">
    <ul role="list" class="divide-y divide-gray-200">
    <li v-for="driver in drivers" >
        <Link :href="route('dashboard', { driver : 2 })">
            <div class="block hover:bg-gray-50 cursor-pointer">
            <div class="px-4 py-4 sm:px-6">
                <div class="flex items-center justify-between">
                <p class="truncate text-sm font-medium text-gray-900">Isakiye Afasha</p>
                <div class="ml-2 flex flex-shrink-0">
                    <p class="inline-flex rounded-full px-2 text-xs font-semibold leading-5" :class="true ? 'text-green-800 bg-green-100':'text-red-800 bg-red-100'">{{ true ?'On Trip':'Not On Trip' }}</p>
                </div>
                </div>
                <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">
                    <p class="flex items-center text-sm text-gray-500">
                    <ClockIcon class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    Trip: 5PM  <!-- {{ driver.lastDispatch ? dayjs(driver.lastDispatch?.created_at).fromNow():"" }} -->
                    </p>
                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:ml-6 sm:mt-0">
                    <MapPinIcon class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    To: Kawempe  <!--  {{ driver.lastDispatch?.destination }} -->
                    </p>
                </div>
                </div>
            </div>
            </div>
        </Link>

        <div :class="true ? 'h-[420px]':'h-0'" class="overflow-hidden bg-gray-50 transition-all ease-in-out duration-300">
        <div class="p-3 flex items-center border-b border-t">
            <div class="animate__animated" :class="true ?'animate__fadeInRight':'animate__fadeOutUp'">
            <button type="button" class="rounded-full bg-white border p-1 text-gray-500 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                <ArrowLeftIcon class="h-5 w-5" aria-hidden="true" />
              </button>
            </div>
            <h5 class="text-md font-bold ml-4 animate__animated animate__delay-0.3s" :class="true ?'animate__fadeInRight':'animate__fadeOutUp'">{{'Hello'}}</h5>
          </div>
          <ul role="list" class="space-y-6 p-3 overflow-hidden">
            <li class="relative flex gap-x-4">
              <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                <div class="w-px bg-gray-200"></div>
              </div>
              <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-green-500 rounded-full">
                <div class="h-1.5 w-1.5 rounded-full bg-green-100 ring-1 ring-white"></div>
              </div>
              <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span class="font-medium text-gray-900">{{'driver.from'}}</span> {{' driver.lastDispatch?.origin' }}, Pickup Point.</p>
              <time datetime="2023-01-23T10:32" class="flex-none py-0.5 text-xs leading-5 text-gray-500">"  "</time>
            </li>

            <li v-for="stop in props.driver?.dispatched_vehicle?.latest_active_dispatch?.stops"  class="relative flex gap-x-4">
              <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                <div class="w-px bg-gray-200"></div>
              </div>

              <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white rounded-full">
                <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
              </div>
              <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span class="font-medium text-gray-900">Stop: 1</span> Mbarara town -
                <a href="#" class="text-blue-400">{{ stop?.device_position?.latitude }},{{ stop?.device_position?.longitude }} </a></p>
              <time datetime="2023-01-23T11:03" class="flex-none py-0.5 text-xs leading-5 text-gray-500">11:14am</time>
            </li>

            <li class="relative flex gap-x-4">
              <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                <div class="w-px bg-gray-200"></div>
              </div>

              <img src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="relative mt-3 h-6 w-6 flex-none rounded-full bg-gray-50">
              <div class="flex-auto rounded-md p-3 ring-1 ring-inset ring-gray-200">
                <div class="flex justify-between gap-x-4">
                  <div class="py-0.5 text-xs leading-5 text-gray-500"><span class="font-medium text-gray-900">{{' driver.nameDriverList1' }}</span> Current Location</div>
                  <time datetime="2023-01-23T15:56" class="flex-none py-0.5 text-xs leading-5 text-gray-500">now</time>
                </div>
                <p class="text-sm leading-6 text-gray-500">Mpigi - Masaka Kampala Rd</p>
                <p class="text-xs leading-6 text-gray-500">Speed: 40km/h</p>
              </div>
            </li>

            <li class="relative flex gap-x-4">
              <div class="absolute left-0 top-0 flex w-6 justify-center h-6">
                <div class="w-px bg-gray-200"></div>
              </div>

            <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                <MapPinIcon class="h-6 w-6 text-blue-600" />
            </div>
            <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span class="font-medium text-gray-900">{{ 'driver.lastDispatch?.destination'  }}.</span> Final Delivery Point.</p>
            <time datetime="2023-01-24T09:20" class="flex-none py-0.5 text-xs leading-5 text-gray-500">...</time>
            </li>
        </ul>
        <div class="w-full p-3">
            <button type="button" @click="true?'animate__fadeInDown':'animate__fadeOutUp'" class="animate__animated rounded-md w-full bg-[#002760] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">More Details</button>
        </div>
        </div>
    </li>
</ul>
  </div>

</template>

<script setup>
import { MapPinIcon, ClockIcon, ArrowLeftIcon } from '@heroicons/vue/20/solid'
import { Link, usePage } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue';
import Loader from './Loader.vue';
import dayjs from 'dayjs'
import * as relativeTime from 'dayjs/plugin/relativeTime'
import { computed } from 'vue';
dayjs.extend(relativeTime)
const loading = ref(false);
const openDetails = ref(false)
const page = usePage();
const drivers = computed(() => page.props.drivers)

</script>
