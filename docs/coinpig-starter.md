# CoinPig: Laravel Vue Project Structure

Based on reviewing the original Next.js/Supabase schema, here's a proposed structure for implementing CoinPig as a Laravel Vue application supporting both families and classrooms:

## Core Architecture

1. **Backend**: Laravel with Inertia.js for seamless Vue integration
2. **Frontend**: Vue.js using Laravel Jetstream with Inertia
3. **Database**: PostgreSQL (recommended for production use)
4. **Authentication**: Laravel Jetstream with team functionality

## User Types & Permissions

Leveraging Laravel Jetstream's native team authorization with custom team types:

1. **Team Types**:

    - Family: Parent-child structure for home use
    - Classroom: Teacher-student structure for educational settings

2. **User Roles**:

    - Admin (Parent/Teacher): Manages finances, creates tasks, creates goals, approves completions
    - Member (Child/Student): Completes tasks, creates and manages goals, uses earned coins
    - Assistant (Older siblings/Teaching assistants): Limited admin capabilities

    _Planning prompt: What specific permissions should each role have in each team type? How might classroom needs differ from family needs?_

3. **Permission System**:

    - Laravel Policies to control resource access
    - Gates for higher-level permission checks
    - Jetstream's team-based role permissions
    - Custom middleware for route protection
    - Team-type specific permissions (classroom vs family)

    _Planning prompt: What granular permissions will be needed beyond the basic admin/member division? Will classroom permissions require educational-specific features?_

## Database Structure

### Users & Teams

1. **Users Table**:

    - Standard Laravel users table through Jetstream
    - Additional fields: `name`, `email`, `profile_photo_path`, `notification_preferences`
    - Fields for educational users: `educational_institution` (for teachers)

2. **Teams Table** (represents families or classrooms):

    - Jetstream's built-in teams table
    - `id`, `name`, `personal_team`, `user_id` (the parent/teacher user/owner)
    - Additional field: `team_type` (family/classroom)
    - Related `team_settings` table: `description`, `settings`, `educational_grade` (for classrooms)

    _Planning prompt: What specific settings will differ between families and classrooms? Will educational features require grade-level content adaptation?_

3. **Team User Table** (family/classroom memberships):

    - Jetstream's built-in team_user pivot table
    - Fields: `team_id`, `user_id`, `role`
    - Additional role-specific permissions and settings
    - Student/child-specific fields: `grade_level`, `age` (optional for age-appropriate content)

    _Planning prompt: How will invitation status be tracked with Jetstream's invitation system? Will there be different onboarding for students vs children?_

### Finance Components

1. **Wallets Table**:

    - `id`, `user_id`, `team_id`, `name`, `balance`, `settings`
    - Each member gets a wallet when added to a team
    - Classroom-specific fields: `educational_purpose`, `learning_objectives`

    _Planning prompt: Will classrooms use different wallet terminology or have educational objectives tied to wallet usage? How will classroom wallets differ from family wallets?_

2. **Transactions Table**:

    - `id`, `wallet_id`, `amount`, `type`, `reference_id`, `reference_type`, `notes`, `created_at`
    - Polymorphic relationship to tasks, goals, or manual transfers
    - Status tracking for pending/approved transactions
    - Educational fields: `learning_category`, `curriculum_alignment` (for classroom usage)

    _Planning prompt: What transaction metadata needs tracking? Will educational transactions need different categorization?_

### Tasks Module

1. **Tasks Table**:

    - `id`, `team_id`, `name`, `description`, `coin_reward`, `requires_approval`, `status`
    - Fields for task categorization: `category`, `difficulty_level`
    - Educational fields: `learning_objective`, `curriculum_standard`, `subject` (for classroom tasks)

    _Planning prompt: How will educational tasks differ from home tasks? Will there be a task library with educational content?_

2. **Task Assignments Table**:

    - Many-to-many relationship between tasks and users
    - `task_id`, `user_id`, `due_date`, `status`, `priority`
    - Classroom-specific fields: `learning_outcome`, `submission_type`

    _Planning prompt: How will task assignment differ in classroom settings? Will there be group assignments in classrooms?_

3. **Task Completions Table**:

    - `id`, `task_id`, `user_id`, `status`, `completed_at`, `approved_at`, `approved_by`
    - Fields for evidence: `completion_notes`, `evidence_files`
    - Educational assessment fields: `feedback`, `grade`, `competency_demonstrated`

    _Planning prompt: What verification is needed for task completion in educational contexts? Will teacher feedback need different fields than parent approval?_

