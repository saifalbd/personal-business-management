<div class="container-fluid deshboard">
	<!--start box-->
	<div class="tiles-parent-title-box">
		<div class="tiles-parent-title">
			Customer Details
		</div>
		
	</div>
		<div class="custom-tiles-grid">
@foreach($info['customerDetails'] as $list)
		<div class="custom-tile-wide">
			<div class="custom-tile-box">
					<div class="custom-tile text-center">
						<div style="width: 100%;">
						<div class="title-bar float-left">
							{{$list['title']}}
						</div>
						<div class="value-bar float-right">
							{{$list['value']}}
						</div>
						</div>

					</div>
				
			</div>
		</div>
		@endforeach
		
		
		</div>
		<!--end box-->
	<!--start box-->
	<div class="tiles-parent-title-box">
		<div class="tiles-parent-title">
			Vendor Details
		</div>
		
	</div>
		<div class="custom-tiles-grid">
@foreach($info['vendorDetails'] as $list)
		<div class="custom-tile-wide">
			<div class="custom-tile-box">
					<div class="custom-tile text-center">
						<div style="width: 100%;">
						<div class="title-bar float-left">
							{{$list['title']}}
						</div>
						<div class="value-bar float-right">
							{{$list['value']}}
						</div>
						</div>

					</div>
				
			</div>
		</div>
		@endforeach
		
		
		</div>
		<!--end box-->
	<!--start box-->
	<div class="tiles-parent-title-box">
		<div class="tiles-parent-title">
			Vendor Details
		</div>
		
	</div>
		<div class="custom-tiles-grid">
@foreach($info['vendorSingleDetails'] as $list)
		<div class="custom-tile-hori">
			<div class="custom-tile-box">
				
				<div class="vendorName">
					{{$list['name']}}
				</div>
	@foreach($list->child as $row)
	<div style="width: 100%;"><div class="title-bar float-left">{{$row['title']}}</div><div class="value-bar float-right">{{$row['value']}}</div></div>
@endforeach
					
			</div>
		</div>
		@endforeach
		
		
		</div>
		<!--end box-->
</div>
