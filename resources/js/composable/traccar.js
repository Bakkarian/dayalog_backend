import { watch, onMounted, ref , provide, inject } from 'vue'

export default function useTraccar(){

    const positions = ref([]);
    const devices = ref([]);

    onMounted(()=>{
        var url = import.meta.env.VITE_TRACCAR_URL
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
            ajax('GET', url + '/api/devices', function(_) {
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
                    if('positions' in data){

                        //Get only unique device locations from devices
                        const uniqueNewPositions = data.positions.reduce((accumulator, currentPosition) => {
                            const existingPosition = accumulator.find((item) => item.deviceId === currentPosition.deviceId);

                            if (!existingPosition || currentPosition.id > existingPosition.id) {
                              // If there's no existing position with the same deviceId or if the current position has a larger id, replace it.
                              accumulator = accumulator.filter((item) => item.deviceId !== currentPosition.deviceId);
                              accumulator.push(currentPosition);
                            }
                            return accumulator;
                          }, []);

                        let dataIdsSet = new Set(uniqueNewPositions.map(item => item.deviceId));
                        positions.value = [
                            ...positions.value.filter(item => !dataIdsSet.has(item.deviceId)),
                            ...uniqueNewPositions
                        ];
                    }

                    if('devices' in data){
                        let dataIdsSet = new Set(data.devices.map(item => item.id));
                        devices.value = [...devices.value.filter(item => !dataIdsSet.has(item.id)), ...data.devices];
                    }

                }
            });
        });
    })

    const positionChangedHandler = ref(false);

    watch(positions, (newPositions) => {
        newPositions.forEach((newPos, index) => {

            watch(() => positions.value[index], (newValue, oldValue) => {
                if(positionChangedHandler.value && hasAttributesChanged(newValue, oldValue)){
                    positionChangedHandler.value(newValue, oldValue);
                    emitPositionChanged(index, newValue, oldValue);
                }
            }, { deep: true });

        });
    }, { deep: true });

    const emitPositionChanged = (index, newPosition, oldPosition ) => {
        const eventName = `positionChanged:${index}`;
        if (events[eventName]) {
            events[eventName](newPosition, oldPosition);
        }
    };

    const events = {
        onPositionChanged(index, handler) {
            provide(`positionChanged:${index}`, handler);
        }
    };

    const onDevicePositionChanged = (handler) => {
        positionChangedHandler.value = handler
    }


    // Check if at least one attribute (other than ID) changed
    const hasAttributesChanged = (newPosition, oldPosition) => {
        // Assuming 'id' is the attribute that should be excluded
        const attributesToCheck = Object.keys(newPosition).filter(attr => attr !== 'id');
        return attributesToCheck.some(attr => newPosition[attr] !== oldPosition[attr]);
    };


    return { positions, devices, events, onDevicePositionChanged };
}
