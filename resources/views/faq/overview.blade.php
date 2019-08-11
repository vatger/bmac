@extends('layouts.app')

@section('content')
    <h2>FAQ Overview</h2>
    @include('layouts.alert')
    @push('scripts')
        <script>
            $('.delete-faq').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure',
                    text: 'Are you sure you want to remove this faq?',
                    type: 'warning',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        Swal.fire('Deleting faq...');
                        Swal.showLoading();
                        $(this).closest('form').submit();
                    }
                });
            });
        </script>
    @endpush
    <p>
        <a href="{{ route('faq.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new FAQ</a>
    </p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">Question</th>
            <th scope="row">Linked?</th>
            <th scope="row" colspan="2">Actions</th>
        </tr>
        </thead>
        @forelse($faqs as $faq)
            <tr>
                <td>{{ $faq->id }}</td>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->events()->count() ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('faq.edit', $faq) }}">
                        <button class="btn btn-primary">
                            <i class="fa fa-edit"></i> Edit FAQ
                        </button>
                    </a>
                </td>
                <td>
                    <form action="{{ route('faq.destroy', $faq) }}" method="post">
                        @method('DELETE')
                        <button class="btn btn-danger delete-faq"><i class="fa fa-trash"></i> Remove FAQ</button>
                        @csrf
                    </form>
                </td>
            </tr>
        @empty
            @php
                flashMessage('warning', 'No faq\'s found', 'No faq\'s are in the system, consider adding one, using the button above');
            @endphp
            @include('layouts.alert')
        @endforelse
        {{ $faqs->links() }}
    </table>
    {{ $faqs->links() }}
@endsection
