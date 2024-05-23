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

## User Modules
1. [ViewSchedule]
2. [ClockInClockOut]
3. [RequestShiftChange]
4. [NotificationforShiftUpdates]

Here are the suggested columns for the modules/tables:

### 1. [ViewSchedule]
This table will store the schedule details of users.

| Column Name        | Data Type       | Description                             |
|--------------------|-----------------|-----------------------------------------|
| `schedule_id`      | INT (Primary Key, Auto Increment) | Unique identifier for each schedule record |
| `user_id`          | INT             | Foreign key linking to the users table  |
| `date`             | DATE            | Date of the scheduled shift             |
| `start_time`       | TIME            | Start time of the shift                 |
| `end_time`         | TIME            | End time of the shift                   |
| `shift_type`       | VARCHAR(50)     | Type of shift (e.g., Morning, Evening)  |
| `location`         | VARCHAR(100)    | Location of the shift                   |
| `created_at`       | TIMESTAMP       | Record creation timestamp               |
| `updated_at`       | TIMESTAMP       | Record update timestamp                 |

### 2. [ClockInClockOut]
This table will log the clock in and clock out times of users.

| Column Name        | Data Type       | Description                             |
|--------------------|-----------------|-----------------------------------------|
| `clock_id`         | INT (Primary Key, Auto Increment) | Unique identifier for each clock record |
| `user_id`          | INT             | Foreign key linking to the users table  |
| `date`             | DATE            | Date of the clock in/out                |
| `clock_in_time`    | TIMESTAMP       | Clock in timestamp                      |
| `clock_out_time`   | TIMESTAMP       | Clock out timestamp                     |
| `location`         | VARCHAR(100)    | Location of the clock in/out            |
| `created_at`       | TIMESTAMP       | Record creation timestamp               |
| `updated_at`       | TIMESTAMP       | Record update timestamp                 |

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