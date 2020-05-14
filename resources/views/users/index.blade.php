@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div
                            x-data="{
                                loading: false,
                            }"
                            @scroll.window="
                                if (this.loading) return;

                                var nextLink = document.querySelector('a[rel=next]');

                                if (! nextLink) return;

                                var docHeight = Math.max(
                                    document.body.scrollHeight, document.documentElement.scrollHeight,
                                    document.body.offsetHeight, document.documentElement.offsetHeight,
                                    document.body.clientHeight, document.documentElement.clientHeight
                                );

                                if ((window.innerHeight + window.scrollY) < docHeight - 600) {
                                    return;
                                }

                                this.loading = true;

                                axios.get(nextLink.href)
                                    .then(({ data }) => {
                                        $refs.usersList.innerHTML += data.list;
                                        $refs.pagination.innerHTML = data.links;
                                        this.loading = false;
                                    });
                            "
                        >
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody x-ref="usersList">
                                @foreach($users as $user)
                                    @include('users._list_row', ['user' => $user])
                                @endforeach
                                </tbody>
                            </table>

                            <div x-ref="pagination">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
