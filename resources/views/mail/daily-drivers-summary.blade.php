<x-mail::message>
@if(count($data) > 0)
## Here is the distance traveled by drivers while delivering items:

<x-mail::table>
| No.  | Name            | Distance (KM) |
| :---- | :--------------- | :------------- |
@foreach($data as $item)
| {{ $loop->index + 1 }} | {{ $item['user']->name }} | {{ number_format($item['distance'], 2) }} |
@endforeach
</x-mail::table>

@else
## There is no data available for today.
@endif

<x-mail::button :url="route('orders')">All Orders</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
