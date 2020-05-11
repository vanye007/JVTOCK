
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style>
  #suppliers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
    }

  #suppliers td, #suppliers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #suppliers tr:nth-child(even){background-color: #f2f2f2;}

  #suppliers tr:hover {background-color: #ddd;}

  #suppliers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #026fc1;
    color: white;
  }

  .orange{
    background-color: #f47712 !important;
    color: white !important;
  }
  </style>
</head>
<body>

  <div class="section supplier-data-sec data-table ">
    <div class="w-row">
      <div class="w-col w-col-12 col-sm-12">
        <div>
        <h1><img src="https://jvtock.com/images/jvtock-logo.png"/ width="100px;">  <a style="float:right" href="https://jvtock.com"><p style="font-size:14px;">Visit website</p></a><h1>
        </div>
      </div>
    </div>
      <div style="float: none;" class="w-col w-col-12">
      </div>
      <div class="table-responsive">
      <table  id="suppliers" class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col" class="orange">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Certificate</th>
            <th scope="col">Price</th>
            <th scope="col">Volume</th>
            <th scope="col">Supply Capacity</th>
            <th scope="col">Inventory</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $key => $value)
            <tr>
              <td class="orange">{{$value->name}}</td>
              <td>{{$value->description}}</td>
              <td>{{$value->certificates}}</td>
              <td>{{$value->sale_price}}</td>
              <td>{{$value->volume}}</td>
              <td>{{$value->capacity}}</td>
              <td>{{$value->inventory}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>

  </html>
