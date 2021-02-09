@extends('layouts.cus_app')

@section('content')
    <div class="px-5 pt-2 font-weight-bolder my-5 text-capitalize">
        <h3>
            <i class="fas fa-user"></i> Viewing User
        </h3>
        <select class="form-control mb-2 w-25" id="records" onchange="plot()">
            <optgroup label="select record please">
                <option value="1">record 1</option>
                <option value="2">record 2</option>
                <option value="3">record 3</option>
                <option value="4">record 4</option>
            </optgroup>
        </select>

        <!-- Load plotly.js into the DOM -->
        <script src='https://cdn.plot.ly/plotly-latest.min.js'></script>
        <img src="" width="100" height="100" id="preview">

        <div id='myDiv' class="position-static"><!-- Plotly chart will be drawn inside this DIV -->
        </div>
        <script>
            plot()
function plot() {
    let data = {{ json_encode($record_1) }};
    let preview = document.getElementById("preview");
    preview.src = '/assets/images/redict_img/1.png';
    let rec = (document.getElementById('records').value)
      if (rec == 1){
          data = {{ json_encode($record_1) }}
              preview.src = '/assets/images/redict_img/1.png';
      }else if(rec == 2 ){
          data = {{ json_encode($record_2) }}
              preview.src = ('/assets/images/redict_img/2.png');
      }else if(rec == 3 ){
          data = {{ json_encode($record_3) }}
              preview.src = '/assets/images/redict_img/3.png';
      }else if(rec == 4 ){
          data = {{ json_encode($record_4) }}
              preview.src = '/assets/images/redict_img/4.png';
      }
    ch1 = []
    ch2 = []
    ch3 = []
    ch4 = []

    for (let i = 0; i < 640; i++)
        ch1.push(data[0][i][0][0])

    var c3 = {
        y: ch1,
        type: 'scatter',
        name: 'c3'
    };

    for (let i = 0; i < 640; i++)
        ch2.push(data[0][i][1][0])

    var c1 = {
        y: ch2,
        type: 'scatter',
        name: 'c1'
    };

    for (let i = 0; i < 640; i++)
        ch3.push(data[0][i][2][0])

    var c2 = {
        y: ch3,
        type: 'scatter',
        name: 'c2'
    };

    for (let i = 0; i < 640; i++)
        ch4.push(data[0][i][3][0])

    var c4 = {
        y: ch4,
        type: 'scatter',
        name: 'c4'
    };


    var data1 = [c3, c1, c2, c4];

    Plotly.newPlot('myDiv', data1);
}
        </script>
    </div>
@endsection
