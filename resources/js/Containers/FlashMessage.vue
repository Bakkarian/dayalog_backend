<template>
        <div v-if="flash.success || flash.error" :class="[ 'rounded-md p-4 mt-2 border', 
                        success ? 'bg-green-50 border-green-300' : '', error ? 'bg-red-50 border-red-400' : '',
        ]">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <CheckCircleIcon v-if="flash.success" class="h-5 w-5 text-green-400" aria-hidden="true" />
                        <XCircleIcon v-else-if="flash.error" class="h-5 w-5 text-red-400" aria-hidden="true" />
                    </div>
                    <div class="ml-3">
                        <p :class="[
                            'text-sm font-medium',
                            success ? 'text-green-800' : '',
                            error ? 'text-red-800' : '',
                        ]">{{ flash.error }} {{ flash.success }}</p>
                    </div>

                    <div class="ml-auto pl-3">
                        <template v-if="flash.actions"  v-for="(action, index) in flash.actions" :key="index" >
                            <Link v-if="action.type == 'href'" :href="action.url" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                                {{ action.name }}
                            </Link>
                        </template>
                    </div> 
                </div>
        </div>
</template>
<script setup>
import { CheckCircleIcon, XMarkIcon } from '@heroicons/vue/20/solid'
import { XCircleIcon } from '@heroicons/vue/20/solid'
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const flash = computed(() => usePage().props.flash)


</script>
