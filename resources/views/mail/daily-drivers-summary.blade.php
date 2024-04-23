<x-mail::message>
@if(count($data) > 0)
## Here is the distance traveled by drivers while delivering items:

<x-mail::table>
| No.   | Name              | Total Distance (KM) | Disptach Distance |
| :---- | :----------------- | :----------------- | :---------------- |
@foreach($data as $item)
| {{ $loop->index + 1 }} | {{ $item['user']?->name ?? "No Driver" }} | {{  number_format($item['totalDailydistance'], 2) }}  | {{ number_format($item['dispatchDistance'], 2) }} |
@endforeach
</x-mail::table>

@else
    ## There is no data available for yersterday.
@endif

<x-mail::button :url="route('orders')">View Orders</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
