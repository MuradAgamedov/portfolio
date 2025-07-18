@extends('admin.layouts.master')

@section('title', 'View Contact Message')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Message #{{ $contact->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Message Details -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Message Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-3"><strong>Name:</strong></div>
                                        <div class="col-md-9">{{ $contact->name }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3"><strong>Email:</strong></div>
                                        <div class="col-md-9">
                                            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                        </div>
                                    </div>
                                    @if($contact->phone)
                                    <div class="row mb-3">
                                        <div class="col-md-3"><strong>Phone:</strong></div>
                                        <div class="col-md-9">
                                            <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col-md-3"><strong>Subject:</strong></div>
                                        <div class="col-md-9">{{ $contact->subject }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3"><strong>Message:</strong></div>
                                        <div class="col-md-9">
                                            <div class="border p-3 bg-light">
                                                {!! nl2br(e($contact->message)) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3"><strong>Status:</strong></div>
                                        <div class="col-md-9">
                                            @if($contact->isUnread())
                                                <span class="badge badge-warning">Unread</span>
                                            @elseif($contact->isRead())
                                                <span class="badge badge-info">Read</span>
                                            @else
                                                <span class="badge badge-success">Replied</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3"><strong>Sent:</strong></div>
                                        <div class="col-md-9">{{ $contact->getFormattedCreatedDate() }}</div>
                                    </div>
                                    @if($contact->read_at)
                                    <div class="row mb-3">
                                        <div class="col-md-3"><strong>Read:</strong></div>
                                        <div class="col-md-9">{{ $contact->getFormattedReadDate() }}</div>
                                    </div>
                                    @endif
                                    @if($contact->replied_at)
                                    <div class="row mb-3">
                                        <div class="col-md-3"><strong>Replied:</strong></div>
                                        <div class="col-md-9">{{ $contact->getFormattedRepliedDate() }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Actions -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Actions</h5>
                                </div>
                                <div class="card-body">
                                    @if($contact->isUnread())
                                    <form action="{{ route('admin.contacts.mark-as-read', $contact) }}" method="POST" class="mb-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-block">
                                            <i class="fas fa-check"></i> Mark as Read
                                        </button>
                                    </form>
                                    @endif
                                    
                                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                                       class="btn btn-primary btn-block mb-2">
                                        <i class="fas fa-reply"></i> Reply via Email
                                    </a>
                                    
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block">
                                            <i class="fas fa-trash"></i> Delete Message
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Reply Form -->
                            @if(!$contact->isReplied())
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Send Reply</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="admin_reply">Your Reply:</label>
                                            <textarea name="admin_reply" id="admin_reply" rows="5" 
                                                      class="form-control" required 
                                                      placeholder="Type your reply here..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fas fa-paper-plane"></i> Send Reply
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Admin Reply -->
                            @if($contact->admin_reply)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Admin Reply</h5>
                                </div>
                                <div class="card-body">
                                    <div class="border p-3 bg-light">
                                        {!! nl2br(e($contact->admin_reply)) !!}
                                    </div>
                                    <small class="text-muted">
                                        Replied on: {{ $contact->getFormattedRepliedDate() }}
                                    </small>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 