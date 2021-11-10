# Project Name: Basic Bank
## Project Summary: This project will create a bank simulation for users. They’ll be able to have various accounts, do standard bank functions like deposit, withdraw, internal (user’s accounts)/external(other user’s accounts) transfers, and creating/closing 
## Github Link: (Prod Branch of Project Folder) https://github.com/MichaelHalaj/IT-202-001/tree/prod/public_html/Project
## Project Board Link: https://github.com/MichaelHalaj/IT-202-001/projects/1
## Website Link: (Heroku Prod of Project folder) https://mh45-prod.herokuapp.com/Project/login.php
## Your Name: Michael Halaj

<!--
### Line item / Feature template (use this for each bullet point)
#### Don't delete this

- [ ] \(mm/dd/yyyy of completion) Feature Title (from the proposal bullet point, if it's a sub-point indent it properly)
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show
### End Line item / Feature Template
--> 
### Proposal Checklist and Evidence

- Milestone 1

  - [x] \(11/6/2021) User will be able to register a new account
    -  List of Evidence of Feature Completion
        * Form Fields
            * Username, email, password, confirm password (other fields optional)
            * Email is required and must be validated
            * Username is required
            * Confirm password’s match
        * <span style="text-decoration:underline;">Users</span> Table
            * Id, username, email, password (60 characters), created, modified
        * Password must be hashed (plain text passwords will lose points)
        * Email should be unique
        * Username should be unique
        * System should let user know if username or email is taken and allow the user to correct the error without wiping/clearing the form
            * The only fields that may be cleared are the password fields
      - Status: Completed
      - Direct Link: https://mh45-prod.herokuapp.com/Project/register.php
      - Pull Requests
        - https://github.com/MichaelHalaj/IT-202-001/pull/17
      - Screenshots
        ![Screenshot (86)](https://user-images.githubusercontent.com/89932319/140791213-4d8ac5c8-35d1-47dc-9470-5fa4451794e5.png)
          - Demonstrates the input needed to register




  - [x] \(11/7/2021 of completion)  User will be able to login to their account (given they enter the correct credentials)
    -  List of Evidence of Feature Completion
         * Form
             * User can login with **email **or **username**
                 * This can be done as a single field or as two separate fields
             * Password is required
         * User should see friendly error messages when an account either doesn’t exist or if passwords don’t match
         * Logging in should fetch the user’s details (and roles) and save them into the session.
         * User will be directed to a landing page upon login
             * This is a protected page (non-logged in users shouldn’t have access)
             * This can be home, profile, a dashboard, etc
      - Status: Completed
      - Direct Link: https://mh45-prod.herokuapp.com/Project/login.php
      - Pull Requests
        - https://github.com/MichaelHalaj/IT-202-001/pull/29
      - Screenshots
        ![Screenshot (84)](https://user-images.githubusercontent.com/89932319/140653988-c91204ac-def5-42f1-a057-a51f0ce2e502.png)
          - Demonstrates the input needed to login to user account

  - [x] \(11/7/2021 of completion) User will be able to logout
    -  List of Evidence of Feature Completion
         * Logging out will redirect to login page
         * User should see a message that they’ve successfully logged out
         * Session should be destroyed (so the back button doesn’t allow them access back in)
      - Status: Completed
      - Direct Link: https://mh45-prod.herokuapp.com/Project/login.php
      - Pull Requests
        - https://github.com/MichaelHalaj/IT-202-001/pull/30
      - Screenshots
        ![Screenshot (88)](https://user-images.githubusercontent.com/89932319/140805910-084bb811-401d-4a01-8bcc-3829f97ed0d0.png)
          - Demonstrates the successful logout message

  - [x] \(11/7/2021) of completion) Basic security rules implemented
    -  List of Evidence of Feature Completion
         * Authentication:
             * Function to check if user is logged in
             * Function should be called on appropriate pages that only allow logged in users
         * Roles/Authorization:
             * Have a roles table (see below)
      - Status: Completed
      - Direct Link: https://mh45-prod.herokuapp.com/Project/home.php
      - Pull Requests
        - https://github.com/MichaelHalaj/IT-202-001/pull/18
      - Screenshots
        - ![Screenshot (90)](https://user-images.githubusercontent.com/89932319/140847686-8fd57073-cfd5-4827-a3cb-d36bfdcd5fd9.png)
          - Demonstrates the function that checks if a user is logged in

  - [x] \(11/8/2021) Basic Roles implemented
    -  List of Evidence of Feature Completion
         * Have a <span style="text-decoration:underline;">Roles</span> table	(id, name, description, is_active, modified, created)
         * Have a <span style="text-decoration:underline;">User Roles</span> table (id, user_id, role_id, is_active, created, modified)
         * Include a function to check if a user has a specific role (we won’t use it for this milestone but it should be usable in the future)
      - Status: Completed
      - Direct Link: https://mh45-prod.herokuapp.com/Project/admin/assign_roles.php
      - Pull Requests
        - https://github.com/MichaelHalaj/IT-202-001/pull/31
      - Screenshots
        - ![Screenshot (97)](https://user-images.githubusercontent.com/89932319/141029384-21d69541-4c7e-4111-ad21-5bde18dee981.png)
          - Demonstrates the tables created with the roles

  - [x] \(11/8/2021) Site should have basic styles/theme applied; everything should be styled
    -  List of Evidence of Feature Completion
         * I.e., forms/input, navigation bar, etc
      - Status: Completed
      - Direct Link: https://mh45-prod.herokuapp.com/Project/home.php
      - Pull Requests
        - https://github.com/MichaelHalaj/IT-202-001/pull/35
      - Screenshots
        - ![Screenshot (99)](https://user-images.githubusercontent.com/89932319/141029783-b7d9f613-33a5-481a-843e-e42d0396eee1.png)
          - Show thats the site follows a dark theme with black, grey, and white

  - [x] \(11/8/2021) Any output messages/errors should be “user friendly”
    -  List of Evidence of Feature Completion
         * I.e., forms/input, navigation bar, etc
         * Any technical errors or debug output displayed will result in a loss of points
      - Status: Completed
      - Direct Link: https://mh45-prod.herokuapp.com/Project/home.php
      - Pull Requests
        - https://github.com/MichaelHalaj/IT-202-001/pull/18
      - Screenshots
        - ![Screenshot (104)](https://user-images.githubusercontent.com/89932319/141034631-b929e72c-6fb7-4164-b58c-e07ba17e3466.png)
          - Demonstrates a user friendly message where the the user is notified that the passwords do not match

  - [x] \(11/8/2021) User will be able to see their profile
    -  List of Evidence of Feature Completion
        * Email, username, etc
      - Status: Pending (Completed)
      - Direct Link: https://mh45-prod.herokuapp.com/Project/profile.php
      - Pull Requests
        - https://github.com/MichaelHalaj/IT-202-001/pull/29
      - Screenshots
        - ![Screenshot (93)](https://user-images.githubusercontent.com/89932319/140848060-75314ea4-548d-47a9-90f9-69310c2c56b9.png)
          - Demonstrates that the user can view their profile information and change their password if they need to 

  - [x] \(11/8/2021) User will be able to edit their profile
    -  List of Evidence of Feature Completion
         * Changing username/email should properly check to see if it’s available before allowing the change
         * Any other fields should be properly validated
         * Allow password reset (only if the existing correct password is provided)
             * Hint: logic for the password check would be similar to login
      - Status: Completed
      - Direct Link: https://mh45-prod.herokuapp.com/Project/profile.php
      - Pull Requests
        - https://github.com/MichaelHalaj/IT-202-001/pull/29
      - Screenshots
        - ![Screenshot (93)](https://user-images.githubusercontent.com/89932319/140848060-75314ea4-548d-47a9-90f9-69310c2c56b9.png)
          - Demonstrates that the user can change their info in the profile section


- Milestone 2

  - [ ] \(mm/dd/yyyy of completion) Create the Accounts table (id, account_number [unique, always 12 characters], user_id, balance (default 0), account_type, created, modified)
    -  List of Evidence of Feature Completion
      - Status: Pending (Completed, Partially working, Incomplete, Pending)
      - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
      - Pull Requests
        - PR link #1 (repeat as necessary)
      - Screenshots
        - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
          - Screenshot #1 description explaining what you're trying to show

  - [ ] \(mm/dd/yyyy of completion) Project setup steps:
    -  List of Evidence of Feature Completion
      - Status: Pending (Completed, Partially working, Incomplete, Pending)
      - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
      - Pull Requests
        - PR link #1 (repeat as necessary)
      - Screenshots
        - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
          - Screenshot #1 description explaining what you're trying to show

  - [ ] \(mm/dd/yyyy of completion) Create the Transactions table (see reference below)
    -  List of Evidence of Feature Completion
      - Status: Pending (Completed, Partially working, Incomplete, Pending)
      - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
      - Pull Requests
        - PR link #1 (repeat as necessary)
      - Screenshots
        - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
          - Screenshot #1 description explaining what you're trying to show

  - [ ] \(mm/dd/yyyy of completion) Dashboard page
    -  List of Evidence of Feature Completion
      - Status: Pending (Completed, Partially working, Incomplete, Pending)
      - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
      - Pull Requests
        - PR link #1 (repeat as necessary)
      - Screenshots
        - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
          - Screenshot #1 description explaining what you're trying to show

  - [ ] \(mm/dd/yyyy of completion) User will be able to create a checking account
    -  List of Evidence of Feature Completion
      - Status: Pending (Completed, Partially working, Incomplete, Pending)
      - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
      - Pull Requests
        - PR link #1 (repeat as necessary)
      - Screenshots
        - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
          - Screenshot #1 description explaining what you're trying to show

  - [ ] \(mm/dd/yyyy of completion) User will be able to list their accounts
    -  List of Evidence of Feature Completion
      - Status: Pending (Completed, Partially working, Incomplete, Pending)
      - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
      - Pull Requests
        - PR link #1 (repeat as necessary)
      - Screenshots
        - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
          - Screenshot #1 description explaining what you're trying to show

  - [ ] \(mm/dd/yyyy of completion) User will be able to click an account for more information (a.ka. Transaction History page)
    -  List of Evidence of Feature Completion
      - Status: Pending (Completed, Partially working, Incomplete, Pending)
      - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
      - Pull Requests
        - PR link #1 (repeat as necessary)
      - Screenshots
        - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
          - Screenshot #1 description explaining what you're trying to show

  - [ ] \(mm/dd/yyyy of completion) User will be able to deposit/withdraw from their account(s)
    -  List of Evidence of Feature Completion
      - Status: Pending (Completed, Partially working, Incomplete, Pending)
      - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
      - Pull Requests
        - PR link #1 (repeat as necessary)
      - Screenshots
        - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
          - Screenshot #1 description explaining what you're trying to show
- Milestone 3
- Milestone 4
### Intructions
#### Don't delete this
1. Pick one project type
2. Create a proposal.md file in the root of your project directory of your GitHub repository
3. Copy the contents of the Google Doc into this readme file
4. Convert the list items to markdown checkboxes (apply any other markdown for organizational purposes)
5. Create a new Project Board on GitHub
   - Choose the Automated Kanban Board Template
   - For each major line item (or sub line item if applicable) create a GitHub issue
   - The title should be the line item text
   - The first comment should be the acceptance criteria (i.e., what you need to accomplish for it to be "complete")
   - Leave these in "to do" status until you start working on them
   - Assign each issue to your Project Board (the right-side panel)
   - Assign each issue to yourself (the right-side panel)
6. As you work
  1. As you work on features, create separate branches for the code in the style of Feature-ShortDescription (using the Milestone branch as the source)
  2. Add, commit, push the related file changes to this branch
  3. Add evidence to the PR (Feat to Milestone) conversation view comments showing the feature being implemented
     - Screenshot(s) of the site view (make sure they clearly show the feature)
     - Screenshot of the database data if applicable
     - Describe each screenshot to specify exactly what's being shown
     - A code snippet screenshot or reference via GitHub markdown may be used as an alternative for evidence that can't be captured on the screen
  4. Update the checklist of the proposal.md file for each feature this is completing (ideally should be 1 branch/pull request per feature, but some cases may have multiple)
    - Basically add an x to the checkbox markdown along with a date after
      - (i.e.,   - [x] (mm/dd/yy) ....) See Template above
    - Add the pull request link as a new indented line for each line item being completed
    - Attach any related issue items on the right-side panel
  5. Merge the Feature Branch into your Milestone branch (this should close the pull request and the attached issues)
    - Merge the Milestone branch into dev, then dev into prod as needed
    - Last two steps are mostly for getting it to prod for delivery of the assignment 
  7. If the attached issues don't close wait until the next step
  8. Merge the updated dev branch into your production branch via a pull request
  9. Close any related issues that didn't auto close
    - You can edit the dropdown on the issue or drag/drop it to the proper column on the project board