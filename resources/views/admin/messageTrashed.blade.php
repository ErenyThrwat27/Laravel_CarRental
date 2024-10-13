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
        <th>FULL Name</th>
        <th>Email</th>
        <th>Message Content</th>
      </tr>
    </thead>
    <tbody>
      @foreach($msg as $row)
      <tr>
        <td>{{ $row->firstName . ' ' . $row->lastName }}</td>
        <td>{{$row->email}}</td>
        <td>{{$row->content}}</td>
        <td>
            <form action="{{ route('msgrestore') }}" method="post">
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