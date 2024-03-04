<template>
    <div class="block max-w-[400px] bg-white mx-auto mt-12 p-4 rounded-md">

        <div class="p-4 lg:bg-[#002760] flex items-center rounded-md shadow-md">
            <img class="h-8 w-auto" src="../assets/LOGO.png" alt="Dayalog" />
        <h1 class="flex-auto text-white">Order: 234567899</h1>
        </div>
        <hr class="my-4" />
        <ul role="list" class="space-y-6">
            <li v-for="(activityItem, activityItemIdx) in activity" :key="activityItem.id" class="relative flex gap-x-4">
            <div :class="[activityItemIdx === activity.length - 1 ? 'h-6' : '-bottom-6', 'absolute left-0 top-0 flex w-6 justify-center']">
                <div class="w-px bg-gray-200" />
            </div>

                <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                <SignalIcon v-if="activityItem.type === 'active'" class="h-6 w-6 text-green-600" aria-hidden="true" />
                <div v-else class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300" />
                </div>
                <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500">
                <span class="font-medium text-gray-900">{{ activityItem.stage }}</span> {{ activityItem.type }}
                </p>
                <time :datetime="activityItem.dateTime" class="flex-none py-0.5 text-xs leading-5 text-gray-500">{{ activityItem.type != 'pending'?activityItem.date:'...' }}</time>
            
            </li>
        </ul>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
import { SignalIcon } from '@heroicons/vue/24/solid'
import {
  FaceFrownIcon,
  FaceSmileIcon,
  FireIcon,
  HandThumbUpIcon,
  HeartIcon,
  PaperClipIcon,
  XMarkIcon,
} from '@heroicons/vue/20/solid'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'

let activity = [
  { id: 1, type: 'done', stage: 'Processing', date: '7d ago', dateTime: '2023-01-23T10:32' },
  { id: 1, type: 'done', stage: 'Packaging', date: '7d ago', dateTime: '2023-01-23T10:32' },
  { id: 1, type: 'done', stage: 'Trip started', date: '7d ago', dateTime: '2023-01-23T10:32' },
  { id: 6, type: 'active', stage: 'In transit', date: '1d ago', dateTime: '2023-01-24T09:20' },
  { id: 5, type: 'pending', stage: 'Delivered', date: '2d ago', dateTime: '2023-01-24T09:12' },
]
  </script>