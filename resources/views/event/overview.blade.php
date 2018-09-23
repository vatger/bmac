@extends('layouts.app')

@section('content')
    <h2>Events Overview</h2>
    <p><a href="{{ route('event.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new Event</a></p>
    @include('layouts.alert')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">Name</th>
            <th scope="row">Type</th>
            <th scope="row">Date</th>
            <th scope="row">Start</th>
            <th scope="row">End</th>
            <th scope="row">Actions</th>
        </tr>
        </thead>
        @forelse($events as $event)
            @if($event->endEvent < now())
                <tr class="table-primary">
            @else
                <tr>
            @endif
                <td>{{ $event->id }}</td>
                <td><a href="{{ route('booking.index', $event) }}" title="Open Slot Table">{{ $event->name }}</a></td>
                <td>{{ $event->type->name }}</td>
                <td>{{ $event->startEvent->format('d-m-Y') }}</td>
                <td>{{ $event->startEvent->format('Hi') }}z</td>
                <td>{{ $event->endEvent->format('Hi') }}z</td>
                <td>
                    <a href="{{ route('event.edit',$event->id) }}" class="btn btn-primary disabled"><i class="fa fa-edit"></i> Edit Event</a>
                    @if($event->endBooking > now())
                        <a href="{{ route('booking.admin.importForm',$event) }}" class="btn btn-success"><i class="fa fa-edit"></i> Import data</a>
                        <a href="{{ route('booking.create',$event) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Timeslots</a>
                        <a href="{{ route('booking.admin.autoAssignForm',$event) }}" class="btn btn-primary">Auto Assign FL / Route</a>
                    @endif
                    <a href="{{ route('event.email.form',$event) }}" class="btn btn-primary"><i class="fa fa-envelope"></i> Send E-mails (all persons)</a>
                    <a href="{{ route('booking.export',$event) }}" class="btn btn-success"><i class="fa fa-edit"></i> Export data</a>
                </td>
            </tr>
        @empty
            @php
                flashMessage('info', 'No events found', 'No events are in the system, consider adding one, using the button above');
            @endphp
            @include('layouts.alert')
        @endforelse
    </table>
@endsection