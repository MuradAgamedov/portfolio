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
                        <div class="btn-group" role="group" aria-label="Contact filters">
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-list"></i> All
                            </a>
                            <a href="{{ route('admin.contacts.unread') }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-envelope"></i> Unread 
                                <span class="badge bg-warning text-dark ms-1">{{ $unreadCount }}</span>
                            </a>
                            <a href="{{ route('admin.contacts.read') }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-envelope-open"></i> Read
                            </a>
                            <a href="{{ route('admin.contacts.replied') }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-reply"></i> Replied
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($contacts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 60px;">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col" class="text-center" style="width: 100px;">Status</th>
                                    <th scope="col" class="text-center" style="width: 120px;">Date</th>
                                    <th scope="col" class="text-center" style="width: 200px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                <tr class="{{ $contact->isUnread() ? 'table-warning' : '' }}">
                                    <td class="text-center fw-bold">{{ $contact->id }}</td>
                                    <td class="fw-semibold">{{ $contact->name }}</td>
                                    <td>
                                        <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                                            {{ $contact->email }}
                                        </a>
                                    </td>
                                    <td>{{ Str::limit($contact->subject, 50) }}</td>
                                    <td class="text-center">
                                        @if($contact->isUnread())
                                            <span class="badge bg-warning text-dark">Unread</span>
                                        @elseif($contact->isRead())
                                            <span class="badge bg-info text-dark">Read</span>
                                        @else
                                            <span class="badge bg-success text-dark">Replied</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-muted">
                                        <small>{{ $contact->getFormattedCreatedDate() }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Contact actions">
                                            <a href="{{ route('admin.contacts.show', $contact) }}" 
                                               class="btn btn-sm btn-info" title="View Message">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($contact->isUnread())
                                            <form action="{{ route('admin.contacts.mark-as-read', $contact) }}" 
                                                  method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-warning" title="Mark as Read">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            @endif
                                            <form action="{{ route('admin.contacts.destroy', $contact) }}" 
                                                  method="POST" style="display: inline;"
                                                  onsubmit="return confirm('Are you sure you want to delete this message?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Message">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination with Bootstrap 5 -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $contacts->firstItem() ?? 0 }} to {{ $contacts->lastItem() ?? 0 }} of {{ $contacts->total() }} results
                        </div>
                        <div>
                            {{ $contacts->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-inbox fa-3x text-muted"></i>
                        </div>
                        <h4 class="text-muted">No contact messages found</h4>
                        <p class="text-muted">When someone submits the contact form, messages will appear here.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 