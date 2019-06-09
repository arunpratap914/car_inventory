@extends('welcome')
@section('content')
<div class="container">
    <div class="mx-auto" style="width:800px">
        <form class="text-center border border-light p-5 dropzone">
                {{ csrf_field() }}
                <p class="h4 mb-4">Add Manufacturer</p>

            <div class="row">
                <div class="col-md-9 text-right">
                    <input type="text" class="form-control" id="mfg" placeholder="Enter name" name="mfg">
                </div>
                <div class="col-md-2 text-left">
                    <button name="submit" type="submit" value="Submit" class="btn btn-info">Submit</button>
                </div>
                <div class="col-md-1 text-left">
                    <i class="fa fa-check" id="success" style="color:green;display:none;"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 alert alert-danger m-5" id="err" style="display:none;"></div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(function () {
    $('form').on('submit', function (e) {
        e.preventDefault();
        $("#msg").hide();
        $("#err").hide();
        $("#mfg").css({"border": "1px solid #ced4da"});

        var url = "{{route('man.store')}}";

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
                    $("#success").show().delay(500).fadeOut();
                    $("#mfg").val('');
                    $("#mfg").focus('');
                }
                else
                {
                    if(data.error){
                        console.log(data.error);
                        $("#mfg").css({"border": "1px solid #de2155"});
                        $("#err").show();
                        $("#err").html(data.error);
                    };
                }

            }
        });

    });

});
</script>
@endsection
