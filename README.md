# 🎬 Movie Manager

<div align="center">

A complete web application for managing and reviewing movies, built with modern PHP and a reactive interface.

[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![SQLite](https://img.shields.io/badge/SQLite-Data-003B57.svg?style=for-the-badge&logo=sqlite&logoColor=white)](https://www.sqlite.org/index.html)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev/)
[![Phosphor Icons](https://img.shields.io/badge/Phosphor_Icons-Icons-green?style=for-the-badge)](https://phosphoricons.com/)

</div>

---

## 📖 Table of Contents

| [Features](#-features) | [Tech Stack](#-tech-stack) | [How to Run](#-how-to-run) |
|----------------------|---------------------------|------------------------------------------|
| [Structure](#-structure) | [Screenshots](#-screenshots) | [Contributing](#-contributing) |

---

## 🚀 Features

**Movie Manager** allows users to create an account, explore a movie catalog, and manage their own collection.

### 🔐 Authentication
- **Login & Register**: Complete flow with data validation and security (password hashing).
- **Split-Screen Interface**: Modern design with smooth toggling between login and register forms using Alpine.js.
- **Visual Feedback**: Real-time validation with icons and contextual error messages.

### 🎥 Dashboard & Explore
- **Visual Catalog**: Movie listing in cards featuring posters, average rating, and details.
- **Search**: Real-time movie filtering by title.
- **Responsiveness**: Adaptive layout for both mobile and desktop.

### 📝 Management (CRUD)
- **My Movies**: Exclusive area for managing movies registered by the user.
- **Add Movie**: Image upload (posters), year selection, category, and description.
- **Edit & Delete**: (Planned for future versions).

### ⭐ Reviews
- **Review System**: Users can rate movies (1-5 stars) and leave comments.
- **Average Calculation**: Movie rating is automatically calculated based on reviews.
- **Interactivity**: Dynamic rating modal.

---

## 💻 Tech Stack

This project was developed using the following technologies:

- **PHP 8+**: Robust and performant backend language.
- **SQLite**: Lightweight and efficient database, no complex server configuration required.
- **Tailwind CSS**: Utility-first CSS framework for rapid and consistent styling.
- **Alpine.js**: Minimalist JavaScript framework for frontend interactivity (modals, toggles, uploads).
- **Phosphor Icons**: Flexible and modern icon library.

---

## 🛠️ How to Run

Follow the steps below to run the project locally:

### Prerequisites
- PHP 8.0 or higher installed.
- Recommended PHP extensions: `pdo`, `pdo_sqlite`.

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/movie-manager.git
   cd movie-manager
   ```

2. **Setup Database**
   Run the setup script to create the database and tables:
   ```bash
   php setup_database.php
   ```

3. **Start the Server**
   Use the built-in PHP server:
   ```bash
   php -S localhost:8888
   ```

4. **Access the Application**
   Open your browser and navigate to: `http://localhost:8888`

---

## 📂 Structure

```bash
movie-manager/
├── controllers/      # Control logic (Login, Register, Movies)
├── models/           # Model Classes (Movie, Review, User)
├── views/            # HTML/PHP Templates
│   ├── partials/     # Reusable components (Cards, Search)
│   └── template/     # Base Layouts (App, Guest)
├── public/           # Static files (Images, CSS)
├── Database.php      # SQLite connection class
├── routes.php        # Simple route definition
└── setup_database.php # DB initialization script
```

---

## 🤝 Contributing

Contributions are always welcome! Feel free to open issues or submit pull requests.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/MyFeature`)
3. Commit your Changes (`git commit -m 'feat: Add some amazing feature'`)
4. Push to the Branch (`git push origin feature/MyFeature`)
5. Open a Pull Request

---

<div align="center">
Made with 💜 by <a href="https://github.com/rafaumeu">Rafael Dias Zendron</a>

[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/rafael-dias-zendron-528290132/)
[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/rafaumeu)
</div>
