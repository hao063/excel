<style>

</style>
<table data-cols-width="10, 130">
    <thead>
    <tr >
        <th height="0px">2313</th>
        <th height="0px">2313</th>
    </tr>
    <tr>
        <th style="position: relative;">
            <img  style="position: absolute; width: 60px" height="100px" width="70px" src="{{ public_path('messi.jpg') }}" alt="Your Image">
        </th>
    </tr>
    <tr >
        <th height="50px" style="white-space: normal;">Em là ai từ đâu bước tới nơi đây mà đẹp như tiên</th>
    </tr>
    @foreach($headers as $header)
        <tr>
            @foreach($header['data'] as $item)
                <th height="50px"
                    colspan="{{count($header['data']) == 1 && $item['col'] == 1 ? $numberColMax : $item['col']}}"
                    style="text-align:center; vertical-align: center; background-color: {{$item['color'] ?? ''}};border: thin solid black;">
                    {{$item['title']}}
                </th>
            @endforeach
        </tr>
    @endforeach
    </thead>
    <tbody>
        <tr>
            <td style="font-weight: bold">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.</td>
            <td>23234</td>
        </tr>

    </tbody>
</table>

