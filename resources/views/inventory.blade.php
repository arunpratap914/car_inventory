@extends('welcome')
@section('content')
<div class="container" style="margin-top:100px">
        <div class="alert alert-danger" id="err" style="display: none;">Something went wrong</div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Manufacturer</th>
                        <th>Model Name</th>
                        <th>Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ccr as $key => $car)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$car->mfgname}}</td>
                        <td>{{$car->name}}</td>
                        <td>{{$car->total}}</td>
                    <td><button id="view_detail" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal{{$car->id}}">View Detail</button></td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5">No Car Is Available</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Manufacturer</th>
                        <th>Model Name</th>
                        <th>Count</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
</div>




@forelse($ccr as $key => $car)
<!-- The Modal -->
<div class="modal" id="myModal{{$car->id}}">
        <div class="modal-dialog  modal-xl">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h1 class="modal-title">Details</h1>
              <a href="{{ route('inventory_index') }}" class="close">×</a>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Name</th>
                        <th>Color</th>
                        <th>Mfg Year</th>
                        <th>Reg Num</th>
                        <th>Notes</th>
                        <th>Pic1</th>
                        <th>Pic2</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        $models = \App\car::all()->where('name',$car->name)->where('manufacturer_id',$car->mfgid)->where('status',1);
                        //dd($models);
                        @endphp
                    @forelse($models as $key => $value)
                    <tr id="carr_{{$value->id}}">
                        <td>{{$value->name}}</td>
                        <td>{{$value->color}}</td>
                        <td>{{$value->mfg_year}}</td>
                        <td>{{$value->reg_num}}</td>
                        <td>{{$value->note}}</td>
                        <td><img src="{{asset('cars/images')}}/{{$value->pic1}}" width="100px"></td>
                        <td><img src="{{asset('cars/images')}}/{{$value->pic2}}" width="100px"></td>
                        <td><button onclick="return sold({{$value->id}});" class="btn btn-sm btn-warning">Sold</button></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">No Model Found</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <a href="{{ route('inventory_index') }}" class="btn btn-danger" >Close</a>
            </div>

          </div>
        </div>
      </div>
@empty

@endforelse


<script type="text/javascript">
function sold(car_id){
    var url = "{{route('inventory_sold')}}";
    var token = "{{ csrf_token() }}";
    $.ajax({
        url : url,
        headers : {'X-CSRF-TOKEN': token},
        type : "POST",
        data: {"_token": token,'car_id':car_id},
        datatype : 'JSON',
        success: function(data){

            if(data.success == 1)
            {
                $("#carr_"+data.msg).hide();
            }
            else
            {
                console.log(data.error);
                $("#err").show();
            }

        }
    });

}

    </script>
@endsection
