import { computed, onMounted, ref } from 'vue'
import {
  CalendarIcon,
  ChartPieIcon,
  DocumentDuplicateIcon,
  FolderIcon,
  HomeIcon,
    UsersIcon,
  DeviceTabletIcon,
    QueueListIcon
} from '@heroicons/vue/24/outline'
import { usePage } from '@inertiajs/vue3'

export default function useNavigation() {
  const url = computed(() => usePage().url)
  const host = ref(window.location.host)
  const link = computed(() =>{
    return  host.value + (url.value == "/"?"": url.value)
  })

  const navigation = computed(() => [
    { name: 'Dashboard', href: route('dashboard'), icon: HomeIcon, current: route('dashboard').endsWith(url) },
    { name: 'Add Device', href: route('device.create'), icon: DeviceTabletIcon, current: route('device.create').endsWith(url) },
    { name: 'View Devices', href: route('devices.view'), icon: QueueListIcon, current: route('devices.view').endsWith(url) },
    { name: 'Create Driver', href: route('driver.create'), icon: UsersIcon, current: route('driver.create').endsWith(url) },
    // { name: 'Create Driver', href: route('driver.create'), icon: UsersIcon, current: route('driver.create').endsWith(url) },
    /*{ name: 'Projects', href: route('test'), icon: FolderIcon, current: route('test').endsWith(url) },
    { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
    { name: 'Documents', href: '#', icon: DocumentDuplicateIcon, current: false },
    { name: 'Reports', href: '#', icon: ChartPieIcon, current: false },*/
  ])

  const userNavigation = [
    { name: 'Your profile', href: '#' },
    { name: 'Sign out', href: '#' },
  ]

  onMounted(()=>{
    host.value = window.location.host;
  })

  return { navigation, userNavigation , link }
}
