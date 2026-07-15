# E-Surat Binangun - Implementation Guide

## Overview
This document outlines the new features that have been implemented to complete the e-surat system, including the admin dashboard, user management, and notification system.

## New Features Implemented

### 1. Admin Dashboard
**Location**: `/admin/dashboard`
**Controller**: `App\Http\Controllers\Admin\DashboardController`
**View**: `resources/views/admin/dashboard.blade.php`

**Features**:
- Display statistics:
  - Total number of surat submissions
  - Pending surat count
  - Surat being processed (diproses)
  - Completed surat (selesai)
  - Total number of users
- Display recent surat submissions (last 10)
- Quick access to user management and surat management

**Access**: Only admin users can access this page. Non-admin users will receive a 403 error.

### 2. User Management System
**Location**: `/admin/users`
**Controller**: `App\Http\Controllers\Admin\DashboardController` (users method)
**View**: `resources/views/admin/users.blade.php`

**Features**:
- View all users in a paginated table (15 users per page)
- Toggle admin status for users
- Toggle active/inactive status for users
- Delete users
- Safety checks prevent:
  - Toggling own admin status
  - Deactivating own account
  - Deleting own account

**User Information Displayed**:
- Name
- Email
- NIK (National ID)
- Role (Admin/User)
- Status (Active/Inactive)

### 3. Admin Notification System
**Location**: `/notifications`
**Controller**: `App\Http\Controllers\NotificationController`
**Model**: `App\Models\AdminNotification`
**View**: `resources/views/notifications/index.blade.php`

**Features**:
- Receive notifications when:
  - New users register
  - New surat submissions are made
- Mark individual notifications as read
- Mark all notifications as read
- Delete individual notifications
- Clear all notifications at once
- View unread notification count (JSON endpoint)

**Database Table**: `admin_notifications`
- `id`: Primary key
- `user_id`: Admin user who receives the notification
- `type`: Type of notification (e.g., 'surat_submitted', 'user_registered')
- `title`: Notification title
- `message`: Notification message
- `related_model`: Model type (e.g., 'Surat', 'User')
- `related_id`: ID of the related model
- `read_at`: Timestamp when notification was read
- `created_at`: Timestamp when notification was created
- `updated_at`: Timestamp when notification was last updated

### 4. Profile Update with File Uploads
**Location**: `/profile/edit`
**Controller**: `App\Http\Controllers\ProfileController`
**View**: `resources/views/profile/edit.blade.php`

**File Upload Support**:
- Profile picture (JPG, PNG, max 2MB)
- Digital signature (JPG, PNG, max 2MB)
- KTP scan (JPG, PNG, max 2MB)
- Kartu Keluarga (KK) scan (JPG, PNG, max 2MB)

**Storage Locations**:
- Profile pictures: `storage/profile/`
- Signatures: `storage/signatures/`
- KTP: `storage/ktp/`
- KK: `storage/kk/`

**Features**:
- Preview uploaded files
- Replace files by uploading new ones
- Old files are automatically deleted when replaced
- All file uploads are validated for type and size

## Installation & Deployment

### Step 1: Run Migrations
Execute the following command to create the necessary database tables:

```bash
php artisan migrate
```

This will create:
- `admin_notifications` table for storing admin notifications
- Add document fields to `users` table (signature_path, ktp_path, kk_path)

### Step 2: Create Storage Symlink
Create a symbolic link for public file access:

```bash
php artisan storage:link
```

This creates a link from `public/storage` to `storage/app/public`.

### Step 3: Set File Permissions
Ensure the storage directory is writable:

```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Step 4: Test the Features

#### Test Admin Dashboard
1. Log in as an admin user
2. Navigate to `/admin/dashboard`
3. Verify that statistics and recent surat are displayed

#### Test User Management
1. As an admin, go to `/admin/dashboard`
2. Click "Manage Users"
3. Test toggling admin status, active status, and deleting users

#### Test Notifications
1. Register a new user (admin should receive a notification)
2. Submit a new surat (admin should receive a notification)
3. Go to `/notifications` as an admin
4. Verify notifications are displayed
5. Test marking as read and deleting notifications

#### Test Profile Updates
1. Log in as a regular user
2. Go to `/profile/edit`
3. Upload KTP, signature, and other documents
4. Verify files are saved and displayed

## Routes

### Admin Routes (Protected by 'admin' middleware)
```
GET  /admin/dashboard                          - Admin dashboard
GET  /admin/users                              - User management
POST /admin/users/{user}/toggle-admin          - Toggle admin status
POST /admin/users/{user}/toggle-active         - Toggle active status
DELETE /admin/users/{user}                     - Delete user
GET  /notifications                            - View notifications
GET  /notifications/unread-count               - Get unread count (JSON)
POST /notifications/{notification}/mark-read  - Mark as read
POST /notifications/mark-all-read              - Mark all as read
POST /notifications/{notification}/delete      - Delete notification
POST /notifications/clear-all                  - Clear all notifications
```

### User Routes (Protected by 'auth' middleware)
```
GET  /profile                                  - View profile
GET  /profile/edit                             - Edit profile
PUT  /profile                                  - Update profile
```

## File Structure

### New Controllers
- `app/Http/Controllers/Admin/DashboardController.php`
- `app/Http/Controllers/NotificationController.php`

### New Models
- `app/Models/AdminNotification.php`

### New Views
- `resources/views/admin/users.blade.php`
- `resources/views/notifications/index.blade.php`

### New Migrations
- `database/migrations/2024_07_14_create_admin_notifications_table.php`
- `database/migrations/2024_07_14_add_document_fields_to_users_table.php`

## Security Considerations

1. **Admin Middleware**: All admin routes are protected by the 'admin' middleware which checks `is_admin` flag
2. **Authorization Checks**: Controllers verify user permissions before allowing actions
3. **Self-Protection**: Users cannot modify their own admin status or delete their own accounts
4. **File Validation**: All file uploads are validated for type and size
5. **CSRF Protection**: All forms include CSRF tokens

## Troubleshooting

### Notifications not appearing
- Ensure migrations have been run: `php artisan migrate`
- Check that the user is marked as admin: `is_admin = true` in users table

### File uploads not working
- Verify storage symlink exists: `php artisan storage:link`
- Check file permissions: `chmod -R 775 storage/`
- Ensure upload directory exists: `storage/app/public/profile/`, etc.

### Admin dashboard shows 0 statistics
- Verify admin user has `is_admin = true` in database
- Check that surat records exist in the database

## Future Enhancements

Potential improvements for future versions:
1. Email notifications to admins
2. SMS notifications for urgent surat
3. Notification preferences (which types to receive)
4. Batch operations for user management
5. Advanced filtering and search in admin dashboard
6. Export user and surat data to CSV/Excel
7. Admin activity logging
8. User activity logs

## Support

For issues or questions about these implementations, please refer to the Laravel documentation:
- [Laravel File Storage](https://laravel.com/docs/filesystem)
- [Laravel Eloquent](https://laravel.com/docs/eloquent)
- [Laravel Authorization](https://laravel.com/docs/authorization)
