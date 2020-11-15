@component('mail::message')
# Message from {{ config('app.name') }}

From: [{{ $data['email'] }}](mailto:{{ $data['email'] }})<br>
Subject: {{ $data['subject'] }}<br>
Message: {{ $data['message'] }}
@endcomponent
