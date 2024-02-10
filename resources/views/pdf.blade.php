<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr>
        <td><b>Name</b></td>
        <td><b>Monthly Consumtion</b></td>
        <td><b>Location</b></td>     
        <td><b>Images</b></td>     
      </tr>
      </thead>
      <tbody>
        @foreach ($buildings  as $building)
            
      <tr>
        <td>
          {{$building->name}}
        </td>
        <td>
            {{($building->monthly_consumption)?$building->monthly_consumption:'N/A'}}
        </td>
        <td>
            {{$building->location_details}}
        </td>
        <td>
            @foreach($building->images as $img)
            <img src="{{ storage_path().'/app/building_images/'.$img->image_name }}" alt="" title="">
            @endforeach
        </td>
      </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>