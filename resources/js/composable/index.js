import { computed, onMounted, ref } from 'vue'
import {
  CalendarIcon,
  ChartPieIcon,
  DocumentDuplicateIcon,
  ShoppingBagIcon,
  HomeIcon,
    UsersIcon,
  DeviceTabletIcon,
    QueueListIcon,
    TruckIcon
} from '@heroicons/vue/24/outline'
import { usePage } from '@inertiajs/vue3'

export default function useNavigation() {
  const url = computed(() => usePage().url)
  const host = ref(window.location.host)
  const protocol = ref(window.location.protocol);

  const link = computed(() =>{
    const baseUrl = `${protocol}//${host.value}`;
    return  baseUrl + (url.value == "/"?"": url.value)
  })

  const navigation = computed(() => [
    { name: 'Dashboard', href: route('dashboard'), icon: HomeIcon, current: route('dashboard').endsWith(url) },
    { name: 'Add Device', href: route('device.create'), icon: DeviceTabletIcon, current: route('device.create').endsWith(url) },
    { name: 'View Devices', href: route('devices.index'), icon: QueueListIcon, current: route('devices.index').endsWith(url) },
    { name: 'Create Driver', href: route('driver.create'), icon: UsersIcon, current: route('driver.create').endsWith(url) },
    { name: 'Vehicles', href: route('vehicle.view'), icon: TruckIcon, current: route('vehicle.create').endsWith(url) },
    { name: 'Add Vehicle', href: route('vehicle.create'), icon: UsersIcon, current: route('vehicle.create').endsWith(url) },
    { name: 'Orders', href: route('orders'), icon: ShoppingBagIcon, current: route('orders').endsWith(url) },
  ])

  const userNavigation = [
    { name: 'Your profile', href: route('profile.edit') },
    { name: 'Sign out', href: route('logout') , method:'post' },
  ]

  onMounted(()=>{
    host.value = window.location.host;
  })

  return { navigation, userNavigation , link }
}
