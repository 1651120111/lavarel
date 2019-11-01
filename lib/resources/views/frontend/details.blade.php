@extends('frontend.master')
@section('title','Chi tiết sản phẩm')
@section('main')
<link rel="stylesheet" href="css/details.css">
	<div id="wrap-inner">
		<div id="product-info" style="margin-bottom: 5%">
			<div class="clearfix"></div>
			<h3>{{$items -> pro_name}}</h3>
			<div class="row">
				<div id="product-img" class="col-xs-12 col-sm-12 col-md-3 text-center">
					<img src="{{asset('lib/storage/app/avatar/'.$items->pro_img)}}" style="width: 300px;height: 410px" >
				</div>
				<div id="product-details" class="col-xs-12 col-sm-12 col-md-9" style="padding-left: 14%">
					<p>Giá: <span class="price">{{number_format($items ->pro_price,0,',','.')}} VNĐ</span></p>
					<p>Bảo hành: {{$items->pro_warranty}}</p> 
					<p>Phụ kiện: {{$items->pro_accessories}}</p>
					<p>Tình trạng: {{$items->pro_condition}}</p>
					<p>Khuyến mại: {{$items->pro_promotion}}</p>
					<p>Còn hàng: @if($items->pro_status == 1) còn hàng @else hết hàng @endif	</p>
					<p class="add-cart text-center"><a href="{{route('cart.add',[$items->pro_id])}}">Đặt hàng online</a></p>
				</div>
			</div>							
		</div>
		<div id="product-detail">
			<h3><b>Chi tiết sản phẩm</b></h3>
			<p class="text-justify">{!! $items->pro_description !!}</p>
		</div>
		<hr style="margin: 50px">
		<div id="comment" >
			<h3><b>Bình luận</h3>
			<div class="col-md-9 comment">
				<form method="post">
					{{ csrf_field()}}
					<div class="form-group">
						<label for="email">Email:</label>
						<input required type="email" class="form-control" id="email" name="email">
					</div>
					<div class="form-group">
						<label for="name">Tên:</label>
						<input required type="text" class="form-control" id="name" name="name">
					</div>
					<div class="form-group">
						<label for="cm">Bình luận:</label>
						<textarea required rows="10" id="cm" class="form-control" name="content"></textarea>
					</div>
					<div class="form-group text-right">
						<button type="submit" class="btn btn-default">Gửi</button>
					</div>
				</form>
			</div>
		</div>
		<div id="comment-list">
			@foreach($comments as $comment)
			<ul>
				<li class="com-title">
					{{$comment -> com_name}}
					<br>
					<span>{{date('d/m/Y H:i',strtotime($comment->created_at))}}</span>	
				</li>
				<li class="com-details">
					{{$comment->com_content}}
				</li>
			</ul>
			@endforeach
		</div>
	</div>					
	<!-- end main -->
@stop