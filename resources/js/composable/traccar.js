import { watch, onMounted, ref , provide, inject } from 'vue'

export default function useTraccar(){

    const positions = ref([]);
    const devices = ref([]);

    onMounted(()=>{

        Echo.channel("traccar").listen('TraccarEvent', (event)=>{
            var data = event.data;
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
