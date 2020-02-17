@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">Billets</div>

                <div class="card-body">
                    <div class="card-header">Tous les billets</div>
                    <a class="btn btn-success" href="{{ route('billets.create') }}">Create New billet</a>
                    @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                    @endif
                    <table class="table table-bordered">

                        <tr>

                            <th>User name</th>

                            <th>Title</th>

                            <th>Content</th>

                            <th width="280px">Action</th>

                        </tr>

                        @foreach ($billets as $billet)

                        <tr>

                            <td>{{ $billet->user->username }}</td>

                            <td>{{ $billet->title }}</td>

                            <td>{{ $billet->content }}</td>



                            <td>

                                <form action="{{ route('billets.destroy',$billet->id) }}" method="POST">



                                    <a class="btn btn-info" href="{{ route('billets.show',$billet->id) }}">Show</a>



                                    <a class="btn btn-primary" href="{{ route('billets.edit',$billet->id) }}">Edit</a>



                                    @csrf

                                    @method('DELETE')



                                    <button type="submit" class="btn btn-danger">Delete</button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </table>
                    {{ $billets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
