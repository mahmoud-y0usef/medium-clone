# Medium Clone

A full-featured publishing platform built with Laravel 12, inspired by Medium.com. Users can write, publish, and discover stories across a range of topics.

---

## Table of Contents

- [Overview](#overview)
- [Tech Stack](#tech-stack)
- [Features](#features)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [Installation](#installation)
- [Seeding](#seeding)
- [Routes](#routes)
- [Authentication Flow](#authentication-flow)
- [Editor](#editor)
- [Layouts](#layouts)

---

## Overview

This project replicates the core experience of Medium.com: a clean reading and writing interface, topic-based browsing, user follows, post reactions, bookmarks, comments, and a personal statistics dashboard. The landing page is a marketing page only — no content is visible until an account is created.

---

## Tech Stack

| Layer       | Technology                          |
|-------------|-------------------------------------|
| Framework   | Laravel 12.x                        |
| PHP         | 8.4                                 |
| Auth        | Laravel Breeze (session-based)      |
| Frontend    | Blade + Tailwind CSS v3             |
| Build tool  | Vite 7                              |
| JS          | Alpine.js, Quill v2 (bubble theme)  |
| Database    | MySQL / SQLite                      |
| Storage     | Laravel local disk (public)         |
| Testing     | Pest 3                              |

---

## Features

### Public (unauthenticated)
- Landing page with full-screen hero and SVG illustration
- All nav buttons (Sign in, Get started, Write) open an auth modal with register and login panels
- No posts, profiles, or any content is accessible without an account
- Unauthenticated requests to any protected URL redirect to the landing page

### Authentication
- Register with name, email, password
- Login with remember-me
- Email verification required before accessing the app
- Password reset via email link
- After registration, the user is redirected to an onboarding topic picker

### Onboarding
- Topic picker with interest areas
- User selects topics before continuing to the feed
- Selections stored for future feed personalisation

### Dashboard
- Horizontal category tab strip — no visible scrollbar, fade gradient on overflow edges + left/right arrow buttons
- Paginated post cards with cover image, author name, title, excerpt, reading time, and clap count
- Active category tab is highlighted and tabs are filterable by category slug

### Stories (writing)
- Clean Medium-style editor with no chrome by default
- Title is a plain auto-resizing textarea
- Body uses Quill v2 in bubble mode — formatting toolbar appears as a floating popup on text selection
- Floating `+` button appears beside empty paragraphs for inserting:
  - Inline images loaded from disk (embedded as base64)
  - Horizontal dividers
- Publish panel slides in from the right with:
  - Cover image upload with live preview
  - Category dropdown
  - Tags input (comma-separated, stored in a many-to-many relation)
  - Publish immediately or save as draft
- Editing a story pre-fills all fields including the tag list and cover preview

### Post page
- Full HTML content rendered from the stored Quill delta
- Cover image at the top if set
- Author info, category badge, tag list, publication date, reading time
- Clap (like) button with live count
- Bookmark toggle
- Comment section with stored responses

### Profile
- Public author profile listing all their published posts
- Follow / unfollow toggle
- Avatar initial badge when no photo is uploaded

### Library
- List of all posts the authenticated user has bookmarked

### Following feed
- Chronological feed of posts from authors the user follows

### Stories management
- Separate tabs for drafts and published posts
- Edit or delete any story from within the list

### Stats
- Summary totals: claps received, comments received, followers
- Per-story breakdown table with individual clap and comment counts for each published post

### Search
- Full-text search across post titles and content
- Results displayed as standard post cards

---

## Project Structure

```
app/
  Http/
    Controllers/
      Auth/                     # Breeze auth controllers
      BookmarkController.php
      CommentController.php
      FollowController.php
      FollowingController.php
      HomeController.php
      LikeController.php
      OnboardingController.php
      PostController.php
      ProfileController.php
      SearchController.php
      StatsController.php
      StoryController.php
      UserController.php
    Requests/
      StorePostRequest.php
      UpdatePostRequest.php
  Models/
    Bookmark.php
    Category.php
    Comment.php
    Follow.php
    Like.php
    Post.php
    Tag.php
    User.php
  Policies/
    PostPolicy.php

resources/
  views/
    layouts/
      app.blade.php             # Authenticated layout — left sidebar + floating top-right bar
      editor.blade.php          # Clean editor layout (no chrome)
      public.blade.php          # Guest layout for landing page
    auth/                       # Breeze auth views (restyled to match project)
    posts/
      create.blade.php
      edit.blade.php
      show.blade.php
    dashboard.blade.php
    home.blade.php              # Landing page with hero and auth modal
    onboarding.blade.php
    stories/
      index.blade.php
    stats/
      index.blade.php
    following/
      index.blade.php

database/
  migrations/                   # 11 migration files (see schema section)
  seeders/
    DatabaseSeeder.php          # 10 categories, 10 users, 100 posts
  factories/
    PostFactory.php
    UserFactory.php

routes/
  web.php
  auth.php
```

---

## Database Schema

### users
| Column            | Type           | Notes                  |
|-------------------|----------------|------------------------|
| id                | bigint PK      |                        |
| name              | string         |                        |
| email             | string         | unique                 |
| email_verified_at | timestamp      | nullable               |
| password          | string         |                        |
| remember_token    | string         | nullable               |
| timestamps        |                |                        |

### categories
| Column | Type      |
|--------|-----------|
| id     | bigint PK |
| name   | string    |

### posts
| Column       | Type           | Notes               |
|--------------|----------------|---------------------|
| id           | bigint PK      |                     |
| title        | string         |                     |
| slug         | string         | unique              |
| image        | string         | nullable, file path |
| content      | longText       | Quill HTML          |
| category_id  | FK → categories|                     |
| user_id      | FK → users     |                     |
| published_at | timestamp      | null = draft        |
| timestamps   |                |                     |

### comments
| Column     | Type      |
|------------|-----------|
| id         | bigint PK |
| body       | text      |
| post_id    | FK        |
| user_id    | FK        |
| timestamps |           |

### likes
| Column  | Type | Notes          |
|---------|------|----------------|
| post_id | FK   | composite PK   |
| user_id | FK   | composite PK   |

### bookmarks
| Column  | Type | Notes          |
|---------|------|----------------|
| post_id | FK   | composite PK   |
| user_id | FK   | composite PK   |

### follows
| Column       | Type | Notes          |
|--------------|------|----------------|
| follower_id  | FK   | composite PK   |
| following_id | FK   | composite PK   |

### tags
| Column | Type      |
|--------|-----------|
| id     | bigint PK |
| name   | string    |
| slug   | string    |

### post_tag (pivot)
| Column  | Type |
|---------|------|
| post_id | FK   |
| tag_id  | FK   |

---

## Installation

```bash
# 1. Clone the repository
git clone <repo-url>
cd medium

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Copy and configure environment
cp .env.example .env
php artisan key:generate
```

Open `.env` and configure your database connection:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medium
DB_USERNAME=root
DB_PASSWORD=
```

For SQLite (zero-config local development):

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

```bash
# 5. Run migrations
php artisan migrate

# 6. Seed the database (optional but recommended)
php artisan db:seed

# 7. Create the storage symlink
php artisan storage:link

# 8. Compile frontend assets
npm run build

# 9. Start the development server
php artisan serve
```

The application will be available at `http://127.0.0.1:8000`.

For frontend development with hot module replacement, run `npm run dev` in a second terminal alongside `php artisan serve`.

---

## Seeding

`DatabaseSeeder` creates the following records:

- **10 categories**: Technology, Health, Travel, Food, Lifestyle, Education, Finance, Entertainment, Sports, Fashion
- **10 users** via `UserFactory` (Faker-generated names, emails, hashed passwords)
- **100 posts** via `PostFactory` distributed randomly across users and categories, with randomised `published_at` values

To rebuild the database from scratch:

```bash
php artisan migrate:fresh --seed
```

---

## Routes

| Method | URI                     | Route name         | Auth |
|--------|-------------------------|--------------------|------|
| GET    | /                       | home               | No   |
| GET    | /dashboard              | dashboard          | Yes  |
| GET    | /onboarding             | onboarding.index   | Yes  |
| POST   | /onboarding             | onboarding.store   | Yes  |
| GET    | /posts/create           | posts.create       | Yes  |
| POST   | /posts                  | posts.store        | Yes  |
| GET    | /posts/{slug}           | posts.show         | Yes  |
| GET    | /posts/{slug}/edit      | posts.edit         | Yes  |
| PUT    | /posts/{slug}           | posts.update       | Yes  |
| DELETE | /posts/{slug}           | posts.destroy      | Yes  |
| POST   | /posts/{post}/like      | posts.like         | Yes  |
| POST   | /posts/{post}/bookmark  | posts.bookmark     | Yes  |
| POST   | /posts/{post}/comments  | comments.store     | Yes  |
| DELETE | /comments/{comment}     | comments.destroy   | Yes  |
| GET    | /users/{user}           | users.show         | Yes  |
| POST   | /users/{user}/follow    | users.follow       | Yes  |
| GET    | /bookmarks              | bookmarks.index    | Yes  |
| GET    | /search                 | search             | Yes  |
| GET    | /stories                | stories.index      | Yes  |
| GET    | /stats                  | stats.index        | Yes  |
| GET    | /following              | following.index    | Yes  |
| GET    | /profile                | profile.edit       | Yes  |
| PATCH  | /profile                | profile.update     | Yes  |
| DELETE | /profile                | profile.destroy    | Yes  |

Auth routes (`/login`, `/register`, `/logout`, `/forgot-password`, `/verify-email`, etc.) are defined in `routes/auth.php` by Laravel Breeze.

---

## Authentication Flow

1. A guest visits `/` and sees the landing page only.
2. Clicking Sign in, Get started, Write, or Start reading opens an inline modal.
3. The modal has Register and Login panels that toggle without a page reload.
4. After registration, the user is redirected to `/email/verify` if email verification is enabled (it is by default — `User` implements `MustVerifyEmail`).
5. After verifying their email, the user is redirected to `/onboarding`.
6. After completing onboarding, the user lands on `/dashboard`.
7. Any unauthenticated access to a protected route redirects to `/` (configured via `redirectGuestsTo` in `bootstrap/app.php`).

---

## Editor

The story editor (`/posts/create` and `/posts/{slug}/edit`) is a distraction-free writing surface:

- **Title field** — a plain `<textarea>` with auto-resize, rendered in Playfair Display, no border
- **Body field** — Quill v2 in bubble mode; no visible toolbar until text is selected, at which point a formatted popup appears with: H1, H2, H3, bold, italic, underline, blockquote, code block, ordered list, unordered list, link, and image
- **Floating `+` button** — appears to the left of any empty paragraph line while the cursor is in the body; clicking it opens a mini-menu offering:
  - Insert image from disk (converts to base64, stored inline in the HTML)
  - Insert horizontal rule divider (custom Quill blot)
- **Publish panel** — clicking the Publish button in the top bar slides in a right-side panel containing:
  - Cover image upload with instant preview
  - Category selector (required)
  - Tags field (comma-separated; individual tags are looked up or created and linked via `post_tag`)
  - A toggle between "Publish now" and "Save as draft"
  - Final submit button

Post slugs are auto-generated from the title using `Str::slug()`. If a slug already exists, a numeric suffix is appended to ensure uniqueness.

Cover images are uploaded to `storage/app/public/posts` and served via the storage symlink. The `Post` model has an `image_url` accessor that returns the correct public URL for both storage-based paths and external URLs.

---

## Layouts

| Layout     | File                       | Used by                                       |
|------------|----------------------------|-----------------------------------------------|
| Public     | `layouts/public.blade.php` | Landing page (`/`), onboarding                |
| App        | `layouts/app.blade.php`    | All authenticated pages except the editor     |
| Editor     | `layouts/editor.blade.php` | Create and edit story pages                   |

**App layout** has a fixed 240px left sidebar with navigation links (Home, Library, Stories, Stats, Following, Profile) and a floating top-right bar with a Write button and avatar dropdown.

**Editor layout** has no sidebar. It renders a minimal top bar with a logo and the Publish button, then a centered content area with a max-width for comfortable reading/writing width.

**Public layout** renders the full-width landing page with the marketing navbar, hero section, and footer. The auth modal is embedded in this layout and toggled via Alpine.js state.