4. **Task Recurrence Patterns**:

    - `id`, `task_id`, `frequency_type`, `frequency_value`, `start_date`, `end_date`
    - Handling for different recurrence patterns (daily, weekly, monthly, custom)
    - Educational scheduling fields: `academic_term`, `semester_alignment`

    _Planning prompt: How might recurrence patterns differ for classrooms vs families? Will school calendars affect task scheduling?_

### Goals Module

1. **Goals Table**:

    - `id`, `user_id`, `team_id`, `name`, `description`, `target_amount`, `current_amount`, `status`
    - Additional fields: `category`, `image`, `deadline`, `progress_percentage`
    - Educational fields: `learning_category`, `skill_development`, `curriculum_alignment`

    _Planning prompt: How will educational goals differ? Will there be class-wide goals in addition to individual student goals?_

2. **Goal Contributions Table**:

    - `id`, `goal_id`, `user_id`, `amount`, `status`, `approved_at`, `approved_by`
    - Source tracking for contributions (task rewards, manual additions)
    - Educational fields: `achievement_type`, `skill_demonstrated`

    _Planning prompt: Will educational contribution methods differ? Can teachers set different incentive structures than parents?_

## Application Flow

1. **Authentication & Onboarding**:

    - Laravel Jetstream for login/registration
    - Team creation during registration (family or classroom)
    - Member addition process (children or students)
    - Member invitation workflow using Jetstream's team invitations
    - Team type-specific setup wizards

    _Planning prompt: What information is needed during onboarding for each team type? How will the setup flow differ for teachers vs parents?_

2. **Admin Experience** (Parents/Teachers):

    - Team management dashboard with financial overview
    - Task creation and assignment interface
    - Approval queue for task completions
    - Member progress tracking and reporting
    - Classroom-specific: educational reports, curriculum alignment tracking

    _Planning prompt: What key metrics do admins need to see? What actions should be available directly from the dashboard? How will teacher dashboards differ from parent dashboards?_

3. **Member Experience** (Children/Students):

    - Personal dashboard showing wallet balance and tasks
    - Task list with completion submission interface
    - Goal creation and contribution workflow
    - Achievement and progress visualization
    - Educational-specific: learning progress, skill development tracking

    _Planning prompt: How should information be presented differently to students vs children? What educational elements should be included for classroom use?_

## Key Laravel Components

1. **Models**: Eloquent models with relationships for all entities
2. **Controllers**: Resource controllers for each domain with team-type aware logic
3. **Policies**: For role-based permissions and access control with team-type conditions
4. **Events & Listeners**: For handling wallet updates, task approvals, notifications
5. **Resources**: For data transformation in API responses
6. **Migrations**: For database schema setup and evolution
7. **Middleware**: For team-type specific routing and access control

## Frontend Structure

1. **Inertia.js**: For connecting Laravel backend with Vue frontend
2. **Vue Components**: Organized by feature domain with team-type variants
3. **Component Structure**:

    - Layouts for different dashboard types (extending Jetstream layouts)
    - Shared UI components using Tailwind CSS or another component library
    - Feature-specific components organized by domain
    - Team-type specific component variants (classroom vs family)

4. **Vue Component Organization**:
    - `/resources/js/Components` - Shared reusable components
    - `/resources/js/Layouts` - Page layouts including Jetstream layouts
    - `/resources/js/Pages` - Inertia page components for each route
    - `/resources/js/Pages/Family` - Family-specific page components
    - `/resources/js/Pages/Classroom` - Classroom-specific page components
    - `/resources/js/Mixins` - Shared functionality across components
    - `/resources/js/Store` - Pinia or Vuex store if state management is needed

## Development Phases

1. **Foundation Phase**

    - Core authentication & team structure using Jetstream
    - Team type implementation (family/classroom)
    - Basic role permissions with team-type awareness
    - Member invitation system

2. **Financial Framework Phase**

    - Wallet creation and management
    - Basic transaction system with team-type specific features
    - Balance calculations
    - Educational wallet features for classrooms

3. **Task Ecosystem Phase**

    - Task creation and assignment
    - Completion workflow with team-type specific approval processes
    - Recurring task support
    - Educational task templates and curriculum alignment

4. **Goals & Aspirations Phase**

    - Goal creation and tracking
    - Contribution mechanisms
    - Goal completion celebration
    - Educational goal tracking and skill development

5. **Insights & Reporting Phase**
    - Role-specific dashboards
    - Financial reporting
    - Activity analytics
    - Educational progress reporting for classroom settings

_Planning prompt: What MVP features should be prioritized for initial release? Should the system launch with both team types or focus on one initially?_
