<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env ('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
    img {
        height: 150px;
        width: 100%
    }

    .item {
        padding-left: 5px;
        padding-right: 5px
    }

    .item-card {
        transition: .5s;
        cursor: pointer
    }

    .item-card-title,
    .item-card-title i {
        font-size: 15px;
        transition: 1s;
        cursor: pointer
    }

    .item-card-title i {
        color: #ffa710
    }

    .card-title i:hover {
        transform: scale(1.25) rotate(100deg);
        color: #18d4ca
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 10px 10px 15px rgba(0, 0, 0, .3)
    }

    .card-text {
        height: 80px
    }

    .card::after,
    .card::before {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        transform: scale3d(0, 0, 1);
        transition: transform .3s ease-out;
        background: rgba(255, 255, 255, .1);
        content: '';
        pointer-events: none
    }

    .card::before {
        transform-origin: left top
    }

    .card::after {
        transform-origin: right bottom
    }

    .card:focus::after,
    .card:focus::before,
    .card:hover::after,
    .card:hover::before {
        transform: scale3d(1, 1, 1)
    }
    </style>
</head>

<body>

    <div class="container" style="margin-top: 100px;">
        <div class="row">
            @if(count($accounts) > 0)
            @foreach($accounts as $account)
            <div class="col-md-3 col-sm-6 item">
                <div class="card item-card card-block">
                    <h4 class="card-title text-right"><i class="material-icons">{{$account->acc_title}}</i></h4>
                    <img src="{{ asset(MyApp::ASSET_IMG.'amazon.png') }}" width="180" alt="" />
                    <h5 class="item-card-title mt-3 mb-3">{{$account->acc_title}}</h5>
                    <a href="/dashboard/{{ $account->acc_id }}" class="btn btn-primary btn-go">Go To Dashboad</a>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-md-3 col-sm-6 item">
                <div class="card item-card card-block">
                    <h4 class="card-title text-right"><i class="material-icons">settings</i></h4>
                    <img src="https://static.pexels.com/photos/7096/people-woman-coffee-meeting.jpg"
                        alt="Photo of sunset">
                    <h5 class="item-card-title mt-3 mb-3">No Account Found</h5>
                    <p class="card-text">Plz Contact Your Admin</p>
                </div>
            </div>
            @endif

        </div>
    </div>

</body>

</html>