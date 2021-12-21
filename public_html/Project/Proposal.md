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


<table><tr><td>Milestone 2</td></tr><tr><td><table><tr><td>F1 - Create the Accounts table (id, account_number [unique, always 12 characters], user_id, balance (default 0), account_type, created, modified) (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/login.php](https://mh45-prod.herokuapp.com/Project/login.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/user_accounts.php](https://mh45-prod.herokuapp.com/Project/user_accounts.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/62](https://github.com/MichaelHalaj/IT-202-001/pull/62)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/66](https://github.com/MichaelHalaj/IT-202-001/pull/66)</p></td></tr><tr><td><table><tr><td>F1 - none<tr><td>Status: completed</td></tr><tr><td>![Screenshot (121)](https://user-images.githubusercontent.com/89932319/144532379-1dedebb4-5423-4be1-8a8a-eba6608851fe.png)<p>Shows tables with appropriate labels</td></tr></td></tr></table></td></tr><table><tr><td>F2 - Project setup steps: (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/login.php](https://mh45-prod.herokuapp.com/Project/login.php)</p></td></tr><tr><td>PRs:<p>

[https://github.com/MichaelHalaj/IT-202-001/pull/65](https://github.com/MichaelHalaj/IT-202-001/pull/65)</p></td></tr><tr><td><table><tr><td>F2 - Create a system user if they don’t exist (this will never be logged into, it’s just to keep things working per system requirements)<tr><td>Status: completed</td></tr><tr><td>![Screenshot (123)](https://user-images.githubusercontent.com/89932319/144532861-42c02a93-3e23-4ff3-b4ac-8b96e0b7a679.png)<p>Shows code inserting a system user</td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F2 - Create a world account in the Accounts table created below (if it doesn’t exist)<tr><td>Status: completed</td></tr><tr><td> ![Screenshot (125)](https://user-images.githubusercontent.com/89932319/144533026-60da3211-8eea-4019-8800-b9bab9412899.png)<p>Show code inserting a world account </td></tr></td></tr></table></td></tr><table><tr><td>F3 - Create the Transactions table (see reference below) (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p> 

 [https://mh45-prod.herokuapp.com/Project/login.php](https://mh45-prod.herokuapp.com/Project/login.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/63](https://github.com/MichaelHalaj/IT-202-001/pull/63)</p></td></tr><tr><td><table><tr><td>F3 - none<tr><td>Status: completed</td></tr><tr><td>![Screenshot (127)](https://user-images.githubusercontent.com/89932319/144533437-cc737c12-af10-420e-bfb3-f61a12fdc6e6.png)<p>Code showing the creation of the transaction table</td></tr></td></tr></table></td></tr><table><tr><td>F4 - Dashboard page (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/64](https://github.com/MichaelHalaj/IT-202-001/pull/64)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/67](https://github.com/MichaelHalaj/IT-202-001/pull/67)</p></td></tr><tr><td><table><tr><td>F4 - Will have links for Create Account, My Accounts, Deposit, Withdraw Transfer, Profile<tr><td>Status: completed</td></tr><tr><td>![Screenshot (129)](https://user-images.githubusercontent.com/89932319/144533733-61f5308d-c1ae-4ea2-b188-0bdac1e7ceec.png)<p>Shows dashboard page with buttons to take the user where they need to go</td></tr></td></tr></table></td></tr><table><tr><td>F5 - User will be able to create a checking account (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/account.php](https://mh45-prod.herokuapp.com/Project/account.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/68](https://github.com/MichaelHalaj/IT-202-001/pull/68)</p></td></tr><tr><td><table><tr><td>F5 - System will generate a unique 12 digit account number<tr><td>Status: completed</td></tr><tr><td>![Screenshot (132)](https://user-images.githubusercontent.com/89932319/144534170-9aded637-d3c1-445b-b280-22b5abfa67c0.png)<p>Demonstration of two possible account numbers generated from the system</td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F5 - System will associate the account to the user / Account type will be set as checking<tr><td>Status: completed</td></tr><tr><td>![Screenshot (134)](https://user-images.githubusercontent.com/89932319/144534564-b257c7bf-1dd4-4878-a7d8-66003f73a74f.png)<p>Table showing system associating ID to the account and that accounts are being set as checking</td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F5 - Will require a minimum deposit of $5 (from the world account) / User friendly messages<tr><td>Status: completed</td></tr><tr><td>![Screenshot (136)](https://user-images.githubusercontent.com/89932319/144534861-dce36fd7-27e6-4df3-bc0a-7bb4cd0e7792.png)<p>Message showing minimum deposit of $5</td></tr><tr><td>![Screenshot (138)](https://user-images.githubusercontent.com/89932319/144535008-3a7e3739-47ac-499c-9de2-0a81713fa6f5.png)<p>User friendly message showing successful creation as well as redirecting to user's accounts page</td></tr></td></tr></table></td></tr><table><tr><td>F6 - User will be able to list their accounts (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/user_accounts.php](https://mh45-prod.herokuapp.com/Project/user_accounts.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/69](https://github.com/MichaelHalaj/IT-202-001/pull/69)</p></td></tr><tr><td><table><tr><td>F6 - Limit results to 5 for now / Show account number, account type and balance<tr><td>Status: completed</td></tr><tr><td>![Screenshot (140)](https://user-images.githubusercontent.com/89932319/144535525-9f9c0223-5415-4d5e-a0e3-5c4cb03a74ef.png)<p>List of 5 user accounts with the necessary values displayed</td></tr></td></tr></table></td></tr><table><tr><td>F7 - User will be able to click an account for more information (a.ka. Transaction History page) (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/user_accounts.php](https://mh45-prod.herokuapp.com/Project/user_accounts.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/71](https://github.com/MichaelHalaj/IT-202-001/pull/71)</p></td></tr><tr><td><table><tr><td>F7 - Show account number, account type, balance, opened/created date / Show transaction history (from Transactions table)<tr><td>Status: completed</td></tr><tr><td>![Screenshot (143)](https://user-images.githubusercontent.com/89932319/144536344-8592cba6-8686-4aec-b2a1-f4e2fc6521d9.png)<p>Shows all the necessary information of an account split into two tables as well the limit of 10 results</td></tr><tr><td>![Screenshot (145)](https://user-images.githubusercontent.com/89932319/144536506-ca4536fc-ca44-45f2-b339-358f452afb43.png)<p>Shows a slightly different account with less transactions</td></tr></td></tr></table></td></tr><table><tr><td>F8 - User will be able to deposit/withdraw from their account(s) (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/deposit.php](https://mh45-prod.herokuapp.com/Project/deposit.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/withdraw.php](https://mh45-prod.herokuapp.com/Project/withdraw.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/70](https://github.com/MichaelHalaj/IT-202-001/pull/70)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/72](https://github.com/MichaelHalaj/IT-202-001/pull/72)</p></td></tr><tr><td><table><tr><td>F8 - Form should have a dropdown of their accounts to pick from / World account should not be in the dropdown/  Form should have a field to enter a positive numeric value / For now, allow any deposit value (0 - inf) / Form should allow the user to record a memo for the transaction<tr><td>Status: pending</td></tr><tr><td>![Screenshot (149)](https://user-images.githubusercontent.com/89932319/144537472-d4018606-d8a1-4380-81f3-0972081ed50d.png)<p>Drop down of accounts</td></tr><tr><td>![Screenshot (151)](https://user-images.githubusercontent.com/89932319/144537595-ed16a2ce-79ac-436b-8fec-94affe45b287.png)<p>Minimum deposit amount and display of memo</td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F8 - For withdraw, add a check to make sure they can’t withdraw more money than the account has / Show appropriate user-friendly error messages<tr><td>Status: completed</td></tr><tr><td>![Screenshot (154)](https://user-images.githubusercontent.com/89932319/144538243-8ebe4af9-5204-4f99-9ab5-742ecab87cad.png)<p>Shows that the user cannot withdraw more than their account balance</td></tr><tr><td>![Screenshot (156)](https://user-images.githubusercontent.com/89932319/144538517-6bbeb003-91e2-47d8-b632-48799351d624.png)<p>Code that checks that withdrawal is not greater than balance</td></tr><tr><td>![Screenshot (163)](https://user-images.githubusercontent.com/89932319/144539232-49b78ce2-02a8-485b-be2c-913754d0f1e3.png)<p>Shows user friendly message after withdrawal</td></tr><tr><td>![Screenshot (165)](https://user-images.githubusercontent.com/89932319/144539375-7440c496-5e41-4ebc-a9f9-103b820093fe.png)<p>Shows user friendly message after deposit</td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F8 - Each transaction is recorded as a transaction pair in the Transaction table per the details below<tr><td>Status: completed</td></tr><tr><td>![Screenshot (159)](https://user-images.githubusercontent.com/89932319/144538758-da97fbf6-620c-4e7a-928c-81be57791beb.png)<p>Shows transaction pair in transaction table</td></tr><tr><td>![Screenshot (161)](https://user-images.githubusercontent.com/89932319/144540637-8ba40882-3f25-4828-834a-68df619794ff.png)<p>Shows that world account is negative due to all the deposits</td></tr></td></tr></table></td></tr></td></tr></table>

<table>
<tr><td>Milestone3</td></tr><tr><td>
<table>
<tr><td>F1 - User will be able to transfer between their accounts (2021-12-10)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/transfer.php](https://mh45-prod.herokuapp.com/Project/transfer.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/login.php](https://mh45-prod.herokuapp.com/Project/login.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/76](https://github.com/MichaelHalaj/IT-202-001/pull/76)</p></td></tr>
<tr><td>
<table>
<tr><td>F1 - Form should include a dropdown first AccountSrc and a dropdown for AccountDest (only accounts the user owns; no world account)</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145655043-590b5220-5fff-4c8a-9717-418e11196c7b.png">
<p>Demonstrates the account dropdown for source</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145655093-e96bae70-714a-41dd-bb6b-ce536f259b4a.png">
<p>Demonstrates the account dropdown for destination</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F1 - Form should include a field for a positive numeric value</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145655182-097cdeac-0ff2-451c-a821-8cc3df4bc505.png">
<p>Demonstrates a field where you cannot enter a negative number</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F1 - System shouldn’t allow the user to transfer more funds than what’s available in AccountSrc</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145655348-3f7ee9a7-67c7-4058-9306-b77751b4af61.png">
<p>Shows that the source cannot transfer more than it has</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F1 - Form should allow the user to record a memo for the transaction</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145655453-ac721fb7-3b23-4089-8799-1d19195d7df2.png">
<p>Shows input for memo</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F1 - Each transaction is recorded as a transaction pair in the Transaction table / These will reflect in the transaction history page</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145655631-2e341775-b6ed-40fe-b1b6-bfe1bf4df28d.png">
<p>Shows that transaction was recorded as a pair</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F1 - Show appropriate user-friendly error messages / Show user-friendly success messages</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145655736-eeac48be-9679-4e63-b0c1-f21d8cf3a579.png">
<p>Shows successful transfer and redirect to user's accounts</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145655812-32fd40e3-08d5-493a-a85e-0144424a6561.png">
<p>Shows that user cannot transfer into the same account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145655869-35453f9f-baf2-40ef-85a5-62744c6a8c97.png">
<p>Check if user selected an account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145655908-be4e1c50-e039-498a-9cd6-84ace189887d.png">
<p>Check if user selected an account</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F2 - Transaction History page (2021-12-10)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/login.php](https://mh45-prod.herokuapp.com/Project/login.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/user_accounts.php](https://mh45-prod.herokuapp.com/Project/user_accounts.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/transactions.php](https://mh45-prod.herokuapp.com/Project/transactions.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/79](https://github.com/MichaelHalaj/IT-202-001/pull/79)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/92](https://github.com/MichaelHalaj/IT-202-001/pull/92)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/93](https://github.com/MichaelHalaj/IT-202-001/pull/93)</p></td></tr>
<tr><td>
<table>
<tr><td>F2 - Will show the latest 10 transactions by default</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656129-a9fcf329-3396-4897-930f-b29655be4048.png">
<p>Shows that once an account is selected and filter is pressed, a default of 10 transactions are shown</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145657934-f4d6e3e5-ab38-49e2-b0bf-6458de72b864.png">
<p>Showing where to find this filter page by clicking more details</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F2 - User will be able to filter transactions between two dates</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656207-12a0c2f1-458b-408f-bec6-88418fbd8138.png">
<p>Shows the filter for transactions between two dates</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656255-ffde7475-2a26-423e-9525-15cae9c2eeb6.png">
<p>Shows the filter for transactions between two dates</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F2 - User will be able to filter transactions by type (deposit, withdraw, transfer)</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656310-9ff75e75-f56e-4937-a241-0f192a851141.png">
<p>Shows the selection of type</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656335-6baab4b8-7537-4589-82af-be23dc4139b3.png">
<p>Shows the successful filter for transfers</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656369-45765194-9156-4c03-90ba-421f99c24572.png">
<p>Shows the successful filter for deposits</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F2 - Transactions should paginate results after the initial 10</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656466-fed55e8c-d0ba-45ef-a79c-0559cede98fa.png">
<p>Shows first page as well as high to low order; however, pages numbers do not show up bottom left</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656550-89838463-fb9a-4a11-8823-b5069a923f22.png">
<p>Shows second page; however, high to low order does not persist </p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656595-b02e1fc0-2f4e-4523-b810-c7996d5b9910.png">
<p>Shows last page</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F3 - User’s profile page should record/show First and Last name (2021-12-10)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/profile.php](https://mh45-prod.herokuapp.com/Project/profile.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/login.php](https://mh45-prod.herokuapp.com/Project/login.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/81](https://github.com/MichaelHalaj/IT-202-001/pull/81)</p></td></tr>
<tr><td>
<table>
<tr><td>F3 - First And Last Name</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656681-430ea21a-4f1e-4499-88ab-12a46c878658.png">
<p>Shows input for first and last name</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656723-a0801bcf-4ae9-4012-be04-29b6bd38b26c.png">
<p>Shows input</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656744-7ce33e2f-fb79-4f74-a702-903200a1ded8.png">
<p>Shows user friendly message</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656766-4732acb3-dae5-4ee9-b695-5273d3105bfa.png">
<p>Shows Test1@gmail.com properly updated with first and last name</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656839-e849af19-d0d9-461a-b839-b7f7665eb426.png">
<p>Check for length and correct alphabetical input</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145656868-0e4c0a68-85a8-4c4c-a694-4fbe45cfda2c.png">
<p>Shows wrong input and corresponding messages</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F4 - User will be able to transfer funds to another user’s account (2021-12-10)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/transferfunds.php](https://mh45-prod.herokuapp.com/Project/transferfunds.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/80](https://github.com/MichaelHalaj/IT-202-001/pull/80)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/91](https://github.com/MichaelHalaj/IT-202-001/pull/91)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/93](https://github.com/MichaelHalaj/IT-202-001/pull/93)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/96](https://github.com/MichaelHalaj/IT-202-001/pull/96)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/99](https://github.com/MichaelHalaj/IT-202-001/pull/99)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/102](https://github.com/MichaelHalaj/IT-202-001/pull/102)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/106](https://github.com/MichaelHalaj/IT-202-001/pull/106)</p></td></tr>
<tr><td>
<table>
<tr><td>F4 - Form should include a dropdown of the current user’s accounts (as AccountSrc) / Form should include a field for the destination user’s last name / Form should include a field for the last 4 digits of the destination user’s account number (to lookup AccountDest) / Form should include a field for a positive numerical value Form should allow the user to record a memo for the transaction</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145657171-388939d8-4b66-418b-930c-a3bc5c30e842.png">
<p>Shows the list of accounts from user, input for last name and last 4 characters of account, a positive input value and input for memo</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145657889-e814cdd2-6fa1-45a9-9224-c029c5290f45.png">
<p>Showing how to navigate to the transfer to other users</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F4 - System shouldn’t let the user transfer more than the balance of their account</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145658221-933f0aa5-cbf0-45be-8e61-08779a840908.png">
<p>Shows that the user cannot transfer if they do not have enough money</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F4 - System will lookup appropriate account based on destination user’s last name and the last 4 digits of the account number</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145658940-302feeba-ff82-453e-b294-5148791abb5f.png">
<p>Code that looks up  last name and last 4 digits</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F4 - Show appropriate user-friendly error messages / Show user-friendly success messages</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145658996-3edba7a0-3d76-4c88-a403-f816e695fa49.png">
<p>Message when anything other than alphabetical letters are typed into input for last name</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145659793-f2e952f4-a0b3-4b01-bc13-e34b82cc564d.png">
<p>Message when user does not select account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145659813-7a1f1bc7-534f-4d72-a67f-d419ab5c5254.png">
<p>Message when the system cannot locate account to transfer to</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145659835-fe3c604b-72cf-4dda-8df4-8af9f92c0b50.png">
<p>Message and redirect with successful transfer</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F4 - Transaction will be recorded with the type as “ext-transfer” / Each transaction is recorded as a transaction pair in the Transaction table / These will reflect in the transaction history page</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/145659912-862acc5b-431e-4236-aa0c-0ae4ce7e4e21.png">
<p>Shows the type of transfer and pair in table </p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr></td></tr></table>

<table>
<tr><td>Milestone4</td></tr><tr><td>
<table>
<tr><td>F1 - User can set their profile to be public or private (will need another column in Users table) (2021-12-21)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/profile.php](https://mh45-prod.herokuapp.com/Project/profile.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/117](https://github.com/MichaelHalaj/IT-202-001/pull/117)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/118](https://github.com/MichaelHalaj/IT-202-001/pull/118)</p></td></tr>
<tr><td>
<table>
<tr><td>F1 - If public, hide email address from other users</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146874668-ecb18a31-fc33-4c01-9c84-969953b88af2.png">
<p>Demonstrates one account that has been set to private in User table</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146874781-b6c9e6cc-10fd-4aa5-ad7b-379ffee5bf02.png">
<p>Demonstrates how to set account to private or public</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146874859-8d3d8294-46ce-4225-b608-b3570abc8247.png">
<p>shows that email shows up as PRIVATE instead of showing actual email</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146874971-72d9aced-5a0a-4e85-95dd-a86ebe8002a1.png">
<p>shows that actual email shows up when account is set to PUBLIC</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F2 - User will be able open a savings account (2021-12-21)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/account.php](https://mh45-prod.herokuapp.com/Project/account.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/111](https://github.com/MichaelHalaj/IT-202-001/pull/111)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/68](https://github.com/MichaelHalaj/IT-202-001/pull/68)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/113](https://github.com/MichaelHalaj/IT-202-001/pull/113)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/119](https://github.com/MichaelHalaj/IT-202-001/pull/119)</p></td></tr>
<tr><td>
<table>
<tr><td>F2 - System will generate a 12 digit/character account number per the existing rules (see Checking Account above) / System will associate the account to the user Account type will be set as savings / Will require a minimum deposit of $5 (from the world account)</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146875558-1b9b9b1b-a4c4-4b7d-bd97-3a8a4cc42ead.png">
<p>Shows that savings account with 12 characters was created</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F2 - System sets an APY that’ll be used to calculate monthly interest based on the balance of the account</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146875770-be1d3d09-2bae-4034-993e-769a19f3c2ab.png">
<p>Shows test of interest calculated based on an account's balance</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146875886-9064444e-5ad2-4234-a57c-05c2a3c0b786.png">
<p>Shows code snippet that determines payout based on APY</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146876048-7c27a5ea-b3fb-4ad4-a58f-9df4365f519b.png">
<p>APY table</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F2 - User will see user-friendly error messages when appropriate / User will see user-friendly success message when account is created successfully</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146876126-253a3ec2-d64e-48a3-9cfd-1382d48ee188.png">
<p>Shows how to select  and create savings account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146876224-a0397d90-b095-4000-9db7-14366bb47b96.png">
<p>Shows success messages when created and deposited amount</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F3 - User will be able to take out a loan (2021-12-21)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/loan.php](https://mh45-prod.herokuapp.com/Project/loan.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/transfer.php](https://mh45-prod.herokuapp.com/Project/transfer.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/112](https://github.com/MichaelHalaj/IT-202-001/pull/112)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/114](https://github.com/MichaelHalaj/IT-202-001/pull/114)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/115](https://github.com/MichaelHalaj/IT-202-001/pull/115)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/121](https://github.com/MichaelHalaj/IT-202-001/pull/121)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/122](https://github.com/MichaelHalaj/IT-202-001/pull/122)</p></td></tr>
<tr><td>
<table>
<tr><td>F3 - System will generate a 12 digit/character account number per the existing rules (see Checking Account above) / Account type will be set as loan / Will require a minimum value of $500</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146876752-b1465a01-953e-444e-b346-9b20918f9e9d.png">
<p>Shows minimum value </p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146883335-276fcbfc-dfed-42e1-bbe1-daff176da2af.png">
<p>Shows 12 character generation for loan account as well as positive balance for loans at the bottom</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F3 - System will show an APY (before the user submits the form) / Form will have a dropdown of the user’s accounts of which to deposit the money into</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146883523-e65c11f4-4958-42e6-a415-1eca9ef69fa3.png">
<p>Shows APY and dropdown of user accounts </p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F3 - Special Case for Loans:</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146884600-353f912a-5835-47f5-b197-0b79945b54a2.png">
<p>Image shows that loan accounts do NOT appear in source dropdown</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146884652-453a3846-d294-49f8-8f74-b68cc5305437.png">
<p>Image shows that loan account do appear in destination dropdown</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146885118-5e147b90-318d-4454-9915-b0f13fea00d6.png">
<p>Code used to calculated APY for loan</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F3 - User will see user-friendly error messages when appropriate / User will see user-friendly success message when account is created successfully</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146884483-b16e5dcd-ed06-42f5-8971-c3c79d7bc1e3.png">
<p>Shows that you cannot transfer anymore to loan account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146884800-197b0922-5f37-4266-b5bf-d80231d862a8.png">
<p>Shows successful opening of loan account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146885296-ba0328df-3397-4610-bfca-ff8b733fbdb6.png">
<p>Error shown when user inputs account that is not theirs and tries to create loan account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146885415-caeee1e8-950b-425e-b2b7-008e2c29a349.png">
<p>Error when user does not select account to deposit loan into</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F4 - Listing accounts and/or viewing Account Details should show any applicable APY or “-” if none is set for the particular account (may alternatively just hide the display for these types) (2021-12-21)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/120](https://github.com/MichaelHalaj/IT-202-001/pull/120)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/130](https://github.com/MichaelHalaj/IT-202-001/pull/130)</p></td></tr>
<tr><td>
<table>
<tr><td>F4 - none</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146886194-21d861c1-d4ba-4d8a-a389-19a677327e5a.png">
<p>Shows applicable APY next to savings and loan accounts</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F5 - User will be able to close an account (2021-12-21)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/close.php](https://mh45-prod.herokuapp.com/Project/close.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/116](https://github.com/MichaelHalaj/IT-202-001/pull/116)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/121](https://github.com/MichaelHalaj/IT-202-001/pull/121)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/123](https://github.com/MichaelHalaj/IT-202-001/pull/123)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/124](https://github.com/MichaelHalaj/IT-202-001/pull/124)</p></td></tr>
<tr><td>
<table>
<tr><td>F5 - User must transfer or withdraw all funds out of the account before doing so / If the account is a loan, it must be paid off in full first</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146886682-8c6ce1fe-6854-457a-a552-14d27ebbc8ab.png">
<p>Shows the layout of closing an account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146886758-4e01fba4-d20f-47f9-823e-8f53ef46c14c.png">
<p>Shows what happens when clicking on account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146886847-0ee46acb-0044-47e9-aa0e-e0fdc48b65e3.png">
<p>Shows what happens when clicking on loan account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146886979-7e287453-0cde-4832-8cd9-9cc522c534b8.png">
<p>Shows what happens you enter exact amount to pay off loan and close account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146887063-40123c33-7658-4bfd-9665-092581dc9f4f.png">
<p>Shows that loan account no longer shows up</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F5 - Account should have a column “active” that will get set as false.</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146887275-8313ed7c-6b06-4fe6-a381-639d62e2f35b.png">
<p>Shows that user must enter exact amount needed to close account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146887443-44bf51c2-67d4-426e-b6a1-5bfd644e6852.png">
<p>Shows the column where the account active is set to false and no longer appears on almost all dropdown menus</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F6 - Admin role (leave this section for last) (2021-12-21)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://mh45-prod.herokuapp.com/Project/home.php](https://mh45-prod.herokuapp.com/Project/home.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/admin/search.php](https://mh45-prod.herokuapp.com/Project/admin/search.php)</p><p>

 [https://mh45-prod.herokuapp.com/Project/admin/manage.php](https://mh45-prod.herokuapp.com/Project/admin/manage.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/124](https://github.com/MichaelHalaj/IT-202-001/pull/124)</p><p>

 [https://github.com/MichaelHalaj/IT-202-001/pull/127](https://github.com/MichaelHalaj/IT-202-001/pull/127)</p></td></tr>
<tr><td>
<table>
<tr><td>F6 - Will be able to search for users by firstname and/or lastname</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146888018-fa063e6e-be34-4785-8257-2d82d02ef681.png">
<p>Shows result for searching my first name only</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146888202-c32d6589-7960-4ba3-8984-7a19ea05c15c.png">
<p>Shows result for searching both first and last name</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146888355-d54687e0-e675-4631-9035-d46003ba1d3d.png">
<p>Shows no matches found when cannot find user </p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F6 - Will be able to look-up specific account numbers (partial match) / Will be able to see the transaction history of an account</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146888496-bf1a31e5-95a4-49bb-8ecd-5ab468794e03.png">
<p>Shows partial match account history</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F6 - Will be able to freeze an account (this is similar to disable/delete but it’s a different column)</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146888746-5c362ad6-9610-41c4-b05f-fb9707ee3092.png">
<p>Shows option to freeze an account</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146888821-bb7929c3-5e01-4984-9b38-8795f17d884b.png">
<p>Shows message when account is frozen or unfrozen</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146889252-cd736d11-674f-44f0-a2bc-4d6457e5f82e.png">
<p>Shows column for where account is frozen</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146889419-9fe59f74-7527-41ae-8845-4aed68937e5f.png">
<p>Code that checks if an account is frozen and prevents that account from being interacted with</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146889592-3e030306-b5f2-4d4d-bb8f-af3e5ac10046.png">
<p>Message that appears whenever user tries to interact with an account that is frozen</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F6 - Will be able to open accounts for specific users</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146889792-2b08c653-c39d-4067-b72e-ee0e191769b6.png">
<p>Demonstrates option to create account for another user</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146889845-2da06a8e-a99f-4ed8-9047-220a59cd9335.png">
<p>Shows success message when account is created</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146889928-2a6d8edd-3e1f-461a-add0-9211d572d5a8.png">
<p>Shows the newly created account for user with id 35 in table</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F6 - Will be able to deactivate a user</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146890152-7dca9f63-191d-4afd-a582-ec7a4d70322a.png">
<p>Shows option to deactivate a user by selecting false and then confirm</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146890737-4e2c4a4a-92fc-437e-a0a7-f99f2ab9b573.png">
<p>Shows what happens if active is set to true</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146890823-c1c5c51a-79af-4f9a-b057-68e150b99677.png">
<p>Shows what happens if active is set to false</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/89932319/146890944-91a6af62-6e9c-4152-b744-afa0ada60699.png">
<p>Shows what happens when trying to log into account that has been deactivated</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr></td></tr></table>
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