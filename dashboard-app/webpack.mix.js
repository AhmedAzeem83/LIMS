<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Analytics Dashboard</title>
</head>
<body>
    <header>
        <div class="logo">My Dashboard</div>
        <h1>Analytics Dashboard</h1>
        <div class="user-profile">User ▼</div>
    </header>
    <aside class="sidebar">
        <nav>
            <ul>
                <li>Home</li>
                <li>Reports</li>
                <li>Settings</li>
                <li>Help</li>
            </ul>
        </nav>
    </aside>
    <main>
        <section class="live-statistics">
            <div class="stat-card">Total Users: 1,234</div>
            <div class="stat-card">Active Sessions: 567</div>
            <div class="stat-card">Revenue: $12,345</div>
        </section>
        <section class="charts">
            <canvas id="lineChart"></canvas>
            <canvas id="barChart"></canvas>
            <canvas id="pieChart"></canvas>
        </section>
        <section class="data-table">
            <input type="text" placeholder="Search...">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User ID</th>
                        <th>Activity</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be populated here -->
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 My Company</p>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
    </footer>
    <script src="scripts.js"></script>
</body>
</html>