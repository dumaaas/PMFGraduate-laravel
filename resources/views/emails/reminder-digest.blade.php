@component('mail::message')
# You asked us to remind you to watch this movie..


@component('mail::table')
|Movie|Genre|Release year|Reminder date|
|:----|:----|:-----------|:------------|

@foreach ($reminders as $reminder)

|<a href="http://movieTime.cg/movies/{{$reminder['movie']['id']}}">{{$reminder['movie']['name']}}</a>
|{{$reminder['movie']['genre']}}|{{$reminder['movie']['releaseYear']}}|{{$reminder['reminder_date']}}|
@endforeach
@endcomponent


Best wishes,<br>
movieTime
@endcomponent
