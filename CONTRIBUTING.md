# Contributing to Movie Manager

First off, thanks for taking the time to contribute! 🎉

The following is a set of guidelines for contributing to **Movie Manager**. These are mostly guidelines, not rules. Use your best judgment, and feel free to propose changes to this document in a pull request.

## 🛠 How to Contribute

### 1. Fork the Repository
Fork the repo and clone it to your machine:

```bash
git clone https://github.com/your-username/movie-manager.git
```

### 2. Create a Branch
Create a new branch for your feature or bug fix:

```bash
git checkout -b feat/my-amazing-feature
# or
git checkout -b fix/annoying-bug
```

### 3. Make Your Changes
- **PHP**: Follow modern PHP best practices and PSR standards.
- **Frontend**: We use Tailwind CSS. Avoid writing custom CSS unless absolutely necessary.
- **Interactivity**: Use Alpine.js for dynamic behaviors.

### 4. Commit Your Changes
We follow the **Conventional Commits** specification.

- `feat`: A new feature
- `fix`: A bug fix
- `docs`: Documentation only changes
- `style`: Changes that do not affect the meaning of the code (white-space, formatting, etc)
- `refactor`: A code change that neither fixes a bug nor adds a feature

**Example:**
```bash
git commit -m "feat(auth): implement password recovery"
```

### 5. Push and Open a Pull Request
Push your branch and open a Pull Request against the `main` branch.

```bash
git push origin feat/my-amazing-feature
```

## 🧪 Testing
Before submitting, please ensure:
- The application runs without errors (`php -S localhost:8888`).
- New features are tested manually.
- No debug code (`var_dump`, `dd`) is left behind.

## 🐛 Reporting Bugs
Bugs are tracked as GitHub issues. When filing an issue, explain the problem and include additional details to help maintainers reproduce the problem.

---

Happy Coding! 💜
