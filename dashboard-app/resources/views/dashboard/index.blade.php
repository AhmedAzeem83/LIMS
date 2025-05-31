<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Performance Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <div class="logo">My Company</div>
        <h1>Sales Performance Dashboard</h1>
        <div class="user-profile">User</div>
        <input type="date" id="date-range" />
    </header>
    <aside>
        <nav>
            <ul>
                <li>Home</li>
                <li>Reports</li>
                <li>Analytics</li>
                <li>Settings</li>
            </ul>
        </nav>
    </aside>
    <main>
        <section class="live-stats">
            <div class="stat-card">Total Sales: $10,000</div>
            <div class="stat-card">New Customers: 150</div>
            <div class="stat-card">Conversion Rate: 5%</div>
            <div class="stat-card">Average Order Value: $200</div>
        </section>
        <section class="charts">
            <canvas id="salesTrendChart"></canvas>
        </section>
        <section class="data-table">
            <table>
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">Date</th>
                        <th onclick="sortTable(1)">Customer Name</th>
                        <th onclick="sortTable(2)">Product</th>
                        <th onclick="sortTable(3)">Amount</th>
                        <th onclick="sortTable(4)">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be populated here -->
                </tbody>
            </table>
            <div class="pagination">Pagination Controls</div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 My Company. All rights reserved.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>