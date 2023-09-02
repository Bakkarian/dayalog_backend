<template>
    <Head title="Dashboard" />
    <div class="">
      <div class="absolute top-0 bottom-0 right-0 left-0">
        <!--      <img src="./assets/map.png" class="h-full" />-->
        <div id="map" class="h-full w-full"></div>
      </div>
      <div class="absolute right-0 left-0">
        <TransitionRoot as="template" :show="sidebarOpen">
          <Dialog as="div" class="relative z-50 lg:hidden" @close="sidebarOpen = false">
            <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
              <div class="fixed inset-0 bg-gray-900/80" />
            </TransitionChild>
            <div class="fixed inset-0 flex">
              <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
                  <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                      <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                        <span class="sr-only">Close sidebar</span>
                        <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                      </button>
                    </div>
                  </TransitionChild>

                  <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-2 ring-1 ring-white/10">
                    <div class="flex h-16 shrink-0 items-center">
                      <img class="h-8 w-auto" src="../assets/LOGO.png" alt="Dayalog" />
                    </div>
                    <nav class="flex flex-1 flex-col">
                      <ul role="list" class="-mx-2 flex-1 space-y-1">
                        <li v-for="item in navigation" :key="item.name">
                          <Link :href="item.href" :class="[item.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                            <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                            {{ item.name }}
                          </Link>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </DialogPanel>
              </TransitionChild>
            </div>
          </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:block lg:w-20 lg:overflow-y-auto lg:bg-[#002760] lg:pb-4 rounded-lg m-4 animate__animated animate__fadeInLeft animate__faster">
          <div class="flex h-16 shrink-0 items-center justify-center">
            <img class="h-8 w-auto" src="../assets/LOGO.png" alt="Dayalog" />
          </div>
          <nav class="mt-8">
            <ul role="list" class="flex flex-col items-center space-y-1">
              <li v-for="item in navigation" :key="item.name">
                <Link :href="item.href" :class="[item.href.endsWith(url) ? 'bg-black bg-opacity-30 text-red' : 'text-gray-400 hover:text-white hover:bg-black hover:bg-opacity-20', 'group flex gap-x-3 rounded-md p-3 text-sm leading-6 font-semibold']">
                  <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                  <span class="sr-only">{{ item.name }}</span>
                </Link>
              </li>
            </ul>
          </nav>
        </div>

        <div class="lg:pl-20">
          <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-md sm:gap-x-6 sm:px-6 lg:px-8 lg:my-4 mr-4 ml-8 rounded-lg animate__animated animate__fadeInDown">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
              <span class="sr-only">Open sidebar</span>
              <Bars3Icon class="h-6 w-6" aria-hidden="true" />
            </button>

            <!-- Separator -->
            <div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true" />

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
              <form class="relative flex flex-1" action="#" method="GET">
                <label for="search-field" class="sr-only">Search</label>
                <MagnifyingGlassIcon class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400" aria-hidden="true" />
                <input id="search-field" class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm" placeholder="Search..." type="search" name="search" />
              </form>
              <div class="flex items-center gap-x-4 lg:gap-x-6">
                <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                  <span class="sr-only">View notifications</span>
                  <BellIcon class="h-6 w-6" aria-hidden="true" />
                </button>

                <!-- Separator -->
                <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-900/10" aria-hidden="true" />

                <!-- Profile dropdown -->
                <Menu as="div" class="relative">
                  <MenuButton class="-m-1.5 flex items-center p-1.5">
                    <span class="sr-only">Open user menu</span>
                    <img class="h-8 w-8 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                    <span class="hidden lg:flex lg:items-center">
                    <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">Tom Cook</span>
                    <ChevronDownIcon class="ml-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                  </span>
                  </MenuButton>
                  <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                    <MenuItems class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                      <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                        <Link :href="item.href" :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']">{{ item.name }}</Link>
                      </MenuItem>
                    </MenuItems>
                  </transition>
                </Menu>
              </div>
            </div>
          </div>

          <main class="xl:pl-96">
            <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
              <!-- Main area -->
            </div>
          </main>
        </div>

        <aside class="fixed bottom-0 left-20 top-16 hidden w-96 border-r border-gray-200 px-4 py-6 sm:px-6 lg:px-8 xl:block animate__animated animate__fadeIn">
          <!-- Secondary column (hidden on smaller screens) -->
          <div id="driver-list" class="mt-8 w-full overflow-y-auto bg-white h-40 shadow-lg rounded-md transition-all ease-in-out duration-300">
            <DriverList1 :routeFunction="showroute" />
          </div>
        </aside>
      </div>

      <!--    <MapExample />-->

    </div>
  </template>

  <script setup>
  import { ref} from 'vue'
  import Layout from '@/Layouts/NoLayout.vue';
  import DriverList1 from "@/Containers/DriverList1.vue";
  import { Loader } from "@googlemaps/js-api-loader"
  import markr from "@/assets/marker.png"
  import {
    Dialog,
    DialogPanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
  } from '@headlessui/vue'
  import {
    Bars3Icon,
    BellIcon,
    XMarkIcon,
  } from '@heroicons/vue/24/outline'
  import { ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
  import useNavigation from '@/composable'
  import { Head, Link, usePage } from '@inertiajs/vue3';
  import { computed, onMounted, defineProps } from 'vue';

  defineOptions({ layout: Layout })

  const props = defineProps(['devices'])

  const url = computed(() => usePage().url)
  const { navigation, userNavigation } = useNavigation()

  const sidebarOpen = ref(false)
  let loadingList = ref(true)


  setTimeout(function(){
    let element = document.getElementById("driver-list")
    element.classList.remove("h-40")
    element.classList.add("h-[85%]")
    loadingList.value = false;
  },1000)

  const loader = new Loader({
    apiKey: "AIzaSyAir29_hRhb99ll83YjLarlSbj-9su5zXI",
    version: "weekly",

  });
  const mapStyle = [
          /*{
              "featureType": "administrative.land_parcel",
              "elementType": "labels",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },*/
          {
              "featureType": "landscape.natural.landcover",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "landscape.natural.terrain",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "poi",
              "elementType": "labels.text",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "poi.business",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "poi.park",
              "elementType": "labels.text",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "road.arterial",
              "elementType": "labels",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "road.highway",
              "elementType": "labels",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "road.local",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "road.local",
              "elementType": "labels",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          }
  ];
  let map;
  const markerImage = markr;
  let locations = [

  ];
  let locationMarkers = [];
  let bounds;
  function loadMap(){
      loader.load().then(async () => {
          const { Map } = await google.maps.importLibrary("maps");
          const { AdvancedMarkerView } = await google.maps.importLibrary("marker");
          // const { DirectionsService, DirectionsRenderer } = await google.maps.importLibrary("directions");
          let position = {lat: 0.297784, lng: 32.544896}


          map = new Map(document.getElementById("map"), {
              center: { lat: 0.297784, lng: 32.544896 },
              zoom: 9,
              mapTypeId: 'roadmap',
              // mapId: "7c96e127d329f19d",
              styles: mapStyle,
              // Remove Controls
              streetViewControl: false, // Remove street view control
              // zoomControl: false, // Remove zoom control
              mapTypeControl: false, // Remove map type control
          });


          locations.forEach((mkr) => {
              const marker = new google.maps.Marker({
                  position: mkr.position,
                  map: map,
                  title: mkr.title,
                  icon: {
                      url: markerImage,
                      scaledSize: new google.maps.Size(40, 40)
                  },
                  /*label: {
                    text: "A",
                    color: "white"
                  },*/
                  animation: google.maps.Animation.DROP,
                  clickable: true,
                  draggable: false
              });
              const infowindow = new google.maps.InfoWindow({
                  content: '' +
                      '<div class="h-24 w-72">\n' +
                      '        <div class="cursor-pointer">\n' +
                      '          <div class="sm:px-4">\n' +
                      '            <div class="flex items-center justify-between">\n' +
                      '              <p class="truncate text-sm font-medium text-gray-900">'+mkr.title+'</p>\n' +
                      '              <div class="ml-2 flex flex-shrink-0">\n' +
                      '                <p class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100">'+mkr.status+'</p>\n' +
                      '              </div>\n' +
                      '            </div>\n' +
                      '            <!--<div class="mt-2 flex justify-between">\n' +
                      '              <div class="flex">\n' +
                      '                <p class="flex items-center text-sm text-gray-500">\n' +
                      '                  Trip: 2 Hrs\n' +
                      '                </p>\n' +
                      '                <p class="mt-2 flex items-center text-sm text-gray-500 sm:ml-6 sm:mt-0">\n' +
                      '                  To: Jinja\n' +
                      '                </p>\n' +
                      '              </div>\n' +
                      '            </div>-->\n' +
                      '          </div>\n' +
                      '        </div></div>'
              });

              marker.addListener('click', () => {
                  infowindow.open(map, marker);
              });

              locationMarkers.push(marker);
              const bounds = new google.maps.LatLngBounds();
              locations.forEach(position => {
                  bounds.extend(position.position);
              });

              const padding = 150; // Adjust this padding as needed
              map.fitBounds(bounds, padding);
          });
      });
  }
  /*function clickAction(){
    loader.deleteScript();
  }*/
  let marker, directionsService, directionsRenderer;
  const markers = [
    { position: { lat: 0.297784, lng: 32.544896 }, title: "Marker 1" },
    { position: { lat: 0.292162, lng: 32.5485867 }, title: "Marker 2" },
  ];
  function clearMarkers() {
      locationMarkers.forEach(marker => {
          marker.setMap(null); // Remove the marker from the map
      });

      locationMarkers.pop(); // Clear the MVCArray
  }
  const showroute  = () =>{
      clearMarkers();
    loader.load().then(async () => {
      const { Map } = await google.maps.importLibrary("maps");
      const { AdvancedMarkerView } = await google.maps.importLibrary("marker");

      /*map = new Map(document.getElementById("map"), {
        center: { lat: 0.292162, lng: 32.5485867 },
        zoom: 13,
        mapTypeId: "roadmap",
        styles: mapStyle
      });*/

      marker = markers.map((marker) => {
        const { position, title } = marker;

        return new google.maps.Marker({
          position,
          title,
          map,
          // icon: markerIcon
        });
      });

      let icons = {
        start: /*new google.maps.MarkerImage(
            // URL
            "https://bishangatravel.com/wp-content/uploads/2022/07/marker.png",
            // (width,height)
            new google.maps.Size( 44, 32 ),
            // The origin point (x,y)
            new google.maps.Point( 0, 0 ),
            // The anchor point (x,y)
            new google.maps.Point( 22, 32 )
        )*/{
            url: markerImage,
            scaledSize: new google.maps.Size(40, 40),
        },
        end: /*new google.maps.MarkerImage(
            // URL
            "https://bishangatravel.com/wp-content/uploads/2022/07/marker.png",
            // (width,height)
            new google.maps.Size( 44, 32 ),
            // The origin point (x,y)
            new google.maps.Point( 0, 0 ),
            // The anchor point (x,y)
            new google.maps.Point( 22, 32 )
        )*/{
            url: markerImage,
            scaledSize: new google.maps.Size(40, 40),
        }
      };

      directionsService = new google.maps.DirectionsService();
      directionsRenderer = new google.maps.DirectionsRenderer({
        map,
        suppressMarkers: true,
          // icons: icons,
      });

      // document.getElementById("show-route").addEventListener("click", () => {
      const waypoints = marker.map(({ position }) => ({ location: position }));
      const origin = waypoints.shift().location;
      const destination = waypoints.pop().location;

      directionsService.route(
          {
            origin,
            destination,
            // waypoints,
            travelMode: google.maps.TravelMode.DRIVING,
          },
          (response, status) => {
            if (status === "OK") {
              directionsRenderer.setDirections(response);
                directionsRenderer.setOptions({
                    polylineOptions: {
                        strokeColor: "#002c75", // Red color
                        strokeWeight: 4, // Line thickness
                        strokeOpacity: 0.7, // Line opacity (0-1)
                    },
                });
              let leg = response.routes[ 0 ].legs[ 0 ];
              // console.log(response,leg.end_location);
              makeMarker( origin, icons.start, "title" );
              makeMarker( destination, icons.end, 'title' );
            } else {
              window.alert(`Directions request failed due to ${status}`);
            }
          }
      );
      // });
    });
  }
  function makeMarker( position, icon, title ) {
    new google.maps.Marker({
      position: position,
      map: map,
      icon: icon,
      title: title
    });
  }


  function setInitDeviceLocation(position) {
    const device =  props.devices.filter( x=> x.id == position.deviceId)
    // console.log("position initial load", position, device);
    let positionItem = {
        id: position.deviceId,
        position: { lat: position.latitude, lng: position.longitude },
        title: device[0].name,
        status: device[0].status
    };
    locations.push(positionItem);
    console.log(device[0]);
    // bounds.extend({ lat: position.latitude, lng: position.longitude });
  }

  function updateDeviceLocation(position) {
      // bounds = new google.maps.LatLngBounds();
    // console.log("position changes", position);
    let markerIndex = locations.findIndex( x=> x.id === position.deviceId);
    // console.log(markerIndex);
    let newPosition = { lat: position.latitude, lng: position.longitude }
      locationMarkers[markerIndex].setPosition(newPosition);
      // bounds.extend(newPosition);
  }

  let initialLocationDataLoad = ref(false);

  onMounted(() => {


            var url =import.meta.env.VITE_TRACCAR_URL
            var token = import.meta.env.VITE_TRACCAR_WEBSOCKET_TOKEN

            var ajax = function (method, url, callback) {
                var xhr = new XMLHttpRequest();
                xhr.withCredentials = true;
                xhr.open(method, url, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        callback(JSON.parse(xhr.responseText));
                    }
                };
                if (method == 'POST') {
                    xhr.setRequestHeader('Content-type', 'application/json');
                }
                xhr.send()
            };

                ajax('GET', url + '/api/session?token=' + token, function(user) {
                    // debugger
                    ajax('GET', url + '/api/devices', function(devices) {
                        var socket = new WebSocket('ws' + url.substring(4) + '/api/socket');
                        socket.onopen = () => {
                            console.log('Connected to websocket Successfully')
                        }
                        socket.onerror = (error) => {
                            console.log('socket error: ', error)
                        }
                        socket.onclose = function (event) {
                            //TODO: Write code to reopen
                        };
                        socket.onmessage = function (event) {


                            var data = JSON.parse(event.data);
                            if(data.positions){
                                // markers.pop();
                                if (!initialLocationDataLoad.value) {
                                    data.positions.forEach(setInitDeviceLocation)
                                    loadMap()
                                }else {
                                    data.positions.forEach(updateDeviceLocation)
                                }
                                initialLocationDataLoad.value = true;
                                // console.log(locations);
                            }
                        }
                    });
                });


  })

  </script>
