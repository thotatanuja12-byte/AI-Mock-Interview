# AI Mock Interview

## Project Overview

AI Mock Interview is a web-based interview practice platform designed to help B.Tech students prepare for technical interviews in a realistic and structured environment.

The platform allows users to select a technical role, interview round, difficulty level, and interview duration. Based on these selections, the system provides role-specific interview questions and conducts a simulated interview session.

## Key Features

- User Registration and Login
- Role-Based Interview Selection
- Multiple Technical Roles
- Interview Rounds:
  - Warm Up
  - Coding
  - Role Related
  - Behavioral
- Difficulty Levels:
  - Easy
  - Medium
  - Hard
- Interview Durations:
  - 5 minutes – 4 questions
  - 15 minutes – 7 questions
  - 30 minutes – 12 questions
- Audio and Video Interview Support
- AI Interviewer Interface
- Randomized and Personalized Questions
- Interview Progress Tracking
- Interview Analytics and Feedback
- Interview History

## Technical Roles

The platform currently supports:

1. Software Engineer
2. Frontend Developer
3. Backend Developer
4. Full Stack Developer
5. Data Scientist / AI-ML Engineer
6. Data Analyst
7. Cybersecurity Engineer
8. Cloud / DevOps Engineer

## Technologies Used

- HTML5
- CSS3
- JavaScript
- PHP
- MySQL
- XAMPP
- GitHub

## Project Workflow

Home Page  
→ Login / Sign Up  
→ Role Selection  
→ Interview Configuration  
→ Practice Prerequisites  
→ AI Mock Interview  
→ Processing  
→ Analytics and Feedback

## Database

The project uses MySQL to store user account information and interview-related data.

## Project Structure

```text
AI-Mock-Interview/
│
├── index.html
├── login.html
├── signup.html
├── role-based.html
├── interview-setup.html
├── prerequisites.html
├── interview.html
├── processing.html
├── analytics.html
│
└── php/
    ├── db.php
    ├── login.php
    ├── signup.php
    ├── session-check.php
    └── test-db.php
