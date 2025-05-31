<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sales Performance Dashboard</title>
</head>
<body>
    <header>
        <div class="logo">My Company</div>
        <h1>Sales Performance Dashboard</h1>
        <div class="user-profile">User Avatar</div>
    </header>
    <aside class="sidebar">
        <nav>
            <ul>
                <li>Dashboard Overview</li>
                <li>Sales Statistics</li>
                <li>User Management</li>
                <li>Reports</li>
                <li>Settings</li>
            </ul>
        </nav>
    </aside>
    <main>
        <section class="live-statistics">
            <div class="stat-card">Total Sales: $10,000</div>
            <div class="stat-card">New Customers: 50</div>
            <div class="stat-card">Active Users: 200</div>
            <div class="stat-card">Revenue Growth: 15%</div>
        </section>
        <section class="charts">
            <canvas id="salesOverTimeChart"></canvas>
            <canvas id="salesByCategoryChart"></canvas>
        </section>
        <section class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Product</th>
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
        <p>&copy; 2023 My Company. All rights reserved.</p>
    </footer>
    <script src="scripts.js"></script>
</body>
</html>