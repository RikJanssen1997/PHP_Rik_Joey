<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <title>Laravel</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>

<body>
  <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
      @auth
      <a href="{{ url('/home') }}">Home</a>
      @else
      <a href="{{ route('login') }}">Login</a>

      @if (Route::has('register'))
      <a href="{{ route('register') }}">Register</a>
      @endif
      @endauth
    </div>
    @endif


    <div class="dashboardContent">
      <div class="progress">
        <div class="progress-bar bg-danger" id="progressbar" role="progressbar" style="width: {{$progress}}%;" aria-valuenow={{$progress ?? 0}} aria-valuemin="0" aria-valuemax="100">
          <h5 id="progressText">{{$progress}}%</h5>
        </div>
        @if($progress == 0)
        <div class="emptyProgressBar">
        <h5 id="progressText">{{$progress}}%</h5>
        </div>
        @endif
      </div>

      <div class="SelectUser">
        <div class="dropdown show">
          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Kies een student uit..
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            @foreach($users as $user)
            <a class="dropdown-item" href="{{ route('Dashboard',$user->id) }}">{{$user->name}}</a>
            @endforeach
          </div>
        </div>
      </div>
      @if(isset($chosenUser))
        <h3>Gekozen student: {{$chosenUser->name}}</h3>
      @endif

      <div id="accordion">
        @foreach($periods as $period)
        <div class="card">
          <div class="card-header" id="heading{{$period->number}}">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$period->number}}" aria-expanded="false" aria-controls="collapseTwo">
                Periode {{$period->number}}
              </button>
            </h5>
          </div>
          <div id="collapse{{$period->number}}" class="collapse" aria-labelledby="heading{{$period->number}}" data-parent="#accordion">
            <div class="card-body">

              <p>
                @foreach($period->blocks as $block)
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#Blok{{$block->number}}" aria-expanded="false" aria-controls="collapseExample">
                  Blok{{$block->number}}
                </button>
                @endforeach
              </p>

              @foreach($period->blocks as $block)
              <div class="collapse" id="Blok{{$block->number}}">
                <div class="card card-body">
                  <h2> Blok {{$block->number}}</h2>
                  <div class="cardbox">
                    @if(isset($modules))
                    @foreach($modules as $module)
                    @if($module->block_id == $block->id)
                    <div class="card margin-top" style="width: 18rem;">
                      <div class="card-body">
                        <h5 class="card-title">{{$module->name}}</h5>
                         <ul class="card-text">
                          <li>Behaalde cijfer: {{$module->gotGrade}}</li>
                          <li>Behaalde studiepunten: {{$module->gotEC}}EC </li>
                          <li>Max. aantal studiepunten: {{$module->ec}}EC</li>
                        </ul>
                        
                      </div>
                    </div>
                      <div>
                      </div>
                    @endif
                    @endforeach
                  </div>
                  @endif
                  @if($block->totalEC > 0)
                    <p id="ECMessage">Dit blok heb je {{$block->totalObtainedEC}}EC van de {{$block->totalEC}}EC behaald.</p>
                  @endif
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        @endforeach
      </div>
</body>

</html>