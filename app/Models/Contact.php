<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'read_at',
        'replied_at',
        'admin_reply'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope for read messages
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Scope for replied messages
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    /**
     * Mark message as read
     */
    public function markAsRead()
    {
        $this->update([
            'status' => 'read',
            'read_at' => now()
        ]);
    }

    /**
     * Mark message as replied
     */
    public function markAsReplied($reply = null)
    {
        $this->update([
            'status' => 'replied',
            'replied_at' => now(),
            'admin_reply' => $reply
        ]);
    }

    /**
     * Get formatted created date
     */
    public function getFormattedCreatedDate()
    {
        return $this->created_at ? $this->created_at->format('d.m.Y H:i') : '';
    }

    /**
     * Get formatted read date
     */
    public function getFormattedReadDate()
    {
        return $this->read_at ? $this->read_at->format('d.m.Y H:i') : '';
    }

    /**
     * Get formatted replied date
     */
    public function getFormattedRepliedDate()
    {
        return $this->replied_at ? $this->replied_at->format('d.m.Y H:i') : '';
    }

    /**
     * Check if message is unread
     */
    public function isUnread()
    {
        return $this->status === 'unread';
    }

    /**
     * Check if message is read
     */
    public function isRead()
    {
        return $this->status === 'read';
    }

    /**
     * Check if message is replied
     */
    public function isReplied()
    {
        return $this->status === 'replied';
    }
}
