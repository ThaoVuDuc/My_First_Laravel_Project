@extends('frontend.master')
@section('title', 'giỏ hàng')
@section('main')
<link rel="stylesheet" href="css/cart.css">

<script type="text/javascript">
	function updateCart(quantity, id){
		$.get(
			'{{asset('cart/update')}}',//đường dẫn
			{quantity:quantity,id:id},//đối tượng
			//phương thức
			function (){
				location.reload();
			}
		);
	}
</script>
<div id="wrap-inner">
	<div id="list-cart">
		<h3>Giỏ hàng</h3>
		@if(Cart::isEmpty() == NULL)
		<form>
			<table class="table table-bordered .table-responsive text-center">
				<tr class="active">
					<td width="11.111%">Ảnh mô tả</td>
					<td width="22.222%">Tên sản phẩm</td>
					<td width="22.222%">Số lượng</td>
					<td width="16.6665%">Đơn giá</td>
					<td width="16.6665%">Thành tiền</td>
					<td width="11.112%">Xóa</td>
				</tr>
				@foreach($items as $item)
				<tr>
					<td><img class="img-responsive" src="{{asset('lib/storage/app/avatar/'.$item->attributes->img)}}" width="65px" height="80px">
					</td>
					<td>{{$item->name}}</td>
					<td>
						<div class="form-group">
							<input class="form-control" type="number" value="{{$item->quantity}}" onchange="updateCart(this.value, '{{$item->id}}')">
						</div>
					</td>
					<td><span class="price">{{number_format($item->price, 0, ',', '.')}} đ</span></td>
					<td><span class="price">{{number_format($item->quantity * $item->price, 0, ',', '.')}} đ</span></td>
					<td><a href="{{asset('cart/delete/'.$item->id)}}" class="btn btn-danger text-white">xóa</a></td>
				</tr>
				@endforeach
			</table>
			<div class="row" id="total-price">
				<div class="col-md-6 col-sm-12 col-xs-12">										
						Tổng thanh toán: <span class="total-price">{{number_format($total, 0, ',', '.')}} đ</span>
																								
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<a href="#" class="my-btn btn">Mua tiếp</a>
					<a href="{{asset('cart/update')}}" class="my-btn btn">Cập nhật</a>
					<a href="{{asset('cart/delete/all')}}" class="my-btn btn">Xóa giỏ hàng</a>
				</div>
			</div>
		</form>  
		<div id="xac-nhan">
		<h3>Xác nhận mua hàng</h3>
		<form method="post">
			<div class="form-group">
				<label for="email">Email address:</label>
				<input required type="email" class="form-control" id="email" name="email">
			</div>
			<div class="form-group">
				<label for="name">Họ và tên:</label>
				<input required type="text" class="form-control" id="name" name="name">
			</div>
			<div class="form-group">
				<label for="phone">Số điện thoại:</label>
				<input required type="number" class="form-control" id="phone" name="phone">
			</div>
			<div class="form-group">
				<label for="add">Địa chỉ:</label>
				<input required type="text" class="form-control" id="add" name="add">
			</div>
			<div class="form-group text-right">
				<button type="submit" class="btn btn-default">Thực hiện đơn hàng</button>
			</div>
			{{csrf_field()}}
		</form>
	</div> 
	@else <h2>{{'Giỏ hàng trống !'}}</h2>
	@endif          	                	
	</div>
</div>

@stop