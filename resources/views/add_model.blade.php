@extends('welcome')
@section('content')
<div class="container">
        <div class="alert alert-danger" id="err" style="display: none;"></div>
    <!-- Default form add model -->
<form class="text-center border border-light p-5 dropzone" enctype="multipart/form-data">
{{ csrf_field() }}
        <p class="h4 mb-4">Add Car Detail</p>

        <div class="form-row mb-4">
            <div class="col">
                <!-- Model Name -->
                <input type="text" id="model_name" name="model_name" class="form-control" placeholder="Model Name">
                <span id="model_name_err" class="error text-left" style="color: red;"></span>
            </div>
            <div class="col">
                <!-- Manufacturer -->
                <select class="form-control" id="mfg" name="mfg">
                    <option value="" style="display:none;">Select</option>
                    @foreach($mfgs as $key=>$value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
                <span id="mfg_err" class="error text-left" style="color: red;"></span>
            </div>
        </div>

        <!-- Color -->
        <input type="text" id="color" name="color" class="form-control mb-4" placeholder="Color">
        <span id="color_err" class="error text-left mb-4" style="color: red;"></span>

        <div class="form-row mb-4">
            <div class="col">
                <!-- mfg year -->
                <input type="text" id="mfg_year" name="mfg_year" class="form-control " placeholder="Manufacturing Year">
                <span id="mfg_year_err" class="error text-left" style="color: red;"></span>
            </div>
            <div class="col">
                <!-- Registration Number -->
                <input type="text" id="reg_num" name="reg_num" class="form-control " placeholder="Registration Number">
                <span id="reg_num_err" class="error text-left" style="color: red;"></span>
            </div>
        </div>

        <!-- Note -->
        <textarea type="text" id="note" name="note" class="form-control mb-4" placeholder="Note"></textarea>

        <div class="form-row mb-4">
            <div class="col">
                <!-- Image 1 -->
                <input type="file" id="pic1" name="pic1" class="form-control mb-4" accept="image/x-png,image/gif,image/jpeg" placeholder="Image 1">
                <span id="pic1_err" class="error text-left" style="color: red;"></span>
            </div>
            <div class="col">
                <!-- Image 2 -->
                <input type="file" id="pic2" name="pic2" class="form-control mb-4" accept="image/x-png,image/gif,image/jpeg" placeholder="Image 2">
                <span id="pic2_err" class="error text-left" style="color: red;"></span>
            </div>
        </div>



        <!-- Submit button -->
        <button id="sub_add_model" class="btn btn-info my-4 btn-block" type="submit">Submit</button>
        <div class="container"><p class="text-center"><i class="fa fa-check text-center" id="success" style="color:green;display:none;"></i></p></div>

    </form>
    <!-- Default form add model -->

</div>
<script type="text/javascript">
    $(function () {
        $('form').on('submit', function (e) {
            $(".form-control").css({"border": "1px solid #ced4da"});
            $('.error').html('');

            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
            var regex = new RegExp("^[a-zA-Z0-9 ]+$");
            var year_regex = new RegExp("^[0-9]+$");
            var model_name = $("#model_name").val();
            var mfg = $("#mfg").val();
            var color = $("#color").val();
            var mfg_year = $("#mfg_year").val();
            var reg_num = $("#reg_num").val();
            var note = $("#note").val();
            var pic1 = $("#pic1").val();
            var pic2 = $("#pic2").val();

            if (model_name == '') {
                $("#model_name").css({"border": "1px solid #de2155"});
                $('#model_name_err').html('This field can not be empty.');
                return false;
             }
             if (!model_name.match(regex)) {
                $("#model_name").css({"border": "1px solid #de2155"});
                $('#model_name_err').html('Invalid input text.');
                return false;
            }
            if (mfg == '') {
                $("#mfg").css({"border": "1px solid #de2155"});
                $('#mfg_err').html('This field can not be empty.');
                return false;
             }

             if (color == '') {
                $("#color").css({"border": "1px solid #de2155"});
                $('#color_err').html('This field can not be empty.');
                return false;
             }

             if (mfg_year == '') {
                $("#mfg_year").css({"border": "1px solid #de2155"});
                $('#mfg_year_err').html('This field can not be empty.');
                return false;
             }
             if (!mfg_year.match(year_regex)) {
                $("#mfg_year").css({"border": "1px solid #de2155"});
                $('#mfg_year_err').html('Year can not contain letters.');
                return false;
            }
            if (mfg_year.length != 4) {
                $("#mfg_year").css({"border": "1px solid #de2155"});
                $('#mfg_year_err').html('Invalid year.');
                return false;
            }
             if (reg_num == '') {
                $("#reg_num").css({"border": "1px solid #de2155"});
                $('#reg_num_err').html('This field can not be empty.');
                return false;
             }
             if (note == '') {
                $("#note").css({"border": "1px solid #de2155"});
                $('#note_err').html('This field can not be empty.');
                return false;
             }
             if (pic1 == '') {
                $("#pic1").css({"border": "1px solid #de2155"});
                $('#pic1_err').html('This field can not be empty.');
                return false;
             }
             if ($.inArray(pic1.split('.').pop().toLowerCase(), fileExtension) == -1) {
                    //alert("Only formats are allowed : "+fileExtension.join(', '));
                    $("#pic1").css({"border": "1px solid #de2155"});
                    $('#pic1_err').html('Only formats are allowed : '+fileExtension.join(', '));
                    return false;
                }
             if (pic2 == '') {
                $("#pic2").css({"border": "1px solid #de2155"});
                $('#pic2_err').html('This field can not be empty.');
                return false;
             }
             if ($.inArray(pic2.split('.').pop().toLowerCase(), fileExtension) == -1) {
                    //alert("Only formats are allowed : "+fileExtension.join(', '));
                    $("#pic2").css({"border": "1px solid #de2155"});
                    $('#pic2_err').html('Only formats are allowed : '+fileExtension.join(', '));
                    return false;
                }
            e.preventDefault();
            $("#msg").hide();
            $("#err").hide();
            $("#mfg").css({"border": "1px solid #ced4da"});
            var url = "{{route('car.store')}}";

            $.ajax({
                url : url,
                type : "POST",
                data: new FormData(this),
                datatype : 'JSON',
                contentType:false,
                cache:false,
                processData:false,
                success: function(data){

                    if(data.success == 1)
                    {
                        $("#success").show();
                        $("#model_name").val('');
                        $("#mfg").val('');
                        $("#color").val('');
                        $("#mfg_year").val('');
                        $("#reg_num").val('');
                        $("#note").val('');
                        $("#pic1").val('');
                        $("#pic2").val('');
                    }
                    else
                    {
                        if(data.error){
                            console.log(data.error);
                            $("#err").show();
                            $.each(data.error, function(index, value){
                                $("#err").append("<li>" + value + "</li>");
                            });
                            //$("#err").html(data.error);
                        };
                    }

                }
            });

        });
    });

    </script>
@endsection
