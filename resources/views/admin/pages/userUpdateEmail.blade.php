
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>

<body>
    {{ __('layout_user.dear') }} {{ __('layout_user.information_change') }}
    <p>Your information has changed. New information:</p>
    <p><b>{{ __('layout_user.code') }}</b>: {{ $data['code'] }}</p>
    <p><b>{{ __('layout_user.birthday') }}</b>: {{ $data['day_of_birth'] }}</p>
    <p><b>{{ __('layout_user.address') }}</b>: {{ $data['address'] }} </p>
    <p><b>{{ __('layout_user.password') }}</b>: {{ array_key_exists("password", $data) ? $data['password'] : "" }} </p>
    <p><b>{{ __('layout_user.phone') }}</b>: ( {{ $data['area_code'] }} ) {{ $data['phone_number'] }}</p>
    <p><b>{{ __('layout_user.role') }}</b>: {{ $data['roles'] }}</p>
    <p><b>{{ __('layout_user.level') }}</b>: {{ $data['levels'] }}</p>
    <p><b>{{ __('layout_user.status') }}</b>: {{ $data['status'] }}</p>
    <p><b>{{ __('layout_user.type') }}</b>: {{ $data['types'] }}</p>
    <p><b>{{ __('layout_user.note') }}</b>: {{ $data['note'] }}</p>
</body>

</html>