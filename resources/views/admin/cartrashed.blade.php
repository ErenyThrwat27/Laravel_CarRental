<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Deleted Data</h2>          
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Price</th>
        <th>Image</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cars as $row)
      <tr>
        <td>{{$row->title}}</td>
        <td>{{$row->content}}</td>
        <td>{{$row->price}}</td>
        <td><img src="{{ asset('./images/'.$row->image)}}" alt="Testimonial" style="width:150px;height:150px;"></td>
        <td>
            <form action="{{ route('carrestore') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$row->id}}">
                <input type="submit" value="Restore" class="btn btn-success">
             </form>
        </td>
      </tr>
      @endforeach
      
      </tr>
    </tbody>
  </table>
  
</div>

</body>
</html>