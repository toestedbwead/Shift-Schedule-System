# Hospital Management System

Welcome to the Shift & Scheduling System documentation.

## Table of Contents

1. [Overview](#overview)
2. [Admin Modules](#admin-modules)
3. [User Modules](#employee-modules)
4. [Usage Instructions](#usage-instructions)


## Admin Modules
1. [AddEmployee]
2. [ListofEmployee]
3. [AddSchedule]
4. [ListofSchedule]
5. [ViewShiftRequest] 
6. [NotificationforShiftRequest]

database name = shiftnsched

tables:
1. clock_table
columns: 
userID	
employeeName	
clockDate	
clockInTime	
clockOutTime
2. employee_table
columns:
emp_id	
emp_name	
emp_status	
emp_role	
emp_department	
3. login_table
columns:
login_id	
Email	
password	
Account_type
4. shift_change_requests
columns:
requestID	
employeeName	
currentShiftDate	
currentShiftType	
desiredShiftDate	
desiredShiftType	
swapEmployeeName	
requestDate	
status
5. shift_table
columns:
shift_id	
employeeName	
shift_type	
shift_time	
date	
day	
notes

## User Modules
1. [ViewSchedule]
2. [ClockInClockOut]
3. [RequestShiftChange]
4. [NotificationforShiftUpdates]

Here are the suggested columns for the modules/tables:


### 2. [ClockInClockOut]
This table will log the clock in and clock out times of users.

| Column Name        | Data Type       | Description                             |
|--------------------|-----------------|-----------------------------------------|
| `user_id`          | INT             | Foreign key linking to the users table  |
| `date`             | DATE            | Date of the clock in/out                |
| `clock_in_time`    | TIMESTAMP       | Clock in timestamp                      |
| `clock_out_time`   | TIMESTAMP       | Clock out timestamp                     |

### 3. [RequestShiftChange]
This table will handle requests for shift changes made by users.

| Column Name            | Data Type       | Description                             |
|------------------------|-----------------|-----------------------------------------|
| `request_id`           | INT (Primary Key, Auto Increment) | Unique identifier for each request record |
| `user_id`              | INT             | Foreign key linking to the users table  |
| `current_schedule_id`  | INT             | Foreign key linking to the current schedule table |
| `requested_date`       | DATE            | Date of the requested shift change      |
| `requested_start_time` | TIME            | Requested start time of the shift       |
| `requested_end_time`   | TIME            | Requested end time of the shift         |
| `reason`               | TEXT            | Reason for the shift change request     |
| `status`               | VARCHAR(50)     | Status of the request (e.g., Pending, Approved, Rejected) |
| `created_at`           | TIMESTAMP       | Record creation timestamp               |
| `updated_at`           | TIMESTAMP       | Record update timestamp                 |

### 4. [NotificationforShiftUpdates]
This table will store notifications related to shift updates.

| Column Name          | Data Type       | Description                             |
|----------------------|-----------------|-----------------------------------------|
| `notification_id`    | INT (Primary Key, Auto Increment) | Unique identifier for each notification record |
| `user_id`            | INT             | Foreign key linking to the users table  |
| `message`            | TEXT            | Notification message                    |
| `is_read`            | BOOLEAN         | Status of the notification (read/unread) |
| `created_at`         | TIMESTAMP       | Notification creation timestamp         |
| `updated_at`         | TIMESTAMP       | Notification update timestamp           |

These columns provide a comprehensive structure for managing user schedules, clocking in and out, shift change requests, and shift update notifications.