<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <div class="logo">My Dashboard</div>
        <div class="user-settings">User</div>
    </header>
    <div class="sidebar">
        <nav>
            <ul>
                <li>Home</li>
                <li>Analytics</li>
                <li>Reports</li>
                <li>Settings</li>
                <li>Logout</li>
            </ul>
        </nav>
    </div>
    <main>
        <section class="live-stats">
            <div class="stat-card">Total Users: <span id="total-users">1000</span></div>
            <div class="stat-card">Active Sessions: <span id="active-sessions">250</span></div>
            <div class="stat-card">Revenue: <span id="revenue">$5000</span></div>
        </section>
        <section class="charts">
            <canvas id="lineChart"></canvas>
            <canvas id="barChart"></canvas>
            <canvas id="pieChart"></canvas>
        </section>
        <section class="data-table">
            <input type="text" id="search" placeholder="Search...">
            <table>
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">Name</th>
                        <th onclick="sortTable(1)">Email</th>
                        <th onclick="sortTable(2)">Status</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Data rows will be populated here -->
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 My Dashboard. All rights reserved.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>