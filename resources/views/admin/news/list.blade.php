@extends('admin/app')

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ $result['page_header'] }}</h3>

      <span class="pull-right"><a href="{{ route('news.create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;  Add New </a></span>
    </div>
    
    <div class="box-body">
    	<table class="table table-hover table-responsive table-condensed">
    		<thead class="bg-primary">
    			<tr>
    				<th>S.No</th>
                    <th>Title</th>
                    <th>Published Date</th>
                    <th class="center-align">Status</th>
                    <th class="center-align">Action</th>

    			</tr>
    		</thead>
    		<tbody>
    			<?php $count = 1; ?>
                @foreach ($result['newslist'] as $item)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->published_date}}</td>
                    <td class="center-align">
                    	@if ($item->status == '1')
                            <img src="{{ asset('/admin/images/tick.png') }} ">
                        @else
						    <img src="{{ asset('/admin/images/notick.png') }}">
						@endif
					</td>
                    <td width="100px" class="center-align"><a href="{{ route('news.edit', $item->id) }}">Edit </a>&nbsp; | &nbsp; <a href="{{ route('/my-admin/news.delete', $item->id) }}" onclick=" return confirm('Are You Sure ???');">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $result['newslist']->links() }}
    </div>
  </div>
</div>
<div class="clearfix"></div>

@endsection