@extends('admin.layouts.master')

@section('title', 'Contact Messages')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Messages</h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-primary">All</a>
                            <a href="{{ route('admin.contacts.unread') }}" class="btn btn-sm btn-outline-warning">
                                Unread <span class="badge badge-warning">{{ $unreadCount }}</span>
                            </a>
                            <a href="{{ route('admin.contacts.read') }}" class="btn btn-sm btn-outline-info">Read</a>
                            <a href="{{ route('admin.contacts.replied') }}" class="btn btn-sm btn-outline-success">Replied</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($contacts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                <tr class="{{ $contact->isUnread() ? 'table-warning' : '' }}">
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ Str::limit($contact->subject, 50) }}</td>
                                    <td>
                                        @if($contact->isUnread())
                                            <span class="badge badge-warning">Unread</span>
                                        @elseif($contact->isRead())
                                            <span class="badge badge-info">Read</span>
                                        @else
                                            <span class="badge badge-success">Replied</span>
                                        @endif
                                    </td>
                                    <td>{{ $contact->getFormattedCreatedDate() }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.contacts.show', $contact) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            @if($contact->isUnread())
                                            <form action="{{ route('admin.contacts.mark-as-read', $contact) }}" 
                                                  method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-check"></i> Mark Read
                                                </button>
                                            </form>
                                            @endif
                                            <form action="{{ route('admin.contacts.destroy', $contact) }}" 
                                                  method="POST" style="display: inline;"
                                                  onsubmit="return confirm('Are you sure you want to delete this message?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-3">
                        {{ $contacts->links() }}
                    </div>
                    @else
                    <div class="text-center py-4">
                        <h4>No contact messages found</h4>
                        <p class="text-muted">When someone submits the contact form, messages will appear here.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 