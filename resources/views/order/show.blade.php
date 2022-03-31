@extends('layouts.app')

@section('content')

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Order Show</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header with_btn">
                        <h4 class="card-title">Order Detail</h4>
                        <a href="{{route('order.index')}}" class="btn btn-primary btn-sm ">Back</a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example" class="table">
                                 <tr>
                                <td><h4 class="mb-0"><strong>Title:</strong></h4></td>
                                <td><p class="mb-0" >{{$order->title }}</p></td>
                                 </tr>
                               <tr>
                                   <td><h4 class="mb-0"><strong>Description:</strong></h4></td>
                                   <td><p class="mb-0">{{ $order->description }}</p></td>
                               </tr>
                                    <tr>
                                   <td><h4 class="mb-0"><strong>Image:</strong></h4</td>
                                   <td><img src="{{asset('images/'.$order->image)}}" width="100px" height="100px"></td>
                               </tr>
                            </table>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--**********************************
    Content body end
***********************************-->
@endsection
@section('scripts')
<script type="text/javascript">

var table = $('#example').DataTable({
		searching: false,
		paging:true,
		select: false,
		info: false,
		lengthChange:false ,
		language: {
			paginate: {
			  previous: "Previous",
			  next: "Next"
			}
		  }

	})
</script>
@endsection