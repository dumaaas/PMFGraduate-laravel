<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>movieTime</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"><img src="images/logo1.png" alt="" width="150"/></td>
        <td align="right">
            <h3>movieTime - movie reviews</h3>
            <pre>
                Admin: {{Auth::user()->firstName}} {{Auth::user()->lastName}}
                Country: {{Auth::user()->country}}
                City: {{Auth::user()->city}}
                Phone: {{Auth::user()->phoneNumber}}
            </pre>
        </td>
    </tr>

  </table>


  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Genre</th>
        <th>Rating</th>
        <th>Year</th>
        <th>Duration</th>
        <th>Total reviews</th>
        <th>Total comments </th>
        <th>Total favorites </th>
        <th>Total watched </th>
        <th>Total watchlist </th>
        <th>Total custom </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($movies as $movie)
        <tr>
          <th scope="row">{{$movie->id}}</th>
          <td>{{$movie->name}}</td>
          <td>{{$movie->genre}}</td>
          <td align="right">{{$movie->imdb}}/10</td>
          <td align="right">{{$movie->releaseYear}}</td>
          <td align="right">{{$movie->duration}} min</td>
          <td align="right">{{$movie->rating->count()}}</td>
          <td align="right">{{$movie->comment->count()}}</td>
          <td align="right">{{$movie->favorite->count()}}</td>
          <td align="right">{{$movie->watched->count()}}</td>
          <td align="right">{{$movie->watchlist->count()}}</td>
          <td align="right">{{$movie->custom->count()}}</td>
        </tr> 
      @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="5"></td>
            <td align="right">Total</td>
            <td align="right" class="gray">{{$ratingsNum}}</td>
            <td align="right" class="gray">{{$commentsNum}}</td>
            <td align="right" class="gray">{{$favoritesNum}}</td>
            <td align="right" class="gray">{{$watchedNum}}</td>
            <td align="right" class="gray">{{$watchlistNum}}</td>
            <td align="right" class="gray">{{$customNum}}</td>
        </tr>
    </tfoot>
  </table>
<br>
<br>
<h4>Movie with most reviews: <a href="http://movieTime.cg/movies/{{$movieRating->id}}">{{$movieRating->name}}</a></h4>
</body>
</html>