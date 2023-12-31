<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('user.dashboard') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.showAppointmentForm') }}">Appointment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.register.form') }}">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.listDoctors') }}">Doctors Schedule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.articleIndexUser') }}">Article</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
      </ul>
      <span class="nav-text"></span>
    </div>
</nav>