<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Currency</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon"
          href="https://www.freepnglogos.com/uploads/dollar-sign-png/heavy-dollar-sign-icon-noto-emoji-objects-iconset-google-3.png"/>

</head>
<body>

<div class="container">
    <div class="row justify-content-center m-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Курс валют</h3>
                </div>

                @if (isset($error))
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div>Произошла ошибка соединения.
                                        <br>{{$error}}<br>
                                        Перезагрузите страницу
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Валюта</th>
                            <th scope="col">{{$dateBefore}}</th>
                            <th scope="col">{{$date}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Доллар США $: </td>
                            <td>₽ {{$dollarBefore}}</td>
                            <th scope="row">
                                ₽ {{$dollar}}
                                @if($dollarBefore < $dollar)
                                    <div class="arrow up">↑</div>
                                @elseif($dollarBefore > $dollar)
                                    <div class="arrow down">↓</div>
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <td>Евро €: </td>
                            <td>₽ {{$euroBefore}}</td>
                            <th scope="row">
                                ₽ {{$euro}}
                                @if($euroBefore < $euro)
                                    <div class="arrow up">↑</div>
                                @elseif($euroBefore > $euro)
                                    <div class="arrow down">↓</div>
                                @endif
                            </th>
                        </tr>
                        </tbody>
                    </table>
                @endif


            </div>
        </div>
    </div>
</div>

</body>
</html>
