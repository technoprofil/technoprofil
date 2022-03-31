@extends('layouts.app')

@section('content')

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
  <div class="container-fluid">
    <div class="row page-titles">
    <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="javascript:void(0)">User Listing</a></li>
    </ol>
    </div>
    @include('order.form-success')
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header"><h4 class="card-title">User Listing</h4>
            <a href="{{route('order.create')}}" class="btn btn-primary btn-sm ">Add New</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table">
                    <thead>
                    <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($orders as $row)
                      <tr>
                        <td>{{$row->title}}</td>
                        <td>{{$row->description}}</td>
                        <td><img src="{{asset('images/'.$row->image)}}" width="100px" height="100px"></td>
                        <td>
                          <div class="d-flex">
                          <a href="{{route('order.show',$row->id)}}" style="margin-right: 20px;" class="btn btn-success btn-lg active">Show</a>
                            <a href="{{route('order.edit',$row->id)}}" style="margin-right: 20px;" class="btn btn-primary btn-lg active">Edit</a>
							              <form action="{{ route('order.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-danger btn-lg active" value="Delete">
                                    </form>

                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('order.confirm')

<!--**********************************
    Content body end
***********************************-->
@endsection

@section('scripts')
<script type="text/javascript">

$('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

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
