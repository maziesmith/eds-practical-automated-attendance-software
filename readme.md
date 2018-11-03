# About Project

This project was done to solve the problem of people being marked absent for programs in COvenant University even though they have taken exeats. The software allows exeats to be recorded and upon upload of attendances students who have been granted exeat are marked as "ON EXEAT" rather than "ABSENT"......so they don't get into trouble and don't have to stress with clarifying their attendances.

It was built with Laravel 5.7. Laravel has the most extensive and thorough [documentation] (https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

## How To Use
### For Developer
 Currently no function has been created to handle registration. Users are to be seeded.
 The UsersTableSeeder contains a factory class to populate the users table with student. It is currently commented out and you can define your own seeder class or factory.

### For Admins
The dashboard side tab has links to upload attendance, compute attendance, view attendance, add event and add exeat.
#### Add Exeat
 - Click on the Exeat link
 - Enter ID of student and start and end dates of exeat
 - Submit
#### Add Event
 - Click on Event link
 - Enter event name
 - Enter start and end dates of event
 - Submit
#### Upload Attendance
 - Click on Upload attendance link
 - Enter ID of Event for attendance
 - Upload attendance file. (CSV document containing just matriculation number of students present. A sample can be seen in the public/uploads/attendances folder)
 - Submit
#### Compute Attendance
 - Click on Compute attendance link
 - Enter ID of Event to compute attendance
 - Submit
 (This action must be done after attendance upload and not before.)
#### View Attendance
 - Click on view attendance link
 - Enter ID of attendance to view.
 - Submit
## Future Updates
 - Allow registration of users and addition of users by admins.
 - Allow admin to view events and their IDs from front end.
 - Allow admin to search for events from frontend on upload/computation/view of attendance.
 - Automatically recompute attendance if exeat table is updated.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
