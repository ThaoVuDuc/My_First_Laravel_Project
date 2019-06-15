@if(Session::has('error'))
	<p class="alert alert-danger">{{Session::get('error')}}</p>
@endif
{{--foreach kiểm tra có lỗi không--}}
@foreach($errors->all() as $error)
	<p class="alert alert-danger">{{$error}}</p>
@endforeach