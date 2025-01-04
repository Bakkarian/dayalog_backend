<script setup>
 import Map from '@/Components/Map.vue';
 import useDashboardMap from '@/composable/dashboardMap';
import { onUnmounted } from 'vue';

 const { loaded } = useDashboardMap()

</script>

<template>
    <div class="">
      <div class="absolute top-0 bottom-0 right-0 left-0 lg:left-[350px]">
        <Map />
      </div>
      <div class="bg-gradient-to-r from-gray-100 lg:left-[350px] top-0 bottom-0 w-[50px] absolute"></div>
      <div class="absolute right-0 left-0">
        <div class="relative">
          <aside v-if="loaded" class="fixed bottom-0 left-20 top-16 hidden w-96 border-r border-gray-200 px-4 py-6 sm:px-6 lg:px-8 xl:block animate__animated animate__fadeIn">
            <slot name="aside"></slot>
          </aside>
        </div>
      </div>

      <div>
        <slot v-if="loaded" ></slot>
      </div>

    </div>
</template>
