# FAQ Project - Janhavi
####**Epic 1: To activate user login after email verification**
1. After successful registration system should generate a confirmation code and add that to user model.
2. After registration system should send a mail to registered user id with verification link.
3. User should not be able to login without verification.
4. User should get verified by clicking on link received in his email.
5. System should update user as active/verified on link access by user.
6. User should be able to login successfully after verification.
7. System should be able to test above stated feature by generating fake mail.

>_Note: Please use Sendgrid or mail-trap account for successful running of above feature. Add hostname, username, port and password of your account to .env file._

####**Epic 2: To view all questions and answers posted by all users in the FAQ forum with user and time details**
1. After logging in user should be able to see all questions posted by all users.
2. User should be able to see all answers posted by other users as well.
3. User should see the question owner's(user's) email address and time of last update along with question.
3. User should see the answer owner's(user's) email address and time of last update along with answer.
4. User should be able to edit or delete only questions posted by him and not the ones posted by others.
5. User should be able to edit or delete only answers posted by him and not the ones posted by others.
6. Using dusk test environment system should be able to cross verify above stated functionality of edit and delete.

####**Epic 3: Testing with Dusk**
1. Install Dusk by following instruction on laravel dusk documentation website.
2. Generate a new test file using dusk commands.
3. Test System Environment should be able to perform User Registration test along with mail verification to create an active verified account.
4. Test System Environment should be able to login with existing user details.
5. Test System Environment should be able to create and update user profile details.
6. Test System Environment should be able to perform CRUD operation on Question.
7. Test System Environment should be able to perform CRUD operation on Answers.


