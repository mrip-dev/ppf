@extends('layout.layout')
 @section('content')


<div class="layout-px-spacing">
	<div class="middle-content container-xxl p-0">
		
		<div class="col-xl-12 col-lg-12 col-sm-12 table">
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <br />
        @endif
         @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        <br />
        @endif
			<div class="widget-content widget-content-area br-8 mt-4">
            <div class="row">
                    <div class="col text-end">
                        <a href="/categories/create" class="btn btn-primary">Add New</a>
                    </div>
                </div>
				<table id="individual-col-search" class="table dt-table-hover">
				
                <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
               
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $datas)
                <tr>
                    <td>{{ $datas->id }}</td>
                    <td>{{ $datas->name }}</td>
                    
                    <td>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('categories.edit', $datas->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                            <form action="{{ route('categories.destroy', $datas->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                            </div>
                        </div>
                        
                       
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <th class="invisible"></th>
            <th class="invisible"></th>
            <th class="invisible"></th>
        </tfoot>
    </table>
   
			</div>
		</div>
	</div>
</div>

@endsection

