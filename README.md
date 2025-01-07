# DriveWise Admin Panel

**DriveWise Admin Panel** is a feature-rich and intuitive platform designed to manage chat systems, APIs, reminders, notifications, and users effectively. It serves as a central hub for administrators to streamline operations and ensure efficient communication and management.

---

## Features

### 💬 **Chat Management**
- **Monitor Chats**: View and manage all active chats.
- **Archive Chats**: Safely store past conversations for record-keeping.
- **Search Chats**: Quickly locate specific conversations.

### 🌐 **API Management**
- **API Key Generation**: Create and manage API keys for external integrations.
- **Monitor API Usage**: Track API calls and usage analytics.
- **Access Control**: Define API access permissions for different users.

### ⏰ **Reminders & Notifications**
- **Create Reminders**: Set reminders for important tasks or events.
- **Manage Notifications**: Send push or email notifications to users.
- **Schedule Notifications**: Automate the delivery of reminders and updates.

### 👥 **User Management**
- **Add/Remove Users**: Create new user accounts or deactivate existing ones.
- **Edit User Profiles**: Update user details, preferences, or roles.
- **Track Activity**: Monitor user login history and activity logs.

---

## Installation

### Prerequisites
- PHP 8.2+
- Laravel 11
- MySQL
- Composer

### Steps
1. **Clone the repository**:
    ```bash
    git clone https://github.com/sameededitz/drivewise.git
    ```
2. **Navigate to the project directory**:
    ```bash
    cd drivewise
    ```
3. **Install dependencies**:
    ```bash
    composer install
    ```
4. **Set up environment variables**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. **Run migrations and seeders**:
    ```bash
    php artisan migrate --seed
    ```
6. **Start the server**:
    ```bash
    php artisan serve
    ```

---

## Usage

### Admin Features
- **Dashboard**: Gain insights into chats, reminders, notifications, and user activity.
- **Chat Management**: Oversee active and archived conversations.
- **Reminder Management**: Schedule and deliver important reminders.
- **User Management**: Manage user accounts, profiles, and activity logs.

---

## Technologies Used
- **Backend**: Laravel 11
- **Frontend**: Livewire 3, Bootstrap
- **Database**: MySQL

---

## Developer Information
- **Developer**: Sameed
- **Instagram**: [@not_sameed52](https://www.instagram.com/not_sameed52/)
- **Discord**: sameededitz
- **Linktree**: [linktr.ee/sameededitz](https://linktr.ee/sameededitz)
- **Company**: TecClubb
  - **Website**: [https://tecclubb.com/](https://tecclubb.com/)
  - **Contact**: tecclubb@gmail.com

---

## Contributing
Contributions are welcome! Fork the repository, create a new branch, and submit a pull request. Open an issue first for significant changes.

---

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## Contact
For inquiries or support, reach out via:
- **Email**: tecclubb@gmail.com
- **Website**: [https://tecclubb.com/](https://tecclubb.com/)
