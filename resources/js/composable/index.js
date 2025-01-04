import { computed, onMounted, ref } from 'vue'
import {
  ChartPieIcon,
  ShoppingBagIcon,
  UserIcon,
  HomeIcon,
  UsersIcon,
  DeviceTabletIcon,
  QueueListIcon,
  TruckIcon,
  MagnifyingGlassIcon
} from '@heroicons/vue/24/outline'
import { usePage } from '@inertiajs/vue3'

export default function useNavigation() {
  const url = computed(() => usePage().url)
  const host = ref(window.location.host)
  const protocol = ref(window.location.protocol);
  const page = usePage();
  const permissions =  computed(() => page.props.auth.permissions).value

  const currentLink = computed(() =>{
    const url = page.url;
    const baseUrl = `${protocol.value}//${host.value}`;
    return  baseUrl + (url == "/"?"": url)
  })

  const link = computed(() =>{
    const baseUrl = `${protocol}//${host.value}`;
    return  baseUrl + (url.value == "/"?"": url.value)
  })

  /**Define routes which have a short layout */
  const shortLayout = () => {
    return [
      route().current('order.view-order-map'),
      route().current('device.history'),
      route().current('dashboard'),
    ].some(r => r)
  }

  const navigation = computed(() => [
    {
        name: 'Dashboard',
        href: route('dashboard'),
        icon: HomeIcon,
        current: route('dashboard').endsWith(url),
        permissions: [
            'devices.view',
            'devices.track',
        ]
     },
     {
        name: 'Client Dashboard ',
        href: route('client.dashboard'),
        icon: ChartPieIcon,
        current: route('client.dashboard').endsWith(url),
        permissions:[
            'view.client.dashboard',
        ]
    },
    {
        name: 'Add Device',
        href: route('device.create'),
        icon: DeviceTabletIcon,
        current: route('device.create').endsWith(url),
        permissions: [
            'devices.add',
        ]
     },
    {
        name: 'View Devices',
        href: route('devices.index'),
        icon: QueueListIcon,
         current: route('devices.index').endsWith(url),
        permissions :[
            'devices.view',
        ]
     },
    {
        name: 'Create Driver',
        href: route('driver.create'),
        icon: UsersIcon,
        current: route('driver.create').endsWith(url),
        permissions :[
            'drivers.create',
        ]
    },
    {
        name: 'Vehicles',
        href: route('vehicle.view'),
        icon: TruckIcon,
        current: route('vehicle.create').endsWith(url),
        permissions:[
           'vehicles.view',
        ]
    },
    {
        name: 'Add Vehicle',
        href: route('vehicle.create'),
         icon: UsersIcon,
         current: route('vehicle.create').endsWith(url),
         permissions:[
            'vehicles.add',
        ]
    },
    {
        name: 'Orders',
        href: route('orders'),
        icon: ShoppingBagIcon,
        current: route('orders').endsWith(url),
        permissions:[
            'orders.view',
            'owned.order.view',
        ]
    },
    {
        name: 'Users',
        href: route('users.index'),
        icon: UserIcon,
        current: route('users.index').endsWith(url),
        permissions:[
            'users.create',
        ]
    },

    {
        name: 'Search Vehicle ',
        href: route('clientCreatePackage.addPackage'),
        icon: MagnifyingGlassIcon, current: route('clientCreatePackage.addPackage').endsWith(url),
        permissions:[
            'view.client.dashboard',
        ]

    },
  ])

  const userNavigation = [
    { name: 'Your profile', href: route('profile.edit') },
    { name: 'Sign out', href: route('logout') , method:'post' },
  ]

  onMounted(()=>{
    host.value = window.location.host;
  })


 const filteredNavigation = (navigation) => navigation.value.filter((navigation)=>{ return navigation.permissions.some(permission => permissions.includes(permission)); });


  return { navigation:filteredNavigation(navigation) , userNavigation , shortLayout }
}
